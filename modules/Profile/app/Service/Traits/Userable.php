<?php

namespace Profile\Service\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait Userable
{
    public function register($email, $password, $remember = false)
    {
        $name = explode('@', $email)[0];
        $count = User::where('name', 'LIKE', $name)->get()->count();
        if($count) { $name = $name . '_' . $count; }
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        
        return $user;
    }

    /**
     * @param mixed $authenticable
     */
    public function login($authenticable)
    {
        if($authenticable instanceof User)
        {
            Auth::login($authenticable);
        }
        else
        {
            return Auth::attempt($authenticable);
        }
    }

    /**
     * Get user
     * 
     * @param mixed $user
     */
    public function checkUser($user) : bool
    {
        $result = null;
        if(is_int($user))
        {
            $result = User::select('*', 'profiles.id AS profile_id')
                ->where('users.id', '=', $user)
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->exists();
        }
        if(is_string($user))
        {
            $result = User::select('*', 'profiles.id AS profile_id')
                ->where('users.name', '=', $user)
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->exists();
        }
        return $result;
    }

    /**
     * Get user
     * 
     * @param mixed $user
     */
    public function getUser($user) : ?User
    {
        $result = null;
        if(is_int($user))
        {
            $result = User::select('*', 'profiles.id AS profile_id')
                ->where('users.id', '=', $user)
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->first();
        }
        if(is_string($user))
        {
            $result = User::select('*', 'profiles.id AS profile_id')
                ->where('users.name', '=', $user)
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->first();
        }
        return $result;
    }
}