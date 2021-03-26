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
          $date_now = Carbon::now();
          $status = ['scheduled', 'rescheduled'];
          $agenda_details = Agenda_detail::whereIn('status', $status)->get();

          foreach ($agenda_details as $agenda_detail) {
            $session_date_expired = Carbon::parse($agenda_detail->date.' '.$agenda_detail->time)->addDays(1)->addMinutes(1);
            if ($session_date_expired < $date_now) {
              $agenda_detail->status = 'canceled';
              $agenda_detail->update();
            }
          }
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
