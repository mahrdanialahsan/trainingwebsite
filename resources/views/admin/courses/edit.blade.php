@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Course</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data" data-turbo="false"
              data-controller="loader"
              data-action="submit->loader#show">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('title', $course->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL-friendly name)</label>
                <input type="text" name="slug" id="slug"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('slug', $course->slug) }}">
                <p class="text-sm text-gray-500 mt-1">Leave blank to auto-generate from title</p>
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="long_description" class="block text-sm font-medium text-gray-700 mb-2">Long Description</label>
                <textarea name="long_description" id="long_description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('long_description', $course->long_description) }}</textarea>
                @error('long_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="thumbnail_image" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Image</label>
                @if($course->thumbnail_image)
                <div class="mb-2">
                    <p class="text-sm text-gray-500 mb-2">Current thumbnail:</p>
                    <img src="{{ $course->thumbnail_url }}" alt="Current thumbnail" class="w-32 h-32 object-contain bg-gray-100 border border-gray-300">
                    <label class="flex items-center mt-2">
                        <input type="checkbox" name="remove_thumbnail" value="1" class="mr-2">
                        <span class="text-sm text-gray-600">Remove current image</span>
                    </label>
                </div>
                <p class="text-sm text-gray-500 mb-2">Upload a new image to replace (optional):</p>
                @else
                <p class="text-sm text-gray-500 mb-2">No thumbnail set.</p>
                @endif
                <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">JPG, PNG, GIF or WebP. Max 5 MB.</p>
                @error('thumbnail_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date *</label>
                    <input type="date" name="date" id="date" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('date', $course->date->format('Y-m-d')) }}">
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time *</label>
                    <input type="time" name="start_time" id="start_time" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('start_time', $course->start_time->format('H:i')) }}">
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
                           value="{{ old('end_time', $course->end_time ? $course->end_time->format('H:i') : '') }}">
                    @error('end_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('price', $course->price) }}">
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
                           value="{{ old('max_participants', $course->max_participants) }}">
                    @error('max_participants')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        <option value="upcoming" {{ old('status', $course->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="active" {{ old('status', $course->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status', $course->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $course->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $course->is_active) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Update Course
                </button>
                <a href="{{ route('admin.courses.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@push('js')
<script>
(function() {
    var editorId = 'long_description';
    var ckfinderBase = '{{ asset("ckfinder/ckfinder.html") }}';
    var ckfinderImg = '{{ asset("ckfinder/ckfinder.html?type=Images") }}';
    var connector = '{{ asset("ckfinder/core/connector/php/connector.php") }}';
    function initCK() {
        if (typeof CKEDITOR === 'undefined') return false;
        var el = document.getElementById(editorId);
        if (!el || CKEDITOR.instances[editorId]) return !!CKEDITOR.instances[editorId];
        try {
            CKEDITOR.replace(editorId, { height: '400px', filebrowserBrowseUrl: ckfinderBase, filebrowserImageBrowseUrl: ckfinderImg, filebrowserUploadUrl: connector + '?command=QuickUpload&type=Files', filebrowserImageUploadUrl: connector + '?command=QuickUpload&type=Images' });
            return true;
        } catch (e) { return false; }
    }
    function bindSubmit() {
        var form = document.querySelector('form');
        if (!form || form._ckBound) return;
        form._ckBound = true;
        form.addEventListener('submit', function() {
            if (typeof CKEDITOR !== 'undefined') { for (var k in CKEDITOR.instances) { if (CKEDITOR.instances[k]) CKEDITOR.instances[k].updateElement(); } }
        });
    }
    function run() { initCK(); bindSubmit(); }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() { run(); var n = 0; var t = setInterval(function() { if (initCK() || ++n > 20) clearInterval(t); }, 100); });
    } else { run(); var n = 0; var t = setInterval(function() { if (initCK() || ++n > 20) clearInterval(t); }, 100); }
    window.addEventListener('load', run);
})();
</script>
@endpush
@endsection
