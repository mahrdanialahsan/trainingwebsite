@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-6">Checkout</h1>

    @if(session('error'))
        <p class="mb-4 text-red-600">{{ session('error') }}</p>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" data-turbo="false">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-none shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact & shipping</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        @php
                            $userName = auth()->user()?->name ?? '';
                            $nameParts = $userName !== '' ? explode(' ', $userName) : [];
                        @endphp
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First name *</label>
                            <input type="text" name="first_name" id="first_name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:ring-2 focus:ring-brand-primary focus:border-transparent"
                                   value="{{ old('first_name', $nameParts[0] ?? '') }}">
                            @error('first_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last name *</label>
                            <input type="text" name="last_name" id="last_name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:ring-2 focus:ring-brand-primary focus:border-transparent"
                                   value="{{ old('last_name', $nameParts[1] ?? '') }}">
                            @error('last_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:ring-2 focus:ring-brand-primary focus:border-transparent"
                               value="{{ old('email', auth()->user()?->email) }}">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="phone"
                               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:ring-2 focus:ring-brand-primary focus:border-transparent"
                               value="{{ old('phone', auth()->user()?->phone) }}">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Shipping address</label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-none focus:ring-2 focus:ring-brand-primary focus:border-transparent">{{ old('address') }}</textarea>
                        @error('address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-none shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order summary</h2>
                <ul class="divide-y divide-gray-200 mb-4">
                    @foreach($items as $item)
                    <li class="py-3 flex justify-between text-sm">
                        <span>{{ $item->product->title }} × {{ $item->quantity }}</span>
                        <span>${{ number_format($item->line_total, 2) }}</span>
                    </li>
                    @endforeach
                </ul>
                <p class="text-lg font-bold border-t border-gray-200 pt-3 flex justify-between">
                    <span>Total</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </p>
                <p class="text-sm text-gray-500 mt-4">You will be redirected to Stripe to pay securely.</p>
                <button type="submit" class="mt-6 w-full bg-brand-primary text-white py-3 rounded-none hover:bg-brand-dark transition cursor-pointer font-semibold">
                    Pay with card
                </button>
                <a href="{{ route('cart.index') }}" class="block mt-3 text-center text-brand-primary hover:text-brand-dark text-sm">Back to cart</a>
            </div>
        </div>
    </form>
</div>
@endsection
