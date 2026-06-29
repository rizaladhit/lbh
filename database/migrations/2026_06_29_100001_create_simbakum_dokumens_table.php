<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simbakum_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simbakum_id')->constrained('simbakums')->cascadeOnDelete();
            $table->string('nama_dokumen', 255);
            $table->string('file_path', 500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simbakum_dokumens');
    }
};
