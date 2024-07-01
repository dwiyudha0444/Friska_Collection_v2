<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FilterPenjualanPerbulan;
use Carbon\Carbon;

class UpdateMonthlySales extends Command
{
    protected $signature = 'update:monthly-sales';
    protected $description = 'Update monthly sales data to 0 if there are no entries for the month';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Updating monthly sales data...');

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $allProducts = FilterPenjualanPerbulan::all();

        foreach ($allProducts as $product) {
            $sales = FilterPenjualanPerbulan::where('id_produk', $product->id_produk)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->first();

            if (!$sales) {
                FilterPenjualanPerbulan::create([
                    'id_produk' => $product->id_produk,
                    'nama' => $product->nama,
                    'id_kategori' => $product->id_kategori,
                    'image' => $product->image,
                    'harga' => $product->harga,
                    'qty' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $this->info('Monthly sales data updated successfully.');
    }
}
