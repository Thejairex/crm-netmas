<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class kycVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $mail = new Envelope(
            to: $this->user->email,
            from: 'netmas@gmail.com',
        );
        if ($this->user->kyc_status === 'pending') {
            $mail->subject('Se ha enviado tu verificación de identidad');

        } else if ($this->user->kyc_status === 'verified') {
            $mail->subject('Tu verificación de identidad ha sido aprobada');
        } else if ($this->user->kyc_status === 'rejected') {
            $mail->subject('Tu verificación de identidad ha sido rechazada');
        }
        return  $mail;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.kyc-verification-mail',
            with: [
                'user' => $this->user
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
