<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Profile\Service\Facade\Profile;
use Tweet\Events\UserTweeted;
use Tweet\Models\Tweet as ModelsTweet;
use Tweet\Service\Facade\Tweet;

class NewTweet extends Component
{
    public $showTweetModal = false;
    public $tweetCategories = [];
    public $tweetCategoryId;
    public $tweetBody;

    protected $rules = [
        'tweetBody' => 'required|min:6|max:140|string',
        'tweetCategoryId' => 'required|integer',
    ];


    public function showTweetModal()
    {
        $this->showTweetModal = true;
    }

    public function livewireCancel()
    {
        $this->resetData();
        $this->emit('refreshTweets');
    }

    public function livewireSubmit()
    {
        $this->validate();
        $tweet = Tweet::create(
            auth()->user()->id,
            $this->tweetCategoryId,
            $this->tweetBody
        );
        $followerIds = Profile::getWhoFollowMe(auth()->user()->id)->pluck('follower_user_id')->toArray();
        UserTweeted::dispatch([
            'from_user_id' => $tweet->user_id,
            // 'to_user_id' => $tweet->user_id,
            'action' => TWEET_CREATED,
            'notifiable_type' => ModelsTweet::class,
            'notifiable_id' => $tweet->id
        ], $followerIds);
        
        $this->emit('refreshTweets');
        $this->resetData();
    }

    private function resetData()
    {
        $this->showTweetModal = false;
        $this->tweetCategoryId = null;
        $this->tweetBody = null;
    }

    public function mount()
    {
        $this->tweetCategories = Tweet::tweetCategories();
    }

    public function updated($tweetBody)
    {
        $this->validateOnly($tweetBody);
    }



    public function render()
    {
        return view('livewire.new-tweet');
    }
}
