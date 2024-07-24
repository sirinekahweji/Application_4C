<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvellePublicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle Publication Mail',
        );
    }

    /**
     * Get the message content definition.
     */


    public function build()
    {
        $subject = 'test';
        $content = "Sujet : $subject\n" .
            "Une nouvelle publication a été crée.\n" .
            "Description : ";

        return $this->view('mail.hello')->subject($subject)->with('content', $content)->with('test',"mourad a envoyer nouvell mail pour tester");
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
