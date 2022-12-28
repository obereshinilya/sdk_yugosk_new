<?php

namespace App\Listeners;

use App\Events\WasUnbanned;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Log_Unbanned
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
     * @param  WasUnbanned  $event
     * @return void
     */
    public function handle(WasUnbanned $event)
    {

        Logs::create([
           'username' => $event->user_name,
          'ip' => $event->ip,
            'created_at' =>Carbon::now(),
            'description' => 'Пользователь '.$event->user_name .' '.$event->data

        ]);
    }
}
