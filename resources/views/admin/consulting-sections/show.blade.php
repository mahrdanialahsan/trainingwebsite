@extends('layouts.admin')

@section('title', 'View Consulting Section')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Consulting Section Details</h1>

    <div class="bg-white rounded-none shadow p-8">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Section Type</h2>
            <p class="text-gray-700 capitalize">{{ str_replace('_', ' ', $consultingSection->section_type) }}</p>
        </div>

        @if($consultingSection->title)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Title</h2>
            <p class="text-gray-700">{{ $consultingSection->title }}</p>
        </div>
        @endif

        @if($consultingSection->subtitle)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Subtitle</h2>
            <p class="text-gray-700">{{ $consultingSection->subtitle }}</p>
        </div>
        @endif

        @if($consultingSection->content)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Content</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $consultingSection->content }}</p>
        </div>
        @endif

        @if($consultingSection->additional_data && isset($consultingSection->additional_data['items']))
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">List Items</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($consultingSection->additional_data['items'] as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($consultingSection->button_text)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-brand-primary mb-2">Button</h2>
            <p class="text-gray-700"><strong>Text:</strong> {{ $consultingSection->button_text }}</p>
            <p class="text-gray-700"><strong>Link:</strong> {{ $consultingSection->button_link }}</p>
        </div>
        @endif

        <div class="mb-6 grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Display Order</h3>
                <p class="text-gray-600">{{ $consultingSection->order }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Status</h3>
                <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $consultingSection->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $consultingSection->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('admin.consulting-sections.edit', $consultingSection) }}" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.consulting-sections.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
