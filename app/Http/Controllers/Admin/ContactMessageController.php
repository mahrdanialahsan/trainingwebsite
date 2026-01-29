<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact form messages.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contact_message)
    {
        return view('admin.contact-messages.show', compact('contact_message'));
    }
}
