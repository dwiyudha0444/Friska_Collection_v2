<?php

namespace App\Helpers;

use App\Models\FilterPenjualanPerbulan;
use Carbon\Carbon;

class MovingAverageHelper
{
    public static function calculateMovingAverage($productId, $period = 3)
    {
        $sales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $totalQty = $sales->sum('qty');
        $average = $totalQty / $period;

        return $average;
    }

    // public static function calculateMovingAverage($productId)
    // {
    //     // Ambil nilai periode dari tabel Periode
    //     $periodData = Periode::first();  // Asumsi hanya ada satu baris data
    //     $period = $periodData ? $periodData->periode : 3;  // Default ke 3 jika tidak ada data
    
    //     // Jika periode adalah nol, kembalikan nol untuk menghindari pembagian oleh nol
    //     if ($period == 0) {
    //         return 0;
    //     }
    
    //     // Ambil data penjualan untuk produk dan periode yang ditentukan
    //     $sales = FilterPenjualanPerbulan::where('id_produk', $productId)
    //         ->orderBy('created_at', 'desc')
    //         ->take($period)
    //         ->get();
    
    //     // Cek apakah data penjualan kosong
    //     if ($sales->isEmpty()) {
    //         return 0;
    //     }
    
    //     // Hitung total kuantitas dan rata-rata
    //     $totalQty = $sales->sum('qty');
    //     $average = $totalQty / $period;
    
    //     return $average;
    // }
}
