<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediasiReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'obh',
        'alamat',
        'provinsi',
        'kegiatan',
        'tgl_pelaksanaan',
        'kasus',
        'penerima_bantuan',
        'jk_penerima',
        'nama_mediator',
        'checklist_data'
    ];

    protected $casts = [
        'tgl_pelaksanaan' => 'date',
        'checklist_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
