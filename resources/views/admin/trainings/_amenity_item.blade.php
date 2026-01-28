@php
    $isExisting = $isExisting ?? false;
    $amenityId = $isExisting ? $amenity->id : null;
    $index = $index ?? 0;
@endphp
<div class="border border-gray-200 p-4 amenity-item" data-index="{{ $index }}" data-amenity-id="{{ $amenityId }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900">{{ $isExisting ? 'Amenity: ' . $amenity->title : 'Amenity #' . ($index + 1) }}</h3>
        <button type="button" class="text-red-600 hover:text-red-900 remove-amenity" data-index="{{ $index }}">Remove</button>
    </div>
    @if($isExisting)
        <input type="hidden" name="amenities[{{ $index }}][id]" value="{{ $amenity->id }}">
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" name="amenities[{{ $index }}][title]" required
                   value="{{ $isExisting ? $amenity->title : '' }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
            <input type="number" name="amenities[{{ $index }}][order]" min="0" value="{{ $isExisting ? $amenity->order : $index }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        </div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea name="amenities[{{ $index }}][description]" rows="3"
                  class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">{{ $isExisting ? $amenity->description : '' }}</textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Media Type *</label>
            <select name="amenities[{{ $index }}][media_type]" required
                    class="amenity-media-type w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <option value="image" {{ $isExisting && $amenity->media_type === 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ $isExisting && $amenity->media_type === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Media Position *</label>
            <select name="amenities[{{ $index }}][media_position]" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                <option value="left" {{ $isExisting && $amenity->media_position === 'left' ? 'selected' : '' }}>Left</option>
                <option value="right" {{ $isExisting && $amenity->media_position === 'right' ? 'selected' : '' }}>Right</option>
            </select>
        </div>
    </div>
    <div class="mb-4 amenity-image-field" data-index="{{ $index }}" style="display: {{ $isExisting && $amenity->media_type === 'image' ? 'block' : ($isExisting ? 'none' : 'block') }};">
        <label class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
        <input type="file" name="amenities[{{ $index }}][image]" accept="image/*"
               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        @if($isExisting && $amenity->image_path)
            <p class="text-sm text-gray-500 mt-1">Current: <a href="{{ asset('storage/' . $amenity->image_path) }}" target="_blank" class="text-brand-primary">View Image</a></p>
        @endif
    </div>
    <div class="mb-4 amenity-video-field" data-index="{{ $index }}" style="display: {{ $isExisting && $amenity->media_type === 'video' ? 'block' : 'none' }};">
        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL *</label>
        <input type="url" name="amenities[{{ $index }}][video_url]" placeholder="https://www.youtube.com/watch?v=..."
               value="{{ $isExisting && $amenity->video_path && (str_starts_with($amenity->video_path, 'http://') || str_starts_with($amenity->video_path, 'https://')) ? $amenity->video_path : '' }}"
               class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
        <p class="text-sm text-gray-500 mt-1">Enter the full YouTube video URL</p>
    </div>
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" name="amenities[{{ $index }}][is_active]" value="1" {{ $isExisting ? ($amenity->is_active ? 'checked' : '') : 'checked' }} class="mr-2">
            <span class="text-sm text-gray-700">Active</span>
        </label>
    </div>
</div>
