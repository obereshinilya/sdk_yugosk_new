<?php

namespace App\Listeners;

use App\Events\AddLogs;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Log_pdf
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
     * @param  AddLogs  $event
     * @return void
     */
    public function handle(AddLogs $event)
    {
        Logs::create([
        'username' => $event->user_name,
        'ip' => $event->ip,
            'created_at' =>Carbon::now(),
            'description' => 'Пользователь вывел на печать и сохранил '.$event->data.' файл '

    ]);
    }
}
