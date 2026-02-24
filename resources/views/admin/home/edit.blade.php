@extends('layouts.admin')

@section('title', 'Home Page Content')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Home Page Content</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-none mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.home.update') }}" enctype="multipart/form-data" data-turbo="false">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-none shadow p-8 mb-6">
            <p class="text-sm text-gray-500 mb-6">Edit the text and labels shown on the front-end home page. Leave blank to use the default.</p>

            <div class="space-y-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Hero Section</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="home_hero_title" class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
                        <input type="text" name="home_hero_title" id="home_hero_title" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_hero_title', $homeHeroTitle ?? '') }}" placeholder="Professional Training Services">
                    </div>
                    <div class="md:col-span-2">
                        <label for="home_hero_subtitle" class="block text-sm font-medium text-gray-700 mb-2">Hero Subtitle</label>
                        <input type="text" name="home_hero_subtitle" id="home_hero_subtitle" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_hero_subtitle', $homeHeroSubtitle ?? '') }}" placeholder="Enhance your skills with our expert-led courses...">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hero Background Image</label>
                        @if(!empty($heroBackgroundUrl))
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-2">Current image:</p>
                            <img src="{{ $heroBackgroundUrl }}" alt="Current hero background" class="max-w-full h-40 object-cover border border-gray-300 rounded-none">
                        </div>
                        @endif
                        <input type="file" name="home_hero_background_image" id="home_hero_background_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary">
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF or WebP. Max 5 MB. Upload a new image to replace the current one.</p>
                        <p class="text-xs text-gray-500 mt-2">Or use a path below (e.g. images/cover.png) to use an existing file from the public folder.</p>
                        <input type="text" name="home_hero_background" id="home_hero_background" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary mt-2" value="{{ old('home_hero_background', $homeHeroBackground ?? 'images/cover.png') }}" placeholder="images/cover.png">
                        <p class="text-xs text-gray-500 mt-1">Path relative to public folder. Leave as is if you uploaded an image above.</p>
                        @error('home_hero_background_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="home_hero_btn_primary" class="block text-sm font-medium text-gray-700 mb-2">Primary Button Text</label>
                        <input type="text" name="home_hero_btn_primary" id="home_hero_btn_primary" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_hero_btn_primary', $homeHeroBtnPrimary ?? '') }}" placeholder="View Training Courses">
                    </div>
                    <div>
                        <label for="home_hero_btn_secondary" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Text</label>
                        <input type="text" name="home_hero_btn_secondary" id="home_hero_btn_secondary" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_hero_btn_secondary', $homeHeroBtnSecondary ?? '') }}" placeholder="Book a Class">
                    </div>
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Welcome / Intro Section</h3>
                <div>
                    <label for="home_intro_heading" class="block text-sm font-medium text-gray-700 mb-2">Intro Heading</label>
                    <input type="text" name="home_intro_heading" id="home_intro_heading" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_intro_heading', $homeIntroHeading ?? '') }}" placeholder="Welcome to Texas Training Group">
                </div>
                <div>
                    <label for="home_intro_content" class="block text-sm font-medium text-gray-700 mb-2">Intro Content</label>
                    <textarea name="home_intro_content" id="home_intro_content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" placeholder="Welcome text and description...">{{ old('home_intro_content', $homeIntroContent ?? '') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Rich text: you can format text, add links and images.</p>
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Feature Cards (3)</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border border-gray-200 rounded-none p-4">
                        <label for="home_feature_1_title" class="block text-sm font-medium text-gray-700 mb-2">Feature 1 Title</label>
                        <input type="text" name="home_feature_1_title" id="home_feature_1_title" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary mb-2" value="{{ old('home_feature_1_title', $homeFeature1Title ?? '') }}" placeholder="Expert Instructors">
                        <label for="home_feature_1_text" class="block text-sm font-medium text-gray-700 mb-2">Feature 1 Text</label>
                        <input type="text" name="home_feature_1_text" id="home_feature_1_text" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_feature_1_text', $homeFeature1Text ?? '') }}" placeholder="Learn from industry professionals...">
                    </div>
                    <div class="border border-gray-200 rounded-none p-4">
                        <label for="home_feature_2_title" class="block text-sm font-medium text-gray-700 mb-2">Feature 2 Title</label>
                        <input type="text" name="home_feature_2_title" id="home_feature_2_title" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary mb-2" value="{{ old('home_feature_2_title', $homeFeature2Title ?? '') }}" placeholder="Certified Programs">
                        <label for="home_feature_2_text" class="block text-sm font-medium text-gray-700 mb-2">Feature 2 Text</label>
                        <input type="text" name="home_feature_2_text" id="home_feature_2_text" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_feature_2_text', $homeFeature2Text ?? '') }}" placeholder="Earn recognized certifications...">
                    </div>
                    <div class="border border-gray-200 rounded-none p-4">
                        <label for="home_feature_3_title" class="block text-sm font-medium text-gray-700 mb-2">Feature 3 Title</label>
                        <input type="text" name="home_feature_3_title" id="home_feature_3_title" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary mb-2" value="{{ old('home_feature_3_title', $homeFeature3Title ?? '') }}" placeholder="Flexible Scheduling">
                        <label for="home_feature_3_text" class="block text-sm font-medium text-gray-700 mb-2">Feature 3 Text</label>
                        <input type="text" name="home_feature_3_text" id="home_feature_3_text" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_feature_3_text', $homeFeature3Text ?? '') }}" placeholder="Choose from various dates...">
                    </div>
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Courses Section</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="home_courses_heading" class="block text-sm font-medium text-gray-700 mb-2">Section Heading</label>
                        <input type="text" name="home_courses_heading" id="home_courses_heading" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_courses_heading', $homeCoursesHeading ?? '') }}" placeholder="Upcoming Training Courses">
                    </div>
                    <div>
                        <label for="home_courses_subtext" class="block text-sm font-medium text-gray-700 mb-2">Section Subtext</label>
                        <input type="text" name="home_courses_subtext" id="home_courses_subtext" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_courses_subtext', $homeCoursesSubtext ?? '') }}" placeholder="Browse our schedule...">
                    </div>
                    <div class="md:col-span-2">
                        <label for="home_courses_empty_text" class="block text-sm font-medium text-gray-700 mb-2">Empty State Text (when no courses)</label>
                        <textarea name="home_courses_empty_text" id="home_courses_empty_text" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" placeholder="New courses are being added regularly...">{{ old('home_courses_empty_text', $homeCoursesEmptyText ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="home_courses_btn_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" name="home_courses_btn_text" id="home_courses_btn_text" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_courses_btn_text', $homeCoursesBtnText ?? '') }}" placeholder="View All Courses">
                    </div>
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Team Section</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="home_team_heading" class="block text-sm font-medium text-gray-700 mb-2">Section Heading</label>
                        <input type="text" name="home_team_heading" id="home_team_heading" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_team_heading', $homeTeamHeading ?? '') }}" placeholder="Meet Our Team">
                    </div>
                    <div>
                        <label for="home_team_subtext" class="block text-sm font-medium text-gray-700 mb-2">Section Subtext</label>
                        <input type="text" name="home_team_subtext" id="home_team_subtext" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_team_subtext', $homeTeamSubtext ?? '') }}" placeholder="The people behind Texas Training Group">
                    </div>
                    <div>
                        <label for="home_team_btn_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" name="home_team_btn_text" id="home_team_btn_text" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_team_btn_text', $homeTeamBtnText ?? '') }}" placeholder="About Us">
                    </div>
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Call to Action (Bottom)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="home_cta_heading" class="block text-sm font-medium text-gray-700 mb-2">CTA Heading</label>
                        <input type="text" name="home_cta_heading" id="home_cta_heading" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_cta_heading', $homeCtaHeading ?? '') }}" placeholder="Ready to Get Started?">
                    </div>
                    <div class="md:col-span-2">
                        <label for="home_cta_subtext" class="block text-sm font-medium text-gray-700 mb-2">CTA Subtext</label>
                        <input type="text" name="home_cta_subtext" id="home_cta_subtext" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_cta_subtext', $homeCtaSubtext ?? '') }}" placeholder="Join our training programs today...">
                    </div>
                    <div>
                        <label for="home_cta_btn_primary" class="block text-sm font-medium text-gray-700 mb-2">Primary Button Text</label>
                        <input type="text" name="home_cta_btn_primary" id="home_cta_btn_primary" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_cta_btn_primary', $homeCtaBtnPrimary ?? '') }}" placeholder="Browse Courses">
                    </div>
                    <div>
                        <label for="home_cta_btn_secondary" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Text</label>
                        <input type="text" name="home_cta_btn_secondary" id="home_cta_btn_secondary" class="w-full px-3 py-2 border border-gray-300 rounded-none focus:outline-none focus:ring-2 focus:ring-brand-primary" value="{{ old('home_cta_btn_secondary', $homeCtaBtnSecondary ?? '') }}" placeholder="Contact Us">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-brand-primary text-white px-6 py-2 rounded-none hover:bg-brand-dark">
                    Save Home Page Content
                </button>
            </div>
        </div>
    </form>
</div>
@push('js')
<script>
(function() {
    var editorId = 'home_intro_content';
    var ckfinderBase = '{{ asset("ckfinder/ckfinder.html") }}';
    var ckfinderImg = '{{ asset("ckfinder/ckfinder.html?type=Images") }}';
    var connector = '{{ asset("ckfinder/core/connector/php/connector.php") }}';
    function initCK() {
        if (typeof CKEDITOR === 'undefined') return false;
        var el = document.getElementById(editorId);
        if (!el || CKEDITOR.instances[editorId]) return !!CKEDITOR.instances[editorId];
        try {
            CKEDITOR.replace(editorId, { height: '300px', filebrowserBrowseUrl: ckfinderBase, filebrowserImageBrowseUrl: ckfinderImg, filebrowserUploadUrl: connector + '?command=QuickUpload&type=Files', filebrowserImageUploadUrl: connector + '?command=QuickUpload&type=Images' });
            return true;
        } catch (e) { return false; }
    }
    function bindSubmit() {
        var form = document.querySelector('form');
        if (!form || form._ckBound) return;
        form._ckBound = true;
        form.addEventListener('submit', function() {
            if (typeof CKEDITOR !== 'undefined') { for (var k in CKEDITOR.instances) { if (CKEDITOR.instances[k]) CKEDITOR.instances[k].updateElement(); } }
        });
    }
    function run() { initCK(); bindSubmit(); }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() { run(); var n = 0; var t = setInterval(function() { if (initCK() || ++n > 20) clearInterval(t); }, 100); });
    } else { run(); var n = 0; var t = setInterval(function() { if (initCK() || ++n > 20) clearInterval(t); }, 100); }
    window.addEventListener('load', run);
})();
</script>
@endpush
@endsection
