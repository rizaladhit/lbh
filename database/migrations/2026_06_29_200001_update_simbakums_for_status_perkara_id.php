<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('simbakums', function (Blueprint $table) {
            $table->unsignedBigInteger('status_perkara_id')->nullable()->after('advokat_pendamping');
            $table->foreign('status_perkara_id')->references('id')->on('status_perkaras')->nullOnDelete();
            $table->dropColumn('status_perkara');
        });
    }

    public function down(): void
    {
        Schema::table('simbakums', function (Blueprint $table) {
            $table->dropForeign(['status_perkara_id']);
            $table->dropColumn('status_perkara_id');
            $table->string('status_perkara')->nullable();
        });
    }
};
