<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'rental_id')) {
                // Jika rental_id masih ada
                try {
                    $table->dropForeign(['rental_id']);
                    $table->renameColumn('rental_id', 'rental_item_id');
                } catch (\Throwable $e) {
                    // abaikan error
                }
            }
    
            // Pastikan kolom rental_item_id sudah ada dan diberi foreign key
            if (!Schema::hasColumn('reviews', 'rental_item_id')) {
                $table->unsignedBigInteger('rental_item_id')->nullable(); // atau sesuaikan
            }
    
            // Tambahkan FK jika belum ada
            $table->foreign('rental_item_id')
                ->references('id')->on('rental_items')
                ->onDelete('cascade');
        });
    }
    

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['rental_item_id']);
            $table->renameColumn('rental_item_id', 'rental_id');
        });
    }
};
