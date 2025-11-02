# Lesson 10: Middleware - Full Exam (100 Questions)

## Instructions
- **Total Questions:** 100
- **Time Limit:** 120 minutes
- **Passing Score:** 70/100
- **Question Types:** Multiple Choice, True/False, Code Analysis, Fill in the Blank
- **Difficulty Levels:** ⭐ Easy, ⭐⭐ Medium, ⭐⭐⭐ Hard

---

## Part 1: Multiple Choice Questions (1-40)

### Basic Concepts (⭐)

**1. What is the primary purpose of middleware in Laravel?**
- A) To store data in the database
- B) To filter HTTP requests entering your application
- C) To render views
- D) To define routes

**2. Which method must be implemented in a middleware class?**
- A) `execute()`
- B) `run()`
- C) `handle()`
- D) `process()`

**3. In Laravel 11, where do you register middleware?**
- A) `app/Http/Kernel.php`
- B) `bootstrap/app.php`
- C) `config/middleware.php`
- D) `routes/web.php`

**4. What does the `$next($request)` call do in middleware?**
- A) Stops the request
- B) Redirects to the next page
- C) Passes the request to the next middleware or controller
- D) Returns a response

**5. Which artisan command creates a new middleware?**
- A) `php artisan create:middleware`
- B) `php artisan make:middleware`
- C) `php artisan new:middleware`
- D) `php artisan generate:middleware`

### Middleware Types (⭐⭐)

**6. What is "before" middleware?**
- A) Middleware that runs after the response is sent
- B) Middleware that runs before the request reaches the controller
- C) Middleware that runs before the application starts
- D) Middleware that runs before routing

**7. What is "after" middleware?**
- A) Middleware that runs after the controller but before the response is sent
- B) Middleware that runs after the response is sent to the browser
- C) Middleware that runs after routing
- D) Middleware that runs after database queries

**8. Which method must be implemented for terminable middleware?**
- A) `finish()`
- B) `terminate()`
- C) `complete()`
- D) `destroy()`

**9. When does terminable middleware execute?**
- A) Before the controller
- B) After the controller but before sending the response
- C) After the response has been sent to the browser
- D) Before routing occurs

**10. What is the advantage of terminable middleware?**
- A) It makes the application faster
- B) It can perform tasks without delaying the response to the user
- C) It prevents errors
- D) It caches responses

### Middleware Registration (⭐⭐)

**11. How do you register a global middleware in Laravel 11?**
- A) `$middleware->global()`
- B) `$middleware->append()`
- C) `$middleware->add()`
- D) `$middleware->register()`

**12. How do you create a middleware alias?**
- A) `$middleware->name()`
- B) `$middleware->alias()`
- C) `$middleware->as()`
- D) `$middleware->call()`

**13. Which method adds middleware to a specific group?**
- A) `$middleware->addToGroup()`
- B) `$middleware->appendToGroup()`
- C) `$middleware->pushToGroup()`
- D) `$middleware->includeInGroup()`

**14. How do you apply middleware to a single route?**
- A) `Route::get('/')->with('middleware')`
- B) `Route::get('/')->middleware('auth')`
- C) `Route::get('/')->apply('auth')`
- D) `Route::get('/')->use('auth')`

**15. How do you apply multiple middleware to a route?**
- A) `->middleware('auth', 'verified')`
- B) `->middleware(['auth', 'verified'])`
- C) `->middleware('auth')->middleware('verified')`
- D) All of the above

### Middleware Parameters (⭐⭐)

**16. How do you pass parameters to middleware in a route?**
- A) `->middleware('role', 'admin')`
- B) `->middleware('role:admin')`
- C) `->middleware('role(admin)')`
- D) `->middleware('role[admin]')`

**17. How do you accept parameters in the middleware handle method?**
```php
public function handle(Request $request, Closure $next, ...)
```
- A) `string $param`
- B) `$param`
- C) `string ...$params`
- D) `array $params`

**18. What does `->middleware('role:admin,moderator')` mean?**
- A) User must be both admin AND moderator
- B) The string 'admin,moderator' is passed as one parameter
- C) Two separate parameters: 'admin' and 'moderator'
- D) Invalid syntax

**19. How many parameters can you pass to middleware?**
- A) Only one
- B) Maximum two
- C) Maximum five
- D) Unlimited

**20. How do you access the first parameter in middleware?**
```php
public function handle($request, $next, $param1, $param2)
{
    // Access $param1
}
```
- A) `$this->param1`
- B) `$param1`
- C) `$request->param1`
- D) `func_get_arg(0)`

### Built-in Middleware (⭐)

**21. What does the `auth` middleware do?**
- A) Creates user accounts
- B) Checks if the user is authenticated
- C) Logs user activity
- D) Validates passwords

**22. What does the `guest` middleware do?**
- A) Allows only guests to access
- B) Redirects authenticated users
- C) Creates guest sessions
- D) Logs guest activity

**23. What does the `verified` middleware check?**
- A) If user's password is strong
- B) If user's email is verified
- C) If user's account is active
- D) If user's profile is complete

**24. What does the `throttle` middleware do?**
- A) Speeds up requests
- B) Caches responses
- C) Limits the number of requests
- D) Compresses responses

**25. What is the syntax for throttle middleware?**
- A) `throttle:60,1`
- B) `throttle:1,60`
- C) `throttle(60,1)`
- D) `throttle[60][1]`

### Middleware Groups (⭐⭐)

**26. What is the default middleware group for web routes?**
- A) `api`
- B) `web`
- C) `http`
- D) `default`

**27. What is typically included in the 'web' middleware group?**
- A) API authentication
- B) Session, cookies, CSRF protection
- C) Rate limiting
- D) Database transactions

**28. How do you create a custom middleware group?**
- A) `$middleware->newGroup()`
- B) `$middleware->group()`
- C) `$middleware->createGroup()`
- D) `$middleware->defineGroup()`

**29. How do you apply a middleware group to routes?**
- A) `Route::middleware('web')->group()`
- B) `Route::group(['middleware' => 'web'])`
- C) Both A and B
- D) Neither A nor B

**30. Can you apply multiple middleware groups to one route?**
- A) Yes
- B) No
- C) Only in Laravel 11
- D) Only with route caching

### Advanced Concepts (⭐⭐⭐)

**31. What is middleware priority?**
- A) The order in which middleware executes
- B) The importance level of middleware
- C) The number of requests middleware can handle
- D) The speed of middleware execution

**32. How do you skip middleware for specific routes?**
- A) `->skipMiddleware()`
- B) `->withoutMiddleware()`
- C) `->exceptMiddleware()`
- D) `->ignoreMiddleware()`

**33. Can middleware modify the request before it reaches the controller?**
- A) Yes
- B) No
- C) Only in global middleware
- D) Only in route middleware

**34. Can middleware modify the response after the controller?**
- A) Yes
- B) No
- C) Only in terminable middleware
- D) Only in global middleware

**35. What happens if middleware doesn't call `$next($request)`?**
- A) An error occurs
- B) The request stops and doesn't reach the controller
- C) The middleware is skipped
- D) The application crashes

**36. Can you have multiple handle methods in middleware?**
- A) Yes, unlimited
- B) No, only one
- C) Yes, but maximum two
- D) Only in terminable middleware

**37. How do you redirect from middleware?**
- A) `return redirect('/')`
- B) `redirect('/')`
- C) `$request->redirect('/')`
- D) `$next->redirect('/')`

**38. How do you return JSON from middleware?**
- A) `return json(['error' => 'Unauthorized'])`
- B) `return response()->json(['error' => 'Unauthorized'])`
- C) `return ['error' => 'Unauthorized']`
- D) `echo json_encode(['error' => 'Unauthorized'])`

**39. Can middleware access route parameters?**
- A) Yes, via `$request->route('param')`
- B) No, never
- C) Only in controller middleware
- D) Only in global middleware

**40. What is the purpose of middleware constructor?**
- A) To handle requests
- B) To inject dependencies
- C) To register routes
- D) To define parameters

---

## Part 2: True/False Questions (41-60)

**41.** Middleware can only be applied to routes, not route groups. (⭐)
- True / False

**42.** You can have middleware that runs both before and after the controller in the same class. (⭐⭐)
- True / False

**43.** Global middleware runs on every HTTP request to your application. (⭐)
- True / False

**44.** In Laravel 11, middleware is registered in `app/Http/Kernel.php`. (⭐)
- True / False

**45.** The `handle()` method must always call `$next($request)`. (⭐⭐)
- True / False

**46.** Terminable middleware can delay the response to the user. (⭐⭐)
- True / False

**47.** You can pass unlimited parameters to middleware. (⭐⭐)
- True / False

**48.** Middleware parameters are always strings. (⭐⭐)
- True / False

**49.** The `auth` middleware automatically creates user sessions. (⭐)
- True / False

**50.** You can apply middleware to API routes. (⭐)
- True / False

**51.** Middleware can access the session. (⭐⭐)
- True / False

**52.** Middleware can modify request headers. (⭐⭐)
- True / False

**53.** Middleware can modify response headers. (⭐⭐)
- True / False

**54.** Every middleware must have an alias. (⭐)
- True / False

**55.** Middleware groups can contain other middleware groups. (⭐⭐⭐)
- True / False

**56.** You can exclude specific routes from global middleware. (⭐⭐)
- True / False

**57.** Middleware executes in the order it's registered. (⭐⭐)
- True / False

**58.** You can conditionally apply middleware based on environment. (⭐⭐⭐)
- True / False

**59.** Middleware can interact with the database. (⭐⭐)
- True / False

**60.** The `terminate()` method is required in all middleware. (⭐)
- True / False

---

## Part 3: Code Analysis Questions (61-80)

### Identify the Error (⭐⭐)

**61.** What's wrong with this middleware?
```php
public function handle($request, $next)
{
    if (!auth()->check()) {
        return redirect('login');
    }
}
```

**62.** What's the issue here?
```php
public function handle(Request $request, Closure $next)
{
    $next($request);
    return response()->json(['message' => 'Success']);
}
```

**63.** Identify the problem:
```php
public function handle(Request $request, Closure $next)
{
    $response = $next($request);
    $response->header('X-Custom', 'Value');
    return $response;
}
```

**64.** What's wrong?
```php
Route::get('/admin')->middleware('role', 'admin');
```

**65.** Find the error:
```php
public function terminate(Request $request, Response $response)
{
    return "Cleanup complete";
}
```

### Complete the Code (⭐⭐)

**66.** Complete this middleware registration:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->____([
        'admin' => CheckAdmin::class,
    ]);
})
```

**67.** Fill in the blank to pass parameters:
```php
Route::get('/dashboard')->middleware('role____admin');
```

**68.** Complete the terminable middleware:
```php
public function handle($request, $next)
{
    return $next($request);
}

public function ____($request, $response)
{
    // Cleanup code
}
```

**69.** Complete the age check middleware:
```php
public function handle($request, $next)
{
    if ($request->age < 18) {
        return ___('/home');
    }
    return $next($request);
}
```

**70.** Fill in the global middleware registration:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->____(\App\Http\Middleware\LogRequests::class);
})
```

### What Does This Code Do? (⭐⭐⭐)

**71.** What does this middleware do?
```php
public function handle($request, $next)
{
    if ($request->header('X-API-Key') !== 'secret') {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $next($request);
}
```

**72.** Explain this middleware:
```php
public function handle($request, $next)
{
    App::setLocale($request->input('lang', 'en'));
    return $next($request);
}
```

**73.** What is the purpose of this code?
```php
public function handle($request, $next)
{
    $response = $next($request);
    $response->header('X-Frame-Options', 'DENY');
    return $response;
}
```

**74.** What does this accomplish?
```php
public function handle($request, $next, ...$roles)
{
    if (!in_array(auth()->user()->role, $roles)) {
        abort(403);
    }
    return $next($request);
}
```

**75.** Explain this pattern:
```php
public function handle($request, $next)
{
    $startTime = microtime(true);
    $response = $next($request);
    $duration = microtime(true) - $startTime;
    Log::info("Request took {$duration}s");
    return $response;
}
```

### Predict the Output (⭐⭐⭐)

**76.** What happens when this route is accessed by an unauthenticated user?
```php
Route::get('/dashboard')
    ->middleware('auth')
    ->middleware('verified');
```

**77.** What is the execution order?
```php
Route::middleware(['first', 'second', 'third'])->group(function () {
    Route::get('/', function () {
        return 'Hello';
    })->middleware('fourth');
});
```

**78.** How many times does the handle method execute for this request?
```php
Route::get('/test')
    ->middleware(['auth', 'verified', 'role:admin']);
```

**79.** What happens here?
```php
public function handle($request, $next)
{
    if (config('app.maintenance')) {
        return response('Maintenance Mode', 503);
    }
    return $next($request);
}
```

**80.** What is the result?
```php
Route::get('/users')
    ->middleware('throttle:10,1')
    ->middleware('auth');

// After 11 requests in 1 minute by the same user
```

---

## Part 4: Scenario-Based Questions (81-90)

**81.** You need to log all requests to your application. Which type of middleware should you use? (⭐⭐)
- A) Route middleware
- B) Global middleware
- C) Middleware group
- D) Controller middleware

**82.** You want to track analytics after the user receives their response. What should you implement? (⭐⭐⭐)
- A) Before middleware
- B) After middleware
- C) Terminable middleware
- D) Controller middleware

**83.** You need to check if a user has specific permissions before accessing admin routes. Where should you apply this middleware? (⭐⭐)
- A) Globally
- B) On specific routes or route groups
- C) In the controller
- D) In the model

**84.** You want to set the application locale based on user preferences. When should this middleware run? (⭐⭐)
- A) After authentication
- B) Before any other middleware
- C) After the controller
- D) In terminable middleware

**85.** You need to add a custom header to all API responses. Which approach is best? (⭐⭐)
- A) Before middleware in API group
- B) After middleware in API group
- C) Global before middleware
- D) Controller method

**86.** You want to implement rate limiting for API endpoints only. How do you do this? (⭐⭐)
- A) Global middleware
- B) Apply to API middleware group
- C) In each controller
- D) In the API routes file only

**87.** You need to ensure users verify their email before accessing certain features. Which middleware? (⭐)
- A) `auth`
- B) `guest`
- C) `verified`
- D) `email`

**88.** You want to redirect authenticated users away from login page. Which middleware? (⭐)
- A) `auth`
- B) `guest`
- C) `verified`
- D) `redirect`

**89.** You need to check multiple conditions (authenticated, verified, and admin role) before allowing access. What's the best approach? (⭐⭐⭐)
- A) One middleware that checks all conditions
- B) Three separate middleware chained together
- C) A custom middleware group
- D) Both B and C are good approaches

**90.** You want to measure performance by timing how long each request takes. What pattern should you use? (⭐⭐⭐)
- A) Before middleware only
- B) After middleware only
- C) Both before and after in the same middleware
- D) Terminable middleware only

---

## Part 5: Advanced Application Questions (91-100)

**91.** How would you implement an IP whitelist for maintenance mode? (⭐⭐⭐)
```php
// Choose the best implementation
```
- A) Check IP in controller
- B) Create a middleware that checks IP before returning 503
- C) Use .htaccess
- D) Use firewall rules

**92.** You need to add CORS headers to API responses. Where is the best place? (⭐⭐)
- A) Controller
- B) After middleware
- C) Before middleware
- D) View

**93.** How do you implement request/response logging without affecting performance? (⭐⭐⭐)
- A) Before middleware
- B) After middleware
- C) Terminable middleware
- D) Queue jobs

**94.** You want to cache GET requests in middleware. Which approach? (⭐⭐⭐)
```php
// Select the best pattern
```
- A) Cache before calling $next()
- B) Cache after calling $next()
- C) Cache in terminable middleware
- D) Don't use middleware for caching

**95.** How do you implement API versioning using middleware? (⭐⭐⭐)
- A) Check Accept header and route to different controllers
- B) Use route prefixes only
- C) Modify URLs in middleware
- D) API versioning doesn't use middleware

**96.** You need to sanitize user input for XSS protection. When should this happen? (⭐⭐⭐)
- A) Before the request reaches the controller
- B) After the controller processes the request
- C) In the controller only
- D) In the view only

**97.** How would you implement request signature verification for API security? (⭐⭐⭐)
- A) Global middleware
- B) API group middleware
- C) Route-specific middleware on sensitive endpoints
- D) Both B and C

**98.** You want to add request ID to all log messages. Best approach? (⭐⭐⭐)
- A) Generate ID in global before middleware
- B) Generate ID in controller
- C) Generate ID in terminable middleware
- D) Use session ID

**99.** How do you implement content negotiation (JSON vs XML) in middleware? (⭐⭐⭐)
- A) Check Accept header in before middleware
- B) Transform response in after middleware
- C) Both A and B
- D) Content negotiation doesn't use middleware

**100.** You need to implement a complex authentication system with multiple providers (API key, Bearer token, Session). Best approach? (⭐⭐⭐)
- A) One middleware checking all methods
- B) Separate middleware for each method
- C) Custom guard in Laravel's auth system
- D) Both B and C

---

## Answer Key

### Part 1: Multiple Choice (1-40)
1. B  |  11. B  |  21. B  |  31. A
2. C  |  12. B  |  22. B  |  32. B
3. B  |  13. B  |  23. B  |  33. A
4. C  |  14. B  |  24. C  |  34. A
5. B  |  15. D  |  25. A  |  35. B
6. B  |  16. B  |  26. B  |  36. B
7. A  |  17. C  |  27. B  |  37. A
8. B  |  18. C  |  28. B  |  38. B
9. C  |  19. D  |  29. C  |  39. A
10. B |  20. B  |  30. A  |  40. B

### Part 2: True/False (41-60)
41. False (Middleware can be applied to both routes and groups)
42. True (After middleware pattern)
43. True
44. False (Laravel 11 uses bootstrap/app.php)
45. False (Middleware can return early without calling $next)
46. False (Terminable runs AFTER response is sent, doesn't delay)
47. True
48. True (Parameters from routes are always strings)
49. False (auth middleware checks sessions, doesn't create them)
50. True
51. True
52. True
53. True
54. False (Aliases are optional)
55. False (Groups contain middleware, not other groups)
56. True (Using withoutMiddleware or except)
57. True
58. True
59. True
60. False (Only needed for terminable middleware)

### Part 3: Code Analysis (61-80)

**61.** Missing `return $next($request)` - the request never proceeds if authenticated

**62.** Should return `$next($request)`, not create a new response after it

**63.** Should use `headers` (plural): `$response->headers->set('X-Custom', 'Value')`

**64.** Should use colon syntax: `->middleware('role:admin')`

**65.** Terminate method should not return anything (void)

**66.** `alias`

**67.** `:` (colon)

**68.** `terminate`

**69.** `redirect`

**70.** `append`

**71.** API key authentication middleware - validates X-API-Key header

**72.** Localization middleware - sets application locale from query parameter

**73.** Security middleware - prevents the page from being embedded in iframe (clickjacking protection)

**74.** Role-based access control - checks if user has one of the required roles

**75.** Performance monitoring - measures and logs request duration

**76.** User is redirected to login page by auth middleware, verified middleware never executes

**77.** first → second → third → fourth → controller → fourth ← third ← second ← first

**78.** Three times (one for each middleware)

**79.** Returns 503 Service Unavailable if maintenance mode is enabled, otherwise continues

**80.** Returns 429 Too Many Requests status

### Part 4: Scenarios (81-90)
81. B  |  86. B
82. C  |  87. C
83. B  |  88. B
84. A  |  89. D
85. B  |  90. C

### Part 5: Advanced (91-100)
91. B  |  96. A
92. B  |  97. D
93. C  |  98. A
94. B  |  99. C
95. A  |  100. D

---

## Grading Scale

| Score | Grade | Performance |
|-------|-------|-------------|
| 90-100 | A+ | Excellent - Master Level |
| 80-89 | A | Very Good - Advanced Level |
| 70-79 | B | Good - Competent Level |
| 60-69 | C | Fair - Basic Understanding |
| Below 60 | F | Needs More Study |

---

## Detailed Explanations

### Key Concepts to Review:

1. **Middleware Types:**
   - Before: Executes before controller
   - After: Executes after controller
   - Terminable: Executes after response sent

2. **Registration Methods (Laravel 11):**
   - `$middleware->append()` - Global middleware
   - `$middleware->alias()` - Named middleware
   - `$middleware->appendToGroup()` - Add to existing group
   - `$middleware->group()` - Create custom group

3. **Common Patterns:**
   - Authentication: Check before controller
   - Logging: Use terminable to avoid delays
   - Headers: Modify after controller
   - Validation: Check before controller

4. **Built-in Middleware:**
   - `auth` - Requires authentication
   - `guest` - Allows only guests
   - `verified` - Requires email verification
   - `throttle` - Rate limiting

5. **Best Practices:**
   - Use terminable for non-blocking tasks
   - Apply middleware at appropriate level (global/group/route)
   - Always return proper responses
   - Handle errors gracefully

---

**Good luck with your exam! 🚀**
