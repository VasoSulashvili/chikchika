<?php

namespace Profile\Service\Traits;

use App\Models\User;
use Profile\Models\Profile;

trait CRUD
{
    public function profiles($paginate = null)
    {
        if(!is_null($paginate))
        {
            $user = User::select('*')->orderBy('id', 'asc')->cursorPaginate(
                $perPage = $paginate, $columns = ['*'], $pageName = 'users');
        }
        return $user;
    }

    /**
     * check
     * 
     * @param int|null $id
     * @param int|null $userId
     */
    public function check($id = null, $userId = null)
    {
        $profile = null;
        if(!is_null($id))
        {
            $profile = Profile::where("id", "=", $id)->exists();
        }
        if(!is_null($userId))
        {
            $profile = Profile::where('user_id', '=', $userId)->exists();
        }
        return $profile;
    }

    /**
     * get
     * 
     * @param int|null $id
     * @param int|null $userId
     */
    public function get($id = null, $userId = null)
    {
        $profile = null;
        if(!is_null($id))
        {
            $profile = Profile::find($id);
        }
        if(!is_null($userId))
        {
            $profile = Profile::where('user_id', '=', $userId)->first();
        }
        return $profile;
    }

    /**
     * create profile
     * 
     * @param int $userId
     * @param string $image
     * @param string $firstName
     * @param string $lastName
     * @param bool $public
     */
    public function create($userId, $image = null, $firstName = null, $lastName = null, $public = null)
    {
        $profile = Profile::create([
            'user_id' => $userId,
            'image' => $image,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'public' => $public ? 1 : 0
        ]);
        return $profile;
    }

    /**
     * update profile
     * 
     * @param mixed $profile
     * @param int $userId
     * @param string $image
     * @param string $firstName
     * @param string $lastName
     * @param bool $public
     */
    public function update($profile, $firstName = null, $lastName = null, $public = null, $image = null,)
    {
        if($profile instanceof Profile)
        {
            $profile->update([
                'image' => $image,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'public' => $public ? 1 : 0
            ]);
        }
        else
        {
            $profile = $this->get($profile);
            $profile->update([
                'image' => $image,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'public' => $public ? 1 : 0
            ]);
        }
        
        return $profile;
    }
}