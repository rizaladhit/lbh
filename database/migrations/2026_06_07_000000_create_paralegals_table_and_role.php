<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        try {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'pengacara', 'paralegal') DEFAULT 'user'");
        } catch (\Throwable $e) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('user')->change();
            });
        }

        Schema::create('paralegals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('no_identitas')->unique();
            $table->string('specialization');
            $table->text('address')->nullable();
            $table->string('status')->default('active');
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        DB::table('permohonan_litigasis')->whereNotNull('assigned_paralegal_id')->update(['assigned_paralegal_id' => null]);
        DB::table('permohonan_non_litigasis')->whereNotNull('assigned_paralegal_id')->update(['assigned_paralegal_id' => null]);

        Schema::table('permohonan_litigasis', function (Blueprint $table) {
            try {
                $table->dropForeign(['assigned_paralegal_id']);
            } catch (\Throwable $e) {
            }
            $table->foreign('assigned_paralegal_id')->references('id')->on('paralegals')->nullOnDelete();
        });

        Schema::table('permohonan_non_litigasis', function (Blueprint $table) {
            try {
                $table->dropForeign(['assigned_paralegal_id']);
            } catch (\Throwable $e) {
            }
            $table->foreign('assigned_paralegal_id')->references('id')->on('paralegals')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('permohonan_litigasis', function (Blueprint $table) {
            try {
                $table->dropForeign(['assigned_paralegal_id']);
            } catch (\Throwable $e) {
            }
            $table->foreign('assigned_paralegal_id')->references('id')->on('lawyers')->nullOnDelete();
        });

        Schema::table('permohonan_non_litigasis', function (Blueprint $table) {
            try {
                $table->dropForeign(['assigned_paralegal_id']);
            } catch (\Throwable $e) {
            }
            $table->foreign('assigned_paralegal_id')->references('id')->on('lawyers')->nullOnDelete();
        });

        Schema::dropIfExists('paralegals');

        try {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'pengacara') DEFAULT 'user'");
        } catch (\Throwable $e) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('user')->change();
            });
        }
    }
};
