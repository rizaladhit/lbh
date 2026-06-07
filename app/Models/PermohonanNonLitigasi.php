<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanNonLitigasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_registrasi',
        'nama_pemohon',
        'alamat_pemohon',
        'telp_hp_pemohon',
        'nik_pemohon',
        'jenis_perkara',
        'tgl_rencana_kunjungan',
        'uraian_singkat',
        'file_ktp_kk',
        'file_sktm',
        'file_ttd',
        'user_id',
        'status',
        'verification_notes',
        'assigned_lawyer_id',
        'assigned_paralegal_id',
        'activity_notes',
        'verified_at',
        'assigned_at',
        'completed_at',
    ];

    protected $casts = [
        'tgl_rencana_kunjungan' => 'date',
        'verified_at' => 'datetime',
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    const STATUS_REGISTERED = 'REGISTERED';
    const STATUS_APPROVED   = 'APPROVED';
    const STATUS_VERIFIED   = 'VERIFIED';
    const STATUS_ASSIGNED   = 'ASSIGNED';
    const STATUS_DONE       = 'DONE';
    const STATUS_REJECTED   = 'REJECTED';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedLawyer()
    {
        return $this->belongsTo(Lawyer::class, 'assigned_lawyer_id');
    }

    public function assignedParalegal()
    {
        return $this->belongsTo(Paralegal::class, 'assigned_paralegal_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->no_registrasi)) {
                $count = self::count() + 1;
                $model->no_registrasi = 'NON-' . date('Ym') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Workflow State Transitions
    public function canBeApproved()
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function canBeRejected()
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function canBeVerified()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function approve($notes)
    {
        if ($this->canBeApproved()) {
            $this->update([
                'status' => self::STATUS_APPROVED,
                'verification_notes' => $notes,
            ]);
        }
    }

    public function verify($notes)
    {
        if ($this->canBeVerified()) {
            $this->update([
                'status' => self::STATUS_VERIFIED,
                'verification_notes' => $notes,
                'verified_at' => now(),
            ]);
        }
    }

    public function reject($notes)
    {
        if ($this->canBeRejected()) {
            $this->update([
                'status' => self::STATUS_REJECTED,
                'verification_notes' => $notes,
            ]);
        }
    }

    public function canBeAssigned()
    {
        return $this->status === self::STATUS_VERIFIED || $this->status === self::STATUS_ASSIGNED;
    }

    public function assign($lawyerId, $paralegalId)
    {
        if ($this->canBeAssigned()) {
            $this->update([
                'status' => self::STATUS_ASSIGNED,
                'assigned_lawyer_id' => $lawyerId,
                'assigned_paralegal_id' => $paralegalId,
                'assigned_at' => now(),
            ]);
        }
    }

    public function canBeCompleted()
    {
        return $this->status === self::STATUS_ASSIGNED;
    }

    public function complete($notes)
    {
        if ($this->canBeCompleted()) {
            $this->update([
                'status' => self::STATUS_DONE,
                'activity_notes' => $notes,
                'completed_at' => now(),
            ]);
        }
    }

    // UI Helpers
    public function getStatusBadgeColor()
    {
        return match ($this->status) {
            self::STATUS_REGISTERED => 'bg-secondary',
            self::STATUS_APPROVED   => 'bg-info text-white',
            self::STATUS_VERIFIED   => 'bg-primary',
            self::STATUS_ASSIGNED   => 'bg-warning text-dark',
            self::STATUS_DONE       => 'bg-success',
            self::STATUS_REJECTED   => 'bg-danger',
            default => 'bg-light text-dark'
        };
    }

    public function getStatusIcon()
    {
        return match ($this->status) {
            self::STATUS_REGISTERED => 'fa-solid fa-file-signature',
            self::STATUS_APPROVED   => 'fa-solid fa-thumbs-up',
            self::STATUS_VERIFIED   => 'fa-solid fa-check-double',
            self::STATUS_ASSIGNED   => 'fa-solid fa-user-tie',
            self::STATUS_DONE       => 'fa-solid fa-circle-check',
            self::STATUS_REJECTED   => 'fa-solid fa-ban',
            default => 'fa-solid fa-circle-info'
        };
    }

    public function getStatusLabel()
    {
        return match ($this->status) {
            self::STATUS_REGISTERED => 'Terdaftar',
            self::STATUS_APPROVED   => 'Disetujui',
            self::STATUS_VERIFIED   => 'Terverifikasi',
            self::STATUS_ASSIGNED   => 'Ditugaskan',
            self::STATUS_DONE       => 'Selesai',
            self::STATUS_REJECTED   => 'Ditolak',
            default => 'Unknown'
        };
    }
}
