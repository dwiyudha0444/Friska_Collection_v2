<?php

// File: app/Helpers/MovingAverageHelper.php

namespace App\Helpers;

class MovingAverage
{
    public static function calculateMovingAverage(array $data, int $period = 3)
    {
        $count = count($data);
        if ($count < $period) {
            return null; // Atau return 0 atau nilai lain jika data tidak cukup
        }

        $latestData = array_slice($data, -$period);
        $sum = array_sum($latestData);

        return $sum / $period;
    }
}
