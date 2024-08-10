<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $customerName;
    public $invoiceUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $customerName, $invoiceUrl)
    {
        $this->invoice = $invoice;
        $this->customerName = $customerName;
        $this->invoiceUrl = $invoiceUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Success Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.payment-success-mail',
            with: [
                'invoice' => $this->invoice,
                'customerName' => $this->customerName,
                'invoiceUrl' => $this->invoiceUrl,
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
