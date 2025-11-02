# الدرس 10: Middleware (الوسيطة)

## 📖 جدول المحتويات
1. [مقدمة عن Middleware](#مقدمة-عن-middleware)
2. [كيف تعمل Middleware](#كيف-تعمل-middleware)
3. [Middleware المدمجة](#middleware-المدمجة)
4. [إنشاء Middleware مخصصة](#إنشاء-middleware-مخصصة)
5. [تسجيل Middleware](#تسجيل-middleware)
6. [معاملات Middleware](#معاملات-middleware)
7. [Terminable Middleware](#terminable-middleware)
8. [مجموعات Middleware](#مجموعات-middleware)
9. [أولوية Middleware](#أولوية-middleware)
10. [أمثلة عملية](#أمثلة-عملية)

---

## مقدمة عن Middleware

### ما هي Middleware؟

**Middleware** = مرشحات (Filters) لطلبات HTTP تعمل قبل أو بعد معالجة تطبيقك للطلب.

فكر في Middleware كطبقات تغلف تطبيقك:

```
الطلب → Middleware 1 → Middleware 2 → Controller → الاستجابة
          ↓                ↓                          ↑
    [فحص التوثيق]    [تسجيل الطلب]        [إضافة Headers]
```

### حالات الاستخدام الشائعة:

- **Authentication**: التحقق من تسجيل دخول المستخدم
- **Authorization**: التحقق من صلاحيات المستخدم
- **Logging**: تسجيل معلومات الطلب
- **CORS**: التعامل مع الطلبات عبر النطاقات
- **Rate Limiting**: منع إساءة الاستخدام
- **Maintenance Mode**: منع الطلبات أثناء الصيانة
- **Data Transformation**: تعديل بيانات الطلب/الاستجابة

### تدفق Middleware:

```
┌─────────────┐
│  المتصفح    │
└──────┬──────┘
       │ الطلب
       ↓
┌─────────────────────┐
│  مكدس Middleware    │
│  ├─ VerifyCsrfToken │
│  ├─ Authenticate    │
│  └─ CheckRole       │
└──────┬──────────────┘
       │
       ↓
┌─────────────┐
│  Controller │
└──────┬──────┘
       │ الاستجابة
       ↓
┌─────────────┐
│  المتصفح    │
└─────────────┘
```

---

## كيف تعمل Middleware

### Before Middleware

تعمل **قبل** وصول الطلب إلى Controller:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        // الكود يعمل قبل وصول الطلب إلى Controller
        if ($request->age < 18) {
            return redirect('home');
        }

        return $next($request);
    }
}
```

### After Middleware

تعمل **بعد** معالجة Controller للطلب:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // الكود يعمل بعد توليد Controller للاستجابة
        Log::info('تم إرسال الاستجابة', [
            'status' => $response->status(),
            'content_length' => strlen($response->content()),
        ]);

        return $response;
    }
}
```

### Before و After معاً:

```php
public function handle(Request $request, Closure $next)
{
    // قبل Controller
    Log::info('بدأ الطلب');

    $response = $next($request);

    // بعد Controller
    Log::info('اكتمل الطلب');

    return $response;
}
```

---

## Middleware المدمجة

Laravel يأتي مع عدة Middleware مدمجة:

### Middleware المدمجة الشائعة:

| Middleware | الغرض |
|------------|--------|
| `auth` | التأكد من توثيق المستخدم |
| `auth.basic` | توثيق HTTP الأساسي |
| `guest` | التأكد من أن المستخدم غير مسجل دخول |
| `verified` | التأكد من تحقق البريد الإلكتروني |
| `throttle` | تحديد معدل الطلبات |
| `signed` | التحقق من الروابط الموقعة |
| `can` | التحقق من الصلاحيات عبر Gates/Policies |

### استخدام Middleware المدمجة:

```php
use App\Http\Controllers\ProfileController;

// Middleware واحدة
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth');

// عدة Middleware
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']);

// مجموعة Middleware
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

// Middleware مع معاملات
Route::post('/comment', [CommentController::class, 'store'])
    ->middleware('throttle:5,1'); // 5 طلبات في الدقيقة
```

---

## إنشاء Middleware مخصصة

### إنشاء Middleware:

```bash
php artisan make:middleware CheckRole
```

هذا ينشئ: `app/Http/Middleware/CheckRole.php`

### مثال 1: فحص بسيط

**app/Http/Middleware/CheckAge.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * معالجة الطلب الوارد.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->age < 18) {
            return redirect('home')->with('error', 'يجب أن يكون عمرك 18 عاماً أو أكثر');
        }

        return $next($request);
    }
}
```

### مثال 2: فحص التوثيق

**app/Http/Middleware/CheckAdmin.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if (auth()->user()->role !== 'admin') {
            abort(403, 'إجراء غير مصرح به');
        }

        return $next($request);
    }
}
```

### مثال 3: فحص رمز API

**app/Http/Middleware/CheckApiToken.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-Token');

        if (!$token || $token !== config('app.api_token')) {
            return response()->json([
                'error' => 'رمز API غير صالح'
            ], 401);
        }

        return $next($request);
    }
}
```

### مثال 4: تسجيل الطلبات

**app/Http/Middleware/LogRequests.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        // تسجيل قبل الطلب
        Log::info('بدأ الطلب', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_id' => auth()->id(),
        ]);

        $response = $next($request);

        // تسجيل بعد الطلب
        Log::info('اكتمل الطلب', [
            'status' => $response->status(),
        ]);

        return $response;
    }
}
```

---

## تسجيل Middleware

### الموقع: bootstrap/app.php (Laravel 11)

في Laravel 11، يتم تسجيل Middleware في `bootstrap/app.php`:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // تسجيل اسم مستعار للـ Middleware
        $middleware->alias([
            'check.age' => CheckAge::class,
            'admin' => CheckAdmin::class,
        ]);

        // Middleware عامة (تعمل على كل طلب)
        $middleware->append(LogRequests::class);

        // أولوية Middleware
        $middleware->priority([
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

### Middleware للمسارات:

```php
// مسار واحد
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('admin');

// عدة مسارات
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/users', [AdminController::class, 'users']);
});
```

### Middleware في Controller:

```php
class AdminController extends Controller
{
    public function __construct()
    {
        // تطبيق على كل الدوال
        $this->middleware('admin');

        // تطبيق على دوال محددة
        $this->middleware('auth')->only(['create', 'store']);
        $this->middleware('verified')->except(['index', 'show']);
    }
}
```

---

## معاملات Middleware

### تعريف المعاملات:

**app/Http/Middleware/CheckRole.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if (auth()->user()->role !== $role) {
            abort(403, "الوصول مرفوض. الدور المطلوب: {$role}");
        }

        return $next($request);
    }
}
```

### معاملات متعددة:

```php
public function handle(Request $request, Closure $next, string $role, string $permission)
{
    if (auth()->user()->role !== $role || !auth()->user()->hasPermission($permission)) {
        abort(403);
    }

    return $next($request);
}
```

### استخدام المعاملات في المسارات:

```php
// معامل واحد
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin');

// معاملات متعددة
Route::get('/editor', [EditorController::class, 'index'])
    ->middleware('role:editor,edit-posts');

// عدة Middleware مع معاملات
Route::middleware(['auth', 'role:admin', 'verified'])
    ->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    });
```

### معاملات ديناميكية:

```php
// Throttle: 60 طلب في الدقيقة
Route::middleware('throttle:60,1')->group(function () {
    Route::post('/api/data', [ApiController::class, 'store']);
});

// Throttle: 10 طلبات للضيوف، 60 للمصادقين
Route::middleware('throttle:10|60,1')->group(function () {
    Route::get('/api/posts', [ApiController::class, 'index']);
});
```

---

## Terminable Middleware

### ما هي Terminable Middleware؟

Middleware التي تنفذ عمل **بعد** إرسال الاستجابة إلى المتصفح.

**app/Http/Middleware/TerminableMiddleware.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TerminableMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * تعمل بعد إرسال الاستجابة إلى المتصفح
     */
    public function terminate(Request $request, $response): void
    {
        // مهمة ثقيلة لا تحتاج لتأخير الاستجابة
        Log::info('معالجة التحليلات...');

        // إرسال بيانات التحليلات
        Analytics::track($request->user(), [
            'page' => $request->path(),
            'duration' => microtime(true) - LARAVEL_START,
        ]);

        // تنظيف الملفات المؤقتة
        Storage::deleteDirectory('temp/' . session()->getId());
    }
}
```

### حالات الاستخدام:

- **تتبع التحليلات**
- **إرسال البريد الإلكتروني/الإشعارات**
- **تسخين ذاكرة التخزين المؤقت**
- **مهام التنظيف**
- **تسجيل البيانات المعقدة**

---

## مجموعات Middleware

### مجموعات Middleware الافتراضية:

Laravel يعرف مجموعتين افتراضيتين في `bootstrap/app.php`:

```php
$middleware->group('web', [
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
]);

$middleware->group('api', [
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
]);
```

### مجموعات Middleware مخصصة:

```php
// في bootstrap/app.php
$middleware->group('admin', [
    'auth',
    'verified',
    \App\Http\Middleware\CheckAdmin::class,
    \App\Http\Middleware\LogAdminActivity::class,
]);

// الاستخدام
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/users', [UserController::class, 'index']);
});
```

### الإضافة إلى المجموعات:

```php
// إضافة إلى بداية مجموعة web
$middleware->prependToGroup('web', \App\Http\Middleware\CheckMaintenance::class);

// إضافة إلى نهاية مجموعة api
$middleware->appendToGroup('api', \App\Http\Middleware\LogApiRequests::class);
```

---

## أولوية Middleware

### تحديد الأولوية:

أحياناً الترتيب مهم. حدد الأولوية في `bootstrap/app.php`:

```php
$middleware->priority([
    \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class,
    \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
    \Illuminate\Contracts\Session\Middleware\AuthenticatesSessions::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \Illuminate\Auth\Middleware\Authorize::class,
]);
```

هذا يضمن تشغيل Middleware بالترتيب الصحيح بغض النظر عن كيفية تعيينها للمسارات.

---

## أمثلة عملية

### مثال 1: Middleware وضع الصيانة

**app/Http/Middleware/CheckMaintenance.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenance
{
    protected $allowedIps = [
        '127.0.0.1',
        '192.168.1.100', // IP المكتب
    ];

    public function handle(Request $request, Closure $next)
    {
        if (config('app.maintenance_mode') === true) {
            // السماح لـ IPs محددة
            if (in_array($request->ip(), $this->allowedIps)) {
                return $next($request);
            }

            // السماح لمستخدمي الإدارة
            if (auth()->check() && auth()->user()->isAdmin()) {
                return $next($request);
            }

            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
```

### مثال 2: إجبار HTTPS

**app/Http/Middleware/ForceHttps.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
```

### مثال 3: Middleware اللغة

**app/Http/Middleware/SetLocale.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    protected $languages = ['en', 'ar', 'fr'];

    public function handle(Request $request, Closure $next)
    {
        // فحص معامل URL
        if ($request->has('lang') && in_array($request->lang, $this->languages)) {
            Session::put('locale', $request->lang);
        }

        // تعيين اللغة من الجلسة أو الافتراضية
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);

        return $next($request);
    }
}
```

### مثال 4: تنظيف المدخلات

**app/Http/Middleware/SanitizeInput.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeInput
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                // إزالة محاولات XSS
                $value = strip_tags($value);
                // إزالة المسافات الزائدة
                $value = trim($value);
            }
        });

        $request->merge($input);

        return $next($request);
    }
}
```

### مثال 5: الوصول المبني على أدوار متعددة

**app/Http/Middleware/CheckRoles.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoles
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'ليس لديك صلاحية للوصول إلى هذا المورد');
    }
}
```

**الاستخدام:**
```php
// السماح لـ admin أو moderator
Route::middleware('roles:admin,moderator')->group(function () {
    Route::get('/moderate', [ModerateController::class, 'index']);
});
```

### مثال 6: التحقق من توقيع الطلب

**app/Http/Middleware/ValidateSignature.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ValidateSignature
{
    public function handle(Request $request, Closure $next)
    {
        $signature = $request->header('X-Signature');
        $timestamp = $request->header('X-Timestamp');

        // فحص الطابع الزمني (منع هجمات إعادة التشغيل)
        if (!$timestamp || abs(time() - $timestamp) > 300) {
            return response()->json(['error' => 'انتهت صلاحية الطلب'], 401);
        }

        // التحقق من التوقيع
        $payload = $request->getContent();
        $expectedSignature = hash_hmac('sha256', $timestamp . $payload, config('app.api_secret'));

        if (!hash_equals($expectedSignature, $signature)) {
            return response()->json(['error' => 'توقيع غير صالح'], 401);
        }

        return $next($request);
    }
}
```

### مثال 7: قائمة IP البيضاء/السوداء

**app/Http/Middleware/RestrictIp.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictIp
{
    protected $whitelist = [
        '127.0.0.1',
        '192.168.1.*',
    ];

    protected $blacklist = [
        '10.0.0.1',
    ];

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        // فحص القائمة السوداء
        if ($this->isBlacklisted($ip)) {
            abort(403, 'عنوان IP الخاص بك محظور');
        }

        // فحص القائمة البيضاء (إذا لم تكن فارغة)
        if (!empty($this->whitelist) && !$this->isWhitelisted($ip)) {
            abort(403, 'عنوان IP الخاص بك غير مسموح');
        }

        return $next($request);
    }

    protected function isWhitelisted($ip)
    {
        foreach ($this->whitelist as $allowed) {
            if ($this->matchesPattern($ip, $allowed)) {
                return true;
            }
        }
        return false;
    }

    protected function isBlacklisted($ip)
    {
        foreach ($this->blacklist as $blocked) {
            if ($this->matchesPattern($ip, $blocked)) {
                return true;
            }
        }
        return false;
    }

    protected function matchesPattern($ip, $pattern)
    {
        $pattern = str_replace('*', '.*', $pattern);
        return preg_match('/^' . $pattern . '$/', $ip);
    }
}
```

### مثال 8: تخزين الاستجابة مؤقتاً

**app/Http/Middleware/CacheResponse.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    public function handle(Request $request, Closure $next, int $minutes = 60)
    {
        // تخزين طلبات GET فقط
        if ($request->method() !== 'GET') {
            return $next($request);
        }

        $key = 'response_' . md5($request->fullUrl());

        // إرجاع الاستجابة المخزنة إذا كانت موجودة
        if (Cache::has($key)) {
            return response(Cache::get($key));
        }

        $response = $next($request);

        // تخزين الاستجابة
        Cache::put($key, $response->getContent(), now()->addMinutes($minutes));

        return $response;
    }
}
```

**الاستخدام:**
```php
Route::get('/posts', [PostController::class, 'index'])
    ->middleware('cache:30'); // تخزين لمدة 30 دقيقة
```

---

## أفضل الممارسات

### 1. اجعل Middleware مركزة

```php
// جيد - مسؤولية واحدة
class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->age < 18) {
            return redirect('home');
        }
        return $next($request);
    }
}

// سيء - مسؤوليات كثيرة
class CheckEverything
{
    public function handle(Request $request, Closure $next)
    {
        // فحص العمر، التوثيق، الصلاحيات، IP، إلخ.
        // الكثير في Middleware واحدة
    }
}
```

### 2. استخدم Early Returns

```php
// جيد
public function handle(Request $request, Closure $next)
{
    if (!auth()->check()) {
        return redirect('login');
    }

    if (!auth()->user()->isActive()) {
        return redirect('inactive');
    }

    return $next($request);
}
```

### 3. كن حذراً مع Middleware العامة

```php
// استخدم بحذر - تعمل على كل طلب
$middleware->append(SomeMiddleware::class);

// أفضل - استخدم middleware المسارات عند الإمكان
Route::middleware('some')->group(function () {
    // تطبق فقط على هذه المسارات
});
```

### 4. تعامل مع الاستثناءات بشكل صحيح

```php
public function handle(Request $request, Closure $next)
{
    try {
        // منطق Middleware
        return $next($request);
    } catch (\Exception $e) {
        Log::error('خطأ في Middleware: ' . $e->getMessage());
        return response('الخدمة غير متاحة', 503);
    }
}
```

### 5. اختبر Middleware الخاصة بك

```php
// tests/Feature/CheckAgeMiddlewareTest.php
public function test_blocks_users_under_18()
{
    $response = $this->get('/restricted?age=16');
    $response->assertRedirect('home');
}

public function test_allows_users_over_18()
{
    $response = $this->get('/restricted?age=21');
    $response->assertOk();
}
```

### 6. استخدم مجموعات Middleware للأنماط الشائعة

```php
// تعريف مرة واحدة
$middleware->group('api-admin', [
    'auth:sanctum',
    'role:admin',
    'throttle:60,1',
]);

// استخدام في كل مكان
Route::middleware('api-admin')->group(function () {
    // مسارات API للإدارة
});
```

### 7. وثّق Middleware الخاصة بك

```php
/**
 * التحقق من أن المستخدم قد تحقق من بريده الإلكتروني ورقم هاتفه.
 *
 * يجب تطبيق هذه Middleware على المسارات التي تتطلب
 * التحقق الكامل من الحساب (مثل معالجة الدفع).
 *
 * @param Request $request
 * @param Closure $next
 * @return mixed
 */
public function handle(Request $request, Closure $next)
{
    // ...
}
```

---

## الأخطاء الشائعة

### 1. نسيان إرجاع $next($request)

```php
// خطأ - لا يوجد return
public function handle(Request $request, Closure $next)
{
    if (auth()->check()) {
        $next($request); // نسيان return!
    }
}

// صحيح
public function handle(Request $request, Closure $next)
{
    if (auth()->check()) {
        return $next($request);
    }
    return redirect('login');
}
```

### 2. عدم تسجيل Middleware

```php
// تم إنشاء Middleware لكن نسيت التسجيل في bootstrap/app.php
// لن تعمل حتى يتم التسجيل!

$middleware->alias([
    'custom' => \App\Http\Middleware\CustomMiddleware::class,
]);
```

### 3. ترتيب Middleware خاطئ

```php
// خطأ - فحص التوثيق يحدث بعد فحص الدور
Route::middleware(['role:admin', 'auth'])->group(function () {
    // سيعطي خطأ إذا لم يكن المستخدم مصادق عليه
});

// صحيح
Route::middleware(['auth', 'role:admin'])->group(function () {
    // التوثيق أولاً، ثم فحص الدور
});
```

### 4. تعديل الطلب بشكل خاطئ

```php
// خطأ - لا يستمر
public function handle(Request $request, Closure $next)
{
    $request->user_role = 'admin'; // يضيع بعد Middleware
    return $next($request);
}

// صحيح
public function handle(Request $request, Closure $next)
{
    $request->merge(['user_role' => 'admin']);
    return $next($request);
}
```

---

## مثال كامل: نظام توثيق API

### Middleware: app/Http/Middleware/ApiAuthenticate.php

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'error' => 'مفتاح API مطلوب'
            ], 401);
        }

        $key = ApiKey::where('key', $apiKey)
                     ->where('is_active', true)
                     ->first();

        if (!$key) {
            return response()->json([
                'error' => 'مفتاح API غير صالح'
            ], 401);
        }

        // فحص حد المعدل
        if ($key->hasExceededRateLimit()) {
            return response()->json([
                'error' => 'تم تجاوز حد المعدل'
            ], 429);
        }

        // إرفاق مفتاح API بالطلب
        $request->attributes->set('api_key', $key);

        // تسجيل الاستخدام
        $key->incrementUsage();

        return $next($request);
    }
}
```

### التسجيل في bootstrap/app.php:

```php
$middleware->alias([
    'api.auth' => \App\Http\Middleware\ApiAuthenticate::class,
]);
```

### الاستخدام في المسارات:

```php
Route::middleware('api.auth')->group(function () {
    Route::get('/api/users', [ApiController::class, 'users']);
    Route::post('/api/users', [ApiController::class, 'store']);
});
```

---

## الخطوات التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 11**: رفع الملفات والتخزين
- رفع الملفات والتحقق منها
- إعدادات التخزين
- معالجة الصور
- التخزين السحابي (S3)

---

**تعلم سعيد!**
