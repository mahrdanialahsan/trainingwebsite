@extends('layouts.app')

@section('title', 'FAQs')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-brand-primary mb-4 text-center">Frequently Asked Questions</h1>
    <p class="text-lg text-gray-600 mb-8 text-center">Find answers to common questions about our services</p>
    
    <!-- Filter Tabs -->
    <div class="flex justify-center mb-8 border-b border-gray-200">
        <div class="flex space-x-4">
            <a href="{{ route('faqs.index', ['type' => 'general']) }}" 
               class="py-2 px-4 border-b-2 font-medium {{ $type === 'general' ? 'border-brand-primary text-brand-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                General
            </a>
            <a href="{{ route('faqs.index', ['type' => 'about-us']) }}" 
               class="py-2 px-4 border-b-2 font-medium {{ $type === 'about-us' ? 'border-brand-primary text-brand-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                About Us
            </a>
            <a href="{{ route('faqs.index', ['type' => 'consulting']) }}" 
               class="py-2 px-4 border-b-2 font-medium {{ $type === 'consulting' ? 'border-brand-primary text-brand-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Consulting
            </a>
        </div>
    </div>

    @if($faqs->count() > 0)
    <div class="space-y-4">
        @foreach($faqs as $faq)
        <div class="bg-white rounded-none shadow-md overflow-hidden">
            <button type="button" class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none hover:bg-gray-50 transition cursor-pointer" onclick="toggleFaq({{ $faq->id }})">
                <span class="text-lg font-semibold text-gray-900 pr-4">{{ $faq->question }}</span>
                <svg id="icon-{{ $faq->id }}" class="w-5 h-5 text-brand-primary transform transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="content-{{ $faq->id }}" class="hidden px-6 pb-4">
                <p class="text-gray-700 whitespace-pre-line">{{ $faq->answer }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-none shadow-md p-8 text-center">
        <p class="text-gray-600">No FAQs available at this time.</p>
    </div>
    @endif
</div>

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
