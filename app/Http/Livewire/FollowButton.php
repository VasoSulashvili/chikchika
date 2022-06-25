<?php

namespace App\Http\Livewire;

use App\Exceptions\ErrorPageException;
use Livewire\Component;
use Profile\Service\Facade\Profile;

class FollowButton extends Component
{
    public $user;
    public $authUser;
    public $status = null;

    public function __construct($user)
    {
        $this->user = $user;
        auth()->check() ? $this->authUser = auth()->user() : $this->authUser = null;
    }

    public function follow()
    {
        if(!auth()->check()) { throw new ErrorPageException(403, "Please sign in"); }
        if(!is_null($this->authUser))
        {
            Profile::follow($this->authUser->id, $this->user->id);
            $this->setStatus();
        }
        
    }

    private function setStatus()
    {
        if(!is_null($this->authUser))
        {
            $this->status = is_null(Profile::following($this->authUser->id, $this->user->id)) ? null : true;
        }
    }

    public function mount()
    {
        $this->setStatus();
    }

    public function updated()
    {
        $this->setStatus();
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
