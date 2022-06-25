<?php

namespace Tweet\Models;

use Tweet\Database\Factories\TweetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Tweet\Service\Facade\Tweet as FacadeTweet;

class Tweet extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'tweet_category_id', 'body'];
    protected $append = ['like_status', 'likes_count', 'unlikes_count'];
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TweetFactory::new();
    }

    // Accessors
    public function likeStatus() : Attribute
    {
        return Attribute::make(
            get: function(){
                $result = null;
                if(Auth::check())
                {
                    $result = FacadeTweet::checkUserLikes(Auth::user()->id, $this->id);
                }
                return 'sssss';
            }
        );
    }
}
