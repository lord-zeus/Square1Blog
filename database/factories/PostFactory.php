<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(11),
            'description' => fake()->sentence(50),
            'published_at' => now(),
            'user_id' => 1
        ];
    }

    /**
     * Post Should not have a title.
     *
     * @return static
     */
    public function nullTitle()
    {
        return $this->state([
            'title' => null,
        ]);
    }
}
