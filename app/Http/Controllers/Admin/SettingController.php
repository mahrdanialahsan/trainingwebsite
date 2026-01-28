<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Payment Settings
        $stripePublicKey = Setting::get('stripe_public_key', '');
        $stripeSecretKey = Setting::get('stripe_secret_key', '');
        $stripeWebhookSecret = Setting::get('stripe_webhook_secret', '');
        
        // General Settings
        $tagline = Setting::get('tagline', 'Professional training and consulting services.');
        $systemEmail = Setting::get('system_email', 'info@training.com');
        $phoneNumber = Setting::get('phone_number', '(555) 123-4567');
        
        // Social Media Links
        $socialFacebook = Setting::get('social_facebook', '');
        $socialInstagram = Setting::get('social_instagram', '');
        $socialYoutube = Setting::get('social_youtube', '');
        $socialTwitter = Setting::get('social_twitter', '');
        $socialLinkedin = Setting::get('social_linkedin', '');
        
        return view('admin.settings.index', compact(
            'stripePublicKey', 'stripeSecretKey', 'stripeWebhookSecret',
            'tagline', 'systemEmail', 'phoneNumber',
            'socialFacebook', 'socialInstagram', 'socialYoutube', 'socialTwitter', 'socialLinkedin'
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Payment Settings
            'stripe_public_key' => 'nullable|string',
            'stripe_secret_key' => 'nullable|string',
            'stripe_webhook_secret' => 'nullable|string',
            // General Settings
            'tagline' => 'nullable|string|max:255',
            'system_email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:255',
            // Social Media Links
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
        ]);

        // Payment Settings
        Setting::set('stripe_public_key', $validated['stripe_public_key'] ?? '', 'password', 'Stripe Publishable Key');
        Setting::set('stripe_secret_key', $validated['stripe_secret_key'] ?? '', 'password', 'Stripe Secret Key');
        Setting::set('stripe_webhook_secret', $validated['stripe_webhook_secret'] ?? '', 'password', 'Stripe Webhook Secret');
        
        // General Settings
        Setting::set('tagline', $validated['tagline'] ?? '', 'text', 'Company Tagline');
        Setting::set('system_email', $validated['system_email'] ?? '', 'email', 'System Email Address');
        Setting::set('phone_number', $validated['phone_number'] ?? '', 'text', 'Phone Number');
        
        // Social Media Links
        Setting::set('social_facebook', $validated['social_facebook'] ?? '', 'url', 'Facebook Page URL');
        Setting::set('social_instagram', $validated['social_instagram'] ?? '', 'url', 'Instagram Profile URL');
        Setting::set('social_youtube', $validated['social_youtube'] ?? '', 'url', 'YouTube Channel URL');
        Setting::set('social_twitter', $validated['social_twitter'] ?? '', 'url', 'Twitter Profile URL');
        Setting::set('social_linkedin', $validated['social_linkedin'] ?? '', 'url', 'LinkedIn Company Page URL');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
