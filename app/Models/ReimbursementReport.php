<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'obh',
        'alamat',
        'provinsi',
        'kegiatan',
        'tgl_pelaksanaan',
        'penerima_bantuan',
        'tempat_pelaksanaan',
        'materi',
        'narasumber',
        'kasus',
        'nomor_perkara',
        'perkara_type',
        'jenis_kegiatan_investigasi',
        'nama_investigator',
        'nama_mediator',
        'nama_negosiator',
        'nama_konsultan',
        'checklist_data',
        'status',
        'notes',
    ];

    protected $casts = [
        'tgl_pelaksanaan' => 'date',
        'checklist_data' => 'json',
    ];

    public const KEGIATAN_TYPES = [
        'Penelitian Hukum',
        'Penyuluhan Hukum',
        'Investigasi Kasus',
        'Konsultasi Hukum',
        'Mediasi',
        'Negosiasi',
        'Pemberdayaan Masyarakat',
        'Pendampingan Diluar Pengadilan',
        'Litigasi Perdata',
        'Litigasi Pidana',
        'Litigasi TUN',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'bg-secondary',
            self::STATUS_SUBMITTED => 'bg-info text-white',
            self::STATUS_APPROVED => 'bg-success',
            self::STATUS_REJECTED => 'bg-danger',
            default => 'bg-light text-dark',
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_SUBMITTED => 'Diajukan',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
            default => 'Unknown',
        };
    }
}
