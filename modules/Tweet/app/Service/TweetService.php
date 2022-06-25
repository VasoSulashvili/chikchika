<?php

namespace Tweet\Service;

use Tweet\Service\Traits\Categoriable;
use Tweet\Service\Traits\Commentable;
use Tweet\Service\Traits\CRUD;
use Tweet\Service\Traits\Likeable;

class TweetService
{
    use CRUD, Categoriable, Likeable, Commentable;

}