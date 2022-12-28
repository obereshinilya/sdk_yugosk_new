<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddLogs
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_name;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($user_name, $data, $ip)
    {
        $this->user_name = $user_name;
        $this->data = $data;
        $this->ip = $ip;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
