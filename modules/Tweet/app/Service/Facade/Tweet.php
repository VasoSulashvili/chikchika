<?php

namespace Tweet\Service\Facade;

use Illuminate\Support\Facades\Facade;

class Tweet extends Facade
{
    protected static function getFacadeAccessor() { return 'TweetService'; }
}