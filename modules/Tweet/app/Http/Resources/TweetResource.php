<?php

namespace Tweet\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use Tweet\Models\TweetCategory;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tweet_category_id' => new TweetCategoryResource(TweetCategory::find($this->tweet_category_id)),
            'tweet_user_id' => new UserResource(User::find($this->user_id)),
            'body' => $this->body,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}