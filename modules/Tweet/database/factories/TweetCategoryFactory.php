<?php

namespace Tweet\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tweet\Models\TweetCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Tweet\Models\TweetCategory>
 */
class TweetCategoryFactory extends Factory
{
    protected $model = TweetCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word()
        ];
    }
}
