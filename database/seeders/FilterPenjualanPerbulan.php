<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterPenjualanPerbulan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filter_penjualan_perbulan')->insert([
            [
                'id_produk' => '1',
                'nama' => 'Celana Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'qty' => '100',
                'created_at' => \Carbon\Carbon::now()->subMonths(), 
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'id_produk' => '2',
                'nama' => 'Baju Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'qty' => '120',
                'created_at' => \Carbon\Carbon::now()->subMonths(), 
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'id_produk' => '1',
                'nama' => 'Celana Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'qty' => '100',
                'created_at' => \Carbon\Carbon::now()->subMonths(2), 
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'id_produk' => '2',
                'nama' => 'Baju Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'qty' => '120',
                'created_at' => \Carbon\Carbon::now()->subMonths(2), 
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'id_produk' => '1',
                'nama' => 'Celana Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'qty' => '100',
                'created_at' => \Carbon\Carbon::now()->subMonths(3), 
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'id_produk' => '2',
                'nama' => 'Baju Jeans',
                'id_kategori' => '1',
                'harga' => '20000',
                'qty' => '120',
                'created_at' => \Carbon\Carbon::now()->subMonths(3), 
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
