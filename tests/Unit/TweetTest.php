<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Models\User;
use Tests\TestCase;
use Tweet\Models\Tweet as ModelsTweet;
use Tweet\Service\Facade\Tweet;

class TweetTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * test tweet canbe liked; count likes; test user likes given tweet
     * 
     * @test
     */
    public function can_like_tweet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $tweet = ModelsTweet::factory()->create();
        Tweet::like($user->id, $tweet->id);
        $this->assertDatabaseHas('tweet_likes',[
            'user_id' => $user->id,
            'tweet_id' => $tweet->id,
            'sign' => TWEET_LIKE
        ]);
        $this->assertTrue(Tweet::checkUserLikes($user->id, $tweet->id) == TWEET_LIKE);
        $this->assertEquals(Tweet::countLike($tweet->id), 1);
    }

    /**
     * test tweet canbe unliked; count unlikes; test user unlikes given tweet
     * 
     * @test
     */
    public function can_unlike_tweet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $tweet = ModelsTweet::factory()->create();
        Tweet::unlike($user->id, $tweet->id);
        $this->assertDatabaseHas('tweet_likes',[
            'user_id' => $user->id,
            'tweet_id' => $tweet->id,
            'sign' => TWEET_UNLIKE
        ]);
        
        $this->assertTrue(Tweet::checkUserLikes($user->id, $tweet->id) == TWEET_UNLIKE);
        $this->assertEquals(Tweet::countUnlike($tweet->id), 1);
    }

    /**
     * test comment cannbe created
     * 
     * @test
     */
    public function can_make_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $tweet = ModelsTweet::factory()->create();
        $body = 'some comments';
        Tweet::createComment($tweet->id, $user->id, $body);
        $this->assertDatabaseHas('tweet_comments', [
            'user_id' => $user->id,
            'tweet_id' => $tweet->id,
            'body' => $body
        ]);

        $this->assertEquals(Tweet::countComment($tweet->id), 1);
    }
}
