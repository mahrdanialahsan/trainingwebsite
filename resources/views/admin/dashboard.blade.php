@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-none shadow p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Total Courses</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_courses'] }}</p>
        </div>

        <div class="bg-white rounded-none shadow p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Upcoming Courses</h3>
            <p class="text-3xl font-bold text-brand-primary">{{ $stats['upcoming_courses'] }}</p>
        </div>

        <div class="bg-white rounded-none shadow p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Total Bookings</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_bookings'] }}</p>
        </div>

        <div class="bg-white rounded-none shadow p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Total Revenue</h3>
            <p class="text-3xl font-bold text-green-600">${{ number_format($stats['total_revenue'], 2) }}</p>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-none shadow mb-8">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Recent Bookings</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attendee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $booking->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->course->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-none
                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No bookings yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Upcoming Courses -->
    <div class="bg-white rounded-none shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Upcoming Courses</h2>
        </div>
        <div class="p-6">
            @forelse($upcomingCourses as $course)
            <div class="mb-4 pb-4 border-b border-gray-200 last:border-0">
                <h3 class="font-semibold text-gray-900">{{ $course->title }}</h3>
                <p class="text-sm text-gray-500">{{ $course->date->format('F d, Y') }} at {{ $course->start_time->format('g:i A') }}</p>
                <p class="text-sm text-gray-500">${{ number_format($course->price, 2) }}</p>
            </div>
            @empty
            <p class="text-gray-500">No upcoming courses</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
