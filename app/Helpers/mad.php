<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Models\FilterPenjualanPerbulan;
use Carbon\Carbon;

class mad
{
    public static function calculateMAD($productId, $period = 3)
    {
        // Ambil data penjualan per bulan untuk produk tertentu
        $sales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        // Dapatkan Moving Average dari helper MovingAverageHelper
        $movingAverage = MovingAverage::calculateMovingAveragePeriodeTiga($productId, $period);

        // Hitung Mean dari data penjualan asli
        $totalQty = $sales->sum('qty');
        $dataCount = $sales->count();
        $mean = $totalQty / $dataCount;

        // Hitung Deviasi Absolut dari Mean dan akumulasikan
        $mad = 0;
        foreach ($sales as $sale) {
            $mad += abs($sale->qty - $mean);
        }

        // Hitung MAD
        $mad = $mad / $dataCount;

        return $mad;
    }

    public static function calculateMADPeriodeEmpat($productId, $period = 4)
    {
        // Ambil data penjualan per bulan untuk produk tertentu
        $sales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        // Dapatkan Moving Average dari helper MovingAverageHelper
        $movingAverage = MovingAverage::calculateMovingAveragePeriodeTiga($productId, $period);

        // Hitung Mean dari data penjualan asli
        $totalQty = $sales->sum('qty');
        $dataCount = $sales->count();
        $mean = $totalQty / $dataCount;

        // Hitung Deviasi Absolut dari Mean dan akumulasikan
        $mad = 0;
        foreach ($sales as $sale) {
            $mad += abs($sale->qty - $mean);
        }

        // Hitung MAD
        $mad = $mad / $dataCount;

        return $mad;
    }

}
