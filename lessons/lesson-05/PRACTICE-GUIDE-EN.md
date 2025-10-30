# Lesson 5 - Practical Application Guide

## 🚀 How to Run the Project

```bash
cd D:\learnlaravel2025\lessons\lesson-05\practice-app

# Setup database
copy .env.example .env
php artisan key:generate

# Configure database in .env
# DB_CONNECTION=mysql
# DB_DATABASE=lesson05_db

# Run Migrations
php artisan migrate

# Run Seeders
php artisan db:seed

# Start server
php artisan serve
```

---

## 📋 Implemented Migrations

### 1. Categories Table
### 2. Products Table (with Foreign Key)
### 3. Orders Table
### 4. Order Items Table
### 5. Pivot Table: Product_Tag

---

## 🌱 Implemented Seeders

### 1. CategorySeeder
### 2. ProductSeeder (with Factory)
### 3. UserSeeder

---

## 🎯 What We Learned

### 1. Creating Migrations
- ✅ Simple tables
- ✅ Foreign Keys
- ✅ Indexes
- ✅ Soft Deletes

### 2. Column Types
- ✅ Numbers: integer, decimal
- ✅ Strings: string, text
- ✅ Dates: timestamp, datetime
- ✅ Special: enum, boolean

### 3. Database Seeding
- ✅ Seeders for static data
- ✅ Factories for random data
- ✅ Organizing Seeders

### 4. Relationships
- ✅ One to Many (Category → Products)
- ✅ Many to Many (Products ↔ Tags)
- ✅ Foreign Keys with onDelete

---

## 📝 Useful Commands

```bash
# Create migration
php artisan make:migration create_products_table

# Create Model with Migration
php artisan make:model Product -m

# Create everything
php artisan make:model Product -mfs
# -m: migration
# -f: factory
# -s: seeder

# Run migrations
php artisan migrate
php artisan migrate:fresh --seed

# Create seeder
php artisan make:seeder ProductSeeder

# Run specific seeder
php artisan db:seed --class=ProductSeeder
```

---

## 🔍 Testing Database

### Using Tinker

```bash
php artisan tinker
```

```php
// Show all products
App\Models\Product::all();

// Show first 5 products
App\Models\Product::take(5)->get();

// Statistics
App\Models\Product::count();
App\Models\Category::count();
App\Models\User::count();

// Create record
App\Models\Category::create([
    'name' => 'New',
    'slug' => 'new',
]);
```

---

## 💡 Tips

1. **Use SQLite for development** - Faster and easier
2. **Write Seeders** for test data
3. **Use Factories** for random data
4. **Don't modify old migrations** - Create new one
5. **Test migrations** before deployment

---

## 📚 Next Step

After completing this lesson, you're ready for:

**Lesson 6**: Eloquent ORM - Basics
- Creating Models
- Querying data
- Table relationships

---

**Happy Learning! 🚀**
