<?php

namespace Tweet\Service\Traits;

use Tweet\Events\UserLikedTweet;
use Tweet\Events\UserUnlikedTweet;
use Tweet\Models\Tweet;
use Tweet\Models\TweetCategory;
use Tweet\Models\TweetLike;

trait Likeable
{
    /**
     * get auth user tweet like status
     * 
     * @param int $userId
     * @param int $tweetId
     */
    public function checkUserLikes($userId, $tweetId) : ?String
    {
        $status = TweetLike::where('user_id', '=', $userId)
            ->where('tweet_id', '=', $tweetId)
            ->exists();
        if($status)
        {
            $status = TweetLike::where('user_id', '=', $userId)
            ->where('tweet_id', '=', $tweetId)
            ->first();
        }
        return $status ? $status->sign : null;
    }

    /**
     * get tweet like status
     * 
     * @param int $userId
     * @param int $tweetId
     */
    public function get($userId, $tweetId)
    {
        $tweet = null;
        if($this->checkUserLikes($userId, $tweetId))
        {
            $tweet = TweetLike::where('user_id', '=', $userId)
            ->where('tweet_id', '=', $tweetId)
            ->first();
        }
        return $tweet;
    }

    /**
     * create
     * 
     * @param int $userId
     * @param int $tweetId
     * @param string $sign
     */
    public function createTweetLike($userId, $tweetId, $sign)
    {
        return TweetLike::create([
            'user_id' => $userId,
            'tweet_id' => $tweetId,
            'sign' => $sign
        ]);
    }


    /**
     * like
     * 
     * @param int $userId
     * @param int $tweetId
     */
    public function like($userId, $tweetId)
    {
        if($this->checkUserLikes($userId, $tweetId))
        {
            $tweet = $this->get($userId, $tweetId);
            $tweet->update([
                'sign' => TWEET_LIKE
            ]);
            UserLikedTweet::dispatch([
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $tweet->user_id,
                'action' => TWEET_LIKE,
                'notifiable_type' => Tweet::class,
                'notifiable_id' => $tweet->id
            ]);
        }
        else
        {
            $tweet = $this->createTweetLike($userId, $tweetId, TWEET_LIKE);
            UserLikedTweet::dispatch([
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $tweet->user_id,
                'action' => TWEET_LIKE,
                'notifiable_type' => Tweet::class,
                'notifiable_id' => $tweet->id
            ]);
        }
    }

    /**
     * unlike
     * 
     * @param int $userId
     * @param int $tweetId
     */
    public function unlike($userId, $tweetId)
    {
        if($this->checkUserLikes($userId, $tweetId))
        {
            $tweet = $this->get($userId, $tweetId);
            $tweet->update([
                'sign' => TWEET_UNLIKE
            ]);
            UserUnlikedTweet::dispatch([
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $tweet->user_id,
                'action' => TWEET_UNLIKE,
                'notifiable_type' => Tweet::class,
                'notifiable_id' => $tweet->id
            ]);
        }
        else
        {
            $tweet = $this->createTweetLike($userId, $tweetId, TWEET_UNLIKE);
            UserUnlikedTweet::dispatch([
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $tweet->user_id,
                'action' => TWEET_UNLIKE,
                'notifiable_type' => Tweet::class,
                'notifiable_id' => $tweet->id
            ]);
        }
    }

    /**
     * count tweet likes
     * 
     * @param int $tweetId
     */
    public function countLike($tweetId)
    {
        return TweetLike::where('tweet_id', '=', $tweetId)
            ->where('sign', '=', TWEET_LIKE)
            ->count();
    }

    /**
     * count tweet unlikes
     * 
     * @param int $tweetId
     */
    public function countUnlike($tweetId)
    {
        return TweetLike::where('tweet_id', '=', $tweetId)
            ->where('sign', '=', TWEET_UNLIKE)
            ->count();
    }
    
}