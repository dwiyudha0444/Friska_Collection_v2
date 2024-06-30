<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class mad
{
    public static function calculateMAD($productId)
    {
        // Ambil data penjualan terbaru per bulan untuk produk tertentu
        $latestSales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$latestSales) {
            return 0;
        }

        // ambil data ma
        $movingAverage = MovingAverage::calculateMovingAveragePeriodeTiga($productId);

        // proses hitung
        $mad = abs($latestSales->qty - $movingAverage); // atau beberapa perhitungan lain

        return $mad;
    }

    public static function calculateMADPeriodeEmpat($productId)
    {
        // Ambil data penjualan terbaru per bulan untuk produk tertentu
        $latestSales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->first();


        if (!$latestSales) {
            return 0;
        }

        // ambil data ma
        $movingAverage = MovingAverage::calculateMovingAverage($productId);

        // proses hitung
        $mad = abs($latestSales->qty - $movingAverage);

        return $mad;
    }

    public static function calculateTotalMad($productId, $period = 3)
    {
        $sales = Prediksi::where('id_produk', $productId)
            ->where('id_periode', 3) 
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $getTotalMad = $sales->sum('mad');
        $totalMad = $getTotalMad / 3;

        return $totalMad;
    }

    public static function calculateTotalMadPeriodeEmpat($productId, $period = 4)
    {
        $sales = Prediksi::where('id_produk', $productId)
            ->where('id_periode', 4) 
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $getTotalMad = $sales->sum('mad');
        $totalMad = $getTotalMad / 4;
        
        return $totalMad;
    }

}
