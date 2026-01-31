@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Product</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" data-turbo="false">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('title', $product->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                <input type="text" name="slug" id="slug"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('slug', $product->slug) }}">
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('description', $product->description) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">You can use basic HTML.</p>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('price', $product->price) }}">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        <option value="">— None —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                    <input type="text" name="sku" id="sku"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('sku', $product->sku) }}">
                    @error('sku')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">Stock quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('stock_quantity', $product->stock_quantity) }}" placeholder="Leave empty for always available">
                    @error('stock_quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                @if($product->image_path)
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 mb-2">Current image:</p>
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" class="w-48 h-48 object-contain border border-gray-300 bg-gray-50">
                    </div>
                @endif
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ $product->image_path ? 'Replace image (optional)' : 'Product image' }}</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">JPEG, PNG, GIF or WebP, max 5 MB. Leave empty to keep current.</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Display order</label>
                    <input type="number" name="order" id="order" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('order', $product->order) }}">
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-end">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                               class="rounded-none border-gray-300 text-brand-primary focus:ring-brand-primary">
                        <span class="ml-2 text-sm text-gray-700">Active (visible on shop)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-none hover:bg-gray-300">
                    Cancel
                </a>
                <a href="{{ route('admin.products.show', $product) }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-none hover:bg-gray-300">
                    View
                </a>
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function() {
    var editorId = 'description';
    function initCKEditor() {
        if (typeof CKEDITOR === 'undefined') return false;
        var el = document.getElementById(editorId);
        if (!el || CKEDITOR.instances[editorId]) return !!CKEDITOR.instances[editorId];
        try {
            CKEDITOR.replace(editorId, { height: 200 });
            return true;
        } catch (e) { return false; }
    }
    function bindFormSubmit() {
        var form = document.querySelector('form');
        if (!form || form._ckSubmitBound) return;
        form._ckSubmitBound = true;
        form.addEventListener('submit', function() {
            if (typeof CKEDITOR !== 'undefined') {
                for (var k in CKEDITOR.instances) {
                    if (CKEDITOR.instances[k]) CKEDITOR.instances[k].updateElement();
                }
            }
        });
    }
    function run() {
        if (initCKEditor()) bindFormSubmit();
        else bindFormSubmit();
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            run();
            var attempts = 0;
            var t = setInterval(function() {
                if (initCKEditor() || ++attempts > 20) clearInterval(t);
            }, 100);
        });
    } else {
        run();
        var attempts = 0;
        var t = setInterval(function() {
            if (initCKEditor() || ++attempts > 20) clearInterval(t);
        }, 100);
    }
    window.addEventListener('load', run);
})();
</script>
@endpush
@endsection
