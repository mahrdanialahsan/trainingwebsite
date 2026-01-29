@extends('layouts.admin')

@section('title', $document->title)

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $document->title }}</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.documents.edit', $document) }}" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.documents.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
                Back
            </a>
        </div>
    </div>

    <div class="bg-white rounded-none shadow p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Document Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Title</p>
                    <p class="font-medium">{{ $document->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Type</p>
                    <p class="font-medium">{{ ucfirst($document->type) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <span class="px-2 py-1 text-xs font-semibold rounded-none {{ $document->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $document->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Created</p>
                    <p class="font-medium">{{ $document->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>
                @if($document->file_name)
                <div>
                    <p class="text-sm text-gray-500 mb-1">File name</p>
                    <p class="font-medium">{{ $document->file_name }}</p>
                </div>
                @endif
                @if($document->file_size)
                <div>
                    <p class="text-sm text-gray-500 mb-1">File size</p>
                    <p class="font-medium">{{ number_format($document->file_size / 1024, 1) }} KB</p>
                </div>
                @endif
            </div>
        </div>

        @if($document->description)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Description</h2>
            <div class="prose max-w-none bg-gray-50 p-6 rounded-none">
                {!! nl2br(e($document->description)) !!}
            </div>
        </div>
        @endif

        @if($document->file_path)
        <div>
            <h2 class="text-2xl font-semibold mb-4">File</h2>
            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="inline-flex items-center text-brand-primary hover:underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Download / View PDF
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
