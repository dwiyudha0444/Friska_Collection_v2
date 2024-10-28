<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Helpers\MovingAverage;
use App\Helpers\mad;
use App\Models\FilterPenjualanPerbulan;
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

}
