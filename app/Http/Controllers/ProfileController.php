<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Profile\Service\Facade\Profile;
use App\Exceptions\ErrorPageException;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('unseen.notifications');
        $this->middleware('profile.owner')->except(['show']);
    }

    public function showToken(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::get(null, $user->id);
        return view('profile.token')
            ->with('user', $user)
            ->with('profile', $profile);
    }

    public function createToken(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::get(null, $user->id);
        $token = $request->user()->createToken($request->user()->name);
        return view('profile.token')
            ->with('user_token', $token->plainTextToken)
            ->with('user', $user)
            ->with('profile', $profile);
    }

    public function show(Request $request, $user)
    {
        if(!Profile::checkUser($user)) { throw new ErrorPageException(403, "User not found"); }
        $user = Profile::getUser($user);
        $profile = Profile::get(null, $user->id);
        
        return view('profile.show')
            ->with('user', $user)
            ->with('profile', $profile);
    }

    public function edit(Request $request, $user)
    {
        if(!Profile::checkUser($user)) { throw new ErrorPageException(403, "User not found"); }
        $user = Profile::getUser($user);
        $profile = Profile::get(null, $user->id);
        
        return view('profile.edit')
            ->with('user', $user)
            ->with('profile', $profile);
    }

    public function update(UpdateProfileRequest $request, $user)
    {
        if(!Profile::checkUser($user)) { throw new ErrorPageException(403, "User not found"); }
        $user = Profile::getUser($user);
        $profile = Profile::get(null ,$user->id);
        Profile::update(
            $profile, 
            $request->input('first_name'), 
            $request->last_name, 
            $request->public, 
            null);
        return back();
    }
}
