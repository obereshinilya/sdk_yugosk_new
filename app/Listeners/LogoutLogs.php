<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Logs;

class LogoutLogs
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $Logs;
    public function __construct(Logs $Logs)
    {
        $this->Logs = $Logs;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $this->Logs->setLogOutLog();
    }
}
