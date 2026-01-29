<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database so admin can view all messages
        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        try {
            // Get contact email from settings, fallback to system email
            $contactEmail = Setting::get('contact_email', Setting::get('system_email', 'info@training.com'));

            // Send email to management (optional; message is already saved)
            Mail::to($contactEmail)->send(new ContactFormMail(
                $validated['name'],
                $validated['email'],
                $validated['phone'] ?? null,
                $validated['subject'],
                $validated['message']
            ));
        } catch (\Exception $e) {
            \Log::error('Contact form email failed: ' . $e->getMessage());
            // Message is saved; still show success to user
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We have received your message and will get back to you soon.'
            ]);
        }

        return back()->with('success', 'Thank you for contacting us! We have received your message and will get back to you soon.');
    }
}
