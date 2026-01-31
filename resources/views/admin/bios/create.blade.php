@extends('layouts.admin')

@section('title', 'Add Bio')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Add New Bio</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.bios.store') }}" enctype="multipart/form-data" data-turbo="false">
            @csrf

            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select name="type" id="type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    <option value="">Select type...</option>
                    <option value="owner" {{ old('type') === 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="partner" {{ old('type') === 'partner' ? 'selected' : '' }}>Partner</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input type="text" name="name" id="name" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                <input type="text" name="tagline" id="tagline"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('tagline') }}"
                       placeholder="e.g., Expert Trainer, Certified Professional">
                @error('tagline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                <textarea name="bio" id="bio" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" id="phone"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                <div id="photo-preview-wrap" class="mb-2 hidden">
                    <img id="photo-preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-none border border-gray-300">
                </div>
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="credentials" class="block text-sm font-medium text-gray-700 mb-2">Credentials</label>
                <textarea name="credentials" id="credentials" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('credentials') }}</textarea>
                @error('credentials')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                <textarea name="experience" id="experience" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('experience') }}</textarea>
                @error('experience')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded-none border-gray-300 text-brand-primary focus:ring-brand-primary">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.bios.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-none hover:bg-gray-300">
                    Cancel
                </a>
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Create Bio
                </button>
            </div>
        </form>
    </div>
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initCKEditors() {
            if (typeof CKEDITOR === 'undefined') return false;
            var editors = ['bio', 'credentials', 'experience'];
            var opts = { height: '300px', filebrowserBrowseUrl: '{{ asset("ckfinder/ckfinder.html") }}', filebrowserImageBrowseUrl: '{{ asset("ckfinder/ckfinder.html?type=Images") }}', filebrowserUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php") }}?command=QuickUpload&type=Files', filebrowserImageUploadUrl: '{{ asset("ckfinder/core/connector/php/connector.php") }}?command=QuickUpload&type=Images' };
            var done = 0;
            editors.forEach(function(editorId) {
                var el = document.getElementById(editorId);
                if (el && !CKEDITOR.instances[editorId]) { try { CKEDITOR.replace(editorId, opts); done++; } catch (e) {} }
            });
            return done > 0;
        }
        initCKEditors();
        var n = 0;
        var t = setInterval(function() { if (initCKEditors() || ++n > 20) clearInterval(t); }, 100);
        window.addEventListener('load', initCKEditors);
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
        var photoInput = document.getElementById('photo');
        var photoPreview = document.getElementById('photo-preview');
        var photoPreviewWrap = document.getElementById('photo-preview-wrap');
        if (photoInput && photoPreview && photoPreviewWrap) {
            photoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                        photoPreviewWrap.classList.remove('hidden');
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    photoPreviewWrap.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush
@endsection
