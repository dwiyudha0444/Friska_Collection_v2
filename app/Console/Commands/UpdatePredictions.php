<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use Carbon\Carbon;
use Log;

class UpdatePredictions extends Command
{
    protected $signature = 'update:predictions';
    protected $description = 'Update prediction data on the 2nd of every month';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Updating prediction data...');
        Log::info('Starting prediction update.');

        if (Carbon::now()->day != 2) {
            $this->info('Today is not the 2nd of the month. Skipping update.');
            Log::info('Today is not the 2nd of the month. Skipping update.');
            return;
        }

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $salesData = FilterPenjualanPerbulan::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        foreach ($salesData as $data) {
            Prediksi::create([
                'id_produk' => $data->id_produk,
                'nama' => $data->nama,
                'id_kategori' => $data->id_kategori,
                'image' => $data->image,
                'harga' => $data->harga,
                'qty' => $data->qty,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            Log::info('Created new prediction entry for product: ' . $data->id_produk);
        }

        Log::info('Prediction data updated successfully.');
        $this->info('Prediction data updated successfully.');
    }
}

