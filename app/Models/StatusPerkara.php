<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPerkara extends Model
{
    protected $fillable = ['nama', 'is_final', 'warna', 'urutan'];

    protected $casts = [
        'is_final' => 'boolean',
        'urutan'   => 'integer',
    ];

    public function simbakums()
    {
        return $this->hasMany(Simbakum::class);
    }

    public function getBadgeClass(): string
    {
        $color = $this->warna ?? 'secondary';
        $textClass = in_array($color, ['warning', 'light']) ? ' text-dark' : '';
        return 'badge bg-' . $color . $textClass;
    }
}
