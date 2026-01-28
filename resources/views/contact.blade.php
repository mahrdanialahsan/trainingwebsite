@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
@php
    $systemEmail = \App\Models\Setting::get('system_email', 'info@training.com');
    $phoneNumber = \App\Models\Setting::get('phone_number', '(555) 123-4567');
@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-brand-primary mb-4">Contact Us</h1>
        <p class="text-lg text-gray-700">Get in touch with us. We'd love to hear from you.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-bold text-brand-primary mb-6">Get In Touch</h2>
            <div class="space-y-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-brand-primary mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $phoneNumber) }}" class="text-brand-primary hover:underline">{{ $phoneNumber }}</a>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-brand-primary mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <a href="mailto:{{ $systemEmail }}" class="text-brand-primary hover:underline">{{ $systemEmail }}</a>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-brand-primary mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                        <p class="text-gray-700">123 Training Street, Education City, EC 12345</p>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <a href="#" class="inline-block bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark transition">
                    Get Directions
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-bold text-brand-primary mb-6">Send Us a Message</h2>
            <form class="space-y-6" method="POST" action="#">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                           class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                    <input type="text" id="subject" name="subject" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"></textarea>
                </div>
                <div>
                    <button type="submit" class="w-full bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark font-semibold transition">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="bg-gray-200 rounded-none min-h-[400px] flex items-center justify-center mb-12">
        <div class="text-center text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p class="text-sm">Map will be embedded here</p>
        </div>
    </div>
</div>
@endsection
