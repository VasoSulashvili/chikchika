<?php

namespace Notification\Service\Facade;

use Illuminate\Support\Facades\Facade;

class Notification extends Facade
{
    protected static function getFacadeAccessor() { return 'NotificationService'; }
}