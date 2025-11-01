# Lesson 2: Routing - Full Exam
# الدرس الثاني: التوجيه (Routing) - الاختبار الكامل

**Total Questions:** 100
**Lesson Topic:** Laravel Routing
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
| F | Code Writing | 5 | 5 |
| G | What's the Output | 5 | 5 |
| **Total** | | **100** | **100** |

---

# Section A: Multiple Choice (40 Questions)
# القسم أ: اختيار من متعدد

---

### Q1. Where are web routes defined in Laravel?

a) `app/routes.php`
b) `routes/web.php`
c) `config/routes.php`
d) `public/routes.php`

**Answer:** _____

---

### Q2. Which HTTP method is used to retrieve/read data?

a) POST
b) GET
c) PUT
d) DELETE

**Answer:** _____

---

### Q3. Which HTTP method is used to create new resources?

a) GET
b) POST
c) PUT
d) PATCH

**Answer:** _____

---

### Q4. Which HTTP method is used for complete update?

a) POST
b) GET
c) PUT
d) PATCH

**Answer:** _____

---

### Q5. Which HTTP method is used to delete resources?

a) REMOVE
b) DELETE
c) DESTROY
d) DROP

**Answer:** _____

---

### Q6. How do you define a GET route?

a) `Route::get('/path', function)`
b) `Route::create('/path', function)`
c) `Get::route('/path', function)`
d) `Route::make('/path', function)`

**Answer:** _____

---

### Q7. How do you define a POST route?

a) `Route::create('/path', function)`
b) `Route::post('/path', function)`
c) `Post::route('/path', function)`
d) `Route::send('/path', function)`

**Answer:** _____

---

### Q8. What is a route parameter?

a) A fixed value in URL
b) A variable value in URL enclosed in `{}`
c) A query string
d) A form field

**Answer:** _____

---

### Q9. How do you define a required route parameter?

a) `Route::get('/user/{id}', ...)`
b) `Route::get('/user/[id]', ...)`
c) `Route::get('/user/$id', ...)`
d) `Route::get('/user/:id', ...)`

**Answer:** _____

---

### Q10. How do you define an optional route parameter?

a) `Route::get('/user/{id}', ...)`
b) `Route::get('/user/{id?}', ...)`
c) `Route::get('/user/[id?]', ...)`
d) `Route::get('/user/{id:optional}', ...)`

**Answer:** _____

---

### Q11. How do you add a constraint to a route parameter?

a) `->where('id', '[0-9]+')`
b) `->constraint('id', '[0-9]+')`
c) `->validate('id', '[0-9]+')`
d) `->check('id', '[0-9]+')`

**Answer:** _____

---

### Q12. What does `->where('id', '[0-9]+')` mean?

a) ID must be letters
b) ID must be numeric
c) ID must be alphanumeric
d) ID is optional

**Answer:** _____

---

### Q13. How do you name a route?

a) `->name('route.name')`
b) `->setName('route.name')`
c) `->routeName('route.name')`
d) `->called('route.name')`

**Answer:** _____

---

### Q14. How do you generate a URL for a named route?

a) `url('route.name')`
b) `route('route.name')`
c) `path('route.name')`
d) `link('route.name')`

**Answer:** _____

---

### Q15. How do you pass parameters to a named route?

a) `route('user.show', $id)`
b) `route('user.show', ['id' => $id])`
c) Both a and b
d) `route('user.show?id=' . $id)`

**Answer:** _____

---

### Q16. What is a route group?

a) A way to apply attributes to multiple routes
b) A collection of models
c) A database table
d) A view component

**Answer:** _____

---

### Q17. How do you add a prefix to route groups?

a) `Route::prefix('admin')->group(...)`
b) `Route::group(['prefix' => 'admin'], ...)`
c) Both a and b
d) `Route::addPrefix('admin')->group(...)`

**Answer:** _____

---

### Q18. How do you add a name prefix to route groups?

a) `Route::name('admin.')->group(...)`
b) `Route::namePrefix('admin.')->group(...)`
c) `Route::prefix('admin.')->group(...)`
d) `Route::group(['as' => 'admin.'], ...)`

**Answer:** _____

---

### Q19. What does `Route::middleware('auth')` do?

a) Creates authentication
b) Applies middleware to routes
c) Deletes authentication
d) Displays login form

**Answer:** _____

---

### Q20. How do you redirect from one route to another?

a) `redirect('/path')`
b) `redirect()->to('/path')`
c) `Route::redirect('/old', '/new')`
d) All of the above

**Answer:** _____

---

### Q21. How do you redirect to a named route?

a) `redirect()->route('route.name')`
b) `redirect('route.name')`
c) `route()->redirect('route.name')`
d) `to()->route('route.name')`

**Answer:** _____

---

### Q22. What is CSRF protection?

a) A type of encryption
b) Protection against Cross-Site Request Forgery
c) A database feature
d) A caching mechanism

**Answer:** _____

---

### Q23. How do you add CSRF token in forms?

a) `@csrf`
b) `{{ csrf_token() }}`
c) `<input type="hidden" name="_token" value="{{ csrf_token() }}">`
d) All of the above

**Answer:** _____

---

### Q24. Which routes require CSRF protection?

a) GET only
b) POST, PUT, PATCH, DELETE
c) All routes
d) DELETE only

**Answer:** _____

---

### Q25. How do you spoof HTTP methods in forms?

a) `@method('PUT')`
b) `{{ method('PUT') }}`
c) `<input type="method" value="PUT">`
d) Forms can use any method directly

**Answer:** _____

---

### Q26. What does `Route::view('/path', 'view.name')` do?

a) Creates a view file
b) Returns a view without controller
c) Deletes a view
d) Redirects to view

**Answer:** _____

---

### Q27. How do you pass data to a view route?

a) `Route::view('/path', 'view', ['key' => 'value'])`
b) `Route::view('/path', 'view')->with('key', 'value')`
c) Only a is correct
d) Both a and b

**Answer:** _____

---

### Q28. What is route model binding?

a) Automatically inject model instance in route
b) Create models from routes
c) Delete models via routes
d) Display models in views

**Answer:** _____

---

### Q29. How do you view all registered routes?

a) `php artisan routes`
b) `php artisan route:list`
c) `php artisan list:routes`
d) `php artisan show:routes`

**Answer:** _____

---

### Q30. What does `Route::fallback()` do?

a) Creates a backup route
b) Handles 404 errors
c) Redirects to homepage
d) Deletes invalid routes

**Answer:** _____

---

### Q31. Where are API routes defined?

a) `routes/api.php`
b) `routes/web.php`
c) `app/api.php`
d) `config/api.php`

**Answer:** _____

---

### Q32. What prefix is automatically applied to API routes?

a) `/api`
b) `/rest`
c) `/v1`
d) No prefix

**Answer:** _____

---

### Q33. How do you access the current route name?

a) `Route::currentRouteName()`
b) `request()->route()->getName()`
c) Both a and b
d) `Route::getName()`

**Answer:** _____

---

### Q34. What does `Route::match(['get', 'post'], '/path', ...)` do?

a) Creates two routes
b) Route responds to both GET and POST
c) Redirects GET to POST
d) Validates methods

**Answer:** _____

---

### Q35. What does `Route::any('/path', ...)` do?

a) Responds to any HTTP method
b) Responds to GET only
c) Creates multiple routes
d) Requires authentication

**Answer:** _____

---

### Q36. What does `Route::permanentRedirect()` return?

a) 301 status code
b) 302 status code
c) 404 status code
d) 200 status code

**Answer:** _____

---

### Q37. Which method defines a route for both show and update?

a) `Route::resource()`
b) `Route::crud()`
c) `Route::restful()`
d) `Route::api()`

**Answer:** _____

---

### Q38. What is the correct regex pattern for numeric IDs?

a) `[0-9]`
b) `[0-9]+`
c) `[0-9]*`
d) `\d+`

**Answer:** _____

---

### Q39. How do you constrain multiple parameters?

a) `->where(['id' => '[0-9]+', 'slug' => '[a-z]+'])`
b) `->where('id', '[0-9]+')->where('slug', '[a-z]+')`
c) Both a and b
d) Not possible

**Answer:** _____

---

### Q40. What is a route service provider?

a) Provides services to routes
b) Registers and configures routes
c) Creates route files
d) Deletes unused routes

**Answer:** _____

---

# Section B: True or False (20 Questions)
# القسم ب: صح أو خطأ

---

### Q41. Web routes are defined in `routes/web.php`.

**Answer:** _____

---

### Q42. GET requests can modify data on the server.

**Answer:** _____

---

### Q43. Route parameters are enclosed in curly braces `{}`.

**Answer:** _____

---

### Q44. You can have multiple parameters in a single route.

**Answer:** _____

---

### Q45. Route names must be unique.

**Answer:** _____

---

### Q46. Named routes make it easier to generate URLs.

**Answer:** _____

---

### Q47. Route groups can share middleware.

**Answer:** _____

---

### Q48. CSRF protection is only needed for GET requests.

**Answer:** _____

---

### Q49. `@csrf` directive adds CSRF token to forms.

**Answer:** _____

---

### Q50. HTML forms only support GET and POST methods.

**Answer:** _____

---

### Q51. `@method('PUT')` allows form method spoofing.

**Answer:** _____

---

### Q52. `Route::view()` requires a controller.

**Answer:** _____

---

### Q53. Route model binding automatically injects model instances.

**Answer:** _____

---

### Q54. API routes automatically have `/api` prefix.

**Answer:** _____

---

### Q55. You can apply middleware to a single route.

**Answer:** _____

---

### Q56. `Route::fallback()` must be defined last.

**Answer:** _____

---

### Q57. Regular expressions can be used in route constraints.

**Answer:** _____

---

### Q58. `route()` helper generates URLs for named routes.

**Answer:** _____

---

### Q59. Routes are registered in RouteServiceProvider.

**Answer:** _____

---

### Q60. You can redirect to external URLs using `redirect()`.

**Answer:** _____

---

# Section C: Fill in the Blanks (10 Questions)
# القسم ج: املأ الفراغات

---

### Q61. To define a GET route, use `Route::__________('/path', callback)`.

**Answer:** __________________

---

### Q62. Route parameters are defined using `{__________}` syntax.

**Answer:** __________________

---

### Q63. To make a parameter optional, add a `__________` after the parameter name.

**Answer:** __________________

---

### Q64. The `__________` method names a route for URL generation.

**Answer:** __________________

---

### Q65. CSRF tokens are added to forms using the `__________` directive.

**Answer:** __________________

---

### Q66. To spoof PUT method in forms, use `__________('PUT')`.

**Answer:** __________________

---

### Q67. The command `php artisan __________` lists all routes.

**Answer:** __________________

---

### Q68. Route groups share attributes using `Route::__________()` method.

**Answer:** __________________

---

### Q69. To redirect to a named route, use `redirect()->__________('route.name')`.

**Answer:** __________________

---

### Q70. API routes are defined in `routes/__________.php`.

**Answer:** __________________

---

# Section D: Code Analysis (10 Questions)
# القسم د: تحليل الكود

---

### Q71. What does this route do?

```php
Route::get('/users/{id}', function ($id) {
    return "User ID: " . $id;
});
```

a) Shows all users
b) Shows user with specific ID
c) Creates a new user
d) Deletes a user

**Answer:** _____

---

### Q72. What's wrong with this route?

```php
Route::get('/post/{id?}', function () {
    return "Post ID: " . $id;
});
```

a) Missing `$id` parameter in function
b) Should use POST method
c) Parameter name mismatch
d) No error

**Answer:** _____

---

### Q73. What will this return for `/user/abc`?

```php
Route::get('/user/{id}', function ($id) {
    return "User: " . $id;
})->where('id', '[0-9]+');
```

a) "User: abc"
b) 404 error
c) 500 error
d) Redirect to home

**Answer:** _____

---

### Q74. How many routes does this create?

```php
Route::prefix('admin')->group(function () {
    Route::get('/users', ...);
    Route::get('/posts', ...);
});
```

a) 1
b) 2
c) 3
d) 4

**Answer:** _____

---

### Q75. What URL does this generate?

```php
// Route definition
Route::get('/posts/{id}', ...)->name('posts.show');

// URL generation
route('posts.show', 5);
```

a) `/posts`
b) `/posts/5`
c) `/posts?id=5`
d) `/5/posts`

**Answer:** _____

---

### Q76. Is this form secure?

```blade
<form method="POST" action="/users">
    <input type="text" name="name">
    <button>Submit</button>
</form>
```

a) Yes, completely secure
b) No, missing CSRF token
c) No, missing encryption
d) No, missing validation

**Answer:** _____

---

### Q77. What HTTP method will be used?

```blade
<form method="POST" action="/users/5">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>
```

a) GET
b) POST
c) DELETE (spoofed via POST)
d) PUT

**Answer:** _____

---

### Q78. What's the route name?

```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', ...)->name('users');
});
```

a) `users`
b) `admin.users`
c) `prefix.users`
d) `admin/users`

**Answer:** _____

---

### Q79. What does this return?

```php
Route::view('/about', 'about', ['title' => 'About Us']);
```

a) Creates about.blade.php
b) Shows about view with title variable
c) Redirects to /about
d) Error

**Answer:** _____

---

### Q80. When does this route execute?

```php
Route::fallback(function () {
    return view('errors.404');
});
```

a) On every request
b) When no other route matches
c) On errors only
d) Never

**Answer:** _____

---

# Section E: Find the Bug (10 Questions)
# القسم هـ: اكتشف الخطأ

---

### Q81. Find the bug:

```php
Route::post('/users/{id}', function ($userId) {
    return "User: " . $userId;
});
```

a) Parameter name mismatch: `{id}` vs `$userId`
b) Should use GET
c) Missing constraint
d) No bug

**Answer:** _____

---

### Q82. Find the bug:

```php
Route::get('/users/{id}', ...)->where('id', '[a-z]+');
// URL: /users/123
```

a) Constraint allows letters, but ID is numeric
b) Should use POST
c) Missing parameter
d) No bug

**Answer:** _____

---

### Q83. Find the bug:

```php
Route::get('/posts/{id}/{slug?}', function ($id) {
    return "Post: " . $id . " - " . $slug;
});
```

a) Missing `$slug` parameter in function
b) Can't mix required and optional parameters
c) Should use POST
d) No bug

**Answer:** _____

---

### Q84. Find the bug:

```php
route('posts.show', ['post' => 5, 'comment' => 10]);
// Route: Route::get('/posts/{id}', ...)->name('posts.show');
```

a) Parameter mismatch: route expects 'id', passed 'post'
b) Too many parameters
c) Should use $id directly
d) No bug

**Answer:** _____

---

### Q85. Find the bug:

```blade
<form method="GET" action="/users">
    @csrf
    <input type="text" name="search">
</form>
```

a) GET requests don't need CSRF
b) Missing method spoofing
c) Should use POST
d) No bug

**Answer:** _____

---

### Q86. Find the bug:

```php
Route::get('/users', ...)->name('users');
Route::get('/posts', ...)->name('users');  // Same name!
```

a) Duplicate route names (must be unique)
b) Should use different HTTP methods
c) Missing middleware
d) No bug

**Answer:** _____

---

### Q87. Find the bug:

```php
Route::prefix('admin')->group(function () {
    Route::get('users', ...);  // Missing leading slash
});
```

a) 'users' should be '/users'
b) Actually no bug - both work
c) Should use POST
d) Missing name

**Answer:** _____

---

### Q88. Find the bug:

```php
Route::view('/terms', 'legal.terms')
     ->with('title', 'Terms of Service');
```

a) `Route::view()` doesn't support `->with()`
b) Missing parameter
c) Should use Route::get()
d) No bug

**Answer:** _____

---

### Q89. Find the bug:

```php
Route::get('/user/{id}', function ($id) {
    return User::find($id);
})->where('id', '[0-9]+');

// Visit: /user/999999 (user doesn't exist)
```

a) Will return null (no 404) - should use findOrFail
b) Constraint is wrong
c) Missing parameter
d) No bug

**Answer:** _____

---

### Q90. Find the bug:

```php
// routes/web.php
Route::get('/admin', ...);
Route::prefix('admin')->group(function () {
    Route::get('/', ...);  // Duplicate!
});
```

a) Both create `/admin` route - conflict!
b) Should use different methods
c) Missing middleware
d) No bug

**Answer:** _____

---

# Section F: Code Writing (5 Questions)
# القسم و: كتابة الكود

**Instructions:** Write the complete code for each requirement.

---

### Q91. Write a route that:
- Accepts GET requests to `/products/{id}`
- ID must be numeric
- Returns "Product: {id}"

```php








```

---

### Q92. Write a route group that:
- Has prefix `admin`
- Has name prefix `admin.`
- Contains two routes: `/users` and `/posts`
- Both named appropriately

```php










```

---

### Q93. Create a form that:
- Submits to `/users/{id}` with PUT method
- Includes CSRF protection
- Has an input field for "name"

```blade











```

---

### Q94. Write code to:
- Define a route named `user.profile`
- Generate URL for user ID 10
- Store in `$url` variable

```php





```

---

### Q95. Create a fallback route that:
- Returns a custom 404 view
- View is located at `errors.not-found`

```php



```

---

# Section G: What's the Output (5 Questions)
# القسم ز: ما هو الناتج

---

### Q96. What URL is generated?

```php
Route::get('/posts/{post}/comments/{comment}', ...)
     ->name('posts.comments');

echo route('posts.comments', ['post' => 5, 'comment' => 10]);
```

**Output:** __________________

---

### Q97. What is displayed when visiting `/user/john`?

```php
Route::get('/user/{name}', function ($name) {
    return "Hello, " . strtoupper($name);
});
```

**Output:** __________________

---

### Q98. What HTTP status code is returned?

```php
Route::permanentRedirect('/old-url', '/new-url');
// User visits /old-url
```

**Status Code:** __________________

---

### Q99. What is the final route name?

```php
Route::name('api.')->prefix('api')->group(function () {
    Route::get('/users', ...)->name('users.index');
});
```

**Route Name:** __________________

---

### Q100. What happens when visiting `/products/abc`?

```php
Route::get('/products/{id}', function ($id) {
    return "Product: " . $id;
})->where('id', '[0-9]+');
```

a) Shows "Product: abc"
b) 404 Not Found
c) 500 Error
d) Redirects to home

**Answer:** _____

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
