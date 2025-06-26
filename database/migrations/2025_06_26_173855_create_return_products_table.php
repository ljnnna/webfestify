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
        Schema::create('return_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('order_product_id')->constrained('order_products')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->integer('quantity_returned'); 
            $table->enum('return_status', [
                'in_process', 
                'completed', 
            ])->default('in_process');
            $table->timestamp('return_processed_at')->nullable(); 
            $table->timestamp('return_completed_at')->nullable();
            $table->enum('product_condition', [
                'excellent', 
                'good', 
                'fair', 
                'poor', 
                'damaged'
            ])->nullable();
            $table->json('condition_before')->nullable(); 
            $table->json('condition_after')->nullable(); 
            $table->text('condition_notes')->nullable(); 
            $table->decimal('penalty_amount', 10, 2)->default(0);  
            $table->timestamps();
            
            $table->index(['order_id', 'product_id']);
            $table->index('return_status');
            $table->index('return_processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_products');
    }
};
