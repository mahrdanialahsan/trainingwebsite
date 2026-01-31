@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="mb-6 text-sm text-gray-500">
        <a href="{{ route('shop') }}" class="hover:text-brand-primary transition">Shop</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->title }}</span>
    </nav>

    @if(session('success'))
        <p class="mb-4 text-green-600 font-medium">{{ session('success') }} <a href="{{ route('cart.index') }}" class="text-brand-primary hover:text-brand-dark underline">View cart</a> or <a href="{{ route('checkout.show') }}" class="text-brand-primary hover:text-brand-dark underline">checkout</a>.</p>
    @endif
    @if(session('error'))
        <p class="mb-4 text-red-600">{{ session('error') }}</p>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        {{-- Product image --}}
        <div class="bg-white rounded-none shadow-md overflow-hidden">
            @if($product->image_path)
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" class="w-full h-auto object-contain max-h-[500px] mx-auto bg-gray-50">
            @else
            <div class="w-full h-96 bg-gray-100 flex items-center justify-center text-gray-400">
                <span>No image</span>
            </div>
            @endif
        </div>

        {{-- Product details --}}
        <div>
            @if($product->category)
            <p class="text-sm text-gray-500 mb-2">{{ $product->category->name }}</p>
            @endif
            <h1 class="text-3xl font-bold text-brand-primary mb-4">{{ $product->title }}</h1>
            <p class="text-3xl font-bold text-brand-primary mb-6">${{ number_format($product->price, 2) }}</p>

            @if($product->description)
            <div class="prose prose-gray max-w-none mb-6">
                {!! $product->description !!}
            </div>
            @endif

            @if($product->sku)
            <p class="text-sm text-gray-500 mb-4">SKU: {{ $product->sku }}</p>
            @endif

            @if($product->inStock())
            <p class="text-green-600 font-medium mb-4">In stock</p>
            <div class="border border-gray-200 rounded-none p-6 bg-gray-50 mb-6">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-wrap items-end gap-4" data-turbo="false">
                    @csrf
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="99" class="w-24 px-4 py-3 border border-gray-300 rounded-none text-center focus:ring-2 focus:ring-brand-primary focus:border-transparent">
                    </div>
                    <button type="submit" class="bg-brand-primary text-white px-8 py-3 rounded-none hover:bg-brand-dark font-semibold transition cursor-pointer inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Add to cart
                    </button>
                </form>
                <p class="text-sm text-gray-500 mt-3"><a href="{{ route('cart.index') }}" class="text-brand-primary hover:text-brand-dark font-medium">View cart</a> · Secure checkout with card.</p>
            </div>
            <p class="text-sm text-gray-500">Have a question? <a href="{{ route('contact') }}?inquiry=product-{{ $product->slug }}" class="text-brand-primary hover:text-brand-dark">Contact us</a>.</p>
            @else
            <p class="text-amber-600 font-medium mb-4">Currently out of stock</p>
            <a href="{{ route('contact') }}?inquiry=product-{{ $product->slug }}" class="inline-block bg-gray-300 text-gray-700 px-8 py-3 rounded-none font-semibold cursor-not-allowed" aria-disabled="true">
                Out of stock
            </a>
            <p class="text-sm text-gray-500 mt-2">Contact us to be notified when this item is back in stock.</p>
            @endif
        </div>
    </div>
</div>
@endsection
