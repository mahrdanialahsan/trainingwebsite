<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $company;
    public $phone;
    public $serviceInterest;
    public $messageText;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $company, $phone, $serviceInterest, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->company = $company;
        $this->phone = $phone;
        $this->serviceInterest = $serviceInterest ? ucwords(str_replace('-', ' ', $serviceInterest)) : null;
        $this->messageText = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Consultation Request: ' . $this->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.consultation-request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
