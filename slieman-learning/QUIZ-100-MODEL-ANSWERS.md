# Laravel Quiz - Model Answers (100 Questions)
# الإجابات النموذجية - اختبار Laravel (100 سؤال)

**Quiz:** Lessons 1-3 Comprehensive Test
**Date:** 11/01/2025

---

## 📋 Quick Answer Key / مفتاح الإجابات السريع

### Part 1: Laravel Basics (Q1-30)
```
1-b  2-b  3-b  4-a  5-b  6-c  7-b  8-c  9-b  10-c
11-b 12-b 13-b 14-b 15-b 16-c 17-b 18-b 19-d 20-b
21-a 22-a 23-b 24-b 25-b 26-c 27-b 28-d 29-a 30-b
```

### Part 2: Routing (Q31-65)
```
31-b 32-b 33-b 34-c 35-b 36-a 37-b 38-b 39-a 40-b
41-a 42-b 43-a 44-b 45-c 46-a 47-c 48-a 49-b 50-d
51-a 52-b 53-d 54-b 55-a 56-b 57-c 58-a 59-b 60-b
61-a 62-a 63-c 64-b 65-a
```

### Part 3: Controllers & MVC (Q66-100)
```
66-a 67-b 68-c 69-b 70-c 71-c 72-b 73-c 74-d 75-c
76-a 77-b 78-c 79-a 80-a 81-b 82-c 83-c 84-d 85-a
86-a 87-b 88-d 89-d 90-d 91-a 92-a 93-b 94-a 95-c
96-a 97-b 98-c 99-d 100-b
```

---

# Part 1: Laravel Basics (Questions 1-30)

## Q1. What is Laravel?

**Answer: b) A PHP web application framework**

**Explanation:**
Laravel is a free, open-source PHP web application framework created by Taylor Otwell. It follows the MVC (Model-View-Controller) architectural pattern and provides elegant syntax and powerful tools for building modern web applications.

**Why other options are wrong:**
- a) JavaScript framework → That's React, Vue, Angular
- c) Database management system → That's MySQL, PostgreSQL
- d) Text editor → That's VS Code, Sublime

---

## Q2. Which command is used to create a new Laravel project?

**Answer: b) `composer create-project laravel/laravel project-name`**

**Explanation:**
Composer is PHP's dependency manager. This command downloads Laravel and all its dependencies and creates a new project.

```bash
# Create new Laravel project
composer create-project laravel/laravel my-app

# Or specify version
composer create-project laravel/laravel my-app "12.*"
```

**Why other options are wrong:**
- a) `php artisan new project` → Artisan doesn't create projects, it works inside existing ones
- c) `npm install laravel` → NPM is for JavaScript packages
- d) `laravel install project` → No such command exists

---

## Q3. What is the purpose of the `.env` file?

**Answer: b) To store environment-specific configuration**

**Explanation:**
The `.env` file stores environment variables like database credentials, API keys, and app settings. Different environments (local, staging, production) can have different `.env` files.

```
# .env file example
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=laravel
```

**Why other options are wrong:**
- a) To store routes → Routes are in `routes/` folder
- c) To store views → Views are in `resources/views/`
- d) To store controllers → Controllers are in `app/Http/Controllers/`

**Important:** Never commit `.env` to version control! It contains secrets.

---

## Q4. Which file contains the main application configuration?

**Answer: a) `config/app.php`**

**Explanation:**
`config/app.php` contains core application settings like app name, timezone, locale, providers, and aliases.

```php
// config/app.php
return [
    'name' => env('APP_NAME', 'Laravel'),
    'timezone' => 'UTC',
    'locale' => 'en',
    'providers' => [...],
];
```

**Why other options are wrong:**
- b) `routes/web.php` → For defining routes
- c) `bootstrap/app.php` → For bootstrapping the application
- d) `.env` → For environment variables (reads from here)

---

## Q5. What command starts the Laravel development server?

**Answer: b) `php artisan serve`**

**Explanation:**
This command starts PHP's built-in development server on `localhost:8000`.

```bash
php artisan serve

# Custom port
php artisan serve --port=8080

# Custom host
php artisan serve --host=0.0.0.0 --port=8000
```

**Why other options are wrong:**
- a) `php artisan run` → No such command
- c) `php artisan start` → No such command
- d) `composer serve` → Composer doesn't run servers

---

## Q6. What is the default port for Laravel development server?

**Answer: c) 8000**

**Explanation:**
When you run `php artisan serve`, Laravel starts on `http://localhost:8000` by default.

**Other common ports:**
- 3000 → React, Node.js
- 8080 → Alternative web server port
- 5000 → Flask (Python)

---

## Q7. Which directory contains the application's controllers?

**Answer: b) `app/Http/Controllers`**

**Explanation:**
Controllers handle the logic between routes and views.

**Laravel Directory Structure:**
```
app/
├── Http/
│   ├── Controllers/     ← Controllers here
│   ├── Middleware/
│   └── Requests/
├── Models/              ← Models here
└── Providers/
```

---

## Q8. What is the purpose of the `artisan` command?

**Answer: c) Laravel's command-line tool for various tasks**

**Explanation:**
Artisan is Laravel's powerful CLI tool for generating code, managing database, clearing cache, and more.

**Common Artisan Commands:**
```bash
php artisan list                    # Show all commands
php artisan make:controller Name    # Create controller
php artisan make:model Post         # Create model
php artisan migrate                 # Run migrations
php artisan db:seed                 # Seed database
php artisan route:list              # Show all routes
php artisan cache:clear             # Clear cache
```

---

## Q9. Which directory contains Blade template files?

**Answer: b) `resources/views`**

**Explanation:**
Blade is Laravel's templating engine. All view files go in `resources/views/` with `.blade.php` extension.

```
resources/
└── views/
    ├── welcome.blade.php
    ├── layouts/
    │   └── app.blade.php
    └── users/
        ├── index.blade.php
        └── show.blade.php
```

---

## Q10. What is the file extension for Blade templates?

**Answer: c) `.blade.php`**

**Explanation:**
Blade templates use `.blade.php` extension. Laravel compiles them to plain PHP.

```blade
<!-- resources/views/welcome.blade.php -->
<h1>{{ $title }}</h1>
@if ($users)
    @foreach ($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
@endif
```

---

## Q11. Which command generates the application key?

**Answer: b) `php artisan key:generate`**

**Explanation:**
This generates a random 32-character string for `APP_KEY` in `.env`. Used for encryption and security.

```bash
php artisan key:generate

# Output in .env:
APP_KEY=base64:abc123...
```

**Important:** Run this on fresh Laravel installations!

---

## Q12. Where is the application key stored?

**Answer: b) `.env` file as `APP_KEY`**

**Explanation:**
```
# .env
APP_KEY=base64:RandomGeneratedString123...
```

The key is used to encrypt sessions, cookies, and other sensitive data.

---

## Q13. What is Composer in Laravel context?

**Answer: b) PHP dependency manager**

**Explanation:**
Composer manages PHP packages and dependencies. Laravel itself is installed via Composer.

```bash
# Install Laravel
composer create-project laravel/laravel app

# Install a package
composer require package/name

# Update dependencies
composer update
```

---

## Q14. Which file lists all Composer dependencies?

**Answer: b) `composer.json`**

**Explanation:**
```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^11.0"
    }
}
```

**`composer.lock`** → Locks exact versions installed

---

## Q15. What is the purpose of the `vendor` directory?

**Answer: b) To store Composer dependencies**

**Explanation:**
All packages installed via Composer go into `vendor/`. This includes Laravel framework itself!

**Important:**
- Never edit files in `vendor/`
- Add `vendor/` to `.gitignore`
- Run `composer install` to restore vendor folder

---

## Q16. Which directory should be web-accessible?

**Answer: c) `public`**

**Explanation:**
Only the `public/` directory should be accessible from the web. It contains `index.php` (entry point), assets (CSS, JS, images).

**Apache Virtual Host Example:**
```apache
DocumentRoot "/path/to/project/public"
```

**Security:** Never expose `app/`, `storage/`, or `.env` to the web!

---

## Q17. What file is the application entry point?

**Answer: b) `public/index.php`**

**Explanation:**
All requests go through `public/index.php` which bootstraps Laravel.

**Request Flow:**
```
Browser Request
    ↓
public/index.php
    ↓
bootstrap/app.php
    ↓
Route matching
    ↓
Controller → Response
```

---

## Q18. How do you access environment variables in code?

**Answer: b) `env('VAR')`**

**Explanation:**
```php
// Recommended: Use env() in config files only
$debug = env('APP_DEBUG', false);

// In application code, use config()
$debug = config('app.debug');
```

**Best Practice:**
```php
// config/app.php
'debug' => env('APP_DEBUG', false),

// In your code
if (config('app.debug')) { ... }
```

**Note:** Option d "All of the above" is technically correct in PHP, but Laravel recommends `env()`.

---

## Q19. What is the Laravel version you're learning?

**Answer: d) Laravel 12**

**Explanation:**
Based on the lessons provided, you're learning Laravel 12.x (the latest version as of your learning date).

**Check version:**
```bash
php artisan --version
# Laravel Framework 12.x.x
```

---

## Q20. Which command shows Laravel version?

**Answer: b) `php artisan --version`**

**Explanation:**
```bash
php artisan --version
# Output: Laravel Framework 12.0.0
```

**Also shows PHP version:**
```bash
php --version
# PHP 8.3.0 ...
```

---

## Q21. What is MVC?

**Answer: a) Model View Controller**

**Explanation:**
MVC is an architectural pattern that separates application into three components:

**Model:** Data and business logic
```php
// app/Models/User.php
class User extends Model { ... }
```

**View:** Presentation layer (HTML)
```blade
<!-- resources/views/users.blade.php -->
<h1>Users</h1>
```

**Controller:** Connects Model and View
```php
// app/Http/Controllers/UserController.php
class UserController {
    public function index() {
        $users = User::all();
        return view('users', compact('users'));
    }
}
```

---

## Q22. Which directory contains the Models?

**Answer: a) `app/Models`**

**Explanation:**
```
app/
└── Models/
    ├── User.php
    ├── Post.php
    └── Comment.php
```

**Create a model:**
```bash
php artisan make:model Post
# Creates: app/Models/Post.php
```

---

## Q23. What is the purpose of the `storage` directory?

**Answer: b) To store compiled views, logs, cache**

**Explanation:**
```
storage/
├── app/              # File uploads
├── framework/
│   ├── cache/       # Cache files
│   ├── sessions/    # Session files
│   └── views/       # Compiled Blade templates
└── logs/
    └── laravel.log  # Application logs
```

**Important:** Make sure `storage/` is writable (chmod 775)!

---

## Q24. Which command clears application cache?

**Answer: b) `php artisan cache:clear`**

**Explanation:**
```bash
# Clear application cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear ALL caches
php artisan optimize:clear
```

---

## Q25. What is the purpose of `config/database.php`?

**Answer: b) To configure database connections**

**Explanation:**
```php
// config/database.php
'connections' => [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'laravel'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
    ],
    'sqlite' => [...],
    'pgsql' => [...],
],
```

---

## Q26. Which is the default database for new Laravel projects?

**Answer: c) SQLite**

**Explanation:**
Laravel 12 uses SQLite by default for simplicity. It creates `database/database.sqlite` file.

**Change to MySQL:**
```env
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

---

## Q27. What file should NOT be committed to version control?

**Answer: b) `.env`**

**Explanation:**
`.env` contains secrets (API keys, database passwords). Never commit it!

**`.gitignore` includes:**
```
/vendor/
/node_modules/
.env
.env.backup
*.log
```

**Instead, commit `.env.example`:**
```
# .env.example (safe to commit)
APP_NAME=Laravel
APP_KEY=
DB_CONNECTION=mysql
DB_DATABASE=your_database
```

---

## Q28. Which command lists all available artisan commands?

**Answer: d) Both b and c**

**Explanation:**
```bash
# Method 1
php artisan list

# Method 2 (same result)
php artisan

# Both display all available commands!
```

**Filter by namespace:**
```bash
php artisan list make
# Shows only make:* commands
```

---

## Q29. What is the purpose of `bootstrap/app.php`?

**Answer: a) To create the application instance**

**Explanation:**
This file bootstraps the Laravel application and creates the application container.

```php
// bootstrap/app.php
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

// Register core service providers
$app->singleton(...);

return $app;
```

**Not for displaying views or storing routes!**

---

## Q30. Which directory contains database migrations?

**Answer: b) `database/migrations`**

**Explanation:**
```
database/
├── migrations/
│   ├── 2024_01_01_create_users_table.php
│   └── 2024_01_02_create_posts_table.php
├── seeders/
└── factories/
```

**Create migration:**
```bash
php artisan make:migration create_posts_table
```

---

# Part 2: Routing (Questions 31-65)

## Q31. Where are web routes defined?

**Answer: b) `routes/web.php`**

**Explanation:**
```php
// routes/web.php
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index']);
```

**Other route files:**
- `routes/api.php` → API routes (prefix `/api`)
- `routes/console.php` → Console commands
- `routes/channels.php` → Broadcasting channels

---

## Q32. Which HTTP method is used to retrieve data?

**Answer: b) GET**

**Explanation:**
**GET** = Retrieve/Read data (no side effects)

**HTTP Methods:**
- **GET** → Retrieve data
- **POST** → Create new
- **PUT** → Update (full replacement)
- **PATCH** → Update (partial)
- **DELETE** → Remove

---

## Q33. Which HTTP method is used to create new resources?

**Answer: b) POST**

**Explanation:**
```php
// Display create form
Route::get('/posts/create', [PostController::class, 'create']);

// Handle form submission (create new post)
Route::post('/posts', [PostController::class, 'store']);
```

---

## Q34. Which method updates existing resources completely?

**Answer: c) PUT**

**Explanation:**
- **PUT** = Complete replacement of resource
- **PATCH** = Partial update

```php
// PUT = Replace entire resource
Route::put('/posts/{id}', [PostController::class, 'update']);

// PATCH = Update specific fields
Route::patch('/posts/{id}', [PostController::class, 'update']);
```

---

## Q35. Which method deletes resources?

**Answer: b) DELETE**

**Explanation:**
```php
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
```

```blade
<!-- In Blade -->
<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>
```

---

## Q36. How do you define a GET route?

**Answer: a) `Route::get('/path', function)`**

**Explanation:**
```php
// Closure
Route::get('/about', function () {
    return view('about');
});

// Controller
Route::get('/posts', [PostController::class, 'index']);
```

---

## Q37. How do you define a POST route?

**Answer: b) `Route::post('/path', function)`**

**Explanation:**
```php
Route::post('/posts', [PostController::class, 'store']);
```

---

## Q38. What is a route parameter?

**Answer: b) A variable value in URL enclosed in `{}`**

**Explanation:**
```php
// Required parameter
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});
// /user/5 → "User ID: 5"

// Multiple parameters
Route::get('/posts/{post}/comments/{comment}', function ($post, $comment) {
    return "Post $post, Comment $comment";
});
```

---

## Q39. How do you define a required route parameter?

**Answer: a) `Route::get('/user/{id}', ...)`**

**Explanation:**
```php
// Required
Route::get('/user/{id}', function ($id) { ... });
// /user/5 ✅
// /user ❌ (404 error)
```

---

## Q40. How do you define an optional route parameter?

**Answer: b) `Route::get('/user/{id?}', ...)`**

**Explanation:**
```php
// Optional (note the ?)
Route::get('/user/{id?}', function ($id = null) {
    return $id ? "User $id" : "All users";
});
// /user/5 ✅ → "User 5"
// /user ✅ → "All users"
```

**Don't forget default value in function!**

---

## Q41. How do you add a constraint to route parameters?

**Answer: a) `->where('id', 'pattern')`**

**Explanation:**
```php
// ID must be numeric
Route::get('/user/{id}', ...)->where('id', '[0-9]+');

// Slug must be lowercase letters and hyphens
Route::get('/post/{slug}', ...)->where('slug', '[a-z-]+');

// Multiple constraints
Route::get('/post/{id}/{slug}', ...)
    ->where(['id' => '[0-9]+', 'slug' => '[a-z-]+']);
```

---

## Q42. What does `->where('id', '[0-9]+')` mean?

**Answer: b) ID must be numeric**

**Explanation:**
- `[0-9]` = Any digit (0-9)
- `+` = One or more

```php
Route::get('/user/{id}', ...)->where('id', '[0-9]+');
// /user/123 ✅
// /user/abc ❌ (404)
```

---

## Q43. How do you name a route?

**Answer: a) `->name('route.name')`**

**Explanation:**
```php
Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show');
```

**Use in Blade:**
```blade
<a href="{{ route('users.index') }}">All Users</a>
<a href="{{ route('users.show', $user) }}">View User</a>
```

---

## Q44. How do you generate URL for a named route?

**Answer: b) `route('route.name')`**

**Explanation:**
```php
// Without parameters
$url = route('home');
// http://localhost:8000/

// With parameters
$url = route('user.show', $user->id);
// http://localhost:8000/user/5

// With query string
$url = route('search', ['q' => 'laravel']);
// http://localhost:8000/search?q=laravel
```

---

## Q45. How do you pass parameters to named routes?

**Answer: c) Both a and b**

**Explanation:**
```php
// Method 1: Simple
route('user.show', $id);
route('user.show', 5);

// Method 2: Array
route('user.show', ['id' => $id]);

// Multiple parameters
route('posts.comments', [$postId, $commentId]);
route('posts.comments', ['post' => $postId, 'comment' => $commentId]);

// Both are valid!
```

---

## Q46. What is a route group?

**Answer: a) A way to apply attributes to multiple routes**

**Explanation:**
```php
// Apply middleware to multiple routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', ...);
    Route::get('/profile', ...);
});

// Add prefix
Route::prefix('admin')->group(function () {
    Route::get('/users', ...);    // /admin/users
    Route::get('/posts', ...);    // /admin/posts
});
```

---

## Q47. How do you add a prefix to route groups?

**Answer: c) Both a and b**

**Explanation:**
```php
// Method 1: Fluent (modern)
Route::prefix('admin')->group(function () {
    Route::get('/users', ...);  // /admin/users
});

// Method 2: Array
Route::group(['prefix' => 'admin'], function () {
    Route::get('/users', ...);  // /admin/users
});

// Both work!
```

---

## Q48. How do you add name prefix to route groups?

**Answer: a) `Route::name('admin.')->group(...)`**

**Explanation:**
```php
Route::name('admin.')->group(function () {
    Route::get('/users', ...)->name('users');     // admin.users
    Route::get('/posts', ...)->name('posts');     // admin.posts
});

// Combined with prefix:
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', ...)->name('users');
    // URL: /admin/users
    // Name: admin.users
});
```

---

## Q49. What does `Route::middleware('auth')` do?

**Answer: b) Applies middleware to routes**

**Explanation:**
```php
// Single route
Route::get('/dashboard', ...)->middleware('auth');

// Group
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', ...);
    Route::get('/profile', ...);
});

// Multiple middleware
Route::middleware(['auth', 'verified'])->group(...);
```

**Middleware** = Filters HTTP requests (authentication, logging, etc.)

---

## Q50. How do you redirect from one route to another?

**Answer: d) All of the above**

**Explanation:**
```php
// Method 1: redirect() helper
Route::get('/old', function () {
    return redirect('/new');
});

// Method 2: redirect()->to()
return redirect()->to('/home');

// Method 3: Route::redirect()
Route::redirect('/old', '/new');
Route::redirect('/old', '/new', 301); // Permanent

// All three work!
```

---

## Q51. How do you redirect to a named route?

**Answer: a) `redirect()->route('route.name')`**

**Explanation:**
```php
// Correct
return redirect()->route('home');
return redirect()->route('user.show', $id);

// With flash message
return redirect()
    ->route('users.index')
    ->with('success', 'User created!');
```

**NOT** `route()->redirect()` - that doesn't exist!

---

## Q52. What is the purpose of CSRF protection?

**Answer: b) To prevent Cross-Site Request Forgery**

**Explanation:**
**CSRF (Cross-Site Request Forgery)** = Malicious websites making requests on behalf of authenticated users.

Laravel automatically protects all POST, PUT, PATCH, DELETE routes.

```blade
<form method="POST">
    @csrf  <!-- Required! -->
    <input type="text" name="email">
</form>
```

Without `@csrf` → 419 error!

---

## Q53. How do you add CSRF token in forms?

**Answer: d) All of the above**

**Explanation:**
```blade
<!-- Method 1: @csrf directive (easiest) -->
<form method="POST">
    @csrf
</form>

<!-- Method 2: csrf_token() helper -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<!-- Method 3: Full hidden input -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<!-- All three generate the same output! -->
```

---

## Q54. Which routes require CSRF protection?

**Answer: b) POST, PUT, PATCH, DELETE**

**Explanation:**
- **GET** → No CSRF needed (read-only, no side effects)
- **POST, PUT, PATCH, DELETE** → CSRF required (modify data)

```php
// No CSRF needed
Route::get('/posts', ...);

// CSRF required
Route::post('/posts', ...);
Route::put('/posts/{id}', ...);
Route::patch('/posts/{id}', ...);
Route::delete('/posts/{id}', ...);
```

---

## Q55. How do you spoof HTTP methods in forms?

**Answer: a) `@method('PUT')`**

**Explanation:**
HTML forms only support GET and POST. For PUT/PATCH/DELETE, use method spoofing:

```blade
<!-- Update (PUT) -->
<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('PUT')
    <input type="text" name="title">
    <button>Update</button>
</form>

<!-- Delete -->
<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>
```

---

## Q56. What does `Route::view('/path', 'view.name')` do?

**Answer: b) Returns a view without controller**

**Explanation:**
```php
// Direct view return (no controller needed)
Route::view('/about', 'about');
Route::view('/terms', 'legal.terms');

// With data
Route::view('/welcome', 'welcome', ['name' => 'Laravel']);

// Equivalent to:
Route::get('/about', function () {
    return view('about');
});
```

**Not a redirect!** It returns the view at that URL.

---

## Q57. How do you pass data to a view route?

**Answer: c) Only a is correct**

**Explanation:**
```php
// ✅ Correct: Third parameter
Route::view('/welcome', 'welcome', ['name' => 'Laravel']);

// ❌ Wrong: ->with() doesn't exist for Route::view()
Route::view('/welcome', 'welcome')->with('name', 'Laravel');
```

`Route::view()` doesn't support `->with()` method!

---

## Q58. What is route model binding?

**Answer: a) Automatically inject model instance in route**

**Explanation:**
```php
// Without model binding
Route::get('/posts/{id}', function ($id) {
    $post = Post::findOrFail($id);
    return view('post', compact('post'));
});

// With model binding (automatic!)
Route::get('/posts/{post}', function (Post $post) {
    return view('post', compact('post'));
});
// Laravel automatically finds Post by ID!
```

---

## Q59. How do you view all registered routes?

**Answer: b) `php artisan route:list`**

**Explanation:**
```bash
php artisan route:list

# Filter by name
php artisan route:list --name=user

# Filter by method
php artisan route:list --method=GET

# Show only specific columns
php artisan route:list --columns=uri,name,action
```

---

## Q60. What does `Route::fallback()` do?

**Answer: b) Handles 404 errors**

**Explanation:**
```php
// Custom 404 handler (must be last!)
Route::fallback(function () {
    return view('errors.404');
});

// Or redirect
Route::fallback(function () {
    return redirect('/');
});
```

Catches ALL unmatched routes (404s).

---

## Q61. Where are API routes defined?

**Answer: a) `routes/api.php`**

**Explanation:**
```php
// routes/api.php
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

// Accessible at: /api/users
```

---

## Q62. What prefix is automatically applied to API routes?

**Answer: a) `/api`**

**Explanation:**
Routes in `routes/api.php` automatically get `/api` prefix:

```php
// routes/api.php
Route::get('/users', ...);
// Actual URL: /api/users

Route::get('/posts', ...);
// Actual URL: /api/posts
```

---

## Q63. How do you access the current route name?

**Answer: c) Both a and b**

**Explanation:**
```php
// Method 1
$name = Route::currentRouteName();

// Method 2
$name = request()->route()->getName();

// Both work!
```

**In Blade:**
```blade
@if (Route::currentRouteName() === 'home')
    <p>Welcome home!</p>
@endif
```

---

## Q64. What does `Route::match(['get', 'post'], '/path', ...)` do?

**Answer: b) Route responds to both GET and POST**

**Explanation:**
```php
// Respond to GET or POST
Route::match(['get', 'post'], '/contact', function () {
    return view('contact');
});

// /contact (GET) ✅
// /contact (POST) ✅
```

---

## Q65. What does `Route::any('/path', ...)` do?

**Answer: a) Responds to any HTTP method**

**Explanation:**
```php
// Respond to ALL HTTP methods
Route::any('/webhook', function () {
    // Handles GET, POST, PUT, PATCH, DELETE, etc.
});
```

**Use carefully!** Usually you want specific methods.

---

# Part 3: Controllers & MVC (Questions 66-100)

## Q66. How do you create a controller?

**Answer: a) `php artisan make:controller Name`**

**Explanation:**
```bash
# Basic controller
php artisan make:controller UserController

# Resource controller (7 methods)
php artisan make:controller UserController --resource

# API resource controller (5 methods)
php artisan make:controller UserController --api

# Single action controller
php artisan make:controller ShowDashboard --invokable
```

---

## Q67. How do you create a resource controller?

**Answer: b) `php artisan make:controller Name --resource`**

**Explanation:**
```bash
php artisan make:controller PostController --resource
```

Creates controller with 7 methods:
1. index() - List all
2. create() - Show create form
3. store() - Save new
4. show() - Display one
5. edit() - Show edit form
6. update() - Save changes
7. destroy() - Delete

---

## Q68. How many methods does a resource controller have?

**Answer: c) 7**

**Explanation:**
```php
class PostController extends Controller
{
    public function index() {}      // 1. List
    public function create() {}     // 2. Create form
    public function store() {}      // 3. Save new
    public function show($id) {}    // 4. Show one
    public function edit($id) {}    // 5. Edit form
    public function update($id) {}  // 6. Save changes
    public function destroy($id) {} // 7. Delete
}
```

---

## Q69. Which method displays a list of resources?

**Answer: b) `index()`**

**Explanation:**
```php
public function index()
{
    $posts = Post::all();
    return view('posts.index', compact('posts'));
}
```

Route: `GET /posts` → `index()`

---

## Q70. Which method displays the create form?

**Answer: c) `create()`**

**Explanation:**
```php
public function create()
{
    return view('posts.create');
}
```

Route: `GET /posts/create` → `create()`

---

## Q71. Which method saves a new resource?

**Answer: c) `store()`**

**Explanation:**
```php
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    Post::create($request->all());

    return redirect()->route('posts.index');
}
```

Route: `POST /posts` → `store()`

---

## Q72. Which method displays a single resource?

**Answer: b) `show()`**

**Explanation:**
```php
public function show(Post $post)
{
    return view('posts.show', compact('post'));
}
```

Route: `GET /posts/{id}` → `show()`

---

## Q73. Which method displays the edit form?

**Answer: c) `edit()`**

**Explanation:**
```php
public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}
```

Route: `GET /posts/{id}/edit` → `edit()`

---

## Q74. Which method updates a resource?

**Answer: d) `update()`**

**Explanation:**
```php
public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $post->update($request->all());

    return redirect()->route('posts.show', $post);
}
```

Route: `PUT/PATCH /posts/{id}` → `update()`

---

## Q75. Which method deletes a resource?

**Answer: c) `destroy()`**

**Explanation:**
```php
public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.index')
        ->with('success', 'Post deleted!');
}
```

Route: `DELETE /posts/{id}` → `destroy()`

---

## Q76. How do you register a resource route?

**Answer: a) `Route::resource('products', ProductController::class)`**

**Explanation:**
```php
// One line creates 7 routes!
Route::resource('products', ProductController::class);

// Generated routes:
GET    /products           → index()
GET    /products/create    → create()
POST   /products           → store()
GET    /products/{id}      → show()
GET    /products/{id}/edit → edit()
PUT    /products/{id}      → update()
DELETE /products/{id}      → destroy()
```

---

## Q77. How do you create a single action controller?

**Answer: b) `php artisan make:controller Name --invokable`**

**Explanation:**
```bash
php artisan make:controller ShowDashboard --invokable
```

```php
class ShowDashboard extends Controller
{
    public function __invoke()
    {
        return view('dashboard');
    }
}
```

---

## Q78. What method does a single action controller use?

**Answer: c) `__invoke()`**

**Explanation:**
```php
class ShowDashboard extends Controller
{
    public function __invoke()
    {
        // Called automatically when controller is invoked
        return view('dashboard');
    }
}
```

---

## Q79. How do you route to a single action controller?

**Answer: a) `Route::get('/path', ControllerName::class)`**

**Explanation:**
```php
// Laravel 8+ (modern)
Route::get('/dashboard', ShowDashboard::class);

// Laravel automatically calls __invoke()
```

**NOT** `ControllerName@invoke` (old Laravel 7 syntax, deprecated).

---

## Q80. What does MVC stand for?

**Answer: a) Model View Controller**

**Explanation:**
- **Model:** Data layer
- **View:** Presentation layer
- **Controller:** Logic layer

---

## Q81. What is the role of the Model in MVC?

**Answer: b) Handle business logic and data**

**Explanation:**
```php
class Post extends Model
{
    // Database interaction
    // Business logic
    // Relationships
}
```

---

## Q82. What is the role of the View in MVC?

**Answer: c) Display data to users**

**Explanation:**
```blade
<!-- resources/views/posts/show.blade.php -->
<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
```

Views handle HTML and presentation only.

---

## Q83. What is the role of the Controller in MVC?

**Answer: c) Connect Model and View, handle logic**

**Explanation:**
```php
public function show(Post $post)
{
    // Get data from Model
    $post = Post::find($id);

    // Pass to View
    return view('posts.show', compact('post'));
}
```

Controllers orchestrate between Models and Views.

---

## Q84. How do you pass data to a view from controller?

**Answer: d) All of the above**

**Explanation:**
```php
// Method 1: compact()
return view('users', compact('users'));

// Method 2: Array
return view('users', ['users' => $users]);

// Method 3: with()
return view('users')->with('users', $users);

// All three work!
```

---

## Q85. What does `compact('products')` return?

**Answer: a) `['products' => $products]`**

**Explanation:**
```php
$products = Product::all();

compact('products');
// Returns: ['products' => $products]

// Same as:
['products' => $products]
```

**Important:** Use variable NAME in quotes, not the variable itself!
```php
compact('products')     // ✅ Correct
compact($products)      // ❌ Wrong
```

---

## Q86. How do you validate request data in controller?

**Answer: a) `$request->validate([...])`**

**Explanation:**
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    User::create($validated);
}
```

---

## Q87. What happens if validation fails?

**Answer: b) Redirects back with errors**

**Explanation:**
When validation fails:
1. Redirects back to previous page
2. Flashes errors to session
3. Preserves old input

```blade
@error('email')
    <span class="error">{{ $message }}</span>
@enderror
```

**NOT** a 500 error!

---

## Q88. How do you redirect from controller?

**Answer: d) All of the above**

**Explanation:**
```php
// Method 1: To path
return redirect('/home');

// Method 2: To named route
return redirect()->route('users.index');

// Method 3: Back
return redirect()->back();

// All work!
```

---

## Q89. How do you flash data to session?

**Answer: d) Both b and c**

**Explanation:**
```php
// Method 1: session()->flash()
session()->flash('success', 'Saved!');

// Method 2: redirect()->with()
return redirect()->route('users.index')
    ->with('success', 'User created!');

// Both flash data (available for next request only)
```

**NOT** `session(['key' => 'value'])` - that's permanent!

---

## Q90. How do you access request input in controller?

**Answer: d) All of the above**

**Explanation:**
```php
// Method 1: input()
$email = $request->input('email');

// Method 2: Property access
$email = $request->email;

// Method 3: get()
$email = $request->get('email');

// All three work!
```

---

## Q91. How do you get all request data?

**Answer: a) `$request->all()`**

**Explanation:**
```php
$data = $request->all();
// Returns all input data as array

// Better for security:
$data = $request->only(['name', 'email']);
$data = $request->except(['_token', '_method']);
```

---

## Q92. How do you check if request has a field?

**Answer: a) `$request->has('key')`**

**Explanation:**
```php
// Check if field exists
if ($request->has('email')) {
    // Field exists (even if empty)
}

// Check if field has value
if ($request->filled('email')) {
    // Field exists AND not empty
}
```

---

## Q93. What is dependency injection in controllers?

**Answer: b) Laravel auto-provides dependencies in method parameters**

**Explanation:**
```php
// Laravel automatically injects Request
public function store(Request $request)
{
    // $request is provided automatically!
}

// Type-hint any class
public function show(Post $post, UserService $service)
{
    // Both injected automatically!
}
```

---

## Q94. How do you type-hint Request in controller?

**Answer: a) `public function store(Request $request)`**

**Explanation:**
```php
use Illuminate\Http\Request;

public function store(Request $request)
{
    // Type hint before variable
}
```

---

## Q95. How do you create an API resource controller?

**Answer: c) Both a and b**

**Explanation:**
```bash
# Method 1
php artisan make:controller ProductController --api

# Method 2
php artisan make:controller ProductController --resource --api

# Both create API resource with 5 methods!
```

---

## Q96. How many methods does an API resource controller have?

**Answer: a) 5**

**Explanation:**
API resource controller has 5 methods:
1. index()
2. store()
3. show()
4. update()
5. destroy()

**Missing:** create(), edit() (no forms in APIs)

---

## Q97. Which methods are NOT in API resource controller?

**Answer: b) `create()` and `edit()`**

**Explanation:**
APIs don't need forms, so `create()` and `edit()` are excluded.

**Web Resource (7):**
index, **create**, store, show, **edit**, update, destroy

**API Resource (5):**
index, store, show, update, destroy

---

## Q98. How do you limit resource routes?

**Answer: c) Both a and b**

**Explanation:**
```php
// Only specific routes
Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

// All except specific routes
Route::resource('posts', PostController::class)
    ->except(['destroy']);

// Both work!
```

---

## Q99. How do you return JSON from controller?

**Answer: d) Both b and c**

**Explanation:**
```php
// Method 1: response()->json()
return response()->json(['data' => $data]);

// Method 2: Return array (auto-converts)
return ['data' => $data];

// Both work! Laravel auto-converts arrays to JSON in APIs.
```

---

## Q100. What is middleware in Laravel?

**Answer: b) Filter for HTTP requests**

**Explanation:**
Middleware filters/processes HTTP requests before they reach controllers.

```php
// Authentication middleware
Route::middleware('auth')->group(function () {
    // Only authenticated users can access
});

// Custom middleware
php artisan make:middleware CheckAge

class CheckAge
{
    public function handle($request, $next)
    {
        if ($request->age < 18) {
            return redirect('home');
        }
        return $next($request);
    }
}
```

---

## 🎉 End of Model Answers

**Total Questions:** 100
**Coverage:** Laravel Lessons 1-3
- Part 1: Laravel Basics (30 questions)
- Part 2: Routing (35 questions)
- Part 3: Controllers & MVC (35 questions)

---

**Study Tips:**
1. Review questions you got wrong
2. Practice writing code, not just reading
3. Build a small project using these concepts
4. Refer back to this guide when stuck

**Good luck with your Laravel journey! 🚀**
