# التطبيق العملي: نظام مدونة متكامل باستخدام Views و Blade

## 🎯 هدف المشروع

بناء نظام مدونة متكامل يطبق جميع مفاهيم Views و Blade Templates

## 📋 المتطلبات

- Laravel مثبت
- معرفة بـ Routes و Controllers
- فهم الدرس النظري

---

## المشروع: نظام مدونة Blog System

### ميزات المشروع:

```
✅ صفحة رئيسية مع آخر المقالات
✅ عرض قائمة جميع المقالات
✅ عرض تفاصيل مقال واحد
✅ صفحة عن الموقع
✅ صفحة اتصل بنا
✅ Layout رئيسي مع Header و Footer
✅ Components قابلة لإعادة الاستخدام
✅ Sidebar مع آخر المقالات
✅ System التصنيفات
✅ Responsive Design
```

---

## الخطوة 1: إعداد المشروع

### 1.1 إنشاء مشروع Laravel جديد

```bash
composer create-project laravel/laravel blog-views
cd blog-views
```

### 1.2 إنشاء Model و Migration للمقالات

```bash
php artisan make:model Post -m
php artisan make:model Category -m
```

### 1.3 تعديل Migrations

**database/migrations/xxxx_create_categories_table.php:**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
```

**database/migrations/xxxx_create_posts_table.php:**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
```

### 1.4 تشغيل Migration

```bash
php artisan migrate
```

---

## الخطوة 2: إعداد Models

### 2.1 Category Model

**app/Models/Category.php:**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

### 2.2 Post Model

**app/Models/Post.php:**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'published',
        'published_at',
        'views'
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}
```

---

## الخطوة 3: إنشاء Seeder للبيانات التجريبية

### 3.1 إنشاء Seeders

```bash
php artisan make:seeder CategorySeeder
php artisan make:seeder PostSeeder
```

### 3.2 CategorySeeder

**database/seeders/CategorySeeder.php:**

```php
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'التقنية', 'description' => 'مقالات عن التقنية والبرمجة'],
            ['name' => 'التصميم', 'description' => 'مقالات عن التصميم والإبداع'],
            ['name' => 'التسويق', 'description' => 'مقالات عن التسويق الرقمي'],
            ['name' => 'الأعمال', 'description' => 'مقالات عن ريادة الأعمال'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
```

### 3.3 PostSeeder

**database/seeders/PostSeeder.php:**

```php
<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'title' => 'مقدمة إلى Laravel',
                'excerpt' => 'تعلم أساسيات Laravel Framework',
                'content' => 'Laravel هو إطار عمل PHP حديث...',
                'category' => 'التقنية',
            ],
            [
                'title' => 'أساسيات Blade Templates',
                'excerpt' => 'كيفية استخدام Blade في Laravel',
                'content' => 'Blade هو محرك القوالب القوي...',
                'category' => 'التقنية',
            ],
            [
                'title' => 'تصميم واجهات المستخدم',
                'excerpt' => 'مبادئ تصميم UI/UX',
                'content' => 'تصميم واجهة المستخدم مهم جداً...',
                'category' => 'التصميم',
            ],
            [
                'title' => 'استراتيجيات التسويق الرقمي',
                'excerpt' => 'كيف تسوق منتجك بفعالية',
                'content' => 'التسويق الرقمي أصبح ضرورة...',
                'category' => 'التسويق',
            ],
            [
                'title' => 'بناء Startup ناجح',
                'excerpt' => 'خطوات بناء شركة ناشئة',
                'content' => 'الشركات الناشئة تحتاج إلى...',
                'category' => 'الأعمال',
            ],
        ];

        foreach ($posts as $post) {
            $category = Category::where('name', $post['category'])->first();

            Post::create([
                'category_id' => $category->id,
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'excerpt' => $post['excerpt'],
                'content' => $post['content'],
                'published' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000),
            ]);
        }
    }
}
```

### 3.4 تحديث DatabaseSeeder

**database/seeders/DatabaseSeeder.php:**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
```

### 3.5 تشغيل Seeders

```bash
php artisan db:seed
```

---

## الخطوة 4: إنشاء Controllers

### 4.1 إنشاء Controllers

```bash
php artisan make:controller HomeController
php artisan make:controller PostController
php artisan make:controller PageController
```

### 4.2 HomeController

**app/Http/Controllers/HomeController.php:**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::published()
            ->latest()
            ->with('category')
            ->take(6)
            ->get();

        $popularPosts = Post::published()
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        $categories = Category::withCount('posts')->get();

        return view('home', compact('latestPosts', 'popularPosts', 'categories'));
    }
}
```

### 4.3 PostController

**app/Http/Controllers/PostController.php:**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->latest()
            ->with('category')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->with('category')
            ->firstOrFail();

        // زيادة عدد المشاهدات
        $post->increment('views');

        // المقالات المقترحة من نفس التصنيف
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(9);

        return view('posts.category', compact('category', 'posts'));
    }
}
```

### 4.4 PageController

**app/Http/Controllers/PageController.php:**

```php
<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
```

---

## الخطوة 5: تعريف Routes

**routes/web.php:**

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [PostController::class, 'category'])->name('posts.category');

// Pages
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
```

---

## الخطوة 6: إنشاء Layout الرئيسي

### 6.1 إنشاء مجلدات Views

```bash
mkdir resources/views/layouts
mkdir resources/views/partials
mkdir resources/views/components
mkdir resources/views/posts
mkdir resources/views/pages
```

### 6.2 Layout الرئيسي

**resources/views/layouts/app.blade.php:**

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'مدونة تقنية شاملة')">
    <title>@yield('title', 'الصفحة الرئيسية') - مدونتي</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
```

---

## الخطوة 7: إنشاء Partials

### 7.1 Header

**resources/views/partials/header.blade.php:**

```blade
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <!-- Top Bar -->
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-4 space-x-reverse">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                    مدونتي
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 space-x-reverse">
                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('posts.index') }}"
                   class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('posts.*') ? 'text-blue-600 font-semibold' : '' }}">
                    المقالات
                </a>
                <a href="{{ route('pages.about') }}"
                   class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('pages.about') ? 'text-blue-600 font-semibold' : '' }}">
                    عن الموقع
                </a>
                <a href="{{ route('pages.contact') }}"
                   class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('pages.contact') ? 'text-blue-600 font-semibold' : '' }}">
                    اتصل بنا
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden pb-4" id="mobile-menu">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600">الرئيسية</a>
            <a href="{{ route('posts.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">المقالات</a>
            <a href="{{ route('pages.about') }}" class="block py-2 text-gray-700 hover:text-blue-600">عن الموقع</a>
            <a href="{{ route('pages.contact') }}" class="block py-2 text-gray-700 hover:text-blue-600">اتصل بنا</a>
        </div>
    </div>
</header>

@once
@push('scripts')
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
@endpush
@endonce
```

### 7.2 Footer

**resources/views/partials/footer.blade.php:**

```blade
<footer class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-xl font-bold mb-4">عن المدونة</h3>
                <p class="text-gray-300">
                    مدونة تقنية شاملة تهتم بكل ما هو جديد في عالم البرمجة والتصميم والتقنية.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">روابط سريعة</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">الرئيسية</a></li>
                    <li><a href="{{ route('posts.index') }}" class="text-gray-300 hover:text-white">المقالات</a></li>
                    <li><a href="{{ route('pages.about') }}" class="text-gray-300 hover:text-white">عن الموقع</a></li>
                    <li><a href="{{ route('pages.contact') }}" class="text-gray-300 hover:text-white">اتصل بنا</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">تواصل معنا</h3>
                <ul class="space-y-2 text-gray-300">
                    <li>البريد: info@myblog.com</li>
                    <li>الهاتف: 123-456-7890</li>
                    <li>العنوان: الرياض، المملكة العربية السعودية</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - مدونتي</p>
        </div>
    </div>
</footer>
```

### 7.3 Sidebar

**resources/views/partials/sidebar.blade.php:**

```blade
<aside class="space-y-6">
    <!-- Latest Posts Widget -->
    <x-widget title="أحدث المقالات">
        @foreach($latestPosts ?? [] as $post)
            <div class="flex space-x-3 space-x-reverse mb-4">
                @if($post->image)
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-16 h-16 object-cover rounded">
                @else
                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif
                <div class="flex-1">
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-semibold hover:text-blue-600">
                        {{ Str::limit($post->title, 40) }}
                    </a>
                    <p class="text-xs text-gray-500 mt-1">{{ $post->published_at->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach
    </x-widget>

    <!-- Categories Widget -->
    <x-widget title="التصنيفات">
        @foreach($categories ?? [] as $category)
            <a href="{{ route('posts.category', $category->slug) }}"
               class="flex items-center justify-between py-2 px-3 rounded hover:bg-gray-50 group">
                <span class="text-gray-700 group-hover:text-blue-600">{{ $category->name }}</span>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $category->posts_count ?? 0 }}</span>
            </a>
        @endforeach
    </x-widget>
</aside>
```

---

## الخطوة 8: إنشاء Components

### 8.1 إنشاء Widget Component

```bash
php artisan make:component Widget
```

**app/View/Components/Widget.php:**

```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Widget extends Component
{
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.widget');
    }
}
```

**resources/views/components/widget.blade.php:**

```blade
<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-bold mb-4 pb-2 border-b">{{ $title }}</h3>
    <div>
        {{ $slot }}
    </div>
</div>
```

### 8.2 إنشاء PostCard Component

```bash
php artisan make:component PostCard
```

**app/View/Components/PostCard.php:**

```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostCard extends Component
{
    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('components.post-card');
    }
}
```

**resources/views/components/post-card.blade.php:**

```blade
<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
    <!-- Image -->
    @if($post->image)
        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
            <span class="text-white text-xl font-bold">{{ Str::substr($post->title, 0, 1) }}</span>
        </div>
    @endif

    <!-- Content -->
    <div class="p-6">
        <!-- Category -->
        <a href="{{ route('posts.category', $post->category->slug) }}"
           class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-3">
            {{ $post->category->name }}
        </a>

        <!-- Title -->
        <h2 class="text-xl font-bold mb-3 hover:text-blue-600">
            <a href="{{ route('posts.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h2>

        <!-- Excerpt -->
        <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>

        <!-- Meta -->
        <div class="flex items-center justify-between text-sm text-gray-500">
            <span>{{ $post->published_at->format('Y-m-d') }}</span>
            <span>{{ $post->views }} مشاهدة</span>
        </div>
    </div>
</article>
```

### 8.3 إنشاء Alert Component

```bash
php artisan make:component Alert
```

**app/View/Components/Alert.php:**

```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;

    public function __construct($type = 'info', $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.alert');
    }

    public function alertClasses()
    {
        return [
            'success' => 'bg-green-100 border-green-400 text-green-700',
            'error' => 'bg-red-100 border-red-400 text-red-700',
            'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
            'info' => 'bg-blue-100 border-blue-400 text-blue-700',
        ][$this->type] ?? 'bg-blue-100 border-blue-400 text-blue-700';
    }
}
```

**resources/views/components/alert.blade.php:**

```blade
<div class="border-l-4 p-4 mb-4 {{ $alertClasses() }}" role="alert">
    @if($message)
        <p>{{ $message }}</p>
    @else
        {{ $slot }}
    @endif
</div>
```

---

## الخطوة 9: إنشاء Views

### 9.1 الصفحة الرئيسية

**resources/views/home.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">مرحباً بك في مدونتي</h1>
            <p class="text-xl mb-8">اكتشف أحدث المقالات في التقنية والبرمجة</p>
            <a href="{{ route('posts.index') }}"
               class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 inline-block">
                تصفح المقالات
            </a>
        </div>
    </section>

    <!-- Latest Posts Section -->
    <section class="container mx-auto px-4 py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">أحدث المقالات</h2>
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">عرض الكل</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestPosts as $post)
                <x-post-card :post="$post" />
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">لا توجد مقالات بعد</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Categories Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">التصنيفات</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('posts.category', $category->slug) }}"
                       class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition">
                        <h3 class="font-bold text-lg mb-2">{{ $category->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $category->posts_count }} مقال</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Posts Section -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">الأكثر قراءة</h2>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @foreach($popularPosts as $index => $post)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex items-start space-x-3 space-x-reverse">
                        <span class="text-3xl font-bold text-gray-300">{{ $index + 1 }}</span>
                        <div>
                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="font-semibold hover:text-blue-600 block mb-2">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                            <p class="text-xs text-gray-500">{{ $post->views }} مشاهدة</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
```

### 9.2 قائمة المقالات

**resources/views/posts/index.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'جميع المقالات')

@section('content')
    <!-- Page Header -->
    <div class="bg-blue-600 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold">جميع المقالات</h1>
            <p class="mt-2">تصفح جميع مقالاتنا</p>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($posts as $post)
                            <x-post-card :post="$post" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @else
                    <x-alert type="info" message="لا توجد مقالات لعرضها" />
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection
```

### 9.3 عرض مقال واحد

**resources/views/posts/show.blade.php:**

```blade
@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt)

@section('content')
    <article class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Image -->
                    @if($post->image)
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
                    @endif

                    <!-- Content -->
                    <div class="p-8">
                        <!-- Category -->
                        <a href="{{ route('posts.category', $post->category->slug) }}"
                           class="inline-block text-sm font-semibold text-blue-600 bg-blue-50 px-4 py-2 rounded-full mb-4">
                            {{ $post->category->name }}
                        </a>

                        <!-- Title -->
                        <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

                        <!-- Meta -->
                        <div class="flex items-center space-x-4 space-x-reverse text-gray-600 mb-6 pb-6 border-b">
                            <span>📅 {{ $post->published_at->format('Y-m-d') }}</span>
                            <span>👁 {{ $post->views }} مشاهدة</span>
                        </div>

                        <!-- Excerpt -->
                        <div class="bg-gray-50 p-6 rounded-lg mb-6">
                            <p class="text-lg text-gray-700 leading-relaxed">{{ $post->excerpt }}</p>
                        </div>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold mb-6">مقالات ذات صلة</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedPosts as $relatedPost)
                                <x-post-card :post="$relatedPost" />
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('partials.sidebar')
            </div>
        </div>
    </article>
@endsection
```

### 9.4 مقالات حسب التصنيف

**resources/views/posts/category.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'مقالات ' . $category->name)

@section('content')
    <!-- Page Header -->
    <div class="bg-blue-600 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold">{{ $category->name }}</h1>
            <p class="mt-2">{{ $category->description }}</p>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                @forelse($posts as $post)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <x-post-card :post="$post" />
                    </div>
                @empty
                    <x-alert type="info">
                        لا توجد مقالات في تصنيف {{ $category->name }} حالياً
                    </x-alert>
                @endforelse

                <!-- Pagination -->
                @if($posts->count() > 0)
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection
```

### 9.5 صفحة عن الموقع

**resources/views/pages/about.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'عن الموقع')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-6">عن الموقع</h1>

            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-4">من نحن</h2>
                <p class="text-gray-700 mb-6 leading-relaxed">
                    مدونة تقنية متخصصة في نشر المحتوى التعليمي عن البرمجة والتصميم والتسويق الرقمي.
                    نهدف إلى توفير محتوى عربي عالي الجودة للمبرمجين والمطورين.
                </p>

                <h2 class="text-2xl font-bold mb-4">رؤيتنا</h2>
                <p class="text-gray-700 mb-6 leading-relaxed">
                    أن نكون المرجع الأول للمحتوى التقني العربي، ونساهم في تطوير مهارات المبرمجين العرب.
                </p>

                <h2 class="text-2xl font-bold mb-4">قيمنا</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>الجودة في المحتوى</li>
                    <li>الاحترافية في التقديم</li>
                    <li>التطوير المستمر</li>
                    <li>المساهمة في المجتمع التقني</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
```

### 9.6 صفحة اتصل بنا

**resources/views/pages/contact.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'اتصل بنا')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold mb-6 text-center">اتصل بنا</h1>

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="#" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">الاسم</label>
                        <input type="text" id="name" name="name"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Subject -->
                    <div class="mb-6">
                        <label for="subject" class="block text-gray-700 font-semibold mb-2">الموضوع</label>
                        <input type="text" id="subject" name="subject"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-semibold mb-2">الرسالة</label>
                        <textarea id="message" name="message" rows="5"
                                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                                  required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        إرسال الرسالة
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl mb-2">📧</div>
                    <h3 class="font-semibold mb-2">البريد الإلكتروني</h3>
                    <p class="text-gray-600">info@myblog.com</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl mb-2">📞</div>
                    <h3 class="font-semibold mb-2">الهاتف</h3>
                    <p class="text-gray-600">123-456-7890</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-3xl mb-2">📍</div>
                    <h3 class="font-semibold mb-2">العنوان</h3>
                    <p class="text-gray-600">الرياض، السعودية</p>
                </div>
            </div>
        </div>
    </div>
@endsection
```

---

## الخطوة 10: إعداد View Composer

### 10.1 إنشاء ViewServiceProvider

```bash
php artisan make:provider ViewServiceProvider
```

**app/Providers/ViewServiceProvider.php:**

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // مشاركة البيانات مع Sidebar
        View::composer('partials.sidebar', function ($view) {
            $view->with([
                'latestPosts' => Post::published()->latest()->take(5)->get(),
                'categories' => Category::withCount('posts')->get(),
            ]);
        });

        // مشاركة site name مع جميع Views
        View::share('siteName', 'مدونتي');
    }
}
```

### 10.2 تسجيل Service Provider

**config/app.php:**

```php
'providers' => [
    // ...
    App\Providers\ViewServiceProvider::class,
],
```

---

## الخطوة 11: تشغيل المشروع

### 11.1 تشغيل Server

```bash
php artisan serve
```

### 11.2 زيارة الصفحات

```
http://localhost:8000/              # الصفحة الرئيسية
http://localhost:8000/posts         # جميع المقالات
http://localhost:8000/posts/مقالة   # مقال محدد
http://localhost:8000/category/التقنية  # مقالات حسب التصنيف
http://localhost:8000/about         # عن الموقع
http://localhost:8000/contact       # اتصل بنا
```

---

## ملخص ما تعلمناه

✅ **Layouts**: إنشاء layout رئيسي باستخدام @extends و @yield
✅ **Partials**: فصل الأجزاء المتكررة (Header, Footer, Sidebar)
✅ **Components**: إنشاء components قابلة لإعادة الاستخدام
✅ **Data Passing**: تمرير البيانات من Controller إلى View
✅ **Blade Directives**: استخدام @if, @foreach, @forelse, etc.
✅ **View Composers**: مشاركة البيانات مع views معينة
✅ **Slots**: استخدام Named Slots في Components
✅ **Conditional Classes**: استخدام @class
✅ **Best Practices**: تطبيق أفضل الممارسات

---

## تحديات إضافية 🚀

1. إضافة نظام التعليقات على المقالات
2. إضافة نظام البحث
3. إضافة نظام Tags
4. إضافة صفحة Authors
5. إضافة نظام Pagination مخصص
6. إضافة Dark Mode
7. إضافة Social Sharing Buttons

---

**تهانينا! 🎉 لقد أكملت المشروع العملي!**
