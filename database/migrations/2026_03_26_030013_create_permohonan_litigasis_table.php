<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonan_litigasis', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->unique()->nullable();
            $table->string('nama');
            $table->text('alamat');
            $table->string('telp_hp');
            $table->string('nik', 20);
            $table->string('jenis_perkara');
            $table->string('no_perkara');
            $table->date('tgl_rencana_kunjungan');
            $table->text('uraian_singkat');
            $table->string('file_ktp_kk');
            $table->string('file_sktm')->nullable();
            $table->string('file_ttd');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_litigasis');
    }
};
