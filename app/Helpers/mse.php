<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Helpers\mad;
use App\Models\FilterPenjualanPerbulan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class mad
{
    public static function calculateMSE($productId)
    {
        $mad = mad::calculateMAD($productId);

        // Misalkan $mad adalah hasil dari beberapa perhitungan yang akan Anda lakukan
        // Gantilah logika ini dengan logika perhitungan MAD yang sebenarnya
        $mse = $mad * $mad; // atau beberapa perhitungan lain

        return $mse;
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

        $movingAverage = MovingAverage::calculateMovingAverage($productId);

        // Misalkan $mad adalah hasil dari beberapa perhitungan yang akan Anda lakukan
        // Gantilah logika ini dengan logika perhitungan MAD yang sebenarnya
        $mad = $latestSales->qty - $movingAverage; // atau beberapa perhitungan lain

        return $mad;
    }

}
