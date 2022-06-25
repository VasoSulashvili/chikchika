<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Profile\Events\UserUnfollowed;

class UserFollowingSubscriber implements ShouldQueue
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

    public function userFollowed($event)
    {

    }

    public function userUnfollowed($event)
    {

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            UserFollowed::class,
            [UserFollowingSubscriber::class, 'userFollowed']
        );
 
        $events->listen(
            UserUnfollowed::class,
            [UserFollowingSubscriber::class, 'userUnfollowed']
        );
    }
}
