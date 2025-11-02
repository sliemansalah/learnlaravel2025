# Middleware - Quick Reference

## 🚀 Generate Middleware

```bash
php artisan make:middleware MiddlewareName
```

---

## 📝 Basic Structure

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MiddlewareName
{
    public function handle(Request $request, Closure $next)
    {
        // Before logic

        $response = $next($request);

        // After logic

        return $response;
    }
}
```

---

## 🔧 Register Middleware (Laravel 11)

### In `bootstrap/app.php`:

```php
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        // Alias
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
        ]);

        // Global
        $middleware->append(\App\Http\Middleware\LogRequests::class);

        // Group
        $middleware->group('api.protected', [
            \App\Http\Middleware\ApiAuth::class,
            \App\Http\Middleware\RateLimit::class,
        ]);

        // Priority
        $middleware->priority([
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\CustomMiddleware::class,
        ]);

        // Prepend/Append to existing groups
        $middleware->prependToGroup('web', \App\Http\Middleware\First::class);
        $middleware->appendToGroup('api', \App\Http\Middleware\Last::class);
    })
    ->create();
```

---

## 🛣️ Apply Middleware to Routes

### Single Route
```php
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth');
```

### Multiple Middleware
```php
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin', 'verified']);
```

### Route Groups
```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
});
```

### With Parameters
```php
Route::get('/posts', [PostController::class, 'index'])
    ->middleware('throttle:60,1');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin,moderator');
```

---

## 🎛️ Controller Middleware

```php
class PostController extends Controller
{
    public function __construct()
    {
        // All methods
        $this->middleware('auth');

        // Specific methods
        $this->middleware('admin')->only(['create', 'store', 'destroy']);

        // Except methods
        $this->middleware('verified')->except(['index', 'show']);

        // With parameters
        $this->middleware('role:editor')->only('edit');
    }
}
```

---

## 📦 Middleware with Parameters

### Define
```php
public function handle(Request $request, Closure $next, string $role)
{
    if (auth()->user()->role !== $role) {
        abort(403);
    }

    return $next($request);
}
```

### Multiple Parameters
```php
public function handle(Request $request, Closure $next, string ...$roles)
{
    if (!in_array(auth()->user()->role, $roles)) {
        abort(403);
    }

    return $next($request);
}
```

### Use
```php
Route::get('/admin', function () {
    //
})->middleware('role:admin');

Route::get('/moderate', function () {
    //
})->middleware('role:admin,moderator,editor');
```

---

## ⏱️ Before Middleware

```php
public function handle(Request $request, Closure $next)
{
    // Runs before request reaches controller
    if ($request->age < 18) {
        return redirect('home');
    }

    return $next($request);
}
```

---

## ⏲️ After Middleware

```php
public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // Runs after controller processes request
    Log::info('Response: ' . $response->status());

    return $response;
}
```

---

## 🔚 Terminable Middleware

```php
public function handle(Request $request, Closure $next)
{
    return $next($request);
}

public function terminate(Request $request, $response): void
{
    // Runs after response sent to browser
    Analytics::track($request->path());
}
```

---

## 🔐 Built-in Middleware

| Middleware | Purpose |
|------------|---------|
| `auth` | Require authentication |
| `auth:sanctum` | API authentication |
| `guest` | Only guests (not authenticated) |
| `verified` | Email verification required |
| `throttle:60,1` | Rate limit (60 req/min) |
| `signed` | Signed URL validation |
| `can:update,post` | Authorization check |

---

## 🎯 Common Patterns

### Authentication Check
```php
if (!auth()->check()) {
    return redirect('login');
}
```

### Role Check
```php
if (auth()->user()->role !== 'admin') {
    abort(403);
}
```

### API Key Validation
```php
$apiKey = $request->header('X-API-Key');

if (!$apiKey || !$this->isValid($apiKey)) {
    return response()->json(['error' => 'Unauthorized'], 401);
}
```

### Rate Limiting
```php
$key = 'rate:' . $request->ip();
$attempts = Cache::get($key, 0);

if ($attempts >= 60) {
    return response()->json(['error' => 'Too many requests'], 429);
}

Cache::put($key, $attempts + 1, 60);
```

### Request Logging
```php
Log::info('Request', [
    'method' => $request->method(),
    'url' => $request->fullUrl(),
    'ip' => $request->ip(),
]);
```

### Modify Request
```php
$request->merge(['timestamp' => time()]);
```

### Add Response Headers
```php
$response->headers->set('X-Custom-Header', 'value');
```

---

## 🧪 Testing Middleware

```php
public function test_middleware_blocks_guests()
{
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
}

public function test_middleware_allows_authenticated_users()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertOk();
}

public function test_middleware_checks_role()
{
    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->get('/admin');
    $response->assertStatus(403);
}

public function test_api_middleware_validates_key()
{
    $response = $this->withHeaders([
        'X-API-Key' => 'valid-key',
    ])->getJson('/api/users');

    $response->assertOk();
}
```

---

## ⚠️ Common Mistakes

### Forgot return
```php
// ❌ Wrong
public function handle(Request $request, Closure $next)
{
    $next($request); // Missing return!
}

// ✅ Correct
public function handle(Request $request, Closure $next)
{
    return $next($request);
}
```

### Wrong order
```php
// ❌ Wrong - checks role before auth
Route::middleware(['role:admin', 'auth'])->group(...);

// ✅ Correct
Route::middleware(['auth', 'role:admin'])->group(...);
```

### Not registered
```php
// ❌ Middleware exists but not registered
Route::get('/')->middleware('custom'); // Won't work!

// ✅ Register first in bootstrap/app.php
$middleware->alias(['custom' => CustomMiddleware::class]);
```

---

## 📊 Middleware Flow

```
Request
  ↓
Global Middleware
  ↓
Route Middleware (in order)
  ↓
Controller
  ↓
Response (through middleware stack)
  ↓
Browser
  ↓
Terminable Middleware
```

---

## 🎨 Useful Snippets

### IP Whitelist
```php
$allowed = ['127.0.0.1', '192.168.1.*'];
if (!$this->ipMatches($request->ip(), $allowed)) {
    abort(403);
}
```

### Maintenance Mode
```php
if (config('app.maintenance') && !$request->ip() === '127.0.0.1') {
    return response()->view('maintenance', [], 503);
}
```

### Force HTTPS
```php
if (!$request->secure() && app()->environment('production')) {
    return redirect()->secure($request->getRequestUri());
}
```

### Set Locale
```php
if ($request->has('lang')) {
    App::setLocale($request->lang);
    Session::put('locale', $request->lang);
}
```

### Sanitize Input
```php
$input = $request->all();
array_walk_recursive($input, function (&$value) {
    $value = strip_tags(trim($value));
});
$request->merge($input);
```

---

## 🔗 Quick Links

- [Middleware Docs](https://laravel.com/docs/11.x/middleware)
- [Testing Docs](https://laravel.com/docs/11.x/http-tests)
- [Request Docs](https://laravel.com/docs/11.x/requests)
- [Response Docs](https://laravel.com/docs/11.x/responses)

---

**Print this for quick reference! 📄**
