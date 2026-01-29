@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-8">Training Courses</h1>

    @if($courses->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
        <div class="bg-white rounded-none shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            @if($course->thumbnail_image)
            <div class="w-full h-64 overflow-hidden relative group bg-gray-100 flex items-center justify-center">
                <img src="{{ asset($course->thumbnail_image) }}" alt="{{ $course->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
            <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
            <div class="mb-4">
                <p class="text-sm text-gray-500">Date: {{ $course->date->format('M d, Y') }}</p>
                <p class="text-sm text-gray-500">Time: {{ $course->start_time->format('g:i A') }}</p>
                <p class="text-lg font-bold text-brand-primary mt-2">${{ number_format($course->price, 2) }}</p>
            </div>
                <a href="{{ route('courses.show', $course->slug) }}" class="block w-full text-center bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark transition">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
    @else
    <div class="bg-white rounded-none shadow-md p-8 text-center">
        <p class="text-gray-600">No courses available at this time. Please check back later.</p>
    </div>
    @endif
</div>
@endsection
