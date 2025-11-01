# Lesson 6: Eloquent ORM - Basics - Full Exam
# الدرس السادس: Eloquent ORM - الأساسيات - الاختبار الكامل

**Total Questions:** 100
**Lesson Topic:** Eloquent ORM Basics
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

### Q1. What is Eloquent?

a) A JavaScript library
b) Laravel's ORM (Object-Relational Mapping)
c) A database driver
d) A templating engine

**Answer:** _____

---

### Q2. How do you create a model?

a) `php artisan make:model User`
b) `php artisan create:model User`
c) `php artisan model:make User`
d) `php artisan new:model User`

**Answer:** _____

---

### Q3. Where are models stored by default?

a) `app/Models/`
b) `app/`
c) `models/`
d) `database/models/`

**Answer:** _____

---

### Q4. What table name does a `Post` model use by default?

a) `post`
b) `posts`
c) `Post`
d) `Posts`

**Answer:** _____

---

### Q5. How do you specify a custom table name?

a) `protected $table = 'my_posts';`
b) `public $tableName = 'my_posts';`
c) `protected $tableName = 'my_posts';`
d) `public $table = 'my_posts';`

**Answer:** _____

---

### Q6. What is the default primary key column name?

a) `ID`
b) `id`
c) `primary_key`
d) `pk`

**Answer:** _____

---

### Q7. How do you specify a custom primary key?

a) `protected $primaryKey = 'user_id';`
b) `public $primary = 'user_id';`
c) `protected $key = 'user_id';`
d) `public $primaryKey = 'user_id';`

**Answer:** _____

---

### Q8. How do you retrieve all records?

a) `User::getAll()`
b) `User::all()`
c) `User::fetchAll()`
d) `User::get()`

**Answer:** _____

---

### Q9. What's the difference between `all()` and `get()`?

a) No difference
b) `all()` returns Collection, `get()` returns array
c) `all()` retrieves all, `get()` executes query builder
d) `get()` is faster

**Answer:** _____

---

### Q10. How do you find a record by primary key?

a) `User::find(1)`
b) `User::get(1)`
c) `User::findBy(1)`
d) `User::where('id', 1)`

**Answer:** _____

---

### Q11. What does `findOrFail()` do when record not found?

a) Returns null
b) Throws 404 exception
c) Returns empty collection
d) Returns false

**Answer:** _____

---

### Q12. How do you get the first record?

a) `User::get(0)`
b) `User::first()`
c) `User::one()`
d) `User::findFirst()`

**Answer:** _____

---

### Q13. What does `User::where('active', true)->first()` return?

a) All active users
b) First active user
c) Last active user
d) Array of users

**Answer:** _____

---

### Q14. How do you create a new record?

a) `User::create(['name' => 'John'])`
b) `new User(['name' => 'John'])->save()`
c) Both a and b
d) `User::insert(['name' => 'John'])`

**Answer:** _____

---

### Q15. What is mass assignment?

a) Assigning multiple variables
b) Creating multiple records at once
c) Assigning multiple attributes in one operation
d) Database replication

**Answer:** _____

---

### Q16. What property protects against mass assignment?

a) `$protected`
b) `$fillable`
c) `$guarded`
d) Both b and c

**Answer:** _____

---

### Q17. What does `$fillable` define?

a) Required fields
b) Fields that can be mass assigned
c) Validated fields
d) Primary key

**Answer:** _____

---

### Q18. What does `$guarded` define?

a) Required fields
b) Fields that CANNOT be mass assigned
c) Encrypted fields
d) Foreign keys

**Answer:** _____

---

### Q19. How do you allow all fields for mass assignment?

a) `protected $fillable = ['*'];`
b) `protected $guarded = [];`
c) `protected $fillable = [];`
d) `protected $guarded = ['*'];`

**Answer:** _____

---

### Q20. How do you update a record?

a) `$user->update(['name' => 'Jane'])`
b) `$user->name = 'Jane'; $user->save();`
c) Both a and b
d) `User::update(1, ['name' => 'Jane'])`

**Answer:** _____

---

### Q21. What does `User::where('id', 1)->update(['name' => 'Jane'])` do?

a) Updates and returns the user
b) Updates matching records, returns number affected
c) Throws error
d) Creates new record

**Answer:** _____

---

### Q22. How do you delete a record?

a) `$user->delete()`
b) `User::destroy(1)`
c) `User::where('id', 1)->delete()`
d) All of the above

**Answer:** _____

---

### Q23. What does `User::destroy([1, 2, 3])` do?

a) Deletes users with IDs 1, 2, 3
b) Throws error
c) Deletes all users
d) Does nothing

**Answer:** _____

---

### Q24. What columns does `$timestamps = true` create?

a) `timestamp` column
b) `created_at` and `updated_at`
c) `created_at`, `updated_at`, `deleted_at`
d) `date_created` and `date_modified`

**Answer:** _____

---

### Q25. How do you disable automatic timestamps?

a) `protected $timestamps = false;`
b) `public $timestamps = false;`
c) `protected $noTimestamps = true;`
d) `public $useTimestamps = false;`

**Answer:** _____

---

### Q26. What trait enables soft deletes?

a) `SoftDelete`
b) `SoftDeletes`
c) `Deletable`
d) `TrashAble`

**Answer:** _____

---

### Q27. What column does soft delete use?

a) `deleted`
b) `deleted_at`
c) `is_deleted`
d) `trashed_at`

**Answer:** _____

---

### Q28. How do you include soft deleted records?

a) `User::all()`
b) `User::withTrashed()->get()`
c) `User::withDeleted()->get()`
d) `User::showDeleted()->get()`

**Answer:** _____

---

### Q29. How do you get only soft deleted records?

a) `User::onlyTrashed()->get()`
b) `User::deleted()->get()`
c) `User::trashed()->get()`
d) `User::withTrashed()->get()`

**Answer:** _____

---

### Q30. How do you restore a soft deleted record?

a) `$user->restore()`
b) `$user->undelete()`
c) `$user->recover()`
d) `$user->activate()`

**Answer:** _____

---

### Q31. How do you permanently delete a soft deleted record?

a) `$user->delete()`
b) `$user->forceDelete()`
c) `$user->permanentDelete()`
d) `$user->destroy()`

**Answer:** _____

---

### Q32. What does `User::latest()->first()` return?

a) Oldest user
b) Most recently created user
c) First user alphabetically
d) Random user

**Answer:** _____

---

### Q33. What is the opposite of `latest()`?

a) `earliest()`
b) `oldest()`
c) `first()`
d) `oldest()`

**Answer:** _____

---

### Q34. How do you limit results to 10 records?

a) `User::limit(10)->get()`
b) `User::take(10)->get()`
c) Both a and b
d) `User::get(10)`

**Answer:** _____

---

### Q35. How do you skip the first 5 records?

a) `User::skip(5)->get()`
b) `User::offset(5)->get()`
c) Both a and b
d) `User::from(5)->get()`

**Answer:** _____

---

### Q36. What does `pluck('name')` return?

a) Array of user objects
b) Collection of name values only
c) First name
d) String of names

**Answer:** _____

---

### Q37. How do you count records?

a) `User::count()`
b) `count(User::all())`
c) Both a and b (a is better)
d) `User::total()`

**Answer:** _____

---

### Q38. What does `User::where('age', '>', 18)->count()` return?

a) Collection of users
b) Number of users over 18
c) Array of ages
d) First user over 18

**Answer:** _____

---

### Q39. How do you order results?

a) `User::orderBy('name')->get()`
b) `User::sortBy('name')->get()`
c) `User::order('name')->get()`
d) `User::sort('name')->get()`

**Answer:** _____

---

### Q40. How do you create a model with migration?

a) `php artisan make:model User -m`
b) `php artisan make:model User --migration`
c) Both a and b
d) `php artisan make:model User -create`

**Answer:** _____

---

# Section B: True or False (20 Questions)

---

### Q41. Eloquent follows "Convention over Configuration".

**Answer:** _____

---

### Q42. The default table name for a `User` model is `users`.

**Answer:** _____

---

### Q43. The default primary key column is `id`.

**Answer:** _____

---

### Q44. `find()` returns null if record not found.

**Answer:** _____

---

### Q45. `findOrFail()` throws a 404 exception if record not found.

**Answer:** _____

---

### Q46. `$fillable` and `$guarded` can be used together.

**Answer:** _____

---

### Q47. Setting `$guarded = []` allows all mass assignment.

**Answer:** _____

---

### Q48. `User::create()` requires `$fillable` or `$guarded` properties.

**Answer:** _____

---

### Q49. `$timestamps = false` disables automatic timestamp management.

**Answer:** _____

---

### Q50. Soft deletes require the `SoftDeletes` trait.

**Answer:** _____

---

### Q51. Soft deleted records are excluded from queries by default.

**Answer:** _____

---

### Q52. `forceDelete()` bypasses soft delete and permanently removes the record.

**Answer:** _____

---

### Q53. `latest()` orders by `created_at` in descending order.

**Answer:** _____

---

### Q54. `all()` returns a Collection instance.

**Answer:** _____

---

### Q55. `pluck()` returns an array of values.

**Answer:** _____

---

### Q56. `count()` executes a COUNT query on the database.

**Answer:** _____

---

### Q57. You can chain multiple `where()` methods.

**Answer:** _____

---

### Q58. `update()` on a query returns the updated model.

**Answer:** _____

---

### Q59. Models are stored in `app/Models/` by default in Laravel 8+.

**Answer:** _____

---

### Q60. Eloquent automatically handles `created_at` and `updated_at` if `$timestamps = true`.

**Answer:** _____

---

# Section C: Fill in the Blanks (10 Questions)

---

### Q61. To create a model, use `php artisan __________ User`.

**Answer:** __________________

---

### Q62. To specify a custom table name, set `protected $__________ = 'my_table';`.

**Answer:** __________________

---

### Q63. To retrieve all records, use `User::__________()`.

**Answer:** __________________

---

### Q64. To find by primary key or throw 404, use `User::__________(1)`.

**Answer:** __________________

---

### Q65. To protect against mass assignment, define `protected $__________ = ['name', 'email'];`.

**Answer:** __________________

---

### Q66. To enable soft deletes, use the `__________` trait.

**Answer:** __________________

---

### Q67. Soft deletes create a `__________` column.

**Answer:** __________________

---

### Q68. To include soft deleted records, use `User::__________()->get()`.

**Answer:** __________________

---

### Q69. To get the newest record, use `User::__________()->first()`.

**Answer:** __________________

---

### Q70. To count records, use `User::__________()`.

**Answer:** __________________

---

# Section D: Code Analysis (10 Questions)

---

### Q71. What does this return?

```php
User::find(5);
```

a) User with ID 5, or null if not found
b) All users
c) 5 users
d) Error

**Answer:** _____

---

### Q72. What does this code do?

```php
class User extends Model
{
    protected $fillable = ['name', 'email'];
}

User::create(['name' => 'John', 'email' => 'john@example.com', 'password' => 'secret']);
```

a) Creates user with all three fields
b) Creates user with name and email only (password ignored)
c) Throws error
d) Creates user with password only

**Answer:** _____

---

### Q73. What happens here?

```php
$user = User::find(999); // User doesn't exist
echo $user->name;
```

a) Displays empty string
b) Displays null
c) Fatal error: trying to get property of null
d) No error

**Answer:** _____

---

### Q74. What's returned?

```php
User::where('age', '>', 18)->get();
```

a) Single user
b) Collection of users over 18
c) Number of users
d) Array of users

**Answer:** _____

---

### Q75. What does this do?

```php
class Post extends Model
{
    protected $timestamps = false;
}
```

a) Deletes timestamp columns
b) Disables automatic timestamp management
c) Hides timestamps from output
d) Validates timestamps

**Answer:** _____

---

### Q76. What's the result?

```php
User::destroy([1, 2, 3]);
```

a) Deletes users with IDs 1, 2, and 3
b) Soft deletes users 1, 2, 3
c) Returns users 1, 2, 3
d) Error

**Answer:** _____

---

### Q77. What does this return?

```php
User::pluck('email');
```

a) User model
b) Collection of email addresses only
c) First email
d) Array of user objects

**Answer:** _____

---

### Q78. How many queries does this execute?

```php
$users = User::all();
$count = User::count();
```

a) 1
b) 2
c) 3
d) 0

**Answer:** _____

---

### Q79. What's the output?

```php
class Post extends Model
{
    use SoftDeletes;
}

$post = Post::find(1);
$post->delete();

// Later:
$found = Post::find(1);
var_dump($found);
```

a) Post object
b) null (soft deleted, excluded from queries)
c) Error
d) Empty array

**Answer:** _____

---

### Q80. What happens?

```php
User::where('id', 1)->update(['name' => 'Jane']);
```

a) Returns updated User model
b) Returns number of affected rows (1)
c) Throws error
d) Returns boolean

**Answer:** _____

---

# Section E: Find the Bug (10 Questions)

---

### Q81. Find the bug:

```php
class User extends Model
{
    // Missing $fillable or $guarded
}

User::create(['name' => 'John']);
```

a) Mass assignment exception - need $fillable or $guarded
b) No bug
c) Missing primary key
d) Wrong method

**Answer:** _____

---

### Q82. Find the bug:

```php
$user = User::find(999);  // Doesn't exist
$user->update(['name' => 'Jane']);
```

a) Calling update() on null - fatal error
b) No bug
c) Wrong method
d) Missing parameter

**Answer:** _____

---

### Q83. Find the bug:

```php
class Post extends Model
{
    protected $table = 'post';  // Should be 'posts'!
}
```

a) Likely error - table probably named 'posts' not 'post'
b) No bug
c) Wrong property
d) Missing quotes

**Answer:** _____

---

### Q84. Find the bug:

```php
class User extends Model
{
    protected $fillable = ['name', 'email'];
    protected $guarded = ['password'];
}
```

a) Can't use both $fillable and $guarded
b) No bug
c) Wrong syntax
d) Missing values

**Answer:** _____

---

### Q85. Find the bug:

```php
$users = User::all();
echo $users->name;  // Collection, not model!
```

a) Can't access property on Collection - need to loop or get first()
b) No bug
c) Wrong property name
d) Missing quotes

**Answer:** _____

---

### Q86. Find the bug:

```php
User::where('age', '>', 18);  // Missing ->get()!
// Doesn't execute query
```

a) Query not executed - need ->get() or ->first()
b) No bug
c) Wrong method
d) Missing parameter

**Answer:** _____

---

### Q87. Find the bug:

```php
class Post extends Model
{
    use SoftDelete;  // Wrong trait name!
}
```

a) Should be `SoftDeletes` (plural)
b) No bug
c) Wrong namespace
d) Missing import

**Answer:** _____

---

### Q88. Find the bug:

```php
$user = new User();
$user->save();  // No attributes set!
```

a) Might violate database constraints (missing required fields)
b) No bug
c) Wrong method
d) Missing parameter

**Answer:** _____

---

### Q89. Find the bug:

```php
User::create([
    'name' => 'John',
    'email' => 'john@example.com'
]);
// Model has $fillable = ['name'] only
```

a) Email will be ignored (not in $fillable)
b) No bug
c) Throws error
d) Creates duplicate

**Answer:** _____

---

### Q90. Find the bug:

```php
$post = Post::onlyTrashed()->first();
$post->restore();
// But Post model doesn't use SoftDeletes trait!
```

a) Error - SoftDeletes trait not imported
b) No bug
c) Wrong method
d) Missing parameter

**Answer:** _____

---

# Section F: Code Writing (10 Questions)

**Instructions:** Write the complete code.

---

### Q91. Create a User model with:
- Mass assignable: name, email
- Guarded: password
- Timestamps enabled

```php









```

---

### Q92. Write code to:
1. Find user with ID 5
2. Update their name to "Jane Doe"
3. Save the changes

```php





```

---

### Q93. Create a query that:
- Gets all users where age > 18
- Orders by name ascending
- Limits to 10 results

```php



```

---

### Q94. Write code to create a new user with:
- name: "John Smith"
- email: "john@example.com"
- age: 25

```php



```

---

### Q95. Write a model that:
- Uses soft deletes
- Table name is "blog_posts"
- Fillable: title, content

```php










```

---

### Q96. Write code to:
1. Soft delete user with ID 10
2. Restore that user
3. Force delete that user permanently

```php





```

---

### Q97. Write a query to get:
- Only user emails (pluck)
- Where status is 'active'

```php


```

---

### Q98. Write code to:
- Count all users
- Count users where role is 'admin'

```php



```

---

### Q99. Create a model that:
- Disables timestamps
- Primary key is 'user_id'
- Table is 'tbl_users'

```php








```

---

### Q100. Write code to delete users where:
- created_at is older than 30 days
- status is 'inactive'

```php



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
