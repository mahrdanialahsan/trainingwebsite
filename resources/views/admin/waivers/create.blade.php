@extends('layouts.admin')

@section('title', 'Create Waiver')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Create New Waiver</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.waivers.store') }}" enctype="multipart/form-data" data-turbo="false">
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
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                <textarea name="content" id="content" rows="10" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('content') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Enter the waiver text content. This will be displayed to users during booking.</p>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">PDF File (Optional)</label>
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <p class="text-sm text-gray-500 mt-1">Upload a PDF version of the waiver (max 10MB)</p>
                @error('pdf_file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Set as active waiver (will deactivate other active waivers)</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Create Waiver
                </button>
                <a href="{{ route('admin.waivers.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function() {
    var editorId = 'content';
    function initCKEditor() {
        if (typeof CKEDITOR === 'undefined') return false;
        var el = document.getElementById(editorId);
        if (!el || CKEDITOR.instances[editorId]) return !!CKEDITOR.instances[editorId];
        try {
            CKEDITOR.replace(editorId, { height: 300 });
            return true;
        } catch (e) { return false; }
    }
    function bindFormSubmit() {
        var form = document.querySelector('form');
        if (!form || form._ckBound) return;
        form._ckBound = true;
        form.addEventListener('submit', function() {
            if (typeof CKEDITOR !== 'undefined') {
                for (var k in CKEDITOR.instances) {
                    if (CKEDITOR.instances[k]) CKEDITOR.instances[k].updateElement();
                }
            }
        });
    }
    function run() {
        initCKEditor();
        bindFormSubmit();
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            run();
            var n = 0;
            var t = setInterval(function() {
                if (initCKEditor() || ++n > 20) clearInterval(t);
            }, 100);
        });
    } else {
        run();
        var n = 0;
        var t = setInterval(function() {
            if (initCKEditor() || ++n > 20) clearInterval(t);
        }, 100);
    }
    window.addEventListener('load', run);
})();
</script>
@endpush
@endsection
