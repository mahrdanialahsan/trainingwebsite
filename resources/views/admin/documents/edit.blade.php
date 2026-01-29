@extends('layouts.admin')

@section('title', 'Edit Document')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Document</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.documents.update', $document) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('title', $document->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select name="type" id="type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <option value="waiver" {{ old('type', $document->type) === 'waiver' ? 'selected' : '' }}>Waiver</option>
                    <option value="training" {{ old('type', $document->type) === 'training' ? 'selected' : '' }}>Training</option>
                    <option value="form" {{ old('type', $document->type) === 'form' ? 'selected' : '' }}>Form</option>
                    <option value="other" {{ old('type', $document->type) === 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">PDF File</label>
                @if($document->file_path)
                <p class="text-sm text-gray-500 mb-2">Current file: <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="text-brand-primary hover:underline">{{ $document->file_name }}</a></p>
                @endif
                <input type="file" name="file" id="file" accept=".pdf"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Leave empty to keep current file. Upload a new PDF to replace (max 10MB)</p>
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('description', $document->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $document->is_active) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Active (visible to users)</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Update Document
                </button>
                <a href="{{ route('admin.documents.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
