<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PidanaReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'obh', 'alamat', 'provinsi', 'perkara',
        'kasus', 'nomor_perkara', 'penerima_bantuan', 'jk_penerima',
        'checklist_data', 'status',
    ];

    protected $casts = [
        'checklist_data' => 'json',
    ];

    public const STATUS_DRAFT     = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_APPROVED  = 'approved';
    public const STATUS_REJECTED  = 'rejected';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT     => 'Draft',
            self::STATUS_SUBMITTED => 'Diajukan',
            self::STATUS_APPROVED  => 'Disetujui',
            self::STATUS_REJECTED  => 'Ditolak',
            default                => 'Unknown',
        };
    }

    public function getStatusBadge(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT     => 'badge bg-secondary',
            self::STATUS_SUBMITTED => 'badge bg-info text-white',
            self::STATUS_APPROVED  => 'badge bg-success',
            self::STATUS_REJECTED  => 'badge bg-danger',
            default                => 'badge bg-light text-dark',
        };
    }
}
