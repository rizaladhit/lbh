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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('client_name');
            $table->string('client_contact');
            $table->string('case_title');
            $table->text('description');
            $table->enum('status', ['Draft', 'Submitted', 'In Progress', 'Completed'])->default('Draft');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('attachment_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
