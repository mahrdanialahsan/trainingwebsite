@extends('layouts.app')

@section('title', 'Accept Waiver')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Waiver Agreement</h1>

    <div class="bg-white rounded-none shadow-md p-8">
        <h2 class="text-2xl font-semibold mb-4">{{ $waiver->title }}</h2>

        <form method="POST" action="{{ route('bookings.accept-waiver', $booking) }}" id="waiverForm">
            @csrf

            <div class="mb-6">
                <div class="prose max-w-none">
                    {!! nl2br(e($waiver->content)) !!}
                </div>
            </div>

            @if($waiver->pdf_path)
            <div class="mb-6">
                <a href="{{ asset('storage/' . $waiver->pdf_path) }}" target="_blank" 
                   class="text-brand-primary hover:underline font-medium">View PDF Version</a>
            </div>
            @endif

            <div class="mb-6">
                <label for="signature_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name (Signature) *
                </label>
                <input type="text" name="signature_name" id="signature_name" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       placeholder="Type your full name to sign">
                @error('signature_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-start">
                    <input type="checkbox" name="accepted_sections[]" value="main" required
                           class="mt-1 mr-2">
                    <span class="text-sm text-gray-700">
                        I have read and understand the waiver terms and conditions. I agree to all terms and conditions stated above. *
                    </span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark text-lg font-semibold transition">
                    Accept and Continue to Payment
                </button>
                <a href="{{ route('courses.show', $booking->course->slug) }}" 
                   class="flex-1 bg-gray-300 text-gray-700 px-6 py-3 rounded-none hover:bg-gray-400 text-lg font-semibold text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
