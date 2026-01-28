@extends('layouts.app')

@section('title', 'Consulting')

@section('content')
<!-- Hero Section -->
@if($hero)
<div class="bg-brand-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">{{ $hero->title ?? 'Professional Consulting Services' }}</h1>
            <p class="text-xl md:text-2xl text-gray-100 mb-8 max-w-3xl mx-auto">{{ $hero->subtitle ?? 'Transform your organization with expert guidance' }}</p>
            @if($hero->button_text)
            <a href="{{ $hero->button_link ?? '#contact' }}" class="inline-block bg-white text-brand-primary px-8 py-3 rounded-none hover:bg-gray-100 font-semibold transition shadow-lg">
                {{ $hero->button_text }}
            </a>
            @endif
        </div>
    </div>
</div>
@else
<div class="bg-brand-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Professional Consulting Services</h1>
            <p class="text-xl md:text-2xl text-gray-100 mb-8 max-w-3xl mx-auto">Transform your organization with expert guidance, strategic insights, and proven methodologies tailored to your unique challenges</p>
            <a href="#contact" class="inline-block bg-white text-brand-primary px-8 py-3 rounded-none hover:bg-gray-100 font-semibold transition shadow-lg">
                Schedule a Consultation
            </a>
        </div>
    </div>
</div>
@endif

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Overview Section -->
    @if($overview)
    <div class="mb-16">
        <div class="bg-white rounded-none shadow-md p-8 md:p-12 border border-gray-200">
            <h2 class="text-3xl font-bold text-brand-primary mb-6">{{ $overview->title ?? 'Why Choose Our Consulting Services?' }}</h2>
            <div class="text-lg text-gray-700 leading-relaxed whitespace-pre-line">{{ $overview->content }}</div>
        </div>
    </div>
    @endif

    <!-- Services Section -->
    @if($services->count() > 0)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-brand-primary mb-8 text-center">Our Consulting Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="bg-white rounded-none shadow-md p-6 border border-gray-200 hover:shadow-lg transition">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-brand-primary mb-3">{{ $service->title }}</h3>
                <p class="text-gray-700 mb-4">{{ $service->content }}</p>
                @if($service->additional_data && isset($service->additional_data['items']))
                <ul class="text-sm text-gray-600 space-y-1">
                    @foreach($service->additional_data['items'] as $item)
                    <li>• {{ $item }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Who It's For Section -->
    <div class="mb-16">
        <div class="bg-white rounded-none shadow-md p-8 md:p-12 border border-gray-200">
            <h2 class="text-3xl font-bold text-brand-primary mb-6">Who Can Benefit From Our Services?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-xl font-semibold text-brand-primary mb-3">Small & Medium Businesses</h3>
                    <p class="text-gray-700 mb-4">Growing businesses that need strategic guidance to scale operations, improve efficiency, and compete effectively in their markets.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-brand-primary mb-3">Startups & Entrepreneurs</h3>
                    <p class="text-gray-700 mb-4">New ventures seeking expert advice on business model development, market entry strategies, and operational setup.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-brand-primary mb-3">Established Organizations</h3>
                    <p class="text-gray-700 mb-4">Mature companies looking to transform, innovate, or optimize existing processes and systems for better performance.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-brand-primary mb-3">Non-Profit Organizations</h3>
                    <p class="text-gray-700 mb-4">Mission-driven organizations needing help with strategic planning, operational efficiency, and capacity building.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Approach Section -->
    @if($approach->count() > 0)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-brand-primary mb-8 text-center">Our Consulting Approach</h2>
        <div class="bg-white rounded-none shadow-md p-8 md:p-12 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($approach as $index => $step)
                <div class="text-center">
                    <div class="bg-brand-primary text-white w-16 h-16 rounded-none flex items-center justify-center text-2xl font-bold mx-auto mb-4">{{ $index + 1 }}</div>
                    <h3 class="text-lg font-semibold text-brand-primary mb-2">{{ $step->title }}</h3>
                    <p class="text-gray-700 text-sm">{{ $step->content }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Benefits Section -->
    @if($benefits->count() > 0)
    <div class="mb-16">
        <div class="bg-brand-primary text-white p-8 md:p-12 rounded-none">
            <h2 class="text-3xl font-bold mb-8 text-center text-white">Key Benefits</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($benefits as $benefit)
                <div class="bg-white p-6 rounded-none shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-brand-primary">{{ $benefit->title }}</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $benefit->content }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Contact Section -->
    <div id="contact" class="mb-16">
        <div class="bg-white rounded-none shadow-md p-8 md:p-12 border border-gray-200">
            <h2 class="text-3xl font-bold text-brand-primary mb-6 text-center">Ready to Get Started?</h2>
            <p class="text-lg text-gray-700 mb-8 text-center max-w-2xl mx-auto">
                Let's discuss how our consulting services can help your organization achieve its goals. Contact us today to schedule a free initial consultation.
            </p>
            <div class="max-w-2xl mx-auto">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        </div>
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company/Organization</label>
                        <input type="text" id="company" name="company"
                               class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                    </div>
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service Interest</label>
                        <select id="service" name="service"
                                class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                            <option value="">Select a service...</option>
                            <option value="strategic-planning">Strategic Planning</option>
                            <option value="organizational-development">Organizational Development</option>
                            <option value="process-optimization">Process Optimization</option>
                            <option value="technology-consulting">Technology Consulting</option>
                            <option value="financial-advisory">Financial Advisory</option>
                            <option value="risk-management">Risk Management</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-brand-primary text-white px-8 py-3 rounded-none hover:bg-brand-dark font-semibold transition shadow-lg">
                            Request Consultation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    @if($faqs->count() > 0)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-brand-primary mb-8 text-center">Frequently Asked Questions</h2>
        <div class="bg-white rounded-none shadow-md p-8 md:p-12 border border-gray-200">
            <div class="space-y-6">
                @foreach($faqs as $faq)
                <div>
                    <h3 class="text-xl font-semibold text-brand-primary mb-2">{{ $faq->question }}</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $faq->answer }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    @if($cta)
    <div class="bg-brand-dark text-white p-8 md:p-12 rounded-none text-center">
        <h2 class="text-3xl font-bold mb-4">{{ $cta->title }}</h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">{{ $cta->content }}</p>
        @if($cta->button_text)
        <a href="{{ $cta->button_link ?? '#contact' }}" class="inline-block bg-white text-brand-primary px-8 py-3 rounded-none hover:bg-gray-100 font-semibold transition shadow-lg">
            {{ $cta->button_text }}
        </a>
        @endif
    </div>
    @else
    <div class="bg-brand-dark text-white p-8 md:p-12 rounded-none text-center">
        <h2 class="text-3xl font-bold mb-4">Let's Transform Your Organization Together</h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Take the first step towards achieving your goals. Schedule a free consultation to discuss your needs and explore how we can help.
        </p>
        <a href="#contact" class="inline-block bg-white text-brand-primary px-8 py-3 rounded-none hover:bg-gray-100 font-semibold transition shadow-lg">
            Get Started Today
        </a>
    </div>
    @endif
</div>
@endsection
