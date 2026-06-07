<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanLitigasi extends Model
{
    use HasFactory;

    const STATUS_REGISTERED = 'REGISTERED';
    const STATUS_APPROVED   = 'APPROVED';
    const STATUS_VERIFIED   = 'VERIFIED';
    const STATUS_ASSIGNED   = 'ASSIGNED';
    const STATUS_DONE       = 'DONE';
    const STATUS_REJECTED   = 'REJECTED';

    protected $fillable = [
        'user_id',
        'no_registrasi',
        'nama',
        'alamat',
        'telp_hp',
        'nik',
        'jenis_perkara',
        'no_perkara',
        'tgl_rencana_kunjungan',
        'uraian_singkat',
        'file_ktp_kk',
        'file_sktm',
        'file_ttd',
        'status',
        'assigned_lawyer_id',
        'assigned_paralegal_id',
        'verification_notes',
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
                $model->no_registrasi = 'LIT-' . date('Ym') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
            if (empty($model->status)) {
                $model->status = self::STATUS_REGISTERED;
            }
        });
    }

    /**
     * Status Workflow Methods
     */
    public function canBeApproved(): bool
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function canBeRejected(): bool
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function canBeVerified(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function canBeAssigned(): bool
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function canBeCompleted(): bool
    {
        return $this->status === self::STATUS_ASSIGNED;
    }

    public function approve(string $notes = null): bool
    {
        if (!$this->canBeApproved()) {
            return false;
        }

        $this->update([
            'status' => self::STATUS_APPROVED,
            'verification_notes' => $notes,
        ]);

        return true;
    }

    public function verify(string $notes = null): bool
    {
        if (!$this->canBeVerified()) {
            return false;
        }
        $this->update([
            'status' => self::STATUS_VERIFIED,
            'verification_notes' => $notes,
            'verified_at' => now(),
        ]);
        return true;
    }

    public function reject(string $notes = null): bool
    {
        if (!$this->canBeRejected()) {
            return false;
        }

        $this->update([
            'status' => self::STATUS_REJECTED,
            'verification_notes' => $notes,
        ]);

        return true;
    }

    public function assign($lawyerId = null, $paralegaId = null): bool
    {
        if (!$this->canBeAssigned()) {
            return false;
        }
        $this->update([
            'status' => self::STATUS_ASSIGNED,
            'assigned_lawyer_id' => $lawyerId,
            'assigned_paralegal_id' => $paralegaId,
            'assigned_at' => now(),
        ]);
        return true;
    }

    public function complete(string $notes = null): bool
    {
        if (!$this->canBeCompleted()) {
            return false;
        }
        $this->update([
            'status' => self::STATUS_DONE,
            'activity_notes' => $notes,
            'completed_at' => now(),
        ]);
        return true;
    }

    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            self::STATUS_REGISTERED => 'bg-primary',
            self::STATUS_APPROVED   => 'bg-info text-white',
            self::STATUS_VERIFIED   => 'bg-success',
            self::STATUS_ASSIGNED   => 'bg-warning text-dark',
            self::STATUS_DONE       => 'bg-secondary',
            self::STATUS_REJECTED   => 'bg-danger',
            default                 => 'bg-light text-dark',
        };
    }

    public function getStatusIcon(): string
    {
        return match($this->status) {
            self::STATUS_REGISTERED => 'fa-solid fa-inbox',
            self::STATUS_APPROVED   => 'fa-solid fa-thumbs-up',
            self::STATUS_VERIFIED   => 'fa-solid fa-circle-check',
            self::STATUS_ASSIGNED   => 'fa-solid fa-user-tie',
            self::STATUS_DONE       => 'fa-solid fa-flag-checkered',
            self::STATUS_REJECTED   => 'fa-solid fa-ban',
            default                 => 'fa-solid fa-circle-question',
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_REGISTERED => 'Terdaftar',
            self::STATUS_APPROVED   => 'Disetujui',
            self::STATUS_VERIFIED   => 'Terverifikasi',
            self::STATUS_ASSIGNED   => 'Ditugaskan',
            self::STATUS_DONE       => 'Selesai',
            self::STATUS_REJECTED   => 'Ditolak',
            default                 => 'Unknown',
        };
    }
}
