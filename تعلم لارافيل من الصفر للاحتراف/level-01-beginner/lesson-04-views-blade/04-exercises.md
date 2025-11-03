# تمارين عملية: Views و Blade Templates

## 📚 نظرة عامة

هذا الملف يحتوي على 6 تمارين عملية متدرجة من السهل إلى المتقدم لتطبيق مفاهيم Views و Blade

---

## التمرين 1: صفحات بسيطة (سهل) ⭐

### المطلوب:

أنشئ تطبيق Laravel بسيط يحتوي على:

1. صفحة رئيسية
2. صفحة "من نحن"
3. صفحة "خدماتنا" تعرض قائمة بـ 5 خدمات
4. صفحة "اتصل بنا" مع نموذج اتصال
5. Layout مشترك مع Header و Footer
6. Navigation menu يظهر في جميع الصفحات

### المتطلبات التقنية:

- استخدم @extends و @section
- استخدم @include للـ Header و Footer
- استخدم @foreach لعرض الخدمات
- استخدم conditional classes للـ active link

---

### الحل:

#### 1. إنشاء المشروع

```bash
composer create-project laravel/laravel simple-website
cd simple-website
```

#### 2. تعريف Routes

**routes/web.php:**
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
```

#### 3. إنشاء Controller

```bash
php artisan make:controller PageController
```

**app/Http/Controllers/PageController.php:**
```php
<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $services = [
            ['name' => 'تطوير المواقع', 'icon' => '🌐', 'description' => 'نقوم بتطوير مواقع احترافية'],
            ['name' => 'تطبيقات الجوال', 'icon' => '📱', 'description' => 'تطبيقات iOS و Android'],
            ['name' => 'التصميم الجرافيكي', 'icon' => '🎨', 'description' => 'تصاميم احترافية مبتكرة'],
            ['name' => 'التسويق الرقمي', 'icon' => '📈', 'description' => 'حملات تسويقية فعالة'],
            ['name' => 'الاستشارات', 'icon' => '💼', 'description' => 'استشارات تقنية متخصصة'],
        ];

        return view('services', compact('services'));
    }

    public function contact()
    {
        return view('contact');
    }
}
```

#### 4. إنشاء Layout

**resources/views/layouts/app.blade.php:**
```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'الموقع')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
```

#### 5. إنشاء Header

**resources/views/partials/header.blade.php:**
```blade
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <div class="text-2xl font-bold text-blue-600">
                شركتي
            </div>

            <nav class="flex space-x-6 space-x-reverse">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    الرئيسية
                </a>
                <a href="{{ route('about') }}"
                   class="{{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    من نحن
                </a>
                <a href="{{ route('services') }}"
                   class="{{ request()->routeIs('services') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    خدماتنا
                </a>
                <a href="{{ route('contact') }}"
                   class="{{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    اتصل بنا
                </a>
            </nav>
        </div>
    </div>
</header>
```

#### 6. إنشاء Footer

**resources/views/partials/footer.blade.php:**
```blade
<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">
        <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - شركتي</p>
    </div>
</footer>
```

#### 7. إنشاء الصفحات

**resources/views/home.blade.php:**
```blade
@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <div class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">مرحباً بكم في شركتي</h1>
            <p class="text-xl mb-8">نقدم أفضل الحلول التقنية</p>
            <a href="{{ route('services') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold">
                تعرف على خدماتنا
            </a>
        </div>
    </div>
@endsection
```

**resources/views/about.blade.php:**
```blade
@extends('layouts.app')

@section('title', 'من نحن')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-6">من نحن</h1>
        <div class="bg-white rounded-lg shadow-md p-8">
            <p class="text-lg mb-4">
                نحن شركة رائدة في مجال التقنية، نقدم حلولاً مبتكرة لعملائنا.
            </p>
            <p class="text-lg">
                فريقنا يتكون من خبراء متخصصين في مختلف المجالات التقنية.
            </p>
        </div>
    </div>
@endsection
```

**resources/views/services.blade.php:**
```blade
@extends('layouts.app')

@section('title', 'خدماتنا')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-center">خدماتنا</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($services as $service)
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">{{ $service['icon'] }}</div>
                    <h3 class="text-xl font-bold mb-2">{{ $service['name'] }}</h3>
                    <p class="text-gray-600">{{ $service['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
```

**resources/views/contact.blade.php:**
```blade
@extends('layouts.app')

@section('title', 'اتصل بنا')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-center">اتصل بنا</h1>

        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
            <form>
                <div class="mb-4">
                    <label class="block font-semibold mb-2">الاسم</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">البريد الإلكتروني</label>
                    <input type="email" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">الرسالة</label>
                    <textarea rows="5" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold">
                    إرسال
                </button>
            </form>
        </div>
    </div>
@endsection
```

---

## التمرين 2: Components (متوسط) ⭐⭐

### المطلوب:

أنشئ مكتبة من الـ Components القابلة لإعادة الاستخدام:

1. **Button Component** مع أنواع مختلفة (primary, secondary, danger)
2. **Card Component** مع header, body, footer
3. **Alert Component** مع أنواع (success, error, warning, info)
4. **Badge Component** لعرض عدد أو حالة
5. صفحة Demo تعرض جميع الـ Components

---

### الحل:

#### 1. إنشاء Components

```bash
php artisan make:component Button
php artisan make:component Card
php artisan make:component Alert
php artisan make:component Badge
```

#### 2. Button Component

**app/View/Components/Button.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $size;

    public function __construct($type = 'primary', $size = 'md')
    {
        $this->type = $type;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.button');
    }

    public function classes()
    {
        $baseClasses = 'px-4 py-2 rounded font-semibold transition';

        $typeClasses = [
            'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
            'secondary' => 'bg-gray-600 text-white hover:bg-gray-700',
            'danger' => 'bg-red-600 text-white hover:bg-red-700',
            'success' => 'bg-green-600 text-white hover:bg-green-700',
        ][$this->type] ?? 'bg-blue-600 text-white';

        $sizeClasses = [
            'sm' => 'text-sm px-3 py-1',
            'md' => 'text-base px-4 py-2',
            'lg' => 'text-lg px-6 py-3',
        ][$this->size] ?? 'text-base px-4 py-2';

        return "$baseClasses $typeClasses $sizeClasses";
    }
}
```

**resources/views/components/button.blade.php:**
```blade
<button {{ $attributes->merge(['class' => $classes()]) }}>
    {{ $slot }}
</button>
```

#### 3. Card Component

**app/View/Components/Card.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.card');
    }
}
```

**resources/views/components/card.blade.php:**
```blade
<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden']) }}>
    @if ($title || isset($header))
        <div class="bg-gray-50 px-6 py-4 border-b">
            @if (isset($header))
                {{ $header }}
            @else
                <h3 class="text-lg font-bold">{{ $title }}</h3>
            @endif
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="bg-gray-50 px-6 py-4 border-t">
            {{ $footer }}
        </div>
    @endisset
</div>
```

#### 4. Alert Component

**app/View/Components/Alert.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $dismissible;

    public function __construct($type = 'info', $dismissible = false)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
    }

    public function render()
    {
        return view('components.alert');
    }

    public function classes()
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
<div class="border-l-4 p-4 {{ $classes() }} relative" role="alert">
    {{ $slot }}

    @if ($dismissible)
        <button class="absolute top-0 left-0 mt-4 ml-4 text-2xl" onclick="this.parentElement.remove()">
            &times;
        </button>
    @endif
</div>
```

#### 5. Badge Component

**app/View/Components/Badge.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public $type;

    public function __construct($type = 'default')
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('components.badge');
    }

    public function classes()
    {
        $base = 'inline-block px-3 py-1 text-xs font-semibold rounded-full';

        $colors = [
            'primary' => 'bg-blue-100 text-blue-800',
            'success' => 'bg-green-100 text-green-800',
            'danger' => 'bg-red-100 text-red-800',
            'warning' => 'bg-yellow-100 text-yellow-800',
            'default' => 'bg-gray-100 text-gray-800',
        ][$this->type] ?? 'bg-gray-100 text-gray-800';

        return "$base $colors";
    }
}
```

**resources/views/components/badge.blade.php:**
```blade
<span {{ $attributes->merge(['class' => $classes()]) }}>
    {{ $slot }}
</span>
```

#### 6. صفحة Demo

**routes/web.php:**
```php
Route::get('/components-demo', function () {
    return view('components-demo');
})->name('components.demo');
```

**resources/views/components-demo.blade.php:**
```blade
@extends('layouts.app')

@section('title', 'Components Demo')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8">مكتبة الـ Components</h1>

        <!-- Buttons -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Buttons</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-wrap gap-4">
                    <x-button type="primary">Primary</x-button>
                    <x-button type="secondary">Secondary</x-button>
                    <x-button type="danger">Danger</x-button>
                    <x-button type="success">Success</x-button>
                </div>

                <div class="flex flex-wrap gap-4 mt-4">
                    <x-button type="primary" size="sm">Small</x-button>
                    <x-button type="primary" size="md">Medium</x-button>
                    <x-button type="primary" size="lg">Large</x-button>
                </div>
            </div>
        </section>

        <!-- Alerts -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Alerts</h2>
            <div class="space-y-4">
                <x-alert type="success">
                    تمت العملية بنجاح!
                </x-alert>

                <x-alert type="error" :dismissible="true">
                    حدث خطأ! يرجى المحاولة مرة أخرى.
                </x-alert>

                <x-alert type="warning">
                    تحذير: يرجى التحقق من البيانات.
                </x-alert>

                <x-alert type="info">
                    معلومة: يمكنك حفظ التغييرات.
                </x-alert>
            </div>
        </section>

        <!-- Cards -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-card title="بطاقة بسيطة">
                    <p>هذا محتوى البطاقة.</p>
                </x-card>

                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold">بطاقة مع Header مخصص</h3>
                            <x-badge type="success">جديد</x-badge>
                        </div>
                    </x-slot>

                    <p>محتوى البطاقة هنا</p>

                    <x-slot name="footer">
                        <div class="flex justify-end gap-2">
                            <x-button type="secondary" size="sm">إلغاء</x-button>
                            <x-button type="primary" size="sm">حفظ</x-button>
                        </div>
                    </x-slot>
                </x-card>
            </div>
        </section>

        <!-- Badges -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Badges</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-wrap gap-2">
                    <x-badge type="primary">Primary</x-badge>
                    <x-badge type="success">Success</x-badge>
                    <x-badge type="danger">Danger</x-badge>
                    <x-badge type="warning">Warning</x-badge>
                    <x-badge>Default</x-badge>
                </div>
            </div>
        </section>
    </div>
@endsection
```

---

## التمرين 3: Product Catalog (متوسط) ⭐⭐⭐

### المطلوب:

أنشئ نظام عرض منتجات مع:

1. قائمة المنتجات مع Pagination
2. صفحة تفاصيل منتج
3. تصفية المنتجات حسب التصنيف
4. عرض المنتجات المشابهة
5. استخدام Components للـ Product Card

---

### الحل:

#### 1. إنشاء Models و Migrations

```bash
php artisan make:model Category -m
php artisan make:model Product -m
```

**Migration للـ categories:**
```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->timestamps();
});
```

**Migration للـ products:**
```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description');
    $table->decimal('price', 10, 2);
    $table->integer('stock');
    $table->string('image')->nullable();
    $table->timestamps();
});
```

```bash
php artisan migrate
```

#### 2. إعداد Models

**app/Models/Category.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
```

**app/Models/Product.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price', 'stock', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
```

#### 3. Seeder

**database/seeders/ProductSeeder.php:**
```php
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'إلكترونيات' => [
                ['name' => 'لابتوب Dell', 'price' => 3500, 'stock' => 10],
                ['name' => 'آيفون 14', 'price' => 4000, 'stock' => 5],
                ['name' => 'سماعات AirPods', 'price' => 800, 'stock' => 20],
            ],
            'ملابس' => [
                ['name' => 'قميص رجالي', 'price' => 150, 'stock' => 30],
                ['name' => 'بنطلون جينز', 'price' => 200, 'stock' => 25],
            ],
            'كتب' => [
                ['name' => 'تعلم Laravel', 'price' => 80, 'stock' => 100],
                ['name' => 'البرمجة بـ PHP', 'price' => 90, 'stock' => 50],
            ],
        ];

        foreach ($categories as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            foreach ($products as $product) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'description' => 'وصف للمنتج ' . $product['name'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                ]);
            }
        }
    }
}
```

```bash
php artisan db:seed --class=ProductSeeder
```

#### 4. Controller

```bash
php artisan make:controller ProductController
```

**app/Http/Controllers/ProductController.php:**
```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->inStock()
            ->paginate(9);

        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inStock()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->inStock()
            ->paginate(9);

        $categories = Category::withCount('products')->get();

        return view('products.category', compact('category', 'products', 'categories'));
    }
}
```

#### 5. Routes

```php
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('products.category');
```

#### 6. Product Card Component

```bash
php artisan make:component ProductCard
```

**resources/views/components/product-card.blade.php:**
```blade
@props(['product'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
    <div class="h-48 bg-gray-200 flex items-center justify-center">
        @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
        @else
            <span class="text-4xl">📦</span>
        @endif
    </div>

    <div class="p-4">
        <a href="{{ route('products.category', $product->category->slug) }}"
           class="text-xs text-blue-600 font-semibold">
            {{ $product->category->name }}
        </a>

        <h3 class="font-bold text-lg mt-2 mb-2">
            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-600">
                {{ $product->name }}
            </a>
        </h3>

        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 80) }}</p>

        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-blue-600">{{ $product->price }} ريال</span>
            <span class="text-sm text-gray-500">متوفر: {{ $product->stock }}</span>
        </div>

        <a href="{{ route('products.show', $product->slug) }}"
           class="mt-4 block w-full bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
            عرض التفاصيل
        </a>
    </div>
</div>
```

#### 7. Views

**resources/views/products/index.blade.php:**
```blade
@extends('layouts.app')

@section('title', 'جميع المنتجات')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8">جميع المنتجات</h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4">التصنيفات</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('products.category', $category->slug) }}"
                                   class="flex items-center justify-between py-2 hover:text-blue-600">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                        {{ $category->products_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <x-alert type="info">لا توجد منتجات متاحة حالياً</x-alert>
                @endif
            </div>
        </div>
    </div>
@endsection
```

**resources/views/products/show.blade.php:**
```blade
@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
            <!-- Product Image -->
            <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-h-full">
                @else
                    <span class="text-9xl">📦</span>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <a href="{{ route('products.category', $product->category->slug) }}"
                   class="text-blue-600 font-semibold mb-2 inline-block">
                    {{ $product->category->name }}
                </a>

                <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>

                <div class="text-4xl font-bold text-blue-600 mb-6">
                    {{ $product->price }} ريال
                </div>

                <p class="text-gray-700 mb-6 leading-relaxed">
                    {{ $product->description }}
                </p>

                <div class="mb-6">
                    <span class="text-sm text-gray-600">المتوفر في المخزون:</span>
                    <span class="font-bold">{{ $product->stock }} قطعة</span>
                </div>

                <button class="w-full bg-blue-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-blue-700">
                    أضف إلى السلة
                </button>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-12">
                <h2 class="text-3xl font-bold mb-6">منتجات مشابهة</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
```

---

## التمرين 4: Dashboard مع Charts (متقدم) ⭐⭐⭐⭐

### المطلوب:

أنشئ لوحة تحكم (Dashboard) تحتوي على:

1. Stat Cards لعرض الإحصائيات
2. جدول بأحدث الطلبات
3. Chart Component (يمكن استخدام Chart.js)
4. Sidebar للتنقل
5. استخدام View Composer لمشاركة البيانات

---

### الحل:

#### 1. إنشاء Models

```bash
php artisan make:model Order -m
php artisan make:model OrderItem -m
```

**Migrations:**
```php
// orders
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('customer_name');
    $table->string('customer_email');
    $table->decimal('total', 10, 2);
    $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
    $table->timestamps();
});

// order_items
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->timestamps();
});
```

#### 2. Stat Card Component

```bash
php artisan make:component StatCard
```

**app/View/Components/StatCard.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;
    public $change;

    public function __construct($title, $value, $icon = '📊', $color = 'blue', $change = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
        $this->change = $change;
    }

    public function render()
    {
        return view('components.stat-card');
    }

    public function colorClasses()
    {
        return [
            'blue' => 'bg-blue-500',
            'green' => 'bg-green-500',
            'red' => 'bg-red-500',
            'yellow' => 'bg-yellow-500',
            'purple' => 'bg-purple-500',
        ][$this->color] ?? 'bg-blue-500';
    }
}
```

**resources/views/components/stat-card.blade.php:**
```blade
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600 text-sm mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold">{{ $value }}</p>

            @if($change)
                <p class="text-sm mt-2 {{ $change > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $change > 0 ? '↑' : '↓' }} {{ abs($change) }}%
                </p>
            @endif
        </div>

        <div class="{{ $colorClasses() }} p-4 rounded-full text-white text-3xl">
            {{ $icon }}
        </div>
    </div>
</div>
```

#### 3. Dashboard Controller

```bash
php artisan make:controller DashboardController
```

**app/Http/Controllers/DashboardController.php:**
```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total'),
        ];

        $recentOrders = Order::latest()->take(10)->get();

        $ordersPerDay = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->get();

        return view('dashboard.index', compact('stats', 'recentOrders', 'ordersPerDay'));
    }
}
```

#### 4. Dashboard Layout

**resources/views/layouts/dashboard.blade.php:**
```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            @include('dashboard.partials.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md">
                @include('dashboard.partials.header')
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
```

#### 5. Dashboard View

**resources/views/dashboard/index.blade.php:**
```blade
@extends('layouts.dashboard')

@section('title', 'الرئيسية')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <x-stat-card
            title="إجمالي المنتجات"
            :value="$stats['total_products']"
            icon="📦"
            color="blue"
            :change="5.2"
        />

        <x-stat-card
            title="إجمالي الطلبات"
            :value="$stats['total_orders']"
            icon="🛒"
            color="green"
            :change="12.5"
        />

        <x-stat-card
            title="الطلبات المعلقة"
            :value="$stats['pending_orders']"
            icon="⏳"
            color="yellow"
        />

        <x-stat-card
            title="إجمالي الإيرادات"
            :value="number_format($stats['total_revenue'], 2) . ' ريال'"
            icon="💰"
            color="purple"
            :change="8.3"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">أحدث الطلبات</h3>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-right py-2">رقم الطلب</th>
                            <th class="text-right py-2">العميل</th>
                            <th class="text-right py-2">المبلغ</th>
                            <th class="text-right py-2">الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr class="border-b">
                                <td class="py-3">#{{ $order->id }}</td>
                                <td class="py-3">{{ $order->customer_name }}</td>
                                <td class="py-3">{{ $order->total }} ريال</td>
                                <td class="py-3">
                                    <x-badge :type="$order->status === 'completed' ? 'success' : 'warning'">
                                        {{ $order->status }}
                                    </x-badge>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    لا توجد طلبات
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Orders Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">الطلبات خلال الأسبوع</h3>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($ordersPerDay->pluck('date')) !!},
            datasets: [{
                label: 'عدد الطلبات',
                data: {!! json_encode($ordersPerDay->pluck('count')) !!},
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
</script>
@endpush
```

---

## التمرين 5: Multi-language Support (متقدم) ⭐⭐⭐⭐

### المطلوب:

أضف دعم تعدد اللغات للموقع:

1. التبديل بين العربية والإنجليزية
2. استخدام ملفات اللغة
3. RTL/LTR switching
4. Language Switcher Component
5. حفظ اللغة المختارة في Session

_(بسبب طول الحل، سأقدم الخطوات الأساسية)_

---

## التمرين 6: مشروع متكامل - E-commerce Website (متقدم جداً) ⭐⭐⭐⭐⭐

### المطلوب:

أنشئ موقع تجارة إلكترونية متكامل يحتوي على:

1. صفحة رئيسية مع slider و featured products
2. نظام تصنيفات متعدد المستويات
3. صفحة منتج مع صور متعددة و reviews
4. سلة تسوق
5. نظام wishlist
6. صفحة checkout
7. لوحة تحكم للمدير
8. استخدام Components لجميع العناصر المتكررة
9. Responsive design كامل
10. استخدام View Composers بشكل متقدم

_(هذا مشروع كبير يتطلب عدة أيام للتطوير)_

---

## ملخص التمارين

✅ **التمرين 1**: صفحات بسيطة مع Layout
✅ **التمرين 2**: مكتبة Components
✅ **التمرين 3**: Product Catalog
✅ **التمرين 4**: Dashboard مع Charts
✅ **التمرين 5**: Multi-language Support
✅ **التمرين 6**: E-commerce Website كامل

---

## نصائح للممارسة

1. **ابدأ بالتمارين السهلة** ثم انتقل للأصعب
2. **حاول حل التمرين بنفسك أولاً** قبل النظر للحل
3. **أضف ميزات إضافية** لكل تمرين
4. **استخدم Git** لحفظ تقدمك
5. **راجع الكود** واجعله أفضل

---

**تهانينا! 🎉 أنت الآن جاهز لبناء تطبيقات Laravel احترافية!**
