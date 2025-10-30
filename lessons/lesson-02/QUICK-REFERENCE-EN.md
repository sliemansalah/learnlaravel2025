# Lesson 2 - Quick Reference Card

## 🚀 HTTP Route Methods

```php
// GET - Read data
Route::get('/users', function () { });

// POST - Create new
Route::post('/users', function () { });

// PUT - Full update
Route::put('/users/{id}', function ($id) { });

// PATCH - Partial update
Route::patch('/users/{id}', function ($id) { });

// DELETE - Delete
Route::delete('/users/{id}', function ($id) { });

// Multiple Methods
Route::match(['get', 'post'], '/form', function () { });
Route::any('/test', function () { });
```

---

## 📌 Route Parameters

```php
// Required
Route::get('/user/{id}', function ($id) { });

// Optional
Route::get('/user/{name?}', function ($name = 'Guest') { });

// With constraints
Route::get('/user/{id}', function ($id) { })
    ->where('id', '[0-9]+');

// Multiple constraints
Route::get('/user/{id}/{name}', function ($id, $name) { })
    ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

---

## 🏷️ Named Routes

```php
// Definition
Route::get('/profile', function () { })
    ->name('profile');

// Usage in Blade
<a href="{{ route('profile') }}">Profile</a>
<a href="{{ route('user.show', ['id' => 1]) }}">User</a>

// Redirect
return redirect()->route('dashboard');
return redirect()->route('user.show', ['id' => $id]);
```

---

## 📦 Route Groups

```php
// Prefix
Route::prefix('admin')->group(function () {
    Route::get('/users', function () { });  // /admin/users
});

// Middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { });
});

// Name prefix
Route::name('admin.')->group(function () {
    Route::get('/dashboard', function () { })
        ->name('dashboard');  // admin.dashboard
});

// Combine all properties
Route::prefix('admin')
     ->middleware(['auth'])
     ->name('admin.')
     ->group(function () {
         Route::get('/dashboard', function () { })
             ->name('dashboard');
     });
```

---

## 🔗 Route Model Binding

```php
use App\Models\User;

// Implicit Binding
Route::get('/user/{user}', function (User $user) {
    return $user->name;
});

// With custom key
Route::get('/post/{post:slug}', function (Post $post) {
    return $post;
});

// In Model
public function getRouteKeyName()
{
    return 'slug';
}
```

---

## ↩️ Redirects

```php
// Simple
return redirect('/new-page');

// To named route
return redirect()->route('dashboard');

// Permanent (301)
Route::redirect('/old', '/new', 301);

// Back
return back();

// With data
return redirect()->route('home')
                 ->with('success', 'Success!');
```

---

## 📋 Useful Commands

```bash
# Display all routes
php artisan route:list

# Specific routes
php artisan route:list --path=api

# Search by name
php artisan route:list --name=user

# With middleware
php artisan route:list --middleware=auth

# Detailed
php artisan route:list -v
```

---

## 🎯 CRUD Routes Pattern

```php
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
```

---

## ⚡ Global Constraints

In `RouteServiceProvider.php`:

```php
public function boot(): void
{
    Route::pattern('id', '[0-9]+');
    Route::pattern('slug', '[a-z0-9-]+');
}
```

---

## 💡 Best Practices

✅ **Use named routes**
✅ **Organize routes in groups**
✅ **Use Model Binding**
✅ **Add constraints to parameters**
✅ **Don't put logic in routes**

---

## 🔗 Quick Links

- [Main Lesson](./README-EN.md)
- [Next Lesson](../lesson-03/README-EN.md)
