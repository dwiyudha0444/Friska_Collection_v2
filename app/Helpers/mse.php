<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Helpers\mad;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class mse
{
    public static function calculateMSE($productId)
    {
        // ambil data mad
        $mad = mad::calculateMAD($productId);

        // proses hitung
        $mse = $mad * $mad; 

        return $mse;
    }

    public static function calculateMSEPeriodeEmpat($productId)
    {
        // ambil data mad
        $mad = mad::calculateMADPeriodeEmpat($productId);

        // proses hitung
        $mse = $mad * $mad; 

        return $mse;
    }

    public static function calculateTotalMSE($productId, $period = 3)
    {
        $sales = Prediksi::where('id_produk', $productId)
            ->where('id_periode', 3) 
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $getTotalMSE = $sales->sum('mse');
        $totalMSE = $getTotalMSE / 3;
        
        return $totalMSE;
    }
    
    public static function calculateTotalMSEPeriodeEmpat($productId, $period = 4)
    {
        $sales = Prediksi::where('id_produk', $productId)
            ->where('id_periode', 4) 
            ->orderBy('created_at', 'desc')
            ->take($period)
            ->get();

        if ($sales->isEmpty()) {
            return 0;
        }

        $getTotalMSE = $sales->sum('mse');
        $totalMSE = $getTotalMSE / 4;
        
        return $totalMSE;
    }

    

}
