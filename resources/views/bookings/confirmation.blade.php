@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-none shadow-md p-8 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">Booking Confirmed!</h1>
        
        @if(session('email_error'))
            <div class="bg-yellow-50 border-2 border-yellow-400 text-yellow-800 px-4 py-3 rounded-none mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <p class="font-semibold mb-1">Email Notification Issue</p>
                        <p class="text-sm">{{ session('email_error') }}</p>
                        <p class="text-sm mt-2">Your booking is confirmed, but we encountered an issue sending the confirmation email. Please contact support if you need assistance.</p>
                    </div>
                </div>
            </div>
        @elseif(session('email_sent'))
            <p class="text-xl text-gray-600 mb-8">Thank you for your booking. We've sent a confirmation email to {{ $booking->email }}.</p>
        @else
            <p class="text-xl text-gray-600 mb-8">Thank you for your booking. A confirmation email has been sent to {{ $booking->email }}.</p>
        @endif

        <div class="bg-gray-50 rounded-none p-6 mb-8 text-left">
            <h2 class="text-2xl font-semibold mb-4">Booking Details</h2>
            <div class="space-y-2">
                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Course:</strong> {{ $booking->course->title }}</p>
                <p><strong>Date:</strong> {{ $booking->course->date->format('F d, Y') }}</p>
                <p><strong>Time:</strong> {{ $booking->course->start_time->format('g:i A') }}</p>
                <p><strong>Attendee:</strong> {{ $booking->full_name }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
                @if($booking->payment)
                <p><strong>Transaction ID:</strong> {{ $booking->payment->transaction_id }}</p>
                <p><strong>Amount Paid:</strong> ${{ number_format($booking->payment->amount, 2) }}</p>
                @endif
            </div>
        </div>

        <div class="flex space-x-4 justify-center">
            <a href="{{ route('courses') }}" class="bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark transition">
                View More Courses
            </a>
            <a href="{{ route('home') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-none hover:bg-gray-400">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
