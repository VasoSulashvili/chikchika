<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Tweet\Service\Facade\Tweet;

class NewComment extends Component
{
    public $showCommentModal = false;
    public $comment;
    public $tweetId;
    protected $listeners = ['showCommentModalEvent' => 'setCommentModal'];
    protected $rules = [
        'comment' => 'required|min:6|max:140|string',
        'tweetId' => 'required|integer',
    ];

    public function livewireCancel()
    {
        $this->comment = null;
        $this->showCommentModal = false;
    }
    public function setCommentModal($tweetId)
    {
        if(Auth::check())
        {
            $this->showCommentModal = true;
            $this->tweetId = $tweetId;
        }
    }

    public function livewireSubmit()
    {
        $this->validate();
        Tweet::createComment($this->tweetId, Auth::user()->id, $this->comment);
        $this->tweetId = null;
        $this->comment = null;
        $this->showCommentModal = false;
        $this->emit('refreshTweets');
    }


    public function render()
    {
        return view('livewire.new-comment');
    }
}
