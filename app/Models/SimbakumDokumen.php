<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SimbakumDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'simbakum_id',
        'nama_dokumen',
        'file_path',
    ];

    public function simbakum()
    {
        return $this->belongsTo(Simbakum::class);
    }

    /**
     * Get the public URL for this document.
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }
}
