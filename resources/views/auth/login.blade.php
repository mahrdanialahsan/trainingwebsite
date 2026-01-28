@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo.png') }}" alt="Texas Training Group" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-brand-primary">Login</h1>
            <p class="text-gray-600 mt-2">Sign in to your account</p>
        </div>

        <div class="bg-white rounded-none shadow-md p-8">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-none mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
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

                <div class="mb-6 text-right">
                    <a href="{{ route('forgot-password') }}" class="text-sm text-brand-primary hover:text-brand-dark">
                        Forgot your password?
                    </a>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded-none border-gray-300 text-brand-primary focus:ring-brand-primary">
                        <span class="ml-2 text-sm text-gray-700">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark font-semibold">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-brand-primary hover:text-brand-dark font-medium">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
