<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationRequestMail;
use App\Models\ConsultationRequest;
use App\Models\ConsultingSection;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsultingController extends Controller
{
    public function index()
    {
        $hero = ConsultingSection::where('section_type', 'hero')->where('is_active', true)->orderBy('order')->first();
        $overview = ConsultingSection::where('section_type', 'overview')->where('is_active', true)->orderBy('order')->first();
        $services = ConsultingSection::where('section_type', 'services')->where('is_active', true)->orderBy('order')->get();
        $approach = ConsultingSection::where('section_type', 'approach')->where('is_active', true)->orderBy('order')->get();
        $benefits = ConsultingSection::where('section_type', 'benefits')->where('is_active', true)->orderBy('order')->get();
        $cta = ConsultingSection::where('section_type', 'cta')->where('is_active', true)->orderBy('order')->first();
        $faqs = Faq::where('type', 'consulting')->where('status', true)->orderBy('displayorder')->get();
        
        return view('consulting', compact('hero', 'overview', 'services', 'approach', 'benefits', 'cta', 'faqs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'service_interest' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            ConsultationRequest::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'company' => $validated['company'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'service_interest' => $validated['service_interest'] ?? null,
                'message' => $validated['message'],
                'status' => 'pending',
            ]);

            // Send email to Contact Form Email (same as Contact Us)
            try {
                $contactEmail = Setting::get('contact_email', Setting::get('system_email', 'info@training.com'));
                Mail::to($contactEmail)->send(new ConsultationRequestMail(
                    $validated['name'],
                    $validated['email'],
                    $validated['company'] ?? null,
                    $validated['phone'] ?? null,
                    $validated['service_interest'] ?? null,
                    $validated['message']
                ));
            } catch (\Exception $e) {
                \Log::error('Consultation request email failed: ' . $e->getMessage());
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your consultation request has been sent successfully. We will contact you soon.'
                ]);
            }

            return back()->with('success', 'Thank you! Your consultation request has been sent successfully. We will contact you soon.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred. Please try again later.'
                ], 500);
            }

            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }
}
