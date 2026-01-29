@extends('layouts.admin')

@section('title', 'Consultation Request #' . $consultation_request->id)

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Consultation Request #{{ $consultation_request->id }}</h1>
        <a href="{{ route('admin.consultation-requests.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
            Back to list
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-none mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-none shadow p-8">
            <h2 class="text-2xl font-semibold mb-4">Contact Information</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-medium">{{ $consultation_request->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium"><a href="mailto:{{ $consultation_request->email }}" class="text-brand-primary hover:underline">{{ $consultation_request->email }}</a></p>
                </div>
                @if($consultation_request->phone)
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-medium"><a href="tel:{{ $consultation_request->phone }}" class="text-brand-primary hover:underline">{{ $consultation_request->phone }}</a></p>
                </div>
                @endif
                @if($consultation_request->company)
                <div>
                    <p class="text-sm text-gray-500">Company / Organization</p>
                    <p class="font-medium">{{ $consultation_request->company }}</p>
                </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Submitted</p>
                    <p class="font-medium">{{ $consultation_request->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-2 py-1 text-xs font-semibold rounded-none
                        @if($consultation_request->status === 'completed') bg-green-100 text-green-800
                        @elseif($consultation_request->status === 'contacted') bg-blue-100 text-blue-800
                        @elseif($consultation_request->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($consultation_request->status) }}
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.consultation-requests.update-status', $consultation_request) }}" class="mt-6">
                @csrf
                @method('PUT')
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                <div class="flex space-x-2">
                    <select name="status" id="status" required
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        <option value="pending" {{ $consultation_request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="contacted" {{ $consultation_request->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="completed" {{ $consultation_request->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $consultation_request->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-none shadow p-8">
            <h2 class="text-2xl font-semibold mb-4">Request Details</h2>
            <div class="space-y-3">
                @if($consultation_request->service_interest)
                <div>
                    <p class="text-sm text-gray-500">Service Interest</p>
                    <p class="font-medium">{{ ucwords(str_replace('-', ' ', $consultation_request->service_interest)) }}</p>
                </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Message</p>
                    <div class="mt-1 p-4 bg-gray-50 rounded-none border border-gray-200 whitespace-pre-line text-gray-700">{{ $consultation_request->message }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
