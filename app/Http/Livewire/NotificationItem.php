<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Notification\Events\Seen;
use Notification\Events\Unseen;
use Notification\Service\Facade\Notification;
use Profile\Service\Facade\Profile;

class NotificationItem extends Component
{

    public $notification;
    public $fromUser;
    public $userName;
    public $action;
    public $date;
    public $status;
    public $icon;
    // public $fromUser;

    public function updateStatus()
    {
        $this->status ? Unseen::dispatch($this->notification) : Seen::dispatch($this->notification);
        // $this->setViewData();
        $this->status = !$this->status;
    }

    private function setViewData()
    {
        $this->fromUser = Profile::getUser($this->notification["from_user_id"]);
        if(isset($this->fromUser->first_name, $this->fromUser->last_name))
        {
            $this->userName = $this->fromUser->first_name . ' ' . $this->fromUser->last_name;
        }
        else
        {
            $this->userName = $this->fromUser->email;
        }
        $this->action = Notification::action($this->notification["action"])['action'];
        $this->icon = Notification::action($this->notification["action"])['icon'];
        $this->date = $this->notification["created_at"];
        $this->status = $this->notification["seen"];
    }

    public function mount()
    {
        $this->setViewData();
    }

    public function render()
    {
        return view('livewire.notification-item');
    }
}
