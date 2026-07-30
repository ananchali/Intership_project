<?php

namespace App\Mail;

use App\Models\PaymentVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public PaymentVerification $verification;

    public function __construct(PaymentVerification $verification)
    {
        $this->verification = $verification;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Approved - Your Account is Now Active',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-approved',
        );
    }
}
