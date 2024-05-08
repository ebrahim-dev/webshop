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

    public $mailMessage;
    public $subject;
    public $goal;
    public $orderDetails;
    public $totalAmount;

    public function __construct($mailMessage, $subject, $goal, $orderDetails, $totalAmount)
    {
        $this->mailMessage = $mailMessage;
        $this->subject = $subject;
        $this->goal = $goal;
        $this->orderDetails = $orderDetails;
        $this->totalAmount = $totalAmount;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address ('m.syrmani@gmail.com','Sermani'),
            replyTo:[
                new Address ('m.syrmani@gmail.com','Sermani')
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sent_email',
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
