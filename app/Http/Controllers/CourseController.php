<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->where('status', 'upcoming')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->paginate(12);

        return view('courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        if (!$course->canBeBooked()) {
            abort(404);
        }

        return view('courses.show', compact('course'));
    }
}
