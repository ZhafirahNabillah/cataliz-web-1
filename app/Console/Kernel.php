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
            $date_now = Carbon::now('Asia/Jakarta')->toDateString();
            $time_now = Carbon::now('Asia/Jakarta')->toTimeString();

            //mis: date now = 27-08-2021, time now = 22:00
            //mis: session date = 27-08-2021, session time = 21:30
            Agenda_detail::where('date', '<', $date_now)->where('time', '<', $time_now)->where('status', 'scheduled')->update(['status' => 'canceled']);
            Agenda_detail::where('date', '<', $date_now)->where('time', '<', $time_now)->where('status', 'rescheduled')->update(['status' => 'canceled']);
            Agenda_detail::where('date', '<', $date_now)->where('time', '<', $time_now)->where('status', 'unschedule')->update(['status' => 'canceled']);
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
