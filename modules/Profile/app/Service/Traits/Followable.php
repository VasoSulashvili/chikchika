<?php

namespace Profile\Service\Traits;

use App\Models\User;
use Profile\Events\UserFollowed;
use Illuminate\Support\Facades\DB;
use Profile\Events\UserUnfollowed;

trait Followable
{
   /**
     * get following
     * 
     * @param int $followerId
     * @param int $followedId
     */
    public function following($followerId, $followedId)
    {
        $following = null;
        $following = DB::table('followings')
            ->where('follower_user_id', '=', $followerId)
            ->where('followed_user_id', '=', $followedId)
            ->first();
        return $following;
    }
    /**
     * follow
     * 
     * @param int $followerId
     * @param int $followedId
     */
    public function follow($followerId, $followedId)
    {
        $following = $this->following($followerId, $followedId);
        if($following)
        {
            $this->delete($followerId, $followedId);
            UserUnfollowed::dispatch([
                'from_user_id' => $followerId,
                'to_user_id' => $followedId,
                'action' => PROFILE_FS_UNFOLLOWED
            ]);
        }
        else
        {
            $following = DB::table('followings')
                ->insert([
                    'follower_user_id' => $followerId,
                    'followed_user_id' => $followedId
                ]);
            UserFollowed::dispatch([
                'from_user_id' => $followerId,
                'to_user_id' => $followedId,
                'action' => PROFILE_FS_FOLLOWED
            ]);
        }
        
    }

    /**
     * delete
     * 
     * @param int $followerId
     * @param int $followedId
     */
    public function delete($followerId, $followedId)
    {
        $following = $this->following($followerId, $followedId);
        if($following)
        {
            DB::table('followings')
            ->where('follower_user_id', '=', $followerId)
            ->where('followed_user_id', '=', $followedId)
            ->delete();
        }
        
    }

    /**
     * get followed. - users, that user follows
     * 
     * @param int $userId
     */
    public function getWhoIFollow(int $userId)
    {
        return DB::table('followings')->where('follower_user_id', '=', $userId)->get();
    }

    /**
     * get followings. - users, that user followed
     * 
     * @param int $userId
     */
    public function getWhoFollowMe(int $userId)
    {
        return DB::table('followings')->where('followed_user_id', '=', $userId)->get();
    }

    /**
     * users i follow
     */
    public function usersIFollow($userId)
    {
        $follow = $this->getWhoIFollow($userId)->pluck('followed_user_id')->toArray();
        $users = User::whereIn('id', $follow)->get();
        return $users;
    }

    /**
     * users follow me
     */
    public function usersFollowMe($userId)
    {
        $follow = $this->getWhoFollowMe($userId)->pluck('follower_user_id')->toArray();
        $users = User::whereIn('id', $follow)->get();
        return $users;
    }

}