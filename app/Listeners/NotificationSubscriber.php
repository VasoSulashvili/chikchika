<?php

namespace App\Listeners;

use Profile\Events\UserFollowed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification\Events\Seen;
use Notification\Events\Unseen;
use Notification\Service\Facade\Notification;
use Profile\Events\UserUnfollowed;
use Tweet\Events\UserCommentedTweet;
use Tweet\Events\UserLikedTweet;
use Tweet\Events\UserTweeted;
use Tweet\Events\UserUnlikedTweet;

class NotificationSubscriber implements ShouldQueue
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

    public function createNotification($event)
    {
        Notification::create(
            $event->eventData['from_user_id'],
            $event->eventData['to_user_id'],
            $event->eventData['action'],
            isset($event->eventData['notifiable_id']) ? isset($event->eventData['notifiable_id']) : null,
            isset($event->eventData['notifiable_type']) ? isset($event->eventData['notifiable_type']) : null,
        );
    }

    public function createTweetedNotification($event)
    {
        foreach($event->followers as $follower)
        {
            Notification::create(
                $event->eventData['from_user_id'],
                $follower,
                $event->eventData['action'],
                isset($event->eventData['notifiable_id']) ? isset($event->eventData['notifiable_id']) : null,
                isset($event->eventData['notifiable_type']) ? isset($event->eventData['notifiable_type']) : null,
            );
        }
        // dd($event);
    }

    public function updateSeenStatus($event)
    {
        Notification::updateSeenStatus($event->notification->id);
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
            Seen::class, 
            [NotificationSubscriber::class, 'updateSeenStatus']
        );
        $events->listen(
            Unseen::class, 
            [NotificationSubscriber::class, 'updateSeenStatus']
        );
        $events->listen(
            UserFollowed::class,
            [NotificationSubscriber::class, 'createNotification']
        );
 
        $events->listen(
            UserUnfollowed::class,
            [NotificationSubscriber::class, 'createNotification']
        );
        
        $events->listen(
            UserLikedTweet::class,
            [NotificationSubscriber::class, 'createNotification']
        );
        $events->listen(
            UserUnLikedTweet::class,
            [NotificationSubscriber::class, 'createNotification']
        );
        $events->listen(
            UserCommentedTweet::class,
            [NotificationSubscriber::class, 'createNotification']
        );
        $events->listen(
            UserTweeted::class,
            [NotificationSubscriber::class, 'createTweetedNotification']
        );
    }
}
