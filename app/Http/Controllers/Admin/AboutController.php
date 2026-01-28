<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $sections = AboutSection::orderBy('section_type')->orderBy('order')->paginate(20);
        return view('admin.about.index', compact('sections'));
    }

    public function create()
    {
        $sectionTypes = [
            'hero' => 'Hero/Introduction',
            'what_we_offer' => 'What We Offer',
            'who_we_are' => 'Who We Are',
            'training_safety' => 'Training Means Safety',
            'why_choose_us' => 'Why Choose Us',
        ];
        return view('admin.about.create', compact('sectionTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_type' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'required|in:image,video',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'items' => 'nullable|array', // For lists/features
            'subtitle' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('about-sections', 'public');
        }

        if (!empty($request->video_url)) {
            $validated['video_path'] = $request->video_url;
        }

        $additionalData = [];
        if ($request->has('items') && is_array($request->items)) {
            $additionalData['items'] = array_filter($request->items);
        }
        if ($request->has('subtitle') && !empty($request->subtitle)) {
            $additionalData['subtitle'] = $request->subtitle;
        }
        $validated['additional_data'] = !empty($additionalData) ? $additionalData : null;

        AboutSection::create($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'About section created successfully.');
    }

    public function show(AboutSection $about)
    {
        return view('admin.about.show', compact('about'));
    }

    public function edit(AboutSection $about)
    {
        $sectionTypes = [
            'hero' => 'Hero/Introduction',
            'what_we_offer' => 'What We Offer',
            'who_we_are' => 'Who We Are',
            'training_safety' => 'Training Means Safety',
            'why_choose_us' => 'Why Choose Us',
        ];
        return view('admin.about.edit', compact('about', 'sectionTypes'));
    }

    public function update(Request $request, AboutSection $about)
    {
        $validated = $request->validate([
            'section_type' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'required|in:image,video',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'items' => 'nullable|array',
            'subtitle' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image_path && Storage::disk('public')->exists($about->image_path)) {
                Storage::disk('public')->delete($about->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('about-sections', 'public');
        } else {
            // Keep existing image if no new one is uploaded
            $validated['image_path'] = $about->image_path;
        }

        if (!empty($request->video_url)) {
            // If there was a stored file (not a URL), delete it
            if ($about->video_path && !str_starts_with($about->video_path, 'http://') && !str_starts_with($about->video_path, 'https://')) {
                if (Storage::disk('public')->exists($about->video_path)) {
                    Storage::disk('public')->delete($about->video_path);
                }
            }
            $validated['video_path'] = $request->video_url;
        } elseif ($request->has('video_url') && empty($request->video_url)) {
            // Clear video_path if video_url is empty
            if ($about->video_path && !str_starts_with($about->video_path, 'http://') && !str_starts_with($about->video_path, 'https://')) {
                if (Storage::disk('public')->exists($about->video_path)) {
                    Storage::disk('public')->delete($about->video_path);
                }
            }
            $validated['video_path'] = null;
        } else {
            // Keep existing video_path if no new URL is provided
            $validated['video_path'] = $about->video_path;
        }

        $additionalData = [];
        if ($request->has('items') && is_array($request->items)) {
            $additionalData['items'] = array_filter($request->items);
        }
        if ($request->has('subtitle') && !empty($request->subtitle)) {
            $additionalData['subtitle'] = $request->subtitle;
        } elseif ($about->additional_data && isset($about->additional_data['subtitle'])) {
            // Keep existing subtitle if not provided
            $additionalData['subtitle'] = $about->additional_data['subtitle'];
        }
        $validated['additional_data'] = !empty($additionalData) ? $additionalData : null;

        $about->update($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutSection $about)
    {
        if ($about->image_path && Storage::disk('public')->exists($about->image_path)) {
            Storage::disk('public')->delete($about->image_path);
        }
        // Only delete video_path if it's a file, not a URL
        if ($about->video_path && !str_starts_with($about->video_path, 'http://') && !str_starts_with($about->video_path, 'https://')) {
            if (Storage::disk('public')->exists($about->video_path)) {
                Storage::disk('public')->delete($about->video_path);
            }
        }
        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'About section deleted successfully.');
    }
}
