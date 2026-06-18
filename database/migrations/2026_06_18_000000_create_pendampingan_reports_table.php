<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendampingan_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan')->default('Pendampingan Diluar Pengadilan');
            $table->string('kasus');
            $table->date('tgl_pendampingan_1')->nullable();
            $table->date('tgl_pendampingan_2')->nullable();
            $table->date('tgl_pendampingan_3')->nullable();
            $table->date('tgl_pendampingan_4')->nullable();
            $table->string('penerima_bantuan');
            $table->enum('jk_penerima', ['L', 'P']);
            $table->json('checklist_data')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendampingan_reports');
    }
};
