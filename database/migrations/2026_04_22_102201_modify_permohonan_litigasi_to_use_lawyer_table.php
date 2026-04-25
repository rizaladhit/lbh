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
        Schema::table('permohonan_litigasis', function (Blueprint $table) {
            // Drop existing foreign keys to users table
            $table->dropForeign(['assigned_lawyer_id']);
            $table->dropForeign(['assigned_paralegal_id']);

            // Add new foreign keys to lawyers table
            $table->foreign('assigned_lawyer_id')
                ->references('id')->on('lawyers')
                ->onDelete('set null');
            
            $table->foreign('assigned_paralegal_id')
                ->references('id')->on('lawyers')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_litigasis', function (Blueprint $table) {
            // Drop the lawyer foreign keys
            $table->dropForeign(['assigned_lawyer_id']);
            $table->dropForeign(['assigned_paralegal_id']);

            // Restore the original users table foreign keys (if needed)
            // In this case, we'll just leave them nullable since we're reverting
        });
    }
};
