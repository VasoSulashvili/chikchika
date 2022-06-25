<?php

namespace Tweet\Service\Traits;

use Carbon\Carbon;
use Profile\Service\Facade\Profile;
use Tweet\Events\UserTweeted;
use Tweet\Models\Tweet;

trait CRUD
{
    /**
     * Tweets
     * 
     * @param int|null $userId
     * @param int|null $tweetCategoryId
     * @param array $followed
     * @param int|null $paginate
     */
    public function tweets($userId = null, $tweetCategoryId = null, $followed = [], $paginate = null, $hours = null)
    {

        $tweets = Tweet::select('*',
            'tweets.id AS tweet_id',
            'tweets.created_at AS tweet_created_at',
            'users.id AS user_id',
            'users.name AS user_name',
            'users.email AS user_email',
            'profiles.first_name AS user_first_name',
            'profiles.last_name AS user_last_name')
            ->orderBy('tweets.id', 'desc');
        if(!is_null($hours))
        {
            $yesterday = Carbon::yesterday();
            $time = $yesterday->addHours($hours);
            $tweets->where('tweets.created_at', '>', $time);
        }
        if(!is_null($tweetCategoryId))
        {
            $tweets->where('tweet_category_id', '=', $tweetCategoryId);
        }
            
        $tweets->leftJoin('users', 'tweets.user_id', '=', 'users.id')
            ->leftJoin('tweet_categories', 'tweets.tweet_category_id', '=', 'tweet_categories.id')
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id');
        // if guest
        if(!auth()->check())
        {
            $tweets->where('profiles.public', '=', 1);
        }
        else
        {
            // auth user's page or followed user's page
            if(auth()->user()->id == $userId || in_array($userId, $followed))
            {
                $tweets->where('tweets.user_id', '=', $userId);
            }
            elseif(auth()->check() && is_null($userId))
            {
                $ids = array_merge([auth()->user()->id], $followed);
                $tweets->whereIn('tweets.user_id', $ids);
            }
            else
            {
                if(!in_array($userId, $followed))
                {
                    $tweets
                        ->where('tweets.user_id', '=', $userId)
                        ->where('profiles.public', '=', 1);
                }
            }
        }
        
        if(is_null($paginate))
        {
            return $tweets->get();
        }
        return $tweets->cursorPaginate($paginate);
    }
    /**
     * create
     * 
     * @param int $userId
     * @param int $tweetCategoryId
     * @param string $body
     */
    public function create(int $userId, int $tweetCategoryId, string $body)
    {
        $tweet = Tweet::create([
            'user_id' => $userId,
            'tweet_category_id' => $tweetCategoryId,
            'body' => $body
        ]);
        
        return $tweet;
    }

    /**
     * get tweet
     * 
     * @param int $tweetId
     */
    public function getTweet($tweetId)
    {
        $tweet = Tweet::where('tweets.id', "=", $tweetId)
            ->select(
                'tweets.id AS id',
                'tweets.body AS body',
                'tweets.user_id AS user_id',
                'tweets.created_at AS created_at',
                'users.email AS user_email',
                'users.name AS user_name',
                'profiles.first_name AS user_first_name',
                'profiles.last_name AS user_last_name',
            )
            ->leftJoin('users', 'tweets.id', '=', 'users.id')
            ->leftJoin('profiles', 'tweets.user_id', '=', 'profiles.user_id')
            ->first();
        $comments = $this->tweetComments($tweetId);
        $tweet->comments = $comments;
        return $tweet;
    }

    /**
     * email notification tweets
     * 
     * @param int @userId
     */
    public function emailNotificationTweets($userId, $lastDays, $dayHour)
    {
        $today = Carbon::today();
        $lastDay = $today->subDays($lastDays);
        $fromTime = $lastDay->addHours($dayHour);
        $followings = Profile::getWhoIFollow($userId)->pluck('followed_user_id')->toArray();
        $tweets = Tweet::select('*',
            'tweets.id AS tweet_id',
            'tweets.created_at AS tweet_created_at',
            'users.id AS user_id',
            'users.name AS user_name',
            'users.email AS user_email',
            'profiles.first_name AS user_first_name',
            'profiles.last_name AS user_last_name')
            ->leftJoin('users', 'tweets.user_id', '=', 'users.id')
            ->leftJoin('tweet_categories', 'tweets.tweet_category_id', '=', 'tweet_categories.id')
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->orderBy('tweets.id', 'desc')
            ->whereIn('tweets.user_id', array_merge([$userId], $followings))
            ->where('tweets.created_at', '>', $fromTime)
            ->get();
        return $tweets;
    }
}