<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyuluhan_hukum_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan')->default('Penyuluhan Hukum');
            $table->date('tgl_pelaksanaan')->nullable();
            $table->string('penerima_bantuan')->nullable();
            $table->string('tempat_pelaksanaan')->nullable();
            $table->string('materi')->nullable();
            $table->string('narasumber')->nullable();
            $table->json('checklist_data')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyuluhan_hukum_reports');
    }
};
