<?php

namespace Tweet\Service\Traits;

use Illuminate\Support\Facades\DB;
use Tweet\Events\UserCommentedTweet;
use Tweet\Models\TweetCategory;
use Tweet\Models\TweetComment;

trait Commentable
{
    
     /**
     * count tweet comments
     * 
     * @param int $tweetId
     */
    public function countComment($tweetId)
    {
        return TweetComment::where('tweet_id', '=', $tweetId)
            ->count();
    }

    /**
     * count tweet comments
     * 
     * @param int $tweetId
     */
    public function createComment($tweetId, $userId, $body)
    {
        
        $comment = TweetComment::create([
            'tweet_id' => $tweetId,
            'user_id' => $userId,
            'body' => $body
        ]);

        UserCommentedTweet::dispatch([
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $userId,
            'action' => TWEET_LIKE,
            'notifiable_type' => TweetComment::class,
            'notifiable_id' => $comment->id
        ]);
        return $comment;
    }

    /**
     * get comments
     */
    public function tweetComments($tweetId)
    {
        return TweetComment::select(
            'tweet_comments.id AS id',
            'tweet_comments.body AS body',
            'tweet_comments.created_at AS created_at',
            'users.email AS user_email',
            'users.name AS user_name',
            'profiles.first_name AS user_first_name',
            'profiles.last_name AS user_last_name')
            ->where('tweet_id', '=', $tweetId)
            ->leftJoin('users', 'tweet_comments.user_id', '=', 'users.id')
            ->leftJoin('profiles', 'tweet_comments.user_id', '=', 'profiles.user_id')
            ->orderBy('tweet_comments.id', 'DESC')
        ->get();
    }
    
}