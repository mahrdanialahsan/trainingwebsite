<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Setting;
use App\Mail\BookingConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class WebhookController extends Controller
{
    public function stripe(Request $request)
    {
        $stripeSecretKey = Setting::get('stripe_secret_key', '');
        $webhookSecret = Setting::get('stripe_webhook_secret', '');

        if (!$stripeSecretKey || !$webhookSecret) {
            return response()->json(['error' => 'Stripe not configured'], 400);
        }

        Stripe::setApiKey($stripeSecretKey);

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $this->handlePaymentIntentSucceeded($paymentIntent);
                break;
        }

        return response()->json(['received' => true]);
    }

    private function handleCheckoutSessionCompleted($session)
    {
        $bookingId = $session->metadata->booking_id ?? null;
        
        if (!$bookingId) {
            return;
        }

        $booking = Booking::find($bookingId);
        
        if (!$booking || $booking->payment_completed) {
            return;
        }

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

        // Send confirmation email
        try {
            $booking->refresh();
            $booking->load(['course', 'payment']);
            Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
        } catch (\Exception $e) {
            // Log error but don't fail the webhook
            // Note: Webhook errors won't show on UI since it's server-to-server
            \Log::error('Failed to send booking confirmation email via webhook: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'email' => $booking->email,
                'exception' => $e
            ]);
        }
    }

    private function handlePaymentIntentSucceeded($paymentIntent)
    {
        // Additional handling if needed
    }
}
