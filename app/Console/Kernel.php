<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:monthly-sales')->monthlyOn(1, '00:00');

        $schedule->command('update:predictions')->monthlyOn(1, '00:00');

        // // Update monthly sales 10 menit sebelum tengah malam pada hari terakhir bulan
        // $schedule->command('update:monthly-sales')
        // ->when(function () {
        //     // Cek apakah hari ini adalah hari terakhir bulan
        //     return \Carbon\Carbon::now()->endOfMonth()->isToday();
        // })
        // ->at('23:50');

        // // Update predictions tepat tengah malam pada hari terakhir bulan
        // $schedule->command('update:predictions')
        //     ->when(function () {
        //         // Cek apakah hari ini adalah hari terakhir bulan
        //         return \Carbon\Carbon::now()->endOfMonth()->isToday();
        //     })
        //     ->at('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
