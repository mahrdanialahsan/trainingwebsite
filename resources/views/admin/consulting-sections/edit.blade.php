@extends('layouts.admin')

@section('title', 'Edit Consulting Section')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Consulting Section</h1>

    <div class="bg-white rounded-none shadow p-8">
        <form method="POST" action="{{ route('admin.consulting-sections.update', $consultingSection) }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="section_type" class="block text-sm font-medium text-gray-700 mb-2">Section Type *</label>
                <select name="section_type" id="section_type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    @foreach($sectionTypes as $key => $label)
                        <option value="{{ $key }}" {{ old('section_type', $consultingSection->section_type) === $key ? 'selected' : '' }}>{{ $label }}</option>
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
                       value="{{ old('title', $consultingSection->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('subtitle', $consultingSection->subtitle) }}">
                @error('subtitle')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" id="content" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ old('content', $consultingSection->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                    <input type="text" name="button_text" id="button_text"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('button_text', $consultingSection->button_text) }}">
                </div>
                <div>
                    <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                    <input type="text" name="button_link" id="button_link"
                           class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                           value="{{ old('button_link', $consultingSection->button_link) }}">
                </div>
            </div>

            <div class="mb-6" id="items-field">
                <label class="block text-sm font-medium text-gray-700 mb-2">List Items</label>
                <div id="items-container">
                    @if($consultingSection->additional_data && isset($consultingSection->additional_data['items']))
                        @foreach($consultingSection->additional_data['items'] as $item)
                        <div class="flex gap-2 mb-2">
                            <input type="text" name="items[]" value="{{ $item }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" placeholder="Enter item text">
                            <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-3 py-2 rounded-none hover:bg-red-600">Remove</button>
                        </div>
                        @endforeach
                    @else
                        <div class="flex gap-2 mb-2">
                            <input type="text" name="items[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" placeholder="Enter item text">
                            <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-3 py-2 rounded-none hover:bg-red-600">Remove</button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addItem()" class="mt-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-300 text-sm">Add Item</button>
            </div>

            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" id="order" min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('order', $consultingSection->order) }}">
                @error('order')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $consultingSection->is_active) ? 'checked' : '' }}
                           class="rounded-none border-gray-300 text-brand-primary focus:ring-brand-primary">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Update Section
                </button>
                <a href="{{ route('admin.consulting-sections.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-none hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
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
@endsection
