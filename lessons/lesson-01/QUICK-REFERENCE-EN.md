# Lesson 1 - Quick Reference Card

## 🚀 Essential Commands

```bash
# Start development server
php artisan serve

# List all routes
php artisan route:list

# Clear cache
php artisan cache:clear

# Display all artisan commands
php artisan list

# Check Laravel version
php artisan --version
```

---

## 📁 Key Directories

| Path | Purpose |
|------|---------|
| `app/Http/Controllers/` | Controller files |
| `app/Models/` | Eloquent models |
| `routes/web.php` | Web routes |
| `resources/views/` | Blade templates |
| `config/` | Configuration files |
| `database/migrations/` | Database migrations |
| `public/` | Public files and entry point |

---

## 🛣️ Basic Route Syntax

```php
// Simple route
Route::get('/path', function () {
    return 'Hello World';
});

// Return a view
Route::get('/page', function () {
    return view('viewname');
});

// Return JSON
Route::get('/api/data', function () {
    return response()->json(['key' => 'value']);
});
```

---

## 📄 Creating a Blade View

**File**: `resources/views/myview.blade.php`

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My View</title>
</head>
<body>
    <h1>Hello from Blade!</h1>
    <p>Current time: {{ date('H:i:s') }}</p>
</body>
</html>
```

**Route**:
```php
Route::get('/myview', function () {
    return view('myview');
});
```

---

## 🔧 Request Lifecycle (Simplified)

```
Browser Request
    ↓
public/index.php
    ↓
routes/web.php
    ↓
Controller (optional)
    ↓
Model (optional)
    ↓
View
    ↓
Response to Browser
```

---

## ⚙️ Environment File (.env)

```
APP_NAME=MyLaravelApp
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

**Never commit .env to Git!**

---

## 🎯 MVC Pattern

- **Model**: Data and business logic (database)
- **View**: Presentation layer (HTML/Blade)
- **Controller**: Handles requests and coordinates between Model and View

---

## ✅ Lesson 1 Checklist

- [ ] Understand what Laravel is
- [ ] Know the project structure
- [ ] Able to start development server
- [ ] Able to create basic routes
- [ ] Able to create simple Blade views
- [ ] Understand request lifecycle
- [ ] Know basic Artisan commands

---

## 💡 Key Takeaways

1. Laravel uses MVC architecture
2. Routes are defined in `routes/web.php`
3. Views are stored in `resources/views/`
4. Artisan is your command-line helper
5. `.env` file contains environment settings

---

## 🔗 Quick Links

- [Main Lesson](./README-EN.md)
- [Practice Routes](./practice-routes.php)
- [Next Lesson](../lesson-02/README-EN.md)
