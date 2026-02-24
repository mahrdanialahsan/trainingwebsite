<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function edit()
    {
        $homeHeroTitle = Setting::get('home_hero_title', '');
        $homeHeroSubtitle = Setting::get('home_hero_subtitle', '');
        $homeHeroBackground = Setting::get('home_hero_background', 'images/cover.png');
        $homeHeroBtnPrimary = Setting::get('home_hero_btn_primary', '');
        $homeHeroBtnSecondary = Setting::get('home_hero_btn_secondary', '');
        $homeIntroHeading = Setting::get('home_intro_heading', '');
        $homeIntroContent = Setting::get('home_intro_content', '');
        if ($homeIntroContent === '' || $homeIntroContent === null) {
            $p1 = Setting::get('home_intro_paragraph_1', '');
            $p2 = Setting::get('home_intro_paragraph_2', '');
            if ($p1 || $p2) {
                $homeIntroContent = '<p>' . e($p1) . '</p>';
                if ($p2) {
                    $homeIntroContent .= '<p>' . e($p2) . '</p>';
                }
            }
        }
        $homeFeature1Title = Setting::get('home_feature_1_title', '');
        $homeFeature1Text = Setting::get('home_feature_1_text', '');
        $homeFeature2Title = Setting::get('home_feature_2_title', '');
        $homeFeature2Text = Setting::get('home_feature_2_text', '');
        $homeFeature3Title = Setting::get('home_feature_3_title', '');
        $homeFeature3Text = Setting::get('home_feature_3_text', '');
        $homeCoursesHeading = Setting::get('home_courses_heading', '');
        $homeCoursesSubtext = Setting::get('home_courses_subtext', '');
        $homeCoursesEmptyText = Setting::get('home_courses_empty_text', '');
        $homeCoursesBtnText = Setting::get('home_courses_btn_text', '');
        $homeTeamHeading = Setting::get('home_team_heading', '');
        $homeTeamSubtext = Setting::get('home_team_subtext', '');
        $homeTeamBtnText = Setting::get('home_team_btn_text', '');
        $homeCtaHeading = Setting::get('home_cta_heading', '');
        $homeCtaSubtext = Setting::get('home_cta_subtext', '');
        $homeCtaBtnPrimary = Setting::get('home_cta_btn_primary', '');
        $homeCtaBtnSecondary = Setting::get('home_cta_btn_secondary', '');

        $heroBackgroundUrl = $homeHeroBackground
            ? (str_starts_with($homeHeroBackground, 'home/') ? asset('storage/' . $homeHeroBackground) : asset($homeHeroBackground))
            : null;

        return view('admin.home.edit', compact(
            'homeHeroTitle', 'homeHeroSubtitle', 'homeHeroBackground', 'heroBackgroundUrl', 'homeHeroBtnPrimary', 'homeHeroBtnSecondary',
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
            'home_hero_title' => 'nullable|string|max:255',
            'home_hero_subtitle' => 'nullable|string|max:500',
            'home_hero_background' => 'nullable|string|max:255',
            'home_hero_background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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

        $currentHeroPath = Setting::get('home_hero_background', 'images/cover.png');

        if ($request->hasFile('home_hero_background_image')) {
            if ($currentHeroPath && str_starts_with($currentHeroPath, 'home/') && Storage::disk('public')->exists($currentHeroPath)) {
                Storage::disk('public')->delete($currentHeroPath);
            }
            $path = $request->file('home_hero_background_image')->store('home', 'public');
            Setting::set('home_hero_background', $path, 'text', 'Home hero background image path');
        } else {
            Setting::set('home_hero_background', $validated['home_hero_background'] ?? 'images/cover.png', 'text', 'Home hero background image path');
        }

        Setting::set('home_hero_title', $validated['home_hero_title'] ?? '', 'text', 'Home hero title');
        Setting::set('home_hero_subtitle', $validated['home_hero_subtitle'] ?? '', 'text', 'Home hero subtitle');
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

        return redirect()->route('admin.home.edit')
            ->with('success', 'Home page content updated successfully.');
    }
}
