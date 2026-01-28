@extends('layouts.admin')

@section('title', 'View Training')

@section('content')
<div class="max-w-4xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $training->title }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.trainings.edit', $training) }}" class="bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark">
                Edit
            </a>
            <a href="{{ route('admin.trainings.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
                Back
            </a>
        </div>
    </div>

    <div class="bg-white rounded-none shadow p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Training Details</h2>
        <div class="space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-500">Title</label>
                <p class="text-gray-900">{{ $training->title }}</p>
            </div>
            @if($training->about_title)
            <div>
                <label class="text-sm font-medium text-gray-500">About Title</label>
                <p class="text-gray-900">{{ $training->about_title }}</p>
            </div>
            @endif
            @if($training->about_description)
            <div>
                <label class="text-sm font-medium text-gray-500">About Description</label>
                <p class="text-gray-900 whitespace-pre-line">{{ $training->about_description }}</p>
            </div>
            @endif
            @if($training->download_pdf_path)
            <div>
                <label class="text-sm font-medium text-gray-500">Download PDF</label>
                <p>
                    <a href="{{ asset('storage/' . $training->download_pdf_path) }}" target="_blank" class="text-brand-primary hover:text-brand-dark">
                        {{ $training->download_button_text ?? 'Download PDF' }}
                    </a>
                </p>
            </div>
            @endif
            <div>
                <label class="text-sm font-medium text-gray-500">Order</label>
                <p class="text-gray-900">{{ $training->order }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Status</label>
                <p class="text-gray-900">
                    @if($training->is_active)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    @if($training->facilities->count() > 0)
    <div class="bg-white rounded-none shadow p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Facilities ({{ $training->facilities->count() }})</h2>
        <div class="space-y-4">
            @foreach($training->facilities as $facility)
            <div class="border border-gray-200 p-4">
                <h3 class="font-semibold text-gray-900 mb-2">{{ $facility->title }}</h3>
                @if($facility->description)
                <p class="text-sm text-gray-600 mb-2">{{ $facility->description }}</p>
                @endif
                <div class="text-xs text-gray-500">
                    Order: {{ $facility->order }} | 
                    Status: {{ $facility->is_active ? 'Active' : 'Inactive' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($training->amenities->count() > 0)
    <div class="bg-white rounded-none shadow p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Amenities ({{ $training->amenities->count() }})</h2>
        <div class="space-y-4">
            @foreach($training->amenities as $amenity)
            <div class="border border-gray-200 p-4">
                <h3 class="font-semibold text-gray-900 mb-2">{{ $amenity->title }}</h3>
                @if($amenity->description)
                <p class="text-sm text-gray-600 mb-2">{{ $amenity->description }}</p>
                @endif
                <div class="text-xs text-gray-500">
                    Order: {{ $amenity->order }} | 
                    Status: {{ $amenity->is_active ? 'Active' : 'Inactive' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
