<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingFacility;
use App\Models\TrainingAmenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::orderBy('order')->paginate(15);
        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        return view('admin.trainings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'about_title' => 'nullable|string',
            'about_description' => 'nullable|string',
            'download_button_text' => 'nullable|string|max:255',
            'download_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'facilities' => 'nullable|array',
            'facilities.*.title' => 'required_with:facilities|string|max:255',
            'facilities.*.description' => 'nullable|string',
            'facilities.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'facilities.*.video_url' => 'nullable|url|max:500',
            'facilities.*.media_type' => 'required_with:facilities|in:image,video',
            'facilities.*.media_position' => 'required_with:facilities|in:left,right',
            'facilities.*.order' => 'nullable|integer',
            'facilities.*.is_active' => 'boolean',
            'amenities' => 'nullable|array',
            'amenities.*.title' => 'required_with:amenities|string|max:255',
            'amenities.*.description' => 'nullable|string',
            'amenities.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'amenities.*.video_url' => 'nullable|url|max:500',
            'amenities.*.media_type' => 'required_with:amenities|in:image,video',
            'amenities.*.media_position' => 'required_with:amenities|in:left,right',
            'amenities.*.order' => 'nullable|integer',
            'amenities.*.is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('download_pdf')) {
            $validated['download_pdf_path'] = $request->file('download_pdf')->store('training-pdfs', 'public');
        }

        $training = Training::create($validated);

        // Create facilities
        if ($request->has('facilities') && is_array($request->facilities)) {
            foreach ($request->facilities as $index => $facilityData) {
                $facilityValidated = [
                    'training_id' => $training->id,
                    'title' => $facilityData['title'],
                    'description' => $facilityData['description'] ?? null,
                    'media_type' => $facilityData['media_type'],
                    'media_position' => $facilityData['media_position'],
                    'order' => $facilityData['order'] ?? $index,
                    'is_active' => isset($facilityData['is_active']) ? (bool)$facilityData['is_active'] : true,
                ];

                if ($request->hasFile("facilities.{$index}.image")) {
                    $facilityValidated['image_path'] = $request->file("facilities.{$index}.image")->store('training-facilities', 'public');
                }

                if (!empty($facilityData['video_url'])) {
                    $facilityValidated['video_path'] = $facilityData['video_url'];
                }

                TrainingFacility::create($facilityValidated);
            }
        }

        // Create amenities
        if ($request->has('amenities') && is_array($request->amenities)) {
            foreach ($request->amenities as $index => $amenityData) {
                $amenityValidated = [
                    'training_id' => $training->id,
                    'title' => $amenityData['title'],
                    'description' => $amenityData['description'] ?? null,
                    'media_type' => $amenityData['media_type'],
                    'media_position' => $amenityData['media_position'],
                    'order' => $amenityData['order'] ?? $index,
                    'is_active' => isset($amenityData['is_active']) ? (bool)$amenityData['is_active'] : true,
                ];

                if ($request->hasFile("amenities.{$index}.image")) {
                    $amenityValidated['image_path'] = $request->file("amenities.{$index}.image")->store('training-amenities', 'public');
                }

                if (!empty($amenityData['video_url'])) {
                    $amenityValidated['video_path'] = $amenityData['video_url'];
                }

                TrainingAmenity::create($amenityValidated);
            }
        }

        $message = 'Training created successfully.';
        if ($request->has('facilities') || $request->has('amenities')) {
            $message .= ' Facilities and amenities have been added.';
        }

        return redirect()->route('admin.trainings.edit', $training)
            ->with('success', $message);
    }

    public function show(Training $training)
    {
        $training->load(['facilities', 'amenities']);
        return view('admin.trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        $training->load(['facilities', 'amenities']);
        return view('admin.trainings.edit', compact('training'));
    }

    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'about_title' => 'nullable|string',
            'about_description' => 'nullable|string',
            'download_button_text' => 'nullable|string|max:255',
            'download_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'facilities' => 'nullable|array',
            'facilities.*.id' => 'nullable|exists:training_facilities,id',
            'facilities.*.title' => 'required_with:facilities|string|max:255',
            'facilities.*.description' => 'nullable|string',
            'facilities.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'facilities.*.video_url' => 'nullable|url|max:500',
            'facilities.*.media_type' => 'required_with:facilities|in:image,video',
            'facilities.*.media_position' => 'required_with:facilities|in:left,right',
            'facilities.*.order' => 'nullable|integer',
            'facilities.*.is_active' => 'boolean',
            'amenities' => 'nullable|array',
            'amenities.*.id' => 'nullable|exists:training_amenities,id',
            'amenities.*.title' => 'required_with:amenities|string|max:255',
            'amenities.*.description' => 'nullable|string',
            'amenities.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'amenities.*.video_url' => 'nullable|url|max:500',
            'amenities.*.media_type' => 'required_with:amenities|in:image,video',
            'amenities.*.media_position' => 'required_with:amenities|in:left,right',
            'amenities.*.order' => 'nullable|integer',
            'amenities.*.is_active' => 'boolean',
        ]);

        if ($request->hasFile('download_pdf')) {
            if ($training->download_pdf_path && Storage::disk('public')->exists($training->download_pdf_path)) {
                Storage::disk('public')->delete($training->download_pdf_path);
            }
            $validated['download_pdf_path'] = $request->file('download_pdf')->store('training-pdfs', 'public');
        }

        $training->update($validated);

        // Handle facilities
        $submittedFacilityIds = [];
        if ($request->has('facilities') && is_array($request->facilities)) {
            foreach ($request->facilities as $index => $facilityData) {
                $facilityValidated = [
                    'training_id' => $training->id,
                    'title' => $facilityData['title'],
                    'description' => $facilityData['description'] ?? null,
                    'media_type' => $facilityData['media_type'],
                    'media_position' => $facilityData['media_position'],
                    'order' => $facilityData['order'] ?? $index,
                    'is_active' => isset($facilityData['is_active']) ? (bool)$facilityData['is_active'] : true,
                ];

                if ($request->hasFile("facilities.{$index}.image")) {
                    $facilityValidated['image_path'] = $request->file("facilities.{$index}.image")->store('training-facilities', 'public');
                }

                if (!empty($facilityData['video_url'])) {
                    $facilityValidated['video_path'] = $facilityData['video_url'];
                }

                if (!empty($facilityData['id'])) {
                    // Update existing facility
                    $facility = TrainingFacility::find($facilityData['id']);
                    if ($facility && $facility->training_id === $training->id) {
                        // Keep existing image if no new one is uploaded
                        if (!$request->hasFile("facilities.{$index}.image") && $facility->image_path) {
                            $facilityValidated['image_path'] = $facility->image_path;
                        } else if ($request->hasFile("facilities.{$index}.image")) {
                            // Delete old image if new one is uploaded
                            if ($facility->image_path && Storage::disk('public')->exists($facility->image_path)) {
                                Storage::disk('public')->delete($facility->image_path);
                            }
                        }
                        
                        // Keep existing video if no new URL is provided and it's a URL
                        if (empty($facilityData['video_url']) && $facility->video_path && (str_starts_with($facility->video_path, 'http://') || str_starts_with($facility->video_path, 'https://'))) {
                            $facilityValidated['video_path'] = $facility->video_path;
                        } else if (!empty($facilityData['video_url'])) {
                            // Delete old video file if it was a file (not URL) and new URL is provided
                            if ($facility->video_path && !str_starts_with($facility->video_path, 'http://') && !str_starts_with($facility->video_path, 'https://')) {
                                if (Storage::disk('public')->exists($facility->video_path)) {
                                    Storage::disk('public')->delete($facility->video_path);
                                }
                            }
                        }
                        
                        $facility->update($facilityValidated);
                        $submittedFacilityIds[] = $facility->id;
                    }
                } else {
                    // Create new facility
                    $facility = TrainingFacility::create($facilityValidated);
                    $submittedFacilityIds[] = $facility->id;
                }
            }
        }

        // Delete facilities that were removed
        $existingFacilityIds = $training->facilities->pluck('id')->toArray();
        $facilitiesToDelete = array_diff($existingFacilityIds, $submittedFacilityIds);
        foreach ($facilitiesToDelete as $facilityId) {
            $facility = TrainingFacility::find($facilityId);
            if ($facility) {
                if ($facility->image_path && Storage::disk('public')->exists($facility->image_path)) {
                    Storage::disk('public')->delete($facility->image_path);
                }
                if ($facility->video_path && !str_starts_with($facility->video_path, 'http://') && !str_starts_with($facility->video_path, 'https://')) {
                    if (Storage::disk('public')->exists($facility->video_path)) {
                        Storage::disk('public')->delete($facility->video_path);
                    }
                }
                $facility->delete();
            }
        }

        // Handle amenities
        $submittedAmenityIds = [];
        if ($request->has('amenities') && is_array($request->amenities)) {
            foreach ($request->amenities as $index => $amenityData) {
                $amenityValidated = [
                    'training_id' => $training->id,
                    'title' => $amenityData['title'],
                    'description' => $amenityData['description'] ?? null,
                    'media_type' => $amenityData['media_type'],
                    'media_position' => $amenityData['media_position'],
                    'order' => $amenityData['order'] ?? $index,
                    'is_active' => isset($amenityData['is_active']) ? (bool)$amenityData['is_active'] : true,
                ];

                if ($request->hasFile("amenities.{$index}.image")) {
                    $amenityValidated['image_path'] = $request->file("amenities.{$index}.image")->store('training-amenities', 'public');
                }

                if (!empty($amenityData['video_url'])) {
                    $amenityValidated['video_path'] = $amenityData['video_url'];
                }

                if (!empty($amenityData['id'])) {
                    // Update existing amenity
                    $amenity = TrainingAmenity::find($amenityData['id']);
                    if ($amenity && $amenity->training_id === $training->id) {
                        // Keep existing image if no new one is uploaded
                        if (!$request->hasFile("amenities.{$index}.image") && $amenity->image_path) {
                            $amenityValidated['image_path'] = $amenity->image_path;
                        } else if ($request->hasFile("amenities.{$index}.image")) {
                            // Delete old image if new one is uploaded
                            if ($amenity->image_path && Storage::disk('public')->exists($amenity->image_path)) {
                                Storage::disk('public')->delete($amenity->image_path);
                            }
                        }
                        
                        // Keep existing video if no new URL is provided and it's a URL
                        if (empty($amenityData['video_url']) && $amenity->video_path && (str_starts_with($amenity->video_path, 'http://') || str_starts_with($amenity->video_path, 'https://'))) {
                            $amenityValidated['video_path'] = $amenity->video_path;
                        } else if (!empty($amenityData['video_url'])) {
                            // Delete old video file if it was a file (not URL) and new URL is provided
                            if ($amenity->video_path && !str_starts_with($amenity->video_path, 'http://') && !str_starts_with($amenity->video_path, 'https://')) {
                                if (Storage::disk('public')->exists($amenity->video_path)) {
                                    Storage::disk('public')->delete($amenity->video_path);
                                }
                            }
                        }
                        
                        $amenity->update($amenityValidated);
                        $submittedAmenityIds[] = $amenity->id;
                    }
                } else {
                    // Create new amenity
                    $amenity = TrainingAmenity::create($amenityValidated);
                    $submittedAmenityIds[] = $amenity->id;
                }
            }
        }

        // Delete amenities that were removed
        $existingAmenityIds = $training->amenities->pluck('id')->toArray();
        $amenitiesToDelete = array_diff($existingAmenityIds, $submittedAmenityIds);
        foreach ($amenitiesToDelete as $amenityId) {
            $amenity = TrainingAmenity::find($amenityId);
            if ($amenity) {
                if ($amenity->image_path && Storage::disk('public')->exists($amenity->image_path)) {
                    Storage::disk('public')->delete($amenity->image_path);
                }
                if ($amenity->video_path && !str_starts_with($amenity->video_path, 'http://') && !str_starts_with($amenity->video_path, 'https://')) {
                    if (Storage::disk('public')->exists($amenity->video_path)) {
                        Storage::disk('public')->delete($amenity->video_path);
                    }
                }
                $amenity->delete();
            }
        }

        return redirect()->route('admin.trainings.edit', $training)
            ->with('success', 'Training updated successfully.');
    }

    public function destroy(Training $training)
    {
        if ($training->download_pdf_path && Storage::disk('public')->exists($training->download_pdf_path)) {
            Storage::disk('public')->delete($training->download_pdf_path);
        }
        $training->delete();

        return redirect()->route('admin.trainings.index')
            ->with('success', 'Training deleted successfully.');
    }

    // Facility Management
    public function storeFacility(Request $request, Training $training)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'required|in:image,video',
            'media_position' => 'required|in:left,right',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('training-facilities', 'public');
        }

        if (!empty($request->video_url)) {
            $validated['video_path'] = $request->video_url;
        }

        $validated['training_id'] = $training->id;
        TrainingFacility::create($validated);

        return redirect()->back()->with('success', 'Facility added successfully.');
    }

    public function updateFacility(Request $request, Training $training, TrainingFacility $facility)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'required|in:image,video',
            'media_position' => 'required|in:left,right',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($facility->image_path && Storage::disk('public')->exists($facility->image_path)) {
                Storage::disk('public')->delete($facility->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('training-facilities', 'public');
        }

        if (!empty($request->video_url)) {
            // If there was a stored file (not a URL), delete it
            if ($facility->video_path && !str_starts_with($facility->video_path, 'http://') && !str_starts_with($facility->video_path, 'https://')) {
                if (Storage::disk('public')->exists($facility->video_path)) {
                    Storage::disk('public')->delete($facility->video_path);
                }
            }
            $validated['video_path'] = $request->video_url;
        } elseif ($request->has('video_url') && empty($request->video_url)) {
            // Clear video_path if video_url is empty
            if ($facility->video_path && !str_starts_with($facility->video_path, 'http://') && !str_starts_with($facility->video_path, 'https://')) {
                if (Storage::disk('public')->exists($facility->video_path)) {
                    Storage::disk('public')->delete($facility->video_path);
                }
            }
            $validated['video_path'] = null;
        }

        $facility->update($validated);

        return redirect()->back()->with('success', 'Facility updated successfully.');
    }

    public function destroyFacility(Training $training, TrainingFacility $facility)
    {
        if ($facility->image_path && Storage::disk('public')->exists($facility->image_path)) {
            Storage::disk('public')->delete($facility->image_path);
        }
        // Only delete video_path if it's a file, not a URL
        if ($facility->video_path && !str_starts_with($facility->video_path, 'http://') && !str_starts_with($facility->video_path, 'https://')) {
            if (Storage::disk('public')->exists($facility->video_path)) {
                Storage::disk('public')->delete($facility->video_path);
            }
        }
        $facility->delete();

        return redirect()->back()->with('success', 'Facility deleted successfully.');
    }

    // Amenity Management
    public function storeAmenity(Request $request, Training $training)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'required|in:image,video',
            'media_position' => 'required|in:left,right',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('training-amenities', 'public');
        }

        if (!empty($request->video_url)) {
            $validated['video_path'] = $request->video_url;
        }

        $validated['training_id'] = $training->id;
        TrainingAmenity::create($validated);

        return redirect()->back()->with('success', 'Amenity added successfully.');
    }

    public function updateAmenity(Request $request, Training $training, TrainingAmenity $amenity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'required|in:image,video',
            'media_position' => 'required|in:left,right',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($amenity->image_path && Storage::disk('public')->exists($amenity->image_path)) {
                Storage::disk('public')->delete($amenity->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('training-amenities', 'public');
        }

        if (!empty($request->video_url)) {
            // If there was a stored file (not a URL), delete it
            if ($amenity->video_path && !str_starts_with($amenity->video_path, 'http://') && !str_starts_with($amenity->video_path, 'https://')) {
                if (Storage::disk('public')->exists($amenity->video_path)) {
                    Storage::disk('public')->delete($amenity->video_path);
                }
            }
            $validated['video_path'] = $request->video_url;
        } elseif ($request->has('video_url') && empty($request->video_url)) {
            // Clear video_path if video_url is empty
            if ($amenity->video_path && !str_starts_with($amenity->video_path, 'http://') && !str_starts_with($amenity->video_path, 'https://')) {
                if (Storage::disk('public')->exists($amenity->video_path)) {
                    Storage::disk('public')->delete($amenity->video_path);
                }
            }
            $validated['video_path'] = null;
        }

        $amenity->update($validated);

        return redirect()->back()->with('success', 'Amenity updated successfully.');
    }

    public function destroyAmenity(Training $training, TrainingAmenity $amenity)
    {
        if ($amenity->image_path && Storage::disk('public')->exists($amenity->image_path)) {
            Storage::disk('public')->delete($amenity->image_path);
        }
        // Only delete video_path if it's a file, not a URL
        if ($amenity->video_path && !str_starts_with($amenity->video_path, 'http://') && !str_starts_with($amenity->video_path, 'https://')) {
            if (Storage::disk('public')->exists($amenity->video_path)) {
                Storage::disk('public')->delete($amenity->video_path);
            }
        }
        $amenity->delete();

        return redirect()->back()->with('success', 'Amenity deleted successfully.');
    }
}
