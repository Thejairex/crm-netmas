<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseSuccessfulMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $purchase;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $purchase)
    {
        $this->user = $user;
        $this->purchase = $purchase;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->user->email,
            from: 'netmas@gmail.com',
            subject: 'Compra realizada con éxito',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.purchase-successful-mail',
            with: [
                'user' => $this->user,
                'purchase' => $this->purchase
            ]
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
