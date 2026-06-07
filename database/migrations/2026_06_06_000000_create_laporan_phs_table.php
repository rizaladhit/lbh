<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_phs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('pengadilan|lapas');
            $table->string('no_registrasi_perkara');
            $table->string('nama');
            $table->string('terdakwa')->nullable();
            $table->string('nama_jaksa')->nullable();
            $table->string('nama_penasehat_hukum')->nullable();
            $table->string('jenis_perkara')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_phs');
    }
};
