@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Settings</h1>

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <!-- General Settings -->
        <div class="bg-white rounded-none shadow p-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">General Settings</h2>

            <div class="mb-6">
                <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                <input type="text" name="tagline" id="tagline"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('tagline', $tagline) }}"
                       placeholder="Professional training and consulting services.">
                @error('tagline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Company tagline displayed in the footer</p>
            </div>

            <div class="mb-6">
                <label for="system_email" class="block text-sm font-medium text-gray-700 mb-2">System Email</label>
                <input type="email" name="system_email" id="system_email"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('system_email', $systemEmail) }}"
                       placeholder="info@training.com">
                @error('system_email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Email address displayed in the footer and contact page</p>
            </div>

            <div class="mb-6">
                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('phone_number', $phoneNumber) }}"
                       placeholder="(555) 123-4567">
                @error('phone_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Phone number displayed in the footer and contact page</p>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="bg-white rounded-none shadow p-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Social Media Links</h2>

            <div class="mb-6">
                <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                <input type="url" name="social_facebook" id="social_facebook"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('social_facebook', $socialFacebook) }}"
                       placeholder="https://facebook.com/yourpage">
                @error('social_facebook')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                <input type="url" name="social_instagram" id="social_instagram"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('social_instagram', $socialInstagram) }}"
                       placeholder="https://instagram.com/yourprofile">
                @error('social_instagram')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="social_youtube" class="block text-sm font-medium text-gray-700 mb-2">YouTube URL</label>
                <input type="url" name="social_youtube" id="social_youtube"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('social_youtube', $socialYoutube) }}"
                       placeholder="https://youtube.com/yourchannel">
                @error('social_youtube')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                <input type="url" name="social_twitter" id="social_twitter"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('social_twitter', $socialTwitter) }}"
                       placeholder="https://twitter.com/yourprofile">
                @error('social_twitter')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                <input type="url" name="social_linkedin" id="social_linkedin"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('social_linkedin', $socialLinkedin) }}"
                       placeholder="https://linkedin.com/company/yourcompany">
                @error('social_linkedin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Payment Settings -->
        <div class="bg-white rounded-none shadow p-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Settings</h2>

            <div class="mb-6">
                <label for="stripe_public_key" class="block text-sm font-medium text-gray-700 mb-2">Stripe Publishable Key</label>
                <input type="text" name="stripe_public_key" id="stripe_public_key"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('stripe_public_key', $stripePublicKey) }}"
                       placeholder="pk_test_...">
                @error('stripe_public_key')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Your Stripe publishable key (starts with pk_)</p>
            </div>

            <div class="mb-6">
                <label for="stripe_secret_key" class="block text-sm font-medium text-gray-700 mb-2">Stripe Secret Key</label>
                <input type="password" name="stripe_secret_key" id="stripe_secret_key"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('stripe_secret_key', $stripeSecretKey) }}"
                       placeholder="sk_test_...">
                @error('stripe_secret_key')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Your Stripe secret key (starts with sk_)</p>
            </div>

            <div class="mb-6">
                <label for="stripe_webhook_secret" class="block text-sm font-medium text-gray-700 mb-2">Stripe Webhook Secret</label>
                <input type="password" name="stripe_webhook_secret" id="stripe_webhook_secret"
                       class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary"
                       value="{{ old('stripe_webhook_secret', $stripeWebhookSecret) }}"
                       placeholder="whsec_...">
                @error('stripe_webhook_secret')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Your Stripe webhook signing secret (starts with whsec_)</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-none p-4 mb-6">
                <h3 class="text-sm font-semibold text-blue-900 mb-2">How to get your Stripe keys:</h3>
                <ol class="text-sm text-blue-800 list-decimal list-inside space-y-1">
                    <li>Log in to your <a href="https://dashboard.stripe.com" target="_blank" class="underline">Stripe Dashboard</a></li>
                    <li>Go to Developers → API keys</li>
                    <li>Copy your Publishable key and Secret key</li>
                    <li>For webhooks, go to Developers → Webhooks and create an endpoint pointing to: <code class="bg-blue-100 px-1">{{ url('/webhooks/stripe') }}</code></li>
                </ol>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
