@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-8">My Dashboard</h1>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-8">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('dashboard', ['tab' => 'bookings']) }}" 
               class="py-4 px-1 border-b-2 font-medium text-sm {{ $tab === 'bookings' ? 'border-brand-primary text-brand-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                My Bookings
            </a>
            <a href="{{ route('dashboard', ['tab' => 'orders']) }}" 
               class="py-4 px-1 border-b-2 font-medium text-sm {{ $tab === 'orders' ? 'border-brand-primary text-brand-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Orders
            </a>
            <a href="{{ route('dashboard', ['tab' => 'account']) }}" 
               class="py-4 px-1 border-b-2 font-medium text-sm {{ $tab === 'account' ? 'border-brand-primary text-brand-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                My Account
            </a>
        </nav>
    </div>

    <!-- Bookings Tab -->
    @if($tab === 'bookings')
    <div>
        <h2 class="text-2xl font-bold text-brand-primary mb-6">My Bookings</h2>
        @if($bookings->count() > 0)
            <div class="space-y-6">
                @foreach($bookings as $booking)
                <div class="bg-white rounded-none shadow-md p-6 border border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-brand-primary">{{ $booking->course->title }}</h3>
                            <p class="text-gray-600 mt-1">{{ $booking->course->date->format('F d, Y') }} at {{ $booking->course->start_time->format('g:i A') }}</p>
                        </div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-none 
                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600"><strong>Attendee:</strong> {{ $booking->full_name }}</p>
                            <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $booking->email }}</p>
                            @if($booking->phone)
                            <p class="text-sm text-gray-600"><strong>Phone:</strong> {{ $booking->phone }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-600"><strong>Price:</strong> ${{ number_format($booking->course->price, 2) }}</p>
                            <p class="text-sm text-gray-600">
                                <strong>Payment:</strong> 
                                <span class="{{ $booking->payment_completed ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $booking->payment_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Waiver:</strong> 
                                <span class="{{ $booking->waiver_accepted ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $booking->waiver_accepted ? 'Accepted' : 'Not Accepted' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    @if($booking->payment)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600"><strong>Transaction ID:</strong> {{ $booking->payment->transaction_id }}</p>
                        <p class="text-sm text-gray-600"><strong>Payment Method:</strong> {{ ucfirst($booking->payment->payment_method) }}</p>
                        <p class="text-sm text-gray-600"><strong>Paid At:</strong> {{ $booking->payment->paid_at->format('F d, Y g:i A') }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-none shadow-md p-8 text-center">
                <p class="text-gray-600">You don't have any bookings yet.</p>
                <a href="{{ route('courses') }}" class="inline-block mt-4 bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Browse Courses
                </a>
            </div>
        @endif
    </div>
    @endif

    <!-- Orders Tab -->
    @if($tab === 'orders')
    <div>
        <h2 class="text-2xl font-bold text-brand-primary mb-6">My Orders</h2>
        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white rounded-none shadow-md p-6 border border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-brand-primary">{{ $order->booking->course->title }}</h3>
                            <p class="text-gray-600 mt-1">Order #{{ $order->transaction_id }}</p>
                        </div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-none 
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $order->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $order->status === 'refunded' ? 'bg-blue-100 text-blue-800' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600"><strong>Amount:</strong> ${{ number_format($order->amount, 2) }}</p>
                            <p class="text-sm text-gray-600"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600"><strong>Date:</strong> {{ $order->paid_at->format('F d, Y g:i A') }}</p>
                            <p class="text-sm text-gray-600"><strong>Course Date:</strong> {{ $order->booking->course->date->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-none shadow-md p-8 text-center">
                <p class="text-gray-600">You don't have any orders yet.</p>
            </div>
        @endif
    </div>
    @endif

    <!-- Account Tab -->
    @if($tab === 'account')
    <div>
        <h2 class="text-2xl font-bold text-brand-primary mb-6">My Account</h2>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-none mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-none mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Personal Information Table -->
        <div class="bg-white rounded-none shadow-md p-8 mb-6">
            <h3 class="text-xl font-semibold text-brand-primary mb-6">Personal Information</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 w-1/3">Full Name</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" id="display-name">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Email</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" id="display-email">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Phone Number</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" id="display-phone">{{ $user->phone ?? 'Not provided' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 flex space-x-4">
                <button type="button" onclick="openProfileEdit()" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark font-semibold">
                    Edit Profile
                </button>
                <button type="button" onclick="openPasswordChange()" class="bg-gray-600 text-white px-6 py-2 rounded-none hover:bg-gray-700 font-semibold">
                    Change Password
                </button>
            </div>
        </div>

        <!-- Profile Edit Modal -->
        <div id="profile-edit-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-none bg-white">
                <div class="mt-3">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-brand-primary">Edit Profile</h3>
                        <button onclick="closeProfileEdit()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form method="POST" action="{{ route('dashboard.account.update') }}" id="profile-edit-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="update_type" value="profile">

                        <div class="mb-4">
                            <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" id="edit_name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="edit_email" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                                   value="{{ old('email', $user->email) }}">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="edit_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" id="edit_phone"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeProfileEdit()" class="px-4 py-2 border border-gray-300 rounded-none text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark font-semibold">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Change Modal -->
        <div id="password-change-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-none bg-white">
                <div class="mt-3">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-brand-primary">Change Password</h3>
                        <button onclick="closePasswordChange()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form method="POST" action="{{ route('dashboard.account.update') }}" id="password-change-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="update_type" value="password">

                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password" id="new_password" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closePasswordChange()" class="px-4 py-2 border border-gray-300 rounded-none text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded-none hover:bg-gray-700 font-semibold">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

<script>
function openProfileEdit() {
    document.getElementById('profile-edit-modal').classList.remove('hidden');
}

function closeProfileEdit() {
    document.getElementById('profile-edit-modal').classList.add('hidden');
}

function openPasswordChange() {
    document.getElementById('password-change-modal').classList.remove('hidden');
}

function closePasswordChange() {
    document.getElementById('password-change-modal').classList.add('hidden');
}

// Close modals when clicking outside
window.onclick = function(event) {
    const profileModal = document.getElementById('profile-edit-modal');
    const passwordModal = document.getElementById('password-change-modal');
    
    if (event.target == profileModal) {
        closeProfileEdit();
    }
    if (event.target == passwordModal) {
        closePasswordChange();
    }
}
</script>
</div>
@endsection
