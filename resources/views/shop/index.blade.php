@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-4">Shop</h1>
    <p class="text-lg text-gray-600 mb-6">Browse our products. Shirts, merchandise, and more.</p>

    {{-- Filter UI: search + categories in one card --}}
    <div class="bg-white rounded-none shadow-md border border-gray-200 p-6 mb-8">
        <form action="{{ route('shop') }}" method="GET">
            @if(!empty($categorySlug))
                <input type="hidden" name="category" value="{{ e($categorySlug) }}">
            @endif
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <label for="shop-search" class="sr-only">Search products</label>
                <input type="search" id="shop-search" name="q" value="{{ old('q', $search ?? '') }}" placeholder="Search by name, category, or SKU…"
                       class="flex-1 w-full min-w-0 px-4 py-3 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent placeholder-gray-500">
                <div class="flex flex-shrink-0 gap-2">
                    <button type="submit" class="px-5 py-3 bg-brand-primary text-white rounded-none hover:bg-brand-dark transition cursor-pointer font-medium whitespace-nowrap">
                        Search
                    </button>
                    @if(!empty($search) || !empty($categorySlug))
                        <a href="{{ route('shop') }}" class="px-5 py-3 border border-gray-300 text-gray-700 rounded-none hover:bg-gray-50 transition cursor-pointer font-medium whitespace-nowrap">
                            Clear all
                        </a>
                    @endif
                </div>
            </div>
        </form>

        @if($categories->isNotEmpty())
            <div class="mt-5 pt-5 border-t border-gray-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-3">Categories</p>
                <div class="flex flex-wrap gap-2">
                    @php
                        $allUrl = route('shop') . (!empty($search) ? '?q=' . urlencode($search) : '');
                    @endphp
                    <a href="{{ $allUrl }}"
                       class="px-4 py-2 rounded-none text-sm font-medium transition cursor-pointer {{ empty($categorySlug) ? 'bg-brand-primary text-white ring-2 ring-brand-primary ring-offset-2' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All
                    </a>
                    @foreach($categories as $cat)
                        @php
                            $params = request()->only('q');
                            $params['category'] = $cat->slug;
                            $catUrl = route('shop') . '?' . http_build_query($params);
                        @endphp
                        <a href="{{ $catUrl }}"
                           class="px-4 py-2 rounded-none text-sm font-medium transition cursor-pointer {{ ($categorySlug ?? '') === $cat->slug ? 'bg-brand-primary text-white ring-2 ring-brand-primary ring-offset-2' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($search) || !empty($categorySlug))
            <p class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-600">
                @if(!empty($search))
                    Results for <strong>{{ e($search) }}</strong>
                @endif
                @if(!empty($categorySlug))
                    @if(!empty($search)) · @endif
                    Category: <strong>{{ e($categories->firstWhere('slug', $categorySlug)?->name ?? $categorySlug) }}</strong>
                @endif
                — {{ $products->total() }} {{ Str::plural('product', $products->total()) }}
            </p>
        @endif
    </div>

    @if(session('success'))
        <p class="mb-4 text-green-600 font-medium">{{ session('success') }} <a href="{{ route('cart.index') }}" class="text-brand-primary hover:text-brand-dark underline">View cart</a></p>
    @endif

    @if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-none shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            @if($product->image_path)
            <a href="{{ route('shop.show', $product->slug) }}" class="block w-full h-64 overflow-hidden relative group bg-gray-100 flex items-center justify-center">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
            </a>
            @else
            <a href="{{ route('shop.show', $product->slug) }}" class="block w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400">
                <span class="text-sm">No image</span>
            </a>
            @endif
            <div class="p-6">
                @if($product->category)
                <p class="text-sm text-gray-500 mb-1">{{ $product->category->name }}</p>
                @endif
                <h2 class="text-xl font-semibold mb-2">
                    <a href="{{ route('shop.show', $product->slug) }}" class="text-brand-primary hover:text-brand-dark transition">{{ $product->title }}</a>
                </h2>
                <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($product->description), 80) }}</p>
                <p class="text-lg font-bold text-brand-primary mb-4">${{ number_format($product->price, 2) }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('shop.show', $product->slug) }}" class="flex-1 text-center border border-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-50 transition cursor-pointer font-medium">
                        View
                    </a>
                    @if($product->inStock())
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1" data-turbo="false">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark transition cursor-pointer font-medium inline-flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Add to cart
                        </button>
                    </form>
                    @else
                    <span class="flex-1 text-center bg-gray-200 text-gray-500 px-4 py-2 rounded-none font-medium cursor-not-allowed">Out of stock</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @else
    <div class="bg-white rounded-none shadow-md p-12 text-center">
        @if(!empty($search) || !empty($categorySlug))
            <p class="text-gray-600 text-lg">
                No products found
                @if(!empty($search)) for "{{ e($search) }}" @endif
                @if(!empty($categorySlug)) in {{ e($categories->firstWhere('slug', $categorySlug)?->name ?? $categorySlug) }} @endif.
                Try different keywords or <a href="{{ route('shop') }}" class="text-brand-primary hover:text-brand-dark font-medium">clear filters</a>.
            </p>
        @else
            <p class="text-gray-600 text-lg">No products available at the moment. Check back soon!</p>
        @endif
    </div>
    @endif
</div>
@endsection
