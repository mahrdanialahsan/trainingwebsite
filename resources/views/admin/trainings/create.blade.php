@extends('layouts.admin')

@section('title', 'Create Training')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Create New Training</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.trainings.store') }}" enctype="multipart/form-data" data-turbo="false">
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
                <label for="about_title" class="block text-sm font-medium text-gray-700 mb-2">About Title</label>
                <input type="text" name="about_title" id="about_title"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('about_title') }}">
                @error('about_title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="about_description" class="block text-sm font-medium text-gray-700 mb-2">About Description</label>
                <textarea name="about_description" id="about_description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('about_description') }}</textarea>
                @error('about_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="download_button_text" class="block text-sm font-medium text-gray-700 mb-2">Download Button Text</label>
                <input type="text" name="download_button_text" id="download_button_text"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('download_button_text') }}" placeholder="e.g., Download Brochure">
                @error('download_button_text')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="download_pdf" class="block text-sm font-medium text-gray-700 mb-2">Download PDF</label>
                <input type="file" name="download_pdf" id="download_pdf" accept=".pdf"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Max file size: 10MB</p>
                @error('download_pdf')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" id="order" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('order', 0) }}">
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center mt-6">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>

            <!-- Facilities Section -->
            <div class="mb-8 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Facilities</h2>
                    <button type="button" id="add-facility-btn" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                        Add Facility
                    </button>
                </div>
                
                <div id="facilities-container" class="space-y-4">
                    <!-- Facilities will be added here dynamically -->
                </div>
            </div>

            <!-- Amenities Section -->
            <div class="mb-8 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Amenities</h2>
                    <button type="button" id="add-amenity-btn" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                        Add Amenity
                    </button>
                </div>
                
                <div id="amenities-container" class="space-y-4">
                    <!-- Amenities will be added here dynamically -->
                </div>
            </div>

            <div class="flex space-x-4 pt-6 border-t border-gray-200">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Create Training
                </button>
                <a href="{{ route('admin.trainings.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@push('js')
<script>
    let facilityCount = 0;
    let amenityCount = 0;

    document.addEventListener('DOMContentLoaded', function() {
        function initCKEditor() {
            if (typeof CKEDITOR === 'undefined') return false;
            var editorId = 'about_description';
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

        // Add Facility
        document.getElementById('add-facility-btn').addEventListener('click', function() {
            addFacilityForm();
        });

        // Add Amenity
        document.getElementById('add-amenity-btn').addEventListener('click', function() {
            addAmenityForm();
        });

        // Update CKEditor content before form submit
        var form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
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

    function addFacilityForm() {
        const container = document.getElementById('facilities-container');
        const index = facilityCount++;
        
        const facilityHtml = `
            <div class="border border-gray-200 p-4 facility-item" data-index="${index}">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Facility #${index + 1}</h3>
                    <button type="button" class="text-red-600 hover:text-red-900 remove-facility" data-index="${index}">Remove</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="facilities[${index}][title]" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" name="facilities[${index}][order]" min="0" value="${index}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="facilities[${index}][description]" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Media Type *</label>
                        <select name="facilities[${index}][media_type]" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Media Position *</label>
                        <select name="facilities[${index}][media_position]" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4 facility-image-field" data-index="${index}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
                    <input type="file" name="facilities[${index}][image]" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div class="mb-4 facility-video-field" data-index="${index}" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL *</label>
                    <input type="url" name="facilities[${index}][video_url]" placeholder="https://www.youtube.com/watch?v=..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <p class="text-sm text-gray-500 mt-1">Enter the full YouTube video URL</p>
                </div>
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="facilities[${index}][is_active]" value="1" checked class="mr-2">
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', facilityHtml);
        
        // Add remove functionality
        container.querySelector(`.remove-facility[data-index="${index}"]`).addEventListener('click', function() {
            container.querySelector(`.facility-item[data-index="${index}"]`).remove();
        });

        // Handle media type change
        const mediaTypeSelect = container.querySelector(`select[name="facilities[${index}][media_type]"]`);
        const imageField = container.querySelector(`.facility-image-field[data-index="${index}"]`);
        const videoField = container.querySelector(`.facility-video-field[data-index="${index}"]`);
        
        mediaTypeSelect.addEventListener('change', function() {
            if (this.value === 'image') {
                imageField.style.display = 'block';
                videoField.style.display = 'none';
                imageField.querySelector('input').required = true;
                videoField.querySelector('input').required = false;
            } else {
                imageField.style.display = 'none';
                videoField.style.display = 'block';
                imageField.querySelector('input').required = false;
                videoField.querySelector('input').required = true;
            }
        });
    }

    function addAmenityForm() {
        const container = document.getElementById('amenities-container');
        const index = amenityCount++;
        
        const amenityHtml = `
            <div class="border border-gray-200 p-4 amenity-item" data-index="${index}">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Amenity #${index + 1}</h3>
                    <button type="button" class="text-red-600 hover:text-red-900 remove-amenity" data-index="${index}">Remove</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="amenities[${index}][title]" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" name="amenities[${index}][order]" min="0" value="${index}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="amenities[${index}][description]" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Media Type *</label>
                        <select name="amenities[${index}][media_type]" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Media Position *</label>
                        <select name="amenities[${index}][media_position]" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4 amenity-image-field" data-index="${index}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
                    <input type="file" name="amenities[${index}][image]" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div class="mb-4 amenity-video-field" data-index="${index}" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL *</label>
                    <input type="url" name="amenities[${index}][video_url]" placeholder="https://www.youtube.com/watch?v=..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <p class="text-sm text-gray-500 mt-1">Enter the full YouTube video URL</p>
                </div>
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="amenities[${index}][is_active]" value="1" checked class="mr-2">
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', amenityHtml);
        
        // Add remove functionality
        container.querySelector(`.remove-amenity[data-index="${index}"]`).addEventListener('click', function() {
            container.querySelector(`.amenity-item[data-index="${index}"]`).remove();
        });

        // Handle media type change
        const mediaTypeSelect = container.querySelector(`select[name="amenities[${index}][media_type]"]`);
        const imageField = container.querySelector(`.amenity-image-field[data-index="${index}"]`);
        const videoField = container.querySelector(`.amenity-video-field[data-index="${index}"]`);
        
        mediaTypeSelect.addEventListener('change', function() {
            if (this.value === 'image') {
                imageField.style.display = 'block';
                videoField.style.display = 'none';
                imageField.querySelector('input').required = true;
                videoField.querySelector('input').required = false;
            } else {
                imageField.style.display = 'none';
                videoField.style.display = 'block';
                imageField.querySelector('input').required = false;
                videoField.querySelector('input').required = true;
            }
        });
    }
</script>
@endpush
@endsection
