<?php

namespace Tweet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tweet\Database\Factories\TweetCategoryFactory;

class TweetCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TweetCategoryFactory::new();
    }
}
