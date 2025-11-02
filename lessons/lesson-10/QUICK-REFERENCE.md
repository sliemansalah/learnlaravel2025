# Middleware - مرجع سريع

## 🚀 إنشاء Middleware

```bash
php artisan make:middleware MiddlewareName
```

---

## 📝 الهيكل الأساسي

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MiddlewareName
{
    public function handle(Request $request, Closure $next)
    {
        // منطق Before

        $response = $next($request);

        // منطق After

        return $response;
    }
}
```

---

## 🔧 تسجيل Middleware (Laravel 11)

### في `bootstrap/app.php`:

```php
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        // اسم مستعار
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
        ]);

        // عامة
        $middleware->append(\App\Http\Middleware\LogRequests::class);

        // مجموعة
        $middleware->group('api.protected', [
            \App\Http\Middleware\ApiAuth::class,
            \App\Http\Middleware\RateLimit::class,
        ]);

        // أولوية
        $middleware->priority([
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\CustomMiddleware::class,
        ]);

        // إضافة للمجموعات الموجودة
        $middleware->prependToGroup('web', \App\Http\Middleware\First::class);
        $middleware->appendToGroup('api', \App\Http\Middleware\Last::class);
    })
    ->create();
```

---

## 🛣️ تطبيق Middleware على المسارات

### مسار واحد
```php
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth');
```

### عدة Middleware
```php
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin', 'verified']);
```

### مجموعات المسارات
```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
});
```

### مع معاملات
```php
Route::get('/posts', [PostController::class, 'index'])
    ->middleware('throttle:60,1');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin,moderator');
```

---

## 🎛️ Middleware في Controller

```php
class PostController extends Controller
{
    public function __construct()
    {
        // كل الدوال
        $this->middleware('auth');

        // دوال محددة
        $this->middleware('admin')->only(['create', 'store', 'destroy']);

        // باستثناء دوال
        $this->middleware('verified')->except(['index', 'show']);

        // مع معاملات
        $this->middleware('role:editor')->only('edit');
    }
}
```

---

## 📦 Middleware مع معاملات

### التعريف
```php
public function handle(Request $request, Closure $next, string $role)
{
    if (auth()->user()->role !== $role) {
        abort(403);
    }

    return $next($request);
}
```

### معاملات متعددة
```php
public function handle(Request $request, Closure $next, string ...$roles)
{
    if (!in_array(auth()->user()->role, $roles)) {
        abort(403);
    }

    return $next($request);
}
```

### الاستخدام
```php
Route::get('/admin', function () {
    //
})->middleware('role:admin');

Route::get('/moderate', function () {
    //
})->middleware('role:admin,moderator,editor');
```

---

## ⏱️ Before Middleware

```php
public function handle(Request $request, Closure $next)
{
    // تعمل قبل وصول الطلب إلى Controller
    if ($request->age < 18) {
        return redirect('home');
    }

    return $next($request);
}
```

---

## ⏲️ After Middleware

```php
public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // تعمل بعد معالجة Controller للطلب
    Log::info('الاستجابة: ' . $response->status());

    return $response;
}
```

---

## 🔚 Terminable Middleware

```php
public function handle(Request $request, Closure $next)
{
    return $next($request);
}

public function terminate(Request $request, $response): void
{
    // تعمل بعد إرسال الاستجابة إلى المتصفح
    Analytics::track($request->path());
}
```

---

## 🔐 Middleware المدمجة

| Middleware | الغرض |
|------------|--------|
| `auth` | يتطلب توثيق |
| `auth:sanctum` | توثيق API |
| `guest` | ضيوف فقط (غير مصادق) |
| `verified` | يتطلب تحقق البريد |
| `throttle:60,1` | تحديد المعدل (60 طلب/دقيقة) |
| `signed` | التحقق من URL موقع |
| `can:update,post` | فحص التفويض |

---

## 🎯 أنماط شائعة

### فحص التوثيق
```php
if (!auth()->check()) {
    return redirect('login');
}
```

### فحص الدور
```php
if (auth()->user()->role !== 'admin') {
    abort(403);
}
```

### التحقق من مفتاح API
```php
$apiKey = $request->header('X-API-Key');

if (!$apiKey || !$this->isValid($apiKey)) {
    return response()->json(['error' => 'غير مصرح'], 401);
}
```

### تحديد المعدل
```php
$key = 'rate:' . $request->ip();
$attempts = Cache::get($key, 0);

if ($attempts >= 60) {
    return response()->json(['error' => 'طلبات كثيرة جداً'], 429);
}

Cache::put($key, $attempts + 1, 60);
```

### تسجيل الطلبات
```php
Log::info('طلب', [
    'method' => $request->method(),
    'url' => $request->fullUrl(),
    'ip' => $request->ip(),
]);
```

### تعديل الطلب
```php
$request->merge(['timestamp' => time()]);
```

### إضافة Headers للاستجابة
```php
$response->headers->set('X-Custom-Header', 'value');
```

---

## 🧪 اختبار Middleware

```php
public function test_middleware_blocks_guests()
{
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
}

public function test_middleware_allows_authenticated_users()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertOk();
}

public function test_middleware_checks_role()
{
    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->get('/admin');
    $response->assertStatus(403);
}

public function test_api_middleware_validates_key()
{
    $response = $this->withHeaders([
        'X-API-Key' => 'valid-key',
    ])->getJson('/api/users');

    $response->assertOk();
}
```

---

## ⚠️ أخطاء شائعة

### نسيان return
```php
// ❌ خطأ
public function handle(Request $request, Closure $next)
{
    $next($request); // نسيان return!
}

// ✅ صحيح
public function handle(Request $request, Closure $next)
{
    return $next($request);
}
```

### ترتيب خاطئ
```php
// ❌ خطأ - يفحص الدور قبل التوثيق
Route::middleware(['role:admin', 'auth'])->group(...);

// ✅ صحيح
Route::middleware(['auth', 'role:admin'])->group(...);
```

### غير مسجلة
```php
// ❌ Middleware موجودة لكن غير مسجلة
Route::get('/')->middleware('custom'); // لن تعمل!

// ✅ التسجيل أولاً في bootstrap/app.php
$middleware->alias(['custom' => CustomMiddleware::class]);
```

---

## 📊 تدفق Middleware

```
الطلب
  ↓
Middleware عامة
  ↓
Middleware المسارات (بالترتيب)
  ↓
Controller
  ↓
الاستجابة (عبر مكدس Middleware)
  ↓
المتصفح
  ↓
Terminable Middleware
```

---

## 🎨 أكواد مفيدة

### قائمة IP البيضاء
```php
$allowed = ['127.0.0.1', '192.168.1.*'];
if (!$this->ipMatches($request->ip(), $allowed)) {
    abort(403);
}
```

### وضع الصيانة
```php
if (config('app.maintenance') && !$request->ip() === '127.0.0.1') {
    return response()->view('maintenance', [], 503);
}
```

### إجبار HTTPS
```php
if (!$request->secure() && app()->environment('production')) {
    return redirect()->secure($request->getRequestUri());
}
```

### تعيين اللغة
```php
if ($request->has('lang')) {
    App::setLocale($request->lang);
    Session::put('locale', $request->lang);
}
```

### تنظيف المدخلات
```php
$input = $request->all();
array_walk_recursive($input, function (&$value) {
    $value = strip_tags(trim($value));
});
$request->merge($input);
```

---

## 🔗 روابط سريعة

- [توثيق Middleware](https://laravel.com/docs/11.x/middleware)
- [توثيق الاختبارات](https://laravel.com/docs/11.x/http-tests)
- [توثيق Request](https://laravel.com/docs/11.x/requests)
- [توثيق Response](https://laravel.com/docs/11.x/responses)

---

**اطبع هذا للمرجع السريع! 📄**
