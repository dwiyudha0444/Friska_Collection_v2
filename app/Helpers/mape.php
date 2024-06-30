<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Helpers\mad;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class mape
{
    public static function calculateMAPE($productId)
    {
        // Ambil data penjualan terbaru per bulan untuk produk tertentu
        $latestSales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->first();

            // ambil data mad
        $mad = mad::calculateMAD($productId);

        // proses hitung
        $mape = $mad / $latestSales->qty * 100 ; 

        return $mape;
    }

    public static function calculateMAPEPeriodeEmpat($productId)
    {
        // Ambil data penjualan terbaru per bulan untuk produk tertentu
        $latestSales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->first();

            // ambil data mad
        $mad = mad::calculateMADPeriodeEmpat($productId);

        // proses hitung
        $mape = $mad / $latestSales->qty * 100 ; 

        return $mape;

    }

    public static function calculateTotalMAPE($productId, $period = 3)
    {
        $sales = Prediksi::where('id_produk', $productId)
            ->where('id_periode', 3) 
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $getTotalMAPE = $sales->sum('mape');
        $totalMAPE = $getTotalMAPE / 4;
        
        return $totalMAPE;
    }

    public static function calculateTotalMAPEPeriodeEmpat($productId, $period = 4)
    {
        $sales = Prediksi::where('id_produk', $productId)
            ->where('id_periode', 4) 
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $getTotalMAPE = $sales->sum('mape');
        $totalMAPE = $getTotalMAPE / 4;
        
        return $totalMAPE;
    }
}
