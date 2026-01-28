<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultingSection;
use Illuminate\Http\Request;

class ConsultingSectionController extends Controller
{
    public function index()
    {
        $sections = ConsultingSection::orderBy('section_type')->orderBy('order')->paginate(20);
        return view('admin.consulting-sections.index', compact('sections'));
    }

    public function create()
    {
        $sectionTypes = [
            'hero' => 'Hero Section',
            'overview' => 'Overview Section',
            'services' => 'Services Section',
            'approach' => 'Our Approach',
            'benefits' => 'Benefits Section',
            'cta' => 'Call to Action',
        ];
        return view('admin.consulting-sections.create', compact('sectionTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_type' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'items' => 'nullable|array',
        ]);

        $additionalData = [];
        if ($request->has('items') && is_array($request->items)) {
            $additionalData['items'] = array_filter($request->items);
        }
        $validated['additional_data'] = !empty($additionalData) ? $additionalData : null;

        ConsultingSection::create($validated);

        return redirect()->route('admin.consulting-sections.index')
            ->with('success', 'Consulting section created successfully.');
    }

    public function show(ConsultingSection $consultingSection)
    {
        return view('admin.consulting-sections.show', compact('consultingSection'));
    }

    public function edit(ConsultingSection $consultingSection)
    {
        $sectionTypes = [
            'hero' => 'Hero Section',
            'overview' => 'Overview Section',
            'services' => 'Services Section',
            'approach' => 'Our Approach',
            'benefits' => 'Benefits Section',
            'cta' => 'Call to Action',
        ];
        return view('admin.consulting-sections.edit', compact('consultingSection', 'sectionTypes'));
    }

    public function update(Request $request, ConsultingSection $consultingSection)
    {
        $validated = $request->validate([
            'section_type' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'items' => 'nullable|array',
        ]);

        $additionalData = [];
        if ($request->has('items') && is_array($request->items)) {
            $additionalData['items'] = array_filter($request->items);
        }
        $validated['additional_data'] = !empty($additionalData) ? $additionalData : null;

        $consultingSection->update($validated);

        return redirect()->route('admin.consulting-sections.index')
            ->with('success', 'Consulting section updated successfully.');
    }

    public function destroy(ConsultingSection $consultingSection)
    {
        $consultingSection->delete();

        return redirect()->route('admin.consulting-sections.index')
            ->with('success', 'Consulting section deleted successfully.');
    }
}
