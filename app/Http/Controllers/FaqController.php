<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'general');
        $faqs = Faq::where('status', true)
            ->where('type', $type)
            ->orderBy('displayorder')
            ->get();
        return view('faqs.index', compact('faqs', 'type'));
    }
}
