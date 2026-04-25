<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'no_identitas',
        'specialization',
        'address',
        'status',
        'notes',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get permohonan litigasi that assigned to this lawyer
     */
    public function permohonanLitigasiAsLawyer()
    {
        return $this->hasMany(PermohonanLitigasi::class, 'assigned_lawyer_id');
    }

    /**
     * Get permohonan litigasi that assigned to this paralegal
     */
    public function permohonanLitigasiAsParalegal()
    {
        return $this->hasMany(PermohonanLitigasi::class, 'assigned_paralegal_id');
    }

    /**
     * Scope to get active lawyers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Helper to get full status badge
     */
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'active' => 'bg-success text-white',
            'inactive' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            default => 'Unknown',
        };
    }
}
