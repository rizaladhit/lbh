<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penelitian_hukum_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan')->default('Penelitian Hukum');
            $table->date('tgl_pelaksanaan')->nullable();
            $table->string('judul_penelitian');
            $table->json('checklist_data')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitian_hukum_reports');
    }
};
