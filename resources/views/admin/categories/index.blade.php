@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Shop Categories</h1>

    @if(session('success'))
        <p class="mb-4 text-green-600">{{ session('success') }}</p>
    @endif

    <div class="mb-6">
        <a href="{{ route('admin.categories.create') }}" class="inline-block bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark transition">
            Add Category
        </a>
    </div>

    <div class="bg-white rounded-none shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Products</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $cat)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cat->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cat->slug }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cat->order }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cat->products()->count() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="text-brand-primary hover:text-brand-dark">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" class="inline-block" onsubmit="return confirm('Delete this category? Products will become uncategorized.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No categories yet. <a href="{{ route('admin.categories.create') }}" class="text-brand-primary hover:text-brand-dark">Add one</a>.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
