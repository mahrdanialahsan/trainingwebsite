@if(empty($items) || count($items) === 0)
    <div class="p-6 text-center text-gray-500 text-sm">Your cart is empty.</div>
    <div class="px-4 pb-4"><a href="{{ route('shop') }}" class="block w-full text-center bg-brand-primary text-white py-2 rounded-none hover:bg-brand-dark transition text-sm font-medium" data-turbo-action="advance">View shop</a></div>
@else
    <div class="max-h-64 overflow-y-auto">
        @foreach($items as $cartItem)
        <div class="flex gap-2 items-center px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 group/item">
            <a href="{{ route('shop.show', $cartItem->product) }}" class="flex gap-3 min-w-0 flex-1" data-turbo-action="advance">
                <div class="w-12 h-12 flex-shrink-0 bg-gray-100 flex items-center justify-center overflow-hidden">
                    @if($cartItem->product->image_path)
                        <img src="{{ asset('storage/' . $cartItem->product->image_path) }}" alt="" class="w-full h-full object-contain">
                    @else
                        <span class="text-gray-300 text-xs">—</span>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $cartItem->product->title }}</p>
                    <p class="text-xs text-gray-500">{{ $cartItem->quantity }} × ${{ number_format($cartItem->product->price, 2) }}</p>
                </div>
                <div class="text-sm font-medium text-gray-900 flex-shrink-0">${{ number_format($cartItem->line_total, 2) }}</div>
            </a>
            <button type="button" class="cart-dropdown-remove-btn flex-shrink-0 p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded transition cursor-pointer" data-url="{{ route('cart.remove', $cartItem->product) }}" aria-label="Remove {{ $cartItem->product->title }} from cart" title="Remove from cart">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
        @endforeach
    </div>
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
        <span class="font-semibold text-gray-900">Subtotal</span>
        <span class="font-semibold text-gray-900">${{ number_format($subtotal ?? 0, 2) }}</span>
    </div>
    <div class="p-4 flex gap-2">
        <a href="{{ route('cart.index') }}" class="flex-1 text-center border border-gray-300 text-gray-700 py-2 rounded-none hover:bg-gray-50 transition text-sm font-medium" data-turbo-action="advance">View cart</a>
        <a href="{{ route('checkout.show') }}" class="flex-1 text-center bg-brand-primary text-white py-2 rounded-none hover:bg-brand-dark transition text-sm font-medium" data-turbo-action="advance">Checkout</a>
    </div>
@endif
