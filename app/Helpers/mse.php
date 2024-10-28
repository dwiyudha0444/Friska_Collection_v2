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
        $mad = mad::calculateMAD($productId);

        // Misalkan $mad adalah hasil dari beberapa perhitungan yang akan Anda lakukan
        // Gantilah logika ini dengan logika perhitungan MAD yang sebenarnya
        $mse = $mad * $mad; // atau beberapa perhitungan lain

        return $mse;
    }

    public static function calculateMSEPeriodeEmpat($productId)
    {
        $mad = mad::calculateMADPeriodeEmpat($productId);

        // Misalkan $mad adalah hasil dari beberapa perhitungan yang akan Anda lakukan
        // Gantilah logika ini dengan logika perhitungan MAD yang sebenarnya
        $mse = $mad * $mad; // atau beberapa perhitungan lain

        return $mse;
    }

}
