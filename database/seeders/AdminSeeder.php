<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_users')->insert([
            'name' => 'Admin Development',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Password untuk admin
            'role' => 1, // Menandakan sebagai admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('t_users')->insert([
            'name' => 'Admin Labtek',
            'email' => 'admin@labtek.com',
            'password' => Hash::make('password'), // Password untuk admin
            'role' => 1, // Menandakan sebagai admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
