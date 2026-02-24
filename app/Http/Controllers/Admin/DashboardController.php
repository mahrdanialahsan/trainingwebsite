<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_courses' => Course::count(),
            'upcoming_courses' => Course::where('status', 'upcoming')->where('date', '>=', now()->toDateString())->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
        ];

        $recentBookings = Booking::with('course', 'payment')
            ->whereHas('payment', fn ($q) => $q->whereIn('status', ['completed', 'failed']))
            ->latest()
            ->take(10)
            ->get();

        $upcomingCourses = Course::where('status', 'upcoming')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'upcomingCourses'));
    }
}
