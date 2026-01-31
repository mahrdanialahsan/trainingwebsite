@extends('layouts.app')

@section('title', 'Order Confirmed')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-none shadow-md p-8 text-center">
        <h1 class="text-3xl font-bold text-brand-primary mb-2">Thank you for your order</h1>
        <p class="text-gray-600 mb-6">Order #{{ $order->id }} has been confirmed.</p>

        <div class="text-left bg-gray-50 p-6 rounded-none mb-6">
            <p class="font-medium text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</p>
            <p class="text-sm text-gray-600">{{ $order->email }}</p>
            @if($order->phone)<p class="text-sm text-gray-600">{{ $order->phone }}</p>@endif
            @if($order->address)<p class="text-sm text-gray-600 mt-2">{{ $order->address }}</p>@endif
        </div>

        <ul class="text-left divide-y divide-gray-200 mb-6">
            @foreach($order->items as $item)
            <li class="py-2 flex justify-between text-sm">
                <span>{{ $item->product_title }} × {{ $item->quantity }}</span>
                <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
            </li>
            @endforeach
        </ul>
        <p class="text-lg font-bold flex justify-between border-t border-gray-200 pt-3">
            <span>Total paid</span>
            <span>${{ number_format($order->total, 2) }}</span>
        </p>

        <p class="text-sm text-gray-500 mt-6">A confirmation email has been sent to <strong>{{ $order->email }}</strong> with your order details.</p>
        <p class="text-sm text-gray-500 mt-2">We'll contact you if we need any details about shipping.</p>
        <a href="{{ route('shop') }}" class="inline-block mt-6 bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark transition cursor-pointer font-medium">Continue shopping</a>
    </div>
</div>
@endsection
