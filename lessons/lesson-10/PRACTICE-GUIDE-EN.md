# Lesson 10: Middleware - Practice Guide

## 🎯 Learning Objectives

By completing these exercises, you will:
- Create and register custom middleware
- Use middleware parameters effectively
- Implement authentication and authorization checks
- Handle before and after middleware logic
- Build terminable middleware
- Create middleware groups
- Test middleware functionality

---

## 📋 Prerequisites

- Completed Lesson 9 (Authentication & Authorization)
- Laravel 11 project set up
- Basic understanding of HTTP requests/responses
- Knowledge of PHP classes and namespaces

---

## 🔥 Exercise 1: Age Verification Middleware

**Difficulty:** ⭐ Beginner

### Task
Create middleware that checks if a user is 18 or older before allowing access to certain pages.

### Steps

1. **Generate the middleware:**
```bash
php artisan make:middleware CheckAge
```

2. **Implement the logic in `app/Http/Middleware/CheckAge.php`:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->age && $request->age < 18) {
            return redirect('home')->with('error', 'You must be 18 or older');
        }

        return $next($request);
    }
}
```

3. **Register in `bootstrap/app.php`:**
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'check.age' => \App\Http\Middleware\CheckAge::class,
    ]);
})
```

4. **Create routes in `routes/web.php`:**
```php
Route::get('/adults-only', function () {
    return view('adults-only');
})->middleware('check.age');
```

5. **Test the middleware:**
```bash
# Should redirect
curl "http://localhost:8000/adults-only?age=16"

# Should allow
curl "http://localhost:8000/adults-only?age=21"
```

### ✅ Success Criteria
- Middleware blocks users under 18
- Middleware allows users 18 and over
- Proper error message is displayed

---

## 🔥 Exercise 2: API Key Authentication

**Difficulty:** ⭐⭐ Intermediate

### Task
Create middleware that validates API keys for protected API endpoints.

### Steps

1. **Create middleware:**
```bash
php artisan make:middleware ValidateApiKey
```

2. **Implement in `app/Http/Middleware/ValidateApiKey.php`:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateApiKey
{
    private $validKeys = [
        'test-key-123' => 'Test User',
        'prod-key-456' => 'Production User',
    ];

    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API key is required'
            ], 401);
        }

        if (!isset($this->validKeys[$apiKey])) {
            return response()->json([
                'error' => 'Invalid API key'
            ], 401);
        }

        // Attach user info to request
        $request->attributes->set('api_user', $this->validKeys[$apiKey]);

        return $next($request);
    }
}
```

3. **Register the middleware:**
```php
$middleware->alias([
    'api.key' => \App\Http\Middleware\ValidateApiKey::class,
]);
```

4. **Create API routes:**
```php
// routes/api.php
Route::middleware('api.key')->group(function () {
    Route::get('/users', function (Request $request) {
        return response()->json([
            'message' => 'Welcome ' . $request->attributes->get('api_user'),
            'users' => ['John', 'Jane', 'Bob']
        ]);
    });
});
```

5. **Test with curl:**
```bash
# Without API key (should fail)
curl http://localhost:8000/api/users

# With valid API key (should work)
curl -H "X-API-Key: test-key-123" http://localhost:8000/api/users

# With invalid API key (should fail)
curl -H "X-API-Key: wrong-key" http://localhost:8000/api/users
```

### ✅ Success Criteria
- Requests without API key return 401
- Invalid API keys return 401
- Valid API keys allow access
- User info is attached to request

---

## 🔥 Exercise 3: Request Logger Middleware

**Difficulty:** ⭐⭐ Intermediate

### Task
Create middleware that logs every HTTP request with details before and after processing.

### Steps

1. **Create middleware:**
```bash
php artisan make:middleware LogRequests
```

2. **Implement:**
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
        // Before request
        $startTime = microtime(true);

        Log::info('Request Started', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        $response = $next($request);

        // After request
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        Log::info('Request Completed', [
            'status' => $response->status(),
            'duration_ms' => $duration,
        ]);

        return $response;
    }
}
```

3. **Register as global middleware:**
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->append(\App\Http\Middleware\LogRequests::class);
})
```

4. **Test and check logs:**
```bash
# Make some requests
curl http://localhost:8000/

# Check the logs
tail -f storage/logs/laravel.log
```

### ✅ Success Criteria
- All requests are logged with details
- Response time is calculated and logged
- Logs show both request start and completion

---

## 🔥 Exercise 4: Role-Based Middleware with Parameters

**Difficulty:** ⭐⭐ Intermediate

### Task
Create middleware that checks user roles with parameters to allow multiple roles.

### Steps

1. **Add role to users table:**
```bash
php artisan make:migration add_role_to_users_table
```

```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('user');
    });
}
```

```bash
php artisan migrate
```

2. **Create middleware:**
```bash
php artisan make:middleware CheckRole
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!auth()->check()) {
            return redirect('login')->with('error', 'Please login first');
        }

        $userRole = auth()->user()->role;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized. Required role: ' . implode(' or ', $roles));
        }

        return $next($request);
    }
}
```

3. **Register:**
```php
$middleware->alias([
    'role' => \App\Http\Middleware\CheckRole::class,
]);
```

4. **Create test routes:**
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Admin Dashboard';
    });
});

Route::middleware(['auth', 'role:admin,moderator'])->group(function () {
    Route::get('/moderate', function () {
        return 'Moderation Panel';
    });
});

Route::middleware(['auth', 'role:user,admin,moderator'])->group(function () {
    Route::get('/dashboard', function () {
        return 'User Dashboard';
    });
});
```

5. **Create seeder for test users:**
```php
// database/seeders/UserSeeder.php
User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

User::create([
    'name' => 'Regular User',
    'email' => 'user@example.com',
    'password' => Hash::make('password'),
    'role' => 'user',
]);
```

### ✅ Success Criteria
- Admin can access admin routes
- Users with correct roles can access their routes
- Unauthorized users see 403 error
- Multiple roles work correctly

---

## 🔥 Exercise 5: Rate Limiting Middleware

**Difficulty:** ⭐⭐⭐ Advanced

### Task
Create custom rate limiting middleware that limits requests per IP address.

### Steps

1. **Create middleware:**
```bash
php artisan make:middleware RateLimitRequests
```

2. **Implement:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateLimitRequests
{
    public function handle(Request $request, Closure $next, int $maxAttempts = 60, int $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        $attempts = Cache::get($key, 0);

        if ($attempts >= $maxAttempts) {
            return response()->json([
                'error' => 'Too many requests. Please try again later.',
                'retry_after' => Cache::get($key . ':timer')
            ], 429);
        }

        Cache::put($key, $attempts + 1, now()->addMinutes($decayMinutes));
        Cache::put($key . ':timer', now()->addMinutes($decayMinutes)->timestamp, now()->addMinutes($decayMinutes));

        $response = $next($request);

        // Add rate limit headers
        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', max(0, $maxAttempts - $attempts - 1));

        return $response;
    }

    protected function resolveRequestSignature(Request $request): string
    {
        return 'rate_limit:' . $request->ip() . ':' . $request->path();
    }
}
```

3. **Register:**
```php
$middleware->alias([
    'rate.limit' => \App\Http\Middleware\RateLimitRequests::class,
]);
```

4. **Apply to routes:**
```php
Route::middleware('rate.limit:10,1')->group(function () {
    Route::get('/api/limited', function () {
        return response()->json(['message' => 'Success']);
    });
});
```

5. **Test with a script:**
```bash
# Bash script to test rate limiting
for i in {1..15}; do
    echo "Request $i"
    curl -i http://localhost:8000/api/limited
    echo ""
done
```

### ✅ Success Criteria
- First 10 requests succeed
- 11th request returns 429
- Rate limit headers are present
- Counter resets after 1 minute

---

## 🔥 Exercise 6: Maintenance Mode Middleware

**Difficulty:** ⭐⭐ Intermediate

### Task
Create middleware that enables maintenance mode with IP whitelist.

### Steps

1. **Add to .env:**
```env
MAINTENANCE_MODE=false
MAINTENANCE_ALLOWED_IPS=127.0.0.1,192.168.1.100
```

2. **Create middleware:**
```bash
php artisan make:middleware CheckMaintenanceMode
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('app.maintenance_mode')) {
            return $next($request);
        }

        // Check if IP is whitelisted
        $allowedIps = explode(',', env('MAINTENANCE_ALLOWED_IPS', ''));

        if (in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }

        // Check if user is admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        return response()->view('errors.maintenance', [
            'message' => 'We are currently performing maintenance. Please check back soon.'
        ], 503);
    }
}
```

3. **Add to config/app.php:**
```php
'maintenance_mode' => env('MAINTENANCE_MODE', false),
```

4. **Create maintenance view `resources/views/errors/maintenance.blade.php`:**
```html
<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Mode</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: sans-serif;
            background: #f0f0f0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Maintenance Mode</h1>
        <p>{{ $message }}</p>
    </div>
</body>
</html>
```

5. **Register globally:**
```php
$middleware->append(\App\Http\Middleware\CheckMaintenanceMode::class);
```

### ✅ Success Criteria
- Site shows maintenance page when enabled
- Whitelisted IPs can access
- Admin users can access
- Returns 503 status code

---

## 🔥 Exercise 7: Localization Middleware

**Difficulty:** ⭐⭐ Intermediate

### Task
Create middleware that sets the application locale based on URL or session.

### Steps

1. **Create middleware:**
```bash
php artisan make:middleware SetLocale
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    protected $locales = ['en', 'ar', 'fr', 'es'];

    public function handle(Request $request, Closure $next)
    {
        // Check if locale is in URL
        if ($request->has('lang')) {
            $locale = $request->input('lang');

            if (in_array($locale, $this->locales)) {
                Session::put('locale', $locale);
                App::setLocale($locale);
            }
        }
        // Check session
        elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        // Use default
        else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
```

2. **Register:**
```php
$middleware->appendToGroup('web', \App\Http\Middleware\SetLocale::class);
```

3. **Create language files:**
```php
// resources/lang/en/messages.php
return [
    'welcome' => 'Welcome',
    'goodbye' => 'Goodbye',
];

// resources/lang/ar/messages.php
return [
    'welcome' => 'مرحبا',
    'goodbye' => 'وداعا',
];
```

4. **Test route:**
```php
Route::get('/welcome', function () {
    return response()->json([
        'locale' => app()->getLocale(),
        'message' => __('messages.welcome'),
    ]);
});
```

5. **Test:**
```bash
curl http://localhost:8000/welcome?lang=en
curl http://localhost:8000/welcome?lang=ar
```

### ✅ Success Criteria
- Locale changes based on URL parameter
- Locale persists in session
- Translations work correctly

---

## 🔥 Exercise 8: Terminable Middleware for Analytics

**Difficulty:** ⭐⭐⭐ Advanced

### Task
Create terminable middleware that tracks page views after response is sent.

### Steps

1. **Create analytics table:**
```bash
php artisan make:migration create_page_views_table
```

```php
public function up()
{
    Schema::create('page_views', function (Blueprint $table) {
        $table->id();
        $table->string('url');
        $table->string('method');
        $table->string('ip');
        $table->string('user_agent')->nullable();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->integer('response_time_ms');
        $table->integer('status_code');
        $table->timestamps();

        $table->index(['url', 'created_at']);
    });
}
```

```bash
php artisan migrate
```

2. **Create model:**
```bash
php artisan make:model PageView
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'url', 'method', 'ip', 'user_agent', 'user_id',
        'response_time_ms', 'status_code'
    ];
}
```

3. **Create middleware:**
```bash
php artisan make:middleware TrackPageViews
```

```php
<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;

class TrackPageViews
{
    private $startTime;

    public function handle(Request $request, Closure $next)
    {
        $this->startTime = microtime(true);
        return $next($request);
    }

    public function terminate(Request $request, $response): void
    {
        // Calculate response time
        $duration = round((microtime(true) - $this->startTime) * 1000);

        // Store analytics (happens after response sent)
        PageView::create([
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => auth()->id(),
            'response_time_ms' => $duration,
            'status_code' => $response->status(),
        ]);
    }
}
```

4. **Register:**
```php
$middleware->append(\App\Http\Middleware\TrackPageViews::class);
```

5. **Create dashboard route:**
```php
Route::get('/analytics', function () {
    $views = \App\Models\PageView::latest()
        ->take(10)
        ->get();

    $stats = [
        'total_views' => \App\Models\PageView::count(),
        'avg_response_time' => \App\Models\PageView::avg('response_time_ms'),
        'most_visited' => \App\Models\PageView::select('url', \DB::raw('count(*) as views'))
            ->groupBy('url')
            ->orderBy('views', 'desc')
            ->first(),
    ];

    return response()->json([
        'stats' => $stats,
        'recent_views' => $views,
    ]);
});
```

### ✅ Success Criteria
- Page views are tracked without slowing response
- Analytics are stored after response sent
- Dashboard shows meaningful statistics

---

## 🎓 Challenge: Complete Middleware System

**Difficulty:** ⭐⭐⭐⭐ Expert

### Task
Build a complete API middleware system with:
- API key authentication
- Rate limiting per API key
- Request/response logging
- IP whitelist
- CORS handling

### Requirements

1. **Create multiple middleware:**
   - `ApiKeyAuth` - Validates API keys from database
   - `ApiRateLimit` - Limits requests per API key
   - `ApiLogger` - Logs all API requests
   - `IpWhitelist` - Restricts access by IP
   - `ApiCors` - Handles CORS headers

2. **Database structure:**
```bash
php artisan make:migration create_api_keys_table
```

```php
Schema::create('api_keys', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();
    $table->string('name');
    $table->boolean('is_active')->default(true);
    $table->integer('rate_limit')->default(60);
    $table->json('allowed_ips')->nullable();
    $table->timestamp('last_used_at')->nullable();
    $table->timestamps();
});

Schema::create('api_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('api_key_id')->constrained();
    $table->string('method');
    $table->text('url');
    $table->text('request_body')->nullable();
    $table->text('response_body')->nullable();
    $table->integer('status_code');
    $table->integer('response_time_ms');
    $table->timestamps();

    $table->index('created_at');
});
```

3. **Create middleware group:**
```php
$middleware->group('api.protected', [
    \App\Http\Middleware\ApiCors::class,
    \App\Http\Middleware\IpWhitelist::class,
    \App\Http\Middleware\ApiKeyAuth::class,
    \App\Http\Middleware\ApiRateLimit::class,
    \App\Http\Middleware\ApiLogger::class,
]);
```

4. **Apply to API routes:**
```php
Route::middleware('api.protected')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
});
```

### ✅ Success Criteria
- Complete API authentication system
- Rate limiting works per API key
- All requests are logged
- IP whitelist is enforced
- CORS headers are properly set
- System is production-ready

---

## 📝 Testing Your Middleware

### Feature Test Example

Create `tests/Feature/MiddlewareTest.php`:

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_age_middleware_blocks_minors()
    {
        $response = $this->get('/adults-only?age=16');
        $response->assertRedirect('/home');
    }

    public function test_check_age_middleware_allows_adults()
    {
        $response = $this->get('/adults-only?age=21');
        $response->assertOk();
    }

    public function test_api_key_middleware_requires_key()
    {
        $response = $this->getJson('/api/users');
        $response->assertStatus(401);
    }

    public function test_api_key_middleware_accepts_valid_key()
    {
        $response = $this->withHeaders([
            'X-API-Key' => 'test-key-123',
        ])->getJson('/api/users');

        $response->assertOk();
    }

    public function test_role_middleware_blocks_unauthorized_users()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_role_middleware_allows_authorized_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertOk();
    }
}
```

Run tests:
```bash
php artisan test --filter MiddlewareTest
```

---

## 🏆 Completion Checklist

- [ ] Completed Exercise 1: Age Verification
- [ ] Completed Exercise 2: API Key Authentication
- [ ] Completed Exercise 3: Request Logger
- [ ] Completed Exercise 4: Role-Based Middleware
- [ ] Completed Exercise 5: Rate Limiting
- [ ] Completed Exercise 6: Maintenance Mode
- [ ] Completed Exercise 7: Localization
- [ ] Completed Exercise 8: Terminable Middleware
- [ ] Completed Challenge: Complete API System
- [ ] All tests pass
- [ ] Understood middleware lifecycle
- [ ] Can debug middleware issues

---

## 📚 Additional Resources

- [Laravel Middleware Documentation](https://laravel.com/docs/11.x/middleware)
- [Middleware Testing Guide](https://laravel.com/docs/11.x/http-tests)
- [Best Practices for Middleware](https://laravel-news.com/laravel-middleware-best-practices)

---

**Great job! You've mastered Laravel Middleware! 🎉**
