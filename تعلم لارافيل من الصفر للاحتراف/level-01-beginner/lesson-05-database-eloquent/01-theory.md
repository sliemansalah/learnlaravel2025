# الدرس الخامس: Database & Eloquent ORM في Laravel

## 📚 المحتويات

1. [مقدمة عن قواعد البيانات](#مقدمة-عن-قواعد-البيانات)
2. [Database Configuration](#database-configuration)
3. [Migrations](#migrations)
4. [Eloquent ORM](#eloquent-orm)
5. [CRUD Operations](#crud-operations)
6. [Eloquent Relationships](#eloquent-relationships)
7. [Query Builder](#query-builder)
8. [Collections](#collections)
9. [Accessors & Mutators](#accessors--mutators)
10. [Scopes](#scopes)
11. [Eager Loading](#eager-loading)
12. [Advanced Features](#advanced-features)
13. [Best Practices](#best-practices)

---

## مقدمة عن قواعد البيانات

### ما هي قاعدة البيانات؟

**قاعدة البيانات (Database)** هي نظام منظم لتخزين واسترجاع البيانات.

### لماذا نستخدم قواعد البيانات؟

```
✅ تخزين دائم للبيانات
✅ سرعة في الاسترجاع
✅ أمان للمعلومات
✅ إدارة علاقات معقدة بين البيانات
✅ دعم الاستعلامات المعقدة
```

### قواعد البيانات المدعومة في Laravel

| Database | Driver | الوصف |
|----------|--------|--------|
| **MySQL** | mysql | الأكثر شيوعاً |
| **PostgreSQL** | pgsql | قوي ومتقدم |
| **SQLite** | sqlite | خفيف للتطوير |
| **SQL Server** | sqlsrv | لـ Microsoft |

---

## Database Configuration

### 1. إعداد .env

**ملف .env:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 2. ملف config/database.php

```php
'connections' => [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],
],
```

### 3. اختبار الاتصال

```bash
php artisan migrate:status
# أو
php artisan db:show
```

---

## Migrations

### ما هي Migrations؟

**Migrations** هي Version Control لقاعدة البيانات - تسمح بإنشاء وتعديل هيكل الجداول بطريقة برمجية.

### مميزات Migrations

```
✅ Version Control للـ Database
✅ إمكانية التراجع (Rollback)
✅ مشاركة هيكل Database مع الفريق
✅ تطبيق نفس التغييرات على بيئات مختلفة
```

### إنشاء Migration

```bash
# Migration عادي
php artisan make:migration create_posts_table

# Migration مع model
php artisan make:model Post -m

# Migration لتعديل جدول موجود
php artisan make:migration add_status_to_posts_table --table=posts
```

### هيكل Migration

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

### أنواع الأعمدة (Column Types)

#### Numeric Types

```php
$table->id();                      // BIGINT UNSIGNED (auto increment)
$table->bigInteger('votes');       // BIGINT
$table->integer('votes');          // INTEGER
$table->smallInteger('votes');     // SMALLINT
$table->tinyInteger('votes');      // TINYINT
$table->decimal('amount', 8, 2);   // DECIMAL مع precision
$table->double('amount', 8, 2);    // DOUBLE
$table->float('amount', 8, 2);     // FLOAT
```

#### String Types

```php
$table->string('name');            // VARCHAR(255)
$table->string('name', 100);       // VARCHAR(100)
$table->text('description');       // TEXT
$table->longText('description');   // LONGTEXT
$table->char('code', 10);          // CHAR(10)
```

#### Date & Time Types

```php
$table->date('birth_date');        // DATE
$table->dateTime('created_at');    // DATETIME
$table->time('sunrise');           // TIME
$table->timestamp('added_on');     // TIMESTAMP
$table->timestamps();              // created_at & updated_at
$table->softDeletes();             // deleted_at
```

#### Boolean & Enum

```php
$table->boolean('confirmed');      // BOOLEAN
$table->enum('status', ['active', 'inactive', 'pending']);
```

#### Foreign Keys & Indexes

```php
$table->foreignId('user_id')       // BIGINT UNSIGNED
      ->constrained()              // Foreign key to users.id
      ->onDelete('cascade');       // Cascade on delete

$table->unique('email');           // Unique index
$table->index('status');           // Regular index
```

### Column Modifiers

```php
$table->string('email')->nullable();           // يسمح بـ NULL
$table->string('name')->default('Guest');      // قيمة افتراضية
$table->integer('votes')->unsigned();          // UNSIGNED
$table->timestamp('created_at')->useCurrent(); // قيمة حالية
$table->string('token')->unique();             // فريد
$table->text('bio')->comment('User bio');      // تعليق
```

### تشغيل Migrations

```bash
# تشغيل جميع Migrations
php artisan migrate

# التراجع عن آخر batch
php artisan migrate:rollback

# التراجع عن خطوة واحدة
php artisan migrate:rollback --step=1

# إعادة تشغيل جميع Migrations
php artisan migrate:refresh

# حذف جميع الجداول وإعادة التشغيل
php artisan migrate:fresh

# عرض حالة Migrations
php artisan migrate:status
```

### تعديل جدول موجود

```php
Schema::table('users', function (Blueprint $table) {
    // إضافة عمود
    $table->string('phone')->after('email');

    // تعديل عمود
    $table->string('name', 100)->change();

    // إعادة تسمية عمود
    $table->renameColumn('name', 'full_name');

    // حذف عمود
    $table->dropColumn('votes');

    // حذف عدة أعمدة
    $table->dropColumn(['votes', 'avatar']);
});
```

---

## Eloquent ORM

### ما هو Eloquent؟

**Eloquent** هو ORM (Object-Relational Mapping) في Laravel - يسمح بالتعامل مع قاعدة البيانات كـ Objects بدلاً من SQL.

### مميزات Eloquent

```
✅ Active Record Implementation
✅ Syntax واضح وسهل
✅ علاقات قوية بين Models
✅ Events & Observers
✅ Soft Deletes
✅ Accessors & Mutators
✅ Query Scopes
```

### إنشاء Model

```bash
# Model فقط
php artisan make:model Post

# Model + Migration
php artisan make:model Post -m

# Model + Migration + Controller
php artisan make:model Post -mc

# Model + Migration + Controller + Resource
php artisan make:model Post -mcr

# كل شيء (Model + Migration + Controller + Seeder + Factory + Policy + Resource)
php artisan make:model Post --all
```

### هيكل Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * اسم الجدول (اختياري)
     */
    protected $table = 'posts';

    /**
     * Primary Key (اختياري)
     */
    protected $primaryKey = 'id';

    /**
     * Auto-incrementing (اختياري)
     */
    public $incrementing = true;

    /**
     * نوع Primary Key (اختياري)
     */
    protected $keyType = 'int';

    /**
     * Timestamps (اختياري)
     */
    public $timestamps = true;

    /**
     * الأعمدة القابلة للتعبئة Mass Assignment
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'status',
    ];

    /**
     * الأعمدة المحمية من Mass Assignment
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * الأعمدة المخفية (في JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Type Casting
     */
    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'settings' => 'array',
    ];

    /**
     * القيم الافتراضية
     */
    protected $attributes = [
        'status' => 'draft',
    ];
}
```

### Naming Conventions

| Convention | مثال |
|------------|------|
| **Table Name** | posts (جمع، snake_case) |
| **Model Name** | Post (مفرد، PascalCase) |
| **Primary Key** | id |
| **Foreign Key** | user_id (model_id) |
| **Timestamps** | created_at, updated_at |
| **Soft Delete** | deleted_at |
| **Pivot Table** | post_tag (أبجدي) |

---

## CRUD Operations

### Create (الإنشاء)

#### 1. باستخدام new

```php
$post = new Post();
$post->title = 'عنوان المقال';
$post->content = 'محتوى المقال';
$post->save();
```

#### 2. باستخدام create()

```php
Post::create([
    'title' => 'عنوان المقال',
    'content' => 'محتوى المقال',
]);
```

⚠️ **ملاحظة**: يجب تعريف `$fillable` أو `$guarded` في الـ Model

#### 3. باستخدام firstOrCreate()

```php
// يبحث، إذا لم يجد ينشئ
$post = Post::firstOrCreate(
    ['title' => 'عنوان المقال'],
    ['content' => 'محتوى المقال']
);
```

#### 4. باستخدام updateOrCreate()

```php
// يبحث، إذا وجد يحدث، إذا لم يجد ينشئ
$post = Post::updateOrCreate(
    ['title' => 'عنوان المقال'],
    ['content' => 'محتوى جديد']
);
```

### Read (القراءة)

#### 1. جلب الكل

```php
$posts = Post::all();
```

#### 2. جلب بشرط

```php
$posts = Post::where('status', 'published')->get();
```

#### 3. جلب واحد

```php
// بواسطة ID
$post = Post::find(1);

// أول عنصر
$post = Post::first();

// بشرط محدد
$post = Post::where('slug', 'my-post')->first();

// أو رمي Exception إذا لم يجد
$post = Post::findOrFail(1);
$post = Post::where('slug', 'my-post')->firstOrFail();
```

#### 4. Pagination

```php
$posts = Post::paginate(15);
$posts = Post::simplePaginate(15);
```

#### 5. Chunking (للبيانات الكبيرة)

```php
Post::chunk(100, function ($posts) {
    foreach ($posts as $post) {
        // معالجة
    }
});
```

### Update (التحديث)

#### 1. جلب ثم تحديث

```php
$post = Post::find(1);
$post->title = 'عنوان جديد';
$post->save();
```

#### 2. تحديث مباشر

```php
Post::where('id', 1)->update([
    'title' => 'عنوان جديد',
]);
```

#### 3. تحديث متعدد

```php
Post::where('status', 'draft')
    ->update(['status' => 'published']);
```

### Delete (الحذف)

#### 1. حذف بعد الجلب

```php
$post = Post::find(1);
$post->delete();
```

#### 2. حذف مباشر

```php
Post::destroy(1);
Post::destroy([1, 2, 3]);
Post::destroy(1, 2, 3);
```

#### 3. حذف بشرط

```php
Post::where('status', 'draft')->delete();
```

#### 4. Soft Delete

```php
// في Model
use SoftDeletes;

// الحذف (soft)
$post->delete();

// الاستعلام مع المحذوفات
Post::withTrashed()->get();

// المحذوفات فقط
Post::onlyTrashed()->get();

// الاستعادة
$post->restore();

// الحذف النهائي
$post->forceDelete();
```

---

## Eloquent Relationships

### 1. One to One (واحد لواحد)

**مثال**: User لديه Profile واحد

**Migration:**
```php
// users table
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});

// profiles table
Schema::create('profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('bio');
    $table->string('avatar');
    $table->timestamps();
});
```

**Models:**
```php
// User Model
public function profile()
{
    return $this->hasOne(Profile::class);
}

// Profile Model
public function user()
{
    return $this->belongsTo(User::class);
}
```

**استخدام:**
```php
// الوصول
$user = User::find(1);
$profile = $user->profile;

// الإنشاء
$user->profile()->create([
    'bio' => 'My bio',
    'avatar' => 'avatar.jpg',
]);
```

### 2. One to Many (واحد لمتعدد)

**مثال**: User لديه عدة Posts

**Migration:**
```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('content');
    $table->timestamps();
});
```

**Models:**
```php
// User Model
public function posts()
{
    return $this->hasMany(Post::class);
}

// Post Model
public function user()
{
    return $this->belongsTo(User::class);
}
```

**استخدام:**
```php
// جلب جميع posts لمستخدم
$user = User::find(1);
$posts = $user->posts;

// إنشاء post لمستخدم
$user->posts()->create([
    'title' => 'عنوان',
    'content' => 'محتوى',
]);

// جلب user من post
$post = Post::find(1);
$user = $post->user;
```

### 3. Many to Many (متعدد لمتعدد)

**مثال**: Post لديه عدة Tags، Tag لديه عدة Posts

**Migrations:**
```php
// posts table
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->timestamps();
});

// tags table
Schema::create('tags', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});

// pivot table (أبجدي: post_tag)
Schema::create('post_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->foreignId('tag_id')->constrained()->onDelete('cascade');
    $table->timestamps(); // اختياري
});
```

**Models:**
```php
// Post Model
public function tags()
{
    return $this->belongsToMany(Tag::class);
}

// Tag Model
public function posts()
{
    return $this->belongsToMany(Post::class);
}
```

**استخدام:**
```php
// جلب tags لـ post
$post = Post::find(1);
$tags = $post->tags;

// ربط tag بـ post
$post->tags()->attach($tagId);
$post->tags()->attach([1, 2, 3]);

// فك الربط
$post->tags()->detach($tagId);
$post->tags()->detach(); // فك جميع الروابط

// مزامنة (حذف القديم وإضافة الجديد)
$post->tags()->sync([1, 2, 3]);

// toggle (إذا موجود يحذف، إذا غير موجود يضيف)
$post->tags()->toggle([1, 2, 3]);
```

#### Pivot Table مع بيانات إضافية

```php
// في Model
public function tags()
{
    return $this->belongsToMany(Tag::class)
                ->withPivot('added_by', 'notes')
                ->withTimestamps();
}

// الإضافة مع بيانات إضافية
$post->tags()->attach($tagId, [
    'added_by' => auth()->id(),
    'notes' => 'Important tag',
]);

// الوصول للبيانات الإضافية
$tag = $post->tags->first();
echo $tag->pivot->added_by;
echo $tag->pivot->notes;
```

### 4. Has Many Through

**مثال**: Country → Users → Posts

```php
// Country Model
public function posts()
{
    return $this->hasManyThrough(
        Post::class,    // النموذج النهائي
        User::class,    // النموذج الوسيط
        'country_id',   // Foreign key في users table
        'user_id',      // Foreign key في posts table
        'id',           // Local key في countries table
        'id'            // Local key في users table
    );
}

// استخدام
$country = Country::find(1);
$posts = $country->posts; // جميع posts لجميع users في هذا البلد
```

### 5. Polymorphic Relations (علاقات متعددة الأشكال)

#### One to One Polymorphic

**مثال**: Post و User يمكن أن يكون لكل منهما Image واحدة

**Migration:**
```php
Schema::create('images', function (Blueprint $table) {
    $table->id();
    $table->string('url');
    $table->morphs('imageable'); // imageable_id & imageable_type
    $table->timestamps();
});
```

**Models:**
```php
// Image Model
public function imageable()
{
    return $this->morphTo();
}

// Post Model
public function image()
{
    return $this->morphOne(Image::class, 'imageable');
}

// User Model
public function image()
{
    return $this->morphOne(Image::class, 'imageable');
}
```

**استخدام:**
```php
$post = Post::find(1);
$post->image()->create(['url' => 'image.jpg']);

$image = Image::find(1);
$owner = $image->imageable; // Post أو User
```

#### One to Many Polymorphic

**مثال**: Post و Video يمكن أن يكون لكل منهما عدة Comments

```php
// Comment Model
public function commentable()
{
    return $this->morphTo();
}

// Post Model
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}

// Video Model
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

#### Many to Many Polymorphic

**مثال**: Post و Video يمكن أن يكون لكل منهما عدة Tags

```php
// Tag Model
public function posts()
{
    return $this->morphedByMany(Post::class, 'taggable');
}

public function videos()
{
    return $this->morphedByMany(Video::class, 'taggable');
}

// Post Model
public function tags()
{
    return $this->morphToMany(Tag::class, 'taggable');
}

// Video Model
public function tags()
{
    return $this->morphToMany(Tag::class, 'taggable');
}
```

---

## Query Builder

### WHERE Clauses

```php
// Basic where
Post::where('status', 'published')->get();

// Multiple where
Post::where('status', 'published')
    ->where('views', '>', 100)
    ->get();

// Where with array
Post::where([
    ['status', '=', 'published'],
    ['views', '>', 100],
])->get();

// orWhere
Post::where('status', 'published')
    ->orWhere('featured', true)
    ->get();

// whereBetween
Post::whereBetween('views', [100, 500])->get();

// whereIn
Post::whereIn('status', ['published', 'featured'])->get();

// whereNull
Post::whereNull('deleted_at')->get();

// whereDate, whereMonth, whereYear, whereTime
Post::whereDate('created_at', '2024-01-01')->get();
Post::whereMonth('created_at', '01')->get();
Post::whereYear('created_at', '2024')->get();

// whereColumn
Post::whereColumn('updated_at', '>', 'created_at')->get();

// where with closure
Post::where(function ($query) {
    $query->where('status', 'published')
          ->orWhere('featured', true);
})->get();
```

### Ordering & Limiting

```php
// Order by
Post::orderBy('created_at', 'desc')->get();
Post::orderBy('views', 'desc')->orderBy('title', 'asc')->get();

// Latest & Oldest
Post::latest()->get();           // orderBy('created_at', 'desc')
Post::oldest()->get();           // orderBy('created_at', 'asc')

// Random
Post::inRandomOrder()->get();

// Limit & Offset
Post::take(10)->get();
Post::skip(10)->take(10)->get();
Post::offset(10)->limit(10)->get();
```

### Aggregates

```php
// Count
$count = Post::count();
$count = Post::where('status', 'published')->count();

// Max, Min, Avg, Sum
$max = Post::max('views');
$min = Post::min('views');
$avg = Post::avg('views');
$sum = Post::sum('views');

// Exists
$exists = Post::where('slug', 'my-post')->exists();
$doesntExist = Post::where('slug', 'my-post')->doesntExist();
```

### Grouping

```php
// Group by
Post::select('status', DB::raw('count(*) as total'))
    ->groupBy('status')
    ->get();

// Having
Post::select('user_id', DB::raw('count(*) as total'))
    ->groupBy('user_id')
    ->having('total', '>', 5)
    ->get();
```

### Joins

```php
// Inner join
$posts = Post::join('users', 'posts.user_id', '=', 'users.id')
    ->select('posts.*', 'users.name')
    ->get();

// Left join
$posts = Post::leftJoin('users', 'posts.user_id', '=', 'users.id')
    ->get();

// Cross join
$posts = Post::crossJoin('categories')->get();
```

---

## Collections

### ما هي Collections؟

**Collections** هي Wrapper قوي للـ Arrays، توفر دوال مساعدة كثيرة.

### أمثلة شائعة

```php
$posts = Post::all(); // Collection

// Filter
$published = $posts->where('status', 'published');

// Map
$titles = $posts->map(function ($post) {
    return $post->title;
});

// Pluck (استخراج عمود واحد)
$ids = $posts->pluck('id');
$titles = $posts->pluck('title', 'id'); // [id => title]

// First & Last
$first = $posts->first();
$last = $posts->last();

// Take & Skip
$first5 = $posts->take(5);
$skip10 = $posts->skip(10);

// Chunk
$posts->chunk(10)->each(function ($chunk) {
    // معالجة كل 10 عناصر
});

// Sum, Avg, Max, Min
$totalViews = $posts->sum('views');
$avgViews = $posts->avg('views');
$maxViews = $posts->max('views');

// Sort
$sorted = $posts->sortBy('title');
$sorted = $posts->sortByDesc('views');

// GroupBy
$grouped = $posts->groupBy('status');

// Count
$count = $posts->count();

// IsEmpty & IsNotEmpty
if ($posts->isEmpty()) {
    // لا توجد مقالات
}

// Contains
if ($posts->contains('id', 1)) {
    // يحتوي على مقال بـ id = 1
}
```

---

## Accessors & Mutators

### Accessors (للقراءة)

تعديل القيمة عند **قراءتها** من Database.

```php
// في Model
public function getTitleAttribute($value)
{
    return ucfirst($value);
}

// Laravel 9+ (Attribute)
use Illuminate\Database\Eloquent\Casts\Attribute;

protected function title(): Attribute
{
    return Attribute::make(
        get: fn ($value) => ucfirst($value),
    );
}

// استخدام
$post = Post::find(1);
echo $post->title; // يطبق ucfirst تلقائياً
```

### Mutators (للكتابة)

تعديل القيمة عند **كتابتها** إلى Database.

```php
// في Model
public function setTitleAttribute($value)
{
    $this->attributes['title'] = strtolower($value);
}

// Laravel 9+ (Attribute)
protected function title(): Attribute
{
    return Attribute::make(
        get: fn ($value) => ucfirst($value),
        set: fn ($value) => strtolower($value),
    );
}

// استخدام
$post = new Post();
$post->title = 'HELLO WORLD'; // يُخزن كـ 'hello world'
```

### Attribute Casting

```php
// في Model
protected $casts = [
    'published_at' => 'datetime',
    'is_published' => 'boolean',
    'settings' => 'array',
    'price' => 'decimal:2',
];

// استخدام
$post->published_at; // Carbon instance
$post->is_published; // true/false
$post->settings; // Array
$post->price; // '19.99'
```

---

## Scopes

### Local Scopes

دوال مساعدة لاستعلامات متكررة.

```php
// في Model
public function scopePublished($query)
{
    return $query->where('status', 'published');
}

public function scopePopular($query)
{
    return $query->where('views', '>', 1000);
}

public function scopeOfType($query, $type)
{
    return $query->where('type', $type);
}

// استخدام
$posts = Post::published()->get();
$posts = Post::published()->popular()->get();
$posts = Post::ofType('tutorial')->get();
```

### Global Scopes

يتم تطبيقها تلقائياً على جميع الاستعلامات.

```php
// إنشاء Global Scope
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('status', 'published');
    }
}

// في Model
use App\Models\Scopes\PublishedScope;

protected static function booted()
{
    static::addGlobalScope(new PublishedScope);
}

// استخدام
$posts = Post::all(); // يجلب published فقط

// تجاهل Global Scope
$posts = Post::withoutGlobalScope(PublishedScope::class)->get();
$posts = Post::withoutGlobalScopes()->get(); // جميع scopes
```

---

## Eager Loading

### المشكلة: N+1 Query Problem

```php
// ❌ سيئ - 101 query (1 + 100)
$posts = Post::all(); // 1 query

foreach ($posts as $post) {
    echo $post->user->name; // 100 queries
}
```

### الحل: Eager Loading

```php
// ✅ جيد - 2 queries فقط
$posts = Post::with('user')->get();

foreach ($posts as $post) {
    echo $post->user->name; // لا توجد queries إضافية
}
```

### Nested Eager Loading

```php
// جلب posts مع user مع profile
$posts = Post::with('user.profile')->get();

// جلب علاقات متعددة
$posts = Post::with(['user', 'comments', 'tags'])->get();
```

### Eager Loading مع شروط

```php
$posts = Post::with(['comments' => function ($query) {
    $query->where('approved', true)
          ->orderBy('created_at', 'desc');
}])->get();
```

### Lazy Eager Loading

```php
$posts = Post::all();

// تحميل علاقة لاحقاً
$posts->load('user');
$posts->load(['user', 'comments']);
```

---

## Advanced Features

### Mass Assignment Protection

```php
// في Model
protected $fillable = ['title', 'content', 'user_id'];

// أو
protected $guarded = ['id'];

// تعطيل الحماية (خطر!)
protected $guarded = [];
```

### Events

```php
// في Model
protected static function booted()
{
    static::creating(function ($post) {
        $post->slug = Str::slug($post->title);
    });

    static::updating(function ($post) {
        // قبل التحديث
    });

    static::deleting(function ($post) {
        // قبل الحذف
    });
}
```

### Model Observers

```bash
php artisan make:observer PostObserver --model=Post
```

```php
// في Observer
public function creating(Post $post)
{
    $post->slug = Str::slug($post->title);
}

public function created(Post $post)
{
    // بعد الإنشاء
}

// تسجيل Observer في AppServiceProvider
Post::observe(PostObserver::class);
```

### Query Logging

```php
use Illuminate\Support\Facades\DB;

// تفعيل logging
DB::enableQueryLog();

// تنفيذ queries
$posts = Post::with('user')->get();

// عرض queries
dd(DB::getQueryLog());
```

---

## Best Practices

### ✅ 1. استخدم Eloquent بدلاً من Query Builder عندما يكون ممكناً

```php
// ✅ جيد
$post = Post::find(1);

// ❌ سيئ (إلا إذا كنت تحتاج أداء أعلى)
$post = DB::table('posts')->where('id', 1)->first();
```

### ✅ 2. استخدم Eager Loading لتجنب N+1

```php
// ✅ جيد
$posts = Post::with('user')->get();

// ❌ سيئ
$posts = Post::all();
// ثم استخدام $post->user في loop
```

### ✅ 3. استخدم Scopes للاستعلامات المتكررة

```php
// ✅ جيد
$posts = Post::published()->popular()->get();

// ❌ سيئ
$posts = Post::where('status', 'published')
             ->where('views', '>', 1000)
             ->get();
```

### ✅ 4. استخدم fillable أو guarded

```php
// ✅ جيد
protected $fillable = ['title', 'content'];

// ❌ خطر
protected $guarded = [];
```

### ✅ 5. استخدم Transactions للعمليات المعقدة

```php
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    $user = User::create([...]);
    $user->profile()->create([...]);
    $user->posts()->create([...]);
});
```

### ✅ 6. استخدم Chunk للبيانات الكبيرة

```php
// ✅ جيد للبيانات الكبيرة
Post::chunk(100, function ($posts) {
    foreach ($posts as $post) {
        // معالجة
    }
});

// ❌ سيئ - يستهلك ذاكرة كبيرة
$posts = Post::all();
```

### ✅ 7. استخدم exists() بدلاً من count()

```php
// ✅ جيد - أسرع
if (Post::where('slug', $slug)->exists()) {
    // ...
}

// ❌ سيئ - أبطأ
if (Post::where('slug', $slug)->count() > 0) {
    // ...
}
```

### ✅ 8. احذف Relationships عند الحذف

```php
// في Migration
$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade'); // أو 'set null'

// أو في Model Event
protected static function booted()
{
    static::deleting(function ($post) {
        $post->comments()->delete();
    });
}
```

---

## ملخص الدرس

### ما تعلمناه:

✅ **Database Configuration**: إعداد الاتصال بقاعدة البيانات
✅ **Migrations**: إنشاء وتعديل هيكل الجداول
✅ **Eloquent Models**: التعامل مع Database كـ Objects
✅ **CRUD**: Create, Read, Update, Delete
✅ **Relationships**: One to One, One to Many, Many to Many, وغيرها
✅ **Query Builder**: استعلامات قوية ومرنة
✅ **Collections**: دوال مساعدة للتعامل مع البيانات
✅ **Accessors & Mutators**: تعديل البيانات عند القراءة/الكتابة
✅ **Scopes**: استعلامات قابلة لإعادة الاستخدام
✅ **Eager Loading**: تحسين الأداء
✅ **Best Practices**: أفضل الممارسات

---

## الخطوة التالية 🚀

بعد إتمام هذا الدرس، انتقل إلى:
- **التطبيق العملي** (`02-practice.md`)
- **أمثلة الكود** (`03-code-examples.md`)
- **التمارين** (`04-exercises.md`)
- **الاختبار** (`05-exam-with-answers.md`)

---

**تهانينا! 🎉 أنت الآن تفهم Database و Eloquent ORM في Laravel!**
