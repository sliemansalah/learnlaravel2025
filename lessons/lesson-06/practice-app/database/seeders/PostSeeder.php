<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        // Published posts
        Post::create([
            'title' => 'Introduction to Laravel',
            'slug' => 'intro-to-laravel',
            'content' => 'Laravel is a powerful and easy-to-use PHP framework...',
            'user_id' => $user->id,
            'published_at' => now()->subDays(5),
            'views' => 250,
        ]);

        Post::create([
            'title' => 'Eloquent ORM Basics',
            'slug' => 'eloquent-basics',
            'content' => 'Eloquent is Laravel\'s ORM...',
            'user_id' => $user->id,
            'published_at' => now()->subDays(3),
            'views' => 180,
        ]);

        // Draft post
        Post::create([
            'title' => 'Laravel Advanced',
            'slug' => 'laravel-advanced',
            'content' => 'In this article we will learn advanced Laravel features...',
            'user_id' => $user->id,
            'published_at' => null,
            'views' => 0,
        ]);

        // Random posts
        Post::factory()->count(20)->create();
    }
}
