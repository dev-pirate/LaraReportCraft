<?php

namespace DevPirate\LaraReportCraft\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
    ];

    protected function scheduleTimezone()
    {
        return 'UTC'; // Adjust the timezone as needed
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('files:clean')->hourly();
    }
}
