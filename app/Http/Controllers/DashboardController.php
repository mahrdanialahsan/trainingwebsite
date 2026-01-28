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

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('dashboard', ['tab' => 'account'])
            ->with('success', 'Account updated successfully.');
    }
}
