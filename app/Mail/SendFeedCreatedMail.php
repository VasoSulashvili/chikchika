<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendFeedCreatedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $tweets;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.feed-created');
            // ->with('tweets', $this->tweets);
    }
}
