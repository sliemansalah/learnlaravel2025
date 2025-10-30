<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 1000),
            'content' => fake()->paragraphs(5, true),
            'excerpt' => fake()->paragraph(),
            'user_id' => User::factory(),
            'published_at' => fake()->boolean(70) ? fake()->dateTimeBetween('-30 days', 'now') : null,
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
