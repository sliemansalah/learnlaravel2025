<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
            ['name' => 'Business', 'slug' => 'business'],
            ['name' => 'Education', 'slug' => 'education'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create tags
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Programming', 'slug' => 'programming'],
            ['name' => 'Tutorial', 'slug' => 'tutorial'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // Create products
        $products = [
            [
                'name' => 'Laptop Pro',
                'description' => 'High-performance laptop for professionals',
                'price' => 1299.99,
                'stock' => 15
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with precision tracking',
                'price' => 29.99,
                'stock' => 50
            ],
            [
                'name' => 'Mechanical Keyboard',
                'description' => 'RGB mechanical keyboard with blue switches',
                'price' => 89.99,
                'stock' => 30
            ],
            [
                'name' => 'USB-C Hub',
                'description' => '7-in-1 USB-C hub with HDMI and card reader',
                'price' => 49.99,
                'stock' => 40
            ],
            [
                'name' => 'Laptop Stand',
                'description' => 'Adjustable aluminum laptop stand',
                'price' => 39.99,
                'stock' => 25
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Sample data created successfully!');
        $this->command->info('- 4 Categories created');
        $this->command->info('- 5 Tags created');
        $this->command->info('- 5 Products created');
    }
}
