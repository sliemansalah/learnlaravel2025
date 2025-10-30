<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Specific products
        $products = [
            [
                'name' => 'HP Laptop',
                'slug' => 'laptop-hp',
                'description' => 'High performance laptop for gaming and programming',
                'price' => 5000,
                'stock' => 10,
                'category' => 'Electronics',
                'views' => 150,
                'sales' => 25,
            ],
            [
                'name' => 'Samsung Phone',
                'slug' => 'samsung-phone',
                'description' => 'Smartphone with high specs',
                'price' => 3000,
                'stock' => 20,
                'category' => 'Electronics',
                'views' => 200,
                'sales' => 45,
            ],
            [
                'name' => 'Mens Shirt',
                'slug' => 'mens-shirt',
                'description' => 'High quality cotton shirt',
                'price' => 80,
                'stock' => 50,
                'category' => 'Clothing',
                'views' => 80,
                'sales' => 15,
            ],
            [
                'name' => 'Learn Laravel Book',
                'slug' => 'learn-laravel-book',
                'description' => 'Comprehensive book to learn Laravel',
                'price' => 50,
                'stock' => 100,
                'category' => 'Books',
                'views' => 120,
                'sales' => 60,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Random products
        Product::factory()->count(50)->create();
    }
}
