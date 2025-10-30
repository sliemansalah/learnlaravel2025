# Lesson 6 - Practical Application Guide

## 🚀 How to Run the Project

```bash
cd D:\learnlaravel2025\lessons\lesson-06\practice-app

# Setup database
copy .env.example .env
php artisan key:generate

# Configure database in .env
# DB_CONNECTION=sqlite

# Run Migrations
php artisan migrate

# Run Seeders
php artisan db:seed

# Start server
php artisan serve
```

---

## 📋 Implemented Models

### 1. Product Model

**Creating Model:**
```bash
php artisan make:model Product -mfs
```

**Model: app/Models/Product.php**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category',
        'is_active',
    ];

    protected $casts = [
        'price' => 'float',
        'is_active' => 'boolean',
    ];

    // Query Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCheap($query, $maxPrice = 100)
    {
        return $query->where('price', '<=', $maxPrice);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopePopular($query)
    {
        return $query->where('views', '>', 100)
                     ->orderBy('views', 'desc');
    }

    // Accessors
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->price, 2) . ' SAR',
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->name} ({$this->category})",
        );
    }

    // Mutators
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst(trim($value)),
        );
    }
}
```

**Migration:**
```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->integer('stock')->default(0);
    $table->string('category');
    $table->boolean('is_active')->default(true);
    $table->integer('views')->default(0);
    $table->integer('sales')->default(0);
    $table->timestamps();
    $table->softDeletes();
});
```

---

### 2. Post Model (for Blog)

**Model: app/Models/Post.php**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'user_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
                     ->whereNotNull('published_at');
    }

    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    // Accessors
    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                $words = str_word_count(strip_tags($this->content));
                $minutes = ceil($words / 200);
                return $minutes . ' min';
            },
        );
    }

    // Mutator
    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? substr(strip_tags($this->content), 0, 150) . '...',
        );
    }
}
```

**Migration:**
```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content');
    $table->text('excerpt')->nullable();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->integer('views')->default(0);
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

---

## 🌱 Implemented Seeders

### 1. ProductSeeder

```php
<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
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
```

---

### 2. PostSeeder

```php
<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
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
```

---

## 🏭 Implemented Factories

### ProductFactory

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);
        $categories = ['Electronics', 'Clothing', 'Books', 'Sports', 'Home'];

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 1000),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 5000),
            'stock' => fake()->numberBetween(0, 100),
            'category' => fake()->randomElement($categories),
            'is_active' => fake()->boolean(90),
            'views' => fake()->numberBetween(0, 500),
            'sales' => fake()->numberBetween(0, 100),
        ];
    }
}
```

---

### PostFactory

```php
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
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
```

---

## 🎯 Usage Examples

### Example 1: Product Operations

```php
use App\Models\Product;

// Create product
$product = Product::create([
    'name' => 'Gaming Mouse',
    'slug' => 'gaming-mouse',
    'description' => 'Professional gaming mouse',
    'price' => 150,
    'stock' => 30,
    'category' => 'Electronics',
]);

// Show active products
$products = Product::active()->get();

// Show cheap active products
$cheapProducts = Product::active()->cheap(100)->get();

// Show products in stock
$inStock = Product::inStock()->orderBy('name')->get();

// Show popular products
$popular = Product::popular()->take(10)->get();

// Update stock after purchase
$product = Product::find(1);
$product->decrement('stock');
$product->increment('sales');

// Use Accessor
echo $product->formatted_price; // 150.00 SAR
echo $product->full_name;       // Gaming Mouse (Electronics)

// Search and filter
$electronics = Product::where('category', 'Electronics')
                      ->where('price', '<', 1000)
                      ->active()
                      ->get();
```

---

### Example 2: Blog Operations

```php
use App\Models\Post;

// Show published posts
$posts = Post::published()->recent()->get();

// Show drafts
$drafts = Post::draft()->get();

// Increment views
$post = Post::find(1);
$post->increment('views');

// Publish draft
$draft = Post::find(3);
$draft->published_at = now();
$draft->save();

// Use Accessor
echo $post->reading_time; // 5 min

// Soft delete
$post->delete();

// Show with trashed
$allPosts = Post::withTrashed()->get();

// Restore deleted post
$deletedPost = Post::onlyTrashed()->find(1);
$deletedPost->restore();
```

---

### Example 3: Statistics

```php
use App\Models\Product;
use App\Models\Post;

// Product statistics
$totalProducts = Product::count();
$activeProducts = Product::active()->count();
$totalValue = Product::sum('price');
$avgPrice = Product::avg('price');
$maxPrice = Product::max('price');

// Best sellers
$bestSellers = Product::orderBy('sales', 'desc')->take(5)->get();

// Out of stock
$outOfStock = Product::where('stock', 0)->get();

// Blog statistics
$totalPosts = Post::count();
$publishedPosts = Post::published()->count();
$draftPosts = Post::draft()->count();
$totalViews = Post::sum('views');

// Most viewed posts
$mostViewed = Post::published()
                  ->orderBy('views', 'desc')
                  ->take(5)
                  ->get();
```

---

## 🔍 Testing with Tinker

```bash
php artisan tinker
```

```php
// Create product
$product = Product::create([
    'name' => 'Test Product',
    'slug' => 'test-product',
    'price' => 99.99,
    'stock' => 10,
    'category' => 'Test',
]);

// Retrieve data
Product::all();
Product::find(1);
Product::where('price', '>', 100)->get();

// Use Scopes
Product::active()->get();
Product::cheap(50)->get();

// Statistics
Product::count();
Product::sum('price');
Product::avg('price');

// Accessors
$product->formatted_price;
$product->full_name;

// Update
$product->update(['price' => 149.99]);
$product->increment('views');

// Delete
$product->delete();
Product::withTrashed()->get();
$product->restore();
```

---

## 💡 Practical Challenges

### Challenge 1: Product System
Implement the following features:
1. Scope for best-selling products (sales > 50)
2. Accessor to calculate profit (price * sales)
3. Mutator to convert name to uppercase
4. Function to reduce stock on purchase

### Challenge 2: Blog System
Create:
1. Scope for popular posts (views > 500)
2. Accessor to calculate comment count (default)
3. Function to schedule publishing
4. Scope for posts published this week

### Challenge 3: Reports
Create:
1. Daily sales report
2. Most viewed products report
3. Products needing restocking report
4. Most popular posts report

---

## 📝 Useful Commands

```bash
# Create Model with everything
php artisan make:model Product -mfsc

# Run Migrations
php artisan migrate
php artisan migrate:fresh --seed

# Create Factory
php artisan make:factory ProductFactory

# Create Seeder
php artisan make:seeder ProductSeeder

# Run specific Seeder
php artisan db:seed --class=ProductSeeder

# Tinker
php artisan tinker
```

---

## 📚 Next Step

After completing this lesson, you're ready for:

**Lesson 7**: Eloquent Relationships
- One to One
- One to Many
- Many to Many
- Has Many Through
- Polymorphic Relations

---

**Happy Learning! 🚀**
