# التطبيق العملي: نظام إدارة محتوى مع RBAC

## نظرة عامة

في هذا التطبيق سنبني **نظام إدارة محتوى (CMS) متكامل** يتضمن:

- ✅ Authentication (تسجيل، دخول، خروج)
- ✅ Multi-Guard Authentication (Users & Admins)
- ✅ Role-Based Access Control (Admin, Editor, Author, User)
- ✅ Permissions System
- ✅ Gates & Policies
- ✅ Admin Panel
- ✅ Email Verification
- ✅ Password Reset
- ✅ Remember Me
- ✅ Profile Management

---

## خطوات التطبيق

### الخطوة 1: إعداد المشروع

```bash
# إنشاء مشروع Laravel جديد
laravel new cms-system
cd cms-system

# إعداد قاعدة البيانات في .env
DB_DATABASE=cms_system
DB_USERNAME=root
DB_PASSWORD=
```

---

### الخطوة 2: إنشاء Migrations

#### تعديل Users Migration

```bash
php artisan make:migration add_fields_to_users_table
```

```php
// database/migrations/xxxx_add_fields_to_users_table.php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->unique()->after('id');
        $table->string('avatar')->nullable()->after('email');
        $table->boolean('is_active')->default(true)->after('avatar');
        $table->timestamp('last_login_at')->nullable()->after('is_active');
    });
}
```

#### إنشاء Admins Table

```bash
php artisan make:migration create_admins_table
```

```php
public function up()
{
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
```

#### إنشاء RBAC Tables

```bash
php artisan make:migration create_roles_and_permissions_tables
```

```php
public function up()
{
    // Roles Table
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('label')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });

    // Permissions Table
    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('label')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });

    // Role_User Pivot Table
    Schema::create('role_user', function (Blueprint $table) {
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        $table->primary(['role_id', 'user_id']);
    });

    // Permission_Role Pivot Table
    Schema::create('permission_role', function (Blueprint $table) {
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        $table->primary(['permission_id', 'role_id']);
    });
}
```

#### إنشاء Posts Table

```bash
php artisan make:migration create_posts_table
```

```php
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('content');
        $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}
```

**تنفيذ Migrations:**

```bash
php artisan migrate
```

---

### الخطوة 3: إنشاء Models

#### User Model

```php
// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    // Helper Methods
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return (bool) $role->intersect($this->roles)->count();
    }

    public function hasAnyRole($roles)
    {
        return $this->roles->whereIn('name', $roles)->count() > 0;
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

    public function removeRole($role)
    {
        $roleModel = is_string($role)
            ? Role::where('name', $role)->firstOrFail()
            : $role;

        return $this->roles()->detach($roleModel);
    }

    public function syncRoles($roles)
    {
        return $this->roles()->sync($roles);
    }
}
```

#### Admin Model

```php
// app/Models/Admin.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
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
        'password' => 'hashed',
    ];
}
```

#### Role Model

```php
// app/Models/Role.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function givePermissionTo($permission)
    {
        $permissionModel = is_string($permission)
            ? Permission::where('name', $permission)->firstOrFail()
            : $permission;

        return $this->permissions()->syncWithoutDetaching($permissionModel);
    }

    public function revokePermissionTo($permission)
    {
        $permissionModel = is_string($permission)
            ? Permission::where('name', $permission)->firstOrFail()
            : $permission;

        return $this->permissions()->detach($permissionModel);
    }
}
```

#### Permission Model

```php
// app/Models/Permission.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
```

#### Post Model

```php
// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mutators
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return [
                    'title' => $value,
                    'slug' => Str::slug($value),
                ];
            }
        );
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
```

---

### الخطوة 4: إنشاء Seeders

#### RolesAndPermissionsSeeder

```bash
php artisan make:seeder RolesAndPermissionsSeeder
```

```php
// database/seeders/RolesAndPermissionsSeeder.php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // إنشاء الصلاحيات
        $permissions = [
            ['name' => 'view-posts', 'label' => 'عرض المقالات'],
            ['name' => 'create-posts', 'label' => 'إنشاء مقالات'],
            ['name' => 'edit-posts', 'label' => 'تعديل المقالات'],
            ['name' => 'delete-posts', 'label' => 'حذف المقالات'],
            ['name' => 'publish-posts', 'label' => 'نشر المقالات'],
            ['name' => 'manage-users', 'label' => 'إدارة المستخدمين'],
            ['name' => 'manage-roles', 'label' => 'إدارة الأدوار'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // إنشاء الأدوار
        $admin = Role::create([
            'name' => 'admin',
            'label' => 'مدير',
            'description' => 'صلاحيات كاملة على النظام',
        ]);

        $editor = Role::create([
            'name' => 'editor',
            'label' => 'محرر',
            'description' => 'يمكنه إدارة المقالات',
        ]);

        $author = Role::create([
            'name' => 'author',
            'label' => 'كاتب',
            'description' => 'يمكنه إنشاء وتعديل مقالاته فقط',
        ]);

        $user = Role::create([
            'name' => 'user',
            'label' => 'مستخدم',
            'description' => 'مستخدم عادي',
        ]);

        // ربط الصلاحيات بالأدوار
        $admin->permissions()->attach(Permission::all());

        $editor->permissions()->attach(
            Permission::whereIn('name', [
                'view-posts',
                'create-posts',
                'edit-posts',
                'delete-posts',
                'publish-posts',
            ])->get()
        );

        $author->permissions()->attach(
            Permission::whereIn('name', [
                'view-posts',
                'create-posts',
                'edit-posts',
            ])->get()
        );

        $user->permissions()->attach(
            Permission::where('name', 'view-posts')->get()
        );
    }
}
```

#### UsersSeeder

```bash
php artisan make:seeder UsersSeeder
```

```php
// database/seeders/UsersSeeder.php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $admin->assignRole('admin');

        // Editor User
        $editor = User::create([
            'name' => 'Editor User',
            'username' => 'editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $editor->assignRole('editor');

        // Author User
        $author = User::create([
            'name' => 'Author User',
            'username' => 'author',
            'email' => 'author@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $author->assignRole('author');

        // Regular User
        $user = User::create([
            'name' => 'Regular User',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $user->assignRole('user');
    }
}
```

```php
// database/seeders/DatabaseSeeder.php
public function run()
{
    $this->call([
        RolesAndPermissionsSeeder::class,
        UsersSeeder::class,
    ]);
}
```

**تنفيذ Seeders:**

```bash
php artisan db:seed
```

---

### الخطوة 5: تكوين Authentication

#### config/auth.php

```php
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

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
```

---

### الخطوة 6: إنشاء Policies

#### PostPolicy

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
    /**
     * Super Admin يمكنه كل شيء
     */
    public function before(User $user, string $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * يمكن للجميع رؤية المقالات المنشورة
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
        if ($post->status === 'published') {
            return true;
        }

        return $user && $user->id === $post->user_id;
    }

    /**
     * إنشاء مقالة - يحتاج صلاحية create-posts
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-posts');
    }

    /**
     * تعديل - صاحب المقالة أو Editor
     */
    public function update(User $user, Post $post)
    {
        if ($user->id === $post->user_id) {
            return $user->hasPermission('edit-posts');
        }

        return $user->hasRole('editor');
    }

    /**
     * حذف - صاحب المقالة أو Editor
     */
    public function delete(User $user, Post $post)
    {
        if ($user->id === $post->user_id) {
            return $user->hasPermission('delete-posts');
        }

        return $user->hasRole('editor');
    }

    /**
     * نشر - Editor فقط
     */
    public function publish(User $user, Post $post)
    {
        return $user->hasPermission('publish-posts');
    }
}
```

---

### الخطوة 7: إنشاء Gates

```php
// app/Providers/AuthServiceProvider.php
namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    public function boot()
    {
        // Gate للتحقق من الأدوار
        Gate::define('admin-access', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('editor-access', function ($user) {
            return $user->hasAnyRole(['admin', 'editor']);
        });

        // Gates للصلاحيات
        Gate::define('manage-users', function ($user) {
            return $user->hasPermission('manage-users');
        });

        Gate::define('manage-roles', function ($user) {
            return $user->hasPermission('manage-roles');
        });
    }
}
```

---

### الخطوة 8: إنشاء Middleware

#### EnsureUserHasRole

```bash
php artisan make:middleware EnsureUserHasRole
```

```php
// app/Http/Middleware/EnsureUserHasRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            abort(403, 'يجب تسجيل الدخول');
        }

        if (!$request->user()->hasAnyRole($roles)) {
            abort(403, 'غير مصرح لك بالوصول');
        }

        return $next($request);
    }
}
```

#### تسجيل Middleware

```php
// app/Http/Kernel.php
protected $middlewareAliases = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'role' => \App\Http\Middleware\EnsureUserHasRole::class,
    // ...
];
```

---

### الخطوة 9: إنشاء Controllers

#### AuthController

```php
// app/Http/Controllers/Auth/AuthController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
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
            $request->session()->regenerate();

            // تحديث آخر تسجيل دخول
            auth()->user()->update(['last_login_at' => now()]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'البيانات المدخلة غير صحيحة.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create($validated);

        // تعيين Role افتراضي
        $user->assignRole('user');

        Auth::login($user);

        return redirect('dashboard')->with('success', 'مرحباً بك!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
```

#### PostController

```php
// app/Http/Controllers/PostController.php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::with('user')
            ->published()
            ->latest()
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

        $post = auth()->user()->posts()->create($validated);

        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function publish(Post $post)
    {
        $this->authorize('publish', $post);

        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return back()->with('success', 'تم نشر المقالة');
    }
}
```

---

### الخطوة 10: إنشاء Routes

```php
// routes/web.php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Posts Routes
Route::resource('posts', PostController::class);
Route::post('/posts/{post}/publish', [PostController::class, 'publish'])
    ->name('posts.publish')
    ->middleware('can:publish,post');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');
});
```

---

## الخلاصة

في هذا التطبيق العملي قمنا بتطبيق:

✅ **Manual Authentication** (Register, Login, Logout)
✅ **Multi-Guard Authentication** (User & Admin)
✅ **Role-Based Access Control** (Admin, Editor, Author, User)
✅ **Permissions System**
✅ **Gates** للصلاحيات البسيطة
✅ **Policies** للصلاحيات المعقدة
✅ **Custom Middleware** للحماية
✅ **Email Verification** (implements MustVerifyEmail)
✅ **Remember Me**
✅ **Last Login Tracking**

هذا النظام يمثل تطبيقاً حقيقياً متكاملاً للـ Authentication & Authorization! 🔐
