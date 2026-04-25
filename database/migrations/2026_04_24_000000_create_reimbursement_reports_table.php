<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reimbursement_reports', function (Blueprint $table) {
            $table->id();
            $table->string('obh');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kegiatan'); // Type of activity
            $table->date('tgl_pelaksanaan');
            $table->string('penerima_bantuan')->nullable();
            $table->string('tempat_pelaksanaan')->nullable();
            $table->string('materi')->nullable();
            $table->string('narasumber')->nullable();
            $table->string('kasus')->nullable();
            $table->string('nomor_perkara')->nullable();
            $table->string('perkara_type')->nullable(); // PERDATA, PIDANA, TUN for litigasi
            $table->string('jenis_kegiatan_investigasi')->nullable();
            $table->string('nama_investigator')->nullable();
            $table->string('nama_mediator')->nullable();
            $table->string('nama_negosiator')->nullable();
            $table->string('nama_konsultan')->nullable();
            $table->json('checklist_data')->nullable(); // Store checklist items as JSON
            $table->string('status')->default('draft'); // draft, submitted, approved, rejected
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reimbursement_reports');
    }
};
