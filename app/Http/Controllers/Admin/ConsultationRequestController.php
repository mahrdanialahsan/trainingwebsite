<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    /**
     * Display a listing of consultation requests.
     */
    public function index()
    {
        $requests = ConsultationRequest::latest()->paginate(20);
        return view('admin.consultation-requests.index', compact('requests'));
    }

    /**
     * Display the specified consultation request.
     */
    public function show(ConsultationRequest $consultation_request)
    {
        return view('admin.consultation-requests.show', compact('consultation_request'));
    }

    /**
     * Update the status of a consultation request.
     */
    public function updateStatus(Request $request, ConsultationRequest $consultation_request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,completed,cancelled',
        ]);

        $consultation_request->update(['status' => $validated['status']]);

        return redirect()
            ->route('admin.consultation-requests.show', $consultation_request)
            ->with('success', 'Status updated successfully.');
    }
}
