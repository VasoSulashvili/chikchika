<?php

namespace Tests\Unit;

use App\Models\User;
use Profile\Models\Profile as ModelsProfile;
use Tests\TestCase;
use Profile\Service\Facade\Profile;

class ProfileTest extends TestCase
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
     * user can follow user and unfollow
     * 
     * @test
     */
    public function user_follow_and_unfollow()
    {
        $userA = User::factory()->create();
        $this->actingAs($userA);
        $userB = User::factory()->create();
        Profile::follow($userA->id, $userB->id);
        $this->assertDatabaseHas('followings', [
            'follower_user_id' => $userA->id,
            'followed_user_id' => $userB->id
        ]);
        Profile::follow($userA->id, $userB->id);
        $this->assertDatabaseMissing('followings', [
            'follower_user_id' => $userA->id,
            'followed_user_id' => $userB->id
        ]);
    }

    /**
     * test profile crud
     * 
     * @test
     */
    public function test_create_and_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = ModelsProfile::factory()->make();
        $profile = Profile::create($user->id, null, $data->first_name, $data->last_name);
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name
        ]);
        $dataB = ModelsProfile::factory()->make();
        $profileB = Profile::update($profile, $dataB->first_name, $dataB->last_name);
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'first_name' => $dataB->first_name,
            'last_name' => $dataB->last_name
        ]);
        $this->assertDatabaseMissing('profiles', [
            'user_id' => $user->id,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name
        ]);
    }
}
