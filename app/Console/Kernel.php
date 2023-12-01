<?php

namespace App\Console;

use App\Console\Commands\SendServicePetEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands=[
        SendServicePetEmail::class
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-service-pet-email')
        ->timezone('America/Sao_Paulo')
        ->everyMinute();
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
