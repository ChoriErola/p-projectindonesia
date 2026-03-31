<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Backup database setiap hari jam 02:00 pagi
        $schedule->command('backup:database')
            ->dailyAt('02:00')
            ->withoutOverlapping()
            ->onSuccess(function () {
                Log::info('Backup database berhasil');
            })
            ->onFailure(function () {
                Log::error('Backup database gagal');
            });

        // Optional: Backup setiap 6 jam
        // $schedule->command('backup:database')
        //     ->everyFourHours()
        //     ->withoutOverlapping();
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
