<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drafting_dokumen_hukum_reports', function (Blueprint $table) {
            $table->id();
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan')->default('Drafting Dokumen Hukum');
            $table->date('tgl_pelaksanaan');
            $table->string('kasus');
            $table->string('penerima_bantuan');
            $table->enum('jk_penerima', ['L', 'P']);
            $table->string('nama_drafter');
            $table->json('checklist_data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drafting_dokumen_hukum_reports');
    }
};
