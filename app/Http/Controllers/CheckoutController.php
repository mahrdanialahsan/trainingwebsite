<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = CartController::getCart();
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->where('is_active', true)->get()->keyBy('id');
        $items = [];
        $subtotal = 0;
        foreach ($cart as $productId => $qty) {
            $product = $products->get($productId);
            if (!$product || $qty < 1) {
                continue;
            }
            $lineTotal = (float) $product->price * (int) $qty;
            $subtotal += $lineTotal;
            $items[] = (object) [
                'product' => $product,
                'quantity' => (int) $qty,
                'line_total' => $lineTotal,
            ];
        }

        if (empty($items)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty or items are no longer available.');
        }

        return view('checkout.show', compact('items', 'subtotal'));
    }

    public function store(Request $request)
    {
        $cart = CartController::getCart();
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:1000',
        ]);

        $products = Product::whereIn('id', array_keys($cart))->where('is_active', true)->get()->keyBy('id');
        $subtotal = 0;
        $orderItems = [];
        foreach ($cart as $productId => $qty) {
            $product = $products->get($productId);
            if (!$product || $qty < 1) {
                continue;
            }
            $subtotal += (float) $product->price * (int) $qty;
            $orderItems[] = [
                'product' => $product,
                'quantity' => (int) $qty,
            ];
        }

        if (empty($orderItems)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty or items are no longer available.');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'status' => 'pending',
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'product_title' => $item['product']->title,
                'price' => $item['product']->price,
                'quantity' => $item['quantity'],
            ]);
        }

        $stripeSecretKey = Setting::get('stripe_secret_key', '');
        if (!$stripeSecretKey) {
            return redirect()->route('cart.index')->with('error', 'Payment is not configured. Please contact us to complete your order.');
        }

        try {
            Stripe::setApiKey($stripeSecretKey);

            $lineItems = [];
            foreach ($orderItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['product']->title,
                            'description' => 'Quantity: ' . $item['quantity'],
                        ],
                        'unit_amount' => (int) round($item['product']->price * 100),
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.show'),
                'metadata' => [
                    'order_id' => $order->id,
                ],
            ]);

            $order->update(['stripe_session_id' => $session->id]);

            return redirect()->away($session->url);
        } catch (\Exception $e) {
            \Log::error('Shop checkout Stripe error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment could not be started. Please try again.');
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return redirect()->route('shop')->with('error', 'Invalid checkout session.');
        }

        $stripeSecretKey = Setting::get('stripe_secret_key', '');
        if (!$stripeSecretKey) {
            return redirect()->route('shop')->with('error', 'Payment is not configured.');
        }

        try {
            Stripe::setApiKey($stripeSecretKey);
            $session = Session::retrieve($sessionId);
        } catch (\Exception $e) {
            return redirect()->route('shop')->with('error', 'Could not verify payment.');
        }

        $orderId = $session->metadata->order_id ?? null;
        if (!$orderId) {
            return redirect()->route('shop')->with('error', 'Invalid order.');
        }

        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('shop')->with('error', 'Order not found.');
        }

        if ($session->payment_status === 'paid' && !$order->isPaid()) {
            $order->update(['status' => 'paid']);
            session()->forget('shop_cart');
            
            // Send order confirmation email
            try {
                $order->refresh();
                $order->load('items');
                Mail::to($order->email)->send(new OrderConfirmationMail($order));
            } catch (\Exception $e) {
                \Log::error('Failed to send order confirmation email: ' . $e->getMessage(), [
                    'order_id' => $order->id,
                    'email' => $order->email,
                    'exception' => $e
                ]);
            }
        }

        $order->load('items');
        return view('checkout.success', compact('order'));
    }
}
