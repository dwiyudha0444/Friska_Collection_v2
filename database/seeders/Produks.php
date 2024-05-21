<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Produks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama' => 'Celana Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'stok' => '50',
            ],
            [
                'nama' => 'Baju Koko',
                'id_kategori' => '2',
                'harga' => '25000',
                'stok' => '60',
            ],
        ]);
    }
}
