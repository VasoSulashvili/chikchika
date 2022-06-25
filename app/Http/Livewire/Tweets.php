<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Profile\Service\Facade\Profile;
use Tweet\Service\Facade\Tweet;

class Tweets extends Component
{
    protected $listeners = [
        'refreshTweets' => 'setTweets',
        'tweetLikeEvent' => 'like',
        'tweetUnlikeEvent' => 'unlike'];
    protected $tweets;
    protected $categories;
    protected $perPage = 5;
    protected $followed = [];
    public $categoryId = null;
    public $user;

    public function showTweet($tweetId)
    {
        $this->emit('showTweetModal', $tweetId);
        
        $this->setTweets();
    }
    public function createComment($tweetId)
    {
        $this->emit('showCommentModalEvent', $tweetId);
        $this->setTweets();
    }
    public function countLike($tweetId)
    {
        return Tweet::countLike($tweetId);
    }
    public function countUnlike($tweetId)
    {
        return Tweet::countUnlike($tweetId);
    }

    public function countComment($tweetId)
    {
        return Tweet::countComment($tweetId);
    }
    
    public function like($id)
    {
        Tweet::like(auth()->user()->id, $id);
        $this->emit('showTweetModal', $id);
        $this->setTweets();
    }
    
    
    public function unlike($id)
    {
        
        Tweet::unlike(auth()->user()->id, $id);
        $this->setTweets();
    }

    public function cancelLike()
    {

    }

    public function getTweets()
    {
        return $this->tweets;
    }

    public function authUserLikesTweet($tweetId)
    {
        if(auth()->check())
        {
            return Tweet::checkUserLikes(auth()->user()->id, $tweetId);
        }
        return null;
    }

    public function loadMore()
    {
        $this->perPage += 5;
        $this->setTweets();
    }

    public function setTweets()
    {
        if(auth()->check())
        {
            $followers = Profile::getWhoIFollow(auth()->user()->id);
            if(!is_null($followers))
            {
                $this->followed = $followers->pluck('followed_user_id')->toArray();
            }
            
        }
        $catId = $this->categoryId ? $this->categoryId : null;
        
        
        $this->tweets = Tweet::tweets($this?->user?->id, $catId, $this->followed, $this->perPage);
        $this->categories = Tweet::tweetCategories();
        
    }
    public function mount()
    {
        $this->setTweets();
    }
    public function updated()
    {
        $this->setTweets();
    }
    public function render()
    {
        return view('livewire.tweets')
            ->with('tweets', $this->tweets)
            ->with('categories', $this->categories);
    }
}
