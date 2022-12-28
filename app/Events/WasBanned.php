<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WasBanned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
//    public $user_name;
//    public $data;
//    public $ip;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->user_name = $user_name;
//        $this->data = $data;
//        $this->ip = $ip;
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
