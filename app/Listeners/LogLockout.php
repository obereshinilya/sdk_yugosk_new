<?php

namespace App\Listeners;

use App\Models\Logs;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogLockout
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
     * @param  Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        $this->Logs->setLogLock();
    }
}
