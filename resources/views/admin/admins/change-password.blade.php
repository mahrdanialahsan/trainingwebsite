@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Change Password</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.update-password') }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password *</label>
                <input type="password" name="current_password" id="current_password" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password *</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Minimum 8 characters</p>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password *</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Change Password
                </button>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
