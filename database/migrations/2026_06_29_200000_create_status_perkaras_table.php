<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_perkaras', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->boolean('is_final')->default(false);
            $table->string('warna', 50)->default('secondary');
            $table->smallInteger('urutan')->unsigned()->default(0);
            $table->timestamps();
        });

        DB::table('status_perkaras')->insert([
            ['nama' => 'Sidang Pertama', 'is_final' => false, 'warna' => 'info',      'urutan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sidang Kedua',   'is_final' => false, 'warna' => 'warning',   'urutan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sidang Ketiga',  'is_final' => false, 'warna' => 'danger',    'urutan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Selesai',        'is_final' => true,  'warna' => 'success',   'urutan' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('status_perkaras');
    }
};
