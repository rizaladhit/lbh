<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPH extends Model
{
    use HasFactory;

    protected $table = 'laporan_phs';

    protected $fillable = [
        'type',
        'no_registrasi_perkara',
        'nama',
        'terdakwa',
        'nama_jaksa',
        'nama_penasehat_hukum',
        'jenis_perkara',
    ];
}
