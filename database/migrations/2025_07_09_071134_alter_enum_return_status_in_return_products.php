<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE return_products MODIFY COLUMN return_status ENUM('in_process', 'collected', 'checked', 'completed') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE return_products MODIFY COLUMN return_status ENUM('in_process', 'completed') NOT NULL");
    }
};
