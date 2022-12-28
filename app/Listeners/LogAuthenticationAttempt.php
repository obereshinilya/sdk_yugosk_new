<?php

namespace App\Listeners;

use App\Models\Logs;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogAuthenticationAttempt
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
     * @param  Attempting  $event
     * @return void
     */
    public function handle(Attempting $event)
    {
        $this->Logs->setLogAttemp();
    }
}
