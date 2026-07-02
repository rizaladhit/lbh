<?php

namespace App\Mail;

use App\Models\PermohonanLitigasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermohonanLitigasiSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PermohonanLitigasi $permohonanLitigasi
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Permohonan Baru] Litigasi — ' . $this->permohonanLitigasi->no_registrasi,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permohonan-litigasi-submitted',
        );
    }
}
