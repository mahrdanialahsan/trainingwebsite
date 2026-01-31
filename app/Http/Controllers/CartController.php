<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private const CART_KEY = 'shop_cart';

    public function index()
    {
        $cart = session(self::CART_KEY, []);
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

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        $unavailable = !$product->is_active || !$product->inStock();
        if ($unavailable) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'This product is not available.', 'cart_count' => self::getCartCount()], 422);
            }
            return redirect()->route('shop.show', $product)->with('error', 'This product is not available.');
        }

        $qty = min(99, max(1, (int) $request->input('quantity', 1)));
        $cart = session(self::CART_KEY, []);
        $cart[$product->id] = min(99, ($cart[$product->id] ?? 0) + $qty);
        session([self::CART_KEY => $cart]);

        if ($request->wantsJson() || $request->ajax()) {
            $details = self::getCartDetails();
            $dropdownHtml = view('layouts.partials.cart-dropdown-content', [
                'items' => $details['items'],
                'subtotal' => $details['subtotal'],
            ])->render();
            return response()->json([
                'success' => true,
                'message' => 'Added to cart.',
                'cart_count' => self::getCartCount(),
                'dropdown_html' => $dropdownHtml,
            ]);
        }
        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function update(Request $request)
    {
        $cart = session(self::CART_KEY, []);
        $updates = $request->input('items', []);

        foreach ($updates as $productId => $qty) {
            $productId = (int) $productId;
            $qty = max(0, (int) $qty);
            if ($qty === 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = min(99, $qty);
            }
        }

        session([self::CART_KEY => $cart]);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session(self::CART_KEY, []);
        unset($cart[$product->id]);
        session([self::CART_KEY => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }

    public static function getCartCount(): int
    {
        $cart = session(self::CART_KEY, []);
        return (int) array_sum($cart);
    }

    public static function getCart(): array
    {
        return session(self::CART_KEY, []);
    }

    /**
     * Get cart items, subtotal and count for nav dropdown (uses session from current request).
     */
    public static function getCartDetails(): array
    {
        $cart = session(self::CART_KEY, []);
        $productIds = array_keys(array_filter($cart));
        if (empty($productIds)) {
            return ['items' => [], 'subtotal' => 0, 'count' => 0];
        }
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
        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'count' => (int) array_sum($cart),
        ];
    }
}
