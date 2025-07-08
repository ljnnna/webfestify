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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();

            // Relasi ke ReturnProduct
            $table->unsignedBigInteger('return_product_id');
            $table->foreign('return_product_id')
                  ->references('id')
                  ->on('return_products')
                  ->onDelete('cascade');

            // Data kondisi
            $table->string('description'); // contoh: "Late return", "Item damaged"
            $table->decimal('amount', 10, 2)->default(0); // Jumlah denda
            $table->text('notes')->nullable(); // Catatan tambahan

            // Foto kondisi
            $table->string('condition_photo_before')->nullable();
            $table->string('condition_photo_after')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
