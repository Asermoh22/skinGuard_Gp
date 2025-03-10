<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $MailMessage;
    public $subject;

    public function __construct($messageData, $subject)
    {
        $this->MailMessage = $messageData;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("skinguard@gmail.com", "SKINGUARD"),
            subject: $this->subject,
        );
        
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.bookingEmail', // Use your Blade email view
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
