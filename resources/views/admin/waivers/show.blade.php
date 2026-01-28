@extends('layouts.admin')

@section('title', $waiver->title)

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $waiver->title }}</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.waivers.edit', $waiver) }}" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.waivers.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
                Back
            </a>
        </div>
    </div>

    <div class="bg-white rounded-none shadow p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Waiver Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Title</p>
                    <p class="font-medium">{{ $waiver->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Version</p>
                    <p class="font-medium">v{{ $waiver->version }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $waiver->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $waiver->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Created</p>
                    <p class="font-medium">{{ $waiver->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Content</h2>
            <div class="prose max-w-none bg-gray-50 p-6 rounded-none">
                {!! nl2br(e($waiver->content)) !!}
            </div>
        </div>

        @if($waiver->pdf_path)
        <div>
            <h2 class="text-2xl font-semibold mb-4">PDF Document</h2>
            <a href="{{ asset('storage/' . $waiver->pdf_path) }}" target="_blank" 
               class="text-brand-primary hover:underline">View PDF</a>
        </div>
        @endif
    </div>
</div>
@endsection
