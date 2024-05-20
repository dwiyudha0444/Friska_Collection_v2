<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'pemilik@example.com',
                'password' => Hash::make('test123'),
                'role' => 'pemilik',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'admin@example.com',
                'password' => Hash::make('test123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Jim Doe',
                'email' => 'karyawan@example.com',
                'password' => Hash::make('test123'),
                'role' => 'karyawan',
            ],
        ]);
    }
}
