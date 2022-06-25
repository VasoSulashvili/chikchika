<?php

namespace Tweet\Service\Traits;

use Tweet\Models\TweetCategory;

trait Categoriable
{
    /**
     * get categories
     * 
     */
    public function tweetCategories()
    {
        return TweetCategory::all();
    }
    
}