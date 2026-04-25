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
            // Add status column with default REGISTERED
            $table->string('status')->default('REGISTERED')->after('file_ttd');
            
            // Add assignment fields
            $table->unsignedBigInteger('assigned_lawyer_id')->nullable()->after('status');
            $table->unsignedBigInteger('assigned_paralegal_id')->nullable()->after('assigned_lawyer_id');
            
            // Add verification and activity notes
            $table->text('verification_notes')->nullable()->after('assigned_paralegal_id');
            $table->text('activity_notes')->nullable()->after('verification_notes');
            
            // Add timestamps for workflow tracking
            $table->timestamp('verified_at')->nullable()->after('activity_notes');
            $table->timestamp('assigned_at')->nullable()->after('verified_at');
            $table->timestamp('completed_at')->nullable()->after('assigned_at');
            
            // Foreign keys
            $table->foreign('assigned_lawyer_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_paralegal_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_litigasis', function (Blueprint $table) {
            $table->dropForeign(['assigned_lawyer_id']);
            $table->dropForeign(['assigned_paralegal_id']);
            $table->dropColumn([
                'status',
                'assigned_lawyer_id',
                'assigned_paralegal_id',
                'verification_notes',
                'activity_notes',
                'verified_at',
                'assigned_at',
                'completed_at'
            ]);
        });
    }
};
