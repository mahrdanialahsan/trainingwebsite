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
                <div id="consultation-message" class="mb-4"></div>
                
                <form id="consultation-form" class="space-y-6" method="POST" action="{{ route('consulting.request') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                        <select id="service" name="service_interest"
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
                                  class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('message') border-red-500 @enderror"></textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" id="consultation-submit" class="bg-brand-primary text-white px-8 py-3 rounded-none hover:bg-brand-dark font-semibold transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="consultation-submit-text">Request Consultation</span>
                            <span id="consultation-submit-loading" class="hidden">Sending...</span>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('consultation-form');
    if (form) {
        const messageContainer = document.getElementById('consultation-message');
        const submitButton = document.getElementById('consultation-submit');
        const submitText = document.getElementById('consultation-submit-text');
        const submitLoading = document.getElementById('consultation-submit-loading');

        function showMessage(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
            const icon = type === 'success' ? 
                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' :
                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>';

            messageContainer.innerHTML = `
                <div class="${bgColor} border-2 px-4 py-3 rounded-none mb-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            ${icon}
                        </svg>
                        <div class="flex-1">
                            <p class="font-semibold">${message}</p>
                        </div>
                    </div>
                </div>
            `;
            
            messageContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function clearFieldErrors() {
            document.querySelectorAll('.field-error').forEach(el => el.remove());
            document.querySelectorAll('.border-red-500').forEach(el => {
                el.classList.remove('border-red-500');
            });
        }

        function showFieldErrors(errors) {
            clearFieldErrors();
            
            Object.keys(errors).forEach(field => {
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('border-red-500');
                    
                    const errorDiv = document.createElement('p');
                    errorDiv.className = 'text-red-500 text-sm mt-1 flex items-center field-error';
                    errorDiv.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        ${errors[field][0]}
                    `;
                    input.parentElement.appendChild(errorDiv);
                }
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            clearFieldErrors();
            messageContainer.innerHTML = '';
            
            submitButton.disabled = true;
            submitText.classList.add('hidden');
            submitLoading.classList.remove('hidden');

            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || 
                                   document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                return response.json().then(data => {
                    return { status: response.status, data: data };
                }).catch(() => {
                    return { status: response.status, data: { success: false, message: 'An error occurred. Please try again.' } };
                });
            })
            .then(({ status, data }) => {
                submitButton.disabled = false;
                submitText.classList.remove('hidden');
                submitLoading.classList.add('hidden');

                if (data.success) {
                    showMessage(data.message, 'success');
                    form.reset();
                } else {
                    if (data.errors) {
                        showFieldErrors(data.errors);
                    }
                    showMessage(data.message || 'An error occurred. Please try again.', 'error');
                }
            })
            .catch(error => {
                submitButton.disabled = false;
                submitText.classList.remove('hidden');
                submitLoading.classList.add('hidden');
                showMessage('An error occurred. Please try again.', 'error');
            });
        });
    }
});
</script>
@endsection
