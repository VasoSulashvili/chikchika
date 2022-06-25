<?php

namespace Profile\Service;

use Profile\Service\Traits\Userable;
use Profile\Service\Traits\CRUD;
use Profile\Service\Traits\Followable;

class ProfileService
{
    use Userable, CRUD, Followable;
}