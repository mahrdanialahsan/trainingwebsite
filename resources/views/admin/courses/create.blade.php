@extends('layouts.admin')

@section('title', 'Create Course')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Create New Course</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.courses.store') }}" 
              data-controller="loader"
              data-action="submit->loader#show">
            @csrf

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL-friendly name)</label>
                <input type="text" name="slug" id="slug"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('slug') }}" placeholder="Auto-generated from title">
                <p class="text-sm text-gray-500 mt-1">Leave blank to auto-generate from title</p>
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="long_description" class="block text-sm font-medium text-gray-700 mb-2">Long Description</label>
                <textarea name="long_description" id="long_description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('long_description') }}</textarea>
                @error('long_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="thumbnail_image" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Image</label>
                <select name="thumbnail_image" id="thumbnail_image"
                        class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <option value="">No Image</option>
                    <option value="images/thumbnails/image01.png" {{ old('thumbnail_image') === 'images/thumbnails/image01.png' ? 'selected' : '' }}>Image 01</option>
                    <option value="images/thumbnails/image02.png" {{ old('thumbnail_image') === 'images/thumbnails/image02.png' ? 'selected' : '' }}>Image 02</option>
                    <option value="images/thumbnails/image03.png" {{ old('thumbnail_image') === 'images/thumbnails/image03.png' ? 'selected' : '' }}>Image 03</option>
                    <option value="images/thumbnails/image04.png" {{ old('thumbnail_image') === 'images/thumbnails/image04.png' ? 'selected' : '' }}>Image 04</option>
                    <option value="images/thumbnails/image05.png" {{ old('thumbnail_image') === 'images/thumbnails/image05.png' ? 'selected' : '' }}>Image 05</option>
                    <option value="images/thumbnails/image06.png" {{ old('thumbnail_image') === 'images/thumbnails/image06.png' ? 'selected' : '' }}>Image 06</option>
                    <option value="images/thumbnails/image07.png" {{ old('thumbnail_image') === 'images/thumbnails/image07.png' ? 'selected' : '' }}>Image 07</option>
                    <option value="images/thumbnails/image08.png" {{ old('thumbnail_image') === 'images/thumbnails/image08.png' ? 'selected' : '' }}>Image 08</option>
                </select>
                @error('thumbnail_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date *</label>
                    <input type="date" name="date" id="date" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('date') }}">
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time *</label>
                    <input type="time" name="start_time" id="start_time" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('start_time') }}">
                    @error('start_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                    <input type="time" name="end_time" id="end_time"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('end_time') }}">
                    @error('end_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('price') }}">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-2">Max Participants</label>
                    <input type="number" name="max_participants" id="max_participants" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('max_participants') }}">
                    @error('max_participants')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        <option value="upcoming" {{ old('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Create Course
                </button>
                <a href="{{ route('admin.courses.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@push('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for long_description
        if (typeof CKEDITOR !== 'undefined') {
            var editorId = 'long_description';
            var element = document.getElementById(editorId);
            
            if (element && !CKEDITOR.instances[editorId]) {
                CKEDITOR.replace(editorId, {
                    height: '400px',
                    filebrowserBrowseUrl: '{{ asset("ckfinder/ckfinder.html") }}',
                    filebrowserImageBrowseUrl: '{{ asset("ckfinder/ckfinder.html?type=Images") }}',
                    filebrowserFlashBrowseUrl: '{{ asset("ckfinder/ckfinder.html?type=Flash") }}',
                    filebrowserUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
                    filebrowserImageUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
                    filebrowserFlashUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
                });
            }
        }

        // Update CKEditor content before form submit
        var form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                if (typeof CKEDITOR !== 'undefined') {
                    for (var instance in CKEDITOR.instances) {
                        if (CKEDITOR.instances[instance]) {
                            CKEDITOR.instances[instance].updateElement();
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection
