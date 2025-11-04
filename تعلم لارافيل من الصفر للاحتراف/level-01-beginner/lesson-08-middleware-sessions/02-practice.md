# الدرس 8: التطبيق العملي - Middleware والجلسات
# Lesson 8: Practical Implementation - Middleware and Sessions

**المستوى:** مبتدئ | Beginner
**المدة المقدرة:** 2-3 ساعات | 2-3 hours

---

## 📑 جدول المحتويات | Table of Contents

1. [التحضير](#التحضير)
2. [مشروع عملي: نظام إدارة محتوى بسيط](#مشروع-عملي-نظام-إدارة-محتوى-بسيط)
3. [تطبيق Middleware للتحقق من الصلاحيات](#تطبيق-middleware-للتحقق-من-الصلاحيات)
4. [بناء نظام سلة تسوق بـ Sessions](#بناء-نظام-سلة-تسوق-بـ-sessions)
5. [Flash Messages System](#flash-messages-system)
6. [Middleware للغة (Localization)](#middleware-للغة-localization)
7. [Testing](#testing)

---

## 🎯 أهداف التطبيق العملي

بنهاية هذا التطبيق، ستكون قد بنيت:

- ✅ نظام Middleware كامل للتحقق من الصلاحيات
- ✅ نظام سلة تسوق باستخدام Sessions
- ✅ نظام Flash Messages متقدم
- ✅ Middleware للتبديل بين اللغات
- ✅ Middleware لتسجيل النشاطات

---

## 🚀 التحضير

### 1. إنشاء مشروع جديد

```bash
# إنشاء مشروع Laravel جديد
composer create-project laravel/laravel middleware-sessions-app
cd middleware-sessions-app

# تشغيل السيرفر
php artisan serve
```

### 2. إعداد قاعدة البيانات

```bash
# في ملف .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=middleware_sessions_app
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# تشغيل migrations
php artisan migrate
```

### 3. إعداد Sessions

```bash
# تغيير driver إلى database
# في .env
SESSION_DRIVER=database

# إنشاء جدول sessions
php artisan session:table
php artisan migrate
```

---

## 📦 مشروع عملي: نظام إدارة محتوى بسيط

### الخطوة 1: إنشاء Models و Migrations

```bash
# إنشاء User roles
php artisan make:model Role -m
php artisan make:model Post -m

# إنشاء جدول وسيط
php artisan make:migration create_role_user_table
```

#### Migration: roles

```php
<?php
// database/migrations/xxxx_create_roles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // admin, editor, user
            $table->string('display_name'); // المدير, المحرر, المستخدم
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
```

#### Migration: role_user

```php
<?php
// database/migrations/xxxx_create_role_user_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            // منع التكرار
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
```

#### Migration: posts

```php
<?php
// database/migrations/xxxx_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

### الخطوة 2: تحديث Models

#### User Model

```php
<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // العلاقات | Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Methods مساعدة
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function assignRole(string $role): void
    {
        $roleModel = Role::where('name', $role)->first();
        if ($roleModel) {
            $this->roles()->syncWithoutDetaching($roleModel);
        }
    }
}
```

#### Role Model

```php
<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
```

#### Post Model

```php
<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'content', 'status', 'user_id'];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### الخطوة 3: إنشاء Seeder

```bash
php artisan make:seeder RoleSeeder
php artisan make:seeder UserSeeder
```

#### RoleSeeder

```php
<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'المدير',
                'description' => 'له صلاحية كاملة على النظام'
            ],
            [
                'name' => 'editor',
                'display_name' => 'المحرر',
                'description' => 'يمكنه إنشاء وتعديل المحتوى'
            ],
            [
                'name' => 'user',
                'display_name' => 'المستخدم',
                'description' => 'مستخدم عادي'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
```

#### UserSeeder

```php
<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Editor User
        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
        ]);
        $editor->assignRole('editor');

        // Normal User
        $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('user');
    }
}
```

#### تحديث DatabaseSeeder

```php
<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
```

```bash
# تشغيل Seeders
php artisan db:seed
```

---

## 🛡️ تطبيق Middleware للتحقق من الصلاحيات

### الخطوة 1: إنشاء Middleware

```bash
php artisan make:middleware CheckRole
php artisan make:middleware CheckPermission
php artisan make:middleware LogActivity
```

### CheckRole Middleware

```php
<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // التحقق من تسجيل الدخول
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $user = auth()->user();

        // التحقق من وجود أحد الأدوار المطلوبة
        if (!$user->hasAnyRole($roles)) {
            abort(403, 'ليس لديك صلاحية الوصول لهذه الصفحة');
        }

        return $next($request);
    }
}
```

### CheckPermission Middleware

```php
<?php
// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $action): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // منطق التحقق من الصلاحيات
        $canPerform = match($action) {
            'create-post' => $user->hasAnyRole(['admin', 'editor']),
            'edit-post' => $this->canEditPost($user, $request),
            'delete-post' => $user->hasRole('admin'),
            'publish-post' => $user->hasAnyRole(['admin', 'editor']),
            default => false,
        };

        if (!$canPerform) {
            return redirect()->back()
                ->with('error', 'ليس لديك صلاحية لتنفيذ هذا الإجراء');
        }

        return $next($request);
    }

    private function canEditPost($user, $request): bool
    {
        // Admin يمكنه تعديل أي منشور
        if ($user->hasRole('admin')) {
            return true;
        }

        // Editor يمكنه تعديل منشوراته فقط
        if ($user->hasRole('editor')) {
            $post = $request->route('post');
            return $post && $post->user_id === $user->id;
        }

        return false;
    }
}
```

### LogActivity Middleware

```php
<?php
// app/Http/Middleware/LogActivity.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        // معالجة الطلب
        $response = $next($request);

        // حساب الوقت المستغرق
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        // تسجيل النشاط
        if (auth()->check()) {
            Log::info('User Activity', [
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'duration' => $duration . 'ms',
                'timestamp' => now(),
            ]);

            // حفظ في Session أيضاً
            session()->push('activity_log', [
                'url' => $request->path(),
                'time' => now()->toDateTimeString(),
            ]);
        }

        return $response;
    }
}
```

### الخطوة 2: تسجيل Middleware

```php
<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        // Route Middleware Aliases
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'log.activity' => \App\Http\Middleware\LogActivity::class,
        ]);

        // Middleware Groups
        $middleware->group('admin', [
            'auth',
            'role:admin',
            'log.activity',
        ]);

        $middleware->group('editor', [
            'auth',
            'role:admin,editor',
            'log.activity',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

### الخطوة 3: استخدام Middleware في Routes

```php
<?php
// routes/web.php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Protected routes - يتطلب تسجيل دخول
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Editor routes - يتطلب دور editor أو admin
Route::middleware(['editor'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->middleware('permission:edit-post')
        ->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->middleware('permission:edit-post')
        ->name('posts.update');
});

// Admin routes - يتطلب دور admin فقط
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
    Route::get('/users', [AdminController::class, 'users'])
        ->name('users');
});
```

---

## 🛒 بناء نظام سلة تسوق بـ Sessions

### الخطوة 1: إنشاء Product Model

```bash
php artisan make:model Product -m
```

```php
<?php
// database/migrations/xxxx_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

```php
<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
```

### الخطوة 2: إنشاء Cart Service

```php
<?php
// app/Services/CartService.php

namespace App\Services;

use App\Models\Product;

class CartService
{
    /**
     * الحصول على السلة الحالية
     */
    public function getCart(): array
    {
        return session()->get('cart', []);
    }

    /**
     * إضافة منتج للسلة
     */
    public function add(int $productId, int $quantity = 1): bool
    {
        $product = Product::find($productId);

        if (!$product || !$product->is_active) {
            return false;
        }

        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            // المنتج موجود مسبقاً - زيادة الكمية
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // منتج جديد
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return true;
    }

    /**
     * تحديث كمية منتج
     */
    public function update(int $productId, int $quantity): bool
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return false;
        }

        if ($quantity <= 0) {
            return $this->remove($productId);
        }

        $cart[$productId]['quantity'] = $quantity;
        session()->put('cart', $cart);
        return true;
    }

    /**
     * حذف منتج من السلة
     */
    public function remove(int $productId): bool
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return false;
        }

        unset($cart[$productId]);
        session()->put('cart', $cart);
        return true;
    }

    /**
     * تفريغ السلة
     */
    public function clear(): void
    {
        session()->forget('cart');
    }

    /**
     * حساب المجموع
     */
    public function getTotal(): float
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return round($total, 2);
    }

    /**
     * عدد العناصر
     */
    public function getCount(): int
    {
        $cart = $this->getCart();
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    /**
     * التحقق من فراغ السلة
     */
    public function isEmpty(): bool
    {
        return empty($this->getCart());
    }
}
```

### الخطوة 3: إنشاء Cart Controller

```bash
php artisan make:controller CartController
```

```php
<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * عرض السلة
     */
    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * إضافة منتج للسلة
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $added = $this->cartService->add(
            $request->product_id,
            $request->quantity ?? 1
        );

        if ($added) {
            return redirect()->back()
                ->with('success', 'تمت إضافة المنتج للسلة بنجاح');
        }

        return redirect()->back()
            ->with('error', 'عذراً، لم نتمكن من إضافة المنتج');
    }

    /**
     * تحديث كمية منتج
     */
    public function update(Request $request, int $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $updated = $this->cartService->update($productId, $request->quantity);

        if ($updated) {
            return redirect()->back()
                ->with('success', 'تم تحديث السلة بنجاح');
        }

        return redirect()->back()
            ->with('error', 'عذراً، لم نتمكن من تحديث المنتج');
    }

    /**
     * حذف منتج من السلة
     */
    public function remove(int $productId)
    {
        $removed = $this->cartService->remove($productId);

        if ($removed) {
            return redirect()->back()
                ->with('success', 'تم حذف المنتج من السلة');
        }

        return redirect()->back()
            ->with('error', 'المنتج غير موجود في السلة');
    }

    /**
     * تفريغ السلة
     */
    public function clear()
    {
        $this->cartService->clear();

        return redirect()->back()
            ->with('success', 'تم تفريغ السلة بنجاح');
    }
}
```

### الخطوة 4: Routes للسلة

```php
<?php
// routes/web.php

use App\Http\Controllers\CartController;

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/{product}', [CartController::class, 'update'])->name('update');
    Route::delete('/{product}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/', [CartController::class, 'clear'])->name('clear');
});
```

### الخطوة 5: View Component للسلة

```bash
php artisan make:component CartIcon
```

```php
<?php
// app/View/Components/CartIcon.php

namespace App\View\Components;

use App\Services\CartService;
use Illuminate\View\Component;

class CartIcon extends Component
{
    public int $count;

    public function __construct(CartService $cartService)
    {
        $this->count = $cartService->getCount();
    }

    public function render()
    {
        return view('components.cart-icon');
    }
}
```

```blade
{{-- resources/views/components/cart-icon.blade.php --}}

<a href="{{ route('cart.index') }}" class="cart-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
    </svg>
    @if($count > 0)
        <span class="badge">{{ $count }}</span>
    @endif
</a>
```

---

## 💬 Flash Messages System

### إنشاء Flash Message Helper

```php
<?php
// app/Helpers/FlashHelper.php

namespace App\Helpers;

class FlashHelper
{
    /**
     * رسالة نجاح
     */
    public static function success(string $message): void
    {
        session()->flash('success', $message);
    }

    /**
     * رسالة خطأ
     */
    public static function error(string $message): void
    {
        session()->flash('error', $message);
    }

    /**
     * رسالة تحذير
     */
    public static function warning(string $message): void
    {
        session()->flash('warning', $message);
    }

    /**
     * رسالة معلومة
     */
    public static function info(string $message): void
    {
        session()->flash('info', $message);
    }
}
```

### تسجيل Helper في Composer

```json
// composer.json

{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/Helpers/FlashHelper.php"
        ]
    }
}
```

```bash
composer dump-autoload
```

### إنشاء Blade Component للرسائل

```bash
php artisan make:component Alert
```

```php
<?php
// app/View/Components/Alert.php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public function render()
    {
        return view('components.alert');
    }
}
```

```blade
{{-- resources/views/components/alert.blade.php --}}

@if(session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
    <div class="alerts-container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
                <button type="button" class="close-btn" onclick="this.parentElement.remove()">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
                <button type="button" class="close-btn" onclick="this.parentElement.remove()">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning" role="alert">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <span>{{ session('warning') }}</span>
                <button type="button" class="close-btn" onclick="this.parentElement.remove()">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info" role="alert">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('info') }}</span>
                <button type="button" class="close-btn" onclick="this.parentElement.remove()">
                    <span>&times;</span>
                </button>
            </div>
        @endif
    </div>
@endif

<style>
    .alerts-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
    }
    .alert {
        display: flex;
        align-items: center;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
    .alert-icon {
        width: 24px;
        height: 24px;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }
    .close-btn {
        margin-left: auto;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
    }
    .close-btn:hover {
        opacity: 1;
    }
</style>
```

### استخدام في Layout

```blade
{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
</head>
<body>
    {{-- Flash Messages --}}
    <x-alert />

    {{-- المحتوى الرئيسي --}}
    @yield('content')
</body>
</html>
```

---

## 🌍 Middleware للغة (Localization)

### إنشاء SetLocale Middleware

```bash
php artisan make:middleware SetLocale
```

```php
<?php
// app/Http/Middleware/SetLocale.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // اللغات المدعومة
        $supportedLocales = ['ar', 'en'];

        // 1. من الـ URL parameter
        if ($request->has('lang') && in_array($request->lang, $supportedLocales)) {
            $locale = $request->lang;
            session(['locale' => $locale]);
            App::setLocale($locale);
        }
        // 2. من Session
        elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        }
        // 3. من متصفح المستخدم
        elseif ($request->hasHeader('Accept-Language')) {
            $browserLang = substr($request->header('Accept-Language'), 0, 2);
            if (in_array($browserLang, $supportedLocales)) {
                App::setLocale($browserLang);
                session(['locale' => $browserLang]);
            }
        }

        return $next($request);
    }
}
```

### تسجيل Middleware

```php
<?php
// bootstrap/app.php

->withMiddleware(function (Middleware $middleware) {
    // Global Middleware
    $middleware->append(\App\Http\Middleware\SetLocale::class);

    // أو
    $middleware->alias([
        'locale' => \App\Http\Middleware\SetLocale::class,
    ]);
})
```

### إنشاء ملفات الترجمة

```php
<?php
// lang/ar/messages.php

return [
    'welcome' => 'مرحباً',
    'logout' => 'تسجيل خروج',
    'profile' => 'الملف الشخصي',
    'dashboard' => 'لوحة التحكم',
];
```

```php
<?php
// lang/en/messages.php

return [
    'welcome' => 'Welcome',
    'logout' => 'Logout',
    'profile' => 'Profile',
    'dashboard' => 'Dashboard',
];
```

### Language Switcher Component

```blade
{{-- resources/views/components/language-switcher.blade.php --}}

<div class="language-switcher">
    <a href="{{ url()->current() }}?lang=ar" class="{{ app()->getLocale() == 'ar' ? 'active' : '' }}">
        العربية
    </a>
    <span>|</span>
    <a href="{{ url()->current() }}?lang=en" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
        English
    </a>
</div>
```

---

## ✅ ملخص التطبيق العملي

في هذا التطبيق العملي، قمنا ببناء:

1. ✅ **نظام صلاحيات كامل**
   - CheckRole Middleware
   - CheckPermission Middleware
   - Role-based access control

2. ✅ **نظام سلة تسوق**
   - CartService
   - Session-based storage
   - Add, Update, Remove, Clear

3. ✅ **نظام Flash Messages**
   - Success, Error, Warning, Info
   - Auto-dismiss alerts
   - Beautiful UI

4. ✅ **Middleware للغة**
   - Multi-language support
   - Session-based locale
   - Language switcher

5. ✅ **تسجيل النشاطات**
   - LogActivity Middleware
   - Request tracking
   - Performance monitoring

---

## 🎯 الخطوات التالية

- ✅ اختبر جميع الـ Middlewares
- ✅ أضف المزيد من الصلاحيات
- ✅ قم ببناء واجهة المستخدم
- ✅ اكمل نظام الـ Posts
- ✅ أضف Unit Tests

---

**📌 ملاحظة:** تأكد من اختبار كل جزء قبل الانتقال للتالي!

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
