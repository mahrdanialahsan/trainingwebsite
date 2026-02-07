<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use HotwiredLaravel\TurboLaravel\Facades\TurboStream;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:upcoming,active,completed,cancelled',
            'is_active' => 'boolean',
        ], [
            'thumbnail_image.image' => 'The file must be an image.',
            'thumbnail_image.max' => 'The image may not be greater than 5 MB.',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('courses', 'public');
        } else {
            $validated['thumbnail_image'] = null;
        }

        $course = Course::create($validated);

        // Support Turbo Stream responses
        if (request()->wantsTurboStream()) {
            return TurboStream::response()
                ->append('courses-table-body', view('admin.courses._course_row', compact('course')))
                ->append('flash-messages', view('components.flash-message', [
                    'type' => 'success',
                    'message' => 'Course created successfully.'
                ]));
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('bookings');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_thumbnail' => 'nullable|boolean',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:upcoming,active,completed,cancelled',
            'is_active' => 'boolean',
        ], [
            'thumbnail_image.image' => 'The file must be an image.',
            'thumbnail_image.max' => 'The image may not be greater than 5 MB.',
        ]);

        // Auto-generate slug if not provided and title changed
        if (empty($validated['slug']) && $course->title !== $validated['title']) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        if ($request->boolean('remove_thumbnail')) {
            if ($course->thumbnail_image && str_starts_with($course->thumbnail_image, 'courses/') && Storage::disk('public')->exists($course->thumbnail_image)) {
                Storage::disk('public')->delete($course->thumbnail_image);
            }
            $validated['thumbnail_image'] = null;
        } elseif ($request->hasFile('thumbnail_image')) {
            if ($course->thumbnail_image && str_starts_with($course->thumbnail_image, 'courses/') && Storage::disk('public')->exists($course->thumbnail_image)) {
                Storage::disk('public')->delete($course->thumbnail_image);
            }
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('courses', 'public');
        } else {
            $validated['thumbnail_image'] = $course->thumbnail_image;
        }

        unset($validated['remove_thumbnail']);
        $course->update($validated);

        // Support Turbo Stream responses
        if (request()->wantsTurboStream()) {
            return TurboStream::response()
                ->replace("course-{$course->id}", view('admin.courses._course_row', compact('course')))
                ->append('flash-messages', view('components.flash-message', [
                    'type' => 'success',
                    'message' => 'Course updated successfully.'
                ]));
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $courseId = $course->id;
        if ($course->thumbnail_image && str_starts_with($course->thumbnail_image, 'courses/') && Storage::disk('public')->exists($course->thumbnail_image)) {
            Storage::disk('public')->delete($course->thumbnail_image);
        }
        $course->delete();

        // Support Turbo Stream responses
        if (request()->wantsTurboStream()) {
            return TurboStream::response()
                ->remove("course-{$courseId}")
                ->append('flash-messages', view('components.flash-message', [
                    'type' => 'success',
                    'message' => 'Course deleted successfully.'
                ]));
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
