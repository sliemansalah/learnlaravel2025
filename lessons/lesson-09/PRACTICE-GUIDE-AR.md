# الدرس 9 - دليل التطبيق العملي
# تطبيق المصادقة والترخيص

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-09\practice-app
php artisan serve
```

سيعمل الخادم على: `http://localhost:8000`

---

## 📋 المتطلبات الأساسية

قبل البدء، تأكد من:
1. تثبيت Laravel Breeze
2. إعداد قاعدة البيانات في `.env`
3. تشغيل الهجرات
4. تثبيت Node.js و NPM

### خطوات التثبيت:
```bash
# الانتقال إلى practice-app
cd D:\learnlaravel2025\lessons\lesson-09\practice-app

# تثبيت Laravel Breeze
composer require laravel/breeze --dev

# تثبيت scaffolding
php artisan breeze:install blade

# تثبيت التبعيات
npm install && npm run dev

# تشغيل الهجرات
php artisan migrate
```

---

## ✅ التمارين المنفذة

### التمرين 1: إعداد Laravel Breeze

**المهمة**: تثبيت وإعداد نظام المصادقة Laravel Breeze.

**الملفات المولدة**:
- `app/Http/Controllers/Auth/` - متحكمات المصادقة
- `resources/views/auth/` - عروض تسجيل الدخول والتسجيل
- `routes/auth.php` - مسارات المصادقة

**المسارات للاختبار**:
- `/register` - تسجيل مستخدم جديد
- `/login` - تسجيل الدخول
- `/dashboard` - لوحة التحكم (تتطلب مصادقة)
- `/profile` - تعديل الملف الشخصي

---

### التمرين 2: إنشاء Gate بسيط

**الملف**: `app/Providers/AppServiceProvider.php`

```php
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;

public function boot(): void
{
    // Gate: المستخدم يمكنه تحديث منشوره
    Gate::define('update-post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
    });

    // Gate: وصول المدير
    Gate::define('access-admin', function (User $user) {
        return $user->role === 'admin';
    });

    // Gate: المدير الأعلى يمكنه كل شيء
    Gate::before(function (User $user, string $ability) {
        if ($user->email === 'admin@example.com') {
            return true;
        }
    });
}
```

**الاستخدام في Controller**:
```php
public function update(Request $request, Post $post)
{
    // الطريقة 1: التحقق يدوياً
    if (Gate::denies('update-post', $post)) {
        abort(403);
    }

    // الطريقة 2: Authorize (يرمي 403 تلقائياً)
    Gate::authorize('update-post', $post);

    $post->update($request->validated());
    return redirect()->route('posts.show', $post);
}
```

**الاستخدام في Blade**:
```blade
@can('update-post', $post)
    <a href="{{ route('posts.edit', $post) }}">تعديل المنشور</a>
@endcan

@can('access-admin')
    <a href="/admin">لوحة الإدارة</a>
@endcan
```

---

### التمرين 3: إنشاء Post Policy

**الأمر**:
```bash
php artisan make:policy PostPolicy --model=Post
```

**الملف**: `app/Policies/PostPolicy.php`

```php
<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * يمكن للجميع عرض جميع المنشورات
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * عرض المنشورات المنشورة أو المسودات الخاصة
     */
    public function view(?User $user, Post $post): bool
    {
        // الجميع يمكنه رؤية المنشورات المنشورة
        if ($post->is_published) {
            return true;
        }

        // المالك فقط يمكنه رؤية المسودات
        return $user && $user->id === $post->user_id;
    }

    /**
     * المستخدمون المؤكدون فقط يمكنهم الإنشاء
     */
    public function create(User $user): bool
    {
        return $user->email_verified_at !== null;
    }

    /**
     * المالك فقط يمكنه التحديث
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * المالك أو المدير يمكنه الحذف
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
               || $user->role === 'admin';
    }

    /**
     * المدير فقط يمكنه الحذف النهائي
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }
}
```

---

### التمرين 4: Middleware مخصص (للمديرين فقط)

**إنشاء Middleware**:
```bash
php artisan make:middleware EnsureUserIsAdmin
```

**الملف**: `app/Http/Middleware/EnsureUserIsAdmin.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح');
        }

        return $next($request);
    }
}
```

**تسجيل Middleware** في `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
    ]);
})
```

**الاستخدام في المسارات**:
```php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/users', [AdminController::class, 'users']);
});
```

---

### التمرين 5: مصادقة API باستخدام Sanctum

**تثبيت Sanctum**:
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

**إضافة إلى User Model**:
```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}
```

**متحكم API**:
```php
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ], 201);
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'بيانات غير صحيحة'
        ], 401);
    }

    $user = User::where('email', $request->email)->first();
    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
}
```

---

### التمرين 6: نظام الأدوار والصلاحيات

**إضافة عمود role إلى جدول users** (الهجرة):
```php
Schema::table('users', function (Blueprint $table) {
    $table->string('role')->default('user');
});
```

**دوال User Model**:
```php
class User extends Authenticatable
{
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function canModerate(): bool
    {
        return in_array($this->role, ['admin', 'moderator']);
    }
}
```

**Gates للأدوار**:
```php
Gate::define('manage-users', function (User $user) {
    return $user->isAdmin();
});

Gate::define('moderate-posts', function (User $user) {
    return $user->canModerate();
});
```

---

## 🎯 ما تعلمناه

### 1. أساسيات المصادقة
- إعداد Laravel Breeze
- تسجيل الدخول والتسجيل والخروج
- إعادة تعيين كلمة المرور
- تأكيد البريد الإلكتروني

### 2. الترخيص باستخدام Gates
- تعريف Gates
- فحص الأذونات باستخدام `Gate::allows()` و `Gate::denies()`
- استخدام `Gate::authorize()` في المتحكمات
- استخدام `@can` و `@cannot` في Blade

### 3. Policies
- إنشاء Policies
- دوال Policy (viewAny, view, create, update, delete)
- استخدام `$this->authorize()` في المتحكمات
- الاكتشاف التلقائي للـ Policies

### 4. Middleware
- استخدام وسيط `auth`
- استخدام وسيط `guest`
- استخدام وسيط `verified`
- إنشاء وسيط مخصص

### 5. مصادقة API
- إعداد Laravel Sanctum
- إنشاء رموز API
- حماية مسارات API
- صلاحيات الرموز

### 6. الأدوار والصلاحيات
- إضافة أدوار للمستخدمين
- Gates معتمدة على الأدوار
- وسيط مخصص للأدوار
- دوال فحص الأدوار

---

## 🧪 اختبار التنفيذ

### اختبار المصادقة:
1. زيارة `/register` وإنشاء حساب
2. زيارة `/login` وتسجيل الدخول
3. زيارة `/dashboard` (يجب أن ترى لوحة التحكم)
4. تسجيل الخروج ومحاولة زيارة `/dashboard` (يجب التوجيه إلى تسجيل الدخول)

### اختبار الترخيص:
1. إنشاء منشور (المستخدمون المسجلون فقط)
2. محاولة تعديل منشورك (يجب أن ينجح)
3. محاولة تعديل منشور مستخدم آخر (يجب الحصول على 403)
4. المحاولة كمدير (يجب أن ينجح)

### اختبار API:
1. استخدام Postman أو cURL للتسجيل عبر API
2. تسجيل الدخول عبر API والحصول على الرمز
3. استخدام الرمز للوصول إلى المسارات المحمية
4. اختبار نقطة نهاية تسجيل الخروج

---

## 📝 المشاكل الشائعة والحلول

### المشكلة 1: 403 Forbidden على جميع الإجراءات
**الحل**: تحقق من دالة `before()` في Policy - قد تحظر كل شيء

### المشكلة 2: Middleware لا يعمل
**الحل**: تأكد من تسجيل الوسيط في `bootstrap/app.php` أو `app/Http/Kernel.php`

### المشكلة 3: Gate غير موجود
**الحل**: تأكد من تعريف Gates في دالة `AppServiceProvider::boot()`

### المشكلة 4: مصادقة الرمز لا تعمل
**الحل**:
- تحقق من أن وسيط Sanctum في مجموعة وسيط `api`
- تأكد من أن trait `HasApiTokens` في User model
- تحقق من صيغة رمز Bearer: `Authorization: Bearer {token}`

---

## 🔗 الخطوات التالية

بعد إكمال هذه التمارين:
1. تنفيذ نظام مدونة كامل مع ترخيص
2. إضافة المزيد من الأدوار (محرر، مساهم)
3. إنشاء نظام أذونات
4. تنفيذ تحديد معدل API
5. إضافة مصادقة ثنائية

---

**برمجة سعيدة!**
