# التمارين العملية: Authentication & Authorization

## نظرة عامة

هذا الملف يحتوي على **6 تمارين متدرجة** من المستوى المبتدئ إلى المستوى المتقدم.

---

## التمرين 1: نظام تسجيل دخول بسيط ⭐

### الوصف
أنشئ نظام authentication بسيط مع تسجيل دخول وخروج.

### المتطلبات
1. صفحة تسجيل دخول
2. Validation للبيانات
3. Remember Me
4. رسالة خطأ عند فشل تسجيل الدخول
5. إعادة التوجيه لـ dashboard بعد النجاح
6. تسجيل الخروج

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

```php
// Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Controller
public function showLogin()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
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

</details>

---

## التمرين 2: Multi-Guard Authentication ⭐⭐

### الوصف
أنشئ نظام authentication منفصل للمستخدمين والإداريين.

### المتطلبات
1. جدول admins منفصل
2. Admin Model
3. Admin Guard في config/auth.php
4. صفحات login منفصلة لـ users و admins
5. Middleware للحماية
6. Dashboard منفصل لكل نوع

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

```php
// Migration
php artisan make:migration create_admins_table

Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});

// Model
php artisan make:model Admin

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];
}

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

// Admin Controller
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/admin/dashboard');
    }

    return back()->withErrors(['email' => 'البيانات غير صحيحة']);
}

// Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
```

</details>

---

## التمرين 3: Gates & Policies ⭐⭐⭐

### الوصف
أنشئ نظام صلاحيات باستخدام Gates و Policies.

### المتطلبات
1. PostPolicy مع جميع الـ methods
2. Gates للصلاحيات الإدارية
3. حماية Routes باستخدام Policies
4. عرض/إخفاء الأزرار في Blade بناءً على الصلاحيات

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

```php
// Policy
php artisan make:policy PostPolicy --model=Post

class PostPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Post $post)
    {
        if ($post->status === 'published') {
            return true;
        }
        return $user && $user->id === $post->user_id;
    }

    public function create(User $user)
    {
        return true;
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

// AuthServiceProvider
protected $policies = [
    Post::class => PostPolicy::class,
];

public function boot()
{
    Gate::define('admin-access', fn($user) => $user->is_admin);
    Gate::define('manage-users', fn($user) => $user->is_admin);
}

// Controller
public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    $post->update($request->validated());

    return redirect()->route('posts.show', $post);
}

// Routes
Route::middleware('can:admin-access')->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
});

// Blade
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

</details>

---

## التمرين 4: RBAC System ⭐⭐⭐⭐

### الوصف
أنشئ نظام RBAC كامل مع Roles و Permissions.

### المتطلبات
1. جداول roles, permissions, role_user, permission_role
2. Models للـ Role و Permission
3. Helper Methods في User Model
4. Seeder للبيانات الأولية
5. Gates ديناميكية للـ Permissions
6. Middleware للتحقق من Roles

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

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

// User Model
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
$editor->permissions()->attach([$editPosts->id]);

// Gates
foreach (Permission::all() as $permission) {
    Gate::define($permission->name, function (User $user) use ($permission) {
        return $user->hasPermission($permission->name);
    });
}

// Middleware
php artisan make:middleware CheckRole

public function handle(Request $request, Closure $next, ...$roles)
{
    if (!$request->user() || !$request->user()->hasRole($roles)) {
        abort(403);
    }
    return $next($request);
}

// Usage
Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    Route::resource('posts', PostController::class);
});
```

</details>

---

## التمرين 5: Email Verification & Password Reset ⭐⭐⭐⭐

### الوصف
أنشئ نظام تحقق من البريد الإلكتروني وإعادة تعيين كلمة المرور.

### المتطلبات
1. Email Verification
2. Password Reset
3. Rate Limiting للحماية
4. إرسال Emails
5. Views للـ Notifications

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

```php
// User Model
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ...
}

// Routes
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

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

// Password Reset
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});
```

</details>

---

## التمرين 6: نظام صلاحيات متقدم مع Audit Trail ⭐⭐⭐⭐⭐

### الوصف
أنشئ نظام صلاحيات متقدم مع تتبع جميع الإجراءات.

### المتطلبات
1. RBAC متقدم مع Hierarchical Roles
2. Permission Groups
3. Audit Trail لتتبع جميع الإجراءات
4. Admin Panel لإدارة Roles و Permissions
5. Activity Log للمستخدمين
6. IP Tracking و Device Tracking

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

```php
// Activity Log Migration
Schema::create('activity_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->string('action');
    $table->string('model_type')->nullable();
    $table->unsignedBigInteger('model_id')->nullable();
    $table->json('changes')->nullable();
    $table->ipAddress('ip_address');
    $table->string('user_agent')->nullable();
    $table->timestamps();

    $table->index(['user_id', 'created_at']);
});

// Activity Log Model
class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'model_type', 'model_id',
        'changes', 'ip_address', 'user_agent'
    ];

    protected $casts = ['changes' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}

// Trait للتتبع
trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            static::logActivity('created', $model);
        });

        static::updated(function ($model) {
            static::logActivity('updated', $model, $model->getChanges());
        });

        static::deleted(function ($model) {
            static::logActivity('deleted', $model);
        });
    }

    protected static function logActivity($action, $model, $changes = null)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'changes' => $changes,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}

// استخدام في Models
class Post extends Model
{
    use LogsActivity;
    // ...
}

// Permission Groups Migration
Schema::create('permission_groups', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('label');
    $table->timestamps();
});

Schema::table('permissions', function (Blueprint $table) {
    $table->foreignId('group_id')->nullable()->constrained('permission_groups');
});

// Role Hierarchy
Schema::table('roles', function (Blueprint $table) {
    $table->foreignId('parent_id')->nullable()->constrained('roles');
    $table->integer('level')->default(0);
});

// Admin Controller لإدارة Roles
public function assignPermission(Request $request, Role $role)
{
    $request->validate([
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $role->permissions()->sync($request->permissions);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'assigned_permissions',
        'model_type' => Role::class,
        'model_id' => $role->id,
        'changes' => ['permissions' => $request->permissions],
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
    ]);

    return back()->with('success', 'تم تحديث الصلاحيات بنجاح');
}

// عرض Activity Log
public function activityLog()
{
    $activities = ActivityLog::with('user')
        ->latest()
        ->paginate(50);

    return view('admin.activity-log', compact('activities'));
}
```

</details>

---

## الخلاصة

هذه التمارين تغطي:

✅ Authentication الأساسي
✅ Multi-Guard Authentication
✅ Gates & Policies
✅ RBAC (Roles & Permissions)
✅ Email Verification & Password Reset
✅ Audit Trail & Activity Logging
✅ Advanced Permission Management

**تحدي إضافي**: ادمج جميع هذه المفاهيم في تطبيق واحد متكامل! 🔐
