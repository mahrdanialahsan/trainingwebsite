@extends('layouts.admin')

@section('title', 'Contact Message #' . $contact_message->id)

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Contact Message #{{ $contact_message->id }}</h1>
        <a href="{{ route('admin.contact-messages.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-none hover:bg-gray-400">
            Back to list
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-none shadow p-8">
            <h2 class="text-2xl font-semibold mb-4">Contact Information</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-medium">{{ $contact_message->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium"><a href="mailto:{{ $contact_message->email }}" class="text-brand-primary hover:underline">{{ $contact_message->email }}</a></p>
                </div>
                @if($contact_message->phone)
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-medium"><a href="tel:{{ $contact_message->phone }}" class="text-brand-primary hover:underline">{{ $contact_message->phone }}</a></p>
                </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Submitted</p>
                    <p class="font-medium">{{ $contact_message->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-none shadow p-8">
            <h2 class="text-2xl font-semibold mb-4">Message</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Subject</p>
                    <p class="font-medium">{{ $contact_message->subject }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Message</p>
                    <div class="mt-1 p-4 bg-gray-50 rounded-none border border-gray-200 whitespace-pre-line text-gray-700">{{ $contact_message->message }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
