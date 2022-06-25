<?php

namespace Profile\Service\Facade;

use Illuminate\Support\Facades\Facade;

class Profile extends Facade
{
    protected static function getFacadeAccessor() { return 'ProfileService'; }
}