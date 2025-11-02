# Setup Instructions - Middleware Practice App

## 📦 Quick Setup

### Step 1: Install Dependencies

```bash
composer install
npm install
```

### Step 2: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 3: Database Setup

```bash
# Create SQLite database file
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed database with test users
php artisan db:seed
```

### Step 4: Start Development Server

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite (optional, for assets)
npm run dev
```

Visit: **http://localhost:8000**

---

## 👥 Test Users

After running `php artisan db:seed`, you'll have these users:

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | admin |
| moderator@example.com | password | moderator |
| user@example.com | password | user |
| john@example.com | password | user |
| jane@example.com | password | user |

---

## 🧪 Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter=MiddlewareTest

# Run with coverage
php artisan test --coverage
```

---

## 🚀 Testing Middleware Examples

### 1. Age Verification Middleware

```bash
# Under 18 - should redirect
curl -L "http://localhost:8000/adults-only?age=16"

# 18 or over - should allow
curl "http://localhost:8000/adults-only?age=25"
```

### 2. API Key Authentication

```bash
# No API key - should fail
curl -i http://localhost:8000/api/users

# Valid API key - should work
curl -i -H "X-API-Key: test-key-123" http://localhost:8000/api/users

# Invalid API key - should fail
curl -i -H "X-API-Key: wrong-key" http://localhost:8000/api/users
```

Valid API keys:
- `test-key-123` (Test User)
- `prod-key-456` (Production User)
- `dev-key-789` (Development User)

### 3. Rate Limiting

```bash
# Test rate limiting (10 requests per minute)
for i in {1..15}; do
    echo "Request $i:"
    curl -i http://localhost:8000/test-rate-limit
    echo "---"
done

# First 10 should succeed (200)
# 11th onwards should fail (429)
```

### 4. Localization

```bash
# English
curl http://localhost:8000/welcome?lang=en

# Arabic
curl http://localhost:8000/welcome?lang=ar

# French
curl http://localhost:8000/welcome?lang=fr

# Spanish
curl http://localhost:8000/welcome?lang=es
```

### 5. Role-Based Access

You'll need to use a browser or tool like Postman for these:

1. **Login** as admin@example.com / password
2. **Access routes:**
   - `/dashboard` ✅ All authenticated users
   - `/admin/dashboard` ✅ Admin only
   - `/moderate` ✅ Admin or Moderator

3. **Login** as user@example.com / password
4. **Try to access:**
   - `/dashboard` ✅ Should work
   - `/admin/dashboard` ❌ Should get 403
   - `/moderate` ❌ Should get 403

### 6. Analytics Tracking

```bash
# Generate some traffic
for i in {1..20}; do
    curl http://localhost:8000/
    curl http://localhost:8000/welcome
done

# View analytics
curl http://localhost:8000/analytics | jq
```

### 7. Maintenance Mode

```bash
# Enable maintenance mode
# Edit .env: MAINTENANCE_MODE=true

# Restart server
php artisan serve

# Try accessing the site
curl http://localhost:8000/

# Should show maintenance page (503)
# But 127.0.0.1 is whitelisted by default

# Disable maintenance mode
# Edit .env: MAINTENANCE_MODE=false
```

---

## 📁 Project Structure

```
practice-app/
├── app/
│   ├── Http/
│   │   └── Middleware/
│   │       ├── CheckAge.php                  # Age verification
│   │       ├── CheckMaintenanceMode.php      # Maintenance mode
│   │       ├── CheckRole.php                 # Role-based access
│   │       ├── LogRequests.php               # Request logging
│   │       ├── RateLimitRequests.php         # Custom rate limiting
│   │       ├── SetLocale.php                 # Localization
│   │       ├── TrackPageViews.php            # Analytics (terminable)
│   │       └── ValidateApiKey.php            # API authentication
│   └── Models/
│       ├── PageView.php                      # Analytics model
│       └── User.php                          # User model
├── bootstrap/
│   └── app.php                               # Middleware registration
├── config/
│   └── app.php                               # App configuration
├── database/
│   ├── factories/
│   │   └── UserFactory.php                   # User factory for testing
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   └── 2024_01_01_000000_create_page_views_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── UserSeeder.php                    # Creates test users
├── resources/
│   ├── lang/
│   │   ├── ar/
│   │   │   └── messages.php                  # Arabic translations
│   │   └── en/
│   │       └── messages.php                  # English translations
│   └── views/
│       ├── errors/
│       │   └── maintenance.blade.php         # Maintenance page
│       └── welcome.blade.php                 # Home page
├── routes/
│   ├── api.php                               # API routes
│   └── web.php                               # Web routes
├── tests/
│   ├── Feature/
│   │   └── MiddlewareTest.php                # Middleware tests
│   └── TestCase.php
├── .env.example                              # Environment template
├── artisan                                   # Artisan CLI
├── composer.json                             # PHP dependencies
├── package.json                              # Node dependencies
├── phpunit.xml                               # PHPUnit configuration
├── README.md                                 # Main documentation
├── SETUP.md                                  # This file
└── vite.config.js                            # Vite configuration
```

---

## 🔍 Debugging

### View Logs

```bash
# Follow log file in real-time
tail -f storage/logs/laravel.log

# View last 50 lines
tail -50 storage/logs/laravel.log

# Clear logs
> storage/logs/laravel.log
```

### View Registered Middleware

```bash
php artisan route:list --columns=method,uri,name,middleware
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database

```bash
# Check database
php artisan db:show

# Refresh database
php artisan migrate:fresh --seed
```

---

## 🐛 Common Issues

### Issue: "Class 'Database\Factories\UserFactory' not found"
**Solution:**
```bash
composer dump-autoload
```

### Issue: "SQLSTATE[HY000]: General error: 1 no such table"
**Solution:**
```bash
php artisan migrate:fresh --seed
```

### Issue: Middleware not working
**Solution:**
- Check that middleware is registered in `bootstrap/app.php`
- Clear cache: `php artisan cache:clear`
- Restart server

### Issue: 419 Page Expired (CSRF Token Mismatch)
**Solution:**
- For API testing, add routes to `routes/api.php` (no CSRF)
- Or exclude routes in `bootstrap/app.php`

### Issue: Rate limit not resetting
**Solution:**
```bash
php artisan cache:clear
```

### Issue: Storage permissions
**Solution:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 📚 Learning Resources

- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Middleware Documentation](https://laravel.com/docs/11.x/middleware)
- [Testing Documentation](https://laravel.com/docs/11.x/testing)

---

## 🎯 Next Steps

1. **Explore the code** - Read through each middleware implementation
2. **Run the tests** - See how middleware behaves in tests
3. **Modify middleware** - Try changing the logic
4. **Create new middleware** - Practice creating your own
5. **Combine middleware** - Stack multiple middleware together

---

**Happy Learning! 🚀**
