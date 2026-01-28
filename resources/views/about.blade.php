@extends('layouts.app')

@section('title', 'About Us')

@section('content')
@php
    // Get sections from controller (grouped by section_type)
    $heroSection = $sections->get('hero')->first() ?? null;
    $whatWeOffer = $sections->get('what_we_offer')->first() ?? null;
    $whoWeAre = $sections->get('who_we_are')->first() ?? null;
    $trainingSafety = $sections->get('training_safety')->first() ?? null;
    $whyChooseUs = $sections->get('why_choose_us') ?? collect();
@endphp

<style>
    .about-gold { color: #d4af37; }
    .bg-about-dark { background-color: #3d2817; }
    .bg-about-gold { background-color: #d4af37; }
    .text-about-gold { color: #d4af37; }
    .border-about-gold { border-color: #d4af37; }
</style>

<!-- Hero/Introduction Section -->
@if($heroSection)
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="bg-gray-200 rounded-none min-h-[400px] flex items-center justify-center">
                @if($heroSection && ($heroSection->image_path || $heroSection->video_path))
                    @if($heroSection->media_type === 'video' && $heroSection->video_path)
                        @if(str_starts_with($heroSection->video_path, 'http://') || str_starts_with($heroSection->video_path, 'https://'))
                            @php
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $heroSection->video_path, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <iframe class="w-full h-full min-h-[400px]" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200"><p class="text-gray-500">Invalid YouTube URL</p></div>
                            @endif
                        @else
                            <video class="w-full h-full object-cover rounded-none" controls>
                                <source src="{{ asset('storage/' . $heroSection->video_path) }}" type="video/mp4">
                            </video>
                        @endif
                    @elseif($heroSection->image_path)
                        <img src="{{ asset('storage/' . $heroSection->image_path) }}" alt="{{ $heroSection->title ?? '' }}" class="w-full h-full object-cover rounded-none">
                    @endif
                @else
                    <div class="text-center text-gray-400">
                        <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm">Image/Video will be added from backend</p>
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-brand-primary mb-6">{{ $heroSection->title ?? 'About ' . config('app.name') }}</h1>
                @if($heroSection->content)
                    <div class="text-lg text-gray-700 mb-4">{!! $heroSection->content !!}</div>
                @endif
                @if($heroSection->additional_data && isset($heroSection->additional_data['subtitle']))
                    <p class="text-xl text-about-gold font-semibold mb-4">{{ $heroSection->additional_data['subtitle'] }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- What We Offer Section -->
@if($whatWeOffer)
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-about-gold text-center mb-12">{{ $whatWeOffer->title ?? 'What We Offer' }}</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-gray-200 rounded-none min-h-[300px] flex items-center justify-center">
                @if($whatWeOffer && ($whatWeOffer->image_path || $whatWeOffer->video_path))
                    @if($whatWeOffer->media_type === 'video' && $whatWeOffer->video_path)
                        @if(str_starts_with($whatWeOffer->video_path, 'http://') || str_starts_with($whatWeOffer->video_path, 'https://'))
                            @php
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $whatWeOffer->video_path, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <iframe class="w-full h-full min-h-[300px]" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200"><p class="text-gray-500">Invalid YouTube URL</p></div>
                            @endif
                        @else
                            <video class="w-full h-full object-cover rounded-none" controls>
                                <source src="{{ asset('storage/' . $whatWeOffer->video_path) }}" type="video/mp4">
                            </video>
                        @endif
                    @elseif($whatWeOffer->image_path)
                        <img src="{{ asset('storage/' . $whatWeOffer->image_path) }}" alt="{{ $whatWeOffer->title ?? '' }}" class="w-full h-full object-cover rounded-none">
                    @endif
                @else
                    <div class="text-center text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs">Image/Video placeholder</p>
                    </div>
                @endif
            </div>
            <div class="flex items-center">
                <div>
                    @if($whatWeOffer->additional_data && isset($whatWeOffer->additional_data['items']))
                        <ul class="space-y-4">
                            @foreach($whatWeOffer->additional_data['items'] as $item)
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-about-gold mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-lg text-gray-700">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @elseif($whatWeOffer->content)
                        <div class="text-lg text-gray-700">{!! $whatWeOffer->content !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Who We Are Section -->
@if($whoWeAre)
<section class="bg-about-dark text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12">{{ $whoWeAre->title ?? 'Who We Are' }}</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-gray-700 rounded-none min-h-[300px] flex items-center justify-center">
                @if($whoWeAre && ($whoWeAre->image_path || $whoWeAre->video_path))
                    @if($whoWeAre->media_type === 'video' && $whoWeAre->video_path)
                        @if(str_starts_with($whoWeAre->video_path, 'http://') || str_starts_with($whoWeAre->video_path, 'https://'))
                            @php
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $whoWeAre->video_path, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <iframe class="w-full h-full min-h-[300px]" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-700"><p class="text-gray-400">Invalid YouTube URL</p></div>
                            @endif
                        @else
                            <video class="w-full h-full object-cover rounded-none" controls>
                                <source src="{{ asset('storage/' . $whoWeAre->video_path) }}" type="video/mp4">
                            </video>
                        @endif
                    @elseif($whoWeAre->image_path)
                        <img src="{{ asset('storage/' . $whoWeAre->image_path) }}" alt="{{ $whoWeAre->title ?? '' }}" class="w-full h-full object-cover rounded-none">
                    @endif
                @else
                    <div class="text-center text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs">Image/Video placeholder</p>
                    </div>
                @endif
            </div>
            <div class="flex items-center">
                <div>
                    @if($whoWeAre->content)
                        <div class="text-lg mb-6">{!! $whoWeAre->content !!}</div>
                    @endif
                    @if($whoWeAre->additional_data && isset($whoWeAre->additional_data['items']))
                        <ul class="space-y-3">
                            @foreach($whoWeAre->additional_data['items'] as $item)
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-about-gold mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-lg">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Training Means Safety Section -->
@if($trainingSafety)
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-about-gold text-center mb-12">{{ $trainingSafety->title ?? 'Training Means Safety' }}</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-gray-200 rounded-none min-h-[300px] flex items-center justify-center">
                @if($trainingSafety && ($trainingSafety->image_path || $trainingSafety->video_path))
                    @if($trainingSafety->media_type === 'video' && $trainingSafety->video_path)
                        @if(str_starts_with($trainingSafety->video_path, 'http://') || str_starts_with($trainingSafety->video_path, 'https://'))
                            @php
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $trainingSafety->video_path, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <iframe class="w-full h-full min-h-[300px]" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200"><p class="text-gray-500">Invalid YouTube URL</p></div>
                            @endif
                        @else
                            <video class="w-full h-full object-cover rounded-none" controls>
                                <source src="{{ asset('storage/' . $trainingSafety->video_path) }}" type="video/mp4">
                            </video>
                        @endif
                    @elseif($trainingSafety->image_path)
                        <img src="{{ asset('storage/' . $trainingSafety->image_path) }}" alt="{{ $trainingSafety->title ?? '' }}" class="w-full h-full object-cover rounded-none">
                    @endif
                @else
                    <div class="text-center text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs">Image/Video placeholder</p>
                    </div>
                @endif
            </div>
            <div class="flex items-center">
                <div>
                    @if($trainingSafety->additional_data && isset($trainingSafety->additional_data['items']))
                        <ul class="space-y-4">
                            @foreach($trainingSafety->additional_data['items'] as $item)
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-about-gold mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-lg text-gray-700">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @elseif($trainingSafety->content)
                        <div class="text-lg text-gray-700">{!! $trainingSafety->content !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Ready To Get Started CTA -->
<section class="bg-gray-100 py-16 border-t border-gray-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-about-gold mb-8">Ready To Get Started?</h2>
        <a href="{{ route('courses') }}" class="inline-block bg-brand-dark text-white px-12 py-4 rounded-none hover:bg-brand-primary text-lg font-semibold transition">
            VIEW COURSES
        </a>
    </div>
</section>

<!-- FAQs Section -->
@if($faqs->count() > 0)
<section class="bg-gray-100 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-about-gold text-center mb-12">FAQs</h2>
        <div class="space-y-4">
            @foreach($faqs as $faq)
            <div class="bg-white rounded-none shadow-md overflow-hidden">
                <button class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none" onclick="toggleFaq({{ $faq->id }})">
                    <span class="text-lg font-semibold text-gray-900">{{ $faq->question }}</span>
                    <svg id="icon-{{ $faq->id }}" class="w-5 h-5 text-about-gold transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="content-{{ $faq->id }}" class="hidden px-6 pb-4">
                    <p class="text-gray-700 whitespace-pre-line">{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Why Choose Us Section -->
@if($whyChooseUs->count() > 0)
<section class="bg-about-dark text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($whyChooseUs as $item)
            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 bg-gray-700 rounded-full flex items-center justify-center overflow-hidden">
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    @endif
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $item->title }}</h3>
                @if($item->content)
                    <p class="text-gray-300">{{ $item->content }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- Footer Image Gallery -->
<section class="bg-gray-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-about-gold text-center mb-4">Explore Our Facilities</h2>
        <p class="text-xl text-white text-center mb-12">Our Facilities & Our World-Class Training</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-700 rounded-none min-h-[200px] flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-xs">Facility Image</p>
                </div>
            </div>
            <div class="bg-gray-700 rounded-none min-h-[200px] flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-xs">Facility Image</p>
                </div>
            </div>
            <div class="bg-gray-700 rounded-none min-h-[200px] flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-xs">Facility Image</p>
                </div>
            </div>
            <div class="bg-gray-700 rounded-none min-h-[200px] flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-xs">Facility Image</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFaq(id) {
    const content = document.getElementById('content-' + id);
    const icon = document.getElementById('icon-' + id);
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>
@endsection
