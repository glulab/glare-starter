<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
		$schedule->command('queue:work --stop-when-empty --tries=3')->hourlyAt(33);
        $schedule->command('queue:retry all')->hourlyAt(18);
        $schedule->command('queue:flush')->weeklyOn(1, '4:04');
		$schedule->command('glare:cleanup --compile --force')->weeklyOn(1, '4:44');
        $schedule->command('glare:sitemap')->weeklyOn(1, '5:44');
        // $schedule->command('glare:scheduler-test --log --mail')->everyFiveMinutes(); // ->everyMinute() // ->dailyAt('01:31');
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
