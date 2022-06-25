<?php

namespace Tweet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetComment extends Model
{
    use HasFactory;

    protected $fillable = ['tweet_id', 'user_id', 'body'];
}
