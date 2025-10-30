# الدرس 7 - بطاقة مرجعية سريعة

## 🔗 One to One

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

// الاستخدام
$user = User::find(1);
$profile = $user->profile;

$profile = Profile::find(1);
$user = $profile->user;

// إنشاء
$user->profile()->create(['bio' => 'Developer']);
```

---

## 🔗 One to Many

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

// الاستخدام
$user = User::find(1);
$posts = $user->posts;
$posts = $user->posts()->where('published', true)->get();

$post = Post::find(1);
$user = $post->user;

// إنشاء
$user->posts()->create(['title' => 'Title']);
$user->posts()->createMany([...]);
```

---

## 🔗 Many to Many

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

// الاستخدام
$post = Post::find(1);
$tags = $post->tags;

// إضافة
$post->tags()->attach(1);
$post->tags()->attach([1, 2, 3]);

// إزالة
$post->tags()->detach(1);
$post->tags()->detach(); // الكل

// مزامنة
$post->tags()->sync([1, 2, 3]);
$post->tags()->syncWithoutDetaching([4, 5]);

// تبديل
$post->tags()->toggle([1, 2]);
```

---

## 🔗 Pivot مع بيانات إضافية

```php
// Post Model
public function tags()
{
    return $this->belongsToMany(Tag::class)
                ->withPivot('order', 'notes')
                ->withTimestamps();
}

// إضافة مع بيانات
$post->tags()->attach(1, ['order' => 1]);

// الوصول للبيانات
foreach ($post->tags as $tag) {
    echo $tag->pivot->order;
    echo $tag->pivot->created_at;
}

// مزامنة مع بيانات
$post->tags()->sync([
    1 => ['order' => 1],
    2 => ['order' => 2],
]);
```

---

## 🔗 Has Many Through

```php
// Country Model
public function posts()
{
    return $this->hasManyThrough(
        Post::class,   // النموذج النهائي
        User::class,   // النموذج الوسيط
        'country_id',  // FK على users
        'user_id',     // FK على posts
        'id',          // Local key على countries
        'id'           // Local key على users
    );
}

// الاستخدام
$country = Country::find(1);
$posts = $country->posts;
```

---

## 🔗 Polymorphic Relations

```php
// Migration
$table->morphs('commentable'); // commentable_id + commentable_type

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

// الاستخدام
$post = Post::find(1);
$comments = $post->comments;

$comment = Comment::find(1);
$commentable = $comment->commentable; // Post أو Video

// إنشاء
$post->comments()->create(['content' => 'Great!']);
```

---

## 🔗 Many to Many Polymorphic

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

// الاستخدام
$post->tags()->attach([1, 2, 3]);
$tag = Tag::find(1);
$posts = $tag->posts;
$videos = $tag->videos;
```

---

## ⚡ Eager Loading

```php
// تحميل علاقة واحدة
$posts = Post::with('user')->get();

// تحميل عدة علاقات
$posts = Post::with(['user', 'comments', 'tags'])->get();

// تحميل متداخل
$posts = Post::with('user.profile')->get();
$posts = Post::with('comments.user')->get();

// تحميل متعدد متداخل
$posts = Post::with([
    'user.profile',
    'comments.user',
    'tags'
])->get();

// تحميل مع شروط
$posts = Post::with(['comments' => function ($query) {
    $query->where('approved', true)
          ->latest()
          ->take(5);
}])->get();

// Lazy Eager Loading
$posts = Post::all();
$posts->load('user');
$posts->loadMissing('user'); // إذا لم يكن محملاً

// عد العلاقات
$posts = Post::withCount('comments')->get();
echo $posts[0]->comments_count;

// عد مع شروط
$posts = Post::withCount([
    'comments',
    'comments as approved_comments_count' => function ($query) {
        $query->where('approved', true);
    }
])->get();
```

---

## 🔍 البحث في العلاقات

```php
// whereHas - البحث بشرط
$posts = Post::whereHas('user', function ($query) {
    $query->where('country_id', 1);
})->get();

$posts = Post::whereHas('comments', function ($query) {
    $query->where('approved', true);
})->get();

// doesntHave - ليس لديه
$posts = Post::doesntHave('comments')->get();

// has - لديه
$posts = Post::has('comments')->get();
$posts = Post::has('comments', '>=', 5)->get();

// orWhereHas
$posts = Post::whereHas('tags', function ($query) {
    $query->where('name', 'Laravel');
})->orWhereHas('tags', function ($query) {
    $query->where('name', 'PHP');
})->get();
```

---

## 🎯 أمثلة سريعة

```php
// منشور مع كل العلاقات
$post = Post::with([
    'user.profile',
    'comments.user',
    'tags'
])->find(1);

// مستخدمون مع عدد المنشورات
$users = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();

// منشورات بدون تعليقات
$posts = Post::doesntHave('comments')->get();

// منشورات من دولة معينة
$posts = Post::whereHas('user', function ($query) {
    $query->where('country_id', 1);
})->get();

// إحصائيات
$user = User::withCount(['posts', 'comments'])->find(1);
echo "Posts: " . $user->posts_count;
echo "Comments: " . $user->comments_count;
```

---

## 📝 Migration Patterns

```php
// One to Many
$table->foreignId('user_id')->constrained()->onDelete('cascade');

// Many to Many (Pivot Table)
Schema::create('post_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->foreignId('tag_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    $table->unique(['post_id', 'tag_id']);
});

// Polymorphic
$table->morphs('commentable'); // commentable_id + commentable_type

// أو يدوياً
$table->unsignedBigInteger('commentable_id');
$table->string('commentable_type');
$table->index(['commentable_id', 'commentable_type']);
```

---

## ✅ أفضل الممارسات

✅ استخدم Eager Loading دائماً
✅ استخدم withCount للإحصائيات
✅ حدد الأعمدة المطلوبة: `with('user:id,name')`
✅ استخدم whereHas للبحث في العلاقات

❌ لا تنسى Eager Loading (مشكلة N+1)
❌ لا تستخدم get() مرتين
❌ لا تنسى تعريف belongsTo

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [الدرس السابق](../lesson-06/README.md)
- [الدرس التالي](../lesson-08/README.md)
