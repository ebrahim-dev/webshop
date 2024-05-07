<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name="Ebrahim";
    public $email="m.syrmani@gmail.com";
    public $password;
    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->from($this->email, $this->name)
                    ->to('mailtrap@demomailtrap.com')
                    ->subject('Nieuw contactformulier ingediend')
                    ->view('emails.contactForm');
    }
}
