<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftingDokumenHukumReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'obh',
        'alamat',
        'provinsi',
        'kegiatan',
        'tgl_pelaksanaan',
        'kasus',
        'penerima_bantuan',
        'jk_penerima',
        'nama_drafter',
        'checklist_data'
    ];

    protected $casts = [
        'tgl_pelaksanaan' => 'date',
        'checklist_data' => 'array',
    ];
}
