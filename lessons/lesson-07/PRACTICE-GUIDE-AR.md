# دليل التطبيق العملي للدرس السابع

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-07\practice-app

# إعداد قاعدة البيانات
copy .env.example .env
php artisan key:generate

# تشغيل Migrations
php artisan migrate

# تشغيل Seeders
php artisan db:seed

# تشغيل الخادم
php artisan serve
```

---

## 📋 العلاقات المنفذة

### 1. One to One: User → Profile

**Models:**
- User.php: `hasOne(Profile::class)`
- Profile.php: `belongsTo(User::class)`

**الاستخدام:**
```php
$user = User::find(1);
echo $user->profile->bio;
echo $user->profile->website;
```

---

### 2. One to Many: User → Posts

**Models:**
- User.php: `hasMany(Post::class)`
- Post.php: `belongsTo(User::class)`

**الاستخدام:**
```php
$user = User::find(1);
foreach ($user->posts as $post) {
    echo $post->title;
}

$post = Post::find(1);
echo $post->user->name;
```

---

### 3. Many to Many: Posts ←→ Tags

**Models:**
- Post.php: `belongsToMany(Tag::class)`
- Tag.php: `belongsToMany(Post::class)`

**الاستخدام:**
```php
$post = Post::find(1);
$post->tags()->attach([1, 2, 3]);

foreach ($post->tags as $tag) {
    echo $tag->name;
}
```

---

### 4. Polymorphic: Comments على Posts/Videos

**Models:**
- Comment.php: `morphTo()`
- Post.php: `morphMany(Comment::class, 'commentable')`
- Video.php: `morphMany(Comment::class, 'commentable')`

**الاستخدام:**
```php
$post = Post::find(1);
$post->comments()->create(['content' => 'رائع!']);

$comment = Comment::find(1);
$commentable = $comment->commentable;
```

---

## 🌱 أمثلة Seeders

```php
// UserSeeder
User::factory()->create([
    'name' => 'أحمد',
    'email' => 'ahmad@example.com',
]);

// ProfileSeeder
Profile::create([
    'user_id' => 1,
    'bio' => 'مطور Laravel',
    'website' => 'https://example.com',
]);

// PostSeeder
Post::create([
    'user_id' => 1,
    'title' => 'تعلم Laravel',
    'content' => 'محتوى المنشور...',
]);

// TagSeeder
$tags = ['Laravel', 'PHP', 'Web Development'];
foreach ($tags as $tag) {
    Tag::create(['name' => $tag, 'slug' => Str::slug($tag)]);
}

// ربط Tags بالمنشورات
$post = Post::find(1);
$post->tags()->attach([1, 2, 3]);
```

---

## 🎯 أمثلة الاستخدام

### مثال 1: Eager Loading

```php
// ❌ مشكلة N+1
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->user->name; // query لكل منشور
}

// ✅ Eager Loading
$posts = Post::with('user')->get();
foreach ($posts as $post) {
    echo $post->user->name; // لا توجد queries إضافية
}

// تحميل عدة علاقات
$posts = Post::with(['user', 'comments', 'tags'])->get();

// تحميل متداخل
$posts = Post::with('user.profile')->get();
$posts = Post::with('comments.user')->get();
```

---

### مثال 2: withCount

```php
// عد التعليقات
$posts = Post::withCount('comments')->get();
foreach ($posts as $post) {
    echo "{$post->title}: {$post->comments_count} تعليق";
}

// عد عدة علاقات
$users = User::withCount(['posts', 'comments'])
            ->orderBy('posts_count', 'desc')
            ->get();
```

---

### مثال 3: whereHas

```php
// منشورات من مستخدمين نشطين
$posts = Post::whereHas('user', function ($query) {
    $query->where('is_active', true);
})->get();

// منشورات لها تعليقات معتمدة
$posts = Post::whereHas('comments', function ($query) {
    $query->where('approved', true);
})->get();

// منشورات بدون تعليقات
$posts = Post::doesntHave('comments')->get();

// منشورات لها 5 تعليقات على الأقل
$posts = Post::has('comments', '>=', 5)->get();
```

---

### مثال 4: Many to Many Operations

```php
$post = Post::find(1);

// إضافة وسوم
$post->tags()->attach(1);
$post->tags()->attach([1, 2, 3]);
$post->tags()->attach(1, ['order' => 1]); // مع بيانات إضافية

// إزالة وسوم
$post->tags()->detach(1);
$post->tags()->detach([1, 2]);
$post->tags()->detach(); // إزالة الكل

// مزامنة (استبدال)
$post->tags()->sync([1, 2, 3]);

// مزامنة بدون حذف
$post->tags()->syncWithoutDetaching([4, 5]);

// تبديل
$post->tags()->toggle([1, 2]);

// التحقق
if ($post->tags->contains(1)) {
    echo "لديه الوسم";
}
```

---

### مثال 5: Polymorphic Comments

```php
// تعليق على منشور
$post = Post::find(1);
$comment = $post->comments()->create([
    'content' => 'منشور رائع!',
]);

// تعليق على فيديو
$video = Video::find(1);
$comment = $video->comments()->create([
    'content' => 'فيديو مفيد!',
]);

// الحصول على العنصر من التعليق
$comment = Comment::find(1);
$commentable = $comment->commentable;

if ($commentable instanceof Post) {
    echo "تعليق على منشور: " . $commentable->title;
} elseif ($commentable instanceof Video) {
    echo "تعليق على فيديو: " . $commentable->title;
}
```

---

## 🔍 اختبار باستخدام Tinker

```bash
php artisan tinker
```

```php
// اختبار One to One
$user = User::find(1);
$user->profile;
$user->profile->bio;

// اختبار One to Many
$user->posts;
$user->posts()->count();

// اختبار Many to Many
$post = Post::find(1);
$post->tags;
$post->tags()->attach(1);
$post->tags()->sync([1, 2, 3]);

// اختبار Eager Loading
Post::with('user')->get();
Post::with(['user', 'comments', 'tags'])->get();

// اختبار withCount
Post::withCount('comments')->get();
User::withCount(['posts', 'comments'])->get();

// اختبار whereHas
Post::whereHas('tags', function ($query) {
    $query->where('name', 'Laravel');
})->get();

// اختبار Polymorphic
$post = Post::find(1);
$post->comments()->create(['content' => 'Test']);
$comment = Comment::find(1);
$comment->commentable;
```

---

## 💡 نصائح مهمة

### ✅ أفضل الممارسات

1. استخدم Eager Loading دائماً لتجنب مشكلة N+1
2. استخدم withCount للإحصائيات بدلاً من count()
3. استخدم whereHas للبحث في العلاقات
4. حدد الأعمدة المطلوبة: `with('user:id,name')`
5. استخدم Soft Deletes مع onDelete('cascade')

### ⚠️ أخطاء شائعة

1. نسيان Eager Loading (مشكلة N+1)
2. استخدام get() مرتين
3. نسيان تعريف belongsTo في الجهة الأخرى
4. عدم إضافة Foreign Keys في Migrations
5. نسيان unique() في Pivot Tables

---

## 📝 أوامر مفيدة

```bash
# إنشاء Models مع Migrations
php artisan make:model Post -m
php artisan make:model Profile -m

# إنشاء Seeder
php artisan make:seeder PostSeeder

# تشغيل Migrations
php artisan migrate
php artisan migrate:fresh --seed

# Tinker
php artisan tinker
```

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 8**: Validation and Form Requests
- Basic Validation
- Form Request Classes
- Custom Validation Rules

---

**تعلم سعيد! 🚀**
