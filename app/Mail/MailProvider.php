<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MailProvider extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */
     public function __construct(
        public $mailFrom,
        public $mailReplyTo,
        public $subject,
        public $template,
     )
    {
        //

       //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailFrom["email"], $this->mailFrom["name"]),
            subject: $this->subject,
             replyTo: [
        new Address($this->mailReplyTo["email"], $this->mailReplyTo["name"]),
    ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->template,
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
