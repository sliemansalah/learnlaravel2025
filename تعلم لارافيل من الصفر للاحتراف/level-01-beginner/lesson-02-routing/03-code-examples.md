# الدرس الثاني - أمثلة الكود: Routing في Laravel

## 📋 المحتويات
1. [أمثلة Routes الأساسية](#basic-routes)
2. [أمثلة HTTP Methods](#http-methods)
3. [أمثلة Route Parameters](#route-parameters)
4. [أمثلة Named Routes](#named-routes)
5. [أمثلة Route Groups](#route-groups)
6. [أمثلة Route Model Binding](#route-model-binding)
7. [أمثلة API Routes](#api-routes)
8. [أمثلة متقدمة](#advanced-examples)

---

## 1. أمثلة Routes الأساسية {#basic-routes}

### مثال 1: Route بسيط يُرجع نص

```php
// routes/web.php

Route::get('/', function () {
    return 'مرحباً بك في Laravel!';
});

Route::get('/about', function () {
    return 'صفحة من نحن';
});
```

**الاستخدام:**
```
http://localhost:8000/
http://localhost:8000/about
```

---

### مثال 2: Route يُرجع JSON

```php
Route::get('/api/data', function () {
    return response()->json([
        'message' => 'Hello World',
        'status' => 'success',
        'data' => [
            'name' => 'Laravel',
            'version' => '10'
        ]
    ]);
});
```

**الناتج:**
```json
{
    "message": "Hello World",
    "status": "success",
    "data": {
        "name": "Laravel",
        "version": "10"
    }
}
```

---

### مثال 3: Route::view() لعرض View

```php
// عرض view مباشرة بدون controller
Route::view('/welcome', 'welcome');

// مع تمرير بيانات
Route::view('/about', 'about', [
    'title' => 'من نحن',
    'description' => 'نحن شركة متخصصة في تطوير الويب'
]);
```

---

### مثال 4: Route::redirect()

```php
// إعادة توجيه بسيطة
Route::redirect('/old-url', '/new-url');

// إعادة توجيه دائمة (301)
Route::redirect('/old-page', '/new-page', 301);

// أو استخدم permanentRedirect
Route::permanentRedirect('/old', '/new');
```

---

## 2. أمثلة HTTP Methods {#http-methods}

### مثال 5: جميع HTTP Methods

```php
// GET - جلب البيانات
Route::get('/posts', function () {
    return 'عرض جميع المقالات';
});

// POST - إنشاء جديد
Route::post('/posts', function () {
    return 'إنشاء مقال جديد';
});

// PUT - تحديث كامل
Route::put('/posts/{id}', function ($id) {
    return "تحديث المقال رقم $id";
});

// PATCH - تحديث جزئي
Route::patch('/posts/{id}', function ($id) {
    return "تحديث جزئي للمقال رقم $id";
});

// DELETE - حذف
Route::delete('/posts/{id}', function ($id) {
    return "حذف المقال رقم $id";
});
```

---

### مثال 6: Route::match() - عدة Methods

```php
// قبول GET و POST
Route::match(['get', 'post'], '/contact', function () {
    if (request()->isMethod('get')) {
        return view('contact.form');
    }

    // معالجة POST
    return 'تم إرسال النموذج';
});
```

---

### مثال 7: Route::any() - جميع Methods

```php
// قبول جميع HTTP Methods
Route::any('/webhook', function () {
    $method = request()->method();
    return "استقبلت طلب من نوع: $method";
});
```

---

## 3. أمثلة Route Parameters {#route-parameters}

### مثال 8: Required Parameter

```php
// معامل واحد
Route::get('/users/{id}', function ($id) {
    return "عرض المستخدم رقم: $id";
});

// معاملين
Route::get('/posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return "تعليق رقم $commentId من مقال رقم $postId";
});
```

**الاستخدام:**
```
http://localhost:8000/users/5
http://localhost:8000/posts/10/comments/25
```

---

### مثال 9: Optional Parameter

```php
// معامل اختياري مع قيمة افتراضية
Route::get('/users/{name?}', function ($name = 'ضيف') {
    return "مرحباً $name";
});

// معاملين اختياريين
Route::get('/posts/{category?}/{year?}', function ($category = 'all', $year = null) {
    if ($year) {
        return "مقالات $category لسنة $year";
    }
    return "مقالات $category";
});
```

**الاستخدام:**
```
http://localhost:8000/users          → مرحباً ضيف
http://localhost:8000/users/ahmed    → مرحباً ahmed
http://localhost:8000/posts          → مقالات all
http://localhost:8000/posts/tech     → مقالات tech
http://localhost:8000/posts/tech/2024 → مقالات tech لسنة 2024
```

---

### مثال 10: Regular Expression Constraints

```php
// فقط أرقام
Route::get('/users/{id}', function ($id) {
    return "User ID: $id";
})->where('id', '[0-9]+');

// فقط حروف
Route::get('/users/{name}', function ($name) {
    return "User: $name";
})->where('name', '[a-zA-Z]+');

// قيود متعددة
Route::get('/posts/{id}/{slug}', function ($id, $slug) {
    return "Post: $id - $slug";
})->where(['id' => '[0-9]+', 'slug' => '[a-z-]+']);

// استخدام whereNumber و whereAlpha
Route::get('/users/{id}', function ($id) {
    return "User: $id";
})->whereNumber('id');

Route::get('/category/{name}', function ($name) {
    return "Category: $name";
})->whereAlpha('name');

Route::get('/posts/{slug}', function ($slug) {
    return "Post: $slug";
})->whereAlphaNumeric('slug');

// UUID
Route::get('/products/{uuid}', function ($uuid) {
    return "Product UUID: $uuid";
})->whereUuid('uuid');
```

---

### مثال 11: Global Constraints

```php
// في RouteServiceProvider.php
public function boot()
{
    // جميع parameters اسمها 'id' يجب أن تكون أرقام
    Route::pattern('id', '[0-9]+');

    // جميع parameters اسمها 'slug' يجب أن تكون حروف وشرطات
    Route::pattern('slug', '[a-z0-9-]+');
}

// الآن في web.php لن تحتاج ->where()
Route::get('/posts/{id}', function ($id) {
    return "Post: $id";
}); // تطبق القيود تلقائياً
```

---

## 4. أمثلة Named Routes {#named-routes}

### مثال 12: تسمية Routes

```php
// تسمية route بسيط
Route::get('/profile', function () {
    return 'صفحة الملف الشخصي';
})->name('profile');

// مع parameter
Route::get('/users/{id}', function ($id) {
    return "User: $id";
})->name('users.show');

// تسمية route مع controller
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
```

---

### مثال 13: استخدام route() helper

```php
// في Controller أو Closure
Route::get('/redirect-example', function () {
    // إعادة توجيه إلى named route
    return redirect()->route('profile');
});

// مع parameters
Route::get('/show-user', function () {
    return redirect()->route('users.show', ['id' => 5]);
});

// مع query string
Route::get('/search', function () {
    return redirect()->route('posts.index', ['sort' => 'date', 'order' => 'desc']);
    // النتيجة: /posts?sort=date&order=desc
});
```

**في Blade:**
```blade
<!-- رابط بسيط -->
<a href="{{ route('profile') }}">الملف الشخصي</a>

<!-- مع parameter -->
<a href="{{ route('users.show', ['id' => $user->id]) }}">عرض المستخدم</a>

<!-- أو -->
<a href="{{ route('users.show', $user->id) }}">عرض المستخدم</a>

<!-- مع query strings -->
<a href="{{ route('posts.index', ['category' => 'tech', 'page' => 2]) }}">
    مقالات التقنية - صفحة 2
</a>
```

---

### مثال 14: توليد URLs

```php
// الحصول على URL الكامل
$url = route('posts.show', ['id' => 1]);
// النتيجة: http://localhost:8000/posts/1

// التحقق من route الحالي
if (request()->routeIs('posts.*')) {
    // نحن في أي route يبدأ بـ posts.
}

if (request()->routeIs('posts.show')) {
    // نحن في posts.show بالضبط
}
```

---

## 5. أمثلة Route Groups {#route-groups}

### مثال 15: Prefix Group

```php
// جميع routes تبدأ بـ /admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'لوحة التحكم';
    }); // /admin/dashboard

    Route::get('/users', function () {
        return 'المستخدمين';
    }); // /admin/users

    Route::get('/posts', function () {
        return 'المقالات';
    }); // /admin/posts
});
```

---

### مثال 16: Name Prefix

```php
// جميع أسماء routes تبدأ بـ admin.
Route::name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard';
    })->name('dashboard'); // اسمها: admin.dashboard

    Route::get('/users', function () {
        return 'Users';
    })->name('users'); // اسمها: admin.users
});
```

---

### مثال 17: Prefix + Name مع Controller

```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // URL: /admin/posts
    // Name: admin.posts.index

    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    // URL: /admin/posts/{id}
    // Name: admin.posts.show
});
```

---

### مثال 18: Middleware Group

```php
// تطبيق middleware على مجموعة
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return 'لوحة التحكم';
    });

    Route::get('/profile', function () {
        return 'الملف الشخصي';
    });
});
```

---

### مثال 19: مجموعة متكاملة (Prefix + Name + Middleware)

```php
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // لوحة التحكم
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        // URL: /admin/dashboard
        // Name: admin.dashboard
        // Middleware: auth, admin

        // إدارة المستخدمين
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            // URL: /admin/users
            // Name: admin.users.index

            Route::get('/{id}', [UserController::class, 'show'])->name('show');
            // URL: /admin/users/{id}
            // Name: admin.users.show
        });

        // إدارة المقالات
        Route::resource('posts', PostController::class);
        // يُنشئ: admin.posts.index, admin.posts.create, إلخ
    });
```

---

### مثال 20: Domain Group (Subdomain Routing)

```php
// routes للـ subdomain محدد
Route::domain('api.example.com')->group(function () {
    Route::get('/users', function () {
        return 'API Users';
    });
});

// مع dynamic subdomain
Route::domain('{account}.example.com')->group(function () {
    Route::get('/dashboard', function ($account) {
        return "Dashboard for: $account";
    });
});
// مثال: company1.example.com/dashboard
```

---

## 6. أمثلة Route Model Binding {#route-model-binding}

### مثال 21: Implicit Binding (الضمني)

```php
// Model
namespace App\Models;

class Post extends Model
{
    // ...
}

// Route
Route::get('/posts/{post}', function (Post $post) {
    // Laravel يجلب Post تلقائياً بناءً على id
    return $post;
});
```

**الاستخدام:**
```
http://localhost:8000/posts/5
→ يجلب Post::findOrFail(5) تلقائياً
```

---

### مثال 22: Custom Key (مفتاح مخصص)

```php
// في Route - استخدام slug بدلاً من id
Route::get('/posts/{post:slug}', function (Post $post) {
    return $post;
});
// الآن: /posts/my-first-post يبحث بـ slug

// أو في Model - تعيين مفتاح افتراضي
class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug'; // استخدم slug دائماً
    }
}

// الآن جميع route bindings تستخدم slug
Route::get('/posts/{post}', function (Post $post) {
    return $post; // يبحث بـ slug تلقائياً
});
```

---

### مثال 23: Soft Deleted Models

```php
// تضمين soft deleted models
Route::get('/posts/{post}', function (Post $post) {
    return $post;
})->withTrashed();

// الآن يمكن جلب posts المحذوفة أيضاً
```

---

### مثال 24: Explicit Binding

```php
// في RouteServiceProvider.php
use App\Models\Post;

public function boot()
{
    // Explicit binding بسيط
    Route::model('post', Post::class);

    // أو مع custom logic
    Route::bind('post', function ($value) {
        return Post::where('slug', $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    });
}

// الآن في web.php
Route::get('/posts/{post}', function ($post) {
    // $post جاهز ومعالج حسب bind()
    return $post;
});
```

---

### مثال 25: Scoped Binding (Laravel 9+)

```php
// User له posts، نريد فقط posts للـ user المحدد
Route::get('/users/{user}/posts/{post}', function (User $user, Post $post) {
    return $post;
})->scopeBindings();

// أو في group
Route::scopeBindings()->group(function () {
    Route::get('/users/{user}/posts/{post}', function (User $user, Post $post) {
        return $post;
    });
});

// الآن Laravel يتأكد أن post يعود لـ user
// مثل: WHERE user_id = $user->id AND id = $post
```

---

## 7. أمثلة API Routes {#api-routes}

### مثال 26: API Routes الأساسية

```php
// في routes/api.php
// جميع routes هنا تبدأ بـ /api تلقائياً

Route::get('/posts', function () {
    $posts = Post::all();
    return response()->json(['data' => $posts]);
});

Route::post('/posts', function () {
    $post = Post::create(request()->all());
    return response()->json(['data' => $post], 201);
});
```

**الاستخدام:**
```
GET  http://localhost:8000/api/posts
POST http://localhost:8000/api/posts
```

---

### مثال 27: API Resource Routes

```php
// في api.php
Route::apiResource('posts', PostController::class);

// يُنشئ 5 routes:
// GET    /api/posts              → index
// POST   /api/posts              → store
// GET    /api/posts/{post}       → show
// PUT    /api/posts/{post}       → update
// DELETE /api/posts/{post}       → destroy
```

---

### مثال 28: API مع Versioning

```php
// Version 1
Route::prefix('v1')->group(function () {
    Route::apiResource('posts', 'Api\V1\PostController');
    Route::apiResource('users', 'Api\V1\UserController');
});

// Version 2
Route::prefix('v2')->group(function () {
    Route::apiResource('posts', 'Api\V2\PostController');
    Route::apiResource('users', 'Api\V2\UserController');
});
```

**الاستخدام:**
```
http://localhost:8000/api/v1/posts
http://localhost:8000/api/v2/posts
```

---

### مثال 29: Rate Limiting في API

```php
// في routes/api.php
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/posts', function () {
        return Post::all();
    });
});
// يسمح بـ 60 طلب في الدقيقة

// أو custom rate limiter (في RouteServiceProvider.php)
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

public function boot()
{
    RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(100)->by($request->user()?->id ?: $request->ip());
    });
}

// ثم في routes/api.php
Route::middleware('throttle:api')->group(function () {
    // routes هنا
});
```

---

## 8. أمثلة متقدمة {#advanced-examples}

### مثال 30: Fallback Route (404 مخصص)

```php
// يجب أن يكون آخر route
Route::fallback(function () {
    return response()->json([
        'message' => 'الصفحة غير موجودة',
        'code' => 404
    ], 404);
});

// أو عرض view
Route::fallback(function () {
    return view('errors.404');
});
```

---

### مثال 31: Route Caching

```bash
# تخزين routes مؤقتاً (لتسريع الأداء في الإنتاج)
php artisan route:cache

# مسح cache
php artisan route:clear

# عرض جميع routes
php artisan route:list
```

---

### مثال 32: CORS Configuration

```php
// في config/cors.php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_headers' => ['*'],
];

// أو في middleware
Route::middleware('cors')->group(function () {
    Route::apiResource('posts', PostController::class);
});
```

---

### مثال 33: Current Route Information

```php
Route::get('/info', function () {
    $route = request()->route();

    return [
        'name' => $route->getName(),
        'uri' => $route->uri(),
        'method' => request()->method(),
        'action' => $route->getActionName(),
        'parameters' => $route->parameters(),
    ];
});

// في Blade
@if (request()->routeIs('posts.index'))
    <li class="active">المقالات</li>
@endif
```

---

### مثال 34: Signed URLs (روابط موقعة للأمان)

```php
// إنشاء signed URL
use Illuminate\Support\Facades\URL;

Route::get('/create-link', function () {
    $url = URL::signedRoute('verify-email', [
        'id' => 1,
        'hash' => sha1('user@example.com')
    ]);

    return $url;
});

// Route الذي يتطلب signature
Route::get('/verify/{id}/{hash}', function ($id, $hash) {
    return "Email verified!";
})->name('verify-email')->middleware('signed');

// Temporary signed URL (تنتهي بعد وقت محدد)
$url = URL::temporarySignedRoute(
    'verify-email',
    now()->addMinutes(30),
    ['id' => 1, 'hash' => sha1('user@example.com')]
);
```

---

### مثال 35: مشروع كامل - Blog System Routes

```php
<?php
// routes/web.php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('home');
})->name('home');

// Posts Routes
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/', [PostController::class, 'store'])->name('store')->middleware('auth');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/{post}', [PostController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy')->middleware('auth');

    // Comments على post
    Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Authors
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

// Admin Panel
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Admin Posts Management
    Route::resource('posts', Admin\PostController::class);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('users', Admin\UserController::class);
});

// API Routes (في api.php)
Route::prefix('v1')->name('api.')->group(function () {
    Route::apiResource('posts', Api\PostController::class);
    Route::apiResource('categories', Api\CategoryController::class);

    // مع authentication
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/posts/{post}/like', [Api\PostController::class, 'like']);
        Route::delete('/posts/{post}/like', [Api\PostController::class, 'unlike']);
    });
});
```

---

## 🎯 ملخص الأوامر المهمة

```bash
# عرض جميع routes
php artisan route:list

# عرض routes محددة
php artisan route:list --name=posts

# تخزين routes مؤقتاً (production)
php artisan route:cache

# مسح route cache
php artisan route:clear

# تشغيل السيرفر
php artisan serve
```

---

## 📚 مصادر إضافية

- [Laravel Routing Documentation](https://laravel.com/docs/routing)
- [Laravel Route Model Binding](https://laravel.com/docs/routing#route-model-binding)
- [Laravel API Resources](https://laravel.com/docs/eloquent-resources)

---

**الدرس التالي**: Controllers 🎯
