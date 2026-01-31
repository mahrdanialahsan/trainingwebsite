@extends('layouts.admin')

@section('title', $product->title)

@section('content')
<div class="max-w-4xl">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="inline-block bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark transition">Edit</a>
            <a href="{{ route('admin.products.index') }}" class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded-none hover:bg-gray-300">Back to list</a>
        </div>
    </div>

    <div class="bg-white rounded-none shadow overflow-hidden">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" class="w-full max-w-sm object-contain bg-gray-50 border border-gray-200">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 rounded-none">No image</div>
                    @endif
                </div>
                <div class="md:col-span-2 space-y-4">
                    <p><span class="font-medium text-gray-700">Slug:</span> {{ $product->slug }}</p>
                    <p><span class="font-medium text-gray-700">Price:</span> ${{ number_format($product->price, 2) }}</p>
                    @if($product->category)
                        <p><span class="font-medium text-gray-700">Category:</span> {{ $product->category->name }}</p>
                    @endif
                    @if($product->sku)
                        <p><span class="font-medium text-gray-700">SKU:</span> {{ $product->sku }}</p>
                    @endif
                    <p><span class="font-medium text-gray-700">Stock:</span> {{ $product->stock_quantity === null ? 'Always available' : $product->stock_quantity }}</p>
                    <p><span class="font-medium text-gray-700">Display order:</span> {{ $product->order }}</p>
                    <p>
                        <span class="font-medium text-gray-700">Status:</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                    <p class="pt-2">
                        <a href="{{ route('shop.show', $product) }}" target="_blank" rel="noopener" class="text-brand-primary hover:text-brand-dark">View on shop →</a>
                    </p>
                </div>
            </div>
            @if($product->description)
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                    <div class="prose prose-gray max-w-none">
                        {!! $product->description !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
