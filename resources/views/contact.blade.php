@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
@php
    $systemEmail = \App\Models\Setting::get('system_email', 'info@training.com');
    $phoneNumber = \App\Models\Setting::get('phone_number', '(555) 123-4567');
@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-brand-primary mb-4">Contact Us</h1>
        <p class="text-lg text-gray-700">Get in touch with us. We'd love to hear from you.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-bold text-brand-primary mb-6">Get In Touch</h2>
            <div class="space-y-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-brand-primary mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $phoneNumber) }}" class="text-brand-primary hover:underline">{{ $phoneNumber }}</a>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-brand-primary mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <a href="mailto:{{ $systemEmail }}" class="text-brand-primary hover:underline">{{ $systemEmail }}</a>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-brand-primary mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                        <p class="text-gray-700">123 Training Street, Education City, EC 12345</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-bold text-brand-primary mb-6">Send Us a Message</h2>
            <div id="contact-message" class="mb-4">
                @if(session('success'))
                    <div class="bg-green-100 border-2 border-green-400 text-green-700 px-4 py-3 rounded-none mb-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <p class="font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border-2 border-red-400 text-red-700 px-4 py-3 rounded-none mb-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            <p class="font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <form id="contact-form" class="space-y-6" method="POST" action="{{ route('contact.store') }}" data-turbo="false">
                @csrf
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
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                           class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                    <input type="text" id="subject" name="subject" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('message') border-red-500 @enderror"></textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" id="contact-submit" class="w-full bg-brand-primary text-white px-6 py-3 rounded-none hover:bg-brand-dark font-semibold transition cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="contact-submit-text">Send Message</span>
                        <span id="contact-submit-loading" class="hidden">Sending...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    if (form) {
        const messageContainer = document.getElementById('contact-message');
        const submitButton = document.getElementById('contact-submit');
        const submitText = document.getElementById('contact-submit-text');
        const submitLoading = document.getElementById('contact-submit-loading');

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
                submitButton.classList.remove('btn-loading');
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
                submitButton.classList.remove('btn-loading');
                submitText.classList.remove('hidden');
                submitLoading.classList.add('hidden');
                showMessage('An error occurred. Please try again.', 'error');
            });
        });
    }
});
</script>
@endsection
