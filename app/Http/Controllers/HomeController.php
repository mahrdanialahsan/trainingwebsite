<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $upcomingCourses = Course::where('is_active', true)
            ->where('status', 'upcoming')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->take(6)
            ->get();

        return view('home', compact('upcomingCourses'));
    }
}
