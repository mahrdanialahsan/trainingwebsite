@extends('layouts.admin')

@section('title', 'Create About Section')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Create New About Section</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.about.store') }}" enctype="multipart/form-data" data-turbo="false">
            @csrf

            <div class="mb-6">
                <label for="section_type" class="block text-sm font-medium text-gray-700 mb-2">Section Type *</label>
                <select name="section_type" id="section_type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <option value="">Select a section type...</option>
                    @foreach($sectionTypes as $key => $label)
                        <option value="{{ $key }}" {{ old('section_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('section_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" id="content" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6" id="subtitle-field" style="display: none;">
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle (for Hero section)</label>
                <textarea name="subtitle" id="subtitle" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('subtitle') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">This appears below the main content in the Hero section</p>
                @error('subtitle')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="media_type" class="block text-sm font-medium text-gray-700 mb-2">Media Type *</label>
                <select name="media_type" id="media_type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <option value="image" {{ old('media_type', 'image') === 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ old('media_type') === 'video' ? 'selected' : '' }}>Video</option>
                </select>
                @error('media_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6" id="image-field">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Upload an image (max 5MB)</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 hidden" id="video-field">
                <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL *</label>
                <input type="url" name="video_url" id="video_url" placeholder="https://www.youtube.com/watch?v=..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Enter the full YouTube video URL</p>
                @error('video_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" id="order" min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('order', 0) }}">
                <p class="text-sm text-gray-500 mt-1">Display order (lower numbers appear first)</p>
                @error('order')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6" id="items-field" style="display: none;">
                <label class="block text-sm font-medium text-gray-700 mb-2">List Items (for sections with bullet points)</label>
                <p class="text-sm text-gray-500 mb-2">Used for: What We Offer, Who We Are, Training Means Safety</p>
                <div id="items-container">
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="items[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" placeholder="Enter item text">
                        <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-3 py-2 rounded-none hover:bg-red-600">Remove</button>
                    </div>
                </div>
                <button type="button" onclick="addItem()" class="mt-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-300 text-sm">Add Item</button>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded-none border-gray-300 text-brand-primary focus:ring-brand-primary">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Create Section
                </button>
                <a href="{{ route('admin.about.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initCKEditor() {
            if (typeof CKEDITOR === 'undefined') return false;
            var editorId = 'content';
            var el = document.getElementById(editorId);
            if (!el || CKEDITOR.instances[editorId]) return !!CKEDITOR.instances[editorId];
            try {
                CKEDITOR.replace(editorId, { height: '300px', filebrowserBrowseUrl: '{{ asset("ckfinder/ckfinder.html") }}', filebrowserImageBrowseUrl: '{{ asset("ckfinder/ckfinder.html?type=Images") }}', filebrowserUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php") }}?command=QuickUpload&type=Files', filebrowserImageUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php") }}?command=QuickUpload&type=Images' });
                return true;
            } catch (e) { return false; }
        }
        initCKEditor();
        var n = 0;
        var t = setInterval(function() { if (initCKEditor() || ++n > 20) clearInterval(t); }, 100);
        window.addEventListener('load', initCKEditor);

        // Handle section type change
        const sectionType = document.getElementById('section_type');
        const subtitleField = document.getElementById('subtitle-field');
        const itemsField = document.getElementById('items-field');
        
        function toggleFields() {
            const sectionValue = sectionType.value;
            
            // Show/hide subtitle field for hero section
            if (sectionValue === 'hero') {
                subtitleField.style.display = 'block';
            } else {
                subtitleField.style.display = 'none';
            }
            
            // Show/hide items field for sections that need lists
            if (['what_we_offer', 'who_we_are', 'training_safety'].includes(sectionValue)) {
                itemsField.style.display = 'block';
            } else {
                itemsField.style.display = 'none';
            }
        }
        
        sectionType.addEventListener('change', toggleFields);
        toggleFields(); // Initialize on page load

        // Handle media type change
        document.getElementById('media_type').addEventListener('change', function() {
            const imageField = document.getElementById('image-field');
            const videoField = document.getElementById('video-field');
            
            if (this.value === 'video') {
                imageField.classList.add('hidden');
                videoField.classList.remove('hidden');
                document.getElementById('image').required = false;
                document.getElementById('video_url').required = true;
            } else {
                imageField.classList.remove('hidden');
                videoField.classList.add('hidden');
                document.getElementById('image').required = true;
                document.getElementById('video_url').required = false;
            }
        });

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

    function addItem() {
        const container = document.getElementById('items-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2 mb-2';
        div.innerHTML = `
            <input type="text" name="items[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" placeholder="Enter item text">
            <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-3 py-2 rounded-none hover:bg-red-600">Remove</button>
        `;
        container.appendChild(div);
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>
@endpush
@endsection
