@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section - Full Width -->
<div class="relative w-full bg-brand-primary text-white py-32 md:py-40 overflow-hidden min-h-[80vh]" style="background-image: url('{{ asset('images/cover.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <!-- Dark Overlay for Text Readability -->
    <div class="absolute inset-0 bg-brand-primary" style="opacity: 0.5;"></div>

    <!-- Content Overlay -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Professional Training Services</h1>
        <p class="text-xl md:text-2xl mb-8 text-gray-100" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">Enhance your skills with our expert-led courses and comprehensive training programs</p>
        <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('courses') }}" class="inline-block bg-white text-brand-primary px-8 py-3 rounded-none hover:bg-gray-100 font-semibold transition shadow-lg cursor-pointer">
                View Training Courses
            </a>
            @php
                $firstCourse = $upcomingCourses->first();
                $hasValidCourse = $firstCourse && $firstCourse->slug;
            @endphp
            @if($hasValidCourse)
            <a href="{{ route('bookings.create', $firstCourse->slug) }}" class="inline-block bg-brand-dark text-white px-8 py-3 rounded-none hover:bg-gray-800 font-semibold transition shadow-lg border-2 border-white cursor-pointer">
            @else
            <a href="{{ route('courses') }}" class="inline-block bg-brand-dark text-white px-8 py-3 rounded-none hover:bg-gray-800 font-semibold transition shadow-lg border-2 border-white cursor-pointer">
            @endif
                Book a Class
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Company Introduction -->
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-brand-primary mb-4">Welcome to Texas Training Group</h2>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg text-gray-700 mb-4">
                We are dedicated to providing high-quality training and professional development services.
                Our expert instructors bring years of real-world experience to help you achieve your career goals.
            </p>
            <p class="text-lg text-gray-700">
                Whether you're looking to advance your skills, earn certifications, or explore new opportunities,
                we have the right program for you. Join hundreds of professionals who have transformed their careers with our training.
            </p>
        </div>
    </div>

    <!-- Features/Highlights -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-none shadow-md p-8 text-center border border-gray-200">
            <div class="bg-gray-100 w-16 h-16 rounded-none flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-brand-primary mb-2">Expert Instructors</h3>
            <p class="text-gray-700">Learn from industry professionals with years of hands-on experience</p>
        </div>

        <div class="bg-white rounded-none shadow-md p-8 text-center border border-gray-200">
            <div class="bg-gray-100 w-16 h-16 rounded-none flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-brand-primary mb-2">Certified Programs</h3>
            <p class="text-gray-700">Earn recognized certifications that boost your career prospects</p>
        </div>

        <div class="bg-white rounded-none shadow-md p-8 text-center border border-gray-200">
            <div class="bg-gray-100 w-16 h-16 rounded-none flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-brand-primary mb-2">Flexible Scheduling</h3>
            <p class="text-gray-700">Choose from various dates and times that fit your schedule</p>
        </div>
    </div>

    <!-- Upcoming Courses Section -->
    @if($upcomingCourses->count() > 0)
    <div class="mb-16">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-brand-primary mb-4">Upcoming Training Courses</h2>
            <p class="text-lg text-gray-700">Browse our schedule and find the perfect course for you</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($upcomingCourses as $course)
            <div class="bg-white rounded-none shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                @if($course->thumbnail_image)
                <div class="w-full h-64 overflow-hidden relative group bg-gray-100 flex items-center justify-center">
                    <img src="{{ asset($course->thumbnail_image) }}" alt="{{ $course->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">{{ $course->title }}</h3>
                    @if($course->description)
                    <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 120) }}</p>
                    @endif
                    <div class="border-t pt-4 mb-4">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $course->date->format('F d, Y') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $course->start_time->format('g:i A') }}
                        </div>
                        <div class="text-2xl font-bold text-brand-primary mt-3">
                            ${{ number_format($course->price, 2) }}
                        </div>
                    </div>
                    <div class="flex gap-3">
                        @if($course->slug)
                        <a href="{{ route('courses.show', $course->slug) }}" class="flex-1 min-w-0 text-center whitespace-nowrap bg-gray-100 text-brand-primary px-4 py-3 rounded-none border border-gray-200 hover:bg-gray-200 hover:border-gray-300 transition font-medium text-sm">
                            View Details
                        </a>
                        <a href="{{ route('bookings.create', $course->slug) }}" class="flex-1 min-w-0 text-center whitespace-nowrap bg-brand-primary text-white px-4 py-3 rounded-none hover:bg-brand-dark transition font-medium text-sm">
                            Book Now
                        </a>
                        @else
                        <a href="{{ route('courses') }}" class="flex-1 min-w-0 text-center whitespace-nowrap bg-gray-100 text-brand-primary px-4 py-3 rounded-none border border-gray-200 hover:bg-gray-200 hover:border-gray-300 transition font-medium text-sm">
                            View Details
                        </a>
                        <a href="{{ route('courses') }}" class="flex-1 min-w-0 text-center whitespace-nowrap bg-brand-primary text-white px-4 py-3 rounded-none hover:bg-brand-dark transition font-medium text-sm">
                            Book Now
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('courses') }}" class="inline-block bg-brand-primary text-white px-8 py-3 rounded-none hover:bg-brand-dark font-semibold transition cursor-pointer">
                View All Courses
            </a>
        </div>
    </div>
    @else
    <div class="bg-white rounded-none shadow-md p-12 text-center mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Upcoming Training Courses</h2>
        <p class="text-gray-600 mb-6">New courses are being added regularly. Check back soon for upcoming training sessions.</p>
        <a href="{{ route('courses') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-none hover:bg-blue-700 cursor-pointer">
            View All Courses
        </a>
    </div>
    @endif

    <!-- Meet Our Team Section -->
    @if(isset($bios) && $bios->count() > 0)
    <div class="mb-16">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-brand-primary mb-4">Meet Our Team</h2>
            <p class="text-lg text-gray-700">The people behind Texas Training Group</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($bios as $bio)
            <div class="bg-white rounded-none shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                <div class="aspect-[4/3] bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if($bio->photo)
                        <img src="{{ asset('storage/' . $bio->photo) }}" alt="{{ $bio->name }}" class="w-full h-full object-contain">
                    @else
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-brand-primary mb-1">{{ $bio->name }}</h3>
                    @if($bio->tagline)
                        <p class="text-brand-secondary font-semibold text-sm mb-3">{{ $bio->tagline }}</p>
                    @endif
                    @if($bio->bio)
                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit(strip_tags($bio->bio), 120) }}</p>
                    @endif
                    <a href="{{ route('about') }}#team" class="text-brand-primary hover:text-brand-dark text-sm font-medium">Learn more →</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('about') }}" class="inline-block bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark font-semibold transition cursor-pointer">
                About Us
            </a>
        </div>
    </div>
    @endif

    <!-- Call to Action Section -->
    <div class="bg-brand-primary rounded-none shadow-lg p-12 text-center text-white">
        <h2 class="text-3xl font-bold mb-4 text-white">Ready to Get Started?</h2>
        <p class="text-xl text-gray-200 mb-8">Join our training programs today and take the next step in your career</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('courses') }}" class="inline-flex items-center justify-center whitespace-nowrap bg-white text-brand-primary px-6 py-3 rounded-none border border-white/20 hover:bg-gray-100 hover:border-gray-300 transition font-semibold text-sm">
                Browse Courses
            </a>
            <a href="{{ route('consulting') }}" class="inline-flex items-center justify-center whitespace-nowrap bg-brand-dark text-white px-6 py-3 rounded-none border border-white/20 hover:bg-gray-800 transition font-semibold text-sm">
                Contact Us
            </a>
        </div>
    </div>
</div>
@endsection
