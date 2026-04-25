<?php

namespace App\Models;

use App\Models\PermohonanLitigasi;
use App\Models\PermohonanNonLitigasi;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'action', 'description', 'model_type', 'model_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRelatedUrl(): ?string
    {
        return match($this->model_type) {
            Report::class => route('reports.show', $this->model_id),
            PermohonanLitigasi::class => route('permohonan-litigasi.show', $this->model_id),
            PermohonanNonLitigasi::class => route('permohonan-non-litigasi.show', $this->model_id),
            default => null,
        };
    }

    public function getRelatedLabel(): string
    {
        return match($this->model_type) {
            Report::class => 'Laporan',
            PermohonanLitigasi::class => 'Permohonan Litigasi',
            PermohonanNonLitigasi::class => 'Permohonan Non-Litigasi',
            default => 'Item',
        };
    }
}
