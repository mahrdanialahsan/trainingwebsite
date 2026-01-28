<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Payment Settings
        Setting::set('stripe_public_key', '', 'password', 'Stripe Publishable Key');
        Setting::set('stripe_secret_key', '', 'password', 'Stripe Secret Key');
        Setting::set('stripe_webhook_secret', '', 'password', 'Stripe Webhook Secret');
        
        // General Settings
        Setting::set('tagline', 'Professional training and consulting services.', 'text', 'Company Tagline');
        Setting::set('system_email', 'info@training.com', 'email', 'System Email Address');
        Setting::set('phone_number', '(555) 123-4567', 'text', 'Phone Number');
        
        // Social Media Links
        Setting::set('social_facebook', '', 'url', 'Facebook Page URL');
        Setting::set('social_instagram', '', 'url', 'Instagram Profile URL');
        Setting::set('social_youtube', '', 'url', 'YouTube Channel URL');
        Setting::set('social_twitter', '', 'url', 'Twitter Profile URL');
        Setting::set('social_linkedin', '', 'url', 'LinkedIn Company Page URL');
    }
}
