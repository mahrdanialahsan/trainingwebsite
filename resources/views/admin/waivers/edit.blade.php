@extends('layouts.admin')

@section('title', 'Edit Waiver')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Waiver</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.waivers.update', $waiver) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('title', $waiver->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                <textarea name="content" id="content" rows="10" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('content', $waiver->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">PDF File (Optional)</label>
                @if($waiver->pdf_path)
                <p class="text-sm text-gray-500 mb-2">Current PDF: <a href="{{ asset('storage/' . $waiver->pdf_path) }}" target="_blank" class="text-brand-primary hover:underline">View</a></p>
                @endif
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Upload a new PDF to replace the existing one (max 10MB)</p>
                @error('pdf_file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $waiver->is_active) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Set as active waiver</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Update Waiver
                </button>
                <a href="{{ route('admin.waivers.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
