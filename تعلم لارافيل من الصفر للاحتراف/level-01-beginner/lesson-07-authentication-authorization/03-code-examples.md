# أمثلة الكود: Authentication & Authorization

## نظرة عامة

هذا الملف يحتوي على **35 مثال عملي** تغطي جميع جوانب Authentication و Authorization في Laravel.

---

## القسم 1: Authentication الأساسي

### مثال 1: تسجيل مستخدم جديد

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// في Controller
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    // إنشاء المستخدم
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // تسجيل الدخول تلقائياً
    Auth::login($user);

    return redirect('/dashboard');
}
```

---

### مثال 2: تسجيل الدخول

```php
use Illuminate\Support\Facades\Auth;

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'البيانات غير صحيحة.',
    ])->onlyInput('email');
}
```

---

### مثال 3: تسجيل الخروج

```php
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
```

---

### مثال 4: التحقق من تسجيل الدخول

```php
// في Controller
if (Auth::check()) {
    // المستخدم مسجل دخول
    $user = Auth::user();
}

// في Blade
@auth
    <p>مرحباً، {{ auth()->user()->name }}</p>
@endauth

@guest
    <a href="/login">تسجيل الدخول</a>
@endguest

// في Middleware
Route::get('/dashboard', function () {
    // ...
})->middleware('auth');
```

---

### مثال 5: Remember Me

```php
// تذكر المستخدم لمدة 5 سنوات
if (Auth::attempt($credentials, $remember = true)) {
    // ...
}

// التحقق من طريقة تسجيل الدخول
if (Auth::viaRemember()) {
    // تم تسجيل الدخول عبر Remember Token
}
```

---

## القسم 2: Guards

### مثال 6: استخدام Guard مخصص

```php
// config/auth.php
'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

'providers' => [
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
```

```php
// تسجيل دخول Admin
if (Auth::guard('admin')->attempt($credentials)) {
    return redirect('/admin/dashboard');
}

// الحصول على Admin الحالي
$admin = Auth::guard('admin')->user();

// تسجيل خروج Admin
Auth::guard('admin')->logout();
```

---

### مثال 7: استخدام Guards في Middleware

```php
// حماية Routes بـ Admin Guard
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

// في Controller
public function __construct()
{
    $this->middleware('auth:admin');
}
```

---

### مثال 8: Multi-Guard Authentication

```php
// في Controller
public function dashboard()
{
    if (Auth::guard('admin')->check()) {
        return view('admin.dashboard');
    }

    if (Auth::guard('web')->check()) {
        return view('user.dashboard');
    }

    return redirect('/login');
}
```

---

## القسم 3: Session Management

### مثال 9: إدارة Session

```php
// تخزين في Session
session(['key' => 'value']);
$request->session()->put('key', 'value');

// جلب من Session
$value = session('key');
$value = $request->session()->get('key', 'default');

// حذف من Session
$request->session()->forget('key');

// مسح كل Session
$request->session()->flush();

// تجديد Session ID
$request->session()->regenerate();
```

---

### مثال 10: تسجيل الخروج من جميع الأجهزة

```php
use Illuminate\Support\Facades\Hash;

public function logoutOtherDevices(Request $request)
{
    $request->validate([
        'password' => 'required',
    ]);

    Auth::logoutOtherDevices($request->password);

    return back()->with('success', 'تم تسجيل الخروج من جميع الأجهزة');
}
```

---

## القسم 4: Gates

### مثال 11: تعريف Gate بسيط

```php
// app/Providers/AppServiceProvider.php
use Illuminate\Support\Facades\Gate;

public function boot()
{
    Gate::define('edit-post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
    });
}
```

---

### مثال 12: استخدام Gate

```php
// في Controller
use Illuminate\Support\Facades\Gate;

if (Gate::allows('edit-post', $post)) {
    // يمكنه التعديل
}

if (Gate::denies('edit-post', $post)) {
    abort(403);
}

// إرجاع 403 إذا فشل
Gate::authorize('edit-post', $post);

// على User
if ($user->can('edit-post', $post)) {
    // ...
}
```

---

### مثال 13: Gate في Blade

```blade
@can('edit-post', $post)
    <a href="{{ route('posts.edit', $post) }}">تعديل</a>
@endcan

@cannot('edit-post', $post)
    <p>لا يمكنك تعديل هذه المقالة</p>
@endcannot
```

---

### مثال 14: Gate بدون Model

```php
Gate::define('admin-only', function (User $user) {
    return $user->is_admin === true;
});

// استخدام
if (Gate::allows('admin-only')) {
    // المستخدم إداري
}
```

---

### مثال 15: Gate مع عدة شروط

```php
Gate::define('publish-post', function (User $user, Post $post) {
    // الصاحب أو الإداري
    return $user->id === $post->user_id || $user->is_admin;
});
```

---

### مثال 16: Gate Before & After

```php
// Before - يتم التحقق قبل جميع Gates
Gate::before(function (User $user, string $ability) {
    if ($user->is_super_admin) {
        return true; // السماح بكل شيء
    }
});

// After - يتم التنفيذ بعد كل Gates
Gate::after(function (User $user, string $ability, bool $result) {
    Log::info("User {$user->id} attempted {$ability}: " . ($result ? 'allowed' : 'denied'));
});
```

---

## القسم 5: Policies

### مثال 17: إنشاء Policy

```bash
php artisan make:policy PostPolicy --model=Post
```

```php
// app/Policies/PostPolicy.php
namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(?User $user, Post $post)
    {
        return $post->is_published;
    }

    public function create(User $user)
    {
        return $user !== null;
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
```

---

### مثال 18: تسجيل Policy

```php
// app/Providers/AuthServiceProvider.php
protected $policies = [
    Post::class => PostPolicy::class,
];
```

---

### مثال 19: استخدام Policy في Controller

```php
public function update(Request $request, Post $post)
{
    // الطريقة 1
    $this->authorize('update', $post);

    // الطريقة 2
    Gate::authorize('update', $post);

    // الطريقة 3
    if ($request->user()->cannot('update', $post)) {
        abort(403);
    }

    $post->update($request->validated());

    return redirect()->route('posts.show', $post);
}
```

---

### مثال 20: Policy في Routes

```php
Route::put('/posts/{post}', [PostController::class, 'update'])
    ->middleware('can:update,post');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->can('delete', 'post');
```

---

### مثال 21: Policy للـ Guest Users

```php
// السماح بـ Guest users باستخدام ?
public function view(?User $user, Post $post)
{
    if ($post->is_published) {
        return true;
    }

    return $user && $user->id === $post->user_id;
}
```

---

### مثال 22: Policy Before Method

```php
class PostPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->is_super_admin) {
            return true;
        }
    }

    // باقي الـ methods...
}
```

---

## القسم 6: RBAC (Role-Based Access Control)

### مثال 23: إعداد Roles و Permissions

```php
// في Seeder
$admin = Role::create(['name' => 'admin', 'label' => 'مدير']);
$editor = Role::create(['name' => 'editor', 'label' => 'محرر']);

$createPost = Permission::create(['name' => 'create-post', 'label' => 'إنشاء مقالة']);
$editPost = Permission::create(['name' => 'edit-post', 'label' => 'تعديل مقالة']);

// ربط Permissions بـ Roles
$admin->permissions()->attach([$createPost->id, $editPost->id]);
$editor->permissions()->attach([$editPost->id]);
```

---

### مثال 24: تعيين Role لمستخدم

```php
// تعيين Role
$user->assignRole('admin');
$user->roles()->attach($roleId);

// حذف Role
$user->removeRole('editor');
$user->roles()->detach($roleId);

// مزامنة Roles
$user->syncRoles(['admin', 'editor']);
```

---

### مثال 25: التحقق من Roles

```php
// في User Model
public function hasRole($role)
{
    return $this->roles->contains('name', $role);
}

public function hasAnyRole($roles)
{
    return $this->roles->whereIn('name', $roles)->count() > 0;
}

// استخدام
if ($user->hasRole('admin')) {
    // ...
}

if ($user->hasAnyRole(['admin', 'editor'])) {
    // ...
}
```

---

### مثال 26: التحقق من Permissions

```php
// في User Model
public function hasPermission($permission)
{
    return $this->roles->flatMap->permissions->contains('name', $permission);
}

// استخدام
if ($user->hasPermission('edit-post')) {
    // ...
}
```

---

### مثال 27: Gates للـ RBAC

```php
// تسجيل Gates ديناميكياً
public function boot()
{
    foreach (Permission::all() as $permission) {
        Gate::define($permission->name, function (User $user) use ($permission) {
            return $user->hasPermission($permission->name);
        });
    }
}

// استخدام
if (Gate::allows('edit-post')) {
    // ...
}
```

---

### مثال 28: Middleware للـ Roles

```php
// app/Http/Middleware/CheckRole.php
public function handle(Request $request, Closure $next, ...$roles)
{
    if (!$request->user() || !$request->user()->hasAnyRole($roles)) {
        abort(403);
    }

    return $next($request);
}

// استخدام
Route::middleware(['auth', 'role:admin'])->group(function () {
    // ...
});
```

---

### مثال 29: Blade Directives للـ Roles

```blade
@if(auth()->user()->hasRole('admin'))
    <a href="/admin">لوحة الإدارة</a>
@endif

@if(auth()->user()->hasPermission('edit-post'))
    <a href="{{ route('posts.edit', $post) }}">تعديل</a>
@endif
```

---

## القسم 7: Email Verification

### مثال 30: تفعيل Email Verification

```php
// في User Model
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ...
}
```

```php
// في Routes
Route::get('/dashboard', function () {
    // ...
})->middleware(['auth', 'verified']);
```

---

### مثال 31: إرسال Email Verification يدوياً

```php
use Illuminate\Support\Facades\Mail;

public function resendVerification(Request $request)
{
    if ($request->user()->hasVerifiedEmail()) {
        return redirect('/dashboard');
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'تم إرسال رابط التحقق!');
}
```

---

## القسم 8: Password Reset

### مثال 32: إرسال رابط إعادة تعيين كلمة المرور

```php
use Illuminate\Support\Facades\Password;

public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
}
```

---

### مثال 33: إعادة تعيين كلمة المرور

```php
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}
```

---

## القسم 9: Rate Limiting

### مثال 34: Rate Limiting للـ Login

```php
use Illuminate\Support\Facades\RateLimiter;

public function login(Request $request)
{
    $key = 'login:' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);

        return back()->withErrors([
            'email' => "محاولات كثيرة جداً. حاول بعد {$seconds} ثانية."
        ]);
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        RateLimiter::clear($key);
        return redirect('/dashboard');
    }

    RateLimiter::hit($key, 60); // 60 ثانية

    return back()->withErrors(['email' => 'البيانات غير صحيحة']);
}
```

---

### مثال 35: Rate Limiting في Routes

```php
// 5 محاولات في الدقيقة
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

// Rate Limiter مخصص
Route::post('/api/data', [ApiController::class, 'store'])
    ->middleware('throttle:api');
```

---

## الخلاصة

هذه الأمثلة تغطي:

✅ Authentication الأساسي (Register, Login, Logout)
✅ Guards (Multi-Guard Authentication)
✅ Session Management
✅ Remember Me
✅ Gates للصلاحيات البسيطة
✅ Policies للصلاحيات المعقدة
✅ RBAC (Roles & Permissions)
✅ Email Verification
✅ Password Reset
✅ Rate Limiting

استخدم هذه الأمثلة كمرجع سريع عند العمل مع Authentication & Authorization! 🔐
