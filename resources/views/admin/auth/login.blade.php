<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - {{ config('app.name') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        .focus\:ring-brand-primary:focus { --tw-ring-color: var(--brand-primary); }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-none shadow-md p-8">
            <div class="text-center mb-6">
                <img src="{{ asset('Logo.png') }}" alt="Texas Training Group" class="h-16 mx-auto mb-4">
            </div>
            <h1 class="text-3xl font-bold text-brand-primary mb-6 text-center">Admin Login</h1>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-none mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('email') }}">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-sm text-gray-700">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                    Login
                </button>
            </form>

            <div class="mt-4 text-center text-sm text-gray-600">
                <p>Default credentials: admin@training.com / password</p>
            </div>
        </div>
    </div>
</body>
</html>
