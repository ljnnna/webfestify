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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ktp_photo')->nullable()->after('email');
            $table->string('ktp_selfie_photo')->nullable()->after('ktp_photo');
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->after('ktp_selfie_photo');
            $table->timestamp('verified_at')->nullable()->after('verification_status');
            $table->text('verification_notes')->nullable()->after('verified_at');
            $table->timestamp('verification_submitted_at')->nullable()->after('verification_notes');
            $table->index('verification_status');
            $table->index('verification_submitted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['verification_status']);
            $table->dropIndex(['verification_submitted_at']);
            $table->dropColumn([
                'ktp_photo',
                'ktp_selfie_photo', 
                'verification_status',
                'verified_at',
                'verification_notes',
                'verification_submitted_at'
            ]);
        });
    }
};
