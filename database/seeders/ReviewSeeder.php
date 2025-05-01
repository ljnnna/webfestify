<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'user_id' => 2, // pastikan ID user 1 udah ada
                'content' => 'Pelayanannya oke banget! hasil foto dan videonya jernihh kece abiezzz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'content' => 'Pengiriman cepat dan aman! Suka banget sama timnya ❤️',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
