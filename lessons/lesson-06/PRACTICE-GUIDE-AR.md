# دليل التطبيق العملي للدرس السادس

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-06\practice-app

# إعداد قاعدة البيانات
copy .env.example .env
php artisan key:generate

# ضبط إعدادات قاعدة البيانات في .env
# DB_CONNECTION=sqlite

# تشغيل Migrations
php artisan migrate

# تشغيل Seeders
php artisan db:seed

# تشغيل الخادم
php artisan serve
```

---

## 📋 Models المنفذة

### 1. Product Model

**إنشاء Model:**
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
            get: fn () => number_format($this->price, 2) . ' ريال',
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

### 2. Post Model (للمدونة)

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
                return $minutes . ' دقيقة';
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

## 🌱 Seeders المنفذة

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
        // منتجات محددة
        $products = [
            [
                'name' => 'لابتوب HP',
                'slug' => 'laptop-hp',
                'description' => 'لابتوب عالي الأداء للألعاب والبرمجة',
                'price' => 5000,
                'stock' => 10,
                'category' => 'إلكترونيات',
                'views' => 150,
                'sales' => 25,
            ],
            [
                'name' => 'هاتف سامسونج',
                'slug' => 'samsung-phone',
                'description' => 'هاتف ذكي بمواصفات عالية',
                'price' => 3000,
                'stock' => 20,
                'category' => 'إلكترونيات',
                'views' => 200,
                'sales' => 45,
            ],
            [
                'name' => 'قميص رجالي',
                'slug' => 'mens-shirt',
                'description' => 'قميص قطني عالي الجودة',
                'price' => 80,
                'stock' => 50,
                'category' => 'ملابس',
                'views' => 80,
                'sales' => 15,
            ],
            [
                'name' => 'كتاب تعلم Laravel',
                'slug' => 'learn-laravel-book',
                'description' => 'كتاب شامل لتعلم Laravel',
                'price' => 50,
                'stock' => 100,
                'category' => 'كتب',
                'views' => 120,
                'sales' => 60,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // منتجات عشوائية
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

        // مقالات منشورة
        Post::create([
            'title' => 'مقدمة إلى Laravel',
            'slug' => 'intro-to-laravel',
            'content' => 'Laravel هو إطار عمل PHP قوي وسهل الاستخدام...',
            'user_id' => $user->id,
            'published_at' => now()->subDays(5),
            'views' => 250,
        ]);

        Post::create([
            'title' => 'Eloquent ORM الأساسيات',
            'slug' => 'eloquent-basics',
            'content' => 'Eloquent هو ORM الخاص بـ Laravel...',
            'user_id' => $user->id,
            'published_at' => now()->subDays(3),
            'views' => 180,
        ]);

        // مقال مسودة
        Post::create([
            'title' => 'Laravel Advanced',
            'slug' => 'laravel-advanced',
            'content' => 'في هذا المقال سنتعلم ميزات Laravel المتقدمة...',
            'user_id' => $user->id,
            'published_at' => null,
            'views' => 0,
        ]);

        // مقالات عشوائية
        Post::factory()->count(20)->create();
    }
}
```

---

## 🏭 Factories المنفذة

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
        $categories = ['إلكترونيات', 'ملابس', 'كتب', 'رياضة', 'منزل'];

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

## 🎯 أمثلة الاستخدام

### مثال 1: عمليات المنتجات

```php
use App\Models\Product;

// إنشاء منتج
$product = Product::create([
    'name' => 'Gaming Mouse',
    'slug' => 'gaming-mouse',
    'description' => 'فأرة ألعاب احترافية',
    'price' => 150,
    'stock' => 30,
    'category' => 'إلكترونيات',
]);

// عرض منتجات نشطة
$products = Product::active()->get();

// عرض منتجات رخيصة ونشطة
$cheapProducts = Product::active()->cheap(100)->get();

// عرض منتجات متوفرة في المخزون
$inStock = Product::inStock()->orderBy('name')->get();

// عرض منتجات شائعة
$popular = Product::popular()->take(10)->get();

// تحديث المخزون بعد عملية شراء
$product = Product::find(1);
$product->decrement('stock');
$product->increment('sales');

// استخدام Accessor
echo $product->formatted_price; // 150.00 ريال
echo $product->full_name;       // Gaming Mouse (إلكترونيات)

// البحث والفلترة
$electronics = Product::where('category', 'إلكترونيات')
                      ->where('price', '<', 1000)
                      ->active()
                      ->get();
```

---

### مثال 2: عمليات المدونة

```php
use App\Models\Post;

// عرض المقالات المنشورة
$posts = Post::published()->recent()->get();

// عرض المسودات
$drafts = Post::draft()->get();

// زيادة المشاهدات
$post = Post::find(1);
$post->increment('views');

// نشر مسودة
$draft = Post::find(3);
$draft->published_at = now();
$draft->save();

// استخدام Accessor
echo $post->reading_time; // 5 دقيقة

// حذف ناعم
$post->delete();

// عرض مع المحذوفة
$allPosts = Post::withTrashed()->get();

// استعادة مقال محذوف
$deletedPost = Post::onlyTrashed()->find(1);
$deletedPost->restore();
```

---

### مثال 3: إحصائيات

```php
use App\Models\Product;
use App\Models\Post;

// إحصائيات المنتجات
$totalProducts = Product::count();
$activeProducts = Product::active()->count();
$totalValue = Product::sum('price');
$avgPrice = Product::avg('price');
$maxPrice = Product::max('price');

// المنتجات الأكثر مبيعاً
$bestSellers = Product::orderBy('sales', 'desc')->take(5)->get();

// منتجات نفدت من المخزون
$outOfStock = Product::where('stock', 0)->get();

// إحصائيات المدونة
$totalPosts = Post::count();
$publishedPosts = Post::published()->count();
$draftPosts = Post::draft()->count();
$totalViews = Post::sum('views');

// المقالات الأكثر مشاهدة
$mostViewed = Post::published()
                  ->orderBy('views', 'desc')
                  ->take(5)
                  ->get();
```

---

## 🔍 اختبار باستخدام Tinker

```bash
php artisan tinker
```

```php
// إنشاء منتج
$product = Product::create([
    'name' => 'Test Product',
    'slug' => 'test-product',
    'price' => 99.99,
    'stock' => 10,
    'category' => 'Test',
]);

// استرجاع البيانات
Product::all();
Product::find(1);
Product::where('price', '>', 100)->get();

// استخدام Scopes
Product::active()->get();
Product::cheap(50)->get();

// الإحصائيات
Product::count();
Product::sum('price');
Product::avg('price');

// Accessors
$product->formatted_price;
$product->full_name;

// التحديث
$product->update(['price' => 149.99]);
$product->increment('views');

// الحذف
$product->delete();
Product::withTrashed()->get();
$product->restore();
```

---

## 💡 تحديات عملية

### تحدي 1: نظام المنتجات
قم بإنشاء الميزات التالية:
1. Scope للمنتجات الأكثر مبيعاً (sales > 50)
2. Accessor لحساب الربح (price * sales)
3. Mutator لتحويل الاسم إلى أحرف كبيرة
4. دالة لتقليل المخزون عند الشراء

### تحدي 2: نظام المدونة
قم بإنشاء:
1. Scope للمقالات الشائعة (views > 500)
2. Accessor لحساب عدد التعليقات (افتراضي)
3. دالة لجدولة النشر
4. Scope للمقالات المنشورة هذا الأسبوع

### تحدي 3: التقارير
قم بإنشاء:
1. تقرير المبيعات اليومية
2. تقرير المنتجات الأكثر مشاهدة
3. تقرير المنتجات التي تحتاج إعادة تعبئة
4. تقرير المقالات الأكثر شعبية

---

## 📝 أوامر مفيدة

```bash
# إنشاء Model مع كل شيء
php artisan make:model Product -mfsc

# تشغيل Migrations
php artisan migrate
php artisan migrate:fresh --seed

# إنشاء Factory
php artisan make:factory ProductFactory

# إنشاء Seeder
php artisan make:seeder ProductSeeder

# تشغيل Seeder معين
php artisan db:seed --class=ProductSeeder

# Tinker
php artisan tinker
```

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 7**: Eloquent Relationships - العلاقات
- One to One
- One to Many
- Many to Many
- Has Many Through
- Polymorphic Relations

---

**تعلم سعيد! 🚀**
