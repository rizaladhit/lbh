<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simbakums', function (Blueprint $table) {
            $table->id();
            $table->string('no_perkara', 100)->unique();
            $table->date('tanggal_register');
            $table->string('klasifikasi_perkara', 255);
            $table->string('terdakwa', 255);
            $table->string('penuntut_umum', 255);
            $table->string('advokat_pendamping', 255);
            $table->enum('status_perkara', ['sidang_pertama', 'sidang_kedua', 'sidang_ketiga', 'selesai']);
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simbakums');
    }
};
