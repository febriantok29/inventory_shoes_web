<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_employees')->insert([
            'code' => 'ADM001',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
