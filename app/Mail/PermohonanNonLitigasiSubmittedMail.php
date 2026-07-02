<?php

namespace App\Mail;

use App\Models\PermohonanNonLitigasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermohonanNonLitigasiSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PermohonanNonLitigasi $permohonanNonLitigasi
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Permohonan Baru] Non-Litigasi — ' . $this->permohonanNonLitigasi->no_registrasi,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permohonan-non-litigasi-submitted',
        );
    }
}
