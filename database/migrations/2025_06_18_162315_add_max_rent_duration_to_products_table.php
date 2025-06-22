<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->unsignedInteger('max_rent_duration')->default(1); // default 1 hari
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('max_rent_duration');
    });
}

};
