@extends('layouts.admin')

@section('title', 'Subscribers')

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Newsletter Subscribers</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-none mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-none shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subscribed At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($subscribers as $subscriber)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $subscriber->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $subscriber->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('M d, Y g:i A') : $subscriber->created_at->format('M d, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <form method="POST" action="{{ route('admin.subscribers.toggle-active', $subscriber) }}" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="{{ $subscriber->is_active ? 'text-orange-600 hover:text-orange-900' : 'text-green-600 hover:text-green-900' }}">
                                {{ $subscriber->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this subscriber?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No subscribers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $subscribers->links() }}
    </div>
</div>
@endsection
