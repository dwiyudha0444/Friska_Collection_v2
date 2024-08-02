<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use App\Helpers\MovingAverageHelper;
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

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Ambil id_produk yang unik dari entri terbaru dalam FilterPenjualanPerbulan
        $latestEntries = FilterPenjualanPerbulan::select('id_produk')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->distinct() // Ambil id_produk yang unik
            ->pluck('id_produk'); // Ambil id_produk saja

        foreach ($latestEntries as $productId) {
            // Ambil data terbaru untuk setiap id_produk dan tambahkan jika belum ada
            $latestSale = FilterPenjualanPerbulan::where('id_produk', $productId)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->latest()
                ->first();

            // Hitung rata-rata pergerakan
            $movingAverage = MovingAverageHelper::calculateMovingAverage($latestSale->id_produk);

            // Buat entri prediksi
            Prediksi::create([
                'id_produk' => $latestSale->id_produk,
                'nama' => $latestSale->nama,
                'id_kategori' => $latestSale->id_kategori,
                'periode' => 3,
                'ma' => $movingAverage,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Log::info('Created new prediction entry for product: ' . $latestSale->id_produk);
        }

        Log::info('Prediction data updated successfully.');
        $this->info('Prediction data updated successfully.');
    }
}
