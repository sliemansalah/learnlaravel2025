# Lesson 5 - Quick Reference Card

## 🗄️ Database Setup

```env
# .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📝 Migration Commands

```bash
# Create migration
php artisan make:migration create_products_table

# Create Model with Migration
php artisan make:model Product -m

# Run migrations
php artisan migrate

# Rollback
php artisan migrate:rollback

# Refresh all
php artisan migrate:fresh

# With Seeding
php artisan migrate:fresh --seed

# Show status
php artisan migrate:status
```

---

## 🏗️ Creating Table

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

## 📊 Common Column Types

```php
// Numbers
$table->id();                           // PRIMARY KEY
$table->integer('votes');
$table->decimal('price', 8, 2);
$table->unsignedBigInteger('user_id');

// Strings
$table->string('name');                 // VARCHAR(255)
$table->string('email', 100);           // VARCHAR(100)
$table->text('description');
$table->json('options');

// Date & Time
$table->date('birth_date');
$table->datetime('created_at');
$table->timestamp('verified_at');
$table->timestamps();                   // created_at + updated_at

// Special
$table->boolean('is_active');
$table->enum('status', ['active', 'inactive']);
```

---

## 🔧 Modifiers

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
// Modern way
$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade');

// Traditional way
$table->unsignedBigInteger('user_id');
$table->foreign('user_id')
      ->references('id')
      ->on('users')
      ->onDelete('cascade');

// onDelete options
->onDelete('cascade')    // Delete
->onDelete('set null')   // NULL
->onDelete('restrict')   // Prevent
```

---

## ✏️ Modifying Tables

```bash
# Create modification migration
php artisan make:migration add_phone_to_users_table
```

```php
// Add column
Schema::table('users', function (Blueprint $table) {
    $table->string('phone')->nullable();
});

// Modify column (requires doctrine/dbal)
composer require doctrine/dbal

Schema::table('users', function (Blueprint $table) {
    $table->string('name', 100)->change();
});

// Drop column
Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('phone');
});

// Rename
Schema::table('users', function (Blueprint $table) {
    $table->renameColumn('old_name', 'new_name');
});
```

---

## 🌱 Database Seeding

```bash
# Create seeder
php artisan make:seeder UserSeeder

# Run seeders
php artisan db:seed
php artisan db:seed --class=UserSeeder
```

```php
// In Seeder
public function run(): void
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
    ]);

    // Or using Factory
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

// Usage
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

// Drop
$table->dropIndex('users_email_index');
$table->dropUnique('users_email_unique');
```

---

## 🔍 Checking

```php
if (Schema::hasTable('users')) {
    // exists
}

if (Schema::hasColumn('users', 'email')) {
    // exists
}
```

---

## 💡 Best Practices

✅ Use clear table names
✅ nullable only when needed
✅ Use Foreign Keys
✅ Add Indexes for search
✅ Always write down()

❌ Don't modify old migrations
❌ Don't use migrate:fresh in production

---

## 🔗 Quick Links

- [Main Lesson](./README-EN.md)
- [Next Lesson](../lesson-06/README-EN.md)
