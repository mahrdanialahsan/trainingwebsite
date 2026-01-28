@extends('layouts.admin')

@section('title', 'Edit Bio')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit {{ ucfirst($bio->type) }} Bio</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.bios.update', $bio) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input type="text" name="name" id="name" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('name', $bio->name) }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                <input type="text" name="tagline" id="tagline"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('tagline', $bio->tagline) }}"
                       placeholder="e.g., Expert Trainer, Certified Professional">
                @error('tagline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                <textarea name="bio" id="bio" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('bio', $bio->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('email', $bio->email) }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" id="phone"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('phone', $bio->phone) }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                @if($bio->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $bio->photo) }}" alt="{{ $bio->name }}" class="w-32 h-32 object-cover rounded-none border border-gray-300">
                </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="credentials" class="block text-sm font-medium text-gray-700 mb-2">Credentials</label>
                <textarea name="credentials" id="credentials" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('credentials', $bio->credentials) }}</textarea>
                @error('credentials')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                <textarea name="experience" id="experience" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('experience', $bio->experience) }}</textarea>
                @error('experience')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $bio->is_active) ? 'checked' : '' }}
                           class="rounded-none border-gray-300 text-brand-primary focus:ring-brand-primary">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.bios.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-none hover:bg-gray-300">
                    Cancel
                </a>
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Update Bio
                </button>
            </div>
        </form>
    </div>
</div>
@push('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for bio, credentials, and experience
        if (typeof CKEDITOR !== 'undefined') {
            var editors = ['bio', 'credentials', 'experience'];
            
            editors.forEach(function(editorId) {
                var element = document.getElementById(editorId);
                
                if (element && !CKEDITOR.instances[editorId]) {
                    CKEDITOR.replace(editorId, {
                        height: '300px',
                        filebrowserBrowseUrl: '{{ asset("ckfinder/ckfinder.html") }}',
                        filebrowserImageBrowseUrl: '{{ asset("ckfinder/ckfinder.html?type=Images") }}',
                        filebrowserFlashBrowseUrl: '{{ asset("ckfinder/ckfinder.html?type=Flash") }}',
                        filebrowserUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
                        filebrowserImageUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
                        filebrowserFlashUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
                    });
                }
            });
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
