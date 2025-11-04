# الدرس 8: الامتحان مع الإجابات - Middleware والجلسات
# Lesson 8: Exam with Answers - Middleware and Sessions

**المستوى:** مبتدئ | Beginner
**المدة:** ساعتان | Duration: 2 hours
**مجموع الدرجات:** 100 نقطة | Total Points: 100

---

## 📋 تعليمات الامتحان | Exam Instructions

- ⏱️ **المدة المخصصة:** ساعتان
- 📝 **يجب الإجابة على جميع الأسئلة**
- 💻 **الأسئلة العملية يجب اختبارها**
- 🚫 **لا تنظر للإجابات قبل المحاولة**
- ✅ **درجة النجاح:** 70/100

---

## القسم الأول: أسئلة الاختيار من متعدد (30 نقطة)

### السؤال 1 (2 نقطة)
**ما هو دور Middleware في Laravel?**

A) تخزين البيانات في قاعدة البيانات
B) فلترة الطلبات قبل وصولها للـ Controller
C) عرض الصفحات للمستخدم
D) إدارة Routes

**✅ الإجابة الصحيحة: B**

**الشرح:**
Middleware هو طبقة وسيطة تعمل كفلتر للطلبات، تسمح بفحص وتعديل الطلبات قبل وصولها للـ Controller أو تعديل الاستجابة قبل إرسالها للمستخدم.

---

### السؤال 2 (2 نقطة)
**أي من التالي يُستخدم لإنشاء Middleware جديد?**

A) `php artisan create:middleware CheckAge`
B) `php artisan make:middleware CheckAge`
C) `php artisan new:middleware CheckAge`
D) `php artisan generate:middleware CheckAge`

**✅ الإجابة الصحيحة: B**

**الشرح:**
الأمر الصحيح هو `php artisan make:middleware CheckAge` وهو يُنشئ Middleware جديد في مجلد `app/Http/Middleware`.

---

### السؤال 3 (2 نقطة)
**أين يتم تسجيل Route Middleware في Laravel 11?**

A) `config/middleware.php`
B) `app/Http/Kernel.php`
C) `bootstrap/app.php`
D) `routes/web.php`

**✅ الإجابة الصحيحة: C**

**الشرح:**
في Laravel 11، يتم تسجيل Middleware في ملف `bootstrap/app.php` داخل دالة `withMiddleware()`.

---

### السؤال 4 (2 نقطة)
**ما هي الطريقة الصحيحة لتمرير معامل لـ Middleware?**

A) `->middleware('role', 'admin')`
B) `->middleware('role:admin')`
C) `->middleware('role' => 'admin')`
D) `->middleware(['role', 'admin'])`

**✅ الإجابة الصحيحة: B**

**الشرح:**
يتم تمرير المعاملات للـ Middleware باستخدام `:` مثل `'role:admin'` أو لعدة معاملات `'role:admin,editor'`.

---

### السؤال 5 (2 نقطة)
**ما الفرق بين Global Middleware و Route Middleware?**

A) لا يوجد فرق
B) Global يعمل على جميع الطلبات، Route على مسارات محددة
C) Global أسرع من Route
D) Route أكثر أماناً من Global

**✅ الإجابة الصحيحة: B**

**الشرح:**
Global Middleware يُطبق على جميع الطلبات في التطبيق، بينما Route Middleware يُطبق فقط على المسارات المحددة.

---

### السؤال 6 (2 نقطة)
**كيف يتم حفظ بيانات في Session?**

A) `session()->save('key', 'value')`
B) `session()->store('key', 'value')`
C) `session()->put('key', 'value')`
D) `session()->set('key', 'value')`

**✅ الإجابة الصحيحة: C**

**الشرح:**
الطريقة الصحيحة هي `session()->put('key', 'value')` أو باستخدام helper: `session(['key' => 'value'])`.

---

### السؤال 7 (2 نقطة)
**ما هو Session Driver الأنسب للمشاريع الكبيرة?**

A) file
B) cookie
C) array
D) redis

**✅ الإجابة الصحيحة: D**

**الشرح:**
Redis هو الأنسب للمشاريع الكبيرة لأنه سريع جداً ويدعم التوسع الأفقي (horizontal scaling).

---

### السؤال 8 (2 نقطة)
**ما هي Flash Messages?**

A) رسائل دائمة في Session
B) رسائل تُحذف بعد قراءتها مرة واحدة
C) رسائل email
D) رسائل في قاعدة البيانات

**✅ الإجابة الصحيحة: B**

**الشرح:**
Flash Messages هي رسائل تُخزن في Session لطلب واحد فقط ثم تُحذف تلقائياً، مثالية لرسائل النجاح والخطأ.

---

### السؤال 9 (2 نقطة)
**كيف يتم إنشاء Flash Message?**

A) `session()->flash('message', 'text')`
B) `redirect()->with('message', 'text')`
C) كلاهما صحيح
D) لا شيء مما سبق

**✅ الإجابة الصحيحة: C**

**الشرح:**
كلا الطريقتين صحيحة: `session()->flash()` أو `redirect()->with()` لإنشاء flash messages.

---

### السؤال 10 (2 نقطة)
**أي method يُستخدم لحذف بيانات من Session?**

A) `session()->delete('key')`
B) `session()->remove('key')`
C) `session()->forget('key')`
D) `session()->unset('key')`

**✅ الإجابة الصحيحة: C**

**الشرح:**
`session()->forget('key')` هو الـ method الصحيح لحذف بيانات من Session.

---

### السؤال 11 (2 نقطة)
**ما الفرق بين `has()` و `exists()` في Sessions?**

A) لا يوجد فرق
B) `has()` تتحقق من القيمة ليست null، `exists()` تتحقق من وجود المفتاح
C) `has()` أسرع من `exists()`
D) `exists()` للـ arrays فقط

**✅ الإجابة الصحيحة: B**

**الشرح:**
`has()` تُرجع true إذا كان المفتاح موجود والقيمة ليست null، بينما `exists()` تُرجع true إذا كان المفتاح موجود حتى لو كانت القيمة null.

---

### السؤال 12 (2 نقطة)
**ما هو `$next($request)` في Middleware?**

A) إيقاف الطلب
B) تمرير الطلب للطبقة التالية
C) إعادة توجيه المستخدم
D) حفظ الطلب في قاعدة البيانات

**✅ الإجابة الصحيحة: B**

**الشرح:**
`$next($request)` يمرر الطلب للـ Middleware التالي أو للـ Controller إذا لم يكن هناك middleware آخر.

---

### السؤال 13 (2 نقطة)
**كيف يتم تطبيق Middleware على Controller?**

A) في الـ Route فقط
B) في الـ Constructor
C) كلاهما صحيح
D) غير ممكن

**✅ الإجابة الصحيحة: C**

**الشرح:**
يمكن تطبيق Middleware على Controller بطريقتين: في الـ Route باستخدام `->middleware()` أو في constructor الـ Controller باستخدام `$this->middleware()`.

---

### السؤال 14 (2 نقطة)
**ما هو lifetime الافتراضي لـ Session في Laravel?**

A) 30 دقيقة
B) 60 دقيقة
C) 120 دقيقة
D) 180 دقيقة

**✅ الإجابة الصحيحة: C**

**الشرح:**
الـ lifetime الافتراضي هو 120 دقيقة (ساعتان) ويمكن تغييره من ملف `config/session.php`.

---

### السؤال 15 (2 نقطة)
**أي من التالي يُستخدم لحذف جميع بيانات Session?**

A) `session()->delete()`
B) `session()->clear()`
C) `session()->flush()`
D) `session()->removeAll()`

**✅ الإجابة الصحيحة: C**

**الشرح:**
`session()->flush()` يحذف جميع البيانات من Session.

---

## القسم الثاني: أسئلة صح أو خطأ (20 نقطة)

### السؤال 16 (2 نقطة)
**Middleware يمكن أن يعمل قبل وبعد معالجة الطلب.**

**✅ الإجابة: صح (True)**

**الشرح:**
Middleware يمكنه العمل قبل تمرير الطلب للـ Controller (قبل `$next($request)`) وبعده (بعد `$next($request)`).

---

### السؤال 17 (2 نقطة)
**يمكن تخزين كائنات PHP كاملة في Session بدون serialization.**

**✅ الإجابة: صح (True)**

**الشرح:**
Laravel يقوم تلقائياً بـ serialize الكائنات عند تخزينها و unserialize عند استرجاعها.

---

### السؤال 18 (2 نقطة)
**Global Middleware يُنفذ بعد Route Middleware.**

**✅ الإجابة: خطأ (False)**

**الشرح:**
Global Middleware يُنفذ قبل Route Middleware في دورة حياة الطلب.

---

### السؤال 19 (2 نقطة)
**Flash Messages تبقى في Session حتى يتم حذفها يدوياً.**

**✅ الإجابة: خطأ (False)**

**الشرح:**
Flash Messages تُحذف تلقائياً بعد الطلب التالي (بعد قراءتها مرة واحدة).

---

### السؤال 20 (2 نقطة)
**يمكن تمرير أكثر من معامل واحد لـ Middleware.**

**✅ الإجابة: صح (True)**

**الشرح:**
يمكن تمرير عدة معاملات باستخدام الفاصلة: `'role:admin,editor,manager'`.

---

### السؤال 21 (2 نقطة)
**Session Driver 'array' مناسب للإنتاج (Production).**

**✅ الإجابة: خطأ (False)**

**الشرح:**
'array' driver يحفظ البيانات في الذاكرة فقط وتُحذف بعد انتهاء الطلب، لذا هو للاختبارات فقط.

---

### السؤال 22 (2 نقطة)
**يجب تسجيل Middleware قبل استخدامه في Routes.**

**✅ الإجابة: صح (True)**

**الشرح:**
يجب تسجيل Middleware في `bootstrap/app.php` قبل استخدامه في Routes باسم مستعار (alias).

---

### السؤال 23 (2 نقطة)
**Middleware يمكنه تعديل الاستجابة (Response) قبل إرسالها.**

**✅ الإجابة: صح (True)**

**الشرح:**
Middleware يمكنه تعديل الـ Response بعد معالجة الطلب وقبل إرساله للمستخدم.

---

### السؤال 24 (2 نقطة)
**Sessions في Laravel مشفرة تلقائياً.**

**✅ الإجابة: صح (True)**

**الشرح:**
Laravel يقوم تلقائياً بتشفير جميع بيانات Session لحمايتها.

---

### السؤال 25 (2 نقطة)
**يمكن استخدام Middleware على route واحد فقط.**

**✅ الإجابة: خطأ (False)**

**الشرح:**
يمكن استخدام نفس Middleware على عدة routes، أو على group من الـ routes، أو على Controller كامل.

---

## القسم الثالث: أسئلة برمجية (50 نقطة)

### السؤال 26 (10 نقاط)
**أنشئ Middleware يتحقق من أن المستخدم admin.**

**الإجابة:**

```php
<?php
// app/Http/Middleware/CheckAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من تسجيل الدخول
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'يجب تسجيل الدخول أولاً');
        }

        // التحقق من كونه admin
        if (!auth()->user()->is_admin) {
            abort(403, 'ليس لديك صلاحية الوصول لهذه الصفحة');
        }

        return $next($request);
    }
}
```

**تسجيل الـ Middleware:**
```php
// bootstrap/app.php

->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\CheckAdmin::class,
    ]);
})
```

**الاستخدام:**
```php
// routes/web.php

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('admin');
```

**معايير التقييم:**
- التحقق من تسجيل الدخول (3 نقاط)
- التحقق من كون المستخدم admin (3 نقاط)
- معالجة الأخطاء بشكل صحيح (2 نقطة)
- التسجيل والاستخدام (2 نقطة)

---

### السؤال 27 (10 نقاط)
**أنشئ نظام سلة تسوق بسيط باستخدام Sessions يحتوي على: إضافة، حذف، وحساب المجموع.**

**الإجابة:**

```php
<?php
// app/Services/CartService.php

namespace App\Services;

class CartService
{
    /**
     * إضافة منتج للسلة
     */
    public function add(int $productId, string $name, float $price, int $quantity = 1): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);
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
        session(['cart' => $cart]);

        return true;
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
     * الحصول على السلة
     */
    public function getCart(): array
    {
        return session('cart', []);
    }

    /**
     * تفريغ السلة
     */
    public function clear(): void
    {
        session()->forget('cart');
    }
}
```

```php
<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function add(Request $request)
    {
        $this->cart->add(
            $request->product_id,
            $request->product_name,
            $request->price,
            $request->quantity ?? 1
        );

        return redirect()->back()
            ->with('success', 'تمت إضافة المنتج للسلة');
    }

    public function remove(int $productId)
    {
        if ($this->cart->remove($productId)) {
            return redirect()->back()
                ->with('success', 'تم حذف المنتج');
        }

        return redirect()->back()
            ->with('error', 'المنتج غير موجود');
    }

    public function index()
    {
        $cart = $this->cart->getCart();
        $total = $this->cart->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }
}
```

**معايير التقييم:**
- دالة الإضافة صحيحة (3 نقاط)
- دالة الحذف صحيحة (3 نقاط)
- حساب المجموع صحيح (2 نقطة)
- Controller مكتمل (2 نقطة)

---

### السؤال 28 (10 نقاط)
**أنشئ Middleware يسجل معلومات كل طلب (URL, Method, IP, Time) في ملف log.**

**الإجابة:**

```php
<?php
// app/Http/Middleware/LogRequests.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        // تسجيل معلومات الطلب
        $startTime = microtime(true);

        // معالجة الطلب
        $response = $next($request);

        // حساب الوقت المستغرق
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        // تسجيل المعلومات
        Log::info('Request Details', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => auth()->id(),
            'status_code' => $response->getStatusCode(),
            'duration' => $duration . 'ms',
            'timestamp' => now()->toDateTimeString(),
        ]);

        return $response;
    }
}
```

**تسجيل كـ Global Middleware:**
```php
// bootstrap/app.php

->withMiddleware(function (Middleware $middleware) {
    $middleware->append(\App\Http\Middleware\LogRequests::class);
})
```

**معايير التقييم:**
- تسجيل URL و Method (2 نقطة)
- تسجيل IP و User Agent (2 نقطة)
- قياس الوقت المستغرق (3 نقاط)
- استخدام Log facade بشكل صحيح (3 نقاط)

---

### السؤال 29 (10 نقاط)
**أنشئ نظام Flash Messages يدعم success, error, warning, info مع Component للعرض.**

**الإجابة:**

```php
<?php
// app/Helpers/Flash.php

namespace App\Helpers;

class Flash
{
    public static function success(string $message): void
    {
        session()->flash('flash_type', 'success');
        session()->flash('flash_message', $message);
    }

    public static function error(string $message): void
    {
        session()->flash('flash_type', 'error');
        session()->flash('flash_message', $message);
    }

    public static function warning(string $message): void
    {
        session()->flash('flash_type', 'warning');
        session()->flash('flash_message', $message);
    }

    public static function info(string $message): void
    {
        session()->flash('flash_type', 'info');
        session()->flash('flash_message', $message);
    }
}
```

```blade
{{-- resources/views/components/flash-alert.blade.php --}}

@if(session()->has('flash_message'))
    @php
        $type = session('flash_type', 'info');
        $message = session('flash_message');

        $colors = [
            'success' => 'bg-green-100 border-green-500 text-green-700',
            'error' => 'bg-red-100 border-red-500 text-red-700',
            'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
            'info' => 'bg-blue-100 border-blue-500 text-blue-700',
        ];

        $icons = [
            'success' => '✓',
            'error' => '✕',
            'warning' => '⚠',
            'info' => 'ℹ',
        ];
    @endphp

    <div class="alert {{ $colors[$type] }} border-l-4 p-4 mb-4" role="alert">
        <div class="flex items-center">
            <span class="text-2xl mr-3">{{ $icons[$type] }}</span>
            <p>{{ $message }}</p>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-auto">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector('.alert')?.remove();
        }, 5000);
    </script>
@endif
```

**الاستخدام في Controller:**
```php
use App\Helpers\Flash;

public function store(Request $request)
{
    // ... save data

    Flash::success('تم حفظ البيانات بنجاح');

    return redirect()->route('index');
}
```

**معايير التقييم:**
- دعم الأنواع الأربعة (4 نقاط)
- Component يعرض الرسائل بشكل صحيح (3 نقاط)
- التصميم وال UX (2 نقطة)
- Auto-dismiss (1 نقطة)

---

### السؤال 30 (10 نقاط)
**أنشئ Middleware يتحقق من صلاحية معينة مع إمكانية تمرير اسم الصلاحية كمعامل.**

**الإجابة:**

```php
<?php
// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        // التحقق من تسجيل الدخول
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $user = auth()->user();

        // التحقق من وجود أحد الصلاحيات
        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'ليس لديك الصلاحية المطلوبة');
    }
}
```

```php
<?php
// app/Models/User.php

public function hasPermission(string $permission): bool
{
    // افترض أن لدينا علاقة permissions
    return $this->permissions()
        ->where('name', $permission)
        ->exists();
}

public function permissions()
{
    return $this->belongsToMany(Permission::class);
}
```

**التسجيل:**
```php
// bootstrap/app.php

->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'permission' => \App\Http\Middleware\CheckPermission::class,
    ]);
})
```

**الاستخدام:**
```php
// routes/web.php

// صلاحية واحدة
Route::get('/posts/create', [PostController::class, 'create'])
    ->middleware('permission:create-post');

// عدة صلاحيات (يكفي واحدة)
Route::get('/posts/edit', [PostController::class, 'edit'])
    ->middleware('permission:edit-post,edit-all');
```

**معايير التقييم:**
- تمرير المعاملات بشكل صحيح (3 نقاط)
- التحقق من الصلاحيات (4 نقاط)
- معالجة الأخطاء (2 نقطة)
- الاستخدام مع routes (1 نقطة)

---

## 📊 جدول الدرجات | Grading Table

| القسم | عدد الأسئلة | الدرجات |
|------|------------|---------|
| الاختيار من متعدد | 15 | 30 |
| صح أو خطأ | 10 | 20 |
| أسئلة برمجية | 5 | 50 |
| **المجموع** | **30** | **100** |

---

## 🎯 معايير التقييم | Grading Criteria

| الدرجة | التقدير | الوصف |
|--------|---------|-------|
| 90-100 | ممتاز | فهم عميق وكود ممتاز |
| 80-89 | جيد جداً | فهم جيد مع أخطاء بسيطة |
| 70-79 | جيد | فهم مقبول، يحتاج تحسين |
| 60-69 | مقبول | فهم ضعيف، يحتاج مراجعة |
| أقل من 60 | راسب | يحتاج إعادة الدرس |

---

## 💡 نصائح بعد الامتحان

### إذا حصلت على 90+
- 🎉 ممتاز! انتقل للدرس التالي
- 📚 يمكنك مساعدة زملائك

### إذا حصلت على 70-89
- ✅ جيد! راجع الأجزاء الضعيفة
- 📖 أعد قراءة النظرية
- 💻 حل تمارين إضافية

### إذا حصلت على أقل من 70
- 📕 راجع الدرس كاملاً
- 👨‍💻 أعد التمارين
- 🎥 شاهد فيديوهات تعليمية
- ❓ اطلب المساعدة
- 🔄 أعد الامتحان

---

## 📚 مراجع إضافية | Additional Resources

- [Laravel Middleware Docs](https://laravel.com/docs/11.x/middleware)
- [Laravel Sessions Docs](https://laravel.com/docs/11.x/session)
- [Laracasts - Middleware](https://laracasts.com/series/laravel-from-scratch/middleware)

---

**🎓 تهانينا على إكمال الامتحان!**

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
