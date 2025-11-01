# Lesson 5: Databases and Migrations - Full Exam
# الدرس الخامس: قواعد البيانات والهجرات - الاختبار الكامل

**Total Questions:** 100
**Lesson Topic:** Laravel Databases & Migrations
**Time Limit:** 150 minutes
**Passing Score:** 70/100

---

## Student Information / معلومات الطالب

**Name / الاسم:** ___________________
**Date / التاريخ:** ___________________
**Start Time / وقت البدء:** ___________________
**End Time / وقت الانتهاء:** ___________________

---

## Exam Sections / أقسام الاختبار

| Section | Question Type | Questions | Points |
|---------|--------------|-----------|--------|
| A | Multiple Choice | 40 | 40 |
| B | True/False | 20 | 20 |
| C | Fill in the Blanks | 10 | 10 |
| D | Code Analysis | 10 | 10 |
| E | Find the Bug | 10 | 10 |
| F | Code Writing | 10 | 10 |
| **Total** | | **100** | **100** |

---

# Section A: Multiple Choice (40 Questions)

---

### Q1. Where are database configuration settings stored?

a) `.env`
b) `config/database.php`
c) Both a and b
d) `database/config.php`

**Answer:** _____

---

### Q2. What is the default database for Laravel 12?

a) MySQL
b) PostgreSQL
c) SQLite
d) MongoDB

**Answer:** _____

---

### Q3. Where are migrations stored?

a) `app/migrations/`
b) `database/migrations/`
c) `storage/migrations/`
d) `migrations/`

**Answer:** _____

---

### Q4. How do you create a migration?

a) `php artisan make:migration create_users_table`
b) `php artisan create:migration users`
c) `php artisan migration:make users`
d) `php artisan new:migration users`

**Answer:** _____

---

### Q5. What command runs all pending migrations?

a) `php artisan migrate:run`
b) `php artisan migrate`
c) `php artisan db:migrate`
d) `php artisan run:migrations`

**Answer:** _____

---

### Q6. What does `php artisan migrate:rollback` do?

a) Undoes all migrations
b) Undoes the last batch of migrations
c) Deletes migration files
d) Resets the database

**Answer:** _____

---

### Q7. What does `php artisan migrate:reset` do?

a) Undoes last migration
b) Undoes all migrations
c) Deletes database
d) Clears cache

**Answer:** _____

---

### Q8. What does `php artisan migrate:fresh` do?

a) Runs new migrations only
b) Drops all tables and re-runs migrations
c) Refreshes migrations
d) Creates a backup

**Answer:** _____

---

### Q9. What does `php artisan migrate:refresh` do?

a) Rolls back and re-runs all migrations
b) Drops all tables
c) Clears cache
d) Updates migrations

**Answer:** _____

---

### Q10. How do you create a table in a migration?

a) `Schema::create('table', function($table) {})`
b) `DB::create('table')`
c) `Table::create('table')`
d) `Migration::create('table')`

**Answer:** _____

---

### Q11. How do you add a column in a migration?

a) `$table->addColumn('name', 'string')`
b) `$table->string('name')`
c) `$table->column('name')->type('string')`
d) `$table->add('name', 'string')`

**Answer:** _____

---

### Q12. What does `$table->id()` create?

a) A string column
b) An auto-incrementing BIGINT primary key
c) A UUID column
d) A foreign key

**Answer:** _____

---

### Q13. How do you make a column nullable?

a) `$table->string('name')->null()`
b) `$table->string('name')->nullable()`
c) `$table->string('name', nullable: true)`
d) `$table->nullable('name')`

**Answer:** _____

---

### Q14. How do you set a default value?

a) `$table->string('status')->default('active')`
b) `$table->string('status', default: 'active')`
c) `$table->string('status')->value('active')`
d) `$table->default('status', 'active')`

**Answer:** _____

---

### Q15. What does `$table->timestamps()` create?

a) One timestamp column
b) `created_at` and `updated_at` columns
c) `created_at`, `updated_at`, and `deleted_at` columns
d) A timestamp primary key

**Answer:** _____

---

### Q16. How do you add a foreign key?

a) `$table->foreign('user_id')->references('id')->on('users')`
b) `$table->foreignKey('user_id', 'users', 'id')`
c) `$table->foreignId('user_id')->constrained()`
d) Both a and c

**Answer:** _____

---

### Q17. What does `->onDelete('cascade')` do?

a) Prevents deletion
b) Deletes related records when parent is deleted
c) Cascades updates
d) Nothing

**Answer:** _____

---

### Q18. How do you drop a table?

a) `Schema::drop('table')`
b) `Schema::dropIfExists('table')`
c) Both a and b
d) `DB::drop('table')`

**Answer:** _____

---

### Q19. How do you check if a table exists?

a) `Schema::hasTable('table')`
b) `Schema::exists('table')`
c) `DB::tableExists('table')`
d) `Table::exists('table')`

**Answer:** _____

---

### Q20. How do you rename a table?

a) `Schema::rename('old', 'new')`
b) `Schema::renameTable('old', 'new')`
c) `DB::rename('old', 'new')`
d) `Table::rename('old', 'new')`

**Answer:** _____

---

### Q21. How do you add a column to an existing table?

a) Create a new migration with `Schema::table()`
b) Edit the original migration
c) Use `php artisan migrate:add-column`
d) Manually in database

**Answer:** _____

---

### Q22. How do you drop a column?

a) `$table->dropColumn('name')`
b) `$table->drop('name')`
c) `$table->removeColumn('name')`
d) `$table->delete('name')`

**Answer:** _____

---

### Q23. How do you rename a column?

a) `$table->renameColumn('old', 'new')`
b) `$table->rename('old', 'new')`
c) `$table->changeColumn('old', 'new')`
d) `$table->modify('old', 'new')`

**Answer:** _____

---

### Q24. What does `$table->softDeletes()` create?

a) A deleted column
b) A deleted_at timestamp column
c) A soft_delete boolean column
d) Nothing

**Answer:** _____

---

### Q25. What is a seeder?

a) A class that seeds/populates database with data
b) A migration tool
c) A database driver
d) A validation class

**Answer:** _____

---

### Q26. How do you create a seeder?

a) `php artisan make:seeder UserSeeder`
b) `php artisan create:seeder UserSeeder`
c) `php artisan seeder:make UserSeeder`
d) `php artisan new:seeder UserSeeder`

**Answer:** _____

---

### Q27. How do you run all seeders?

a) `php artisan db:seed`
b) `php artisan seed`
c) `php artisan run:seeders`
d) `php artisan migrate:seed`

**Answer:** _____

---

### Q28. How do you run a specific seeder?

a) `php artisan db:seed --class=UserSeeder`
b) `php artisan seed UserSeeder`
c) `php artisan run:seeder UserSeeder`
d) `php artisan seeder UserSeeder`

**Answer:** _____

---

### Q29. Where are seeders stored?

a) `app/Seeders/`
b) `database/seeders/`
c) `database/seeds/`
d) `seeders/`

**Answer:** _____

---

### Q30. What does `DB::table('users')->insert([...])` do?

a) Creates a table
b) Inserts data into users table
c) Updates data
d) Deletes data

**Answer:** _____

---

### Q31. How do you use a factory in a seeder?

a) `User::factory()->count(10)->create()`
b) `factory(User::class, 10)->create()`
c) `User::create(10)`
d) `Factory::make(User::class, 10)`

**Answer:** _____

---

### Q32. What is a factory?

a) A class for creating model instances with fake data
b) A database driver
c) A migration tool
d) A validation class

**Answer:** _____

---

### Q33. How do you create a factory?

a) `php artisan make:factory UserFactory`
b) `php artisan create:factory UserFactory`
c) `php artisan factory:make UserFactory`
d) `php artisan new:factory UserFactory`

**Answer:** _____

---

### Q34. Where are factories stored?

a) `app/Factories/`
b) `database/factories/`
c) `factories/`
d) `database/factory/`

**Answer:** _____

---

### Q35. What does `->unique()` do on a column?

a) Makes it a primary key
b) Adds a unique constraint
c) Indexes the column
d) Makes it required

**Answer:** _____

---

### Q36. What does `->index()` do?

a) Creates a primary key
b) Creates a database index for faster queries
c) Makes column unique
d) Orders results

**Answer:** _____

---

### Q37. How do you create a string column with max length?

a) `$table->string('name', 100)`
b) `$table->string('name')->length(100)`
c) `$table->varchar('name', 100)`
d) Both a and c

**Answer:** _____

---

### Q38. What column type is `$table->text()`?

a) Small text (255 chars)
b) Long text (65,535 chars)
c) Unlimited text
d) Same as string

**Answer:** _____

---

### Q39. How do you create an enum column?

a) `$table->enum('status', ['active', 'inactive'])`
b) `$table->select('status', ['active', 'inactive'])`
c) `$table->options('status', ['active', 'inactive'])`
d) `$table->choice('status', ['active', 'inactive'])`

**Answer:** _____

---

### Q40. What does `->unsigned()` do?

a) Makes column nullable
b) Makes numeric column unsigned (no negative values)
c) Removes validation
d) Makes column unique

**Answer:** _____

---

# Section B: True or False (20 Questions)

---

### Q41. Migrations allow version control for your database.

**Answer:** _____

---

### Q42. You should edit existing migrations after running them.

**Answer:** _____

---

### Q43. `php artisan migrate` runs all pending migrations.

**Answer:** _____

---

### Q44. `migrate:fresh` is safe for production databases.

**Answer:** _____

---

### Q45. `$table->id()` creates an auto-incrementing primary key.

**Answer:** _____

---

### Q46. `$table->timestamps()` creates created_at and updated_at columns.

**Answer:** _____

---

### Q47. Foreign keys automatically create indexes.

**Answer:** _____

---

### Q48. You can rollback a specific migration by name.

**Answer:** _____

---

### Q49. Seeders populate the database with test data.

**Answer:** _____

---

### Q50. Factories use Faker library to generate fake data.

**Answer:** _____

---

### Q51. `nullable()` allows NULL values in a column.

**Answer:** _____

---

### Q52. `default()` sets a default value for a column.

**Answer:** _____

---

### Q53. `unique()` ensures all values in a column are different.

**Answer:** _____

---

### Q54. You can have multiple `id()` columns in one table.

**Answer:** _____

---

### Q55. `softDeletes()` adds a deleted_at timestamp column.

**Answer:** _____

---

### Q56. Migrations are run in alphabetical order by filename.

**Answer:** _____

---

### Q57. `Schema::drop()` and `Schema::dropIfExists()` do the same thing.

**Answer:** _____

---

### Q58. You can add indexes after creating a table.

**Answer:** _____

---

### Q59. `onDelete('cascade')` deletes related records automatically.

**Answer:** _____

---

### Q60. Factories can be used in testing.

**Answer:** _____

---

# Section C: Fill in the Blanks (10 Questions)

---

### Q61. To create a migration, use `php artisan __________ create_users_table`.

**Answer:** __________________

---

### Q62. To run all migrations, use `php artisan __________`.

**Answer:** __________________

---

### Q63. Migrations are stored in `database/__________/`.

**Answer:** __________________

---

### Q64. To create a table, use `Schema::__________ ('table', function() {})`.

**Answer:** __________________

---

### Q65. To make a column nullable, chain the `__________()` method.

**Answer:** __________________

---

### Q66. `$table->__________()` creates an auto-incrementing primary key.

**Answer:** __________________

---

### Q67. To create timestamps, use `$table->__________()`.

**Answer:** __________________

---

### Q68. Seeders are stored in `database/__________/`.

**Answer:** __________________

---

### Q69. To run seeders, use `php artisan db:__________`.

**Answer:** __________________

---

### Q70. Factories are stored in `database/__________/`.

**Answer:** __________________

---

# Section D: Code Analysis (10 Questions)

---

### Q71. What does this migration create?

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('email')->unique();
    $table->timestamps();
});
```

a) A users table with id, email, and timestamps
b) A users table with only email
c) An error
d) Nothing

**Answer:** _____

---

### Q72. What's wrong with this migration?

```php
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
    });
}

public function down()
{
    // Empty!
}
```

a) Missing `Schema::drop('posts')` in down()
b) Missing timestamps
c) Missing foreign key
d) No error

**Answer:** _____

---

### Q73. What does this foreign key do?

```php
$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade');
```

a) Deletes user when post is deleted
b) Deletes post when user is deleted
c) Prevents deletion
d) Nothing

**Answer:** _____

---

### Q74. What happens when this runs?

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('phone')->nullable();
});
```

a) Creates users table
b) Adds phone column to existing users table
c) Error
d) Drops users table

**Answer:** _____

---

### Q75. What's the purpose of this seeder?

```php
public function run()
{
    User::factory()->count(50)->create();
}
```

a) Creates 50 real users
b) Creates 50 fake users for testing
c) Deletes 50 users
d) Updates 50 users

**Answer:** _____

---

### Q76. What does this factory define?

```php
public function definition()
{
    return [
        'name' => fake()->name(),
        'email' => fake()->unique()->email(),
    ];
}
```

a) Validation rules
b) Fake data template for User model
c) Database schema
d) API response

**Answer:** _____

---

### Q77. What will this create?

```php
$table->enum('role', ['admin', 'user', 'guest'])
      ->default('user');
```

a) A string column
b) An enum column with 3 choices, default 'user'
c) An integer column
d) A boolean column

**Answer:** _____

---

### Q78. How many columns does this create?

```php
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->timestamps();
$table->softDeletes();
```

a) 4
b) 5
c) 6
d) 7

**Answer:** _____

---

### Q79. What happens with this index?

```php
$table->string('email')->index();
```

a) Makes email unique
b) Creates an index for faster email queries
c) Makes email required
d) Encrypts email

**Answer:** _____

---

### Q80. What does this rollback do?

```php
public function down()
{
    Schema::dropIfExists('posts');
}
```

a) Drops posts table if migration is rolled back
b) Drops posts table immediately
c) Checks if posts exist
d) Does nothing

**Answer:** _____

---

# Section E: Find the Bug (10 Questions)

---

### Q81. Find the bug:

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('email');
    // Missing timestamps!
});
```

a) No bug (timestamps are optional)
b) Should add `$table->timestamps()`
c) Missing closing brace
d) Wrong table name

**Answer:** _____

---

### Q82. Find the bug:

```php
$table->foreignId('user_id')
      ->constrained('user');  // Wrong table name!
      // Should be 'users'
```

a) Table name should be 'users' (plural)
b) Wrong method
c) Missing onDelete
d) No bug

**Answer:** _____

---

### Q83. Find the bug:

```php
public function up()
{
    $table->string('name');  // Missing Schema::create!
}
```

a) Missing `Schema::create()` wrapper
b) Wrong method
c) Missing table name
d) No bug

**Answer:** _____

---

### Q84. Find the bug:

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('phone');
});
// This is in a NEW migration, but table was never created!
```

a) Can't modify table that doesn't exist
b) Wrong method
c) Missing parameter
d) No bug if users table exists from another migration

**Answer:** _____

---

### Q85. Find the bug:

```php
$table->string('email')->unique()->nullable();
// Can nullable column be unique?
```

a) Actually no bug - NULL values can coexist
b) Can't have both unique and nullable
c) Wrong order
d) Missing default

**Answer:** _____

---

### Q86. Find the bug:

```php
$table->id();
$table->id();  // Duplicate primary key!
```

a) Can't have two id() columns (two primary keys)
b) No bug
c) Missing names
d) Wrong method

**Answer:** _____

---

### Q87. Find the bug:

```php
// Migration file: 2024_01_01_create_posts_table
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        // Creating 'users' but filename says 'posts'!
    });
}
```

a) Table name doesn't match migration filename
b) No bug
c) Wrong date
d) Missing parameter

**Answer:** _____

---

### Q88. Find the bug:

```php
public function run()
{
    User::create([
        'name' => 'John',
        'email' => 'john@example.com'
        // Missing password - might be required!
    ]);
}
```

a) Might fail if password is required
b) Wrong method
c) Missing factory
d) No bug

**Answer:** _____

---

### Q89. Find the bug:

```php
$table->enum('status', ['active', 'inactive']);
// User tries to insert 'pending' - not in enum!
```

a) Will throw error - 'pending' not in allowed values
b) No bug
c) Wrong syntax
d) Missing default

**Answer:** _____

---

### Q90. Find the bug:

```php
Schema::drop('users');
// Drops table but doesn't check if it exists!
```

a) Should use `dropIfExists()` to be safe
b) No bug
c) Wrong method
d) Missing parameter

**Answer:** _____

---

# Section F: Code Writing (10 Questions)

**Instructions:** Write the complete code.

---

### Q91. Create a migration for a 'posts' table with:
- id (primary key)
- title (string)
- content (text)
- user_id (foreign key to users)
- timestamps

```php













```

---

### Q92. Write the down() method to drop the posts table.

```php




```

---

### Q93. Create a migration to add a 'phone' column (nullable string) to existing 'users' table.

```php









```

---

### Q94. Write a migration to drop the 'phone' column from 'users' table.

```php









```

---

### Q95. Create a seeder that creates 10 users using factory.

```php






```

---

### Q96. Write a factory definition for a Post model with:
- title (fake sentence)
- content (fake paragraph)
- user_id (random 1-10)

```php









```

---

### Q97. Create a table with soft deletes. Include id, name, email, timestamps, and soft deletes.

```php









```

---

### Q98. Write a foreign key for 'category_id' that references 'id' on 'categories' table with cascade on delete.

```php



```

---

### Q99. Create an enum column 'status' with values: 'draft', 'published', 'archived', default 'draft'.

```php


```

---

### Q100. Write command to:
1. Rollback last migration
2. Re-run all migrations
3. Seed the database

```bash
1. _______________________
2. _______________________
3. _______________________
```

---

## End of Exam / نهاية الاختبار

**Total Questions:** 100
**Your Score:** ____ / 100

---

## Grading Scale / سلم التقييم

- **90-100:** A+ (ممتاز)
- **80-89:** A (ممتاز -)
- **70-79:** B (جيد جداً)
- **60-69:** C (جيد)
- **50-59:** D (مقبول)
- **Below 50:** F (راسب)

---

**Good Luck! / بالتوفيق!** 🚀

**Instructor Signature:** ___________________
**Date Graded:** ___________________
**Final Score:** ___________________
