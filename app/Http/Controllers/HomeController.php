<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\Course;
use App\Models\Subscriber;
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

        $bios = Bio::where('is_active', true)
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return view('home', compact('upcomingCourses', 'bios'));
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            $subscriber = Subscriber::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'is_active' => true,
                    'subscribed_at' => now(),
                ]
            );

            if ($subscriber->wasRecentlyCreated) {
                $message = 'Thank you for subscribing! You will receive updates from us.';
            } else {
                if ($subscriber->is_active) {
                    $message = 'You are already subscribed to our newsletter.';
                } else {
                    $subscriber->update(['is_active' => true, 'subscribed_at' => now()]);
                    $message = 'Welcome back! Your subscription has been reactivated.';
                }
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
