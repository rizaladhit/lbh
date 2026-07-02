<?php

namespace App\Mail;

use App\Models\PermohonanNonLitigasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermohonanNonLitigasiStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PermohonanNonLitigasi $permohonanNonLitigasi,
        public string $statusLabel,
        public string $pesan,
        public string $headerColor = '#6366f1',
        public string $catatanLabel = 'Catatan',
        public ?string $catatanNilai = null
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Update Permohonan] ' . $this->permohonanNonLitigasi->no_registrasi . ' — ' . $this->statusLabel,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permohonan-non-litigasi-status',
        );
    }
}
