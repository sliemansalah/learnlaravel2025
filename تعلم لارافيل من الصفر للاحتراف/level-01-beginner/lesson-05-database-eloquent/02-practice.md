# التطبيق العملي: نظام إدارة مكتبة متكامل (Library Management System)

## 🎯 هدف المشروع

بناء نظام إدارة مكتبة متكامل يطبق جميع مفاهيم Database و Eloquent ORM

## 📋 المتطلبات

- Laravel مثبت
- معرفة بـ Routes و Controllers و Views
- فهم الدرس النظري

---

## المشروع: Library Management System

### ميزات المشروع:

```
✅ إدارة الكتب (Books)
✅ إدارة المؤلفين (Authors)
✅ إدارة الأعضاء (Members)
✅ إدارة الاستعارات (Borrowings)
✅ التصنيفات (Categories)
✅ الناشرين (Publishers)
✅ علاقات معقدة بين الجداول
✅ Many to Many relationships
✅ Polymorphic relationships
✅ Scopes و Accessors
✅ Soft Deletes
✅ Eager Loading
```

---

## الخطوة 1: إعداد المشروع

### 1.1 إنشاء مشروع Laravel جديد

```bash
composer create-project laravel/laravel library-system
cd library-system
```

### 1.2 إعداد قاعدة البيانات

**ملف .env:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_system
DB_USERNAME=root
DB_PASSWORD=
```

### 1.3 إنشاء قاعدة البيانات

```bash
# في MySQL
CREATE DATABASE library_system;
```

---

## الخطوة 2: إنشاء Models و Migrations

### 2.1 إنشاء جميع Models

```bash
php artisan make:model Author -m
php artisan make:model Publisher -m
php artisan make:model Category -m
php artisan make:model Book -m
php artisan make:model Member -m
php artisan make:model Borrowing -m
php artisan make:model Review -m
php artisan make:model Image -m
```

### 2.2 تعديل Migrations

#### Authors Migration

**database/migrations/xxxx_create_authors_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->text('bio')->nullable();
            $table->string('country')->nullable();
            $table->date('birth_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
```

#### Publishers Migration

**database/migrations/xxxx_create_publishers_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('website')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
```

#### Categories Migration

**database/migrations/xxxx_create_categories_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
```

#### Books Migration

**database/migrations/xxxx_create_books_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->unique();
            $table->foreignId('publisher_id')->nullable()->constrained()->onDelete('set null');
            $table->text('description')->nullable();
            $table->date('published_date')->nullable();
            $table->integer('pages')->nullable();
            $table->string('language')->default('ar');
            $table->integer('quantity')->default(1);
            $table->integer('available_quantity')->default(1);
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['available', 'unavailable', 'maintenance'])->default('available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
```

#### Author-Book Pivot Table

```bash
php artisan make:migration create_author_book_table
```

**database/migrations/xxxx_create_author_book_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('author_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['main', 'co-author', 'translator'])->default('main');
            $table->timestamps();

            $table->unique(['author_id', 'book_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('author_book');
    }
};
```

#### Book-Category Pivot Table

```bash
php artisan make:migration create_book_category_table
```

**database/migrations/xxxx_create_book_category_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['book_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_category');
    }
};
```

#### Members Migration

**database/migrations/xxxx_create_members_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('membership_number')->unique();
            $table->date('membership_start')->nullable();
            $table->date('membership_end')->nullable();
            $table->enum('membership_type', ['basic', 'premium', 'vip'])->default('basic');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
```

#### Borrowings Migration

**database/migrations/xxxx_create_borrowings_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->date('borrowed_at');
            $table->date('due_date');
            $table->date('returned_at')->nullable();
            $table->enum('status', ['borrowed', 'returned', 'overdue'])->default('borrowed');
            $table->decimal('fine_amount', 8, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
```

#### Reviews Migration (Polymorphic)

**database/migrations/xxxx_create_reviews_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->morphs('reviewable'); // reviewable_id, reviewable_type
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->unsigned();
            $table->text('comment')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
```

#### Images Migration (Polymorphic)

**database/migrations/xxxx_create_images_table.php:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->morphs('imageable'); // imageable_id, imageable_type
            $table->string('path');
            $table->string('type')->default('cover'); // cover, profile, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
```

### 2.3 تشغيل Migrations

```bash
php artisan migrate
```

---

## الخطوة 3: إعداد Models

### 3.1 Author Model

**app/Models/Author.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'bio',
        'country',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Relationships
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'profile');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * Accessors
     */
    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    /**
     * Scopes
     */
    public function scopeFromCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    public function scopePopular($query)
    {
        return $query->withCount('books')
                     ->having('books_count', '>', 5)
                     ->orderBy('books_count', 'desc');
    }
}
```

### 3.2 Publisher Model

**app/Models/Publisher.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website',
        'country',
    ];

    /**
     * Relationships
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Scopes
     */
    public function scopeFromCountry($query, $country)
    {
        return $query->where('country', $country);
    }
}
```

### 3.3 Category Model

**app/Models/Category.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    /**
     * Relationships
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Mutators
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Scopes
     */
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
```

### 3.4 Book Model

**app/Models/Book.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'isbn',
        'publisher_id',
        'description',
        'published_date',
        'pages',
        'language',
        'quantity',
        'available_quantity',
        'price',
        'status',
    ];

    protected $casts = [
        'published_date' => 'date',
        'price' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class)
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function activeBorrowings()
    {
        return $this->hasMany(Borrowing::class)
                    ->where('status', 'borrowed');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'cover');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * Accessors
     */
    public function getIsAvailableAttribute()
    {
        return $this->available_quantity > 0 && $this->status === 'available';
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    /**
     * Scopes
     */
    public function scopeAvailable($query)
    {
        return $query->where('available_quantity', '>', 0)
                     ->where('status', 'available');
    }

    public function scopeByLanguage($query, $language)
    {
        return $query->where('language', $language);
    }

    public function scopePublishedAfter($query, $date)
    {
        return $query->where('published_date', '>=', $date);
    }

    public function scopePopular($query)
    {
        return $query->withCount('borrowings')
                     ->orderBy('borrowings_count', 'desc');
    }

    /**
     * Methods
     */
    public function borrow()
    {
        if ($this->available_quantity > 0) {
            $this->decrement('available_quantity');
            return true;
        }
        return false;
    }

    public function returnBook()
    {
        if ($this->available_quantity < $this->quantity) {
            $this->increment('available_quantity');
            return true;
        }
        return false;
    }
}
```

### 3.5 Member Model

**app/Models/Member.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'membership_number',
        'membership_start',
        'membership_end',
        'membership_type',
        'status',
    ];

    protected $casts = [
        'membership_start' => 'date',
        'membership_end' => 'date',
    ];

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            if (empty($member->membership_number)) {
                $member->membership_number = 'MEM-' . strtoupper(uniqid());
            }
        });
    }

    /**
     * Relationships
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function activeBorrowings()
    {
        return $this->hasMany(Borrowing::class)
                    ->where('status', 'borrowed');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'profile');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Accessors
     */
    public function getIsMembershipActiveAttribute()
    {
        return $this->status === 'active'
               && $this->membership_end
               && $this->membership_end->isFuture();
    }

    public function getDaysUntilExpiryAttribute()
    {
        if (!$this->membership_end) {
            return null;
        }

        return Carbon::now()->diffInDays($this->membership_end, false);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('membership_end', '>', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('membership_end', '<', now());
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('membership_type', $type);
    }
}
```

### 3.6 Borrowing Model

**app/Models/Borrowing.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
        'fine_amount',
        'notes',
    ];

    protected $casts = [
        'borrowed_at' => 'date',
        'due_date' => 'date',
        'returned_at' => 'date',
        'fine_amount' => 'decimal:2',
    ];

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($borrowing) {
            if (empty($borrowing->borrowed_at)) {
                $borrowing->borrowed_at = now();
            }

            if (empty($borrowing->due_date)) {
                // 14 يوم افتراضياً
                $borrowing->due_date = now()->addDays(14);
            }
        });

        static::updated(function ($borrowing) {
            if ($borrowing->returned_at && $borrowing->status === 'borrowed') {
                $borrowing->status = 'returned';
                $borrowing->save();
            }
        });
    }

    /**
     * Relationships
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Accessors
     */
    public function getIsOverdueAttribute()
    {
        return $this->status === 'borrowed'
               && $this->due_date
               && $this->due_date->isPast();
    }

    public function getDaysOverdueAttribute()
    {
        if (!$this->is_overdue) {
            return 0;
        }

        return Carbon::now()->diffInDays($this->due_date);
    }

    public function getCalculatedFineAttribute()
    {
        if ($this->days_overdue > 0) {
            // 1 ريال لكل يوم تأخير
            return $this->days_overdue * 1.00;
        }

        return 0;
    }

    /**
     * Scopes
     */
    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'borrowed')
                     ->where('due_date', '<', now());
    }

    /**
     * Methods
     */
    public function returnBook()
    {
        $this->returned_at = now();
        $this->status = 'returned';

        // حساب الغرامة
        if ($this->is_overdue) {
            $this->fine_amount = $this->calculated_fine;
        }

        $this->save();

        // إعادة الكتاب للمخزون
        $this->book->returnBook();

        return $this;
    }
}
```

### 3.7 Review Model

**app/Models/Review.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'member_id',
        'rating',
        'comment',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Scopes
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeForBook($query, $bookId)
    {
        return $query->where('reviewable_type', Book::class)
                     ->where('reviewable_id', $bookId);
    }
}
```

### 3.8 Image Model

**app/Models/Image.php:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path',
        'type',
    ];

    /**
     * Relationships
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Accessor
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
```

---

## الخطوة 4: إنشاء Seeders

### 4.1 إنشاء Seeders

```bash
php artisan make:seeder AuthorSeeder
php artisan make:seeder PublisherSeeder
php artisan make:seeder CategorySeeder
php artisan make:seeder BookSeeder
php artisan make:seeder MemberSeeder
```

### 4.2 AuthorSeeder

**database/seeders/AuthorSeeder.php:**
```php
<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'نجيب محفوظ',
                'email' => 'mahfouz@example.com',
                'bio' => 'كاتب مصري، حائز على جائزة نوبل للآداب',
                'country' => 'مصر',
                'birth_date' => '1911-12-11',
            ],
            [
                'name' => 'طه حسين',
                'email' => 'taha@example.com',
                'bio' => 'أديب ومفكر مصري',
                'country' => 'مصر',
                'birth_date' => '1889-11-15',
            ],
            [
                'name' => 'غسان كنفاني',
                'email' => 'kanafani@example.com',
                'bio' => 'كاتب وصحفي فلسطيني',
                'country' => 'فلسطين',
                'birth_date' => '1936-04-09',
            ],
            [
                'name' => 'أحلام مستغانمي',
                'email' => 'ahlam@example.com',
                'bio' => 'كاتبة جزائرية',
                'country' => 'الجزائر',
                'birth_date' => '1953-04-13',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
```

### 4.3 PublisherSeeder

**database/seeders/PublisherSeeder.php:**
```php
<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [
            [
                'name' => 'دار الشروق',
                'email' => 'info@darelshorouk.com',
                'website' => 'www.darelshorouk.com',
                'country' => 'مصر',
            ],
            [
                'name' => 'المركز الثقافي العربي',
                'email' => 'info@arabculturalcenter.com',
                'website' => 'www.arabculturalcenter.com',
                'country' => 'المغرب',
            ],
            [
                'name' => 'دار الآداب',
                'email' => 'info@dar-aladab.com',
                'website' => 'www.dar-aladab.com',
                'country' => 'لبنان',
            ],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}
```

### 4.4 CategorySeeder

**database/seeders/CategorySeeder.php:**
```php
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Parent Categories
        $fiction = Category::create([
            'name' => 'روايات',
            'description' => 'الروايات والقصص الأدبية',
        ]);

        $nonFiction = Category::create([
            'name' => 'كتب غير روائية',
            'description' => 'الكتب الواقعية والعلمية',
        ]);

        $history = Category::create([
            'name' => 'تاريخ',
            'description' => 'كتب التاريخ',
        ]);

        // Child Categories
        Category::create([
            'name' => 'روايات عربية',
            'description' => 'روايات من الأدب العربي',
            'parent_id' => $fiction->id,
        ]);

        Category::create([
            'name' => 'روايات عالمية',
            'description' => 'روايات مترجمة',
            'parent_id' => $fiction->id,
        ]);

        Category::create([
            'name' => 'سير ذاتية',
            'description' => 'السير الذاتية والتراجم',
            'parent_id' => $nonFiction->id,
        ]);

        Category::create([
            'name' => 'تطوير الذات',
            'description' => 'كتب تطوير الذات والإنتاجية',
            'parent_id' => $nonFiction->id,
        ]);
    }
}
```

### 4.5 BookSeeder

**database/seeders/BookSeeder.php:**
```php
<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::whereNotNull('parent_id')->get();

        $books = [
            [
                'title' => 'ثلاثية القاهرة',
                'isbn' => '978-1234567890',
                'description' => 'رواية شهيرة لنجيب محفوظ',
                'published_date' => '1956-01-01',
                'pages' => 1200,
                'language' => 'ar',
                'quantity' => 5,
                'available_quantity' => 5,
                'price' => 120.00,
                'author_id' => 1,
            ],
            [
                'title' => 'رجال في الشمس',
                'isbn' => '978-1234567891',
                'description' => 'رواية غسان كنفاني الشهيرة',
                'published_date' => '1963-01-01',
                'pages' => 150,
                'language' => 'ar',
                'quantity' => 3,
                'available_quantity' => 3,
                'price' => 45.00,
                'author_id' => 3,
            ],
            [
                'title' => 'ذاكرة الجسد',
                'isbn' => '978-1234567892',
                'description' => 'رواية أحلام مستغانمي',
                'published_date' => '1993-01-01',
                'pages' => 400,
                'language' => 'ar',
                'quantity' => 4,
                'available_quantity' => 4,
                'price' => 75.00,
                'author_id' => 4,
            ],
        ];

        foreach ($books as $bookData) {
            $authorId = $bookData['author_id'];
            unset($bookData['author_id']);

            $bookData['publisher_id'] = $publishers->random()->id;

            $book = Book::create($bookData);

            // ربط المؤلف
            $book->authors()->attach($authorId, ['role' => 'main']);

            // ربط التصنيفات
            $book->categories()->attach($categories->random(rand(1, 2))->pluck('id'));
        }
    }
}
```

### 4.6 MemberSeeder

**database/seeders/MemberSeeder.php:**
```php
<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmad@example.com',
                'phone' => '0501234567',
                'membership_start' => now(),
                'membership_end' => now()->addYear(),
                'membership_type' => 'basic',
                'status' => 'active',
            ],
            [
                'name' => 'فاطمة علي',
                'email' => 'fatima@example.com',
                'phone' => '0509876543',
                'membership_start' => now(),
                'membership_end' => now()->addYear(),
                'membership_type' => 'premium',
                'status' => 'active',
            ],
            [
                'name' => 'محمد حسن',
                'email' => 'mohamed@example.com',
                'phone' => '0505555555',
                'membership_start' => now()->subMonths(6),
                'membership_end' => now()->addMonths(6),
                'membership_type' => 'vip',
                'status' => 'active',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
```

### 4.7 DatabaseSeeder

**database/seeders/DatabaseSeeder.php:**
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            PublisherSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            MemberSeeder::class,
        ]);
    }
}
```

### 4.8 تشغيل Seeders

```bash
php artisan db:seed
```

---

## الخطوة 5: إنشاء Controllers

### 5.1 إنشاء Controllers

```bash
php artisan make:controller BookController --resource
php artisan make:controller BorrowingController
php artisan make:controller MemberController --resource
php artisan make:controller AuthorController --resource
```

### 5.2 BookController

**app/Http/Controllers/BookController.php:**
```php
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Eager Loading لتجنب N+1 problem
        $books = Book::with(['authors', 'publisher', 'categories'])
            ->available()
            ->paginate(12);

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        // Eager Loading مع relationships متعددة
        $book = Book::with([
            'authors',
            'publisher',
            'categories',
            'reviews' => function ($query) {
                $query->approved()->with('member')->latest();
            },
            'image'
        ])->findOrFail($id);

        // الكتب المشابهة من نفس التصنيف
        $relatedBooks = Book::whereHas('categories', function ($query) use ($book) {
            $query->whereIn('category_id', $book->categories->pluck('id'));
        })
        ->where('id', '!=', $book->id)
        ->available()
        ->take(4)
        ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('books.create', compact('authors', 'publishers', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn',
            'publisher_id' => 'required|exists:publishers,id',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $validated['available_quantity'] = $validated['quantity'];

        $book = Book::create($validated);

        // ربط المؤلفين
        foreach ($request->authors as $authorId) {
            $book->authors()->attach($authorId, ['role' => 'main']);
        }

        // ربط التصنيفات
        $book->categories()->attach($request->categories);

        return redirect()->route('books.show', $book)
            ->with('success', 'تم إضافة الكتاب بنجاح');
    }

    public function edit($id)
    {
        $book = Book::with(['authors', 'categories'])->findOrFail($id);
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('books.edit', compact('book', 'authors', 'publishers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'publisher_id' => 'required|exists:publishers,id',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string',
            'quantity' => 'required|integer|min:' . ($book->quantity - $book->available_quantity),
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,unavailable,maintenance',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // تحديث available_quantity بناءً على التغيير في quantity
        $diff = $validated['quantity'] - $book->quantity;
        $validated['available_quantity'] = $book->available_quantity + $diff;

        $book->update($validated);

        // تحديث المؤلفين
        $book->authors()->sync($request->authors);

        // تحديث التصنيفات
        $book->categories()->sync($request->categories);

        return redirect()->route('books.show', $book)
            ->with('success', 'تم تحديث الكتاب بنجاح');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // التحقق من عدم وجود استعارات نشطة
        if ($book->activeBorrowings()->exists()) {
            return back()->with('error', 'لا يمكن حذف الكتاب، توجد استعارات نشطة');
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'تم حذف الكتاب بنجاح');
    }
}
```

### 5.3 BorrowingController

**app/Http/Controllers/BorrowingController.php:**
```php
<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'member'])
            ->latest()
            ->paginate(20);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::active()->orderBy('name')->get();
        $books = Book::available()->orderBy('title')->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
            'notes' => 'nullable|string',
        ]);

        $member = Member::findOrFail($request->member_id);
        $book = Book::findOrFail($request->book_id);

        // التحقق من صلاحية العضوية
        if (!$member->is_membership_active) {
            return back()->with('error', 'عضوية المستخدم غير نشطة');
        }

        // التحقق من توفر الكتاب
        if (!$book->is_available) {
            return back()->with('error', 'الكتاب غير متوفر حالياً');
        }

        // التحقق من عدد الكتب المستعارة حالياً
        $activeCount = $member->activeBorrowings()->count();
        $maxBooks = [
            'basic' => 3,
            'premium' => 5,
            'vip' => 10,
        ][$member->membership_type];

        if ($activeCount >= $maxBooks) {
            return back()->with('error', 'وصل العضو للحد الأقصى من الاستعارات');
        }

        DB::transaction(function () use ($validated, $book) {
            // إنشاء الاستعارة
            $borrowing = Borrowing::create($validated);

            // تقليل الكمية المتاحة
            $book->borrow();
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'تمت عملية الاستعارة بنجاح');
    }

    public function show($id)
    {
        $borrowing = Borrowing::with(['book.authors', 'member'])->findOrFail($id);

        return view('borrowings.show', compact('borrowing'));
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::with('book')->findOrFail($id);

        if ($borrowing->status === 'returned') {
            return back()->with('error', 'الكتاب تم إرجاعه مسبقاً');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->returnBook();
        });

        $message = 'تم إرجاع الكتاب بنجاح';

        if ($borrowing->fine_amount > 0) {
            $message .= '. الغرامة: ' . $borrowing->fine_amount . ' ريال';
        }

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', $message);
    }

    public function overdue()
    {
        $borrowings = Borrowing::overdue()
            ->with(['book', 'member'])
            ->get();

        return view('borrowings.overdue', compact('borrowings'));
    }
}
```

---

## الخطوة 6: إنشاء Routes

**routes/web.php:**
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Books
Route::resource('books', BookController::class);

// Authors
Route::resource('authors', AuthorController::class);

// Members
Route::resource('members', MemberController::class);

// Borrowings
Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
Route::get('/borrowings/{id}', [BorrowingController::class, 'show'])->name('borrowings.show');
Route::post('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
Route::get('/borrowings/overdue/list', [BorrowingController::class, 'overdue'])->name('borrowings.overdue');
```

---

## الخطوة 7: أمثلة على الاستعلامات

### 7.1 في Tinker

```bash
php artisan tinker
```

```php
// جلب جميع الكتب مع المؤلفين
$books = Book::with('authors')->get();

// جلب كتاب واحد مع جميع العلاقات
$book = Book::with(['authors', 'publisher', 'categories', 'reviews'])->first();

// جلب الكتب المتاحة فقط
$availableBooks = Book::available()->get();

// جلب كتب بلغة معينة
$arabicBooks = Book::byLanguage('ar')->get();

// جلب الكتب الأكثر استعارة
$popularBooks = Book::popular()->take(10)->get();

// جلب مؤلف مع كتبه
$author = Author::with('books')->find(1);

// جلب عضو مع استعاراته النشطة
$member = Member::with('activeBorrowings.book')->find(1);

// جلب الاستعارات المتأخرة
$overdueBorrowings = Borrowing::overdue()->with(['book', 'member'])->get();

// إنشاء استعارة جديدة
$borrowing = Borrowing::create([
    'member_id' => 1,
    'book_id' => 1,
    'borrowed_at' => now(),
    'due_date' => now()->addDays(14),
]);

// إرجاع كتاب
$borrowing = Borrowing::find(1);
$borrowing->returnBook();

// إضافة مراجعة لكتاب
$book = Book::find(1);
$book->reviews()->create([
    'member_id' => 1,
    'rating' => 5,
    'comment' => 'كتاب رائع',
    'approved' => true,
]);

// جلب متوسط التقييم لكتاب
$book = Book::find(1);
echo $book->average_rating;

// البحث عن كتب بـ Query Builder معقد
$books = Book::whereHas('authors', function ($query) {
    $query->where('country', 'مصر');
})
->whereHas('categories', function ($query) {
    $query->where('name', 'روايات عربية');
})
->where('published_date', '>=', '2000-01-01')
->with(['authors', 'categories'])
->get();
```

---

## ملخص المشروع

### ما تعلمناه وطبقناه:

✅ **Migrations**: إنشاء جداول معقدة مع علاقات
✅ **Models**: جميع أنواع العلاقات
✅ **One to One**: Profile للـ User
✅ **One to Many**: Publisher → Books
✅ **Many to Many**: Books ↔ Authors, Books ↔ Categories
✅ **Polymorphic**: Reviews, Images
✅ **Self-Referencing**: Categories (parent/children)
✅ **Accessors & Mutators**: حساب القيم ديناميكياً
✅ **Scopes**: استعلامات قابلة لإعادة الاستخدام
✅ **Eager Loading**: تحسين الأداء
✅ **Soft Deletes**: حذف آمن
✅ **Events**: تنفيذ كود تلقائياً
✅ **CRUD Operations**: عمليات كاملة
✅ **Transactions**: ضمان تكامل البيانات
✅ **Best Practices**: أفضل الممارسات

---

## تحديات إضافية 🚀

1. إضافة نظام Reservations (حجوزات)
2. إضافة نظام Notifications (إشعارات)
3. إضافة نظام Reports (تقارير)
4. إضافة نظام Search متقدم
5. إضافة نظام Recommendations (توصيات)
6. إضافة API للمشروع
7. إضافة نظام الصلاحيات
8. إضافة Dashboard للإحصائيات

---

**تهانينا! 🎉 لقد أكملت مشروع متكامل باستخدام Eloquent ORM!**
