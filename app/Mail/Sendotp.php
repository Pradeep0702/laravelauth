<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Sendotp extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $otp;
   
    public function __construct($username,$otp)
    {
        $this->username = $username;
        $this->otp = $otp;
    }

    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Auth Login',
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'otp',
        );
    }
 
    public function attachments(): array
    {
        return [];
    }
}
