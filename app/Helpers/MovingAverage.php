<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

use App\Models\FilterPenjualanPerbulan;
use Carbon\Carbon;

class MovingAverage
{
    public static function calculateMovingAveragePeriodeTiga($productId, $period = 3)
    {
        // Fetch the 4 most recent sales data points
        $sales = FilterPenjualanPerbulan::where('id_produk', $productId)
            ->orderBy('created_at', 'desc')
            ->take($period + 1) // Taking 4 data points to include the first one which we will exclude
            ->get();
    
        // If there are fewer than 4 data points, return null (or you can return an empty array or other indication)
        if ($sales->count() < 4) {
            return null;
        }
    
        // Exclude the most recent data point (first one)
        $sales = $sales->slice(1, $period);
    
        $totalQty = $sales->sum('qty');
        $average = $totalQty / $period;
    
        return $average;
    }
    
    

    public static function calculateMovingAverage($productId, $period = 4)
{
    // Fetch the 5 most recent sales data points
    $sales = FilterPenjualanPerbulan::where('id_produk', $productId)
        ->orderBy('created_at', 'desc')
        ->take($period + 1) // Taking 5 data points to include the first one which we will exclude
        ->get();

    // If there are fewer than 5 data points, return null
    if ($sales->count() < $period + 1) {
        return null;
    }

    // Exclude the most recent data point (first one)
    $sales = $sales->slice(1, $period);

    $totalQty = $sales->sum('qty');
    $average = $totalQty / $period;

    return $average;
}

}
