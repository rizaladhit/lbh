<?php

namespace App\Mail;

use App\Models\PermohonanNonLitigasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermohonanNonLitigasiAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PermohonanNonLitigasi $permohonanNonLitigasi,
        public string $recipientName,
        public string $recipientRole
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Penugasan Permohonan Non-Litigasi ' . $this->permohonanNonLitigasi->no_registrasi,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permohonan-non-litigasi-assigned',
        );
    }
}
