<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Agenda_detail;
use Carbon\Carbon;

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
        $schedule->call(function () {
            $time_now = Carbon::now()->setTimezone('Asia/Jakarta')->format('h:i:s');
            $date_now = Carbon::now()->toDateString();

            Agenda_detail::where('date', $date_now)->where('time', '<', $time_now)->orWhere('status', 'scheduled')->update(['status' => 'canceled']);
            Agenda_detail::where('date', $date_now)->where('time', '<', $time_now)->orWhere('status', 'rescheduled')->update(['status' => 'canceled']);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
