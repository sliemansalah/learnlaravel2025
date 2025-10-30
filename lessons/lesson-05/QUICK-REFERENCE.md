# الدرس 5 - بطاقة مرجعية سريعة

## 🗄️ إعداد قاعدة البيانات

```env
# ملف .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📝 أوامر Migrations

```bash
# إنشاء migration
php artisan make:migration create_products_table

# إنشاء Model مع Migration
php artisan make:model Product -m

# تشغيل migrations
php artisan migrate

# التراجع
php artisan migrate:rollback

# إعادة تشغيل الكل
php artisan migrate:fresh

# مع Seeding
php artisan migrate:fresh --seed

# عرض الحالة
php artisan migrate:status
```

---

## 🏗️ إنشاء جدول

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->decimal('price', 10, 2);
    $table->integer('stock')->default(0);
    $table->timestamps();
});
```

---

## 📊 أنواع الأعمدة الشائعة

```php
// أرقام
$table->id();                           // PRIMARY KEY
$table->integer('votes');
$table->decimal('price', 8, 2);
$table->unsignedBigInteger('user_id');

// نصوص
$table->string('name');                 // VARCHAR(255)
$table->string('email', 100);           // VARCHAR(100)
$table->text('description');
$table->json('options');

// تاريخ ووقت
$table->date('birth_date');
$table->datetime('created_at');
$table->timestamp('verified_at');
$table->timestamps();                   // created_at + updated_at

// خاصة
$table->boolean('is_active');
$table->enum('status', ['active', 'inactive']);
```

---

## 🔧 المعدلات

```php
$table->string('email')->nullable();
$table->string('name')->default('Guest');
$table->integer('votes')->unsigned();
$table->string('email')->unique();
$table->string('phone')->after('email');
```

---

## 🔗 Foreign Keys

```php
// الطريقة الحديثة
$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade');

// الطريقة التقليدية
$table->unsignedBigInteger('user_id');
$table->foreign('user_id')
      ->references('id')
      ->on('users')
      ->onDelete('cascade');

// خيارات onDelete
->onDelete('cascade')    // حذف
->onDelete('set null')   // NULL
->onDelete('restrict')   // منع
```

---

## ✏️ تعديل الجداول

```bash
# إنشاء migration للتعديل
php artisan make:migration add_phone_to_users_table
```

```php
// إضافة عمود
Schema::table('users', function (Blueprint $table) {
    $table->string('phone')->nullable();
});

// تعديل عمود (يحتاج doctrine/dbal)
composer require doctrine/dbal

Schema::table('users', function (Blueprint $table) {
    $table->string('name', 100)->change();
});

// حذف عمود
Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('phone');
});

// إعادة تسمية
Schema::table('users', function (Blueprint $table) {
    $table->renameColumn('old_name', 'new_name');
});
```

---

## 🌱 Database Seeding

```bash
# إنشاء seeder
php artisan make:seeder UserSeeder

# تشغيل seeders
php artisan db:seed
php artisan db:seed --class=UserSeeder
```

```php
// في Seeder
public function run(): void
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
    ]);

    // أو باستخدام Factory
    User::factory()->count(50)->create();
}
```

---

## 🏭 Model Factories

```bash
php artisan make:factory ProductFactory
```

```php
public function definition(): array
{
    return [
        'name' => fake()->words(3, true),
        'price' => fake()->randomFloat(2, 10, 1000),
        'stock' => fake()->numberBetween(0, 100),
    ];
}

// الاستخدام
Product::factory()->create();
Product::factory()->count(50)->create();
```

---

## 📑 Indexes

```php
$table->string('email')->unique();
$table->index('email');
$table->index(['first_name', 'last_name']);
$table->fullText('description');

// حذف
$table->dropIndex('users_email_index');
$table->dropUnique('users_email_unique');
```

---

## 🔍 التحقق

```php
if (Schema::hasTable('users')) {
    // موجود
}

if (Schema::hasColumn('users', 'email')) {
    // موجود
}
```

---

## 💡 أفضل الممارسات

✅ استخدم أسماء واضحة للجداول
✅ nullable فقط عند الحاجة
✅ استخدم Foreign Keys
✅ أضف Indexes للبحث
✅ اكتب down() دائماً

❌ لا تعدّل migrations قديمة
❌ لا تستخدم migrate:fresh في الإنتاج

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [الدرس التالي](../lesson-06/README.md)
