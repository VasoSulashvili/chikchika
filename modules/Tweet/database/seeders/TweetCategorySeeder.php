<?php

namespace Tweet\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tweet\Models\TweetCategory;

class TweetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TweetCategory::factory(10)->create();
    }
}
