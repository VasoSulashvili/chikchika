<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Tweet\Service\Facade\Tweet as FacadeTweet;

class Tweet extends Component
{

    // protected $listeners = ['showTweetModal' => 'showTweetModal'];
    public $tweet;
    public $comments;
    public $commentBody;

    public $showTweetModal = false;
    public $countLike;
    public $countUnlike;
    public $countComments;

    public function createComment()
    {
        FacadeTweet::createComment($this->tweet->id, auth()->user()->id, $this->commentBody);
        $this->commentBody = null;
        $this->refreshComments();
        $this->countComments();
    }

    public function like()
    {
        FacadeTweet::like(auth()->user()->id, $this->tweet->id);
        $this->refreshComments();
    }
    
    public function unlike()
    {
        FacadeTweet::unlike(auth()->user()->id, $this->tweet->id);
        $this->refreshComments();
    }

    public function authUserLikesTweet()
    {
        return FacadeTweet::checkUserLikes(auth()->user()->id, $this->tweet->id);
    }
    public function countLike()
    {
        return FacadeTweet::countLike($this->tweet->id);
    }
    public function countUnlike()
    {
        return FacadeTweet::countUnlike($this->tweet->id);
    }

    public function countComments()
    {
        $this->countComments = $this->comments->count();
    }

    public function refreshComments()
    {
        $this->comments = FacadeTweet::tweetComments($this->tweet->id);
    }

    public function updated()
    {
        $this->refreshComments();
        $this->countComments();
    }

    function mount()
    {
        $this->refreshComments();
        $this->countComments();
    }
    public function render()
    {
        return view('livewire.tweet');
    }
}
