<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'full_name' => 'Kale Lincolnshire',
            'username' => 'lincolnshire',
            'password' => Hash::make('kale123'), // password bisa kamu ganti
            'role' => 2, // kalau kamu pakai role untuk admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
