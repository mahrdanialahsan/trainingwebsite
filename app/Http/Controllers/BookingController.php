<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Waiver;
use App\Models\WaiverAcceptance;
use App\Mail\BookingConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class BookingController extends Controller
{
    public function create($slug)
    {
        $course = Course::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        if (!$course->canBeBooked()) {
            return redirect()->route('courses')
                ->with('error', 'This course is not available for booking.');
        }

        return view('bookings.create', compact('course'));
    }

    public function store(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        if (!$course->canBeBooked()) {
            return redirect()->route('courses')
                ->with('error', 'This course is not available for booking.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.waiver', $booking);
    }

    public function showWaiver(Booking $booking)
    {
        $waiver = Waiver::where('is_active', true)->latest()->first();

        if (!$waiver) {
            return redirect()->route('bookings.payment', $booking)
                ->with('error', 'No active waiver found.');
        }

        return view('bookings.waiver', compact('booking', 'waiver'));
    }

    public function acceptWaiver(Request $request, Booking $booking)
    {
        $waiver = Waiver::where('is_active', true)->latest()->first();

        if (!$waiver) {
            return redirect()->back()->with('error', 'No active waiver found.');
        }

        $validated = $request->validate([
            'accepted_sections' => 'required|array|min:1',
            'accepted_sections.*' => 'required|string',
            'signature_name' => 'required|string|max:255',
        ]);

        WaiverAcceptance::create([
            'booking_id' => $booking->id,
            'waiver_id' => $waiver->id,
            'accepted_sections' => $validated['accepted_sections'],
            'signature_name' => $validated['signature_name'],
            'ip_address' => $request->ip(),
            'accepted_at' => now(),
        ]);

        $booking->update(['waiver_accepted' => true]);

        return redirect()->route('bookings.payment', $booking);
    }

    public function showPayment(Booking $booking)
    {
        if (!$booking->waiver_accepted) {
            return redirect()->route('bookings.waiver', $booking)
                ->with('error', 'You must accept the waiver before proceeding to payment.');
        }

        if ($booking->payment_completed) {
            return redirect()->route('bookings.confirmation', $booking);
        }

        $stripePublicKey = Setting::get('stripe_public_key', '');
        $stripeSecretKey = Setting::get('stripe_secret_key', '');
        $checkoutSessionId = null;

        // Create Stripe checkout session if keys are configured
        if ($stripePublicKey && $stripeSecretKey) {
            try {
                Stripe::setApiKey($stripeSecretKey);

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $booking->course->title,
                                'description' => 'Course booking for ' . $booking->course->date->format('F d, Y'),
                            ],
                            'unit_amount' => (int)($booking->course->price * 100), // Convert to cents
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('bookings.confirmation', $booking) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('bookings.payment', $booking),
                    'metadata' => [
                        'booking_id' => $booking->id,
                    ],
                ]);

                $checkoutSessionId = $session->id;
            } catch (\Exception $e) {
                // If Stripe fails, we'll show an error
                return redirect()->route('bookings.payment', $booking)
                    ->with('error', 'Payment system error. Please try again later.');
            }
        }

        return view('bookings.payment', compact('booking', 'stripePublicKey', 'checkoutSessionId'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        if (!$booking->waiver_accepted) {
            return redirect()->route('bookings.waiver', $booking)
                ->with('error', 'You must accept the waiver before proceeding to payment.');
        }

        if ($booking->payment_completed) {
            return redirect()->route('bookings.confirmation', $booking);
        }

        $stripeSecretKey = Setting::get('stripe_secret_key', '');
        $sessionId = $request->query('session_id');

        if ($sessionId && $stripeSecretKey) {
            try {
                Stripe::setApiKey($stripeSecretKey);
                $session = Session::retrieve($sessionId);

                if ($session->payment_status === 'paid') {
                    DB::transaction(function () use ($booking, $session) {
                        $payment = Payment::create([
                            'booking_id' => $booking->id,
                            'transaction_id' => $session->payment_intent,
                            'payment_method' => 'stripe',
                            'amount' => $booking->course->price,
                            'currency' => 'USD',
                            'status' => 'completed',
                            'payment_data' => json_encode($session),
                            'paid_at' => now(),
                        ]);

                        $booking->update([
                            'payment_completed' => true,
                            'status' => 'confirmed',
                        ]);
                    });

                    // Send confirmation email
                    $emailSent = false;
                    $emailError = null;
                    try {
                        $booking->refresh();
                        $booking->load(['course', 'payment']);
                        Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
                        $emailSent = true;
                    } catch (\Exception $e) {
                        // Log error and store for UI display
                        $emailError = 'Failed to send confirmation email: ' . $e->getMessage();
                        \Log::error('Failed to send booking confirmation email: ' . $e->getMessage(), [
                            'booking_id' => $booking->id,
                            'email' => $booking->email,
                            'exception' => $e
                        ]);
                    }

                    return redirect()->route('bookings.confirmation', $booking)
                        ->with('email_sent', $emailSent)
                        ->with('email_error', $emailError);
                }
            } catch (\Exception $e) {
                return redirect()->route('bookings.payment', $booking)
                    ->with('error', 'Payment verification failed. Please contact support.');
            }
        }

        // Fallback: if no Stripe session, redirect back to payment
        return redirect()->route('bookings.payment', $booking)
            ->with('error', 'Please complete the payment process.');
    }

    public function confirmation(Request $request, Booking $booking)
    {
        // If coming from Stripe checkout, verify the session
        $sessionId = $request->query('session_id');
        if ($sessionId && !$booking->payment_completed) {
            $stripeSecretKey = Setting::get('stripe_secret_key', '');
            if ($stripeSecretKey) {
                try {
                    Stripe::setApiKey($stripeSecretKey);
                    $session = Session::retrieve($sessionId);

                    if ($session->payment_status === 'paid' && $session->metadata->booking_id == $booking->id) {
                        $wasPaymentCompleted = $booking->payment_completed;
                        
                        DB::transaction(function () use ($booking, $session) {
                            Payment::updateOrCreate(
                                [
                                    'booking_id' => $booking->id,
                                    'transaction_id' => $session->payment_intent,
                                ],
                                [
                                    'payment_method' => 'stripe',
                                    'amount' => $booking->course->price,
                                    'currency' => 'USD',
                                    'status' => 'completed',
                                    'payment_data' => json_encode($session),
                                    'paid_at' => now(),
                                ]
                            );

                            $booking->update([
                                'payment_completed' => true,
                                'status' => 'confirmed',
                            ]);
                        });

                        // Send confirmation email only if payment was just completed
                        if (!$wasPaymentCompleted) {
                            $emailSent = false;
                            $emailError = null;
                            try {
                                $booking->refresh();
                                $booking->load(['course', 'payment']);
                                Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
                                $emailSent = true;
                            } catch (\Exception $e) {
                                // Log error and store for UI display
                                $emailError = 'Failed to send confirmation email: ' . $e->getMessage();
                                \Log::error('Failed to send booking confirmation email: ' . $e->getMessage(), [
                                    'booking_id' => $booking->id,
                                    'email' => $booking->email,
                                    'exception' => $e
                                ]);
                            }
                            
                            // Store email status in session for display
                            if ($emailError) {
                                session()->flash('email_error', $emailError);
                            } else {
                                session()->flash('email_sent', true);
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Log error but continue
                }
            }
        }

        if (!$booking->payment_completed) {
            return redirect()->route('bookings.payment', $booking);
        }

        return view('bookings.confirmation', compact('booking'));
    }
}
