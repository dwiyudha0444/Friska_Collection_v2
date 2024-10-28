<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Models\FilterPenjualanPerbulan;
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
        $mad = $latestSales->qty - $movingAverage; // atau beberapa perhitungan lain

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
        $mad = $latestSales->qty - $movingAverage;

        return $mad;
    }

}
