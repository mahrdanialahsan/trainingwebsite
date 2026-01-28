<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        // Generate reset token
        $token = Str::random(64);
        
        // Store token in password_resets table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        // Generate reset link
        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));
        
        // Send password reset email
        try {
            Mail::to($user->email)->send(new PasswordResetMail($user, $resetLink));
            
            return back()->with('status', 'Password reset link has been sent to your email address.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Password reset email failed: ' . $e->getMessage());
            
            return back()->withErrors(['email' => 'Failed to send password reset email. Please try again later.']);
        }
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->query('email');
        
        // Verify token
        $reset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$reset) {
            return redirect()->route('forgot-password')
                ->with('error', 'Invalid reset token.');
        }

        // Check if token is expired (24 hours)
        if (Carbon::parse($reset->created_at)->addHours(24)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgot-password')
                ->with('error', 'This password reset link has expired. Please request a new one.');
        }

        // Verify token hash
        if (!Hash::check($token, $reset->token)) {
            return redirect()->route('forgot-password')
                ->with('error', 'Invalid reset token.');
        }

        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid reset token.']);
        }

        // Check if token is expired
        if (Carbon::parse($reset->created_at)->addHours(24)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'This password reset link has expired.']);
        }

        // Verify token
        if (!Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'Invalid reset token.']);
        }

        // Update password
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete reset token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'Your password has been reset successfully. You can now login with your new password.');
    }
}
