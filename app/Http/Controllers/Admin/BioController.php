<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BioController extends Controller
{
    public function index()
    {
        $bios = Bio::all();
        return view('admin.bios.index', compact('bios'));
    }

    public function edit(Bio $bio)
    {
        return view('admin.bios.edit', compact('bio'));
    }

    public function update(Request $request, Bio $bio)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'credentials' => 'nullable|string',
            'experience' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($bio->photo && Storage::disk('public')->exists($bio->photo)) {
                Storage::disk('public')->delete($bio->photo);
            }
            $validated['photo'] = $request->file('photo')->store('bios', 'public');
        } else {
            unset($validated['photo']);
        }

        $bio->update($validated);

        return redirect()->route('admin.bios.index')
            ->with('success', 'Bio updated successfully.');
    }
}
