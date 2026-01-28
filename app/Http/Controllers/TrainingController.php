<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::where('is_active', true)->orderBy('order')->get();
        return view('trainings.index', compact('trainings'));
    }

    public function show($slug)
    {
        $training = Training::where('slug', $slug)->where('is_active', true)
            ->with(['facilities', 'amenities'])
            ->firstOrFail();
        
        return view('trainings.show', compact('training'));
    }
}
