<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Waiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WaiverController extends Controller
{
    public function index()
    {
        $waivers = Waiver::latest()->paginate(15);
        return view('admin.waivers.index', compact('waivers'));
    }

    public function create()
    {
        return view('admin.waivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_path'] = $request->file('pdf_file')->store('waivers', 'public');
        }

        // Deactivate other waivers if this one is active
        if ($request->boolean('is_active')) {
            Waiver::where('is_active', true)->update(['is_active' => false]);
            $validated['version'] = Waiver::max('version') + 1;
        }

        Waiver::create($validated);

        return redirect()->route('admin.waivers.index')
            ->with('success', 'Waiver created successfully.');
    }

    public function show(Waiver $waiver)
    {
        return view('admin.waivers.show', compact('waiver'));
    }

    public function edit(Waiver $waiver)
    {
        return view('admin.waivers.edit', compact('waiver'));
    }

    public function update(Request $request, Waiver $waiver)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('pdf_file')) {
            if ($waiver->pdf_path) {
                Storage::disk('public')->delete($waiver->pdf_path);
            }
            $validated['pdf_path'] = $request->file('pdf_file')->store('waivers', 'public');
        }

        // Deactivate other waivers if this one is active
        if ($request->boolean('is_active') && !$waiver->is_active) {
            Waiver::where('is_active', true)->where('id', '!=', $waiver->id)->update(['is_active' => false]);
            $validated['version'] = Waiver::max('version') + 1;
        }

        $waiver->update($validated);

        return redirect()->route('admin.waivers.index')
            ->with('success', 'Waiver updated successfully.');
    }

    public function destroy(Waiver $waiver)
    {
        if ($waiver->pdf_path) {
            Storage::disk('public')->delete($waiver->pdf_path);
        }

        $waiver->delete();

        return redirect()->route('admin.waivers.index')
            ->with('success', 'Waiver deleted successfully.');
    }
}
