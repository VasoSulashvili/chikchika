<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweetRequest;
use App\Http\Requests\StoreReplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tweet\Http\Resources\TweetCommentResource;
use Tweet\Http\Resources\TweetResource;
use Tweet\Models\Tweet as ModelsTweet;
use Tweet\Models\TweetComment;
use Tweet\Service\Facade\Tweet;

class TweetController extends BaseController
{
    public function tweets()
    {
        return TweetResource::collection(Tweet::tweets());
    }

    public function tweet(Request $request, $tweet_id)
    {
        return new TweetResource(ModelsTweet::find($tweet_id));
    }

    public function createTweet(StoreTweetRequest $request)
    {
        return Tweet::create(
            Auth::user()->id, 
            $request->input('tweet_category_id'), 
            $request->input('body'));
    }

    public function replies(Request $request, $tweet_id)
    {
        return TweetCommentResource::collection(TweetComment::where('tweet_id', '=', $tweet_id)->get());
    }

    public function createReply(StoreReplyRequest $request)
    {
        Tweet::createComment(
            $request->input('tweet_id'), 
            Auth::user()->id, 
            $request->input('body'));
    }

    public function like(Request $request, $tweet_id)
    {
        return Tweet::like(Auth::user()->id, $tweet_id);
    }

    public function unlike(Request $request, $tweet_id)
    {
        return Tweet::unlike(Auth::user()->id, $tweet_id);
    }
}
