# Lesson 2 - Practical Application Guide

## 🚀 How to Run the Project

```bash
cd D:\learnlaravel2025\lessons\lesson-02\practice-app
php artisan serve
```

Server will run on: `http://localhost:8000`

---

## 📋 Available Routes

### 1. Home Page
- **URL**: `http://localhost:8000/`

### 2. Products Routes
- **GET** `/products` - Products list
- **GET** `/products/{id}` - Show specific product (numbers only constraint)
- **GET** `/products/{slug}` - Show product by slug

### 3. Admin Routes Group
- **GET** `/admin/dashboard` - Admin dashboard
- **GET** `/admin/users` - User management
- **GET** `/admin/products` - Product management
- **GET** `/admin/settings` - Settings

### 4. User Routes
- **GET** `/user/{name?}` - User page (optional name)
- **GET** `/profile` - User profile (named route)

### 5. Contact Form
- **GET** `/contact` - Display form
- **POST** `/contact` - Submit form

---

## ✅ Implemented Exercises

### Exercise 1: HTTP Methods Types

```php
Route::get('/products', function () {
    return 'Products list';
});

Route::post('/products', function () {
    return 'Create new product';
});

Route::put('/products/{id}', function ($id) {
    return "Update product $id";
});

Route::delete('/products/{id}', function ($id) {
    return "Delete product $id";
});
```

### Exercise 2: Route Parameters

```php
// Required parameter with constraint
Route::get('/product/{id}', function ($id) {
    return "Show product number: $id";
})->where('id', '[0-9]+')->name('product.show');

// Optional parameter
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello $name";
})->name('user.greeting');

// Multiple parameters
Route::get('/category/{category}/product/{product}', function ($category, $product) {
    return "Category: $category - Product: $product";
});
```

### Exercise 3: Named Routes

```php
Route::get('/dashboard', function () {
    return 'Dashboard';
})->name('dashboard');

Route::get('/profile', function () {
    return 'User Profile';
})->name('profile');

// In Blade:
// <a href="{{ route('dashboard') }}">Dashboard</a>
// <a href="{{ route('product.show', ['id' => 5]) }}">Product 5</a>
```

### Exercise 4: Route Groups

```php
Route::prefix('admin')
     ->name('admin.')
     ->group(function () {
         Route::get('/dashboard', function () {
             return 'Admin Dashboard';
         })->name('dashboard');

         Route::get('/users', function () {
             return 'User Management';
         })->name('users');

         Route::get('/products', function () {
             return 'Product Management';
         })->name('products');

         Route::get('/settings', function () {
             return 'Settings';
         })->name('settings');
     });
```

### Exercise 5: Form with GET & POST

```php
// Display form
Route::get('/contact', function () {
    return view('contact');
})->name('contact.show');

// Process form
Route::post('/contact', function () {
    // Process data here
    return redirect()->route('contact.show')
                     ->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');
```

---

## 🎯 What We Learned

### 1. HTTP Methods Types
- GET for reading
- POST for creating
- PUT/PATCH for updating
- DELETE for deleting

### 2. Route Parameters
- Required parameters `{id}`
- Optional parameters `{name?}`
- Parameter constraints `->where()`

### 3. Named Routes
- Easier route references
- `->name('route.name')`
- `route('route.name')`

### 4. Route Groups
- `prefix()` - URL prefix
- `name()` - Name prefix
- `middleware()` - Shared middleware
- `group()` - Group routes

---

## 📝 Useful Commands

```bash
# Display all routes
php artisan route:list

# Routes with specific prefix
php artisan route:list --path=admin

# Search by name
php artisan route:list --name=product

# Detailed view
php artisan route:list -v
```

---

## 🔍 Testing Routes

Visit each route to verify it works:

1. ✅ `http://localhost:8000/products`
2. ✅ `http://localhost:8000/product/5`
3. ✅ `http://localhost:8000/admin/dashboard`
4. ✅ `http://localhost:8000/user/John`
5. ✅ `http://localhost:8000/user` (without name)
6. ✅ `http://localhost:8000/contact`

---

## 💡 Tips

1. **Use `route:list`** to display all routes
2. **Save changes** before refreshing browser
3. **Use named routes** always
4. **Organize routes** in logical groups
5. **Add constraints** to route parameters

---

## 📚 Next Step

After completing this lesson, you're now ready for:

**Lesson 3**: Controllers and MVC Pattern
- Creating Controllers
- Organizing application logic
- Resource Controllers

---

**Happy Learning! 🚀**
