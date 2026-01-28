@extends('layouts.app')

@section('title', $training->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Training Header -->
    <div class="bg-white rounded-none shadow-md p-8 mb-8">
        <h1 class="text-4xl font-bold text-brand-primary mb-4">{{ $training->title }}</h1>
        @if($training->about_title)
        <p class="text-2xl text-gray-700 mb-6">{{ $training->about_title }}</p>
        @endif
        @if($training->about_description)
        <div class="text-lg text-gray-700 leading-relaxed whitespace-pre-line">
            {{ $training->about_description }}
        </div>
        @endif
        @if($training->download_pdf_path && $training->download_button_text)
        <div class="mt-6">
            <a href="{{ asset('storage/' . $training->download_pdf_path) }}" target="_blank" class="inline-block bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark text-lg font-semibold transition">
                {{ $training->download_button_text }}
            </a>
        </div>
        @endif
    </div>

    <!-- Facilities Section -->
    @if($training->facilities->count() > 0)
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-brand-primary mb-8 text-center">Facilities</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($training->facilities as $facility)
            <div class="bg-white rounded-none shadow-md overflow-hidden">
                @if($facility->image_path || $facility->video_path)
                <div class="w-full h-64 overflow-hidden">
                    @if($facility->media_type === 'video' && $facility->video_path)
                        @if(str_starts_with($facility->video_path, 'http://') || str_starts_with($facility->video_path, 'https://'))
                            @php
                                // Extract YouTube video ID from URL
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $facility->video_path, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <p class="text-gray-500">Invalid YouTube URL</p>
                                </div>
                            @endif
                        @else
                            <video class="w-full h-full object-cover" controls>
                                <source src="{{ asset('storage/' . $facility->video_path) }}" type="video/mp4">
                            </video>
                        @endif
                    @elseif($facility->image_path)
                    <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->title }}" class="w-full h-full object-cover">
                    @endif
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-brand-primary mb-3">{{ $facility->title }}</h3>
                    @if($facility->description)
                    <p class="text-gray-700 leading-relaxed">{{ $facility->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Amenities Section -->
    @if($training->amenities->count() > 0)
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-brand-primary mb-8 text-center">Amenities</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($training->amenities as $amenity)
            <div class="bg-white rounded-none shadow-md overflow-hidden">
                @if($amenity->image_path || $amenity->video_path)
                <div class="w-full h-64 overflow-hidden">
                    @if($amenity->media_type === 'video' && $amenity->video_path)
                        @if(str_starts_with($amenity->video_path, 'http://') || str_starts_with($amenity->video_path, 'https://'))
                            @php
                                // Extract YouTube video ID from URL
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $amenity->video_path, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <p class="text-gray-500">Invalid YouTube URL</p>
                                </div>
                            @endif
                        @else
                            <video class="w-full h-full object-cover" controls>
                                <source src="{{ asset('storage/' . $amenity->video_path) }}" type="video/mp4">
                            </video>
                        @endif
                    @elseif($amenity->image_path)
                    <img src="{{ asset('storage/' . $amenity->image_path) }}" alt="{{ $amenity->title }}" class="w-full h-full object-cover">
                    @endif
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-brand-primary mb-3">{{ $amenity->title }}</h3>
                    @if($amenity->description)
                    <p class="text-gray-700 leading-relaxed">{{ $amenity->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Back Button -->
    <div class="text-center mt-8">
        <a href="{{ route('trainings.index') }}" class="inline-block bg-gray-200 text-brand-primary px-6 py-3 rounded-none hover:bg-gray-300 font-semibold transition">
            ← Back to Training Programs
        </a>
    </div>
</div>
@endsection
