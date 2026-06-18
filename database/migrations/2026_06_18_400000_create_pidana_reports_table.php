<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pidana_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('perkara')->default('Pidana');
            $table->string('kasus')->nullable();
            $table->string('nomor_perkara')->nullable();
            $table->string('penerima_bantuan')->nullable();
            $table->enum('jk_penerima', ['L', 'P'])->nullable();
            $table->json('checklist_data')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pidana_reports');
    }
};
