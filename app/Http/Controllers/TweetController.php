<?php

namespace App\Http\Controllers;

use Tweet\Service\Facade\Tweet;

class TweetController extends Controller
{

    public function __construct()
    {
        $this->middleware('unseen.notifications');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tweets.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user, $tweet)
    {
        $tweet = Tweet::getTweet($tweet);
        return view('tweets.show')
            ->with('tweet', $tweet);
    }
}
