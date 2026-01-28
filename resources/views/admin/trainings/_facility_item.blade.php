@php
    $isExisting = $isExisting ?? false;
    $facilityId = $isExisting ? $facility->id : null;
    $index = $index ?? 0;
@endphp
<div class="border border-gray-200 p-4 facility-item" data-index="{{ $index }}" data-facility-id="{{ $facilityId }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900">{{ $isExisting ? 'Facility: ' . $facility->title : 'Facility #' . ($index + 1) }}</h3>
        <button type="button" class="text-red-600 hover:text-red-900 remove-facility" data-index="{{ $index }}">Remove</button>
    </div>
    @if($isExisting)
        <input type="hidden" name="facilities[{{ $index }}][id]" value="{{ $facility->id }}">
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" name="facilities[{{ $index }}][title]" required
                   value="{{ $isExisting ? $facility->title : '' }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
            <input type="number" name="facilities[{{ $index }}][order]" min="0" value="{{ $isExisting ? $facility->order : $index }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        </div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea name="facilities[{{ $index }}][description]" rows="3"
                  class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ $isExisting ? $facility->description : '' }}</textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Media Type *</label>
            <select name="facilities[{{ $index }}][media_type]" required
                    class="facility-media-type w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <option value="image" {{ $isExisting && $facility->media_type === 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ $isExisting && $facility->media_type === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Media Position *</label>
            <select name="facilities[{{ $index }}][media_position]" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <option value="left" {{ $isExisting && $facility->media_position === 'left' ? 'selected' : '' }}>Left</option>
                <option value="right" {{ $isExisting && $facility->media_position === 'right' ? 'selected' : '' }}>Right</option>
            </select>
        </div>
    </div>
    <div class="mb-4 facility-image-field" data-index="{{ $index }}" style="display: {{ $isExisting && $facility->media_type === 'image' ? 'block' : ($isExisting ? 'none' : 'block') }};">
        <label class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
        <input type="file" name="facilities[{{ $index }}][image]" accept="image/*"
               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        @if($isExisting && $facility->image_path)
            <p class="text-sm text-gray-500 mt-1">Current: <a href="{{ asset('storage/' . $facility->image_path) }}" target="_blank" class="text-brand-primary">View Image</a></p>
        @endif
    </div>
    <div class="mb-4 facility-video-field" data-index="{{ $index }}" style="display: {{ $isExisting && $facility->media_type === 'video' ? 'block' : 'none' }};">
        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL *</label>
        <input type="url" name="facilities[{{ $index }}][video_url]" placeholder="https://www.youtube.com/watch?v=..."
               value="{{ $isExisting && $facility->video_path && (str_starts_with($facility->video_path, 'http://') || str_starts_with($facility->video_path, 'https://')) ? $facility->video_path : '' }}"
               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        <p class="text-sm text-gray-500 mt-1">Enter the full YouTube video URL</p>
    </div>
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" name="facilities[{{ $index }}][is_active]" value="1" {{ $isExisting ? ($facility->is_active ? 'checked' : '') : 'checked' }} class="mr-2">
            <span class="text-sm text-gray-700">Active</span>
        </label>
    </div>
</div>
