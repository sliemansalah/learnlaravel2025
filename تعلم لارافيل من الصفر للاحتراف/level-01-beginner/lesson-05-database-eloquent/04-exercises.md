# تمارين عملية: Database & Eloquent ORM

## 📚 نظرة عامة

هذا الملف يحتوي على 6 تمارين عملية متدرجة من السهل إلى المتقدم لتطبيق مفاهيم Database و Eloquent ORM

---

## التمرين 1: Blog بسيط (سهل) ⭐

### المطلوب:

أنشئ نظام مدونة بسيط يحتوي على:

1. Users (مستخدمون)
2. Posts (مقالات)
3. Comments (تعليقات)
4. علاقة One to Many بين User و Posts
5. علاقة One to Many بين Post و Comments
6. CRUD كامل للمقالات

---

### الحل:

#### 1. إنشاء Models و Migrations

```bash
php artisan make:model Post -m
php artisan make:model Comment -m
```

#### 2. Posts Migration

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('content');
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->integer('views')->default(0);
    $table->timestamps();
});
```

#### 3. Comments Migration

```php
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->text('content');
    $table->boolean('approved')->default(false);
    $table->timestamps();
});
```

#### 4. Models

**Post Model:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
```

**Comment Model:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'content', 'approved'];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
}
```

#### 5. Seeder

```php
// إنشاء مستخدم
$user = User::create([
    'name' => 'أحمد',
    'email' => 'ahmad@example.com',
    'password' => bcrypt('password'),
]);

// إنشاء مقالات
$post1 = $user->posts()->create([
    'title' => 'مقالي الأول',
    'content' => 'محتوى المقال',
    'status' => 'published',
]);

// إنشاء تعليقات
$post1->comments()->create([
    'user_id' => $user->id,
    'content' => 'تعليق رائع',
    'approved' => true,
]);
```

---

## التمرين 2: E-commerce Products (متوسط) ⭐⭐

### المطلوب:

أنشئ نظام منتجات يحتوي على:

1. Categories (تصنيفات) - مع تصنيفات فرعية
2. Products (منتجات)
3. Tags (وسوم) - Many to Many مع Products
4. Scopes للبحث والتصفية
5. Accessors للسعر والعرض

---

### الحل:

#### Models & Migrations

```bash
php artisan make:model Category -m
php artisan make:model Product -m
php artisan make:model Tag -m
php artisan make:migration create_product_tag_table
```

#### Category Model (Self-Referencing)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
```

#### Product Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    // Accessor - السعر النهائي
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?: $this->price;
    }

    // Accessor - الخصم بالنسبة المئوية
    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    // Accessor - متوفر أم لا
    public function getIsAvailableAttribute()
    {
        return $this->stock > 0;
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeOnSale($query)
    {
        return $query->whereNotNull('sale_price');
    }

    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}
```

#### استخدام

```php
// منتجات متوفرة مع خصم
$products = Product::available()->onSale()->get();

// منتجات في تصنيف معين
$products = Product::inCategory(1)->get();

// منتجات ضمن نطاق سعري
$products = Product::priceBetween(50, 200)->get();

// عرض السعر النهائي
foreach ($products as $product) {
    echo $product->final_price;
    echo $product->discount_percentage . '%';
}
```

---

## التمرين 3: Social Network (متوسط) ⭐⭐⭐

### المطلوب:

أنشئ نظام تواصل اجتماعي بسيط:

1. Users يمكنهم متابعة بعضهم (Following/Followers)
2. Posts مع Likes
3. Comments متداخلة (Nested Comments)
4. Polymorphic Relationships للـ Likes

---

### الحل:

#### Follow System (Many to Many Self-Referencing)

**Migration:**
```php
Schema::create('follows', function (Blueprint $table) {
    $table->id();
    $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('following_id')->constrained('users')->onDelete('cascade');
    $table->timestamps();

    $table->unique(['follower_id', 'following_id']);
});
```

**User Model:**
```php
public function following()
{
    return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
                ->withTimestamps();
}

public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
                ->withTimestamps();
}

public function follow($userId)
{
    return $this->following()->attach($userId);
}

public function unfollow($userId)
{
    return $this->following()->detach($userId);
}

public function isFollowing($userId)
{
    return $this->following()->where('following_id', $userId)->exists();
}
```

#### Polymorphic Likes

**Migration:**
```php
Schema::create('likes', function (Blueprint $table) {
    $table->id();
    $table->morphs('likeable');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    $table->unique(['user_id', 'likeable_id', 'likeable_type']);
});
```

**Like Model:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

**Post Model:**
```php
public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}

public function isLikedBy($user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}

public function like($user)
{
    if (!$this->isLikedBy($user)) {
        return $this->likes()->create(['user_id' => $user->id]);
    }
}

public function unlike($user)
{
    return $this->likes()->where('user_id', $user->id)->delete();
}
```

#### Nested Comments

**Migration:**
```php
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
    $table->text('content');
    $table->timestamps();
});
```

**Comment Model:**
```php
public function parent()
{
    return $this->belongsTo(Comment::class, 'parent_id');
}

public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id');
}

public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}
```

---

## التمرين 4: Multi-tenant Application (متقدم) ⭐⭐⭐⭐

### المطلوب:

أنشئ تطبيق متعدد المستأجرين (Multi-tenant):

1. Companies (شركات)
2. Users ينتمون لشركات
3. Projects خاصة بكل شركة
4. Global Scope لتصفية البيانات حسب الشركة
5. Middleware للتحقق من الشركة

---

### الحل:

#### Company Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'slug', 'domain'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
```

#### Global Scope للتصفية حسب الشركة

**app/Models/Scopes/CompanyScope.php:**
```php
<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check() && auth()->user()->company_id) {
            $builder->where('company_id', auth()->user()->company_id);
        }
    }
}
```

#### Project Model مع Global Scope

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Project extends Model
{
    protected $fillable = ['company_id', 'name', 'description'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);

        // تعيين company_id تلقائياً عند الإنشاء
        static::creating(function ($project) {
            if (auth()->check() && !$project->company_id) {
                $project->company_id = auth()->user()->company_id;
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
```

#### استخدام

```php
// سيجلب فقط projects للشركة الحالية تلقائياً
$projects = Project::all();

// لجلب projects من جميع الشركات (للـ Super Admin)
$projects = Project::withoutGlobalScope(CompanyScope::class)->get();
```

---

## التمرين 5: Audit Trail System (متقدم) ⭐⭐⭐⭐

### المطلوب:

أنشئ نظام تتبع التغييرات (Audit Trail):

1. تسجيل جميع التعديلات على الـ Models
2. من قام بالتعديل
3. ما الذي تم تعديله (Old vs New Values)
4. متى تم التعديل

---

### الحل:

#### Audit Model

```bash
php artisan make:model Audit -m
```

**Migration:**
```php
Schema::create('audits', function (Blueprint $table) {
    $table->id();
    $table->morphs('auditable');
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->string('event'); // created, updated, deleted
    $table->json('old_values')->nullable();
    $table->json('new_values')->nullable();
    $table->ipAddress('ip_address')->nullable();
    $table->string('user_agent')->nullable();
    $table->timestamps();
});
```

**Audit Model:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'auditable_id',
        'auditable_type',
        'user_id',
        'event',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

#### Trait للـ Auditing

**app/Traits/Auditable.php:**
```php
<?php

namespace App\Traits;

use App\Models\Audit;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->auditEvent('created', [], $model->getAttributes());
        });

        static::updated(function ($model) {
            $model->auditEvent('updated', $model->getOriginal(), $model->getAttributes());
        });

        static::deleted(function ($model) {
            $model->auditEvent('deleted', $model->getAttributes(), []);
        });
    }

    public function audits()
    {
        return $this->morphMany(Audit::class, 'auditable');
    }

    protected function auditEvent($event, $oldValues, $newValues)
    {
        Audit::create([
            'auditable_id' => $this->id,
            'auditable_type' => get_class($this),
            'user_id' => auth()->id(),
            'event' => $event,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
```

#### استخدام

```php
// في Model
use App\Traits\Auditable;

class Post extends Model
{
    use Auditable;

    // ...
}

// عرض التغييرات
$post = Post::find(1);
foreach ($post->audits as $audit) {
    echo $audit->event;
    echo $audit->user->name;
    print_r($audit->old_values);
    print_r($audit->new_values);
}
```

---

## التمرين 6: Advanced E-learning Platform (متقدم جداً) ⭐⭐⭐⭐⭐

### المطلوب:

أنشئ منصة تعليمية متقدمة تحتوي على:

1. Instructors (مدرسون)
2. Courses (دورات) مع Sections و Lessons
3. Students يمكنهم التسجيل في Courses
4. Progress Tracking (تتبع التقدم)
5. Certificates عند الإنهاء
6. Reviews & Ratings
7. Polymorphic Comments على Courses و Lessons
8. Tags للدورات (Many to Many)

**المتطلبات الإضافية:**
- Eager Loading لتحسين الأداء
- Scopes معقدة
- Accessors & Mutators
- Events & Observers
- Transactions

---

### الهيكل المطلوب:

```
Instructors
├── Courses
│   ├── Sections
│   │   └── Lessons
│   ├── Enrollments (Students)
│   ├── Reviews
│   └── Tags

Students
├── Enrollments
├── Progress
└── Certificates
```

_(الحل التفصيلي طويل جداً، يمكن تطبيقه كمشروع متكامل)_

---

## ملخص التمارين

✅ **التمرين 1**: Blog بسيط - One to Many
✅ **التمرين 2**: E-commerce - Many to Many, Accessors, Scopes
✅ **التمرين 3**: Social Network - Self-Referencing, Polymorphic
✅ **التمرين 4**: Multi-tenant - Global Scopes
✅ **التمرين 5**: Audit Trail - Events, Traits
✅ **التمرين 6**: E-learning Platform - كل المفاهيم معاً

---

## نصائح للممارسة

1. **ابدأ بالتمارين السهلة** ثم انتقل للأصعب
2. **حاول حل التمرين بنفسك أولاً** قبل النظر للحل
3. **أضف ميزات إضافية** لكل تمرين
4. **استخدم Tinker للتجربة**: `php artisan tinker`
5. **راجع N+1 Problem** واستخدم Eager Loading
6. **استخدم Query Logging** لرؤية الاستعلامات: `DB::enableQueryLog()`

---

**تهانينا! 🎉 أنت الآن جاهز لبناء تطبيقات Laravel معقدة!**
