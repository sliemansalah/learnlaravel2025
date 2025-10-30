# الدرس 5: قواعد البيانات والـ Migrations

## 📖 جدول المحتويات
1. [مقدمة في قواعد البيانات](#مقدمة-في-قواعد-البيانات)
2. [إعداد قاعدة البيانات](#إعداد-قاعدة-البيانات)
3. [Migrations](#migrations)
4. [Schema Builder](#schema-builder)
5. [أنواع الأعمدة](#أنواع-الأعمدة)
6. [المفاتيح والفهارس](#المفاتيح-والفهارس)
7. [تعديل الجداول](#تعديل-الجداول)
8. [Database Seeding](#database-seeding)
9. [التمارين العملية](#التمارين-العملية)

---

## مقدمة في قواعد البيانات

### ما هي قواعد البيانات؟

قاعدة البيانات هي **مكان منظم لتخزين واسترجاع البيانات**. في Laravel، نتعامل مع قواعد البيانات بطريقة سهلة وآمنة.

### قواعد البيانات المدعومة

Laravel يدعم 4 أنظمة قواعد بيانات:

| النظام | Driver | الاستخدام |
|--------|--------|-----------|
| **MySQL** | `mysql` | الأكثر شيوعاً |
| **PostgreSQL** | `pgsql` | قوي ومتقدم |
| **SQLite** | `sqlite` | خفيف للتطوير |
| **SQL Server** | `sqlsrv` | Microsoft |

---

## إعداد قاعدة البيانات

### 1. إعدادات الاتصال

**ملف `.env`:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 2. إنشاء قاعدة البيانات

```sql
-- في MySQL
CREATE DATABASE laravel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. استخدام SQLite (للتطوير)

```bash
# إنشاء ملف database
touch database/database.sqlite
```

**في `.env`:**

```env
DB_CONNECTION=sqlite
# احذف باقي DB_* settings
```

### 4. اختبار الاتصال

```bash
php artisan migrate:status
```

إذا ظهرت الرسالة بدون أخطاء، الاتصال ناجح! ✅

---

## Migrations

### ما هي Migrations؟

**Migrations** هي **نظام التحكم في إصدارات قاعدة البيانات** (Version Control للـ Database).

### لماذا Migrations؟

✅ **تتبع التغييرات** - معرفة من غيّر ماذا ومتى
✅ **مشاركة سهلة** - نفس البنية لجميع المطورين
✅ **التراجع** - إمكانية التراجع عن التغييرات
✅ **نشر سهل** - تطبيق التغييرات تلقائياً على الإنتاج

### بدون Migrations vs مع Migrations

```
❌ بدون Migrations:
- إنشاء جداول يدوياً في phpMyAdmin
- مشاركة ملف SQL مع الفريق
- تتبع التغييرات صعب
- أخطاء كثيرة عند النشر

✅ مع Migrations:
- إنشاء جداول بالكود
- git push/pull للمشاركة
- تتبع تلقائي للتغييرات
- نشر سهل وآمن
```

---

## إنشاء Migration

### 1. Migration بسيط

```bash
php artisan make:migration create_products_table
```

**النتيجة:**
```
database/migrations/2024_01_15_120000_create_products_table.php
```

### 2. Migration مع Model

```bash
php artisan make:model Product -m
```

ينشئ Model + Migration معاً.

### 3. هيكل Migration

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

### تشغيل Migrations

```bash
# تشغيل جميع Migrations
php artisan migrate

# التراجع عن آخر مجموعة
php artisan migrate:rollback

# التراجع عن جميع Migrations
php artisan migrate:reset

# إعادة تشغيل جميع Migrations
php artisan migrate:refresh

# إعادة تشغيل مع Seeding
php artisan migrate:refresh --seed

# عرض حالة Migrations
php artisan migrate:status
```

---

## Schema Builder

### إنشاء جدول

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();                          // PRIMARY KEY AUTO_INCREMENT
    $table->string('name');                // VARCHAR(255)
    $table->string('email')->unique();     // UNIQUE
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();                   // created_at, updated_at
});
```

### التحقق من وجود جدول

```php
if (Schema::hasTable('users')) {
    // الجدول موجود
}

if (Schema::hasColumn('users', 'email')) {
    // العمود موجود
}
```

### إعادة تسمية جدول

```php
Schema::rename('old_table', 'new_table');
```

### حذف جدول

```php
Schema::drop('users');
Schema::dropIfExists('users');
```

---

## أنواع الأعمدة

### 1. أعمدة الأرقام

```php
$table->id();                           // BIGINT UNSIGNED AUTO_INCREMENT
$table->bigIncrements('id');            // مثل id()
$table->integer('votes');               // INTEGER
$table->tinyInteger('status');          // TINYINT (-128 to 127)
$table->smallInteger('age');            // SMALLINT
$table->mediumInteger('quantity');      // MEDIUMINT
$table->bigInteger('views');            // BIGINT
$table->unsignedInteger('votes');       // INTEGER UNSIGNED (0+)
$table->unsignedBigInteger('user_id');  // BIGINT UNSIGNED
$table->decimal('price', 8, 2);         // DECIMAL(8,2) - 999999.99
$table->float('amount', 8, 2);          // FLOAT
$table->double('total', 8, 2);          // DOUBLE
```

### 2. أعمدة النصوص

```php
$table->char('code', 10);               // CHAR(10) - طول ثابت
$table->string('name');                 // VARCHAR(255)
$table->string('email', 100);           // VARCHAR(100)
$table->text('description');            // TEXT
$table->mediumText('content');          // MEDIUMTEXT
$table->longText('article');            // LONGTEXT
$table->json('options');                // JSON
$table->jsonb('metadata');              // JSONB (PostgreSQL)
```

### 3. أعمدة التاريخ والوقت

```php
$table->date('birth_date');             // DATE
$table->dateTime('created_at');         // DATETIME
$table->time('alarm_time');             // TIME
$table->timestamp('verified_at');       // TIMESTAMP
$table->timestamps();                   // created_at + updated_at
$table->timestampsTz();                 // مع timezone
$table->softDeletes();                  // deleted_at (للحذف الناعم)
$table->year('graduation_year');        // YEAR
```

### 4. أعمدة خاصة

```php
$table->boolean('is_active');           // BOOLEAN (0 or 1)
$table->enum('status', ['pending', 'active', 'blocked']);
$table->set('roles', ['admin', 'user', 'editor']);
$table->binary('photo');                // BLOB
$table->uuid('id');                     // UUID
$table->ipAddress('visitor');           // IP address
$table->macAddress('device');           // MAC address
$table->geometry('positions');          // GEOMETRY
$table->point('location');              // POINT
$table->rememberToken();                // remember_token VARCHAR(100)
```

---

## المعدلات (Modifiers)

### معدلات شائعة

```php
$table->string('email')->nullable();             // يسمح بـ NULL
$table->string('name')->default('Guest');        // قيمة افتراضية
$table->integer('votes')->unsigned();            // UNSIGNED (0+)
$table->string('username')->unique();            // UNIQUE
$table->decimal('price', 8, 2)->default(0);      // قيمة افتراضية
$table->text('bio')->nullable();                 // NULL مسموح
$table->timestamp('created_at')->useCurrent();   // وقت الإنشاء الحالي
$table->timestamp('updated_at')->useCurrentOnUpdate(); // تحديث تلقائي

// دمج معدلات
$table->string('email')->unique()->nullable();
$table->decimal('price', 8, 2)->unsigned()->default(0);
```

### ترتيب الأعمدة

```php
$table->string('email')->after('name');          // بعد عمود name
$table->string('name')->first();                 // في البداية
```

### تعليقات

```php
$table->string('name')->comment('اسم المستخدم');
```

---

## المفاتيح والفهارس

### 1. Primary Key

```php
$table->id();                                    // PRIMARY KEY تلقائي

// أو يدوياً
$table->bigInteger('id');
$table->primary('id');
```

### 2. Foreign Keys (المفاتيح الأجنبية)

```php
// الطريقة الحديثة (Laravel 7+)
$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade');

// الطريقة التقليدية
$table->unsignedBigInteger('user_id');
$table->foreign('user_id')
      ->references('id')
      ->on('users')
      ->onDelete('cascade')
      ->onUpdate('cascade');

// تسمية مخصصة
$table->foreignId('author_id')
      ->constrained('users')  // يشير لجدول users
      ->onDelete('set null');
```

### خيارات onDelete و onUpdate

```php
->onDelete('cascade')       // حذف التابع عند حذف الأصل
->onDelete('set null')      // تعيين NULL
->onDelete('restrict')      // منع الحذف
->onDelete('no action')     // لا شيء

->onUpdate('cascade')       // تحديث التابع عند تحديث الأصل
```

### 3. Indexes (الفهارس)

```php
$table->string('email')->unique();               // UNIQUE index
$table->index('email');                          // فهرس عادي
$table->index(['first_name', 'last_name']);      // فهرس مركب
$table->fullText('description');                 // فهرس نص كامل

// إزالة فهرس
$table->dropIndex('users_email_index');
$table->dropUnique('users_email_unique');
```

---

## تعديل الجداول

### 1. إضافة أعمدة

```bash
php artisan make:migration add_phone_to_users_table
```

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone')->nullable()->after('email');
        $table->string('address')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone', 'address']);
    });
}
```

### 2. تعديل أعمدة

**تثبيت doctrine/dbal أولاً:**

```bash
composer require doctrine/dbal
```

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // تغيير نوع العمود
        $table->string('name', 100)->change();

        // جعل العمود nullable
        $table->string('email')->nullable()->change();

        // تعديل عدة خصائص
        $table->decimal('price', 10, 2)->unsigned()->default(0)->change();
    });
}
```

### 3. إعادة تسمية أعمدة

```php
Schema::table('users', function (Blueprint $table) {
    $table->renameColumn('old_name', 'new_name');
});
```

### 4. حذف أعمدة

```php
Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('phone');

    // حذف عدة أعمدة
    $table->dropColumn(['phone', 'address']);

    // حذف Foreign Key أولاً ثم العمود
    $table->dropForeign('posts_user_id_foreign');
    $table->dropColumn('user_id');
});
```

---

## Database Seeding

### ما هو Seeding؟

**Seeding** = ملء قاعدة البيانات ببيانات تجريبية للتطوير والاختبار.

### 1. إنشاء Seeder

```bash
php artisan make:seeder UserSeeder
```

**ملف `database/seeders/UserSeeder.php`:**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // طريقة 1: إنشاء سجل واحد
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // طريقة 2: إنشاء عدة سجلات
        $users = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'سارة علي',
                'email' => 'sara@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // طريقة 3: استخدام Factory
        User::factory()->count(50)->create();
    }
}
```

### 2. تشغيل Seeder

**في `database/seeders/DatabaseSeeder.php`:**

```php
public function run(): void
{
    $this->call([
        UserSeeder::class,
        ProductSeeder::class,
        CategorySeeder::class,
    ]);
}
```

**تشغيل:**

```bash
# تشغيل جميع Seeders
php artisan db:seed

# تشغيل seeder محدد
php artisan db:seed --class=UserSeeder

# إعادة تشغيل migrations مع seeding
php artisan migrate:fresh --seed
```

### 3. Model Factories

```bash
php artisan make:factory ProductFactory
```

**ملف `database/factories/ProductFactory.php`:**

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(80), // 80% true
        ];
    }
}
```

**الاستخدام:**

```php
// إنشاء منتج واحد
$product = Product::factory()->create();

// إنشاء 50 منتج
Product::factory()->count(50)->create();

// مع خصائص محددة
Product::factory()->create([
    'name' => 'لابتوب',
    'price' => 5000,
]);
```

---

## أمثلة عملية

### مثال 1: جدول المنتجات

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->integer('stock')->default(0);
    $table->boolean('is_active')->default(true);
    $table->foreignId('category_id')
          ->constrained()
          ->onDelete('cascade');
    $table->timestamps();
    $table->softDeletes();

    // فهارس
    $table->index('is_active');
    $table->index('created_at');
});
```

### مثال 2: جدول الطلبات

```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('order_number')->unique();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->decimal('total_amount', 10, 2);
    $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])
          ->default('pending');
    $table->timestamp('paid_at')->nullable();
    $table->timestamps();
});
```

### مثال 3: جدول محوري (Many-to-Many)

```php
Schema::create('post_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->foreignId('tag_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    // فهرس مركب فريد
    $table->unique(['post_id', 'tag_id']);
});
```

---

## أفضل الممارسات

### ✅ افعل

1. **استخدم أسماء واضحة**
```php
// ✅ جيد
Schema::create('user_profiles', ...);
Schema::create('product_categories', ...);

// ❌ سيء
Schema::create('up', ...);
Schema::create('pc', ...);
```

2. **اجعل الأعمدة nullable فقط عند الحاجة**
```php
// ✅ جيد
$table->string('email');                    // مطلوب
$table->string('phone')->nullable();        // اختياري

// ❌ سيء - كل شيء nullable
$table->string('name')->nullable();
$table->string('email')->nullable();
```

3. **استخدم Foreign Keys**
```php
// ✅ جيد
$table->foreignId('user_id')->constrained()->onDelete('cascade');

// ❌ سيء
$table->unsignedBigInteger('user_id');
```

4. **أضف Indexes للبحث المتكرر**
```php
$table->index('email');
$table->index('status');
$table->index(['user_id', 'created_at']);
```

5. **استخدم Enum للقيم المحدودة**
```php
$table->enum('status', ['active', 'inactive', 'pending']);
$table->enum('role', ['admin', 'user', 'moderator']);
```

### ❌ لا تفعل

1. **لا تعدّل migrations القديمة**
```php
// ❌ سيء - تعديل migration قديم
// أنشئ migration جديد بدلاً من ذلك

// ✅ جيد
php artisan make:migration add_phone_to_users_table
```

2. **لا تحذف migrations في الإنتاج**
```php
// ❌ خطر جداً
php artisan migrate:fresh  // في الإنتاج!

// ✅ آمن
php artisan migrate
```

3. **لا تنسَ down() method**
```php
// ❌ سيء
public function down(): void
{
    // فارغ
}

// ✅ جيد
public function down(): void
{
    Schema::dropIfExists('products');
}
```

---

## التمارين العملية

### تمرين 1: إنشاء جدول Categories ✅

```bash
php artisan make:migration create_categories_table
```

```php
public function up(): void
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
```

### تمرين 2: جدول Posts مع Foreign Key

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('category_id')->constrained()->onDelete('set null');
    $table->integer('views')->default(0);
    $table->boolean('is_published')->default(false);
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

### تمرين 3: Seeder للبيانات

```php
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'تقنية', 'slug' => 'tech'],
            ['name' => 'رياضة', 'slug' => 'sports'],
            ['name' => 'أخبار', 'slug' => 'news'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
```

---

## 🎯 ملخص

في هذا الدرس، تعلمت:

✅ إعداد قاعدة البيانات والاتصال
✅ إنشاء وتشغيل Migrations
✅ جميع أنواع الأعمدة المتاحة
✅ المفاتيح الأجنبية والفهارس
✅ تعديل وحذف الجداول
✅ Database Seeding والـ Factories
✅ أفضل الممارسات

---

## 📚 موارد إضافية

- [Laravel Migrations Documentation](https://laravel.com/docs/migrations)
- [Database Seeding](https://laravel.com/docs/seeding)
- [Schema Builder](https://laravel.com/docs/migrations#creating-tables)

---

## ✅ اختبر نفسك

1. ما الفرق بين `migrate` و `migrate:fresh`؟
2. متى نستخدم `nullable()` على العمود؟
3. كيف تنشئ Foreign Key؟
4. ما فائدة `onDelete('cascade')`؟
5. ما الفرق بين Seeder و Factory؟

---

## الدرس التالي

جاهز للمزيد؟ انتقل إلى **[الدرس 6: Eloquent ORM - الأساسيات](../lesson-06/README.md)**

في الدرس 6، ستتعلم:
- ما هو Eloquent ORM
- إنشاء والاستعلام عن Models
- العلاقات بين الجداول
- والمزيد!

---

**تعلم سعيد! 🚀**
