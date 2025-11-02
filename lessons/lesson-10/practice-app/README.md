# Middleware Practice Application

This is a Laravel 11 application demonstrating various middleware implementations from Lesson 10.

## 📦 Setup Instructions

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup

```bash
# Configure your database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=middleware_practice
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed
```

### 4. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🎯 Included Middleware Examples

### 1. CheckAge Middleware
**File:** `app/Http/Middleware/CheckAge.php`
**Purpose:** Verifies user is 18 or older
**Route:** `/adults-only?age=21`

```bash
# Test
curl "http://localhost:8000/adults-only?age=16"  # Should redirect
curl "http://localhost:8000/adults-only?age=21"  # Should allow
```

### 2. ValidateApiKey Middleware
**File:** `app/Http/Middleware/ValidateApiKey.php`
**Purpose:** Validates API key authentication
**Route:** `/api/users`

```bash
# Test
curl http://localhost:8000/api/users  # Should fail (401)
curl -H "X-API-Key: test-key-123" http://localhost:8000/api/users  # Should work
```

### 3. LogRequests Middleware
**File:** `app/Http/Middleware/LogRequests.php`
**Purpose:** Logs all HTTP requests with timing
**Applied:** Globally

Check logs after making requests:
```bash
tail -f storage/logs/laravel.log
```

### 4. CheckRole Middleware
**File:** `app/Http/Middleware/CheckRole.php`
**Purpose:** Role-based access control
**Routes:**
- `/admin/dashboard` - Admin only
- `/moderate` - Admin or Moderator
- `/dashboard` - All authenticated users

```bash
# Login first, then access:
# http://localhost:8000/admin/dashboard
```

### 5. RateLimitRequests Middleware
**File:** `app/Http/Middleware/RateLimitRequests.php`
**Purpose:** Custom rate limiting
**Route:** `/api/limited` (10 requests per minute)

```bash
# Test rate limiting
for i in {1..15}; do
    echo "Request $i"
    curl -i http://localhost:8000/api/limited
done
```

### 6. CheckMaintenanceMode Middleware
**File:** `app/Http/Middleware/CheckMaintenanceMode.php`
**Purpose:** Enables maintenance mode with IP whitelist
**Applied:** Globally

Enable in `.env`:
```env
MAINTENANCE_MODE=true
MAINTENANCE_ALLOWED_IPS=127.0.0.1
```

### 7. SetLocale Middleware
**File:** `app/Http/Middleware/SetLocale.php`
**Purpose:** Sets application locale
**Route:** `/welcome?lang=ar`

```bash
curl http://localhost:8000/welcome?lang=en
curl http://localhost:8000/welcome?lang=ar
```

### 8. TrackPageViews Middleware (Terminable)
**File:** `app/Http/Middleware/TrackPageViews.php`
**Purpose:** Tracks page views after response sent
**Dashboard:** `/analytics`

```bash
# Make some requests, then view analytics
curl http://localhost:8000/analytics
```

---

## 🗂️ File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── ApiController.php
│   │   └── DashboardController.php
│   └── Middleware/
│       ├── CheckAge.php
│       ├── CheckRole.php
│       ├── CheckMaintenanceMode.php
│       ├── LogRequests.php
│       ├── RateLimitRequests.php
│       ├── SetLocale.php
│       ├── TrackPageViews.php
│       └── ValidateApiKey.php
├── Models/
│   ├── PageView.php
│   └── User.php
bootstrap/
├── app.php                    # Middleware registration
database/
├── migrations/
│   ├── 2024_01_01_create_page_views_table.php
│   └── 2024_01_02_add_role_to_users_table.php
├── seeders/
│   └── UserSeeder.php
routes/
├── api.php                    # API routes with middleware
└── web.php                    # Web routes with middleware
resources/
├── lang/
│   ├── en/
│   │   └── messages.php
│   └── ar/
│       └── messages.php
└── views/
    ├── errors/
    │   └── maintenance.blade.php
    ├── welcome.blade.php
    └── dashboard.blade.php
```

---

## 🧪 Testing

### Run all tests:
```bash
php artisan test
```

### Run specific test:
```bash
php artisan test --filter=MiddlewareTest
```

### Test cases included:
- `tests/Feature/CheckAgeMiddlewareTest.php`
- `tests/Feature/ApiKeyMiddlewareTest.php`
- `tests/Feature/RoleMiddlewareTest.php`
- `tests/Feature/RateLimitMiddlewareTest.php`

---

## 📝 Sample Users

After running `php artisan db:seed`, you'll have:

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | admin |
| moderator@example.com | password | moderator |
| user@example.com | password | user |

---

## 🔍 Testing Scenarios

### Scenario 1: Age Verification
```bash
# Under 18 - should redirect
curl -L "http://localhost:8000/adults-only?age=16"

# 18 or over - should allow
curl "http://localhost:8000/adults-only?age=25"
```

### Scenario 2: API Authentication
```bash
# No API key
curl -i http://localhost:8000/api/users

# Invalid API key
curl -i -H "X-API-Key: invalid" http://localhost:8000/api/users

# Valid API key
curl -i -H "X-API-Key: test-key-123" http://localhost:8000/api/users
```

### Scenario 3: Rate Limiting
```bash
# Bash script to test rate limits
#!/bin/bash
for i in {1..15}; do
    echo "Request $i:"
    curl -w "\nStatus: %{http_code}\n" http://localhost:8000/api/limited
    echo "---"
done
```

### Scenario 4: Role-Based Access
```bash
# Login as admin (use browser or Postman)
# Then access:
# - /admin/dashboard ✅ Should work
# - /moderate ✅ Should work
# - /dashboard ✅ Should work

# Login as user
# Then access:
# - /admin/dashboard ❌ Should fail (403)
# - /moderate ❌ Should fail (403)
# - /dashboard ✅ Should work
```

### Scenario 5: Localization
```bash
# English
curl http://localhost:8000/welcome?lang=en

# Arabic
curl http://localhost:8000/welcome?lang=ar

# French
curl http://localhost:8000/welcome?lang=fr

# Session persists language
curl -c cookies.txt http://localhost:8000/welcome?lang=ar
curl -b cookies.txt http://localhost:8000/welcome
```

### Scenario 6: Analytics Tracking
```bash
# Generate some traffic
for i in {1..10}; do
    curl http://localhost:8000/
    curl http://localhost:8000/dashboard
    curl http://localhost:8000/about
done

# View analytics
curl http://localhost:8000/analytics
```

---

## 🎨 Customization

### Add Your Own Middleware

1. **Create middleware:**
```bash
php artisan make:middleware YourMiddleware
```

2. **Implement logic in `app/Http/Middleware/YourMiddleware.php`**

3. **Register in `bootstrap/app.php`:**
```php
$middleware->alias([
    'your' => \App\Http\Middleware\YourMiddleware::class,
]);
```

4. **Apply to routes:**
```php
Route::get('/your-route', function () {
    //
})->middleware('your');
```

---

## 🐛 Debugging

### View all registered middleware:
```bash
php artisan route:list --columns=method,uri,name,middleware
```

### Check middleware order:
```bash
php artisan route:list -v
```

### Clear cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

---

## 📚 Learning Path

1. **Start with simple middleware** - CheckAge, ValidateApiKey
2. **Move to authentication** - CheckRole
3. **Explore advanced concepts** - RateLimitRequests, TrackPageViews
4. **Build custom solutions** - Combine multiple middleware

---

## ⚠️ Common Issues

### Issue: Middleware not working
**Solution:** Make sure it's registered in `bootstrap/app.php`

### Issue: 419 CSRF error
**Solution:** Add to `$except` in `VerifyCsrfToken` middleware for testing

### Issue: Rate limit not resetting
**Solution:** Clear cache with `php artisan cache:clear`

### Issue: Logs not showing
**Solution:** Check `storage/logs` permissions:
```bash
chmod -R 775 storage
```

---

## 🎯 Challenge Exercises

1. **Create IP Blacklist Middleware**
   - Block specific IP addresses
   - Return 403 for blocked IPs
   - Allow whitelist to bypass

2. **Build Request Signature Middleware**
   - Validate HMAC signatures
   - Prevent replay attacks
   - Add timestamp validation

3. **Implement Cache Middleware**
   - Cache GET requests
   - Set TTL based on route
   - Implement cache invalidation

4. **Create Activity Logger**
   - Log user activities
   - Track changes to models
   - Generate activity reports

---

## 📖 Resources

- [Laravel Middleware Docs](https://laravel.com/docs/11.x/middleware)
- [HTTP Middleware Guide](https://laravel.com/docs/11.x/http-tests)
- [Request Lifecycle](https://laravel.com/docs/11.x/lifecycle)

---

## 🤝 Contributing

Feel free to add more middleware examples or improve existing ones!

---

**Happy Learning! 🚀**
