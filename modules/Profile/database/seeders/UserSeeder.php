<?php

namespace Profile\Database\Seeders;

use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Profile\Service\Facade\Profile;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = Profile::register('user1@gmail.com', 123123123);
        event(new Registered($user1));
        $user2 = Profile::register('user2@gmail.com', 123123123);
        event(new Registered($user2));
        $user3 = Profile::register('user3@gmail.com', 123123123);
        event(new Registered($user3));
    }
}
