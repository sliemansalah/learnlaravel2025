# الدرس 9 - بطاقة مرجعية سريعة: المصادقة والترخيص

## 🚀 الأوامر الأساسية

```bash
# تثبيت Laravel Breeze
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev
php artisan migrate

# إنشاء Policy
php artisan make:policy PostPolicy
php artisan make:policy PostPolicy --model=Post

# إنشاء Middleware
php artisan make:middleware EnsureUserIsAdmin

# تثبيت Sanctum (رموز API)
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

---

## 🔐 أساسيات المصادقة

```php
// التحقق إذا كان المستخدم مسجل دخول
auth()->check()          // يُرجع true/false
auth()->guest()          // يُرجع true إذا لم يكن مسجلاً
auth()->user()           // الحصول على المستخدم الحالي
auth()->id()             // الحصول على ID المستخدم

// تسجيل الدخول
Auth::attempt(['email' => $email, 'password' => $password])
Auth::attempt($credentials, $remember = true)  // مع تذكرني
Auth::login($user)
Auth::loginUsingId(1)

// تسجيل الخروج
Auth::logout()
$request->session()->invalidate()
$request->session()->regenerateToken()
```

---

## 🛡️ الترخيص - Gates

```php
// تعريف Gate (في AppServiceProvider)
Gate::define('update-post', function (User $user, Post $post) {
    return $user->id === $post->user_id;
});

// استخدام Gate
Gate::allows('update-post', $post)      // يُرجع true/false
Gate::denies('update-post', $post)       // يُرجع true/false
Gate::authorize('update-post', $post)    // يرمي 403 إذا رفض

// في Blade
@can('update-post', $post)
    <a href="#">تعديل</a>
@endcan

@cannot('update-post', $post)
    <p>لا يمكنك التعديل</p>
@endcannot
```

---

## 📋 Policies (السياسات)

```php
// إنشاء Policy
php artisan make:policy PostPolicy --model=Post

// دوال Policy
public function viewAny(User $user): bool
public function view(?User $user, Post $post): bool
public function create(User $user): bool
public function update(User $user, Post $post): bool
public function delete(User $user, Post $post): bool
public function restore(User $user, Post $post): bool
public function forceDelete(User $user, Post $post): bool

// استخدام Policy في Controller
$this->authorize('update', $post);
$this->authorize('create', Post::class);

// استخدام Policy في Blade
@can('update', $post)
    <button>تعديل</button>
@endcan
```

---

## 🔒 الوسيط (Middleware)

```php
// في المسارات
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/premium', [PremiumController::class, 'index']);
});

// في Controller
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('auth')->only(['create', 'store']);
    $this->middleware('auth')->except(['index', 'show']);
}
```

---

## 🔑 إدارة كلمات المرور

```php
// تشفير كلمة المرور
use Illuminate\Support\Facades\Hash;

$hashed = Hash::make('password');

// التحقق من كلمة المرور
Hash::check('plain-text', $hashedPassword)

// قاعدة التحقق لكلمة المرور الحالية
$request->validate([
    'current_password' => 'required|current_password',
    'password' => 'required|string|min:8|confirmed',
]);
```

---

## 🎫 رموز API (Sanctum)

```php
// في User Model
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
}

// إنشاء رمز
$token = $user->createToken('token-name')->plainTextToken;

// إنشاء رمز مع صلاحيات
$token = $user->createToken('token-name', ['posts:create', 'posts:update'])
              ->plainTextToken;

// حماية المسارات
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// التحقق من صلاحية الرمز
if ($request->user()->tokenCan('posts:create')) {
    // يمكنه الإنشاء
}

// حذف الرمز (تسجيل خروج)
$request->user()->currentAccessToken()->delete();
```

---

## 👤 توجيهات Blade

```php
// المصادقة
@auth
    <p>مرحباً {{ auth()->user()->name }}</p>
@endauth

@guest
    <a href="{{ route('login') }}">تسجيل الدخول</a>
@endguest

// الترخيص
@can('update', $post)
    <button>تعديل</button>
@endcan

@cannot('delete', $post)
    <p>لا يمكنك الحذف</p>
@endcannot

// التحقق من الدور
@if(auth()->user()->role === 'admin')
    <a href="/admin">لوحة الإدارة</a>
@endif
```

---

## 🔄 إدارة الجلسات

```php
// إعادة توليد الجلسة (منع تثبيت الجلسة)
$request->session()->regenerate();

// إلغاء الجلسة
$request->session()->invalidate();

// إعادة توليد رمز CSRF
$request->session()->regenerateToken();

// تسجيل خروج كامل
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
```

---

## 📝 أنماط شائعة

### متحكم تسجيل الدخول
```php
public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors(['email' => 'بيانات غير صحيحة']);
}
```

### متحكم التسجيل
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);
    return redirect('/dashboard');
}
```

### متحكم الموارد مع الترخيص
```php
public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    $post->update($request->validated());

    return redirect()->route('posts.show', $post);
}
```

---

## ⚡ نصائح سريعة

1. **استخدم دائماً `$this->authorize()`** في المتحكمات لفحوصات الترخيص
2. **أعد توليد الجلسة** عند تسجيل الدخول لمنع تثبيت الجلسة
3. **استخدم Hash::make()** لكلمات المرور، أبداً نص عادي
4. **تحقق من auth()->check()** قبل استخدام auth()->user()
5. **استخدم Policies** للمنطق المعقد للترخيص
6. **الوسيط 'auth'** يحمي المسارات التي تتطلب تسجيل دخول
7. **الوسيط 'guest'** لصفحات تسجيل الدخول/التسجيل فقط
8. **تذكر إلغاء الجلسة** عند تسجيل الخروج

---

## 🎯 حالات استخدام شائعة

```php
// التحقق إذا كان المستخدم يملك المنشور
return $user->id === $post->user_id;

// التحقق إذا كان مديراً
return $user->role === 'admin';

// التحقق إذا كان البريد مؤكداً
return $user->email_verified_at !== null;

// التحقق إذا كان يمكنه الإشراف
return in_array($user->role, ['admin', 'moderator']);

// المدير الأعلى يمكنه كل شيء
public function before(User $user, string $ability): ?bool
{
    if ($user->role === 'super-admin') {
        return true;
    }
    return null;
}
```

---

## ✅ قائمة التحقق - الدرس 9

- [ ] فهم الفرق بين المصادقة والترخيص
- [ ] تثبيت وإعداد Laravel Breeze
- [ ] تنفيذ تسجيل الدخول/التسجيل/الخروج
- [ ] إنشاء واستخدام Gates
- [ ] إنشاء واستخدام Policies
- [ ] استخدام وسيط auth
- [ ] تنفيذ إدارة كلمات المرور
- [ ] استخدام Sanctum لمصادقة API
- [ ] فهم إدارة الجلسات

---

## 💡 النقاط الرئيسية

1. **المصادقة** = من أنت؟ (تسجيل الدخول/التسجيل)
2. **الترخيص** = ماذا يمكنك فعله؟ (الصلاحيات)
3. **Gates** = فحوصات أذونات بسيطة
4. **Policies** = أذونات منظمة للنماذج
5. **Middleware** = حماية المسارات
6. **Sanctum** = مصادقة رموز API
7. دائماً **authorize()** في المتحكمات
8. دائماً **أعد توليد الجلسة** عند تسجيل الدخول

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [README بالإنجليزية](./README-EN.md)
- [دليل التطبيق](./PRACTICE-GUIDE-AR.md)
- [الاختبار الكامل](./FULL-EXAM-100-QUESTIONS.md)
- [الدرس التالي](../lesson-10/README.md)
