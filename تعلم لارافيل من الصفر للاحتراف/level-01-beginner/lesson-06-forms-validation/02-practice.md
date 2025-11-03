# التطبيق العملي: نظام إدارة المدونة الشامل

## نظرة عامة

في هذا التطبيق سنبني **نظام إدارة مدونة متكامل** يتضمن:

- ✅ تسجيل المستخدمين مع Validation معقد
- ✅ تسجيل الدخول مع Remember Me
- ✅ إدارة الملف الشخصي مع رفع الصور
- ✅ إدارة المقالات (CRUD) مع Form Requests
- ✅ التعليقات مع Validation متقدم
- ✅ إعدادات المستخدم
- ✅ Custom Validation Rules
- ✅ File Upload مع معاينة

---

## خطوات التطبيق

### الخطوة 1: إعداد المشروع

```bash
# إنشاء مشروع Laravel جديد
laravel new blog-system
cd blog-system

# إعداد قاعدة البيانات في .env
DB_DATABASE=blog_system
DB_USERNAME=root
DB_PASSWORD=
```

---

### الخطوة 2: إنشاء Migrations

#### Migration للمستخدمين (Users)

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
        $table->text('bio')->nullable()->after('avatar');
        $table->string('phone')->nullable()->after('bio');
        $table->date('birth_date')->nullable()->after('phone');
        $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('birth_date');
        $table->string('website')->nullable()->after('gender');
        $table->boolean('is_active')->default(true)->after('website');
        $table->timestamp('email_verified_at')->nullable()->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'username', 'avatar', 'bio', 'phone',
            'birth_date', 'gender', 'website', 'is_active'
        ]);
    });
}
```

#### Migration للمقالات (Posts)

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
        $table->text('excerpt')->nullable();
        $table->longText('content');
        $table->string('featured_image')->nullable();
        $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
        $table->timestamp('published_at')->nullable();
        $table->unsignedInteger('views_count')->default(0);
        $table->timestamps();
        $table->softDeletes();

        $table->index(['status', 'published_at']);
    });
}
```

#### Migration للتعليقات (Comments)

```bash
php artisan make:migration create_comments_table
```

```php
public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->string('author_name')->nullable();
        $table->string('author_email')->nullable();
        $table->text('content');
        $table->boolean('is_approved')->default(false);
        $table->ipAddress('ip_address')->nullable();
        $table->timestamps();

        $table->index(['post_id', 'is_approved']);
    });
}
```

#### Migration لإعدادات المستخدم (User Settings)

```bash
php artisan make:migration create_user_settings_table
```

```php
public function up()
{
    Schema::create('user_settings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
        $table->boolean('email_notifications')->default(true);
        $table->boolean('comment_notifications')->default(true);
        $table->enum('theme', ['light', 'dark', 'auto'])->default('auto');
        $table->string('language', 5)->default('ar');
        $table->timestamps();
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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'bio',
        'phone',
        'birth_date',
        'gender',
        'website',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    // Accessors
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->avatar
                ? asset('storage/' . $this->avatar)
                : asset('images/default-avatar.png')
        );
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birth_date?->age
        );
    }

    // Mutators
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
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
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    // Accessors
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image
                ? asset('storage/' . $this->featured_image)
                : asset('images/default-post.png')
        );
    }

    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: fn () => ceil(str_word_count($this->content) / 200) . ' دقائق'
        );
    }

    // Mutators
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $this->attributes['title'] = $value;
                $this->attributes['slug'] = Str::slug($value);
                return $value;
            }
        );
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeByAuthor($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function isPublished()
    {
        return $this->status === 'published' && $this->published_at <= now();
    }
}
```

#### Comment Model

```php
// app/Models/Comment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'author_name',
        'author_email',
        'content',
        'is_approved',
        'ip_address',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Relationships
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getAuthorAttribute()
    {
        return $this->user ? $this->user->name : $this->author_name;
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }
}
```

#### UserSetting Model

```php
// app/Models/UserSetting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_notifications',
        'comment_notifications',
        'theme',
        'language',
    ];

    protected $casts = [
        'email_notifications' => 'boolean',
        'comment_notifications' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

---

### الخطوة 4: إنشاء Custom Validation Rules

#### Rule للتحقق من Username

```bash
php artisan make:rule ValidUsername
```

```php
// app/Rules/ValidUsername.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidUsername implements Rule
{
    public function passes($attribute, $value)
    {
        // يجب أن يبدأ بحرف، ويحتوي فقط على أحرف وأرقام و underscore
        return preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $value);
    }

    public function message()
    {
        return 'اسم المستخدم يجب أن يبدأ بحرف ويحتوي فقط على أحرف، أرقام، و underscore.';
    }
}
```

#### Rule للتحقق من Phone السعودي

```bash
php artisan make:rule SaudiPhone
```

```php
// app/Rules/SaudiPhone.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SaudiPhone implements Rule
{
    public function passes($attribute, $value)
    {
        // رقم سعودي: يبدأ بـ 05 ويتبعه 8 أرقام
        return preg_match('/^05[0-9]{8}$/', $value);
    }

    public function message()
    {
        return 'رقم الجوال يجب أن يكون رقم سعودي صحيح (05xxxxxxxx).';
    }
}
```

#### Rule للتحقق من كلمات غير مرغوبة

```bash
php artisan make:rule NoForbiddenWords
```

```php
// app/Rules/NoForbiddenWords.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    protected $forbiddenWords = [
        'spam', 'inappropriate', 'banned',
    ];

    public function passes($attribute, $value)
    {
        foreach ($this->forbiddenWords as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'المحتوى يحتوي على كلمات غير مسموحة.';
    }
}
```

---

### الخطوة 5: إنشاء Form Requests

#### RegisterRequest

```bash
php artisan make:request Auth/RegisterRequest
```

```php
// app/Http/Requests/Auth/RegisterRequest.php
namespace App\Http\Requests\Auth;

use App\Rules\ValidUsername;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users', new ValidUsername],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'terms' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم الكامل مطلوب',
            'username.required' => 'اسم المستخدم مطلوب',
            'username.unique' => 'اسم المستخدم مستخدم مسبقاً',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'terms.accepted' => 'يجب الموافقة على الشروط والأحكام',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'username' => strtolower(trim($this->username)),
            'email' => strtolower(trim($this->email)),
        ]);
    }
}
```

#### UpdateProfileRequest

```bash
php artisan make:request Profile/UpdateProfileRequest
```

```php
// app/Http/Requests/Profile/UpdateProfileRequest.php
namespace App\Http\Requests\Profile;

use App\Rules\SaudiPhone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users')->ignore($userId)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId)
            ],
            'bio' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', new SaudiPhone],
            'birth_date' => ['nullable', 'date', 'before:today', 'after:1900-01-01'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'website' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت',
            'avatar.mimes' => 'الصورة يجب أن تكون بصيغة jpeg, png, أو jpg',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',
            'website.url' => 'رابط الموقع غير صحيح',
        ];
    }
}
```

#### StorePostRequest

```bash
php artisan make:request Post/StorePostRequest
```

```php
// app/Http/Requests/Post/StorePostRequest.php
namespace App\Http\Requests\Post;

use App\Rules\NoForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', new NoForbiddenWords],
            'content' => ['required', 'string', 'min:100', new NoForbiddenWords],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['required_if:status,published', 'nullable', 'date', 'after_or_equal:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان المقالة مطلوب',
            'title.max' => 'عنوان المقالة لا يمكن أن يتجاوز 255 حرف',
            'content.required' => 'محتوى المقالة مطلوب',
            'content.min' => 'محتوى المقالة يجب أن يكون 100 حرف على الأقل',
            'featured_image.max' => 'حجم الصورة البارزة يجب أن لا يتجاوز 5 ميجابايت',
            'status.in' => 'حالة المقالة غير صحيحة',
            'published_at.required_if' => 'تاريخ النشر مطلوب عند نشر المقالة',
            'published_at.after_or_equal' => 'تاريخ النشر يجب أن يكون في الحاضر أو المستقبل',
        ];
    }

    protected function prepareForValidation()
    {
        // إذا كانت draft، تعيين published_at إلى null
        if ($this->status === 'draft') {
            $this->merge(['published_at' => null]);
        }

        // إذا لم يتم توفير excerpt، نستخرجه من المحتوى
        if (!$this->excerpt && $this->content) {
            $this->merge([
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($this->content), 200)
            ]);
        }
    }
}
```

#### UpdatePostRequest

```bash
php artisan make:request Post/UpdatePostRequest
```

```php
// app/Http/Requests/Post/UpdatePostRequest.php
namespace App\Http\Requests\Post;

use App\Rules\NoForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post = $this->route('post');
        return $post && $this->user()->id === $post->user_id;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', new NoForbiddenWords],
            'content' => ['required', 'string', 'min:100', new NoForbiddenWords],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['required_if:status,published', 'nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان المقالة مطلوب',
            'content.required' => 'محتوى المقالة مطلوب',
            'content.min' => 'محتوى المقالة يجب أن يكون 100 حرف على الأقل',
        ];
    }
}
```

#### StoreCommentRequest

```bash
php artisan make:request Comment/StoreCommentRequest
```

```php
// app/Http/Requests/Comment/StoreCommentRequest.php
namespace App\Http\Requests\Comment;

use App\Rules\NoForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // يمكن للجميع التعليق
    }

    public function rules(): array
    {
        $rules = [
            'content' => ['required', 'string', 'min:10', 'max:1000', new NoForbiddenWords],
        ];

        // إذا كان المستخدم غير مسجل، نطلب الاسم والبريد
        if (!auth()->check()) {
            $rules['author_name'] = ['required', 'string', 'max:100'];
            $rules['author_email'] = ['required', 'email', 'max:255'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'content.required' => 'محتوى التعليق مطلوب',
            'content.min' => 'التعليق يجب أن يكون 10 أحرف على الأقل',
            'content.max' => 'التعليق لا يمكن أن يتجاوز 1000 حرف',
            'author_name.required' => 'الاسم مطلوب',
            'author_email.required' => 'البريد الإلكتروني مطلوب',
            'author_email.email' => 'البريد الإلكتروني غير صحيح',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ip_address' => request()->ip(),
        ]);
    }
}
```

---

### الخطوة 6: إنشاء Controllers

#### AuthController

```bash
php artisan make:controller Auth/AuthController
```

```php
// app/Http/Controllers/Auth/AuthController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // عرض صفحة التسجيل
    public function showRegister()
    {
        return view('auth.register');
    }

    // معالجة التسجيل
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        // إنشاء إعدادات افتراضية للمستخدم
        $user->settings()->create([
            'email_notifications' => true,
            'comment_notifications' => true,
            'theme' => 'auto',
            'language' => 'ar',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'تم إنشاء حسابك بنجاح!');
    }

    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')
                ->with('success', 'مرحباً بك، ' . auth()->user()->name);
        }

        return back()->withErrors([
            'email' => 'البيانات المدخلة غير صحيحة.',
        ])->onlyInput('email');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
```

#### ProfileController

```bash
php artisan make:controller Profile/ProfileController
```

```php
// app/Http/Controllers/Profile/ProfileController.php
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // عرض الملف الشخصي
    public function show()
    {
        return view('profile.show', [
            'user' => auth()->user()
        ]);
    }

    // عرض صفحة تعديل الملف الشخصي
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    // تحديث الملف الشخصي
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        // معالجة رفع الصورة
        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // رفع الصورة الجديدة
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $user->update($data);

        return redirect()->route('profile.show')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    // حذف الصورة الشخصية
    public function deleteAvatar(Request $request)
    {
        $user = auth()->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->update(['avatar' => null]);
        }

        return back()->with('success', 'تم حذف الصورة الشخصية');
    }
}
```

#### PostController

```bash
php artisan make:controller Post/PostController --resource
```

```php
// app/Http/Controllers/Post/PostController.php
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // عرض جميع المقالات
    public function index()
    {
        $posts = Post::with('user')
            ->published()
            ->latest('published_at')
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    // عرض صفحة إنشاء مقالة
    public function create()
    {
        return view('posts.create');
    }

    // حفظ المقالة
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // معالجة الصورة البارزة
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        // تعيين published_at إذا كانت published
        if ($data['status'] === 'published' && !isset($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post = Post::create($data);

        return redirect()->route('posts.show', $post)
            ->with('success', 'تم إنشاء المقالة بنجاح');
    }

    // عرض مقالة واحدة
    public function show(Post $post)
    {
        // زيادة عدد المشاهدات
        $post->incrementViews();

        $post->load(['user', 'approvedComments.user']);

        return view('posts.show', compact('post'));
    }

    // عرض صفحة تعديل المقالة
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    // تحديث المقالة
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        // معالجة الصورة البارزة
        if ($request->hasFile('featured_image')) {
            // حذف الصورة القديمة
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        // تعيين published_at عند النشر لأول مرة
        if ($data['status'] === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)
            ->with('success', 'تم تحديث المقالة بنجاح');
    }

    // حذف المقالة
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // حذف الصورة
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'تم حذف المقالة بنجاح');
    }
}
```

#### CommentController

```bash
php artisan make:controller Comment/CommentController
```

```php
// app/Http/Controllers/Comment/CommentController.php
namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // حفظ التعليق
    public function store(StoreCommentRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['post_id'] = $post->id;

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $data['author_name'] = null;
            $data['author_email'] = null;
        }

        // التعليقات تحتاج موافقة افتراضياً
        $data['is_approved'] = false;

        Comment::create($data);

        return back()->with('success', 'تم إضافة تعليقك، وسيظهر بعد المراجعة');
    }

    // حذف التعليق
    public function destroy(Comment $comment)
    {
        // يمكن للمستخدم حذف تعليقاته فقط
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'تم حذف التعليق');
    }
}
```

---

### الخطوة 7: إنشاء Views

#### Layout الأساسي

```blade
{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مدونتي')</title>

    {{-- Bootstrap RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        .error { color: #dc3545; font-size: 0.875em; }
        .avatar-preview { width: 150px; height: 150px; object-fit: cover; border-radius: 50%; }
        .post-image { width: 100%; height: 300px; object-fit: cover; }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">مدونتي</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">المقالات</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.create') }}">مقالة جديدة</a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">الملف الشخصي</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">تعديل الملف</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">إنشاء حساب</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- Content --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-light text-center text-muted py-3 mt-5">
        <p>&copy; 2024 مدونتي. جميع الحقوق محفوظة.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
```

#### صفحة التسجيل

```blade
{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">إنشاء حساب جديد</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم الكامل *</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">اسم المستخدم *</label>
                            <input type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   id="username"
                                   name="username"
                                   value="{{ old('username') }}"
                                   required>
                            <small class="text-muted">يجب أن يبدأ بحرف ويحتوي فقط على أحرف، أرقام، و _</small>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني *</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور *</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   required>
                            <small class="text-muted">يجب أن تحتوي على 8 أحرف على الأقل، مع أحرف وأرقام</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور *</label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox"
                                   class="form-check-input @error('terms') is-invalid @enderror"
                                   id="terms"
                                   name="terms"
                                   value="1">
                            <label class="form-check-label" for="terms">
                                أوافق على <a href="#">الشروط والأحكام</a>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
                    </form>

                    <div class="text-center mt-3">
                        <p>لديك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

#### صفحة تعديل الملف الشخصي

```blade
{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">تعديل الملف الشخصي</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        @method('PUT')

                        {{-- الصورة الشخصية --}}
                        <div class="mb-4 text-center">
                            <img src="{{ $user->avatar_url }}"
                                 alt="Avatar"
                                 class="avatar-preview mb-3"
                                 id="avatarPreview">

                            <div>
                                <label for="avatar" class="btn btn-sm btn-outline-primary">
                                    اختر صورة جديدة
                                </label>
                                <input type="file"
                                       class="d-none @error('avatar') is-invalid @enderror"
                                       id="avatar"
                                       name="avatar"
                                       accept="image/*">

                                @if($user->avatar)
                                    <form action="{{ route('profile.avatar.delete') }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف الصورة</button>
                                    </form>
                                @endif
                            </div>
                            @error('avatar')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">الاسم الكامل *</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">اسم المستخدم *</label>
                                <input type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       id="username"
                                       name="username"
                                       value="{{ old('username', $user->username) }}"
                                       required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني *</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">نبذة عني</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror"
                                      id="bio"
                                      name="bio"
                                      rows="3"
                                      maxlength="500">{{ old('bio', $user->bio) }}</textarea>
                            <small class="text-muted">الأحرف المتبقية: <span id="bioCounter">500</span></small>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">رقم الجوال</label>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="05xxxxxxxx">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="birth_date" class="form-label">تاريخ الميلاد</label>
                                <input type="date"
                                       class="form-control @error('birth_date') is-invalid @enderror"
                                       id="birth_date"
                                       name="birth_date"
                                       value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">الجنس</label>
                                <select class="form-select @error('gender') is-invalid @enderror"
                                        id="gender"
                                        name="gender">
                                    <option value="">اختر...</option>
                                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>أنثى</option>
                                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>آخر</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="website" class="form-label">الموقع الإلكتروني</label>
                                <input type="url"
                                       class="form-control @error('website') is-invalid @enderror"
                                       id="website"
                                       name="website"
                                       value="{{ old('website', $user->website) }}"
                                       placeholder="https://example.com">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // معاينة الصورة
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // عداد الأحرف للنبذة
    const bioTextarea = document.getElementById('bio');
    const bioCounter = document.getElementById('bioCounter');

    function updateCounter() {
        const remaining = 500 - bioTextarea.value.length;
        bioCounter.textContent = remaining;
    }

    bioTextarea.addEventListener('input', updateCounter);
    updateCounter();
</script>
@endsection
```

---

### الخطوة 8: Routes

```php
// routes/web.php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Comment\CommentController;
use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', function () {
    return redirect()->route('posts.index');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/avatar', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
});

// Post Routes
Route::resource('posts', PostController::class);

// Comment Routes
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Dashboard (للمستخدمين المسجلين)
Route::get('/dashboard', function () {
    $posts = auth()->user()->posts()->latest()->paginate(10);
    return view('dashboard', compact('posts'));
})->middleware('auth')->name('dashboard');
```

---

## الخلاصة

في هذا التطبيق العملي قمنا بتطبيق:

✅ **Forms** متعددة (تسجيل، تسجيل دخول، ملف شخصي، مقالات، تعليقات)
✅ **CSRF Protection** على جميع Forms
✅ **Validation** معقد باستخدام Form Requests
✅ **Custom Validation Rules** (ValidUsername, SaudiPhone, NoForbiddenWords)
✅ **File Upload** مع Validation (الصور الشخصية والصور البارزة)
✅ **Error Handling** مع رسائل مخصصة بالعربية
✅ **Old Input** للحفاظ على القيم عند الأخطاء
✅ **Authorization** في Form Requests
✅ **Conditional Validation** (مثل published_at)
✅ **prepareForValidation()** لتنظيف البيانات

هذا التطبيق يمثل نظام حقيقي يمكن بناؤه والتوسع فيه! 🚀
