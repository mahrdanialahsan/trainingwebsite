<?php

namespace App\Http\Controllers;

use App\Models\ConsultingSection;
use App\Models\Faq;
use Illuminate\Http\Request;

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
}
