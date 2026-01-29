@extends('layouts.app')

@section('title', 'Book Course')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Book: {{ $course->title }}</h1>

    <div class="bg-white rounded-none shadow-md p-8">
        <form method="POST" action="{{ route('bookings.store', $course) }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                    <input type="text" name="first_name" id="first_name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('first_name', auth()->check() ? explode(' ', auth()->user()->name)[0] ?? '' : '') }}">
                    @error('first_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('last_name', auth()->check() ? (count(explode(' ', auth()->user()->name)) > 1 ? implode(' ', array_slice(explode(' ', auth()->user()->name), 1)) : '') : '') }}">
                    @error('last_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" id="email" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input type="tel" name="phone" id="phone"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                <textarea name="notes" id="notes" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-gray-50 p-4 rounded-none mb-6">
                <h3 class="font-semibold mb-2">Course Details</h3>
                <p><strong>Date:</strong> {{ $course->date->format('F d, Y') }}</p>
                <p><strong>Time:</strong> {{ $course->start_time->format('g:i A') }}</p>
                <p><strong>Price:</strong> ${{ number_format($course->price, 2) }}</p>
            </div>

            <button type="submit" class="w-full bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark text-lg font-semibold transition cursor-pointer" style="cursor: pointer;">
                Continue to Waiver
            </button>
        </form>
    </div>
</div>
@endsection
