@extends('layouts.admin')

@section('title', 'Bios')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Manage Bios</h1>

    <div class="mb-6">
        <a href="{{ route('admin.bios.create') }}" class="inline-block bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark transition">
            Add New Bio
        </a>
    </div>

    <div class="bg-white rounded-none shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($bios as $bio)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 capitalize">{{ $bio->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $bio->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $bio->email ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $bio->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $bio->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4">
                        <a href="{{ route('admin.bios.edit', $bio) }}" class="text-brand-primary hover:text-brand-dark">Edit</a>
                        <form method="POST" action="{{ route('admin.bios.destroy', $bio) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this bio?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No bios found. <a href="{{ route('admin.bios.create') }}" class="text-brand-primary hover:text-brand-dark">Add your first bio</a>.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
