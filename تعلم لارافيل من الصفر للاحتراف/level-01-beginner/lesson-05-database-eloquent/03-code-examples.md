# أمثلة عملية: Database & Eloquent ORM

## 📚 المحتويات

هذه الصفحة تحتوي على 35 مثالاً عملياً لاستخدام Database و Eloquent ORM في Laravel

---

## القسم الأول: Migrations

### مثال 1: Migration بسيط

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

---

### مثال 2: Migration مع Foreign Keys

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')
          ->constrained()              // يشير إلى users.id
          ->onDelete('cascade');       // حذف تلقائي عند حذف المستخدم
    $table->string('title');
    $table->text('content');
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->timestamps();
    $table->softDeletes();
});
```

---

### مثال 3: تعديل جدول موجود

```php
Schema::table('users', function (Blueprint $table) {
    // إضافة عمود
    $table->string('phone')->nullable()->after('email');

    // تعديل عمود
    $table->string('name', 100)->change();

    // إضافة index
    $table->index('email');

    // حذف عمود
    $table->dropColumn('old_column');
});
```

---

## القسم الثاني: Eloquent Basics

### مثال 4: Model بسيط

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'content', 'status'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected $attributes = [
        'status' => 'draft',
    ];
}
```

---

### مثال 5: CRUD Operations

```php
// Create
$post = Post::create([
    'user_id' => 1,
    'title' => 'My First Post',
    'content' => 'This is the content',
]);

// أو
$post = new Post();
$post->title = 'My First Post';
$post->content = 'This is the content';
$post->save();

// Read
$posts = Post::all();
$post = Post::find(1);
$post = Post::where('status', 'published')->first();
$posts = Post::where('status', 'published')->get();

// Update
$post = Post::find(1);
$post->title = 'Updated Title';
$post->save();

// أو
Post::where('id', 1)->update(['title' => 'Updated Title']);

// Delete
$post = Post::find(1);
$post->delete();

// أو
Post::destroy(1);
Post::destroy([1, 2, 3]);

// Soft Delete
$post = Post::find(1);
$post->delete(); // Soft delete

// جلب المحذوفات
$posts = Post::withTrashed()->get();
$posts = Post::onlyTrashed()->get();

// استعادة
$post->restore();

// حذف نهائي
$post->forceDelete();
```

---

## القسم الثالث: Relationships

### مثال 6: One to One

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

// استخدام
$user = User::find(1);
$profile = $user->profile;

$user->profile()->create([
    'bio' => 'My bio',
    'avatar' => 'avatar.jpg',
]);
```

---

### مثال 7: One to Many

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

// استخدام
$user = User::find(1);
$posts = $user->posts;

$user->posts()->create([
    'title' => 'New Post',
    'content' => 'Content',
]);
```

---

### مثال 8: Many to Many

```php
// Post Model
public function tags()
{
    return $this->belongsToMany(Tag::class)->withTimestamps();
}

// Tag Model
public function posts()
{
    return $this->belongsToMany(Post::class)->withTimestamps();
}

// استخدام
$post = Post::find(1);

// الربط
$post->tags()->attach($tagId);
$post->tags()->attach([1, 2, 3]);

// فك الربط
$post->tags()->detach($tagId);
$post->tags()->detach(); // جميع الروابط

// المزامنة (حذف القديم وإضافة الجديد)
$post->tags()->sync([1, 2, 3]);

// Toggle
$post->tags()->toggle([1, 2, 3]);

// مع بيانات إضافية في pivot
$post->tags()->attach($tagId, ['added_by' => auth()->id()]);
```

---

### مثال 9: Many to Many مع Pivot Data

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
    'notes' => 'Important',
]);

// الوصول للبيانات
foreach ($post->tags as $tag) {
    echo $tag->pivot->added_by;
    echo $tag->pivot->notes;
    echo $tag->pivot->created_at;
}
```

---

### مثال 10: Has Many Through

```php
// Country Model
public function posts()
{
    return $this->hasManyThrough(
        Post::class,
        User::class,
        'country_id',  // Foreign key on users table
        'user_id',     // Foreign key on posts table
        'id',          // Local key on countries table
        'id'           // Local key on users table
    );
}

// استخدام
$country = Country::find(1);
$posts = $country->posts; // جميع posts لجميع users في هذا البلد
```

---

### مثال 11: Polymorphic One to One

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

// استخدام
$post = Post::find(1);
$post->image()->create(['url' => 'image.jpg']);

$image = Image::find(1);
$owner = $image->imageable; // Post أو User
```

---

### مثال 12: Polymorphic One to Many

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

// استخدام
$post = Post::find(1);
$post->comments()->create([
    'content' => 'Great post!',
    'user_id' => auth()->id(),
]);

$comment = Comment::find(1);
$owner = $comment->commentable; // Post أو Video
```

---

## القسم الرابع: Query Builder

### مثال 13: Where Clauses

```php
// Basic where
$posts = Post::where('status', 'published')->get();

// Multiple where
$posts = Post::where('status', 'published')
             ->where('views', '>', 100)
             ->get();

// orWhere
$posts = Post::where('status', 'published')
             ->orWhere('featured', true)
             ->get();

// whereBetween
$posts = Post::whereBetween('views', [100, 500])->get();

// whereIn
$posts = Post::whereIn('status', ['published', 'featured'])->get();

// whereNotIn
$posts = Post::whereNotIn('status', ['draft', 'pending'])->get();

// whereNull / whereNotNull
$posts = Post::whereNull('deleted_at')->get();
$posts = Post::whereNotNull('published_at')->get();

// whereDate, whereMonth, whereYear
$posts = Post::whereDate('created_at', '2024-01-01')->get();
$posts = Post::whereMonth('created_at', '01')->get();
$posts = Post::whereYear('created_at', '2024')->get();

// whereColumn
$posts = Post::whereColumn('updated_at', '>', 'created_at')->get();

// Advanced where
$posts = Post::where(function ($query) {
    $query->where('status', 'published')
          ->orWhere('status', 'featured');
})->where('views', '>', 100)->get();
```

---

### مثال 14: Ordering & Limiting

```php
// Order by
$posts = Post::orderBy('created_at', 'desc')->get();
$posts = Post::orderBy('views', 'desc')->orderBy('title')->get();

// Latest & Oldest
$posts = Post::latest()->get();
$posts = Post::oldest()->get();

// inRandomOrder
$posts = Post::inRandomOrder()->take(5)->get();

// Limit & Offset
$posts = Post::take(10)->get();
$posts = Post::skip(10)->take(10)->get();
$posts = Post::offset(10)->limit(10)->get();
```

---

### مثال 15: Aggregates

```php
// Count
$count = Post::count();
$count = Post::where('status', 'published')->count();

// Max, Min, Avg, Sum
$max = Post::max('views');
$min = Post::min('views');
$avg = Post::avg('views');
$sum = Post::sum('views');

// Exists & Doesn't Exist
if (Post::where('slug', 'my-post')->exists()) {
    // exists
}

if (Post::where('slug', 'my-post')->doesntExist()) {
    // doesn't exist
}
```

---

### مثال 16: Select & Pluck

```php
// Select specific columns
$posts = Post::select('id', 'title', 'created_at')->get();

// Select with DB::raw
$posts = Post::select('status', DB::raw('count(*) as total'))
             ->groupBy('status')
             ->get();

// Pluck (للحصول على array بسيط)
$titles = Post::pluck('title');
$titles = Post::pluck('title', 'id'); // [id => title]
```

---

### مثال 17: Joins

```php
// Inner Join
$posts = Post::join('users', 'posts.user_id', '=', 'users.id')
             ->select('posts.*', 'users.name as author_name')
             ->get();

// Left Join
$posts = Post::leftJoin('comments', 'posts.id', '=', 'comments.post_id')
             ->select('posts.*', DB::raw('COUNT(comments.id) as comments_count'))
             ->groupBy('posts.id')
             ->get();

// Advanced Join
$posts = Post::join('users', function ($join) {
    $join->on('posts.user_id', '=', 'users.id')
         ->where('users.status', '=', 'active');
})->get();
```

---

### مثال 18: Group By & Having

```php
$posts = Post::select('user_id', DB::raw('count(*) as total'))
             ->groupBy('user_id')
             ->having('total', '>', 5)
             ->get();
```

---

## القسم الخامس: Collections

### مثال 19: Collection Methods

```php
$posts = Post::all();

// Filter
$published = $posts->where('status', 'published');
$featured = $posts->filter(function ($post) {
    return $post->views > 1000;
});

// Map
$titles = $posts->map(function ($post) {
    return strtoupper($post->title);
});

// Pluck
$ids = $posts->pluck('id');
$titlesByIds = $posts->pluck('title', 'id');

// First & Last
$first = $posts->first();
$last = $posts->last();

// Take & Skip
$first5 = $posts->take(5);
$skip10 = $posts->skip(10);

// Chunk
$posts->chunk(10)->each(function ($chunk) {
    foreach ($chunk as $post) {
        // Process
    }
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
    // empty
}

// Contains
if ($posts->contains('id', 1)) {
    // contains
}

// Unique
$unique = $posts->unique('user_id');

// Flatten (لتسطيح array متداخل)
$comments = $posts->pluck('comments')->flatten();
```

---

## القسم السادس: Accessors & Mutators

### مثال 20: Accessor

```php
// في Model
public function getTitleAttribute($value)
{
    return ucfirst($value);
}

// Laravel 9+
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

---

### مثال 21: Mutator

```php
// في Model
public function setTitleAttribute($value)
{
    $this->attributes['title'] = strtolower($value);
    $this->attributes['slug'] = Str::slug($value);
}

// Laravel 9+
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

---

### مثال 22: Computed Attributes

```php
// في Model
public function getIsPublishedAttribute()
{
    return $this->status === 'published';
}

public function getExcerptAttribute()
{
    return Str::limit($this->content, 100);
}

// استخدام
$post = Post::find(1);
echo $post->is_published; // true/false
echo $post->excerpt; // أول 100 حرف
```

---

### مثال 23: Attribute Casting

```php
// في Model
protected $casts = [
    'published_at' => 'datetime',
    'is_featured' => 'boolean',
    'settings' => 'array',
    'price' => 'decimal:2',
    'data' => 'object',
    'tags' => 'json',
];

// استخدام
$post = Post::find(1);

// datetime
$post->published_at->format('Y-m-d');
$post->published_at->addDays(7);

// boolean
if ($post->is_featured) {
    // true
}

// array
$post->settings['color'] = 'red';
$post->save();

// decimal
echo $post->price; // '19.99'
```

---

## القسم السابع: Scopes

### مثال 24: Local Scopes

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

public function scopeByStatus($query, $status)
{
    return $query->where('status', $status);
}

public function scopeRecent($query, $days = 7)
{
    return $query->where('created_at', '>=', now()->subDays($days));
}

// استخدام
$posts = Post::published()->get();
$posts = Post::published()->popular()->get();
$posts = Post::byStatus('draft')->get();
$posts = Post::recent(14)->get();
```

---

### مثال 25: Global Scopes

```php
// إنشاء Global Scope Class
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
protected static function booted()
{
    static::addGlobalScope(new PublishedScope);

    // أو inline
    static::addGlobalScope('published', function (Builder $builder) {
        $builder->where('status', 'published');
    });
}

// استخدام
$posts = Post::all(); // يجلب published فقط تلقائياً

// إزالة Global Scope
$posts = Post::withoutGlobalScope(PublishedScope::class)->get();
$posts = Post::withoutGlobalScopes()->get();
```

---

## القسم الثامن: Eager Loading

### مثال 26: N+1 Problem و الحل

```php
// ❌ سيئ - N+1 Problem
$posts = Post::all(); // 1 query

foreach ($posts as $post) {
    echo $post->user->name; // N queries (واحد لكل post)
}
// إجمالي: 1 + N queries

// ✅ جيد - Eager Loading
$posts = Post::with('user')->get(); // 2 queries فقط

foreach ($posts as $post) {
    echo $post->user->name; // لا توجد queries إضافية
}
```

---

### مثال 27: Nested Eager Loading

```php
// جلب posts مع user مع profile
$posts = Post::with('user.profile')->get();

// جلب علاقات متعددة
$posts = Post::with(['user', 'comments', 'tags'])->get();

// مع شروط
$posts = Post::with(['comments' => function ($query) {
    $query->where('approved', true)
          ->orderBy('created_at', 'desc');
}])->get();

// Eager Loading Count
$posts = Post::withCount('comments')->get();
foreach ($posts as $post) {
    echo $post->comments_count;
}

// Lazy Eager Loading
$posts = Post::all();
$posts->load('user');
$posts->load(['user', 'comments']);

// Load Missing
$posts->loadMissing('user'); // يحمل فقط إذا لم يكن محمّلاً
```

---

## القسم التاسع: Advanced Features

### مثال 28: Query Scopes مع Relationships

```php
// جلب users الذين لديهم posts منشورة
$users = User::whereHas('posts', function ($query) {
    $query->where('status', 'published');
})->get();

// جلب users الذين لديهم على الأقل 5 posts
$users = User::has('posts', '>=', 5)->get();

// Count مع whereHas
$users = User::withCount(['posts' => function ($query) {
    $query->where('status', 'published');
}])->get();

// Doesn't Have
$users = User::doesntHave('posts')->get();

// Where Doesn't Have
$users = User::whereDoesntHave('posts', function ($query) {
    $query->where('status', 'draft');
})->get();
```

---

### مثال 29: Chunking & Cursor

```php
// Chunk - مفيد للبيانات الكبيرة
Post::chunk(100, function ($posts) {
    foreach ($posts as $post) {
        // Process each post
    }
});

// Chunk By ID - أكثر كفاءة
Post::chunkById(100, function ($posts) {
    foreach ($posts as $post) {
        // Process
    }
});

// Cursor - أقل استهلاك للذاكرة
foreach (Post::cursor() as $post) {
    // Process one by one
}
```

---

### مثال 30: Transactions

```php
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    $user = User::create([...]);
    $user->profile()->create([...]);
    $user->posts()->create([...]);
});

// مع Try-Catch
try {
    DB::beginTransaction();

    $user = User::create([...]);
    $user->profile()->create([...]);

    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    throw $e;
}
```

---

### مثال 31: firstOrCreate & firstOrNew

```php
// firstOrCreate - يبحث، إذا لم يجد ينشئ ويحفظ
$user = User::firstOrCreate(
    ['email' => 'john@example.com'],
    ['name' => 'John', 'password' => bcrypt('password')]
);

// firstOrNew - يبحث، إذا لم يجد ينشئ بدون حفظ
$user = User::firstOrNew(
    ['email' => 'john@example.com'],
    ['name' => 'John']
);
$user->save(); // يجب الحفظ يدوياً

// updateOrCreate - يبحث، إذا وجد يحدث، إذا لم يجد ينشئ
$user = User::updateOrCreate(
    ['email' => 'john@example.com'],
    ['name' => 'John Updated', 'password' => bcrypt('newpassword')]
);
```

---

### مثال 32: Upsert (Insert or Update Many)

```php
// إدراج أو تحديث عدة records
Flight::upsert([
    ['departure' => 'Oakland', 'destination' => 'San Diego', 'price' => 99],
    ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
], ['departure', 'destination'], ['price']);
// المعاملات: data, uniqueBy, update
```

---

### مثال 33: Soft Deletes مع Relationships

```php
// في Migration
$table->softDeletes();

// في Model
use SoftDeletes;

// Cascading Soft Deletes
protected static function booted()
{
    static::deleting(function ($post) {
        $post->comments()->delete(); // Soft delete للـ comments أيضاً
    });
}

// Force Delete مع Cascading
protected static function booted()
{
    static::forceDeleting(function ($post) {
        $post->comments()->forceDelete();
    });
}
```

---

### مثال 34: Model Events

```php
// في Model
protected static function booted()
{
    static::creating(function ($post) {
        $post->slug = Str::slug($post->title);
    });

    static::created(function ($post) {
        // بعد الإنشاء
        Log::info('Post created: ' . $post->id);
    });

    static::updating(function ($post) {
        // قبل التحديث
    });

    static::updated(function ($post) {
        // بعد التحديث
    });

    static::deleting(function ($post) {
        // قبل الحذف
    });

    static::deleted(function ($post) {
        // بعد الحذف
    });
}
```

---

### مثال 35: Query Logging

```php
use Illuminate\Support\Facades\DB;

// تفعيل Query Logging
DB::enableQueryLog();

// تنفيذ queries
$posts = Post::with('user')->where('status', 'published')->get();

// عرض جميع queries
dd(DB::getQueryLog());

// Result:
[
    [
        'query' => 'select * from posts where status = ?',
        'bindings' => ['published'],
        'time' => 0.52
    ],
    [
        'query' => 'select * from users where id in (?, ?)',
        'bindings' => [1, 2],
        'time' => 0.31
    ]
]
```

---

## ملخص الأمثلة

✅ **Migrations**: إنشاء وتعديل الجداول
✅ **Models**: التعامل مع البيانات كـ Objects
✅ **CRUD**: Create, Read, Update, Delete
✅ **Relationships**: جميع أنواع العلاقات
✅ **Query Builder**: استعلامات قوية
✅ **Collections**: معالجة البيانات
✅ **Accessors & Mutators**: تعديل البيانات
✅ **Scopes**: استعلامات قابلة لإعادة الاستخدام
✅ **Eager Loading**: تحسين الأداء
✅ **Advanced**: Transactions, Events, Soft Deletes

---

**الخطوة التالية:** انتقل إلى **التمارين العملية** لتطبيق ما تعلمته! 🚀
