<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mediasi_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan')->default('MEDIASI');
            $table->date('tgl_pelaksanaan');
            $table->string('kasus');
            $table->string('penerima_bantuan');
            $table->enum('jk_penerima', ['L', 'P']);
            $table->string('nama_mediator');
            $table->json('checklist_data')->nullable(); // Store checklist statuses
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediasi_reports');
    }
};
