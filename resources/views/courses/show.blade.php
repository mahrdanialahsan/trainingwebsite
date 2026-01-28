@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-none shadow-md overflow-hidden">
        @if($course->thumbnail_image)
        <div class="w-full h-64 md:h-96 overflow-hidden">
            <img src="{{ asset($course->thumbnail_image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
        </div>
        @endif
        <div class="p-8">
            <h1 class="text-4xl font-bold text-brand-primary mb-4">{{ $course->title }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-brand-primary">Course Details</h2>
                <div class="space-y-2 mb-6">
                    <p><strong>Date:</strong> {{ $course->date->format('F d, Y') }}</p>
                    <p><strong>Time:</strong> {{ $course->start_time->format('g:i A') }} 
                        @if($course->end_time)
                        - {{ $course->end_time->format('g:i A') }}
                        @endif
                    </p>
                    <p><strong>Price:</strong> <span class="text-2xl font-bold text-brand-primary">${{ number_format($course->price, 2) }}</span></p>
                    @if($course->max_participants)
                    <p><strong>Max Participants:</strong> {{ $course->max_participants }}</p>
                    @endif
                </div>
            </div>
            
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-brand-primary">Description</h2>
                <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                @if($course->long_description)
                <div class="text-gray-700 prose max-w-none">
                    {!! $course->long_description !!}
                </div>
                @endif
            </div>
        </div>

        @if($course->canBeBooked())
        <div class="mt-8">
            <a href="{{ route('bookings.create', $course->slug) }}" class="inline-block bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark text-lg font-semibold transition">
                Book This Course
            </a>
        </div>
        @else
        <div class="mt-8">
            <p class="text-red-600 font-semibold">This course is not available for booking at this time.</p>
        </div>
        @endif
        </div>
    </div>
</div>
@endsection
