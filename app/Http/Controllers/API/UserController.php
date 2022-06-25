<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Profile\Service\Facade\Profile;

class UserController extends Controller
{
    //

    public function show()
    {
        return new UserResource(Profile::getUser(auth()->user()->id));
    }

    public function following()
    {
        return UserResource::collection(Profile::usersIFollow(auth()->user()->id));
    }

    public function follows()
    {
        return UserResource::collection(Profile::usersFollowMe(auth()->user()->id));
    }
}
