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
        $contactEmail = Setting::get('contact_email', $systemEmail);
        
        // Social Media Links
        $socialFacebook = Setting::get('social_facebook', '');
        $socialInstagram = Setting::get('social_instagram', '');
        $socialYoutube = Setting::get('social_youtube', '');
        $socialTwitter = Setting::get('social_twitter', '');
        $socialLinkedin = Setting::get('social_linkedin', '');

        // Home Page Content
        $homeHeroTitle = Setting::get('home_hero_title', 'Professional Training Services');
        $homeHeroSubtitle = Setting::get('home_hero_subtitle', 'Enhance your skills with our expert-led courses and comprehensive training programs');
        $homeHeroBackground = Setting::get('home_hero_background', 'images/cover.png');
        $homeHeroBtnPrimary = Setting::get('home_hero_btn_primary', 'View Training Courses');
        $homeHeroBtnSecondary = Setting::get('home_hero_btn_secondary', 'Book a Class');
        $homeIntroHeading = Setting::get('home_intro_heading', 'Welcome to Texas Training Group');
        $homeIntroContent = Setting::get('home_intro_content', '');
        if ($homeIntroContent === '' || $homeIntroContent === null) {
            $p1 = Setting::get('home_intro_paragraph_1', '');
            $p2 = Setting::get('home_intro_paragraph_2', '');
            if ($p1 || $p2) {
                $homeIntroContent = '<p>' . e($p1) . '</p>' . ($p2 ? '<p>' . e($p2) . '</p>' : '');
            }
        }
        $homeFeature1Title = Setting::get('home_feature_1_title', 'Expert Instructors');
        $homeFeature1Text = Setting::get('home_feature_1_text', 'Learn from industry professionals with years of hands-on experience');
        $homeFeature2Title = Setting::get('home_feature_2_title', 'Certified Programs');
        $homeFeature2Text = Setting::get('home_feature_2_text', 'Earn recognized certifications that boost your career prospects');
        $homeFeature3Title = Setting::get('home_feature_3_title', 'Flexible Scheduling');
        $homeFeature3Text = Setting::get('home_feature_3_text', 'Choose from various dates and times that fit your schedule');
        $homeCoursesHeading = Setting::get('home_courses_heading', 'Upcoming Training Courses');
        $homeCoursesSubtext = Setting::get('home_courses_subtext', 'Browse our schedule and find the perfect course for you');
        $homeCoursesEmptyText = Setting::get('home_courses_empty_text', 'New courses are being added regularly. Check back soon for upcoming training sessions.');
        $homeCoursesBtnText = Setting::get('home_courses_btn_text', 'View All Courses');
        $homeTeamHeading = Setting::get('home_team_heading', 'Meet Our Team');
        $homeTeamSubtext = Setting::get('home_team_subtext', 'The people behind Texas Training Group');
        $homeTeamBtnText = Setting::get('home_team_btn_text', 'About Us');
        $homeCtaHeading = Setting::get('home_cta_heading', 'Ready to Get Started?');
        $homeCtaSubtext = Setting::get('home_cta_subtext', 'Join our training programs today and take the next step in your career');
        $homeCtaBtnPrimary = Setting::get('home_cta_btn_primary', 'Browse Courses');
        $homeCtaBtnSecondary = Setting::get('home_cta_btn_secondary', 'Contact Us');

        return view('admin.settings.index', compact(
            'stripePublicKey', 'stripeSecretKey', 'stripeWebhookSecret',
            'tagline', 'systemEmail', 'phoneNumber', 'contactEmail',
            'socialFacebook', 'socialInstagram', 'socialYoutube', 'socialTwitter', 'socialLinkedin',
            'homeHeroTitle', 'homeHeroSubtitle', 'homeHeroBackground', 'homeHeroBtnPrimary', 'homeHeroBtnSecondary',
            'homeIntroHeading', 'homeIntroContent',
            'homeFeature1Title', 'homeFeature1Text', 'homeFeature2Title', 'homeFeature2Text', 'homeFeature3Title', 'homeFeature3Text',
            'homeCoursesHeading', 'homeCoursesSubtext', 'homeCoursesEmptyText', 'homeCoursesBtnText',
            'homeTeamHeading', 'homeTeamSubtext', 'homeTeamBtnText',
            'homeCtaHeading', 'homeCtaSubtext', 'homeCtaBtnPrimary', 'homeCtaBtnSecondary'
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
            'contact_email' => 'nullable|email|max:255',
            // Social Media Links
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            // Home Page Content
            'home_hero_title' => 'nullable|string|max:255',
            'home_hero_subtitle' => 'nullable|string|max:500',
            'home_hero_background' => 'nullable|string|max:255',
            'home_hero_btn_primary' => 'nullable|string|max:100',
            'home_hero_btn_secondary' => 'nullable|string|max:100',
            'home_intro_heading' => 'nullable|string|max:255',
            'home_intro_content' => 'nullable|string',
            'home_feature_1_title' => 'nullable|string|max:255',
            'home_feature_1_text' => 'nullable|string|max:500',
            'home_feature_2_title' => 'nullable|string|max:255',
            'home_feature_2_text' => 'nullable|string|max:500',
            'home_feature_3_title' => 'nullable|string|max:255',
            'home_feature_3_text' => 'nullable|string|max:500',
            'home_courses_heading' => 'nullable|string|max:255',
            'home_courses_subtext' => 'nullable|string|max:500',
            'home_courses_empty_text' => 'nullable|string|max:1000',
            'home_courses_btn_text' => 'nullable|string|max:100',
            'home_team_heading' => 'nullable|string|max:255',
            'home_team_subtext' => 'nullable|string|max:500',
            'home_team_btn_text' => 'nullable|string|max:100',
            'home_cta_heading' => 'nullable|string|max:255',
            'home_cta_subtext' => 'nullable|string|max:500',
            'home_cta_btn_primary' => 'nullable|string|max:100',
            'home_cta_btn_secondary' => 'nullable|string|max:100',
        ]);

        // Payment Settings
        Setting::set('stripe_public_key', $validated['stripe_public_key'] ?? '', 'password', 'Stripe Publishable Key');
        Setting::set('stripe_secret_key', $validated['stripe_secret_key'] ?? '', 'password', 'Stripe Secret Key');
        Setting::set('stripe_webhook_secret', $validated['stripe_webhook_secret'] ?? '', 'password', 'Stripe Webhook Secret');
        
        // General Settings
        Setting::set('tagline', $validated['tagline'] ?? '', 'text', 'Company Tagline');
        Setting::set('system_email', $validated['system_email'] ?? '', 'email', 'System Email Address');
        Setting::set('phone_number', $validated['phone_number'] ?? '', 'text', 'Phone Number');
        Setting::set('contact_email', $validated['contact_email'] ?? '', 'email', 'Contact Form Email Address');
        
        // Social Media Links
        Setting::set('social_facebook', $validated['social_facebook'] ?? '', 'url', 'Facebook Page URL');
        Setting::set('social_instagram', $validated['social_instagram'] ?? '', 'url', 'Instagram Profile URL');
        Setting::set('social_youtube', $validated['social_youtube'] ?? '', 'url', 'YouTube Channel URL');
        Setting::set('social_twitter', $validated['social_twitter'] ?? '', 'url', 'Twitter Profile URL');
        Setting::set('social_linkedin', $validated['social_linkedin'] ?? '', 'url', 'LinkedIn Company Page URL');

        // Home Page Content
        Setting::set('home_hero_title', $validated['home_hero_title'] ?? '', 'text', 'Home hero title');
        Setting::set('home_hero_subtitle', $validated['home_hero_subtitle'] ?? '', 'text', 'Home hero subtitle');
        Setting::set('home_hero_background', $validated['home_hero_background'] ?? 'images/cover.png', 'text', 'Home hero background image path');
        Setting::set('home_hero_btn_primary', $validated['home_hero_btn_primary'] ?? '', 'text', 'Home hero primary button text');
        Setting::set('home_hero_btn_secondary', $validated['home_hero_btn_secondary'] ?? '', 'text', 'Home hero secondary button text');
        Setting::set('home_intro_heading', $validated['home_intro_heading'] ?? '', 'text', 'Home intro heading');
        Setting::set('home_intro_content', $validated['home_intro_content'] ?? '', 'textarea', 'Home intro content (rich text)');
        Setting::set('home_feature_1_title', $validated['home_feature_1_title'] ?? '', 'text', 'Home feature 1 title');
        Setting::set('home_feature_1_text', $validated['home_feature_1_text'] ?? '', 'text', 'Home feature 1 text');
        Setting::set('home_feature_2_title', $validated['home_feature_2_title'] ?? '', 'text', 'Home feature 2 title');
        Setting::set('home_feature_2_text', $validated['home_feature_2_text'] ?? '', 'text', 'Home feature 2 text');
        Setting::set('home_feature_3_title', $validated['home_feature_3_title'] ?? '', 'text', 'Home feature 3 title');
        Setting::set('home_feature_3_text', $validated['home_feature_3_text'] ?? '', 'text', 'Home feature 3 text');
        Setting::set('home_courses_heading', $validated['home_courses_heading'] ?? '', 'text', 'Home courses section heading');
        Setting::set('home_courses_subtext', $validated['home_courses_subtext'] ?? '', 'text', 'Home courses section subtext');
        Setting::set('home_courses_empty_text', $validated['home_courses_empty_text'] ?? '', 'textarea', 'Home courses empty state text');
        Setting::set('home_courses_btn_text', $validated['home_courses_btn_text'] ?? '', 'text', 'Home courses button text');
        Setting::set('home_team_heading', $validated['home_team_heading'] ?? '', 'text', 'Home team section heading');
        Setting::set('home_team_subtext', $validated['home_team_subtext'] ?? '', 'text', 'Home team section subtext');
        Setting::set('home_team_btn_text', $validated['home_team_btn_text'] ?? '', 'text', 'Home team button text');
        Setting::set('home_cta_heading', $validated['home_cta_heading'] ?? '', 'text', 'Home CTA heading');
        Setting::set('home_cta_subtext', $validated['home_cta_subtext'] ?? '', 'text', 'Home CTA subtext');
        Setting::set('home_cta_btn_primary', $validated['home_cta_btn_primary'] ?? '', 'text', 'Home CTA primary button');
        Setting::set('home_cta_btn_secondary', $validated['home_cta_btn_secondary'] ?? '', 'text', 'Home CTA secondary button');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
