# Lesson 10: Middleware

## 📖 Table of Contents
1. [Introduction to Middleware](#introduction-to-middleware)
2. [How Middleware Works](#how-middleware-works)
3. [Built-in Middleware](#built-in-middleware)
4. [Creating Custom Middleware](#creating-custom-middleware)
5. [Registering Middleware](#registering-middleware)
6. [Middleware Parameters](#middleware-parameters)
7. [Terminable Middleware](#terminable-middleware)
8. [Middleware Groups](#middleware-groups)
9. [Middleware Priority](#middleware-priority)
10. [Practical Examples](#practical-examples)

---

## Introduction to Middleware

### What is Middleware?

**Middleware** = HTTP request filters that run before or after your application handles a request.

Think of middleware as layers that wrap your application:

```
Request → Middleware 1 → Middleware 2 → Controller → Response
          ↓                ↓                          ↑
       [Check Auth]    [Log Request]          [Add Headers]
```

### Common Use Cases:

- **Authentication**: Check if user is logged in
- **Authorization**: Verify user permissions
- **Logging**: Record request information
- **CORS**: Handle cross-origin requests
- **Rate Limiting**: Prevent abuse
- **Maintenance Mode**: Block requests during maintenance
- **Data Transformation**: Modify request/response data

### Middleware Flow:

```
┌─────────────┐
│   Browser   │
└──────┬──────┘
       │ Request
       ↓
┌─────────────────────┐
│  Middleware Stack   │
│  ├─ VerifyCsrfToken │
│  ├─ Authenticate    │
│  └─ CheckRole       │
└──────┬──────────────┘
       │
       ↓
┌─────────────┐
│  Controller │
└──────┬──────┘
       │ Response
       ↓
┌─────────────┐
│   Browser   │
└─────────────┘
```

---

## How Middleware Works

### Before Middleware

Runs **before** the request reaches the controller:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        // Code runs BEFORE request reaches controller
        if ($request->age < 18) {
            return redirect('home');
        }

        return $next($request);
    }
}
```

### After Middleware

Runs **after** the controller handles the request:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Code runs AFTER controller generates response
        Log::info('Response sent', [
            'status' => $response->status(),
            'content_length' => strlen($response->content()),
        ]);

        return $response;
    }
}
```

### Both Before & After:

```php
public function handle(Request $request, Closure $next)
{
    // BEFORE controller
    Log::info('Request started');

    $response = $next($request);

    // AFTER controller
    Log::info('Request completed');

    return $response;
}
```

---

## Built-in Middleware

Laravel comes with several built-in middleware:

### Common Built-in Middleware:

| Middleware | Purpose |
|------------|---------|
| `auth` | Ensure user is authenticated |
| `auth.basic` | HTTP Basic Authentication |
| `guest` | Ensure user is NOT authenticated |
| `verified` | Ensure user has verified email |
| `throttle` | Rate limiting |
| `signed` | Validate signed URLs |
| `can` | Authorization via Gates/Policies |

### Using Built-in Middleware:

```php
use App\Http\Controllers\ProfileController;

// Single middleware
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth');

// Multiple middleware
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']);

// Middleware group
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

// Middleware with parameters
Route::post('/comment', [CommentController::class, 'store'])
    ->middleware('throttle:5,1'); // 5 requests per minute
```

---

## Creating Custom Middleware

### Generate Middleware:

```bash
php artisan make:middleware CheckRole
```

This creates: `app/Http/Middleware/CheckRole.php`

### Example 1: Simple Check

**app/Http/Middleware/CheckAge.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->age < 18) {
            return redirect('home')->with('error', 'You must be 18 or older');
        }

        return $next($request);
    }
}
```

### Example 2: Authentication Check

**app/Http/Middleware/CheckAdmin.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
```

### Example 3: API Token Check

**app/Http/Middleware/CheckApiToken.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-Token');

        if (!$token || $token !== config('app.api_token')) {
            return response()->json([
                'error' => 'Invalid API token'
            ], 401);
        }

        return $next($request);
    }
}
```

### Example 4: Request Logging

**app/Http/Middleware/LogRequests.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Log before request
        Log::info('Request started', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_id' => auth()->id(),
        ]);

        $response = $next($request);

        // Log after request
        Log::info('Request completed', [
            'status' => $response->status(),
        ]);

        return $response;
    }
}
```

---

## Registering Middleware

### Location: bootstrap/app.php (Laravel 11)

In Laravel 11, middleware is registered in `bootstrap/app.php`:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware alias
        $middleware->alias([
            'check.age' => CheckAge::class,
            'admin' => CheckAdmin::class,
        ]);

        // Global middleware (runs on every request)
        $middleware->append(LogRequests::class);

        // Priority middleware
        $middleware->priority([
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

### Route Middleware:

```php
// Single route
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('admin');

// Multiple routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/users', [AdminController::class, 'users']);
});
```

### Controller Middleware:

```php
class AdminController extends Controller
{
    public function __construct()
    {
        // Apply to all methods
        $this->middleware('admin');

        // Apply to specific methods
        $this->middleware('auth')->only(['create', 'store']);
        $this->middleware('verified')->except(['index', 'show']);
    }
}
```

---

## Middleware Parameters

### Defining Parameters:

**app/Http/Middleware/CheckRole.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if (auth()->user()->role !== $role) {
            abort(403, "Access denied. Required role: {$role}");
        }

        return $next($request);
    }
}
```

### Multiple Parameters:

```php
public function handle(Request $request, Closure $next, string $role, string $permission)
{
    if (auth()->user()->role !== $role || !auth()->user()->hasPermission($permission)) {
        abort(403);
    }

    return $next($request);
}
```

### Using Parameters in Routes:

```php
// Single parameter
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin');

// Multiple parameters
Route::get('/editor', [EditorController::class, 'index'])
    ->middleware('role:editor,edit-posts');

// Multiple middleware with parameters
Route::middleware(['auth', 'role:admin', 'verified'])
    ->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    });
```

### Dynamic Parameters:

```php
// Throttle: 60 requests per minute
Route::middleware('throttle:60,1')->group(function () {
    Route::post('/api/data', [ApiController::class, 'store']);
});

// Throttle: 10 requests per minute for guests, 60 for authenticated
Route::middleware('throttle:10|60,1')->group(function () {
    Route::get('/api/posts', [ApiController::class, 'index']);
});
```

---

## Terminable Middleware

### What is Terminable Middleware?

Middleware that performs work **after** the response has been sent to the browser.

**app/Http/Middleware/TerminableMiddleware.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TerminableMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Runs after response is sent to browser
     */
    public function terminate(Request $request, $response): void
    {
        // Heavy task that doesn't need to delay response
        Log::info('Processing analytics...');

        // Send analytics data
        Analytics::track($request->user(), [
            'page' => $request->path(),
            'duration' => microtime(true) - LARAVEL_START,
        ]);

        // Clean up temp files
        Storage::deleteDirectory('temp/' . session()->getId());
    }
}
```

### Use Cases:

- **Analytics tracking**
- **Sending emails/notifications**
- **Cache warming**
- **Cleanup tasks**
- **Logging complex data**

---

## Middleware Groups

### Default Middleware Groups:

Laravel defines two default groups in `bootstrap/app.php`:

```php
$middleware->group('web', [
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
]);

$middleware->group('api', [
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
]);
```

### Custom Middleware Groups:

```php
// In bootstrap/app.php
$middleware->group('admin', [
    'auth',
    'verified',
    \App\Http\Middleware\CheckAdmin::class,
    \App\Http\Middleware\LogAdminActivity::class,
]);

// Usage
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/users', [UserController::class, 'index']);
});
```

### Prepend/Append to Groups:

```php
// Add to beginning of web group
$middleware->prependToGroup('web', \App\Http\Middleware\CheckMaintenance::class);

// Add to end of api group
$middleware->appendToGroup('api', \App\Http\Middleware\LogApiRequests::class);
```

---

## Middleware Priority

### Setting Priority:

Sometimes order matters. Set priority in `bootstrap/app.php`:

```php
$middleware->priority([
    \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class,
    \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
    \Illuminate\Contracts\Session\Middleware\AuthenticatesSessions::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \Illuminate\Auth\Middleware\Authorize::class,
]);
```

This ensures middleware runs in the correct order regardless of how they're assigned to routes.

---

## Practical Examples

### Example 1: Maintenance Mode Middleware

**app/Http/Middleware/CheckMaintenance.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenance
{
    protected $allowedIps = [
        '127.0.0.1',
        '192.168.1.100', // Office IP
    ];

    public function handle(Request $request, Closure $next)
    {
        if (config('app.maintenance_mode') === true) {
            // Allow specific IPs
            if (in_array($request->ip(), $this->allowedIps)) {
                return $next($request);
            }

            // Allow admin users
            if (auth()->check() && auth()->user()->isAdmin()) {
                return $next($request);
            }

            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
```

### Example 2: Force HTTPS

**app/Http/Middleware/ForceHttps.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
```

### Example 3: Localization Middleware

**app/Http/Middleware/SetLocale.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    protected $languages = ['en', 'ar', 'fr'];

    public function handle(Request $request, Closure $next)
    {
        // Check URL parameter
        if ($request->has('lang') && in_array($request->lang, $this->languages)) {
            Session::put('locale', $request->lang);
        }

        // Set locale from session or default
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);

        return $next($request);
    }
}
```

### Example 4: Sanitize Input

**app/Http/Middleware/SanitizeInput.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeInput
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                // Remove XSS attempts
                $value = strip_tags($value);
                // Trim whitespace
                $value = trim($value);
            }
        });

        $request->merge($input);

        return $next($request);
    }
}
```

### Example 5: Role-Based Access with Multiple Roles

**app/Http/Middleware/CheckRoles.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoles
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'You do not have permission to access this resource');
    }
}
```

**Usage:**
```php
// Allow admin OR moderator
Route::middleware('roles:admin,moderator')->group(function () {
    Route::get('/moderate', [ModerateController::class, 'index']);
});
```

### Example 6: Request Signature Validation

**app/Http/Middleware/ValidateSignature.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ValidateSignature
{
    public function handle(Request $request, Closure $next)
    {
        $signature = $request->header('X-Signature');
        $timestamp = $request->header('X-Timestamp');

        // Check timestamp (prevent replay attacks)
        if (!$timestamp || abs(time() - $timestamp) > 300) {
            return response()->json(['error' => 'Request expired'], 401);
        }

        // Verify signature
        $payload = $request->getContent();
        $expectedSignature = hash_hmac('sha256', $timestamp . $payload, config('app.api_secret'));

        if (!hash_equals($expectedSignature, $signature)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        return $next($request);
    }
}
```

### Example 7: IP Whitelist/Blacklist

**app/Http/Middleware/RestrictIp.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictIp
{
    protected $whitelist = [
        '127.0.0.1',
        '192.168.1.*',
    ];

    protected $blacklist = [
        '10.0.0.1',
    ];

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        // Check blacklist
        if ($this->isBlacklisted($ip)) {
            abort(403, 'Your IP address is blocked');
        }

        // Check whitelist (if not empty)
        if (!empty($this->whitelist) && !$this->isWhitelisted($ip)) {
            abort(403, 'Your IP address is not allowed');
        }

        return $next($request);
    }

    protected function isWhitelisted($ip)
    {
        foreach ($this->whitelist as $allowed) {
            if ($this->matchesPattern($ip, $allowed)) {
                return true;
            }
        }
        return false;
    }

    protected function isBlacklisted($ip)
    {
        foreach ($this->blacklist as $blocked) {
            if ($this->matchesPattern($ip, $blocked)) {
                return true;
            }
        }
        return false;
    }

    protected function matchesPattern($ip, $pattern)
    {
        $pattern = str_replace('*', '.*', $pattern);
        return preg_match('/^' . $pattern . '$/', $ip);
    }
}
```

### Example 8: Cache Response

**app/Http/Middleware/CacheResponse.php:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    public function handle(Request $request, Closure $next, int $minutes = 60)
    {
        // Only cache GET requests
        if ($request->method() !== 'GET') {
            return $next($request);
        }

        $key = 'response_' . md5($request->fullUrl());

        // Return cached response if exists
        if (Cache::has($key)) {
            return response(Cache::get($key));
        }

        $response = $next($request);

        // Cache the response
        Cache::put($key, $response->getContent(), now()->addMinutes($minutes));

        return $response;
    }
}
```

**Usage:**
```php
Route::get('/posts', [PostController::class, 'index'])
    ->middleware('cache:30'); // Cache for 30 minutes
```

---

## Best Practices

### 1. Keep Middleware Focused

```php
// Good - Single responsibility
class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->age < 18) {
            return redirect('home');
        }
        return $next($request);
    }
}

// Bad - Too many responsibilities
class CheckEverything
{
    public function handle(Request $request, Closure $next)
    {
        // Checking age, auth, permissions, IP, etc.
        // Too much in one middleware
    }
}
```

### 2. Use Early Returns

```php
// Good
public function handle(Request $request, Closure $next)
{
    if (!auth()->check()) {
        return redirect('login');
    }

    if (!auth()->user()->isActive()) {
        return redirect('inactive');
    }

    return $next($request);
}
```

### 3. Be Careful with Global Middleware

```php
// Use sparingly - runs on EVERY request
$middleware->append(SomeMiddleware::class);

// Better - use route middleware when possible
Route::middleware('some')->group(function () {
    // Only applies to these routes
});
```

### 4. Handle Exceptions Gracefully

```php
public function handle(Request $request, Closure $next)
{
    try {
        // Middleware logic
        return $next($request);
    } catch (\Exception $e) {
        Log::error('Middleware error: ' . $e->getMessage());
        return response('Service unavailable', 503);
    }
}
```

### 5. Test Your Middleware

```php
// tests/Feature/CheckAgeMiddlewareTest.php
public function test_blocks_users_under_18()
{
    $response = $this->get('/restricted?age=16');
    $response->assertRedirect('home');
}

public function test_allows_users_over_18()
{
    $response = $this->get('/restricted?age=21');
    $response->assertOk();
}
```

### 6. Use Middleware Groups for Common Patterns

```php
// Define once
$middleware->group('api-admin', [
    'auth:sanctum',
    'role:admin',
    'throttle:60,1',
]);

// Use everywhere
Route::middleware('api-admin')->group(function () {
    // Admin API routes
});
```

### 7. Document Your Middleware

```php
/**
 * Check if user has verified their email and phone number.
 *
 * This middleware should be applied to routes that require
 * full account verification (e.g., payment processing).
 *
 * @param Request $request
 * @param Closure $next
 * @return mixed
 */
public function handle(Request $request, Closure $next)
{
    // ...
}
```

---

## Common Mistakes

### 1. Forgetting to Return $next($request)

```php
// Wrong - no return statement
public function handle(Request $request, Closure $next)
{
    if (auth()->check()) {
        $next($request); // Missing return!
    }
}

// Correct
public function handle(Request $request, Closure $next)
{
    if (auth()->check()) {
        return $next($request);
    }
    return redirect('login');
}
```

### 2. Not Registering Middleware

```php
// Created middleware but forgot to register in bootstrap/app.php
// Won't work until registered!

$middleware->alias([
    'custom' => \App\Http\Middleware\CustomMiddleware::class,
]);
```

### 3. Wrong Middleware Order

```php
// Wrong - auth check happens after role check
Route::middleware(['role:admin', 'auth'])->group(function () {
    // Will error if user not authenticated yet
});

// Correct
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Auth first, then role check
});
```

### 4. Modifying Request Incorrectly

```php
// Wrong - doesn't persist
public function handle(Request $request, Closure $next)
{
    $request->user_role = 'admin'; // Lost after middleware
    return $next($request);
}

// Correct
public function handle(Request $request, Closure $next)
{
    $request->merge(['user_role' => 'admin']);
    return $next($request);
}
```

---

## Complete Example: API Authentication System

### Middleware: app/Http/Middleware/ApiAuthenticate.php

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API key required'
            ], 401);
        }

        $key = ApiKey::where('key', $apiKey)
                     ->where('is_active', true)
                     ->first();

        if (!$key) {
            return response()->json([
                'error' => 'Invalid API key'
            ], 401);
        }

        // Check rate limit
        if ($key->hasExceededRateLimit()) {
            return response()->json([
                'error' => 'Rate limit exceeded'
            ], 429);
        }

        // Attach API key to request
        $request->attributes->set('api_key', $key);

        // Log usage
        $key->incrementUsage();

        return $next($request);
    }
}
```

### Register in bootstrap/app.php:

```php
$middleware->alias([
    'api.auth' => \App\Http\Middleware\ApiAuthenticate::class,
]);
```

### Use in Routes:

```php
Route::middleware('api.auth')->group(function () {
    Route::get('/api/users', [ApiController::class, 'users']);
    Route::post('/api/users', [ApiController::class, 'store']);
});
```

---

## Next Steps

After completing this lesson, you're ready for:

**Lesson 11**: File Upload & Storage
- File Upload & Validation
- Storage Configuration
- Image Processing
- Cloud Storage (S3)

---

**Happy Learning!**
