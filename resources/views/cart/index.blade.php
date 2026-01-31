@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-6">Shopping Cart</h1>

    @if(session('success'))
        <p class="mb-4 text-green-600">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="mb-4 text-red-600">{{ session('error') }}</p>
    @endif

    @if(empty($items))
        <div class="bg-white rounded-none shadow-md p-12 text-center">
            <p class="text-gray-600 text-lg mb-6">Your cart is empty.</p>
            <a href="{{ route('shop') }}" class="inline-block bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark transition cursor-pointer font-medium">Continue shopping</a>
        </div>
    @else
        <form action="{{ route('cart.update') }}" method="POST" class="mb-8">
            @csrf
            <div class="bg-white rounded-none shadow-md overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    @foreach($items as $item)
                    <li class="p-6 flex flex-wrap gap-4 items-center">
                        <div class="w-20 h-20 flex-shrink-0 bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if($item->product->image_path)
                                <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="" class="w-full h-full object-contain">
                            @else
                                <span class="text-gray-400 text-xs">No image</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('shop.show', $item->product) }}" class="font-medium text-brand-primary hover:text-brand-dark">{{ $item->product->title }}</a>
                            <p class="text-sm text-gray-500">${{ number_format($item->product->price, 2) }} each</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <label for="qty-{{ $item->product->id }}" class="sr-only">Quantity</label>
                            <input type="number" name="items[{{ $item->product->id }}]" id="qty-{{ $item->product->id }}" value="{{ $item->quantity }}" min="1" max="99"
                                   class="w-16 px-2 py-1 border border-gray-300 rounded-none text-center">
                            <button type="button" class="cart-remove-btn text-red-600 hover:text-red-800 text-sm cursor-pointer"
                                    data-url="{{ route('cart.remove', $item->product) }}"
                                    data-confirm="Remove this item?">Remove</button>
                        </div>
                        <div class="w-24 text-right font-medium">${{ number_format($item->line_total, 2) }}</div>
                    </li>
                    @endforeach
                </ul>
                <div class="p-6 bg-gray-50 border-t border-gray-200 flex flex-wrap justify-between items-center gap-4">
                    <a href="{{ route('shop') }}" class="text-brand-primary hover:text-brand-dark font-medium">Continue shopping</a>
                    <div class="flex items-center gap-6">
                        <span class="text-lg font-bold">Subtotal: ${{ number_format($subtotal, 2) }}</span>
                        <button type="submit" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-none hover:bg-gray-300 transition cursor-pointer">Update cart</button>
                        <a href="{{ route('checkout.show') }}" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark transition cursor-pointer font-medium">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>

@if(!empty($items))
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var token = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.querySelectorAll('.cart-remove-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm(this.getAttribute('data-confirm') || 'Remove this item?')) return;
            var url = this.getAttribute('data-url');
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(function(r) {
                if (r.redirected) window.location.href = r.url;
                else if (r.ok) window.location.reload();
                else window.location.href = '{{ route("cart.index") }}';
            }).catch(function() { window.location.href = '{{ route("cart.index") }}'; });
        });
    });
});
</script>
@endpush
@endif
@endsection
