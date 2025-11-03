# الدرس السابع: Authentication & Authorization في Laravel

## المحتويات

1. [مقدمة عن Authentication و Authorization](#مقدمة)
2. [Laravel Authentication Scaffolding](#scaffolding)
3. [Manual Authentication](#manual-authentication)
4. [Guards & Providers](#guards-providers)
5. [Session Management](#session-management)
6. [Remember Me](#remember-me)
7. [Authorization Basics](#authorization-basics)
8. [Gates](#gates)
9. [Policies](#policies)
10. [Middleware للحماية](#middleware)
11. [Role-Based Access Control (RBAC)](#rbac)
12. [Best Practices](#best-practices)

---

## 1. مقدمة عن Authentication و Authorization {#مقدمة}

### ما هو Authentication؟

**Authentication (المصادقة)** هي عملية التحقق من هوية المستخدم - "من أنت؟"

- تسجيل الدخول (Login)
- تسجيل الخروج (Logout)
- تسجيل مستخدم جديد (Register)
- إعادة تعيين كلمة المرور
- التحقق من البريد الإلكتروني

### ما هو Authorization؟

**Authorization (التفويض/الصلاحيات)** هي عملية التحقق من صلاحيات المستخدم - "ما الذي يمكنك فعله؟"

- هل يمكن للمستخدم الوصول لهذه الصفحة؟
- هل يمكنه تعديل هذا المحتوى؟
- هل يمكنه حذف هذا السجل؟

### الفرق بينهما

```
Authentication = من أنت؟ (التحقق من الهوية)
Authorization  = ماذا يمكنك أن تفعل؟ (التحقق من الصلاحيات)

مثال:
1. المستخدم يسجل دخول (Authentication)
2. النظام يتحقق: هل يمكنه حذف المقالة؟ (Authorization)
```

---

## 2. Laravel Authentication Scaffolding {#scaffolding}

### Laravel Breeze (الأبسط والأسرع)

**Laravel Breeze** يوفر authentication بسيط وخفيف:

```bash
# تثبيت Breeze
composer require laravel/breeze --dev

# تثبيت Authentication scaffolding
php artisan breeze:install

# اختيار Stack:
# 1. Blade (بدون JavaScript framework)
# 2. Vue
# 3. React
# 4. API only

# تثبيت dependencies
npm install
npm run dev

# تشغيل Migrations
php artisan migrate
```

**ما يوفره Breeze:**
- ✅ Login / Register
- ✅ Password Reset
- ✅ Email Verification
- ✅ Profile Management
- ✅ Views جاهزة مع Tailwind CSS

---

### Laravel Jetstream (متقدم ومليء بالميزات)

**Laravel Jetstream** يوفر authentication متقدم:

```bash
# تثبيت Jetstream
composer require laravel/jetstream

# تثبيت مع Livewire
php artisan jetstream:install livewire

# أو مع Inertia.js
php artisan jetstream:install inertia

# تثبيت dependencies
npm install
npm run dev

# تشغيل Migrations
php artisan migrate
```

**ما يوفره Jetstream:**
- ✅ كل ما في Breeze
- ✅ Two-Factor Authentication
- ✅ API Tokens (Laravel Sanctum)
- ✅ Team Management
- ✅ Profile Photos
- ✅ Browser Sessions Management
- ✅ Built with Tailwind CSS

---

### Laravel Fortify (Backend فقط)

**Laravel Fortify** يوفر backend authentication بدون UI:

```bash
composer require laravel/fortify

php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

php artisan migrate
```

يستخدم عندما تريد بناء Frontend مخصص أو API.

---

## 3. Manual Authentication {#manual-authentication}

### إعداد Users Table

```php
// database/migrations/xxxx_create_users_table.php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

### User Model

```php
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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+
    ];
}
```

---

### التسجيل (Register)

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// إنشاء مستخدم جديد
$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password), // تشفير كلمة المرور
]);

// تسجيل الدخول تلقائياً بعد التسجيل
Auth::login($user);

return redirect('/dashboard');
```

---

### تسجيل الدخول (Login)

```php
use Illuminate\Support\Facades\Auth;

// الطريقة 1: استخدام attempt()
$credentials = $request->only('email', 'password');
$remember = $request->boolean('remember');

if (Auth::attempt($credentials, $remember)) {
    // نجح تسجيل الدخول
    $request->session()->regenerate(); // تجديد Session للأمان

    return redirect()->intended('dashboard');
}

// فشل تسجيل الدخول
return back()->withErrors([
    'email' => 'البيانات المدخلة غير صحيحة.',
]);
```

```php
// الطريقة 2: التحقق اليدوي
$user = User::where('email', $request->email)->first();

if ($user && Hash::check($request->password, $user->password)) {
    Auth::login($user);
    return redirect('/dashboard');
}
```

---

### تسجيل الخروج (Logout)

```php
use Illuminate\Support\Facades\Auth;

Auth::logout();

$request->session()->invalidate();       // إلغاء Session
$request->session()->regenerateToken();  // تجديد CSRF Token

return redirect('/');
```

---

### التحقق من المستخدم المسجل

```php
// التحقق من تسجيل الدخول
if (Auth::check()) {
    // المستخدم مسجل دخول
}

// الحصول على المستخدم الحالي
$user = Auth::user();

// في Blade
@auth
    <p>مرحباً، {{ Auth::user()->name }}</p>
@endauth

@guest
    <a href="/login">تسجيل الدخول</a>
@endguest

// الحصول على ID فقط
$userId = Auth::id();
```

---

## 4. Guards & Providers {#guards-providers}

### ما هو Guard؟

**Guard** يحدد كيف يتم المصادقة على المستخدمين لكل request.

Laravel يأتي مع Guards جاهزة:
- `web` - Session/Cookie based (افتراضي)
- `api` - Token based

### ما هو Provider؟

**Provider** يحدد كيف يتم جلب المستخدمين من قاعدة البيانات.

```php
// config/auth.php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],

        // Custom Guard
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Custom Provider
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],
];
```

### استخدام Guards المختلفة

```php
// استخدام Web Guard (الافتراضي)
Auth::guard('web')->attempt($credentials);

// استخدام Admin Guard
Auth::guard('admin')->attempt($credentials);

// الحصول على المستخدم من Guard معين
$user = Auth::guard('admin')->user();

// في Middleware
Route::get('/admin/dashboard', function () {
    // ...
})->middleware('auth:admin');
```

---

## 5. Session Management {#session-management}

### كيف تعمل Sessions؟

Laravel تستخدم Sessions لتخزين معلومات المستخدم بين Requests:

```php
// تخزين بيانات في Session
$request->session()->put('key', 'value');
session(['key' => 'value']); // نفس الشيء

// جلب بيانات من Session
$value = $request->session()->get('key');
$value = session('key'); // نفس الشيء

// جلب مع قيمة افتراضية
$value = session('key', 'default');

// التحقق من وجود قيمة
if ($request->session()->has('key')) {
    // ...
}

// حذف من Session
$request->session()->forget('key');

// مسح كل Session
$request->session()->flush();

// تجديد Session ID (للأمان)
$request->session()->regenerate();
```

### Session Configuration

```php
// config/session.php
return [
    'driver' => env('SESSION_DRIVER', 'file'), // file, cookie, database, redis, array
    'lifetime' => 120,  // بالدقائق
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/sessions'),
    'connection' => null,
    'table' => 'sessions',
    'store' => null,
    'lottery' => [2, 100], // فرصة تنظيف Sessions القديمة
    'cookie' => env('SESSION_COOKIE', 'laravel_session'),
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => env('SESSION_SECURE_COOKIE', false),
    'http_only' => true,
    'same_site' => 'lax',
];
```

---

## 6. Remember Me {#remember-me}

### كيف يعمل Remember Me؟

عند تحديد "تذكرني"، Laravel ينشئ Token طويل الأمد (عادة 5 سنوات):

```php
// في Login
if (Auth::attempt($credentials, $remember = true)) {
    // سيتم تذكر المستخدم
}

// التحقق من "viaRemember"
if (Auth::viaRemember()) {
    // المستخدم تم تسجيل دخوله عبر Remember Token
}

// إزالة Remember Token
Auth::logoutOtherDevices($password);
```

### في User Model

```php
// Laravel تلقائياً تبحث عن remember_token column
// تأكد من وجود:
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Laravel تلقائياً تدير remember_token
}
```

---

## 7. Authorization Basics {#authorization-basics}

### المفاهيم الأساسية

```
Action       = الإجراء (view, create, update, delete)
Resource     = المورد (Post, User, Comment)
Permission   = الصلاحية (can user do action on resource?)

مثال:
Can user edit this post?
- User: المستخدم الحالي
- Action: edit
- Resource: المقالة المحددة
```

### طرق Authorization في Laravel

1. **Gates** - Closures بسيطة للتحقق من الصلاحيات
2. **Policies** - Classes منظمة للصلاحيات حسب Model
3. **Middleware** - حماية Routes
4. **Blade Directives** - عرض/إخفاء في Views

---

## 8. Gates {#gates}

### ما هو Gate؟

**Gate** هو Closure بسيط يحدد صلاحية معينة.

### تعريف Gates

```php
// app/Providers/AppServiceProvider.php (أو AuthServiceProvider)
use Illuminate\Support\Facades\Gate;

public function boot()
{
    // Gate بسيط
    Gate::define('update-post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
    });

    // Gate للإداريين
    Gate::define('admin-only', function (User $user) {
        return $user->is_admin === true;
    });

    // Gate مع عدة شروط
    Gate::define('publish-post', function (User $user, Post $post) {
        // يمكن النشر إذا كان صاحب المقالة أو إداري
        return $user->id === $post->user_id || $user->is_admin;
    });

    // Gate قبل كل شيء (Super Admin)
    Gate::before(function (User $user) {
        if ($user->is_super_admin) {
            return true; // السماح بكل شيء
        }
    });

    // Gate بعد كل شيء
    Gate::after(function (User $user, string $ability, bool $result) {
        // تسجيل محاولات الوصول
    });
}
```

### استخدام Gates

```php
// في Controller
use Illuminate\Support\Facades\Gate;

// التحقق من الصلاحية
if (Gate::allows('update-post', $post)) {
    // المستخدم يمكنه التحديث
}

if (Gate::denies('update-post', $post)) {
    // المستخدم لا يمكنه التحديث
    abort(403);
}

// إرجاع Exception إذا فشل
Gate::authorize('update-post', $post); // يرمي 403 إذا فشل

// التحقق من عدة صلاحيات
if (Gate::any(['update-post', 'delete-post'], $post)) {
    // المستخدم يمكنه واحدة منهما على الأقل
}

if (Gate::none(['update-post', 'delete-post'], $post)) {
    // المستخدم لا يمكنه أي منهما
}

// على User Model
if ($user->can('update-post', $post)) {
    // يمكنه
}

if ($user->cannot('update-post', $post)) {
    // لا يمكنه
}
```

### في Blade

```blade
@can('update-post', $post)
    <a href="{{ route('posts.edit', $post) }}">تعديل</a>
@endcan

@cannot('update-post', $post)
    <p>لا يمكنك تعديل هذه المقالة</p>
@endcannot

@canany(['update-post', 'delete-post'], $post)
    <p>يمكنك التحديث أو الحذف</p>
@endcanany
```

---

## 9. Policies {#policies}

### ما هو Policy؟

**Policy** هو Class يجمع منطق Authorization حول Model معين.

### إنشاء Policy

```bash
# إنشاء Policy
php artisan make:policy PostPolicy

# إنشاء Policy مع Model
php artisan make:policy PostPolicy --model=Post
```

```php
// app/Policies/PostPolicy.php
namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    /**
     * يمكن للجميع رؤية المقالات المنشورة
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * يمكن للجميع رؤية مقالة منشورة
     */
    public function view(?User $user, Post $post)
    {
        // يسمح بـ Guest users (?)
        return $post->is_published;
    }

    /**
     * فقط المستخدمين المسجلين يمكنهم الإنشاء
     */
    public function create(User $user)
    {
        return $user !== null;
    }

    /**
     * فقط صاحب المقالة يمكنه التعديل
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * صاحب المقالة أو الإداري يمكنه الحذف
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->is_admin;
    }

    /**
     * فقط صاحب المقالة يمكنه الاستعادة
     */
    public function restore(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * فقط الإداريين يمكنهم الحذف النهائي
     */
    public function forceDelete(User $user, Post $post)
    {
        return $user->is_admin;
    }

    /**
     * قبل كل الصلاحيات (Super Admin)
     */
    public function before(User $user, string $ability)
    {
        if ($user->is_super_admin) {
            return true;
        }
    }
}
```

### تسجيل Policy

```php
// app/Providers/AuthServiceProvider.php
namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    public function boot()
    {
        //
    }
}
```

**ملاحظة**: Laravel تلقائياً تكتشف Policies إذا اتبعت التسمية القياسية.

### استخدام Policies

```php
// في Controller
use App\Models\Post;

public function update(Request $request, Post $post)
{
    // الطريقة 1: authorize() helper
    $this->authorize('update', $post);

    // الطريقة 2: Gate facade
    Gate::authorize('update', $post);

    // الطريقة 3: على User
    if ($request->user()->cannot('update', $post)) {
        abort(403);
    }

    // تحديث المقالة
    $post->update($request->validated());

    return redirect()->route('posts.show', $post);
}
```

```php
// في Routes
Route::put('/posts/{post}', [PostController::class, 'update'])
    ->middleware('can:update,post');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->can('delete', 'post');
```

```blade
{{-- في Blade --}}
@can('update', $post)
    <a href="{{ route('posts.edit', $post) }}">تعديل</a>
@endcan

@can('delete', $post)
    <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">حذف</button>
    </form>
@endcan
```

---

## 10. Middleware للحماية {#middleware}

### Auth Middleware

```php
// حماية Route - يجب تسجيل الدخول
Route::get('/dashboard', function () {
    // ...
})->middleware('auth');

// مجموعة Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
});

// في Controller
public function __construct()
{
    $this->middleware('auth');

    // استثناء Methods معينة
    $this->middleware('auth')->except(['index', 'show']);

    // فقط Methods معينة
    $this->middleware('auth')->only(['create', 'store']);
}
```

### Guest Middleware

```php
// فقط للزوار (غير مسجلي الدخول)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::get('/register', [AuthController::class, 'showRegister']);
});
```

### Verified Middleware

```php
// يجب تأكيد البريد الإلكتروني
Route::get('/dashboard', function () {
    // ...
})->middleware(['auth', 'verified']);
```

### Custom Middleware للصلاحيات

```bash
php artisan make:middleware EnsureUserIsAdmin
```

```php
// app/Http/Middleware/EnsureUserIsAdmin.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            abort(403, 'غير مصرح لك بالوصول');
        }

        return $next($request);
    }
}
```

```php
// app/Http/Kernel.php
protected $middlewareAliases = [
    'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
];
```

```php
// استخدام
Route::get('/admin/dashboard', function () {
    // ...
})->middleware('admin');
```

---

## 11. Role-Based Access Control (RBAC) {#rbac}

### إعداد RBAC البسيط

#### Migrations

```php
// roles table
Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique(); // admin, editor, user
    $table->string('label')->nullable();
    $table->timestamps();
});

// permissions table
Schema::create('permissions', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique(); // create-post, edit-post
    $table->string('label')->nullable();
    $table->timestamps();
});

// role_user pivot table (Many to Many)
Schema::create('role_user', function (Blueprint $table) {
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    $table->primary(['role_id', 'user_id']);
});

// permission_role pivot table (Many to Many)
Schema::create('permission_role', function (Blueprint $table) {
    $table->foreignId('permission_id')->constrained()->onDelete('cascade');
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    $table->primary(['permission_id', 'role_id']);
});
```

#### Models

```php
// app/Models/Role.php
class Role extends Model
{
    protected $fillable = ['name', 'label'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

// app/Models/Permission.php
class Permission extends Model
{
    protected $fillable = ['name', 'label'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

// app/Models/User.php - إضافة Relations
public function roles()
{
    return $this->belongsToMany(Role::class);
}

public function permissions()
{
    // جلب جميع الصلاحيات عبر الأدوار
    return $this->roles->flatMap->permissions->unique('id');
}

// Helper Methods
public function hasRole($role)
{
    return $this->roles->contains('name', $role);
}

public function hasPermission($permission)
{
    return $this->permissions()->contains('name', $permission);
}

public function assignRole($role)
{
    return $this->roles()->attach(
        Role::where('name', $role)->firstOrFail()
    );
}

public function removeRole($role)
{
    return $this->roles()->detach(
        Role::where('name', $role)->firstOrFail()
    );
}
```

#### Gates للـ RBAC

```php
// app/Providers/AuthServiceProvider.php
public function boot()
{
    // Gate للتحقق من Role
    Gate::define('admin-only', function (User $user) {
        return $user->hasRole('admin');
    });

    // Gates ديناميكية للصلاحيات
    foreach (Permission::all() as $permission) {
        Gate::define($permission->name, function (User $user) use ($permission) {
            return $user->hasPermission($permission->name);
        });
    }
}
```

#### استخدام RBAC

```php
// التحقق من Role
if (auth()->user()->hasRole('admin')) {
    // ...
}

// التحقق من Permission
if (auth()->user()->hasPermission('edit-post')) {
    // ...
}

// في Blade
@if(auth()->user()->hasRole('admin'))
    <a href="/admin">لوحة الإدارة</a>
@endif

// في Middleware
if (!$request->user()->hasRole('admin')) {
    abort(403);
}

// في Gates
if (Gate::allows('edit-post')) {
    // ...
}
```

---

## 12. Best Practices {#best-practices}

### 1. استخدم Policies للـ Authorization

```php
// ✅ جيد - منظم وواضح
$this->authorize('update', $post);

// ❌ سيئ - منطق في Controller
if ($post->user_id !== auth()->id()) {
    abort(403);
}
```

### 2. استخدم Middleware للحماية

```php
// ✅ جيد - حماية على مستوى Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// ❌ سيئ - التحقق في كل method
public function index()
{
    if (!auth()->user()->is_admin) abort(403);
    // ...
}
```

### 3. لا تخزن كلمات المرور بدون Hash

```php
// ✅ جيد
'password' => Hash::make($request->password)

// ❌ سيئ - كلمة مرور واضحة!
'password' => $request->password
```

### 4. جدد Session بعد Login

```php
// ✅ جيد - يمنع Session Fixation
if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    return redirect('/dashboard');
}
```

### 5. استخدم Rate Limiting للـ Login

```php
// في Routes
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 محاولات في دقيقة

// أو في Controller
use Illuminate\Support\Facades\RateLimiter;

if (RateLimiter::tooManyAttempts('login:'.$request->ip(), 5)) {
    return back()->withErrors(['email' => 'محاولات كثيرة جداً. حاول بعد دقيقة.']);
}

RateLimiter::hit('login:'.$request->ip());
```

### 6. استخدم Email Verification

```php
// في User Model
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ...
}

// في Routes
Route::get('/dashboard', function () {
    // ...
})->middleware(['auth', 'verified']);
```

### 7. استخدم Two-Factor Authentication للحسابات الحساسة

```php
// Laravel Fortify/Jetstream يوفرون 2FA جاهز
```

### 8. سجل محاولات Login الفاشلة

```php
use Illuminate\Support\Facades\Log;

if (!Auth::attempt($credentials)) {
    Log::warning('Failed login attempt', [
        'email' => $request->email,
        'ip' => $request->ip(),
    ]);
}
```

### 9. استخدم HTTPS في Production

```php
// config/session.php
'secure' => env('SESSION_SECURE_COOKIE', true),

// في AppServiceProvider
if ($this->app->environment('production')) {
    URL::forceScheme('https');
}
```

### 10. احذر من Mass Assignment

```php
// ✅ جيد - استخدم $fillable
User::create($request->validated());

// ❌ سيئ - قد يحتوي على is_admin!
User::create($request->all());
```

---

## الخلاصة

في هذا الدرس تعلمنا:

✅ الفرق بين Authentication و Authorization
✅ Laravel Breeze/Jetstream/Fortify
✅ Manual Authentication (Login, Register, Logout)
✅ Guards & Providers
✅ Session Management & Remember Me
✅ Gates للصلاحيات البسيطة
✅ Policies للصلاحيات المنظمة
✅ Middleware للحماية
✅ Role-Based Access Control (RBAC)
✅ Best Practices للأمان

**Authentication & Authorization** أساسيان لأي تطبيق ويب آمن! 🔐
