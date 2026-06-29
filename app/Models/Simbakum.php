<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Simbakum extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_perkara',
        'tanggal_register',
        'klasifikasi_perkara',
        'terdakwa',
        'penuntut_umum',
        'advokat_pendamping',
        'status_perkara_id',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_register' => 'date',
        'tanggal_selesai'  => 'date',
    ];

    public function dokumens()
    {
        return $this->hasMany(SimbakumDokumen::class);
    }

    public function statusPerkara()
    {
        return $this->belongsTo(StatusPerkara::class);
    }

    /**
     * Compute lama proses in days.
     * Returns "X Hari" or "X Hari – Selesai" when status is_final.
     */
    public function getLamaProses(): string
    {
        $start = $this->tanggal_register;
        if (!$start) {
            return '-';
        }

        $isFinal = $this->statusPerkara?->is_final ?? false;
        if ($isFinal && $this->tanggal_selesai) {
            $days = $start->diffInDays($this->tanggal_selesai);
            return $days . ' Hari – Selesai';
        }

        return $start->diffInDays(Carbon::today()) . ' Hari';
    }

    /**
     * Return Indonesian label for status perkara.
     */
    public function getStatusLabel(): string
    {
        return $this->statusPerkara?->nama ?? '-';
    }

    /**
     * Return Bootstrap badge class for status perkara.
     */
    public function getStatusBadgeClass(): string
    {
        return $this->statusPerkara?->getBadgeClass() ?? 'badge bg-secondary';
    }
}
