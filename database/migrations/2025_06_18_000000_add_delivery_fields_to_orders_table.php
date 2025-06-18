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
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('delivery_option', ['pickup', 'delivery'])->default('pickup')->after('payment_status');
            $table->text('delivery_address')->nullable()->after('delivery_option');
            $table->string('phone_number', 20)->nullable()->after('delivery_address');
            $table->string('recipient_name', 100)->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_option', 'delivery_address', 'phone_number', 'recipient_name']);
        });
    }
};