<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyBillMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;

    public int $nominal;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, int $nominal)
    {
        $this->name = $name;
        $this->nominal = $nominal;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tagihan Bulanan',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.monthly-bill-mail',
            with: [
                'name' => $this->name,
                'nominal' => $this->nominal,
            ],
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
