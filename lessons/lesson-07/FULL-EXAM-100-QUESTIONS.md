# Lesson 7: Eloquent Relationships - Full Exam
# الدرس السابع: علاقات Eloquent - الاختبار الكامل

**Student Name:** _________________ | **Date:** _________
**Time Limit:** 150 minutes | **Passing Score:** 70/100

---

## Section A: Multiple Choice (40 Questions)

**Instructions:** Choose the correct answer for each question.

### Q1. What type of relationship is "User has one Phone"?
a) One-to-Many
b) One-to-One
c) Many-to-Many
d) Polymorphic

**Answer:** _____

### Q2. What method defines a One-to-One relationship in the User model?
a) `hasOne(Phone::class)`
b) `belongsTo(Phone::class)`
c) `hasMany(Phone::class)`
d) `belongsToMany(Phone::class)`

**Answer:** _____

### Q3. What is the inverse of `hasOne()`?
a) `hasMany()`
b) `belongsTo()`
c) `manyToOne()`
d) `oneToOne()`

**Answer:** _____

### Q4. What type of relationship is "User has many Posts"?
a) One-to-One
b) One-to-Many
c) Many-to-Many
d) Has-Many-Through

**Answer:** _____

### Q5. What method defines "Post belongs to User"?
a) `hasOne(User::class)`
b) `hasMany(User::class)`
c) `belongsTo(User::class)`
d) `manyToOne(User::class)`

**Answer:** _____

### Q6. What type of relationship is "Students and Courses" (students can take many courses)?
a) One-to-One
b) One-to-Many
c) Many-to-Many
d) Polymorphic

**Answer:** _____

### Q7. What method defines a Many-to-Many relationship?
a) `hasMany()`
b) `belongsTo()`
c) `belongsToMany()`
d) `manyToMany()`

**Answer:** _____

### Q8. What is a pivot table?
a) A primary database table
b) An intermediate table for many-to-many relationships
c) A view in the database
d) A temporary table

**Answer:** _____

### Q9. What is the naming convention for a pivot table between "users" and "roles"?
a) `users_roles`
b) `role_user`
c) `user_role`
d) `roles_users`

**Answer:** _____

### Q10. Which is the correct pivot table name? (alphabetical order)
a) `post_tag`
b) `tag_post`
c) `posts_tags`
d) `tags_posts`

**Answer:** _____

### Q11. What method attaches a related model in many-to-many?
a) `add()`
b) `attach()`
c) `insert()`
d) `create()`

**Answer:** _____

### Q12. What method removes a related model in many-to-many?
a) `remove()`
b) `delete()`
c) `detach()`
d) `destroy()`

**Answer:** _____

### Q13. What method syncs relationships (attaches new, detaches old)?
a) `synchronize()`
b) `sync()`
c) `update()`
d) `refresh()`

**Answer:** _____

### Q14. What does eager loading prevent?
a) Database errors
b) The N+1 problem
c) Memory leaks
d) SQL injection

**Answer:** _____

### Q15. What method is used for eager loading?
a) `load()`
b) `with()`
c) `include()`
d) `fetch()`

**Answer:** _____

### Q16. How do you eager load the "posts" relationship?
a) `User::with('posts')->get()`
b) `User::load('posts')->get()`
c) `User::include('posts')->get()`
d) `User::fetch('posts')->get()`

**Answer:** _____

### Q17. What is the N+1 problem?
a) A database connection error
b) Making N+1 queries when 1 or 2 would suffice
c) Having too many records
d) A foreign key constraint error

**Answer:** _____

### Q18. How do you lazy eager load a relationship?
a) `$user->with('posts')`
b) `$user->load('posts')`
c) `$user->fetch('posts')`
d) `$user->include('posts')`

**Answer:** _____

### Q19. What does `whereHas('posts')` do?
a) Deletes posts
b) Counts posts
c) Filters users who have posts
d) Updates posts

**Answer:** _____

### Q20. What does `has('posts')` do?
a) Creates posts
b) Filters models that have at least one related post
c) Deletes posts
d) Updates posts

**Answer:** _____

### Q21. What does `doesntHave('posts')` return?
a) All posts
b) Users without any posts
c) Posts without users
d) All users

**Answer:** _____

### Q22. How do you count related models without loading them?
a) `withCount('posts')`
b) `countPosts()`
c) `postsCount()`
d) `count('posts')`

**Answer:** _____

### Q23. What is the result of `$user->posts` (property access)?
a) A query builder instance
b) A collection of posts
c) NULL
d) A single post

**Answer:** _____

### Q24. What is the result of `$user->posts()` (method call)?
a) A collection of posts
b) A query builder instance
c) NULL
d) An array

**Answer:** _____

### Q25. How do you access pivot data in many-to-many?
a) `$role->pivot->created_at`
b) `$role->intermediate->created_at`
c) `$role->join->created_at`
d) `$role->relation->created_at`

**Answer:** _____

### Q26. How do you specify additional pivot columns?
a) `->withPivot('column')`
b) `->withColumns('column')`
c) `->pivot('column')`
d) `->columns('column')`

**Answer:** _____

### Q27. How do you add timestamps to pivot table?
a) `->timestamps()`
b) `->withTimestamps()`
c) `->pivotTimestamps()`
d) `->addTimestamps()`

**Answer:** _____

### Q28. What is a polymorphic relationship?
a) A relationship with multiple tables using the same foreign key
b) A relationship that changes type
c) A relationship where a model can belong to multiple models on a single association
d) A broken relationship

**Answer:** _____

### Q29. What columns are needed for a polymorphic relationship?
a) `foreign_id` only
b) `commentable_id` and `commentable_type`
c) `id` and `type`
d) `model_id` only

**Answer:** _____

### Q30. What method defines a polymorphic relationship?
a) `morphTo()`
b) `polymorphic()`
c) `multiType()`
d) `dynamicRelation()`

**Answer:** _____

### Q31. What method defines the inverse of a polymorphic relationship?
a) `morphMany()`
b) `morphTo()`
c) `belongsTo()`
d) `hasMany()`

**Answer:** _____

### Q32. What is a Has-Many-Through relationship?
a) A direct relationship
b) Accessing distant relationships through an intermediate model
c) A broken relationship
d) A many-to-many relationship

**Answer:** _____

### Q33. Example: Country → Users → Posts. What method defines this?
a) `hasMany(Post::class)`
b) `hasManyThrough(Post::class, User::class)`
c) `throughMany(Post::class, User::class)`
d) `belongsToMany(Post::class)`

**Answer:** _____

### Q34. How do you create a related model?
a) `$user->posts()->create(['title' => 'Test'])`
b) `$user->posts->create(['title' => 'Test'])`
c) `$user->createPost(['title' => 'Test'])`
d) `Post::create(['user_id' => $user->id])`

**Answer:** _____

### Q35. What does `save()` do on a relationship?
a) Saves the parent model
b) Saves the related model with foreign key automatically set
c) Deletes the model
d) Updates the pivot table

**Answer:** _____

### Q36. How do you update pivot data?
a) `$user->roles()->updatePivot($roleId, ['active' => true])`
b) `$user->roles()->update(['active' => true])`
c) `$user->pivot->update(['active' => true])`
d) `$user->updatePivot(['active' => true])`

**Answer:** _____

### Q37. What does `toggle()` do in many-to-many?
a) Deletes all relationships
b) Attaches if not attached, detaches if attached
c) Updates the pivot table
d) Counts relationships

**Answer:** _____

### Q38. How do you constrain eager loading?
a) `with('posts', function($query) { $query->where('active', 1); })`
b) `with('posts')->where('active', 1)`
c) `load('posts', ['active' => 1])`
d) `with(['posts' => 'active'])`

**Answer:** _____

### Q39. What does `wherePivot()` do?
a) Filters pivot table data
b) Creates pivot records
c) Deletes pivot records
d) Updates pivot records

**Answer:** _____

### Q40. How do you get the count of relationships?
a) `$user->posts->count()`
b) `$user->posts()->count()`
c) Both a and b
d) `count($user->posts)`

**Answer:** _____

---

## Section B: True/False (20 Questions)

**Instructions:** Write **T** for True or **F** for False.

### Q41. `hasOne()` defines a One-to-Many relationship.
**Answer:** _____

### Q42. `belongsTo()` is the inverse of `hasMany()`.
**Answer:** _____

### Q43. A pivot table is required for One-to-Many relationships.
**Answer:** _____

### Q44. Pivot table names should be in alphabetical order by default.
**Answer:** _____

### Q45. `attach()` is used to remove relationships.
**Answer:** _____

### Q46. `sync()` attaches new relationships and detaches old ones.
**Answer:** _____

### Q47. Eager loading solves the N+1 problem.
**Answer:** _____

### Q48. `with()` is used for lazy loading.
**Answer:** _____

### Q49. `$user->posts` returns a query builder instance.
**Answer:** _____

### Q50. `$user->posts()` returns a collection.
**Answer:** _____

### Q51. `whereHas()` filters models based on relationship existence.
**Answer:** _____

### Q52. `doesntHave()` returns models that have the relationship.
**Answer:** _____

### Q53. `withCount()` loads all related models into memory.
**Answer:** _____

### Q54. A polymorphic relationship requires two columns: `_id` and `_type`.
**Answer:** _____

### Q55. `morphTo()` defines the parent side of a polymorphic relationship.
**Answer:** _____

### Q56. Has-Many-Through allows accessing distant relationships.
**Answer:** _____

### Q57. `toggle()` in many-to-many switches attachment status.
**Answer:** _____

### Q58. You can access pivot data using `$model->pivot`.
**Answer:** _____

### Q59. `withPivot()` specifies additional pivot columns to retrieve.
**Answer:** _____

### Q60. Foreign keys are automatically created by Laravel for all relationships.
**Answer:** _____

---

## Section C: Fill in the Blanks (10 Questions)

**Instructions:** Fill in the missing parts.

### Q61. To define "User has many Posts", use: `public function posts() { return $this->_______(Post::class); }`
**Answer:** _____________________

### Q62. To define "Post belongs to User", use: `public function user() { return $this->_______(User::class); }`
**Answer:** _____________________

### Q63. To define a Many-to-Many relationship, use: `return $this->_______(Role::class);`
**Answer:** _____________________

### Q64. To eager load relationships, use: `User::______('posts')->get();`
**Answer:** _____________________

### Q65. To attach a role to a user: `$user->roles()->______(1);`
**Answer:** _____________________

### Q66. To detach all roles from a user: `$user->roles()->______();`
**Answer:** _____________________

### Q67. To filter users who have posts: `User::______('posts')->get();`
**Answer:** _____________________

### Q68. To count posts without loading them: `User::______('posts')->get();`
**Answer:** _____________________

### Q69. To define a polymorphic relationship (inverse): `return $this->______();`
**Answer:** _____________________

### Q70. To add timestamps to pivot table: `return $this->belongsToMany(Role::class)->______();`
**Answer:** _____________________

---

## Section D: Code Analysis (10 Questions)

**Instructions:** Analyze the code and answer the questions.

### Q71. What problem does this code have?

```php
$users = User::all();
foreach ($users as $user) {
    echo $user->posts->count();
}
```

a) Syntax error
b) N+1 problem
c) No problem
d) Missing foreign key

**Answer:** _____

### Q72. How many queries does this execute?

```php
$users = User::with('posts')->get(); // 10 users
foreach ($users as $user) {
    echo $user->posts->count();
}
```

a) 1 query
b) 2 queries
c) 10 queries
d) 11 queries

**Answer:** _____

### Q73. What does this return?

```php
$user = User::find(1);
return $user->posts();
```

a) Collection of posts
b) Query builder instance
c) NULL
d) Single post

**Answer:** _____

### Q74. What does this return?

```php
$user = User::find(1);
return $user->posts;
```

a) Query builder instance
b) Collection of posts
c) NULL
d) Array

**Answer:** _____

### Q75. What will happen?

```php
$user = User::find(1);
$user->roles()->attach([1, 2, 3]);
$user->roles()->attach([2, 3, 4]);
```

a) Roles 2 and 3 will be duplicated in pivot table
b) Only roles 2, 3, 4 will exist
c) Error will occur
d) Nothing happens

**Answer:** _____

### Q76. What does this code do?

```php
$user->roles()->sync([1, 2, 3]);
```

a) Adds roles 1, 2, 3
b) Removes all roles except 1, 2, 3
c) Attaches roles 1, 2, 3 and detaches all others
d) Deletes roles 1, 2, 3

**Answer:** _____

### Q77. How can you fix this N+1 problem?

```php
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->user->name;
}
```

a) Use `Post::with('user')->get()`
b) Use `Post::load('user')->get()`
c) Use `Post::include('user')->get()`
d) Cannot be fixed

**Answer:** _____

### Q78. What does this return?

```php
User::whereHas('posts', function($query) {
    $query->where('published', true);
})->get();
```

a) All users
b) Users who have published posts
c) Published posts
d) NULL

**Answer:** _____

### Q79. What does `withCount()` add to the model?

```php
$users = User::withCount('posts')->get();
echo $users[0]->posts_count;
```

a) Loads all posts
b) Adds a `posts_count` attribute with the count
c) Counts users
d) Creates a new column in database

**Answer:** _____

### Q80. What is wrong with this relationship?

```php
// User model
public function posts() {
    return $this->hasOne(Post::class);
}

// A user has MANY posts in reality
```

a) Should use `hasMany()` instead of `hasOne()`
b) Should use `belongsTo()`
c) Should use `belongsToMany()`
d) Nothing wrong

**Answer:** _____

---

## Section E: Find the Bug (10 Questions)

**Instructions:** Find and explain the bug in each code snippet.

### Q81. Find the bug:

```php
// User model
public function posts() {
    return $this->hasMany(Post::class);
}

// Post model
public function user() {
    return $this->hasMany(User::class);
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q82. Find the bug:

```php
$users = User::all();
foreach ($users as $user) {
    foreach ($user->posts as $post) {
        echo $post->title;
    }
}
// This causes N+1 problem
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q83. Find the bug:

```php
// Student and Course (many-to-many)
// Pivot table named: students_courses

public function courses() {
    return $this->belongsToMany(Course::class);
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q84. Find the bug:

```php
$user = User::find(1);
$user->roles()->attach(1);
$user->roles()->attach(1); // Attaching again
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q85. Find the bug:

```php
// User hasMany Posts
// Post belongsTo User
// Missing foreign key in posts table
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q86. Find the bug:

```php
$user = User::find(1);
echo $user->posts()->title; // Trying to access title
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q87. Find the bug:

```php
// Trying to eager load but using wrong syntax
$users = User::load('posts')->get();
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q88. Find the bug:

```php
// Comment is polymorphic (can belong to Post or Video)
public function commentable() {
    return $this->belongsTo(Post::class);
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q89. Find the bug:

```php
// Accessing pivot data without specifying it
$user->roles()->withPivot('active');
foreach ($user->roles as $role) {
    echo $role->active; // Wrong
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q90. Find the bug:

```php
// Trying to use whereHas without callback
User::whereHas('posts')->get();
```

**Bug:** _____________________________________

**Fix:** _____________________________________

---

## Section F: Code Writing (10 Questions)

**Instructions:** Write the required code.

### Q91. Define a One-to-Many relationship: User has many Posts

```php
// User model
public function posts()
{
    // Write your code here
}

// Post model
public function user()
{
    // Write your code here
}
```

**Your Answer:**
```php
// User model


// Post model

```

---

### Q92. Define a Many-to-Many relationship: Student belongsToMany Courses

```php
// Student model
public function courses()
{
    // Write your code here
}

// Course model
public function students()
{
    // Write your code here
}
```

**Your Answer:**
```php
// Student model


// Course model

```

---

### Q93. Write code to eager load posts with users (solve N+1 problem)

```php
// Get all users with their posts in 2 queries
```

**Your Answer:**
```php

```

---

### Q94. Write code to attach roles [1, 2, 3] to a user

```php
$user = User::find(1);
// Attach roles 1, 2, 3
```

**Your Answer:**
```php

```

---

### Q95. Write code to detach all roles from a user

```php
$user = User::find(1);
// Detach all roles
```

**Your Answer:**
```php

```

---

### Q96. Write code to sync roles [1, 2, 3] (attach these, detach others)

```php
$user = User::find(1);
// Sync roles
```

**Your Answer:**
```php

```

---

### Q97. Write code to get users who have at least one post

```php
// Filter users who have posts
```

**Your Answer:**
```php

```

---

### Q98. Write code to count posts for each user without loading posts

```php
// Get users with posts count
```

**Your Answer:**
```php

```

---

### Q99. Define a polymorphic relationship: Comment can belong to Post or Video

```php
// Comment model
public function commentable()
{
    // Write your code here
}

// Post model
public function comments()
{
    // Write your code here
}
```

**Your Answer:**
```php
// Comment model


// Post model

```

---

### Q100. Write code to create a post through the user relationship

```php
$user = User::find(1);
// Create a post with title "My Post" and content "Post content"
```

**Your Answer:**
```php

```

---

## Grading Scale / سلم التقييم

- **90-100:** A+ (Excellent - ممتاز)
- **80-89:** A (Very Good - جيد جداً)
- **70-79:** B (Good - جيد)
- **60-69:** C (Satisfactory - مقبول)
- **Below 60:** F (Needs Improvement - يحتاج تحسين)

---

## Answer Key Summary (For Instructor)

**Section A:** 40 questions × 1 point = 40 points
**Section B:** 20 questions × 1 point = 20 points
**Section C:** 10 questions × 1 point = 10 points
**Section D:** 10 questions × 1 point = 10 points
**Section E:** 10 questions × 1 point = 10 points
**Section F:** 10 questions × 1 point = 10 points

**Total:** 100 points

---

**Good Luck! / بالتوفيق!** 🚀
