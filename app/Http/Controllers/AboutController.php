<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Bio;
use App\Models\Faq;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get all about sections dynamically
        $sections = AboutSection::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('section_type');
        
        // Get FAQs for about page
        $faqs = Faq::where('type', 'about-us')
            ->where('status', true)
            ->orderBy('displayorder')
            ->get();
        
        // Get active bios for team section
        $bios = Bio::where('is_active', true)
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        
        return view('about', compact('sections', 'faqs', 'bios'));
    }
}
