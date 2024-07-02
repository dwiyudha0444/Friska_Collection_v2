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
}
