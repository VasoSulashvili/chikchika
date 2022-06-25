<?php

namespace Notification\Service\Traits;

use Illuminate\Support\Facades\Auth;
use Notification\Models\Notification;

trait Notifiable
{
    private $actions = [
        PROFILE_FS_FOLLOWED => [
            'action' => 'followed you',
            'icon' => 'bi bi-person-plus'
        ],
        PROFILE_FS_UNFOLLOWED => [
            'action' => 'unfollowed you',
            'icon' => 'bi bi-person-dash'
        ],
        TWEET_LIKE => [
            'action' => 'liked tweet',
            'icon' => 'bi bi-hand-thumbs-up'
        ],
        TWEET_UNLIKE => [
            'action' => 'unliked tweet',
            'icon' => 'bi bi-hand-thumbs-down'
        ],
        TWEET_CREATED => [
            'action' => 'tweet created',
            'icon' => 'bi bi-twitter'
        ],
    ];


    /**
     * get action message
     * 
     * @param string $action
     */
    public function action($action)
    {
        return $this->actions[$action];
    }

    /**
     * update notification seen status
     * 
     * @param int $id
     */
    public function updateSeenStatus($id)
    {
        $notification = $this->get($id);
        $notification->update([
            'seen' => $notification->seen ? 0 : 1
        ]);
        return $notification;
    }
}