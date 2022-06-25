<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\FollowButton;
use App\Http\Livewire\NewTweet;
use App\Http\Livewire\Tweet as LivewireTweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tweet\Models\Tweet;
use Tweet\Models\TweetCategory;

class TweetTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(NewTweet::class);

        $component->assertStatus(200);
    }
    
    /**
     * create new tweet
     * 
     * @test
     */
    public function can_create_new_tweet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $tweet = Tweet::factory()->make();
        Livewire::test(NewTweet::class)
            ->set('tweetCategoryId', $tweet->tweet_category_id)
            ->set('tweetBody', $tweet->body)
            ->call('livewireSubmit');
 
        $this->assertTrue(Tweet::whereTweetCategoryId($tweet->tweet_category_id)->exists());
    }

    
}
