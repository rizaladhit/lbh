<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paralegal extends Model
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

    public function permohonanLitigasi()
    {
        return $this->hasMany(PermohonanLitigasi::class, 'assigned_paralegal_id');
    }

    public function permohonanNonLitigasi()
    {
        return $this->hasMany(PermohonanNonLitigasi::class, 'assigned_paralegal_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

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
