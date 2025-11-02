# Lesson 9: Authentication & Authorization - Full Exam
# الدرس التاسع: المصادقة والترخيص - الاختبار الكامل

**Student Name:** _________________ | **Date:** _________
**Time Limit:** 150 minutes | **Passing Score:** 70/100

---

## Section A: Multiple Choice (40 Questions)

**Instructions:** Choose the correct answer for each question.

### Q1. What is Authentication?
a) Checking what a user can do
b) Verifying who the user is
c) Managing database connections
d) Routing requests

**Answer:** _____

### Q2. What is Authorization?
a) Verifying who the user is
b) Checking what a user can do
c) Creating user accounts
d) Password management

**Answer:** _____

### Q3. What command installs Laravel Breeze?
a) `composer require laravel/breeze`
b) `php artisan install breeze`
c) `npm install breeze`
d) `composer install breeze`

**Answer:** _____

### Q4. What does Laravel Breeze provide?
a) Only login functionality
b) Complete authentication scaffolding
c) Only database migrations
d) API authentication only

**Answer:** _____

### Q5. Which helper checks if a user is logged in?
a) `user()->isLogged()`
b) `auth()->check()`
c) `Auth::isAuthenticated()`
d) `session()->hasUser()`

**Answer:** _____

### Q6. Which helper checks if a user is NOT logged in?
a) `auth()->notLogged()`
b) `auth()->guest()`
c) `Auth::isGuest()`
d) `user()->notAuth()`

**Answer:** _____

### Q7. How do you get the current authenticated user?
a) `auth()->user()`
b) `user()->get()`
c) `Auth::getUser()`
d) `session()->user()`

**Answer:** _____

### Q8. How do you get the current user's ID?
a) `auth()->user()->id`
b) `auth()->id()`
c) Both a and b
d) `Auth::getUserId()`

**Answer:** _____

### Q9. What method attempts to log in a user?
a) `Auth::login()`
b) `Auth::attempt()`
c) `Auth::try()`
d) `Auth::authenticate()`

**Answer:** _____

### Q10. What does `Auth::attempt()` return?
a) User object
b) True or false
c) Token string
d) NULL

**Answer:** _____

### Q11. How do you log out a user?
a) `Auth::logout()`
b) `auth()->signOut()`
c) `session()->logout()`
d) `user()->logout()`

**Answer:** _____

### Q12. What is a Gate in Laravel?
a) Database connection
b) A simple authorization check
c) A middleware
d) A route group

**Answer:** _____

### Q13. Where are Gates typically defined?
a) In routes/web.php
b) In AppServiceProvider boot() method
c) In config/auth.php
d) In middleware

**Answer:** _____

### Q14. What does `Gate::allows()` return?
a) User object
b) True or false
c) String message
d) NULL

**Answer:** _____

### Q15. What happens when `Gate::authorize()` denies permission?
a) Returns false
b) Returns null
c) Throws 403 exception
d) Redirects to login

**Answer:** _____

### Q16. What is a Policy in Laravel?
a) A database rule
b) An organized class for model authorization
c) A route configuration
d) A validation rule

**Answer:** _____

### Q17. What command creates a Policy?
a) `php artisan make:policy PostPolicy`
b) `php artisan create:policy PostPolicy`
c) `php artisan policy:make PostPolicy`
d) `php artisan new:policy PostPolicy`

**Answer:** _____

### Q18. Which Policy method checks if user can view any records?
a) `index()`
b) `viewAll()`
c) `viewAny()`
d) `list()`

**Answer:** _____

### Q19. Which Policy method checks if user can view a specific record?
a) `show()`
b) `view()`
c) `canView()`
d) `display()`

**Answer:** _____

### Q20. Which Policy method checks if user can create a record?
a) `store()`
b) `make()`
c) `create()`
d) `new()`

**Answer:** _____

### Q21. Which Policy method checks if user can update a record?
a) `edit()`
b) `modify()`
c) `update()`
d) `change()`

**Answer:** _____

### Q22. Which Policy method checks if user can delete a record?
a) `remove()`
b) `destroy()`
c) `delete()`
d) `erase()`

**Answer:** _____

### Q23. How do you authorize in a controller?
a) `$this->auth('update', $post)`
b) `$this->authorize('update', $post)`
c) `$this->permit('update', $post)`
d) `$this->allow('update', $post)`

**Answer:** _____

### Q24. What middleware protects routes requiring authentication?
a) `'login'`
b) `'auth'`
c) `'authenticate'`
d) `'user'`

**Answer:** _____

### Q25. What middleware allows only guests (not logged in)?
a) `'notauth'`
b) `'visitor'`
c) `'guest'`
d) `'public'`

**Answer:** _____

### Q26. What middleware requires email verification?
a) `'email'`
b) `'verified'`
c) `'confirm'`
d) `'check'`

**Answer:** _____

### Q27. How do you hash a password?
a) `password_hash()`
b) `bcrypt()`
c) `Hash::make()`
d) All of the above work, but c is preferred

**Answer:** _____

### Q28. How do you check a password against a hash?
a) `Hash::check($plain, $hashed)`
b) `Hash::verify($plain, $hashed)`
c) `bcrypt_check($plain, $hashed)`
d) `password_verify($plain, $hashed)`

**Answer:** _____

### Q29. What validation rule checks the current password?
a) `'password'`
b) `'current_password'`
c) `'old_password'`
d) `'check_password'`

**Answer:** _____

### Q30. What package provides API token authentication?
a) Laravel Passport
b) Laravel Sanctum
c) Laravel Fortify
d) Laravel Jetstream

**Answer:** _____

### Q31. What trait must User model have for Sanctum?
a) `HasTokens`
b) `HasApiTokens`
c) `Authenticatable`
d) `TokenAuth`

**Answer:** _____

### Q32. How do you create an API token?
a) `$user->makeToken('name')`
b) `$user->createToken('name')->plainTextToken`
c) `$user->generateToken('name')`
d) `Token::create($user, 'name')`

**Answer:** _____

### Q33. How do you protect API routes with Sanctum?
a) `Route::middleware('sanctum')`
b) `Route::middleware('auth:sanctum')`
c) `Route::middleware('token')`
d) `Route::middleware('api:sanctum')`

**Answer:** _____

### Q34. How do you delete current access token (logout)?
a) `$request->user()->token()->delete()`
b) `$request->user()->currentAccessToken()->delete()`
c) `Auth::deleteToken()`
d) `Token::remove()`

**Answer:** _____

### Q35. What Blade directive checks if user is authenticated?
a) `@logged`
b) `@authenticated`
c) `@auth`
d) `@user`

**Answer:** _____

### Q36. What Blade directive checks if user is NOT authenticated?
a) `@notauth`
b) `@visitor`
c) `@guest`
d) `@anonymous`

**Answer:** _____

### Q37. What Blade directive checks authorization?
a) `@authorize('update', $post)`
b) `@can('update', $post)`
c) `@allowed('update', $post)`
d) `@permit('update', $post)`

**Answer:** _____

### Q38. What is the opposite of `@can`?
a) `@cant`
b) `@cannot`
c) `@denied`
d) `@notallowed`

**Answer:** _____

### Q39. Why regenerate session on login?
a) For better performance
b) To prevent session fixation attacks
c) To clear old data
d) It's not necessary

**Answer:** _____

### Q40. Which method regenerates session?
a) `$request->session()->regenerate()`
b) `$request->session()->refresh()`
c) `$request->session()->renew()`
d) `Session::regenerate()`

**Answer:** _____

---

## Section B: True/False (20 Questions)

**Instructions:** Write **T** for True or **F** for False.

### Q41. Authentication verifies who the user is.
**Answer:** _____

### Q42. Authorization verifies what the user can do.
**Answer:** _____

### Q43. Laravel Breeze provides complete authentication scaffolding.
**Answer:** _____

### Q44. `auth()->check()` returns the user object.
**Answer:** _____

### Q45. `auth()->guest()` returns true if user is NOT logged in.
**Answer:** _____

### Q46. Gates are defined in routes/web.php.
**Answer:** _____

### Q47. `Gate::authorize()` throws 403 exception if denied.
**Answer:** _____

### Q48. Policies are organized classes for model authorization.
**Answer:** _____

### Q49. Policy methods are automatically discovered by Laravel.
**Answer:** _____

### Q50. The `auth` middleware protects routes requiring login.
**Answer:** _____

### Q51. The `guest` middleware allows only authenticated users.
**Answer:** _____

### Q52. `Hash::make()` is the recommended way to hash passwords.
**Answer:** _____

### Q53. `Hash::check()` compares plain text password with hash.
**Answer:** _____

### Q54. Laravel Sanctum provides API token authentication.
**Answer:** _____

### Q55. User model needs `HasApiTokens` trait for Sanctum.
**Answer:** _____

### Q56. `@auth` directive checks if user is authenticated in Blade.
**Answer:** _____

### Q57. `@can` directive checks authorization in Blade.
**Answer:** _____

### Q58. Session should be regenerated on login for security.
**Answer:** _____

### Q59. Session should be invalidated on logout.
**Answer:** _____

### Q60. CSRF token should be regenerated on logout.
**Answer:** _____

---

## Section C: Fill in the Blanks (10 Questions)

**Instructions:** Fill in the missing parts.

### Q61. To check if user is logged in: `auth()->______()`
**Answer:** _____________________

### Q62. To get current user: `auth()->______()`
**Answer:** _____________________

### Q63. To attempt login: `Auth::______($$credentials)`
**Answer:** _____________________

### Q64. To logout: `Auth::______()`
**Answer:** _____________________

### Q65. To check authorization: `Gate::______($$ability, $$model)`
**Answer:** _____________________

### Q66. To authorize in controller: `$$this->______($$ability, $$model)`
**Answer:** _____________________

### Q67. To hash password: `Hash::______($$password)`
**Answer:** _____________________

### Q68. To create API token: `$$user->______('token-name')->plainTextToken`
**Answer:** _____________________

### Q69. To protect route with auth: `Route::middleware('______')`
**Answer:** _____________________

### Q70. To regenerate session: `$$request->session()->______()`
**Answer:** _____________________

---

## Section D: Code Analysis (10 Questions)

**Instructions:** Analyze the code and answer the questions.

### Q71. What does this code do?

```php
if (auth()->check()) {
    return redirect('/dashboard');
}
return redirect('/login');
```

a) Redirects everyone to dashboard
b) Redirects authenticated users to dashboard, guests to login
c) Redirects everyone to login
d) Throws an error

**Answer:** _____

### Q72. What happens when this runs?

```php
Auth::attempt(['email' => 'user@example.com', 'password' => 'wrong'])
```

a) Throws exception
b) Returns false
c) Returns null
d) Logs in user

**Answer:** _____

### Q73. What does this Gate check?

```php
Gate::define('update-post', function (User $user, Post $post) {
    return $user->id === $post->user_id;
});
```

a) Anyone can update any post
b) Only post owner can update
c) Only admin can update
d) No one can update

**Answer:** _____

### Q74. What happens if this Policy method returns false?

```php
public function update(User $user, Post $post): bool
{
    return $user->id === $post->user_id;
}

// In controller:
$this->authorize('update', $post);
```

a) Continues execution
b) Returns false
c) Throws 403 exception
d) Redirects to login

**Answer:** _____

### Q75. What does this middleware do?

```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

a) Allows everyone
b) Allows only guests
c) Allows only authenticated users
d) Allows only admins

**Answer:** _____

### Q76. What will this display if user is NOT logged in?

```blade
@auth
    <p>Welcome {{ auth()->user()->name }}</p>
@endauth

@guest
    <a href="/login">Login</a>
@endguest
```

a) Welcome message
b) Login link
c) Both
d) Nothing

**Answer:** _____

### Q77. What does this do?

```php
$request->session()->regenerate();
```

a) Deletes session
b) Creates new session ID (prevents session fixation)
c) Logs out user
d) Nothing

**Answer:** _____

### Q78. What's wrong with this logout code?

```php
Auth::logout();
return redirect('/');
```

a) Nothing wrong
b) Should invalidate session
c) Should regenerate CSRF token
d) Both b and c

**Answer:** _____

### Q79. What does this return?

```php
$token = $user->createToken('auth-token')->plainTextToken;
```

a) Token object
b) Plain text token string
c) Hashed token
d) NULL

**Answer:** _____

### Q80. How many queries does this potentially make (N+1 problem)?

```php
$users = User::all(); // 10 users
foreach ($users as $user) {
    if ($user->posts->count() > 0) {
        echo $user->name;
    }
}
```

a) 1 query
b) 2 queries
c) 10 queries
d) 11 queries

**Answer:** _____

---

## Section E: Find the Bug (10 Questions)

**Instructions:** Find and explain the bug in each code snippet.

### Q81. Find the bug:

```php
public function dashboard()
{
    $user = auth()->user();
    return view('dashboard', ['name' => $user->name]);
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q82. Find the bug:

```php
Gate::define('update-post', function (User $user, Post $post) {
    return true; // Everyone can update
});
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q83. Find the bug:

```php
public function update(Request $request, Post $post)
{
    // Missing authorization check
    $post->update($request->validated());
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q84. Find the bug:

```php
// Policy
public function view(User $user, Post $post): bool
{
    return $post->is_published;
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q85. Find the bug:

```php
Route::middleware('guest')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q86. Find the bug:

```php
$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $request->password, // Plain text!
]);
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q87. Find the bug:

```php
// Login
Auth::attempt($credentials);
return redirect('/dashboard');
// Missing session regenerate
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q88. Find the bug:

```php
// Logout
Auth::logout();
return redirect('/');
// Missing session cleanup
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q89. Find the bug:

```blade
@can('update-post', $post)
    <a href="/posts/{{ $post->id }}/edit">Edit</a>
@endcan
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q90. Find the bug:

```php
class User extends Authenticatable
{
    // Missing HasApiTokens trait
}

// Creating token
$token = $user->createToken('auth')->plainTextToken;
```

**Bug:** _____________________________________

**Fix:** _____________________________________

---

## Section F: Code Writing (10 Questions)

**Instructions:** Write the required code.

### Q91. Write a Gate that checks if user can delete a post (only post owner or admin)

```php
// In AppServiceProvider
Gate::define('delete-post', function (User $user, Post $post) {
    // Write your code here
});
```

**Your Answer:**
```php

```

---

### Q92. Write a PostPolicy update method (only owner can update)

```php
class PostPolicy
{
    public function update(User $user, Post $post): bool
    {
        // Write your code here
    }
}
```

**Your Answer:**
```php

```

---

### Q93. Write code to protect routes with auth middleware

```php
// Protect dashboard and profile routes
```

**Your Answer:**
```php

```

---

### Q94. Write a complete login method in AuthController

```php
public function login(Request $request)
{
    // Validate
    // Attempt login
    // Regenerate session
    // Redirect
}
```

**Your Answer:**
```php

```

---

### Q95. Write a complete logout method

```php
public function logout(Request $request)
{
    // Logout
    // Invalidate session
    // Regenerate CSRF token
    // Redirect
}
```

**Your Answer:**
```php

```

---

### Q96. Write Blade code to show "Edit" button only if user can update post

```blade
{{-- Your code here --}}
```

**Your Answer:**
```blade

```

---

### Q97. Write code to create API token with specific abilities

```php
// Create token with 'posts:create' and 'posts:update' abilities
```

**Your Answer:**
```php

```

---

### Q98. Write middleware to check if user is admin

```php
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Write your code here
    }
}
```

**Your Answer:**
```php

```

---

### Q99. Write a complete API register method

```php
public function register(Request $request)
{
    // Validate
    // Create user with hashed password
    // Create token
    // Return JSON response
}
```

**Your Answer:**
```php

```

---

### Q100. Write a Policy before method (super admin can do everything)

```php
class PostPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        // Write your code here
    }
}
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
