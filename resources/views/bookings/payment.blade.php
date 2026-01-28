@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Complete Payment</h1>

    <div class="bg-white rounded-none shadow-md p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Booking Summary</h2>
            <div class="bg-gray-50 p-4 rounded-none">
                <p><strong>Course:</strong> {{ $booking->course->title }}</p>
                <p><strong>Date:</strong> {{ $booking->course->date->format('F d, Y') }}</p>
                <p><strong>Time:</strong> {{ $booking->course->start_time->format('g:i A') }}</p>
                <p><strong>Attendee:</strong> {{ $booking->full_name }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Payment Amount</h2>
            <p class="text-3xl font-bold text-brand-primary">${{ number_format($booking->course->price, 2) }}</p>
        </div>

        @if($stripePublicKey)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Pay with Credit/Debit Card</h2>
            <p class="text-gray-600 mb-4">Secure payment powered by Stripe</p>
            <button id="checkout-button" class="w-full bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark text-lg font-semibold transition">
                Pay ${{ number_format($booking->course->price, 2) }} with Stripe
            </button>
        </div>
        @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-none p-4 mb-6">
            <p class="text-sm text-yellow-800">
                <strong>Payment system not configured:</strong> Please configure Stripe keys in the admin settings panel.
            </p>
        </div>
        @endif
    </div>
</div>

@if($stripePublicKey && $checkoutSessionId)
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ $stripePublicKey }}');
    const checkoutButton = document.getElementById('checkout-button');

    checkoutButton.addEventListener('click', function() {
        stripe.redirectToCheckout({
            sessionId: '{{ $checkoutSessionId }}'
        }).then(function (result) {
            if (result.error) {
                alert(result.error.message);
            }
        });
    });
</script>
@endif
@endsection
