@extends('layouts.admin')

@section('title', $course->title)

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.courses.edit', $course) }}" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.courses.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
                Back
            </a>
        </div>
    </div>

    <div class="bg-white rounded-none shadow p-8 mb-8">
        <h2 class="text-2xl font-semibold mb-4">Course Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500 mb-1">Title</p>
                <p class="font-medium">{{ $course->title }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Date</p>
                <p class="font-medium">{{ $course->date->format('F d, Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Start Time</p>
                <p class="font-medium">{{ $course->start_time->format('g:i A') }}</p>
            </div>
            @if($course->end_time)
            <div>
                <p class="text-sm text-gray-500 mb-1">End Time</p>
                <p class="font-medium">{{ $course->end_time->format('g:i A') }}</p>
            </div>
            @endif
            <div>
                <p class="text-sm text-gray-500 mb-1">Price</p>
                <p class="font-medium">${{ number_format($course->price, 2) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Status</p>
                <span class="px-2 py-1 text-xs font-semibold rounded-none
                    @if($course->status === 'upcoming') bg-blue-100 text-blue-800
                    @elseif($course->status === 'active') bg-green-100 text-green-800
                    @elseif($course->status === 'completed') bg-gray-100 text-gray-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($course->status) }}
                </span>
            </div>
            @if($course->max_participants)
            <div>
                <p class="text-sm text-gray-500 mb-1">Max Participants</p>
                <p class="font-medium">{{ $course->max_participants }}</p>
            </div>
            @endif
            <div>
                <p class="text-sm text-gray-500 mb-1">Active</p>
                <p class="font-medium">{{ $course->is_active ? 'Yes' : 'No' }}</p>
            </div>
        </div>

        @if($course->description)
        <div class="mt-6">
            <p class="text-sm text-gray-500 mb-1">Description</p>
            <p class="text-gray-700">{{ $course->description }}</p>
        </div>
        @endif
    </div>

    <div class="bg-white rounded-none shadow p-8">
        <h2 class="text-2xl font-semibold mb-4">Bookings ({{ $course->bookings->count() }})</h2>
        @if($course->bookings->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attendee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($course->bookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $booking->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->email }}</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->payment_completed ? 'Paid' : 'Pending' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500">No bookings for this course yet.</p>
        @endif
    </div>
</div>
@endsection
