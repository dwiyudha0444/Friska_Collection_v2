<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Models\FilterPenjualanPerbulan;
use Carbon\Carbon;

class MovingAverage
{
    public static function calculateMovingAverage($productId, $period = 4)
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
}
