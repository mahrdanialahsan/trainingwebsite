@extends('layouts.admin')

@section('title', 'View User')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">User Details</h1>

    <div class="bg-white rounded-none shadow p-8">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Name</h2>
            <p class="text-gray-700">{{ $user->name }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Email</h2>
            <p class="text-gray-700">{{ $user->email }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Email Verified</h2>
            @if($user->hasVerifiedEmail())
                <span class="px-2 py-1 text-sm font-semibold rounded-none bg-green-100 text-green-800">
                    Verified ({{ $user->email_verified_at->format('M d, Y H:i') }})
                </span>
            @else
                <span class="px-2 py-1 text-sm font-semibold rounded-none bg-yellow-100 text-yellow-800">
                    Unverified
                </span>
            @endif
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Status</h2>
            <span class="px-2 py-1 text-sm font-semibold rounded-none {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Bookings</h2>
            <p class="text-gray-700">{{ $user->bookings->count() }} total bookings</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Created At</h2>
            <p class="text-gray-700">{{ $user->created_at->format('M d, Y H:i') }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Last Updated</h2>
            <p class="text-gray-700">{{ $user->updated_at->format('M d, Y H:i') }}</p>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
