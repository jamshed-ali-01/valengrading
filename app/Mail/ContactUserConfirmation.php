<?php

namespace App\Mail;

use App\Models\ContactQuery;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUserConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $contactQuery;

    public function __construct(ContactQuery $contactQuery)
    {
        $this->contactQuery = $contactQuery;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your message - ' . \App\Models\SiteSetting::get('site_name', 'Valen Grading'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_user_confirmation',
        );
    }
}
