@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Booking #{{ $booking->id }}</h1>
        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
            Back
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-none shadow p-8">
            <h2 class="text-2xl font-semibold mb-4">Booking Information</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Booking ID</p>
                    <p class="font-medium">#{{ $booking->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Course</p>
                    <p class="font-medium">{{ $booking->course->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date</p>
                    <p class="font-medium">{{ $booking->course->date->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Time</p>
                    <p class="font-medium">{{ $booking->course->start_time->format('g:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-2 py-1 text-xs font-semibold rounded-none
                        @if($booking->status === 'confirmed') bg-green-100 text-green-800
                        @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="mt-6">
                @csrf
                @method('PUT')
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                <div class="flex space-x-2">
                    <select name="status" id="status" required
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-none shadow p-8">
            <h2 class="text-2xl font-semibold mb-4">Attendee Information</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-medium">{{ $booking->full_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">{{ $booking->email }}</p>
                </div>
                @if($booking->phone)
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-medium">{{ $booking->phone }}</p>
                </div>
                @endif
                @if($booking->notes)
                <div>
                    <p class="text-sm text-gray-500">Notes</p>
                    <p class="font-medium">{{ $booking->notes }}</p>
                </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Waiver Accepted</p>
                    <p class="font-medium">{{ $booking->waiver_accepted ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Payment Completed</p>
                    <p class="font-medium">{{ $booking->payment_completed ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($booking->payment)
    <div class="bg-white rounded-none shadow p-8 mb-8">
        <h2 class="text-2xl font-semibold mb-4">Payment Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Transaction ID</p>
                <p class="font-medium">{{ $booking->payment->transaction_id }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Amount</p>
                <p class="font-medium">${{ number_format($booking->payment->amount, 2) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Payment Method</p>
                <p class="font-medium">{{ ucfirst($booking->payment->payment_method) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="px-2 py-1 text-xs font-semibold rounded-none
                    @if($booking->payment->status === 'completed') bg-green-100 text-green-800
                    @elseif($booking->payment->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($booking->payment->status === 'failed') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($booking->payment->status) }}
                </span>
            </div>
            @if($booking->payment->paid_at)
            <div>
                <p class="text-sm text-gray-500">Paid At</p>
                <p class="font-medium">{{ $booking->payment->paid_at->format('F d, Y g:i A') }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    @if($booking->waiverAcceptances->count() > 0)
    <div class="bg-white rounded-none shadow p-8">
        <h2 class="text-2xl font-semibold mb-4">Waiver Acceptance</h2>
        @foreach($booking->waiverAcceptances as $acceptance)
        <div class="mb-4 pb-4 border-b border-gray-200 last:border-0">
            <p class="text-sm text-gray-500">Waiver: {{ $acceptance->waiver->title }}</p>
            <p class="text-sm text-gray-500">Signed by: {{ $acceptance->signature_name }}</p>
            <p class="text-sm text-gray-500">Accepted at: {{ $acceptance->accepted_at->format('F d, Y g:i A') }}</p>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
