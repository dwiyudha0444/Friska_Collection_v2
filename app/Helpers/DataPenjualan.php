<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataPenjualan
{
    public static function dataPenjualan($productId)
    {
        // Ambil data penjualan terbaru per bulan untuk produk tertentu
        $latestSales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if (!$latestSales) {
            return 0; // Atau sesuaikan dengan logika penanganan jika data tidak ditemukan
        }
    
        return $latestSales->qty; // Mengembalikan nilai qty dari data penjualan terbaru
    }
    
}