# الدرس 10: Middleware - دليل الممارسة

## 🎯 أهداف التعلم

بإكمال هذه التمارين، سوف:
- تنشئ وتسجل Middleware مخصصة
- تستخدم معاملات Middleware بفعالية
- تطبق فحوصات التوثيق والتفويض
- تتعامل مع منطق Before و After
- تبني Terminable Middleware
- تنشئ مجموعات Middleware
- تختبر وظائف Middleware

---

## 📋 المتطلبات الأساسية

- إتمام الدرس 9 (التوثيق والتفويض)
- مشروع Laravel 11 جاهز
- فهم أساسي لطلبات/استجابات HTTP
- معرفة بـ PHP classes و namespaces

---

## 🔥 التمرين 1: التحقق من العمر

**الصعوبة:** ⭐ مبتدئ

### المهمة
إنشاء Middleware تتحقق من أن عمر المستخدم 18 عاماً أو أكثر قبل السماح بالوصول إلى صفحات معينة.

### الخطوات

1. **إنشاء Middleware:**
```bash
php artisan make:middleware CheckAge
```

2. **تنفيذ المنطق في `app/Http/Middleware/CheckAge.php`:**
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
        if ($request->age && $request->age < 18) {
            return redirect('home')->with('error', 'يجب أن يكون عمرك 18 عاماً أو أكثر');
        }

        return $next($request);
    }
}
```

3. **التسجيل في `bootstrap/app.php`:**
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'check.age' => \App\Http\Middleware\CheckAge::class,
    ]);
})
```

4. **إنشاء المسارات في `routes/web.php`:**
```php
Route::get('/adults-only', function () {
    return view('adults-only');
})->middleware('check.age');
```

5. **اختبار Middleware:**
```bash
# يجب أن يعيد التوجيه
curl "http://localhost:8000/adults-only?age=16"

# يجب أن يسمح
curl "http://localhost:8000/adults-only?age=21"
```

### ✅ معايير النجاح
- Middleware تمنع المستخدمين تحت 18 عاماً
- Middleware تسمح للمستخدمين 18 عاماً فما فوق
- رسالة خطأ مناسبة تظهر

---

## 🔥 التمرين 2: توثيق مفتاح API

**الصعوبة:** ⭐⭐ متوسط

### المهمة
إنشاء Middleware تتحقق من صحة مفاتيح API لنقاط API المحمية.

### الخطوات

1. **إنشاء Middleware:**
```bash
php artisan make:middleware ValidateApiKey
```

2. **التنفيذ في `app/Http/Middleware/ValidateApiKey.php`:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateApiKey
{
    private $validKeys = [
        'test-key-123' => 'مستخدم تجريبي',
        'prod-key-456' => 'مستخدم الإنتاج',
    ];

    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'error' => 'مفتاح API مطلوب'
            ], 401);
        }

        if (!isset($this->validKeys[$apiKey])) {
            return response()->json([
                'error' => 'مفتاح API غير صالح'
            ], 401);
        }

        // إرفاق معلومات المستخدم بالطلب
        $request->attributes->set('api_user', $this->validKeys[$apiKey]);

        return $next($request);
    }
}
```

3. **تسجيل Middleware:**
```php
$middleware->alias([
    'api.key' => \App\Http\Middleware\ValidateApiKey::class,
]);
```

4. **إنشاء مسارات API:**
```php
// routes/api.php
Route::middleware('api.key')->group(function () {
    Route::get('/users', function (Request $request) {
        return response()->json([
            'message' => 'مرحباً ' . $request->attributes->get('api_user'),
            'users' => ['أحمد', 'فاطمة', 'محمد']
        ]);
    });
});
```

5. **الاختبار:**
```bash
# بدون مفتاح API (يجب أن يفشل)
curl http://localhost:8000/api/users

# مع مفتاح API صالح (يجب أن ينجح)
curl -H "X-API-Key: test-key-123" http://localhost:8000/api/users

# مع مفتاح API غير صالح (يجب أن يفشل)
curl -H "X-API-Key: wrong-key" http://localhost:8000/api/users
```

### ✅ معايير النجاح
- الطلبات بدون مفتاح API تُرجع 401
- مفاتيح API غير الصالحة تُرجع 401
- مفاتيح API الصالحة تسمح بالوصول
- معلومات المستخدم مرفقة بالطلب

---

## 🔥 التمرين 3: تسجيل الطلبات

**الصعوبة:** ⭐⭐ متوسط

### المهمة
إنشاء Middleware تسجل كل طلب HTTP مع التفاصيل قبل وبعد المعالجة.

### الخطوات

1. **إنشاء Middleware:**
```bash
php artisan make:middleware LogRequests
```

2. **التنفيذ:**
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
        // قبل الطلب
        $startTime = microtime(true);

        Log::info('بدأ الطلب', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        $response = $next($request);

        // بعد الطلب
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        Log::info('اكتمل الطلب', [
            'status' => $response->status(),
            'duration_ms' => $duration,
        ]);

        return $response;
    }
}
```

3. **التسجيل كـ Middleware عامة:**
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->append(\App\Http\Middleware\LogRequests::class);
})
```

4. **الاختبار والتحقق من السجلات:**
```bash
# إجراء بعض الطلبات
curl http://localhost:8000/

# التحقق من السجلات
tail -f storage/logs/laravel.log
```

### ✅ معايير النجاح
- جميع الطلبات مسجلة مع التفاصيل
- وقت الاستجابة محسوب ومسجل
- السجلات تظهر بداية ونهاية الطلب

---

## 🔥 التمرين 4: Middleware الأدوار مع المعاملات

**الصعوبة:** ⭐⭐ متوسط

### المهمة
إنشاء Middleware تتحقق من أدوار المستخدمين مع معاملات للسماح بأدوار متعددة.

### الخطوات

1. **إضافة حقل role إلى جدول users:**
```bash
php artisan make:migration add_role_to_users_table
```

```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('user');
    });
}
```

```bash
php artisan migrate
```

2. **إنشاء Middleware:**
```bash
php artisan make:middleware CheckRole
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!auth()->check()) {
            return redirect('login')->with('error', 'الرجاء تسجيل الدخول أولاً');
        }

        $userRole = auth()->user()->role;

        if (!in_array($userRole, $roles)) {
            abort(403, 'غير مصرح. الدور المطلوب: ' . implode(' أو ', $roles));
        }

        return $next($request);
    }
}
```

3. **التسجيل:**
```php
$middleware->alias([
    'role' => \App\Http\Middleware\CheckRole::class,
]);
```

4. **إنشاء مسارات اختبار:**
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'لوحة تحكم المدير';
    });
});

Route::middleware(['auth', 'role:admin,moderator'])->group(function () {
    Route::get('/moderate', function () {
        return 'لوحة الإشراف';
    });
});

Route::middleware(['auth', 'role:user,admin,moderator'])->group(function () {
    Route::get('/dashboard', function () {
        return 'لوحة تحكم المستخدم';
    });
});
```

5. **إنشاء seeder لمستخدمي الاختبار:**
```php
// database/seeders/UserSeeder.php
User::create([
    'name' => 'مستخدم مدير',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

User::create([
    'name' => 'مستخدم عادي',
    'email' => 'user@example.com',
    'password' => Hash::make('password'),
    'role' => 'user',
]);
```

### ✅ معايير النجاح
- المدير يمكنه الوصول إلى مسارات المدير
- المستخدمون بأدوار صحيحة يمكنهم الوصول
- المستخدمون غير المصرح لهم يرون خطأ 403
- الأدوار المتعددة تعمل بشكل صحيح

---

## 🔥 التمرين 5: تحديد معدل الطلبات

**الصعوبة:** ⭐⭐⭐ متقدم

### المهمة
إنشاء Middleware مخصصة لتحديد معدل الطلبات حسب عنوان IP.

### الخطوات

1. **إنشاء Middleware:**
```bash
php artisan make:middleware RateLimitRequests
```

2. **التنفيذ:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateLimitRequests
{
    public function handle(Request $request, Closure $next, int $maxAttempts = 60, int $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        $attempts = Cache::get($key, 0);

        if ($attempts >= $maxAttempts) {
            return response()->json([
                'error' => 'طلبات كثيرة جداً. الرجاء المحاولة لاحقاً.',
                'retry_after' => Cache::get($key . ':timer')
            ], 429);
        }

        Cache::put($key, $attempts + 1, now()->addMinutes($decayMinutes));
        Cache::put($key . ':timer', now()->addMinutes($decayMinutes)->timestamp, now()->addMinutes($decayMinutes));

        $response = $next($request);

        // إضافة headers حد المعدل
        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', max(0, $maxAttempts - $attempts - 1));

        return $response;
    }

    protected function resolveRequestSignature(Request $request): string
    {
        return 'rate_limit:' . $request->ip() . ':' . $request->path();
    }
}
```

3. **التسجيل:**
```php
$middleware->alias([
    'rate.limit' => \App\Http\Middleware\RateLimitRequests::class,
]);
```

4. **التطبيق على المسارات:**
```php
Route::middleware('rate.limit:10,1')->group(function () {
    Route::get('/api/limited', function () {
        return response()->json(['message' => 'نجح']);
    });
});
```

5. **الاختبار بـ script:**
```bash
# Bash script لاختبار تحديد المعدل
for i in {1..15}; do
    echo "الطلب $i"
    curl -i http://localhost:8000/api/limited
    echo ""
done
```

### ✅ معايير النجاح
- أول 10 طلبات تنجح
- الطلب الـ 11 يُرجع 429
- headers حد المعدل موجودة
- العداد يُعاد تعيينه بعد دقيقة واحدة

---

## 🔥 التمرين 6: وضع الصيانة

**الصعوبة:** ⭐⭐ متوسط

### المهمة
إنشاء Middleware تفعّل وضع الصيانة مع قائمة IP بيضاء.

### الخطوات

1. **الإضافة إلى .env:**
```env
MAINTENANCE_MODE=false
MAINTENANCE_ALLOWED_IPS=127.0.0.1,192.168.1.100
```

2. **إنشاء Middleware:**
```bash
php artisan make:middleware CheckMaintenanceMode
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('app.maintenance_mode')) {
            return $next($request);
        }

        // التحقق من IP في القائمة البيضاء
        $allowedIps = explode(',', env('MAINTENANCE_ALLOWED_IPS', ''));

        if (in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }

        // التحقق من المستخدم المدير
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        return response()->view('errors.maintenance', [
            'message' => 'نقوم حالياً بالصيانة. الرجاء العودة لاحقاً.'
        ], 503);
    }
}
```

3. **الإضافة إلى config/app.php:**
```php
'maintenance_mode' => env('MAINTENANCE_MODE', false),
```

4. **إنشاء صفحة الصيانة `resources/views/errors/maintenance.blade.php`:**
```html
<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>وضع الصيانة</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 وضع الصيانة</h1>
        <p>{{ $message }}</p>
    </div>
</body>
</html>
```

5. **التسجيل عالمياً:**
```php
$middleware->append(\App\Http\Middleware\CheckMaintenanceMode::class);
```

### ✅ معايير النجاح
- الموقع يعرض صفحة الصيانة عند التفعيل
- IPs في القائمة البيضاء يمكنها الوصول
- المستخدمون المدراء يمكنهم الوصول
- يُرجع رمز حالة 503

---

## 🔥 التمرين 7: اللغة والترجمة

**الصعوبة:** ⭐⭐ متوسط

### المهمة
إنشاء Middleware تضبط لغة التطبيق بناءً على URL أو الجلسة.

### الخطوات

1. **إنشاء Middleware:**
```bash
php artisan make:middleware SetLocale
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    protected $locales = ['en', 'ar', 'fr', 'es'];

    public function handle(Request $request, Closure $next)
    {
        // التحقق من وجود اللغة في URL
        if ($request->has('lang')) {
            $locale = $request->input('lang');

            if (in_array($locale, $this->locales)) {
                Session::put('locale', $locale);
                App::setLocale($locale);
            }
        }
        // التحقق من الجلسة
        elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        // استخدام الافتراضية
        else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
```

2. **التسجيل:**
```php
$middleware->appendToGroup('web', \App\Http\Middleware\SetLocale::class);
```

3. **إنشاء ملفات اللغة:**
```php
// resources/lang/en/messages.php
return [
    'welcome' => 'Welcome',
    'goodbye' => 'Goodbye',
];

// resources/lang/ar/messages.php
return [
    'welcome' => 'مرحبا',
    'goodbye' => 'وداعا',
];
```

4. **مسار الاختبار:**
```php
Route::get('/welcome', function () {
    return response()->json([
        'locale' => app()->getLocale(),
        'message' => __('messages.welcome'),
    ]);
});
```

5. **الاختبار:**
```bash
curl http://localhost:8000/welcome?lang=en
curl http://localhost:8000/welcome?lang=ar
```

### ✅ معايير النجاح
- اللغة تتغير بناءً على معامل URL
- اللغة تستمر في الجلسة
- الترجمات تعمل بشكل صحيح

---

## 🔥 التمرين 8: Terminable Middleware للتحليلات

**الصعوبة:** ⭐⭐⭐ متقدم

### المهمة
إنشاء Terminable Middleware تتتبع مشاهدات الصفحات بعد إرسال الاستجابة.

### الخطوات

1. **إنشاء جدول التحليلات:**
```bash
php artisan make:migration create_page_views_table
```

```php
public function up()
{
    Schema::create('page_views', function (Blueprint $table) {
        $table->id();
        $table->string('url');
        $table->string('method');
        $table->string('ip');
        $table->string('user_agent')->nullable();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->integer('response_time_ms');
        $table->integer('status_code');
        $table->timestamps();

        $table->index(['url', 'created_at']);
    });
}
```

```bash
php artisan migrate
```

2. **إنشاء Model:**
```bash
php artisan make:model PageView
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'url', 'method', 'ip', 'user_agent', 'user_id',
        'response_time_ms', 'status_code'
    ];
}
```

3. **إنشاء Middleware:**
```bash
php artisan make:middleware TrackPageViews
```

```php
<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;

class TrackPageViews
{
    private $startTime;

    public function handle(Request $request, Closure $next)
    {
        $this->startTime = microtime(true);
        return $next($request);
    }

    public function terminate(Request $request, $response): void
    {
        // حساب وقت الاستجابة
        $duration = round((microtime(true) - $this->startTime) * 1000);

        // تخزين التحليلات (يحدث بعد إرسال الاستجابة)
        PageView::create([
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => auth()->id(),
            'response_time_ms' => $duration,
            'status_code' => $response->status(),
        ]);
    }
}
```

4. **التسجيل:**
```php
$middleware->append(\App\Http\Middleware\TrackPageViews::class);
```

5. **إنشاء مسار لوحة التحكم:**
```php
Route::get('/analytics', function () {
    $views = \App\Models\PageView::latest()
        ->take(10)
        ->get();

    $stats = [
        'total_views' => \App\Models\PageView::count(),
        'avg_response_time' => \App\Models\PageView::avg('response_time_ms'),
        'most_visited' => \App\Models\PageView::select('url', \DB::raw('count(*) as views'))
            ->groupBy('url')
            ->orderBy('views', 'desc')
            ->first(),
    ];

    return response()->json([
        'stats' => $stats,
        'recent_views' => $views,
    ]);
});
```

### ✅ معايير النجاح
- مشاهدات الصفحات تُتتبع دون تبطئة الاستجابة
- التحليلات تُخزن بعد إرسال الاستجابة
- لوحة التحكم تعرض إحصائيات مفيدة

---

## 🎓 التحدي: نظام Middleware متكامل

**الصعوبة:** ⭐⭐⭐⭐ خبير

### المهمة
بناء نظام API متكامل مع:
- توثيق مفتاح API
- تحديد معدل لكل مفتاح API
- تسجيل الطلبات/الاستجابات
- قائمة IP البيضاء
- التعامل مع CORS

### المتطلبات

1. **إنشاء عدة Middleware:**
   - `ApiKeyAuth` - التحقق من مفاتيح API من قاعدة البيانات
   - `ApiRateLimit` - تحديد الطلبات لكل مفتاح API
   - `ApiLogger` - تسجيل جميع طلبات API
   - `IpWhitelist` - تقييد الوصول حسب IP
   - `ApiCors` - التعامل مع headers CORS

2. **هيكل قاعدة البيانات:**
```bash
php artisan make:migration create_api_keys_table
```

```php
Schema::create('api_keys', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();
    $table->string('name');
    $table->boolean('is_active')->default(true);
    $table->integer('rate_limit')->default(60);
    $table->json('allowed_ips')->nullable();
    $table->timestamp('last_used_at')->nullable();
    $table->timestamps();
});

Schema::create('api_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('api_key_id')->constrained();
    $table->string('method');
    $table->text('url');
    $table->text('request_body')->nullable();
    $table->text('response_body')->nullable();
    $table->integer('status_code');
    $table->integer('response_time_ms');
    $table->timestamps();

    $table->index('created_at');
});
```

3. **إنشاء مجموعة Middleware:**
```php
$middleware->group('api.protected', [
    \App\Http\Middleware\ApiCors::class,
    \App\Http\Middleware\IpWhitelist::class,
    \App\Http\Middleware\ApiKeyAuth::class,
    \App\Http\Middleware\ApiRateLimit::class,
    \App\Http\Middleware\ApiLogger::class,
]);
```

4. **التطبيق على مسارات API:**
```php
Route::middleware('api.protected')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
});
```

### ✅ معايير النجاح
- نظام توثيق API كامل
- تحديد المعدل يعمل لكل مفتاح API
- جميع الطلبات مسجلة
- قائمة IP البيضاء مفروضة
- headers CORS مضبوطة بشكل صحيح
- النظام جاهز للإنتاج

---

## 📝 اختبار Middleware

### مثال على اختبار Feature

إنشاء `tests/Feature/MiddlewareTest.php`:

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_age_middleware_blocks_minors()
    {
        $response = $this->get('/adults-only?age=16');
        $response->assertRedirect('/home');
    }

    public function test_check_age_middleware_allows_adults()
    {
        $response = $this->get('/adults-only?age=21');
        $response->assertOk();
    }

    public function test_api_key_middleware_requires_key()
    {
        $response = $this->getJson('/api/users');
        $response->assertStatus(401);
    }

    public function test_api_key_middleware_accepts_valid_key()
    {
        $response = $this->withHeaders([
            'X-API-Key' => 'test-key-123',
        ])->getJson('/api/users');

        $response->assertOk();
    }

    public function test_role_middleware_blocks_unauthorized_users()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_role_middleware_allows_authorized_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertOk();
    }
}
```

تشغيل الاختبارات:
```bash
php artisan test --filter MiddlewareTest
```

---

## 🏆 قائمة الإنجاز

- [ ] أكملت التمرين 1: التحقق من العمر
- [ ] أكملت التمرين 2: توثيق مفتاح API
- [ ] أكملت التمرين 3: تسجيل الطلبات
- [ ] أكملت التمرين 4: Middleware الأدوار
- [ ] أكملت التمرين 5: تحديد المعدل
- [ ] أكملت التمرين 6: وضع الصيانة
- [ ] أكملت التمرين 7: اللغة والترجمة
- [ ] أكملت التمرين 8: Terminable Middleware
- [ ] أكملت التحدي: نظام API متكامل
- [ ] جميع الاختبارات تنجح
- [ ] فهمت دورة حياة Middleware
- [ ] يمكنك تصحيح مشاكل Middleware

---

## 📚 موارد إضافية

- [توثيق Laravel Middleware](https://laravel.com/docs/11.x/middleware)
- [دليل اختبار Middleware](https://laravel.com/docs/11.x/http-tests)
- [أفضل ممارسات Middleware](https://laravel-news.com/laravel-middleware-best-practices)

---

**عمل رائع! لقد أتقنت Laravel Middleware! 🎉**
