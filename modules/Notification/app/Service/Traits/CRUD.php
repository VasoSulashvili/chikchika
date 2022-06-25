<?php

namespace Notification\Service\Traits;

use Illuminate\Support\Facades\Auth;
use Notification\Models\Notification;

trait CRUD
{
    /**
     * get notifications
     * 
     */
    public function notifications($order = 'ASC', $paginate = null, $seen = null)
    {
        $notifications = Notification::where('to_user_id', '=', Auth::user()->id)
            ->orderBy('id', $order);
        if(!is_null($seen))
        {
            $notifications->where('seen', '=', $seen ? 1 : 0);
        }
        if(!is_null($paginate))
        {
            return $notifications->cursorPaginate(
                $perPage = $paginate, $columns = ['*'], $pageName = 'notifications'
            );
        }
        return $notifications->get();
    }

    /**
     * get
     * 
     * @param int $id
     */
    public function get($id)
    {
        return Notification::find($id);
    }

    /**
     * Create
     * 
     * @param int $fromUserId
     * @param int $toUserId
     * @param string $action
     * @param string|null $notifiableType
     * @param int|null $notifiableId
     */
    public function create(int $fromUserId, int $toUserId, string $action, $notifiableType = null, $notifiableId = null)
    {
        $notification = Notification::create([
            'to_user_id' => $toUserId,
            'from_user_id' => $fromUserId,
            'notifiable_id' => $notifiableId ? (int) $notifiableId : null,
            'notifiable_type' => $notifiableType ? (string) $notifiableType : null,
            'action' => $action,
        ]);
        return $notification;
    }
}