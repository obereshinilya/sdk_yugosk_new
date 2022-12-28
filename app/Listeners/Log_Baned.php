<?php

namespace App\Listeners;

use App\Events\WasBanned;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Log_Baned
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WasBanned  $event
     * @return void
     */
    public function handle(WasBanned $event)
    {
        Logs::create([
   //         'username' => $event->user_name,
    //        'ip' => $event->ip,
            'created_at' =>Carbon::now()
      //      'description' => 'Пользователь '.$event->user_name .' заблокировал пользователя '.$event->data

        ]);
    }
}
