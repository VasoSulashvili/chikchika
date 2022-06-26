<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Notification\Service\Facade\Notification as FacadeNotification;
use Profile\Service\Facade\Profile;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('unseen.notifications');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $profile = Profile::get(null, $user->id);
        return view('notification.index')
            ->with('notifications', FacadeNotification::notifications("DESC", 10))
            ->with('user', $user)
            ->with('profile', $profile);
    }
}
