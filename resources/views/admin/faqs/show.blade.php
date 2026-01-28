@extends('layouts.admin')

@section('title', 'View FAQ')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">FAQ Details</h1>

    <div class="bg-white rounded-none shadow p-8">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Question</h2>
            <p class="text-gray-700">{{ $faq->question }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Answer</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $faq->answer }}</p>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Display Order</h3>
                <p class="text-gray-600">{{ $faq->displayorder }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Status</h3>
                <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $faq->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $faq->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('admin.faqs.edit', $faq) }}" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
