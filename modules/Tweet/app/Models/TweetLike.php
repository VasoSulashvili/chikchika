<?php

namespace Tweet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tweet_id', 'sign'];
}
