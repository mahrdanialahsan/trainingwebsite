<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->get('tab', 'bookings');

        $bookings = $user->bookings()->with(['course', 'payment'])->latest()->get();
        $orders = Payment::whereHas('booking', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('booking.course')->latest()->get();

        return view('dashboard.index', compact('user', 'bookings', 'orders', 'tab'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();
        $updateType = $request->input('update_type', 'profile');

        if ($updateType === 'password') {
            // Password change
            $validated = $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }

            $user->password = Hash::make($validated['password']);
            $user->save();

            return redirect()->route('dashboard', ['tab' => 'account'])
                ->with('success', 'Password changed successfully.');
        } else {
            // Profile update
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
            ]);

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? null;
            $user->save();

            return redirect()->route('dashboard', ['tab' => 'account'])
                ->with('success', 'Profile updated successfully.');
        }
    }
}
