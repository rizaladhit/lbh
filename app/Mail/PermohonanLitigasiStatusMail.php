<?php

namespace App\Mail;

use App\Models\PermohonanLitigasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermohonanLitigasiStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PermohonanLitigasi $permohonanLitigasi,
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
            subject: '[Update Permohonan] ' . $this->permohonanLitigasi->no_registrasi . ' — ' . $this->statusLabel,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permohonan-litigasi-status',
        );
    }
}
