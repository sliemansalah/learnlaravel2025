# الدرس الخامس - الاختبار مع الإجابات: Database & Eloquent ORM

## 📋 معلومات الاختبار

- **عدد الأسئلة**: 50 سؤال
- **الوقت المقدر**: 60 دقيقة
- **الدرجة الكلية**: 100 درجة
- **درجة النجاح**: 70%

---

## القسم الأول: أسئلة الاختيار من متعدد (30 سؤال × 2 درجة = 60 درجة)

### السؤال 1
ما هو ORM؟

A) Object Relational Mapping
B) Online Resource Manager
C) Object Resource Model
D) Operational Relation Method

**الإجابة الصحيحة**: A

**الشرح**: ORM هو Object-Relational Mapping - تقنية تسمح بالتعامل مع قاعدة البيانات كـ Objects.

---

### السؤال 2
ما الأمر لإنشاء Migration في Laravel؟

A) php artisan create:migration
B) php artisan make:migration
C) php artisan new:migration
D) php artisan generate:migration

**الإجابة الصحيحة**: B

**الشرح**: `php artisan make:migration` هو الأمر الصحيح لإنشاء migration جديد.

---

### السؤال 3
أين يتم حفظ Migrations في Laravel؟

A) app/Migrations/
B) database/migrations/
C) storage/migrations/
D) resources/migrations/

**الإجابة الصحيحة**: B

**الشرح**: جميع Migrations يتم حفظها في `database/migrations/`.

---

### السؤال 4
ما الفرق بين `migrate` و `migrate:fresh`؟

A) لا فرق
B) fresh يحذف جميع الجداول ثم يعيد إنشاءها
C) fresh أسرع فقط
D) migrate للإنتاج، fresh للتطوير

**الإجابة الصحيحة**: B

**الشرح**: `migrate:fresh` يحذف جميع الجداول ثم ينفذ جميع migrations من جديد، بينما `migrate` ينفذ فقط migrations الجديدة.

---

### السؤال 5
ما نوع العمود المناسب لحفظ Email؟

A) $table->text('email')
B) $table->string('email')
C) $table->varchar('email')
D) $table->email('email')

**الإجابة الصحيحة**: B

**الشرح**: `string()` هو النوع المناسب للـ email، مع إمكانية إضافة `->unique()`.

---

### السؤال 6
كيف تضيف Foreign Key في Migration؟

A) $table->foreign('user_id')
B) $table->foreignId('user_id')->constrained()
C) $table->fk('user_id')
D) $table->relation('user_id')

**الإجابة الصحيحة**: B

**الشرح**: `foreignId()->constrained()` هي الطريقة الحديثة والأفضل لإضافة foreign key.

---

### السؤال 7
ما هي Naming Convention لـ table name في Laravel؟

A) مفرد، PascalCase
B) جمع، snake_case
C) مفرد، snake_case
D) جمع، camelCase

**الإجابة الصحيحة**: B

**الشرح**: اسم الجدول يكون جمع بصيغة snake_case (مثل: `users`, `blog_posts`).

---

### السؤال 8
ما الأمر لإنشاء Model مع Migration؟

A) php artisan make:model Post -m
B) php artisan make:model Post --migration
C) php artisan make:model Post -a
D) A و B صحيحة

**الإجابة الصحيحة**: D

**الشرح**: كلاً من `-m` و `--migration` يعملان بنفس الطريقة لإنشاء migration مع model.

---

### السؤال 9
ما المقصود بـ `$fillable` في Model؟

A) الأعمدة المطلوبة
B) الأعمدة القابلة للتعبئة الجماعية (Mass Assignment)
C) الأعمدة الفريدة
D) الأعمدة المخفية

**الإجابة الصحيحة**: B

**الشرح**: `$fillable` يحدد الأعمدة المسموح بها في Mass Assignment لحماية من ثغرات أمنية.

---

### السؤال 10
ما الفرق بين `$fillable` و `$guarded`؟

A) لا فرق
B) fillable للسماح، guarded للمنع
C) fillable للقراءة، guarded للكتابة
D) fillable أسرع

**الإجابة الصحيحة**: B

**الشرح**: `$fillable` يحدد الأعمدة **المسموحة**، `$guarded` يحدد الأعمدة **الممنوعة**.

---

### السؤال 11
كيف تحفظ record جديد في Eloquent؟

A) Post::insert([...])
B) Post::create([...])
C) Post::save([...])
D) Post::add([...])

**الإجابة الصحيحة**: B

**الشرح**: `create()` هي الطريقة المباشرة لإنشاء record جديد (يجب تعريف `$fillable`).

---

### السؤال 12
ما الفرق بين `find()` و `findOrFail()`؟

A) لا فرق
B) findOrFail يرمي Exception إذا لم يجد
C) find أسرع
D) findOrFail يبحث في Soft Deleted

**الإجابة الصحيحة**: B

**الشرح**: `findOrFail()` يرمي `ModelNotFoundException` إذا لم يجد السجل، مفيد لعرض 404.

---

### السؤال 13
كيف تحذف record في Eloquent؟

A) Post::remove(1)
B) Post::delete(1)
C) Post::destroy(1)
D) B و C صحيحة

**الإجابة الصحيحة**: D

**الشرح**: كلاً من `delete()` و `destroy()` يعملان، لكن `destroy()` يمكن أن يأخذ عدة IDs.

---

### السؤال 14
ما المقصود بـ Soft Delete؟

A) حذف بطيء
B) حذف مؤقت يمكن استعادته
C) حذف جزئي
D) حذف آمن

**الإجابة الصحيحة**: B

**الشرح**: Soft Delete يضيف `deleted_at` timestamp بدلاً من حذف السجل نهائياً، يمكن استعادته لاحقاً.

---

### السؤال 15
ما علاقة One to One؟

A) hasOne / belongsTo
B) hasMany / belongsTo
C) belongsToMany
D) morphTo

**الإجابة الصحيحة**: A

**الشرح**: علاقة One to One تستخدم `hasOne()` في Model الأول و `belongsTo()` في الثاني.

---

### السؤال 16
ما علاقة One to Many؟

A) hasOne / belongsTo
B) hasMany / belongsTo
C) belongsToMany
D) hasManyThrough

**الإجابة الصحيحة**: B

**الشرح**: One to Many تستخدم `hasMany()` في Model الأول و `belongsTo()` في الثاني.

---

### السؤال 17
ما علاقة Many to Many؟

A) hasMany
B) belongsTo
C) belongsToMany في كلا الـ Models
D) morphMany

**الإجابة الصحيحة**: C

**الشرح**: Many to Many تحتاج `belongsToMany()` في كلا Models مع pivot table.

---

### السؤال 18
ما اسم Pivot Table لـ Many to Many بين `posts` و `tags`؟

A) posts_tags
B) post_tag (أبجدي)
C) tags_posts
D) أي اسم

**الإجابة الصحيحة**: B

**الشرح**: Pivot table يجب أن يكون مفرد وأبجدي: `post_tag`.

---

### السؤال 19
كيف تربط tag بـ post في Many to Many؟

A) $post->tags()->attach($tagId)
B) $post->tags()->link($tagId)
C) $post->tags()->connect($tagId)
D) $post->tags()->add($tagId)

**الإجابة الصحيحة**: A

**الشرح**: `attach()` يستخدم لربط علاقة Many to Many.

---

### السؤال 20
ما الفرق بين `attach()` و `sync()`؟

A) لا فرق
B) sync يحذف القديم ويضيف الجديد
C) attach أسرع
D) sync للقراءة فقط

**الإجابة الصحيحة**: B

**الشرح**: `attach()` يضيف فقط، `sync()` يحذف الروابط القديمة ويضيف الجديدة.

---

### السؤال 21
ما هي Polymorphic Relationship؟

A) علاقة عادية
B) علاقة حيث Model يمكن أن يرتبط بأكثر من model type
C) علاقة معقدة
D) علاقة متعددة

**الإجابة الصحيحة**: B

**الشرح**: Polymorphic تسمح لـ model (مثل Comment) بالارتباط بعدة models (Post, Video).

---

### السؤال 22
ما الأعمدة المطلوبة في Polymorphic Relationship؟

A) model_id, model_type
B) polymorphic_id, polymorphic_type
C) commentable_id, commentable_type (حسب الاسم)
D) id, type

**الإجابة الصحيحة**: C

**الشرح**: تحتاج `{name}_id` و `{name}_type` (مثل: `commentable_id`, `commentable_type`).

---

### السؤال 23
ما هو Accessor في Eloquent؟

A) دالة للقراءة وتعديل القيمة عند الاسترجاع
B) دالة للكتابة
C) دالة للحذف
D) دالة للبحث

**الإجابة الصحيحة**: A

**الشرح**: Accessor يعدل القيمة عند **قراءتها** من Database.

---

### السؤال 24
ما هو Mutator في Eloquent؟

A) دالة للقراءة
B) دالة للكتابة وتعديل القيمة قبل الحفظ
C) دالة للحذف
D) دالة للبحث

**الإجابة الصحيحة**: B

**الشرح**: Mutator يعدل القيمة عند **كتابتها** إلى Database.

---

### السؤال 25
ما هو Local Scope؟

A) استعلام محلي
B) دالة مساعدة لاستعلامات متكررة
C) scope عام
D) scope محدود

**الإجابة الصحيحة**: B

**الشرح**: Local Scope دالة في Model تبدأ بـ `scope` لتسهيل الاستعلامات المتكررة.

---

### السؤال 26
كيف تكتب Local Scope اسمه `published`؟

A) public function published()
B) public function scopePublished($query)
C) public function scope_published($query)
D) protected function published()

**الإجابة الصحيحة**: B

**الشرح**: Local Scope يبدأ بـ `scope` ثم اسم Scope بصيغة PascalCase.

---

### السؤال 27
ما هو Global Scope؟

A) scope عام
B) scope يطبق تلقائياً على جميع استعلامات Model
C) scope سريع
D) scope معقد

**الإجابة الصحيحة**: B

**الشرح**: Global Scope يطبق تلقائياً على **جميع** استعلامات Model.

---

### السؤال 28
ما هي مشكلة N+1 Query؟

A) استعلام بطيء
B) تنفيذ 1 + N استعلامات بدلاً من استعلامين
C) خطأ في الاستعلام
D) استعلام معقد

**الإجابة الصحيحة**: B

**الشرح**: N+1 يحدث عند جلب relations في loop، ينفذ استعلام لكل record.

---

### السؤال 29
ما الحل لـ N+1 Problem؟

A) استخدام Cache
B) Eager Loading مع with()
C) تقليل البيانات
D) استخدام Raw SQL

**الإجابة الصحيحة**: B

**الشرح**: Eager Loading باستخدام `with()` يجلب العلاقات في استعلام واحد.

---

### السؤال 30
ما الفرق بين `get()` و `all()`؟

A) لا فرق
B) get() يمكن استخدامها بعد where، all() لا
C) all() أسرع
D) get() للكل، all() لجزء

**الإجابة الصحيحة**: B

**الشرح**: `all()` تجلب كل السجلات دائماً، `get()` تنفذ الاستعلام الحالي (مع where وغيره).

---

## القسم الثاني: أسئلة صح أو خطأ (20 سؤال × 1 درجة = 20 درجة)

### السؤال 31
Migration يمكن التراجع عنه باستخدام `rollback`.

**الإجابة**: صح ✓

**الشرح**: `php artisan migrate:rollback` يتراجع عن آخر batch من migrations.

---

### السؤال 32
Primary Key الافتراضي في Eloquent هو `id`.

**الإجابة**: صح ✓

**الشرح**: Laravel يفترض أن Primary Key هو `id` auto-increment.

---

### السؤال 33
يمكن استخدام `$table->timestamps()` لإضافة `created_at` و `updated_at` تلقائياً.

**الإجابة**: صح ✓

**الشرح**: `timestamps()` يضيف العمودين تلقائياً.

---

### السؤال 34
`$guarded = []` يعني السماح لجميع الأعمدة في Mass Assignment.

**الإجابة**: صح ✓

**الشرح**: `$guarded = []` يعني لا توجد أعمدة محمية، لكن **خطر** أمنياً.

---

### السؤال 35
`create()` و `new ... save()` لهما نفس النتيجة.

**الإجابة**: صح ✓

**الشرح**: كلاهما ينشئ record جديد، لكن `create()` أقصر.

---

### السؤال 36
`update()` يعمل على model واحد فقط.

**الإجابة**: خطأ ✗

**الشرح**: `update()` يمكن أن يعمل على عدة records باستخدام query builder.

---

### السؤال 37
Soft Delete يحذف السجل نهائياً.

**الإجابة**: خطأ ✗

**الشرح**: Soft Delete يضيف `deleted_at` فقط، السجل يبقى في Database.

---

### السؤال 38
`belongsTo()` توضع في الـ Model الذي يحتوي Foreign Key.

**الإجابة**: صح ✓

**الشرح**: `belongsTo()` دائماً في Model الذي فيه Foreign Key.

---

### السؤال 39
Pivot Table في Many to Many يجب أن يحتوي على Primary Key.

**الإجابة**: خطأ ✗

**الشرح**: ليس ضرورياً، لكن يُنصح به للمرونة.

---

### السؤال 40
`withPivot()` يستخدم لجلب أعمدة إضافية من Pivot Table.

**الإجابة**: صح ✓

**الشرح**: `withPivot()` يسمح بالوصول لأعمدة إضافية في pivot.

---

### السؤال 41
Polymorphic Relationship تحتاج `morphs()` في Migration.

**الإجابة**: صح ✓

**الشرح**: `$table->morphs('commentable')` يضيف `commentable_id` و `commentable_type`.

---

### السؤال 42
Accessor يبدأ بـ `get` وينتهي بـ `Attribute`.

**الإجابة**: صح ✓

**الشرح**: مثال: `getTitleAttribute()`.

---

### السؤال 43
Mutator يبدأ بـ `set` وينتهي بـ `Attribute`.

**الإجابة**: صح ✓

**الشرح**: مثال: `setTitleAttribute()`.

---

### السؤال 44
Local Scope يمكن استدعاؤه بدون كلمة `scope` في الاستخدام.

**الإجابة**: صح ✓

**الشرح**: `scopePublished()` يُستدعى كـ `Post::published()`.

---

### السؤال 45
Global Scope يطبق على جميع الاستعلامات تلقائياً.

**الإجابة**: صح ✓

**الشرح**: Global Scope يطبق تلقائياً ما لم يتم تعطيله بـ `withoutGlobalScope()`.

---

### السؤال 46
`with()` يستخدم لـ Eager Loading.

**الإجابة**: صح ✓

**الشرح**: `with()` يجلب العلاقات في نفس الاستعلام.

---

### السؤال 47
`load()` يستخدم لـ Lazy Eager Loading.

**الإجابة**: صح ✓

**الشرح**: `load()` يجلب العلاقات بعد استرجاع Model.

---

### السؤال 48
`chunk()` مفيد للبيانات الكبيرة.

**الإجابة**: صح ✓

**الشرح**: `chunk()` يقسم النتائج لأجزاء صغيرة لتوفير الذاكرة.

---

### السؤال 49
`exists()` أسرع من `count() > 0`.

**الإجابة**: صح ✓

**الشرح**: `exists()` يتوقف عند إيجاد أول سجل، أسرع من عد الكل.

---

### السؤال 50
Transaction يضمن تنفيذ جميع العمليات أو لا شيء.

**الإجابة**: صح ✓

**الشرح**: Transaction يضمن Atomicity - إما كل العمليات أو لا شيء.

---

## القسم الثالث: أسئلة مقالية وبرمجية (5 أسئلة × 4 درجات = 20 درجة)

### السؤال 51
اكتب Migration كامل لجدول `products` يحتوي على:
- id
- category_id (Foreign Key)
- name
- slug (unique)
- price (decimal)
- stock (integer)
- timestamps

**الإجابة:**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

---

### السؤال 52
اكتب Model كامل لـ `Post` مع:
- Relationship مع User (belongsTo)
- Relationship مع Comments (hasMany)
- Local Scope للـ published posts
- Accessor للـ excerpt (أول 100 حرف من content)

**الإجابة:**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
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

    // Local Scope
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Accessor
    public function getExcerptAttribute()
    {
        return Str::limit($this->content, 100);
    }
}
```

---

### السؤال 53
اشرح مشكلة N+1 Query مع مثال وحلها.

**الإجابة:**

**المشكلة:**
```php
// ❌ N+1 Problem - سيئ
$posts = Post::all(); // 1 query

foreach ($posts as $post) {
    echo $post->user->name; // N queries (واحد لكل post)
}

// إجمالي: 1 + N queries
// لو عندنا 100 post = 101 query!
```

**الشرح:**
- يتم تنفيذ استعلام واحد لجلب Posts
- ثم استعلام لكل Post لجلب User الخاص به
- إذا كان عندنا 100 post، سيتم تنفيذ 101 استعلام

**الحل - Eager Loading:**
```php
// ✅ Eager Loading - جيد
$posts = Post::with('user')->get(); // 2 queries فقط

foreach ($posts as $post) {
    echo $post->user->name; // لا توجد queries إضافية
}

// إجمالي: 2 queries فقط بغض النظر عن عدد Posts
```

**استعلامات يتم تنفيذها:**
1. `SELECT * FROM posts`
2. `SELECT * FROM users WHERE id IN (1,2,3,...)`

**الفوائد:**
- تحسين كبير في الأداء
- تقليل الاستعلامات من 101 إلى 2
- توفير موارد Database

---

### السؤال 54
اكتب كود لإنشاء علاقة Many to Many بين `Post` و `Tag` مع pivot data (added_by).

**الإجابة:**

**Migration للـ Pivot Table:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('tag_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('added_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->timestamps();

            $table->unique(['post_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
```

**Post Model:**
```php
public function tags()
{
    return $this->belongsToMany(Tag::class)
                ->withPivot('added_by')
                ->withTimestamps();
}
```

**Tag Model:**
```php
public function posts()
{
    return $this->belongsToMany(Post::class)
                ->withPivot('added_by')
                ->withTimestamps();
}
```

**استخدام:**
```php
// الربط مع pivot data
$post = Post::find(1);
$post->tags()->attach($tagId, [
    'added_by' => auth()->id()
]);

// أو
$post->tags()->attach([
    1 => ['added_by' => auth()->id()],
    2 => ['added_by' => auth()->id()],
]);

// الوصول للـ pivot data
foreach ($post->tags as $tag) {
    echo $tag->pivot->added_by;
    echo $tag->pivot->created_at;
}
```

---

### السؤال 55
اكتب كود Transaction لإنشاء User مع Profile و Post في نفس الوقت.

**الإجابة:**

```php
<?php

use Illuminate\Support\Facades\DB;
use App\Models\User;

try {
    DB::transaction(function () {
        // إنشاء User
        $user = User::create([
            'name' => 'أحمد محمد',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
        ]);

        // إنشاء Profile للـ User
        $user->profile()->create([
            'bio' => 'مطور Laravel',
            'avatar' => 'avatar.jpg',
            'phone' => '0501234567',
        ]);

        // إنشاء Post للـ User
        $user->posts()->create([
            'title' => 'مقالي الأول',
            'content' => 'محتوى المقال الأول',
            'status' => 'published',
        ]);

        // إذا نجحت جميع العمليات، يتم commit تلقائياً
        return $user;
    });

    echo "تم إنشاء User مع Profile و Post بنجاح";

} catch (\Exception $e) {
    // إذا فشلت أي عملية، يتم rollback تلقائياً
    echo "حدث خطأ: " . $e->getMessage();
}
```

**أو باستخدام Try-Catch Manual:**
```php
use Illuminate\Support\Facades\DB;

DB::beginTransaction();

try {
    $user = User::create([...]);
    $user->profile()->create([...]);
    $user->posts()->create([...]);

    DB::commit();
    echo "نجح";

} catch (\Exception $e) {
    DB::rollBack();
    echo "فشل: " . $e->getMessage();
}
```

**الفوائد:**
- **Atomicity**: إما جميع العمليات أو لا شيء
- **Consistency**: البيانات متسقة دائماً
- **Safety**: حماية من البيانات الجزئية

---

## 📊 حساب الدرجات

- **القسم الأول (1-30)**: _____ / 60
- **القسم الثاني (31-50)**: _____ / 20
- **القسم الثالث (51-55)**: _____ / 20
- **المجموع الكلي**: _____ / 100

---

## معايير التقييم

| النسبة المئوية | التقدير |
|----------------|---------|
| 90% - 100% | ممتاز |
| 80% - 89% | جيد جداً |
| 70% - 79% | جيد |
| 60% - 69% | مقبول |
| أقل من 60% | راسب |

---

**تهانينا على إكمال الاختبار! 🎉**
