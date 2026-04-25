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
        Schema::table('permohonan_non_litigasis', function (Blueprint $table) {
            $table->string('status')->default('REGISTERED')->after('file_ttd');
            $table->text('verification_notes')->nullable()->after('status');
            $table->foreignId('assigned_lawyer_id')->nullable()->constrained('lawyers')->nullOnDelete()->after('verification_notes');
            $table->foreignId('assigned_paralegal_id')->nullable()->constrained('lawyers')->nullOnDelete()->after('assigned_lawyer_id');
            $table->text('activity_notes')->nullable()->after('assigned_paralegal_id');
            $table->timestamp('verified_at')->nullable()->after('activity_notes');
            $table->timestamp('assigned_at')->nullable()->after('verified_at');
            $table->timestamp('completed_at')->nullable()->after('assigned_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_non_litigasis', function (Blueprint $table) {
            $table->dropForeign(['assigned_lawyer_id']);
            $table->dropForeign(['assigned_paralegal_id']);
            $table->dropColumn([
                'status',
                'verification_notes',
                'assigned_lawyer_id',
                'assigned_paralegal_id',
                'activity_notes',
                'verified_at',
                'assigned_at',
                'completed_at'
            ]);
        });
    }
};
