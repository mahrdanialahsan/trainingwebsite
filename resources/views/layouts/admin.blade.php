<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    
    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/admin.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
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
        /* Hand cursor on buttons and submit inputs */
        button, input[type="submit"], input[type="button"], [type="submit"], [type="button"], a.cursor-pointer { cursor: pointer; }
    </style>
    @stack('styles')
    <!-- CKEditor Rich Text Editor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.23.0/ckeditor.js" integrity="sha512-7VX0mm9Rn8i6WX3/A4v4X8X3XkA8k3+E4z8F5k5O8+4B5f5f5O8+4B5f5f5O8+4B5f5f5O8+4B5f5f5O8+4B5f5f5O8=" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-gray-100 overflow-hidden">
    <div class="flex h-screen">
        <!-- Left Sidebar -->
        <aside class="w-64 bg-brand-primary text-white flex flex-col flex-shrink-0 h-full overflow-y-auto">
            <!-- Logo/Header -->
            <div class="p-6 border-b border-brand-dark">
                <h1 class="text-xl font-bold text-white">Admin Panel</h1>
            </div>
            
            <!-- Navigation Menu -->
            @php
                $navTraining = request()->routeIs('admin.courses.*', 'admin.bookings.*', 'admin.trainings.*', 'admin.waivers.*');
                $navContent = request()->routeIs('admin.about.*', 'admin.bios.*', 'admin.faqs.*');
                $navConsulting = request()->routeIs('admin.consulting-sections.*', 'admin.consultation-requests.*');
                $navInquiries = request()->routeIs('admin.contact-messages.*');
                $navUsers = request()->routeIs('admin.users.*', 'admin.subscribers.*');
                $navSystem = request()->routeIs('admin.settings.*', 'admin.admins.*');
            @endphp
            <nav class="flex-1 overflow-y-auto py-4">
                <div class="px-3 space-y-0.5">
                    {{-- 1. Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.dashboard') ? 'bg-brand-dark text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>

                    {{-- 2. Training & Courses --}}
                    <details class="group" {{ $navTraining ? 'open' : '' }}>
                        <summary class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none cursor-pointer list-none">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <span class="flex-1">Training & Courses</span>
                            <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="pl-4 ml-5 border-l border-brand-dark space-y-0.5">
                            <a href="{{ route('admin.courses.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.courses.*') ? 'bg-brand-dark text-white' : '' }}">Courses</a>
                            <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.bookings.*') ? 'bg-brand-dark text-white' : '' }}">Bookings</a>
                            <a href="{{ route('admin.trainings.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.trainings.*') ? 'bg-brand-dark text-white' : '' }}">Trainings</a>
                            <a href="{{ route('admin.waivers.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.waivers.*') ? 'bg-brand-dark text-white' : '' }}">Waivers</a>
                        </div>
                    </details>

                    {{-- 3. Website Content --}}
                    <details class="group" {{ $navContent ? 'open' : '' }}>
                        <summary class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none cursor-pointer list-none">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            <span class="flex-1">Website Content</span>
                            <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="pl-4 ml-5 border-l border-brand-dark space-y-0.5">
                            <a href="{{ route('admin.about.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.about.*') ? 'bg-brand-dark text-white' : '' }}">About</a>
                            <a href="{{ route('admin.bios.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.bios.*') ? 'bg-brand-dark text-white' : '' }}">Bios</a>
                            <a href="{{ route('admin.faqs.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.faqs.*') ? 'bg-brand-dark text-white' : '' }}">FAQs</a>
                        </div>
                    </details>

                    {{-- 4. Consulting --}}
                    <details class="group" {{ $navConsulting ? 'open' : '' }}>
                        <summary class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none cursor-pointer list-none">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span class="flex-1">Consulting</span>
                            <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="pl-4 ml-5 border-l border-brand-dark space-y-0.5">
                            <a href="{{ route('admin.consulting-sections.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.consulting-sections.*') ? 'bg-brand-dark text-white' : '' }}">Consulting Sections</a>
                            <a href="{{ route('admin.consultation-requests.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.consultation-requests.*') ? 'bg-brand-dark text-white' : '' }}">Consultation Requests</a>
                        </div>
                    </details>

                    {{-- 5. Inquiries --}}
                    <details class="group" {{ $navInquiries ? 'open' : '' }}>
                        <summary class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none cursor-pointer list-none">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="flex-1">Inquiries</span>
                            <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="pl-4 ml-5 border-l border-brand-dark space-y-0.5">
                            <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.contact-messages.*') ? 'bg-brand-dark text-white' : '' }}">Contact Messages</a>
                        </div>
                    </details>

                    {{-- 6. Users & Lists --}}
                    <details class="group" {{ $navUsers ? 'open' : '' }}>
                        <summary class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none cursor-pointer list-none">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="flex-1">Users & Lists</span>
                            <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="pl-4 ml-5 border-l border-brand-dark space-y-0.5">
                            <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.users.*') ? 'bg-brand-dark text-white' : '' }}">Users</a>
                            <a href="{{ route('admin.subscribers.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.subscribers.*') ? 'bg-brand-dark text-white' : '' }}">Subscribers</a>
                        </div>
                    </details>

                    {{-- 7. System --}}
                    <details class="group" {{ $navSystem ? 'open' : '' }}>
                        <summary class="flex items-center px-4 py-3 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none cursor-pointer list-none">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="flex-1">System</span>
                            <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="pl-4 ml-5 border-l border-brand-dark space-y-0.5">
                            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.settings.*') ? 'bg-brand-dark text-white' : '' }}">Settings</a>
                            @if(Auth::guard('admin')->user()->isSuperAdmin())
                            <a href="{{ route('admin.admins.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-300 hover:bg-brand-dark hover:text-white transition rounded-none {{ request()->routeIs('admin.admins.*') ? 'bg-brand-dark text-white' : '' }}">Admins</a>
                            @endif
                        </div>
                    </details>
                </div>
            </nav>
            
            <!-- User Actions Footer -->
            <div class="p-4 border-t border-brand-dark">
                <div class="space-y-2">
                    <a href="{{ route('admin.change-password') }}" class="flex items-center px-4 py-2 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        Change Password
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-200 hover:bg-brand-dark hover:text-white transition rounded-none text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">
            <!-- Top Header Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 h-16 flex items-center justify-end px-6">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ Auth::guard('admin')->user()->name }}</span>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
                {{-- Flash Messages --}}
                <div id="flash-messages" class="px-4 sm:px-6 lg:px-8 pt-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-none mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-none mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    @stack('js')
</body>
</html>
