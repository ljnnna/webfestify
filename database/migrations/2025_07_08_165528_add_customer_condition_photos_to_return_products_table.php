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
        Schema::table('return_products', function (Blueprint $table) {
            $table->json('customer_condition_photos')->nullable()->after('quantity_returned');
        });
    }
    
    public function down(): void
    {
        Schema::table('return_products', function (Blueprint $table) {
            $table->dropColumn('customer_condition_photos');
        });
    }
};
