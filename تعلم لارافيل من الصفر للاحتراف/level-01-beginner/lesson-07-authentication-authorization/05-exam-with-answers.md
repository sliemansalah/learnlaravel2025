# امتحان الدرس السابع: Authentication & Authorization - مع الإجابات

**الوقت المحدد**: 90 دقيقة
**مجموع الدرجات**: 100 نقطة

---

## القسم الأول: أسئلة الاختيار من متعدد (60 نقطة)

### السؤال 1
ما هو الفرق بين Authentication و Authorization؟

A) لا يوجد فرق
B) Authentication = من أنت؟ Authorization = ماذا يمكنك أن تفعل؟
C) Authentication للإداريين و Authorization للمستخدمين
D) Authentication في الـ frontend و Authorization في الـ backend

**الإجابة الصحيحة**: B
**الشرح**: Authentication يتحقق من الهوية، بينما Authorization يتحقق من الصلاحيات.

---

### السؤال 2
ما هو الأمر لتثبيت Laravel Breeze؟

A) `composer require laravel/breeze`
B) `php artisan breeze:install`
C) `npm install breeze`
D) كل من A و B صحيح

**الإجابة الصحيحة**: D
**الشرح**: تحتاج أولاً لتثبيت package ثم تشغيل أمر install.

---

### السؤال 3
ما هي الطريقة الصحيحة لتشفير كلمة المرور؟

A) `encrypt($password)`
B) `Hash::make($password)`
C) `bcrypt($password)`
D) كل من B و C صحيح

**الإجابة الصحيحة**: D
**الشرح**: كلاهما صحيح، `bcrypt()` هو helper function لـ `Hash::make()`.

---

### السؤال 4
ما هي الطريقة لتسجيل دخول مستخدم في Laravel؟

A) `Auth::attempt($credentials)`
B) `Auth::login($user)`
C) كلاهما صحيح
D) لا شيء مما سبق

**الإجابة الصحيحة**: C
**الشرح**: `attempt()` للتحقق وتسجيل الدخول، `login()` لتسجيل دخول مباشر.

---

### السؤال 5
ماذا يفعل `$request->session()->regenerate()`؟

A) يحذف Session
B) يجدد Session ID للأمان
C) ينشئ Session جديد
D) يحفظ Session

**الإجابة الصحيحة**: B
**الشرح**: يجدد Session ID لمنع Session Fixation attacks.

---

### السؤال 6
كيف تتحقق من أن المستخدم مسجل دخول؟

A) `Auth::check()`
B) `auth()->check()`
C) `Auth::user() !== null`
D) جميع ما سبق

**الإجابة الصحيحة**: D
**الشرح**: جميعها طرق صحيحة للتحقق من تسجيل الدخول.

---

### السؤال 7
ما هو الغرض من Remember Token؟

A) تذكر كلمة المرور
B) إبقاء المستخدم مسجل دخول لفترة طويلة
C) تشفير البيانات
D) تسريع تسجيل الدخول

**الإجابة الصحيحة**: B
**الشرح**: Remember Token يسمح بتسجيل الدخول التلقائي لمدة طويلة (افتراضياً 5 سنوات).

---

### السؤال 8
ما هو Guard في Laravel Authentication؟

A) Middleware للحماية
B) نظام يحدد كيفية المصادقة على المستخدمين
C) نوع من Validation
D) نظام للصلاحيات

**الإجابة الصحيحة**: B
**الشرح**: Guard يحدد كيف يتم authentication لكل request (session, token, etc).

---

### السؤال 9
ما هو الـ Guard الافتراضي في Laravel؟

A) `admin`
B) `api`
C) `web`
D) `session`

**الإجابة الصحيحة**: C
**الشرح**: `web` guard هو الافتراضي، يستخدم sessions.

---

### السؤال 10
كيف تستخدم Admin Guard؟

A) `Auth::guard('admin')->attempt($credentials)`
B) `Auth::admin()->attempt($credentials)`
C) `Auth::useGuard('admin')`
D) `Auth::switchGuard('admin')`

**الإجابة الصحيحة**: A
**الشرح**: تستخدم `guard()` method لتحديد Guard معين.

---

### السؤال 11
ما هو Provider في Authentication؟

A) يوفر Session
B) يحدد كيفية جلب المستخدمين من قاعدة البيانات
C) يوفر Guards
D) يوفر Middleware

**الإجابة الصحيحة**: B
**الشرح**: Provider يحدد كيف يتم retrieve المستخدمين (eloquent, database).

---

### السؤال 12
ما هو Gate في Laravel؟

A) Middleware
B) Closure للتحقق من صلاحية معينة
C) نوع من Routes
D) نوع من Models

**الإجابة الصحيحة**: B
**الشرح**: Gate هو closure بسيط يحدد صلاحية معينة.

---

### السؤال 13
أين يتم تعريف Gates؟

A) في Routes
B) في AppServiceProvider أو AuthServiceProvider
C) في Controller
D) في Model

**الإجابة الصحيحة**: B
**الشرح**: يتم تعريف Gates في method `boot()` في Service Provider.

---

### السؤال 14
كيف تستخدم Gate للتحقق من صلاحية؟

A) `Gate::allows('edit-post', $post)`
B) `Gate::check('edit-post', $post)`
C) `Gate::can('edit-post', $post)`
D) `Gate::verify('edit-post', $post)`

**الإجابة الصحيحة**: A
**الشرح**: `allows()` و `denies()` هما الطريقتان الأساسيتان.

---

### السؤال 15
ما الفرق بين `Gate::allows()` و `Gate::authorize()`؟

A) لا يوجد فرق
B) `authorize()` يرمي 403 exception إذا فشل
C) `allows()` أسرع
D) `authorize()` للإداريين فقط

**الإجابة الصحيحة**: B
**الشرح**: `authorize()` يرمي exception بينما `allows()` يرجع boolean.

---

### السؤال 16
ما هو Policy في Laravel؟

A) Middleware
B) Class يجمع منطق Authorization حول Model
C) نوع من Gates
D) نظام للـ Validation

**الإجابة الصحيحة**: B
**الشرح**: Policy يُنظم authorization logic لـ Model معين.

---

### السؤال 17
ما هو الأمر لإنشاء Policy؟

A) `php artisan make:policy PostPolicy`
B) `php artisan create:policy PostPolicy`
C) `php artisan generate:policy PostPolicy`
D) `php artisan new:policy PostPolicy`

**الإجابة الصحيحة**: A
**الشرح**: `make:policy` مع اسم Policy.

---

### السؤال 18
ما هي الـ methods الشائعة في Policy؟

A) `viewAny, view, create, update, delete`
B) `index, show, store, update, destroy`
C) `list, get, post, put, delete`
D) `all, find, save, update, remove`

**الإجابة الصحيحة**: A
**الشرح**: Policy methods تتبع تسمية RESTful actions.

---

### السؤال 19
كيف تستخدم Policy في Controller؟

A) `$this->policy('update', $post)`
B) `$this->authorize('update', $post)`
C) `$this->check('update', $post)`
D) `$this->can('update', $post)`

**الإجابة الصحيحة**: B
**الشرح**: `authorize()` method في Controller.

---

### السؤال 20
ما الغرض من `before()` method في Policy؟

A) يتم تنفيذها قبل كل الـ methods
B) للتحقق الأولي (مثل Super Admin)
C) كلاهما صحيح
D) لا شيء مما سبق

**الإجابة الصحيحة**: C
**الشرح**: `before()` تُنفذ قبل كل methods وتستخدم للتحقق الشامل.

---

### السؤال 21
ما هو RBAC؟

A) Role-Based Access Control
B) Rule-Based Access Control
C) Route-Based Access Control
D) Request-Based Access Control

**الإجابة الصحيحة**: A
**الشرح**: RBAC = Role-Based Access Control (التحكم بالوصول بناءً على الأدوار).

---

### السؤال 22
في RBAC، ما العلاقة بين User و Role؟

A) One to One
B) One to Many
C) Many to Many
D) Polymorphic

**الإجابة الصحيحة**: C
**الشرح**: المستخدم يمكن أن يكون له عدة أدوار والدور يمكن أن يكون لعدة مستخدمين.

---

### السؤال 23
ما اسم الجدول الوسيط بين users و roles؟

A) `user_roles`
B) `role_user`
C) `users_roles`
D) `roles_users`

**الإجابة الصحيحة**: B
**الشرح**: Laravel تستخدم التسمية الأبجدية المفردة.

---

### السؤال 24
كيف تعين Role لمستخدم؟

A) `$user->roles()->attach($roleId)`
B) `$user->assignRole('admin')`
C) كلاهما صحيح
D) لا شيء مما سبق

**الإجابة الصحيحة**: C
**الشرح**: يمكن استخدام `attach()` أو helper method مخصص.

---

### السؤال 25
ما هو Email Verification؟

A) التحقق من صحة البريد الإلكتروني
B) إرسال رابط للتأكد من ملكية البريد
C) كلاهما صحيح
D) لا شيء مما سبق

**الإجابة الصحيحة**: C
**الشرح**: Email verification يتحقق من ملكية البريد عبر رابط.

---

### السؤال 26
ما الـ interface المطلوب لـ Email Verification؟

A) `VerifiesEmail`
B) `MustVerifyEmail`
C) `EmailVerification`
D) `RequiresEmailVerification`

**الإجابة الصحيحة**: B
**الشرح**: User Model يجب أن ينفذ `MustVerifyEmail` interface.

---

### السؤال 27
ما هو Middleware للتحقق من Email Verification؟

A) `auth`
B) `verified`
C) `email.verified`
D) `check.email`

**الإجابة الصحيحة**: B
**الشرح**: `verified` middleware يتحقق من تأكيد البريد.

---

### السؤال 28
كيف ترسل Password Reset Link؟

A) `Password::send($email)`
B) `Password::sendResetLink($email)`
C) `Auth::resetPassword($email)`
D) `User::resetPassword($email)`

**الإجابة الصحيحة**: B
**الشرح**: `Password::sendResetLink()` يرسل رابط إعادة التعيين.

---

### السؤال 29
ما هو Rate Limiting؟

A) تحديد سرعة الاتصال
B) تحديد عدد المحاولات في فترة زمنية
C) تحديد حجم البيانات
D) تحديد وقت الاستجابة

**الإجابة الصحيحة**: B
**الشرح**: Rate Limiting يحد من عدد المحاولات لمنع الهجمات.

---

### السؤال 30
كيف تطبق Rate Limiting على Route؟

A) `->middleware('throttle:5,1')`
B) `->rateLimit(5)`
C) `->limit(5, 1)`
D) `->maxAttempts(5)`

**الإجابة الصحيحة**: A
**الشرح**: `throttle:5,1` = 5 محاولات في 1 دقيقة.

---

## القسم الثاني: صح أو خطأ (20 نقطة)

### السؤال 31
Authentication يتحقق من هوية المستخدم.

**الإجابة**: صح
**الشرح**: Authentication = التحقق من الهوية.

---

### السؤال 32
Laravel Breeze أثقل وأكثر ميزات من Jetstream.

**الإجابة**: خطأ
**الشرح**: Breeze أبسط وأخف، Jetstream أكثر ميزات.

---

### السؤال 33
يجب تشفير كلمة المرور قبل حفظها في قاعدة البيانات.

**الإجابة**: صح
**الشرح**: يجب استخدام `Hash::make()` أو `bcrypt()`.

---

### السؤال 34
`Auth::attempt()` يسجل دخول المستخدم تلقائياً إذا نجح.

**الإجابة**: صح
**الشرح**: `attempt()` يتحقق ويسجل الدخول إذا كانت البيانات صحيحة.

---

### السؤال 35
Remember Token صالح لمدة 24 ساعة افتراضياً.

**الإجابة**: خطأ
**الشرح**: صالح لمدة 5 سنوات افتراضياً.

---

### السؤال 36
يمكن للتطبيق الواحد استخدام عدة Guards.

**الإجابة**: صح
**الشرح**: يمكن استخدام Multiple Guards (web, admin, api).

---

### السؤال 37
Gate يمكن أن يُعرف في Controller.

**الإجابة**: خطأ
**الشرح**: يُعرف في ServiceProvider وليس Controller.

---

### السؤال 38
Policy تُسجل تلقائياً إذا اتبعت التسمية القياسية.

**الإجابة**: صح
**الشرح**: Laravel تكتشف Policies تلقائياً بناءً على التسمية.

---

### السؤال 39
`@can` directive متاح فقط في Controllers.

**الإجابة**: خطأ
**الشرح**: `@can` متاح في Blade views.

---

### السؤال 40
في RBAC، Role يمكن أن يكون له عدة Permissions.

**الإجابة**: صح
**الشرح**: علاقة Many to Many بين Roles و Permissions.

---

### السؤال 41
المستخدم يمكن أن يكون له دور واحد فقط.

**الإجابة**: خطأ
**الشرح**: يمكن للمستخدم أن يكون له عدة أدوار.

---

### السؤال 42
Email Verification اختياري ويمكن تعطيله.

**الإجابة**: صح
**الشرح**: يمكن عدم استخدام `MustVerifyEmail` interface.

---

### السؤال 43
`verified` middleware يسمح فقط للمستخدمين المؤكدين بالوصول.

**الإجابة**: صح
**الشرح**: يمنع الوصول للمستخدمين غير المؤكدين.

---

### السؤال 44
Password Reset يحتاج جدول خاص في قاعدة البيانات.

**الإجابة**: صح
**الشرح**: يحتاج `password_reset_tokens` table.

---

### السؤال 45
Rate Limiting يمنع Brute Force Attacks.

**الإجابة**: صح
**الشرح**: يحد من محاولات التخمين المتكررة.

---

### السؤال 46
`Auth::logout()` يحذف المستخدم من قاعدة البيانات.

**الإجابة**: خطأ
**الشرح**: فقط ينهي الـ session.

---

### السؤال 47
Session ID يجب تجديده بعد Login للأمان.

**الإجابة**: صح
**الشرح**: لمنع Session Fixation attacks.

---

### السؤال 48
Guest middleware يسمح فقط للمستخدمين المسجلين.

**الإجابة**: خطأ
**الشرح**: يسمح فقط للزوار (غير المسجلين).

---

### السؤال 49
يمكن استخدام `?User` في Policy للسماح بـ Guest users.

**الإجابة**: صح
**الشرح**: `?` يجعل المعامل nullable.

---

### السؤال 50
`before()` method في Policy تعمل بعد كل الـ methods.

**الإجابة**: خطأ
**الشرح**: تعمل **قبل** كل الـ methods.

---

## القسم الثالث: أسئلة مقالية وبرمجة (20 نقطة)

### السؤال 51
اشرح الفرق بين Gate و Policy، ومتى تستخدم كل منهما؟

**الإجابة**:

**Gate:**
- Closure بسيط للصلاحيات
- يُستخدم للصلاحيات البسيطة أو العامة
- يُعرف في ServiceProvider
- مثال: التحقق من أن المستخدم admin

**Policy:**
- Class منظم للصلاحيات
- يُستخدم للصلاحيات المعقدة المرتبطة بـ Model
- methods منظمة (viewAny, view, create, etc)
- مثال: صلاحيات CRUD على Post

**متى تستخدم:**
- **Gate**: صلاحيات بسيطة أو عامة (admin-only, view-dashboard)
- **Policy**: صلاحيات معقدة مرتبطة بـ Model (edit post, delete comment)

---

### السؤال 52
اكتب كود كامل لنظام تسجيل دخول مع Remember Me وتجديد Session.

**الإجابة**:

```php
// Controller
public function showLogin()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
        // تجديد Session ID للأمان
        $request->session()->regenerate();

        // تحديث آخر تسجيل دخول
        auth()->user()->update(['last_login_at' => now()]);

        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'البيانات المدخلة غير صحيحة.',
    ])->onlyInput('email');
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
```

```blade
{{-- View --}}
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label>كلمة المرور</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">تذكرني</label>
    </div>

    <button type="submit">تسجيل الدخول</button>
</form>
```

---

### السؤال 53
اكتب كود PostPolicy كامل يتضمن جميع الـ methods الأساسية مع before method للـ Admin.

**الإجابة**:

```php
// app/Policies/PostPolicy.php
namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    /**
     * Admin يمكنه كل شيء
     */
    public function before(User $user, string $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * رؤية جميع المقالات
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * رؤية مقالة واحدة
     */
    public function view(?User $user, Post $post)
    {
        // المقالات المنشورة للجميع
        if ($post->status === 'published') {
            return true;
        }

        // المسودات لصاحبها فقط
        return $user && $user->id === $post->user_id;
    }

    /**
     * إنشاء مقالة
     */
    public function create(User $user)
    {
        // أي مستخدم مسجل
        return true;
    }

    /**
     * تعديل مقالة
     */
    public function update(User $user, Post $post)
    {
        // صاحب المقالة فقط
        return $user->id === $post->user_id;
    }

    /**
     * حذف مقالة
     */
    public function delete(User $user, Post $post)
    {
        // صاحب المقالة فقط
        return $user->id === $post->user_id;
    }

    /**
     * استعادة مقالة محذوفة
     */
    public function restore(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * حذف نهائي
     */
    public function forceDelete(User $user, Post $post)
    {
        // Admin فقط (سيتم السماح عبر before)
        return false;
    }
}
```

---

### السؤال 54
اكتب كود نظام RBAC كامل يتضمن: Models، Migrations، Helper Methods، وأمثلة استخدام.

**الإجابة**:

```php
// Migrations
Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->string('label');
    $table->timestamps();
});

Schema::create('permissions', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->string('label');
    $table->timestamps();
});

Schema::create('role_user', function (Blueprint $table) {
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->primary(['role_id', 'user_id']);
});

Schema::create('permission_role', function (Blueprint $table) {
    $table->foreignId('permission_id')->constrained()->onDelete('cascade');
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
    $table->primary(['permission_id', 'role_id']);
});

// Role Model
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

// Permission Model
class Permission extends Model
{
    protected $fillable = ['name', 'label'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

// User Model - Helper Methods
public function roles()
{
    return $this->belongsToMany(Role::class);
}

public function hasRole($role)
{
    return $this->roles->contains('name', $role);
}

public function hasPermission($permission)
{
    return $this->roles->flatMap->permissions->contains('name', $permission);
}

public function assignRole($role)
{
    $roleModel = is_string($role)
        ? Role::where('name', $role)->firstOrFail()
        : $role;
    return $this->roles()->syncWithoutDetaching($roleModel);
}

// Seeder
$admin = Role::create(['name' => 'admin', 'label' => 'مدير']);
$editor = Role::create(['name' => 'editor', 'label' => 'محرر']);

$manageUsers = Permission::create(['name' => 'manage-users', 'label' => 'إدارة المستخدمين']);
$editPosts = Permission::create(['name' => 'edit-posts', 'label' => 'تعديل المقالات']);

$admin->permissions()->attach([$manageUsers->id, $editPosts->id]);

// استخدام
$user->assignRole('admin');

if ($user->hasRole('admin')) {
    // المستخدم admin
}

if ($user->hasPermission('edit-posts')) {
    // يمكنه تعديل المقالات
}
```

---

### السؤال 55
اشرح كيف يعمل Email Verification في Laravel واكتب الكود المطلوب لتفعيله.

**الإجابة**:

**كيف يعمل:**
1. المستخدم يسجل حساب جديد
2. Laravel يرسل email مع رابط موقع
3. المستخدم يضغط الرابط
4. Laravel يتحقق من التوقيع ويؤكد البريد
5. يُحدث `email_verified_at` في قاعدة البيانات

**الكود المطلوب:**

```php
// 1. User Model
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ...
}

// 2. Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'تم إرسال رابط التحقق!');
    })->middleware('throttle:6,1')->name('verification.send');
});

// 3. حماية Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

// 4. في Controller بعد التسجيل
public function register(Request $request)
{
    $user = User::create($request->validated());

    Auth::login($user);

    // إرسال email verification
    $user->sendEmailVerificationNotification();

    return redirect('/email/verify');
}
```

---

## الخلاصة

هذا الامتحان يغطي:

✅ Authentication (Login, Logout, Register)
✅ Guards & Providers
✅ Session Management
✅ Gates & Policies
✅ RBAC (Roles & Permissions)
✅ Email Verification
✅ Password Reset
✅ Rate Limiting
✅ Best Practices

**تهانينا على إكمال الامتحان!** 🔐
