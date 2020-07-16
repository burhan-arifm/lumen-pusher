<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class UserDeleted extends Event implements ShouldBroadcast
{
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Set broadcast to specific channel.
     *
     * @return Channel/PrivateChannel/PresenceChannel
     **/
    public function broadcastOn()
    {
        return new Channel("user");
    }

    /**
     * Get the data to broadcast
     *
     * @return Array data that want to broadcast
     **/
    public function broadcastWith()
    {
        return ["user-id" => $this->user_id];
    }
}
