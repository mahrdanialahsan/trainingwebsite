<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Training Company'))</title>
    
    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    {{-- Turbo meta tags for CSRF --}}
    <meta name="turbo-cache-control" content="no-cache">
    <style>
        :root {
            --brand-primary: #2e3a47;
            --brand-secondary: #666666;
            --brand-dark: #1a1f26;
        }
        .bg-brand-primary { background-color: var(--brand-primary); }
        .bg-brand-dark { background-color: var(--brand-dark); }
        .text-brand-primary { color: var(--brand-primary); }
        .text-brand-secondary { color: var(--brand-secondary); }
        .border-brand-primary { border-color: var(--brand-primary); }
        .hover\:bg-brand-dark:hover { background-color: var(--brand-dark); }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('Logo.png') }}" alt="Texas Training Group" class="h-12 md:h-16 w-auto">
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">Home</a>
                    <a href="{{ route('about') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">About</a>
                    <div class="relative group" data-controller="dropdown" data-dropdown-open-value="false">
                        <a href="{{ route('trainings.index') }}" class="text-brand-primary font-medium hover:text-brand-dark transition flex items-center" data-action="click->dropdown#toggle">
                            Training
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div data-dropdown-target="menu" class="absolute left-0 mt-2 w-64 bg-white shadow-lg border border-gray-200 hidden opacity-0 invisible transition-all duration-200 z-50">
                            <div class="py-2">
                                @php
                                    $trainings = \App\Models\Training::where('is_active', true)->orderBy('order')->get();
                                @endphp
                                @if($trainings->count() > 0)
                                    <div class="px-4 py-2 text-sm font-semibold text-brand-primary border-b border-gray-200">Training Programs</div>
                                    @foreach($trainings as $training)
                                        <a href="{{ route('trainings.show', $training->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" data-turbo-action="advance">
                                            {{ $training->title }}
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-4 py-2 text-sm text-gray-500">No trainings available</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('courses') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">Courses</a>
                    <a href="{{ route('consulting') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">Consulting</a>
                    <a href="{{ route('faqs.index') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">FAQs</a>
                    <a href="{{ route('contact') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">Contact</a>
                    
                    @auth
                    <div class="relative group" data-controller="dropdown" data-dropdown-open-value="false">
                        <a href="{{ route('dashboard') }}" class="text-brand-primary font-medium hover:text-brand-dark transition flex items-center" data-action="click->dropdown#toggle">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div data-dropdown-target="menu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg border border-gray-200 hidden opacity-0 invisible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" data-turbo-action="advance">Dashboard</a>
                                <a href="{{ route('dashboard', ['tab' => 'bookings']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" data-turbo-action="advance">My Bookings</a>
                                <a href="{{ route('dashboard', ['tab' => 'orders']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" data-turbo-action="advance">Orders</a>
                                <a href="{{ route('dashboard', ['tab' => 'account']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" data-turbo-action="advance">My Account</a>
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200 mt-2 pt-2" data-turbo="false">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-brand-primary font-medium hover:text-brand-dark transition" data-turbo-action="advance">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark transition" data-turbo-action="advance">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Global Turbo Loader --}}
    <div id="turbo-loader" class="fixed top-0 left-0 right-0 bg-brand-primary text-white py-2 text-center z-50 hidden">
        <span class="inline-block animate-spin mr-2">⏳</span> Loading...
    </div>

    <main class="w-full">
        @yield('content')
    </main>

    <footer class="bg-brand-primary text-white mt-12">
        @php
            $tagline = \App\Models\Setting::get('tagline', 'Professional training and consulting services.');
            $systemEmail = \App\Models\Setting::get('system_email', 'info@training.com');
            $phoneNumber = \App\Models\Setting::get('phone_number', '(555) 123-4567');
            $socialFacebook = \App\Models\Setting::get('social_facebook', '');
            $socialInstagram = \App\Models\Setting::get('social_instagram', '');
            $socialYoutube = \App\Models\Setting::get('social_youtube', '');
            $socialTwitter = \App\Models\Setting::get('social_twitter', '');
            $socialLinkedin = \App\Models\Setting::get('social_linkedin', '');
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img src="{{ asset('Logo-transparent.png') }}" alt="Texas Training Group" class="h-16 mb-4">
                    <p class="text-gray-300">{{ $tagline }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Quick Links</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('courses') }}" class="hover:text-white transition">Courses</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About</a></li>
                        <li><a href="{{ route('consulting') }}" class="hover:text-white transition">Consulting</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Contact</h3>
                    <p class="text-gray-300 mb-2">Email: <a href="mailto:{{ $systemEmail }}" class="hover:text-white transition">{{ $systemEmail }}</a></p>
                    <p class="text-gray-300">Phone: <a href="tel:{{ preg_replace('/[^0-9]/', '', $phoneNumber) }}" class="hover:text-white transition">{{ $phoneNumber }}</a></p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Subscribe & Follow</h3>
                    <form class="mb-4" method="POST" action="#" id="subscribe-form">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="email" name="email" placeholder="Enter your email" required
                                   class="flex-1 px-3 py-2 bg-white text-gray-900 rounded-none focus:outline-none focus:ring-2 focus:ring-white text-sm">
                            <button type="submit" class="bg-brand-dark text-white px-4 py-2 rounded-none hover:bg-gray-800 font-semibold transition text-sm whitespace-nowrap">
                                Subscribe
                            </button>
                        </div>
                    </form>
                    <div class="flex space-x-3">
                        @if($socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif
                        @if($socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        @endif
                        @if($socialYoutube)
                        <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition" aria-label="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                        @endif
                        @if($socialTwitter)
                        <a href="{{ $socialTwitter }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition" aria-label="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        @endif
                        @if($socialLinkedin)
                        <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition" aria-label="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-600 mt-8 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Texas Training Group. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
