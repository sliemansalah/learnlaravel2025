# الدرس 8: Middleware والجلسات (Sessions)
# Lesson 8: Middleware and Sessions

**المستوى:** مبتدئ | Beginner
**المدة المقدرة:** 3-4 ساعات | 3-4 hours
**المتطلبات السابقة:** إتمام الدروس 1-7 | Completion of Lessons 1-7

---

## 📑 جدول المحتويات | Table of Contents

1. [ما هو Middleware؟](#ما-هو-middleware)
2. [أنواع Middleware](#أنواع-middleware)
3. [إنشاء Middleware](#إنشاء-middleware)
4. [تسجيل Middleware](#تسجيل-middleware)
5. [معاملات Middleware](#معاملات-middleware)
6. [ما هي Sessions؟](#ما-هي-sessions)
7. [التعامل مع Sessions](#التعامل-مع-sessions)
8. [Flash Messages](#flash-messages)
9. [إعدادات Sessions](#إعدادات-sessions)
10. [أفضل الممارسات](#أفضل-الممارسات)

---

## 🎯 أهداف الدرس | Lesson Objectives

بنهاية هذا الدرس، ستكون قادراً على:

- ✅ فهم مفهوم Middleware ودوره في Laravel
- ✅ إنشاء Middleware مخصص
- ✅ تطبيق Middleware على Routes و Controllers
- ✅ فهم أنواع Middleware المختلفة
- ✅ التعامل مع Sessions في Laravel
- ✅ استخدام Flash Messages بفعالية
- ✅ تأمين التطبيق باستخدام Middleware

By the end of this lesson, you will be able to:

- ✅ Understand Middleware concept and its role in Laravel
- ✅ Create custom Middleware
- ✅ Apply Middleware to Routes and Controllers
- ✅ Understand different Middleware types
- ✅ Work with Sessions in Laravel
- ✅ Use Flash Messages effectively
- ✅ Secure applications using Middleware

---

## 🛡️ ما هو Middleware؟

### التعريف | Definition

**Middleware** هو طبقة وسيطة تعمل كـ "فلتر" أو "حارس بوابة" بين الطلب (Request) والاستجابة (Response). يمكنك استخدامه للتحقق من الطلبات قبل وصولها للـ Controller أو تعديل الاستجابة قبل إرسالها للمستخدم.

**Middleware** is an intermediary layer that acts as a "filter" or "gatekeeper" between the Request and Response. You can use it to inspect requests before they reach the Controller or modify responses before sending them to the user.

### مثال من الحياة الواقعية | Real-Life Example

```
تخيل مطعماً:
🚪 الباب الخارجي → Middleware
👨‍💼 الموظف يفحص:
   - هل الزبون لديه حجز؟ (Authentication)
   - هل يرتدي ملابس مناسبة؟ (Authorization)
   - هل وصل في الوقت المحدد؟ (Validation)

إذا نجح في جميع الفحوصات → يدخل للطاولة (Controller)
إذا فشل → يُرفض الدخول (Redirect/Error)

Imagine a restaurant:
🚪 Front Door → Middleware
👨‍💼 Staff checks:
   - Does the customer have a reservation? (Authentication)
   - Is the dress code appropriate? (Authorization)
   - Did they arrive on time? (Validation)

If all checks pass → enters to table (Controller)
If fails → entry denied (Redirect/Error)
```

### دور Middleware في Laravel

```php
// بدون Middleware
Route::get('/admin', function() {
    // يمكن لأي شخص الوصول!
    return view('admin.dashboard');
});

// مع Middleware
Route::get('/admin', function() {
    return view('admin.dashboard');
})->middleware('auth', 'admin');
// الآن فقط المستخدمين المسجلين والمدراء يمكنهم الوصول
```

### كيف يعمل Middleware؟

```
الطلب (Request)
     ↓
     ↓ يمر عبر Middleware 1
     ↓ (مثلاً: التحقق من تسجيل الدخول)
     ↓
     ↓ يمر عبر Middleware 2
     ↓ (مثلاً: التحقق من الصلاحيات)
     ↓
     ↓ يمر عبر Middleware 3
     ↓ (مثلاً: تسجيل النشاط)
     ↓
Controller (إذا نجحت جميع الفحوصات)
     ↓
Response
     ↓
     ↓ يمر عبر Middleware مرة أخرى (في الاتجاه المعاكس)
     ↓
المستخدم
```

---

## 📦 أنواع Middleware

### 1. Global Middleware (عام)

يعمل على **جميع** الطلبات في التطبيق.

```php
// bootstrap/app.php (Laravel 11)
->withMiddleware(function (Middleware $middleware) {
    $middleware->append(\App\Http\Middleware\LogRequests::class);
})
```

**أمثلة استخدام:**
- ✅ تسجيل جميع الطلبات (Logging)
- ✅ تفعيل CORS
- ✅ ضغط الاستجابات (Compression)

### 2. Route Middleware (للمسارات)

يعمل على مسارات محددة فقط.

```php
// routes/web.php
Route::get('/profile', function() {
    return view('profile');
})->middleware('auth');

// أو لمجموعة من المسارات
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/settings', [SettingsController::class, 'index']);
});
```

**أمثلة استخدام:**
- ✅ التحقق من تسجيل الدخول
- ✅ التحقق من الصلاحيات
- ✅ التحقق من تفعيل البريد الإلكتروني

### 3. Controller Middleware (للـ Controllers)

يُطبق داخل الـ Controller نفسه.

```php
class AdminController extends Controller
{
    public function __construct()
    {
        // يُطبق على جميع methods
        $this->middleware('auth');

        // يُطبق على methods محددة فقط
        $this->middleware('admin')->only(['destroy', 'edit']);

        // يُطبق على جميع methods ما عدا...
        $this->middleware('log')->except(['show']);
    }
}
```

**أمثلة استخدام:**
- ✅ حماية مجموعة من الإجراءات
- ✅ تطبيق قواعد مختلفة لكل method

---

## 🔨 إنشاء Middleware

### الطريقة الأولى: Artisan Command

```bash
# إنشاء Middleware جديد
php artisan make:middleware CheckAge

# إنشاء Middleware في مجلد فرعي
php artisan make:middleware Admin/CheckRole
```

هذا سينشئ ملف في:
```
app/Http/Middleware/CheckAge.php
```

### بنية Middleware الأساسية

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // الكود هنا يُنفذ قبل وصول الطلب للـ Controller

        // نمرر الطلب للطبقة التالية
        $response = $next($request);

        // الكود هنا يُنفذ بعد معالجة الطلب

        return $response;
    }
}
```

### مثال عملي: التحقق من العمر

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من وجود معامل age في الطلب
        if ($request->age && $request->age < 18) {
            return redirect('home')->with('error', 'يجب أن يكون عمرك 18 سنة على الأقل');
        }

        return $next($request);
    }
}
```

### مثال: تسجيل وقت الطلب

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestTime
{
    public function handle(Request $request, Closure $next): Response
    {
        // تسجيل وقت بداية الطلب
        $startTime = microtime(true);

        // معالجة الطلب
        $response = $next($request);

        // حساب الوقت المستغرق
        $endTime = microtime(true);
        $duration = round(($endTime - $startTime) * 1000, 2);

        // تسجيل المعلومات
        Log::info("Request to {$request->path()} took {$duration}ms");

        return $response;
    }
}
```

### مثال: إضافة Headers

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCustomHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // إضافة headers للاستجابة
        $response->headers->set('X-Custom-Header', 'Laravel App');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        return $response;
    }
}
```

---

## 📝 تسجيل Middleware

### في Laravel 11

يتم التسجيل في ملف `bootstrap/app.php`:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        // Global Middleware
        $middleware->append(\App\Http\Middleware\LogRequests::class);

        // Route Middleware (aliases)
        $middleware->alias([
            'check.age' => \App\Http\Middleware\CheckAge::class,
            'admin' => \App\Http\Middleware\CheckAdmin::class,
            'log.time' => \App\Http\Middleware\LogRequestTime::class,
        ]);

        // Middleware Groups
        $middleware->group('admin', [
            'auth',
            'admin',
            'log.time',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

### استخدام Middleware في Routes

```php
// استخدام Middleware واحد
Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth');

// استخدام عدة Middlewares
Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth', 'admin', 'log.time']);

// استخدام Middleware Group
Route::middleware('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/settings', [AdminController::class, 'settings']);
});

// استخدام Middleware inline (بدون تسجيل)
Route::get('/test', function() {
    return 'Test';
})->middleware(\App\Http\Middleware\CheckAge::class);
```

---

## 🎛️ معاملات Middleware

يمكنك تمرير معاملات (Parameters) للـ Middleware:

### تعريف Middleware بمعاملات

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // التحقق من أن المستخدم لديه الدور المطلوب
        if (!$request->user() || !$request->user()->hasRole($role)) {
            abort(403, 'ليس لديك صلاحية الوصول');
        }

        return $next($request);
    }
}
```

### استخدام Middleware بمعاملات

```php
// تمرير معامل واحد
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin');

// تمرير عدة معاملات
Route::get('/editor', [EditorController::class, 'index'])
    ->middleware('role:editor,moderator');
```

### مثال متقدم: معاملات متعددة

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect('login');
        }

        // التحقق من أن المستخدم لديه أحد الصلاحيات المطلوبة
        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'ليس لديك الصلاحيات المطلوبة');
    }
}
```

```php
// الاستخدام
Route::get('/post/{id}/edit', [PostController::class, 'edit'])
    ->middleware('permission:edit-post,edit-all');
```

---

## 💾 ما هي Sessions؟

### التعريف | Definition

**Session** هي طريقة لتخزين معلومات عن المستخدم عبر طلبات HTTP متعددة. بما أن HTTP هو بروتوكول "عديم الحالة" (Stateless)، نحتاج Sessions لتذكر معلومات المستخدم.

**Session** is a way to store information about the user across multiple HTTP requests. Since HTTP is a stateless protocol, we need Sessions to remember user information.

### لماذا نحتاج Sessions؟

```
❌ بدون Sessions:
الطلب 1: المستخدم يسجل الدخول → Laravel: "أهلاً محمد!"
الطلب 2: المستخدم يزور صفحة أخرى → Laravel: "من أنت؟ 🤔"
(لا يتذكر!)

✅ مع Sessions:
الطلب 1: المستخدم يسجل الدخول → Laravel: "أهلاً محمد!"
         (يحفظ في Session: user_id = 123)
الطلب 2: المستخدم يزور صفحة أخرى → Laravel: "أهلاً محمد!"
         (يقرأ من Session: user_id = 123)
```

### كيف تعمل Sessions؟

```
1. المستخدم يزور الموقع لأول مرة
   ↓
2. Laravel ينشئ Session ID فريد
   مثال: "a1b2c3d4e5f6..."
   ↓
3. يُرسل Session ID للمتصفح عبر Cookie
   ↓
4. المتصفح يحفظ Cookie
   ↓
5. في كل طلب جديد، المتصفح يُرسل Session ID
   ↓
6. Laravel يستخدم Session ID لاسترجاع البيانات المحفوظة
```

### أين تُخزن Sessions؟

Laravel يدعم عدة طرق لتخزين Sessions:

```php
// config/session.php

'driver' => env('SESSION_DRIVER', 'database'),

// الخيارات المتاحة:
'file'     - ملفات على السيرفر (افتراضي)
'cookie'   - مشفرة في Cookies
'database' - في قاعدة البيانات (موصى به)
'memcached'- في Memcached
'redis'    - في Redis (الأفضل للمشاريع الكبيرة)
'array'    - في الذاكرة (للاختبار فقط)
```

---

## 🔧 التعامل مع Sessions

### 1. تخزين البيانات | Storing Data

```php
// الطريقة الأولى: session() helper
session(['key' => 'value']);
session(['user_name' => 'محمد', 'age' => 25]);

// الطريقة الثانية: Request object
$request->session()->put('key', 'value');
$request->session()->put('cart', [
    'product_id' => 123,
    'quantity' => 2
]);

// الطريقة الثالثة: Session facade
use Illuminate\Support\Facades\Session;
Session::put('key', 'value');
```

### 2. استرجاع البيانات | Retrieving Data

```php
// استرجاع قيمة
$value = session('key');
$userName = session('user_name'); // "محمد"

// استرجاع مع قيمة افتراضية
$value = session('key', 'default value');
$country = session('country', 'السعودية');

// استرجاع جميع البيانات
$allData = session()->all();

// التحقق من وجود مفتاح
if (session()->has('user_name')) {
    echo "المستخدم مسجل الدخول";
}

// التحقق من وجود قيمة (ليست null)
if (session()->exists('user_name')) {
    echo "المفتاح موجود";
}
```

### 3. حذف البيانات | Deleting Data

```php
// حذف مفتاح واحد
session()->forget('key');
session()->forget('cart');

// حذف عدة مفاتيح
session()->forget(['key1', 'key2', 'key3']);

// حذف جميع البيانات
session()->flush();

// استرجاع ثم حذف
$value = session()->pull('key');
// يسترجع القيمة ثم يحذفها من Session
```

### 4. Push للـ Arrays

```php
// إضافة عنصر لـ array موجود
session()->push('products', 'product_123');

// مثال كامل:
session(['cart' => []]); // إنشاء cart فارغ
session()->push('cart', ['id' => 1, 'name' => 'Laptop']);
session()->push('cart', ['id' => 2, 'name' => 'Mouse']);

// النتيجة:
// cart = [
//     ['id' => 1, 'name' => 'Laptop'],
//     ['id' => 2, 'name' => 'Mouse']
// ]
```

---

## ⚡ Flash Messages

**Flash Messages** هي بيانات تُخزن في Session لطلب واحد فقط ثم تُحذف تلقائياً.

### متى نستخدم Flash Messages؟

```
✅ رسائل النجاح: "تم حفظ البيانات بنجاح!"
✅ رسائل الخطأ: "حدث خطأ أثناء الحفظ"
✅ رسائل التحذير: "انتبه! البيانات غير مكتملة"
✅ رسائل المعلومات: "تم إرسال رسالة التأكيد"
```

### إنشاء Flash Messages

```php
// في Controller
public function store(Request $request)
{
    $user = User::create($request->all());

    // Redirect مع flash message
    return redirect()->route('users.index')
        ->with('success', 'تم إنشاء المستخدم بنجاح!');
}

// أنواع مختلفة من الرسائل
return redirect()->back()
    ->with('error', 'حدث خطأ!')
    ->with('warning', 'انتبه!')
    ->with('info', 'معلومة مهمة');
```

### عرض Flash Messages في Blade

```blade
{{-- resources/views/layouts/app.blade.php --}}

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
```

### مثال متقدم: Component للرسائل

```blade
{{-- resources/views/components/flash-message.blade.php --}}

@if(session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
    <div class="flash-messages">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>نجح!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>خطأ!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>تحذير!</strong> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>معلومة:</strong> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
@endif
```

```blade
{{-- استخدام Component --}}
<x-flash-message />
```

---

## ⚙️ إعدادات Sessions

### ملف الإعدادات: config/session.php

```php
<?php

return [
    // Driver: طريقة تخزين Sessions
    'driver' => env('SESSION_DRIVER', 'database'),

    // Lifetime: مدة بقاء Session (بالدقائق)
    'lifetime' => env('SESSION_LIFETIME', 120),

    // Expire on Close: انتهاء Session عند إغلاق المتصفح
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    // Cookie Name: اسم Cookie
    'cookie' => env('SESSION_COOKIE', 'laravel_session'),

    // Path: المسار الذي يعمل عليه Cookie
    'path' => env('SESSION_PATH', '/'),

    // Domain: النطاق
    'domain' => env('SESSION_DOMAIN'),

    // Secure: استخدام HTTPS فقط
    'secure' => env('SESSION_SECURE_COOKIE', false),

    // HTTP Only: منع JavaScript من الوصول
    'http_only' => env('SESSION_HTTP_ONLY', true),

    // Same Site: حماية CSRF
    'same_site' => env('SESSION_SAME_SITE', 'lax'),
];
```

### إعداد Database Session Driver

```bash
# 1. تغيير Driver في .env
SESSION_DRIVER=database

# 2. إنشاء جدول sessions
php artisan session:table
php artisan migrate
```

سيُنشئ جدول بالشكل التالي:

```php
Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->foreignId('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});
```

### تنظيف Sessions القديمة

```bash
# تنظيف Sessions المنتهية
php artisan session:gc

# جدولة التنظيف التلقائي (في app/Console/Kernel.php)
protected function schedule(Schedule $schedule)
{
    $schedule->command('session:gc')->daily();
}
```

---

## 🎯 أمثلة عملية متقدمة

### مثال 1: Middleware للغة

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من وجود لغة في Session
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }
        // أو من الـ URL
        elseif ($request->has('lang')) {
            $locale = $request->get('lang');
            if (in_array($locale, ['ar', 'en'])) {
                App::setLocale($locale);
                session(['locale' => $locale]);
            }
        }

        return $next($request);
    }
}
```

### مثال 2: Middleware لتتبع آخر نشاط

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // تحديث آخر نشاط في Session
            session(['last_activity' => now()]);

            // تحديث في قاعدة البيانات (كل 5 دقائق)
            $user = Auth::user();
            if ($user->last_activity_at->diffInMinutes(now()) >= 5) {
                $user->update(['last_activity_at' => now()]);
            }
        }

        return $next($request);
    }
}
```

### مثال 3: نظام سلة التسوق (Shopping Cart)

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // إضافة منتج للسلة
    public function add(Request $request)
    {
        $product = [
            'id' => $request->product_id,
            'name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
        ];

        // الحصول على السلة الحالية أو إنشاء جديدة
        $cart = session()->get('cart', []);

        // التحقق من وجود المنتج مسبقاً
        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity'] += $product['quantity'];
        } else {
            $cart[$product['id']] = $product;
        }

        // حفظ السلة
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'تمت إضافة المنتج للسلة');
    }

    // عرض السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    // حذف منتج من السلة
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

    // تفريغ السلة
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'تم تفريغ السلة');
    }
}
```

---

## 🔒 أفضل الممارسات

### 1. الأمان | Security

```php
// ❌ لا تخزن معلومات حساسة في Session
session(['password' => $password]); // خطأ!

// ✅ خزن معلومات آمنة فقط
session(['user_id' => $user->id]);

// ✅ استخدم التشفير للبيانات الحساسة
session(['encrypted_data' => encrypt($sensitiveData)]);
$data = decrypt(session('encrypted_data'));
```

### 2. الأداء | Performance

```php
// ❌ لا تخزن كميات كبيرة من البيانات
session(['all_products' => Product::all()]); // خطأ!

// ✅ خزن IDs فقط
session(['product_ids' => [1, 2, 3, 4, 5]]);

// ✅ استخدم Cache للبيانات الكبيرة
Cache::put('products', Product::all(), now()->addHour());
```

### 3. التنظيف | Cleanup

```php
// تنظيف Sessions المنتهية يومياً
// في app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('session:gc')->daily();
}
```

### 4. Middleware

```php
// ✅ رتب Middleware بشكل منطقي
Route::middleware(['first', 'second', 'third'])->group(function() {
    // first يُنفذ أولاً
    // second ثانياً
    // third ثالثاً
});

// ✅ استخدم Middleware Groups للكود المتكرر
// في bootstrap/app.php
$middleware->group('admin', [
    'auth',
    'verified',
    'admin',
    'log.activity',
]);

// الاستخدام
Route::middleware('admin')->group(function() {
    // ...
});
```

---

## 📝 ملخص الدرس | Lesson Summary

### النقاط الرئيسية:

1. **Middleware** هو فلتر للطلبات
   - Global Middleware: يعمل على جميع الطلبات
   - Route Middleware: يعمل على مسارات محددة
   - Controller Middleware: يُطبق داخل Controllers

2. **Sessions** تخزن معلومات المستخدم عبر الطلبات
   - session()->put() - للحفظ
   - session()->get() - للاسترجاع
   - session()->forget() - للحذف

3. **Flash Messages** تُستخدم لرسائل لمرة واحدة
   - redirect()->with('success', 'رسالة')
   - session('success') في View

4. **أفضل الممارسات:**
   - لا تخزن بيانات حساسة
   - نظف Sessions القديمة
   - استخدم Database/Redis للمشاريع الكبيرة

---

## 🎯 ماذا بعد؟

في الدرس التالي، سنتعلم:

- ✅ التعامل مع الملفات (File Uploads)
- ✅ التحقق من أنواع الملفات
- ✅ تخزين الملفات
- ✅ عرض الصور

**استعد للدرس العملي! 🚀**

---

## 📚 مصادر إضافية | Additional Resources

### الوثائق الرسمية:
- 📖 [Laravel Middleware](https://laravel.com/docs/11.x/middleware)
- 📖 [Laravel Sessions](https://laravel.com/docs/11.x/session)
- 📖 [HTTP Responses](https://laravel.com/docs/11.x/responses)

### فيديوهات:
- 🎥 [Laracasts - Middleware](https://laracasts.com/series/laravel-from-scratch/middleware)
- 🎥 [Laravel Daily - Sessions](https://www.youtube.com/watch?v=session-video)

---

**📌 ملاحظة:** تأكد من فهم جميع المفاهيم قبل الانتقال للدرس العملي!

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
