<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['app_name', 'logo_path', 'address', 'phone', 'description'];

    /**
     * Get the single settings row (always ID 1).
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate(['id' => 1], [
            'app_name' => 'LBH App',
            'logo_path' => null,
            'description' => null,
        ]);
    }
}
