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
//        $schedule->call('App\Http\Controllers\MathController@update_kipd_internal_checks')->cron('1 0 * * *');
  //      $schedule->call('App\Http\Controllers\MathController@update_perfomance_plan_KiPD')->cron('2 0 * * *');
    //    $schedule->call('App\Http\Controllers\MathController@update_plan_industrial_safety')->cron('3 0 * * *');
//	 $schedule->call('App\Http\Controllers\MathController@update_goals_trans_yugorsk')->cron('4 0 * * *');
  //     $schedule->call('App\Http\Controllers\MathController@check_update_status')->cron('5 0 * * *');

//        $schedule->call('App\Http\Controllers\MathController@create_record_indicator')->cron('5 0 * * *');

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
