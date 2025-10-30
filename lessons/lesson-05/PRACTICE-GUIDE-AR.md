# دليل التطبيق العملي للدرس الخامس

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-05\practice-app

# إعداد قاعدة البيانات
copy .env.example .env
php artisan key:generate

# ضبط إعدادات قاعدة البيانات في .env
# DB_CONNECTION=mysql
# DB_DATABASE=lesson05_db

# تشغيل Migrations
php artisan migrate

# تشغيل Seeders
php artisan db:seed

# تشغيل الخادم
php artisan serve
```

---

## 📋 Migrations المنفذة

### 1. جدول Categories

**Migration:**
```bash
php artisan make:migration create_categories_table
```

```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

---

### 2. جدول Products

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
});
```

---

### 3. جدول Orders

```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('order_number')->unique();
    $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');
    $table->decimal('total_amount', 10, 2);
    $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])
          ->default('pending');
    $table->timestamp('paid_at')->nullable();
    $table->timestamps();
});
```

---

### 4. جدول Order Items

```php
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')
          ->constrained()
          ->onDelete('cascade');
    $table->foreignId('product_id')
          ->constrained()
          ->onDelete('restrict');
    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->decimal('subtotal', 10, 2);
    $table->timestamps();
});
```

---

### 5. جدول محوري: Product_Tag

```php
Schema::create('product_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')
          ->constrained()
          ->onDelete('cascade');
    $table->foreignId('tag_id')
          ->constrained()
          ->onDelete('cascade');
    $table->timestamps();

    $table->unique(['product_id', 'tag_id']);
});
```

---

## 🌱 Seeders المنفذة

### 1. CategorySeeder

```php
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'إلكترونيات', 'slug' => 'electronics'],
            ['name' => 'ملابس', 'slug' => 'clothing'],
            ['name' => 'كتب', 'slug' => 'books'],
            ['name' => 'رياضة', 'slug' => 'sports'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
```

---

### 2. ProductSeeder (مع Factory)

```php
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء 50 منتج عشوائي
        Product::factory()->count(50)->create();

        // أو منتجات محددة
        $products = [
            [
                'name' => 'لابتوب HP',
                'slug' => 'laptop-hp',
                'description' => 'لابتوب عالي الأداء',
                'price' => 5000,
                'stock' => 10,
                'category_id' => 1,
            ],
            // المزيد...
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
```

---

### 3. UserSeeder

```php
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'المدير',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // مستخدمين عشوائيين
        User::factory()->count(20)->create();
    }
}
```

---

## 🏭 Factories المنفذة

### ProductFactory

```php
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 5000),
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(90),
            'category_id' => Category::factory(),
        ];
    }
}
```

---

## 🎯 ما تعلمناه

### 1. إنشاء Migrations
- ✅ جداول بسيطة
- ✅ Foreign Keys
- ✅ Indexes
- ✅ Soft Deletes

### 2. أنواع الأعمدة
- ✅ Numbers: integer, decimal
- ✅ Strings: string, text
- ✅ Dates: timestamp, datetime
- ✅ Special: enum, boolean

### 3. Database Seeding
- ✅ Seeders لبيانات ثابتة
- ✅ Factories لبيانات عشوائية
- ✅ تنظيم Seeders

### 4. العلاقات
- ✅ One to Many (Category → Products)
- ✅ Many to Many (Products ↔ Tags)
- ✅ Foreign Keys مع onDelete

---

## 📝 أوامر مفيدة

```bash
# إنشاء migration
php artisan make:migration create_products_table

# إنشاء Model مع Migration
php artisan make:model Product -m

# إنشاء كل شيء
php artisan make:model Product -mfs
# -m: migration
# -f: factory
# -s: seeder

# تشغيل migrations
php artisan migrate
php artisan migrate:fresh --seed

# إنشاء seeder
php artisan make:seeder ProductSeeder

# تشغيل seeder معين
php artisan db:seed --class=ProductSeeder
```

---

## 🔍 اختبار قاعدة البيانات

### باستخدام Tinker

```bash
php artisan tinker
```

```php
// عرض جميع المنتجات
App\Models\Product::all();

// عرض أول 5 منتجات
App\Models\Product::take(5)->get();

// إحصائيات
App\Models\Product::count();
App\Models\Category::count();
App\Models\User::count();

// إنشاء سجل
App\Models\Category::create([
    'name' => 'جديد',
    'slug' => 'new',
]);
```

---

## 💡 نصائح

1. **استخدم SQLite للتطوير** - أسرع وأسهل
2. **اكتب Seeders** لبيانات الاختبار
3. **استخدم Factories** للبيانات العشوائية
4. **لا تعدّل migrations قديمة** - أنشئ migration جديد
5. **اختبر migrations** قبل النشر

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 6**: Eloquent ORM - الأساسيات
- إنشاء Models
- الاستعلام عن البيانات
- العلاقات بين الجداول

---

**تعلم سعيد! 🚀**
