@extends('layouts.app')

@section('title', 'Training Programs')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-8">Training Programs</h1>

    @if($trainings->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($trainings as $training)
        <div class="bg-white rounded-none shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-xl font-semibold mb-3 text-brand-primary">{{ $training->title }}</h3>
                @if($training->about_title)
                <p class="text-gray-600 mb-4 font-medium">{{ $training->about_title }}</p>
                @endif
                @if($training->about_description)
                <p class="text-gray-700 mb-4 flex-grow">{{ Str::limit($training->about_description, 150) }}</p>
                @endif
                <div class="mt-auto pt-4">
                    <a href="{{ route('trainings.show', $training->slug) }}" class="block w-full text-center bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark transition font-semibold">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-none shadow-md p-8 text-center">
        <p class="text-gray-600">No training programs available at this time. Please check back later.</p>
    </div>
    @endif
</div>
@endsection
