<?php

namespace Notification\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\View;
use Notification\Service\Facade\Notification;

class UnseenNotification
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            View::share('unseenNotifications', Notification::notifications('DESC', null, false));
        }
 
        return $next($request);
    }
    
}
