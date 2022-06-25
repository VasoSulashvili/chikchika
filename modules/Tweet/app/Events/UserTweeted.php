<?php

namespace Tweet\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserTweeted implements ShouldQueue, ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventData;
    public $followers;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventData, $followers)
    {
        $this->eventData = $eventData;
        $this->followers = $followers;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $broadcasArray = [];
        foreach($this->followers as $follower)
        {
            $broadcasArray[] = new PrivateChannel('user-channel.' . $follower);
        }
        return $broadcasArray;
        // return new PrivateChannel('user-channel.' . $this->eventData['to_user_id']);
    }
}
