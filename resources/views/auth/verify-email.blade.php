@extends('layouts.app')

@section('title', 'Verify Your Email')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo.png') }}" alt="Texas Training Group" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-brand-primary">Verify Your Email</h1>
            <p class="text-gray-600 mt-2">Please verify your email address to continue</p>
        </div>

        <div class="bg-white rounded-none shadow-md p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-none mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-none mb-4">
                    {{ session('warning') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-none mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we'll gladly send you another.
                </p>
            </div>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark font-semibold mb-4">
                    Resend Verification Email
                </button>
            </form>

            <div class="mt-6 text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-800">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
