<?php

namespace App\Mail;

use App\Models\PermohonanLitigasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermohonanLitigasiAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PermohonanLitigasi $permohonanLitigasi,
        public string $recipientName,
        public string $recipientRole
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Penugasan Permohonan Litigasi ' . $this->permohonanLitigasi->no_registrasi,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permohonan-litigasi-assigned',
        );
    }
}
