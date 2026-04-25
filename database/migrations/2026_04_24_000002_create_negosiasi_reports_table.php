<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('negosiasi_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan')->default('NEGOSIASI');
            $table->date('tgl_pelaksanaan');
            $table->string('kasus');
            $table->string('penerima_bantuan');
            $table->enum('jk_penerima', ['L', 'P']);
            $table->string('nama_negosiator');
            $table->json('checklist_data')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('negosiasi_reports');
    }
};
