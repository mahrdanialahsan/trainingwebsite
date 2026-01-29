@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo.png') }}" alt="Texas Training Group" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-brand-primary">Create Account</h1>
            <p class="text-gray-600 mt-2">Sign up to get started</p>
        </div>

        <div class="bg-white rounded-none shadow-md p-8">
            <div id="message-container"></div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-none mb-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border-2 border-red-400 text-red-700 px-4 py-3 rounded-none mb-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1">
                            <p class="font-semibold mb-1">Please fix the following errors:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form id="register-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" required
                           class="w-full px-3 py-2 border rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('name') border-red-500 @else border-gray-300 @enderror"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-3 py-2 border rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('email') border-red-500 @else border-gray-300 @enderror"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" name="phone" id="phone"
                           class="w-full px-3 py-2 border rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('phone') border-red-500 @else border-gray-300 @enderror"
                           value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-3 py-2 border rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('password') border-red-500 @else border-gray-300 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full px-3 py-2 border rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary @error('password_confirmation') border-red-500 @else border-gray-300 @enderror">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" id="register-submit" class="w-full bg-brand-primary text-white px-4 py-2 rounded-none hover:bg-brand-dark font-semibold cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                    <span id="register-submit-text">Create Account</span>
                    <span id="register-submit-loading" class="hidden">Creating account...</span>
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-brand-primary hover:text-brand-dark font-medium">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('register-form');
    const messageContainer = document.getElementById('message-container');
    const submitButton = document.getElementById('register-submit');
    const submitText = document.getElementById('register-submit-text');
    const submitLoading = document.getElementById('register-submit-loading');

    function showMessage(message, type = 'error') {
        const bgColor = type === 'error' ? 'bg-red-50 border-red-500 text-red-800' : 
                       type === 'success' ? 'bg-green-100 border-green-400 text-green-700' :
                       'bg-yellow-100 border-yellow-400 text-yellow-700';
        
        const icon = type === 'error' ? 
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>' :
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>';

        messageContainer.innerHTML = `
            <div class="${bgColor} border-2 px-4 py-3 rounded-none mb-4 shadow-md">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        ${icon}
                    </svg>
                    <div class="flex-1">
                        <p class="font-bold text-lg mb-2">${type === 'error' ? 'Registration Failed' : 'Success'}</p>
                        <p class="text-sm">${message}</p>
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
            el.classList.add('border-gray-300');
        });
    }

    function showFieldErrors(errors) {
        clearFieldErrors();
        
        Object.keys(errors).forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.remove('border-gray-300');
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
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                }
            } else {
                // Check if message matches any field error to avoid duplicates
                let messageMatchesFieldError = false;
                if (data.errors) {
                    const allFieldErrors = Object.values(data.errors).flat();
                    messageMatchesFieldError = allFieldErrors.some(error => error === data.message);
                    
                    if (messageMatchesFieldError) {
                        // Only show field errors, not the duplicate general message
                        showFieldErrors(data.errors);
                    } else {
                        // Show both if they're different
                        showFieldErrors(data.errors);
                        showMessage(data.message || 'Registration failed. Please try again.', 'error');
                    }
                } else {
                    // No field errors, show general message
                    showMessage(data.message || 'Registration failed. Please try again.', 'error');
                }
            }
        })
        .catch(error => {
            submitButton.disabled = false;
            submitText.classList.remove('hidden');
            submitLoading.classList.add('hidden');
            showMessage('An error occurred. Please try again.', 'error');
        });
    });
});
</script>
@endsection
