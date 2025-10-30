# Lesson 3 - Quick Reference Card

## 🚀 Creating Controllers

```bash
# Simple controller
php artisan make:controller ProductController

# Resource Controller
php artisan make:controller ProductController --resource

# API Resource Controller
php artisan make:controller API/ProductController --api

# With Model
php artisan make:controller ProductController --resource --model=Product

# Single Action Controller
php artisan make:controller ShowProfileController --invokable
```

---

## 📋 Basic Controller Structure

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
```

---

## 🔗 Connecting Controllers with Routes

```php
// Simple route
Route::get('/products', [ProductController::class, 'index']);

// With parameter
Route::get('/products/{id}', [ProductController::class, 'show']);

// Resource Routes (7 routes automatically)
Route::resource('products', ProductController::class);

// API Resource (5 routes)
Route::apiResource('products', ProductController::class);

// Single Action Controller
Route::get('/profile/{id}', ShowProfileController::class);
```

---

## 📦 Resource Controller Methods

```php
class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        return view('products.index');
    }

    // GET /products/create
    public function create()
    {
        return view('products.create');
    }

    // POST /products
    public function store(Request $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index');
    }

    // GET /products/{id}
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // GET /products/{id}/edit
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // PUT/PATCH /products/{id}
    public function update(Request $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.show', $product);
    }

    // DELETE /products/{id}
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
```

---

## 💉 Dependency Injection

```php
// Inject Request
public function store(Request $request)
{
    $name = $request->input('name');
    $price = $request->input('price');
}

// Inject Model (Route Model Binding)
public function show(Product $product)
{
    // $product is ready to use
    return view('products.show', compact('product'));
}

// Inject Service
public function store(Request $request, ProductService $service)
{
    $product = $service->createProduct($request->all());
    return redirect()->route('products.show', $product);
}

// Inject in Constructor
class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->getAllProducts();
        return view('products.index', compact('products'));
    }
}
```

---

## 🔒 Middleware in Controllers

```php
// In Constructor
class ProductController extends Controller
{
    public function __construct()
    {
        // All methods
        $this->middleware('auth');

        // Except index and show
        $this->middleware('auth')->except(['index', 'show']);

        // Only create and store
        $this->middleware('auth')->only(['create', 'store']);
    }
}

// In routes
Route::resource('products', ProductController::class)
    ->middleware('auth');
```

---

## ✂️ Specifying Certain Methods

```php
// Only index and show
Route::resource('products', ProductController::class)
    ->only(['index', 'show']);

// Everything except destroy
Route::resource('products', ProductController::class)
    ->except(['destroy']);
```

---

## 📤 Response Types

```php
// View
return view('products.index', compact('products'));

// Redirect
return redirect()->route('products.index');

// Redirect with message
return redirect()->route('products.index')
                 ->with('success', 'Success!');

// JSON (for APIs)
return response()->json([
    'status' => 'success',
    'data' => $products
]);

// Download
return response()->download($filePath);
```

---

## ✅ Data Validation

```php
// In Controller
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'email' => 'required|email|unique:users',
    ]);

    Product::create($validated);
}

// Using Form Request
public function store(StoreProductRequest $request)
{
    // Validation happens automatically
    Product::create($request->validated());
}
```

Create Form Request:
```bash
php artisan make:request StoreProductRequest
```

---

## 🎯 Single Action Controller

```php
class ShowProfileController extends Controller
{
    public function __invoke($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }
}

// Usage
Route::get('/profile/{id}', ShowProfileController::class);
```

---

## 📋 Useful Commands

```bash
# Display all routes
php artisan route:list

# Routes for specific controller
php artisan route:list --name=products

# Create controller
php artisan make:controller ProductController --resource

# Create Form Request
php artisan make:request StoreProductRequest

# Show Resource Routes structure
php artisan route:list --path=products
```

---

## 💡 Best Practices

✅ **Use Resource Controllers for CRUD**
```php
Route::resource('products', ProductController::class);
```

✅ **Use Route Model Binding**
```php
public function show(Product $product) { }
```

✅ **Use Form Requests**
```php
public function store(StoreProductRequest $request) { }
```

✅ **Don't put complex logic in Controller**
```php
// Use Service Classes
public function store(Request $request, ProductService $service) { }
```

✅ **Use clear names**
```php
class ProductController extends Controller
class UserProfileController extends Controller
```

---

## 🔗 Quick Links

- [Main Lesson](./README-EN.md)
- [Next Lesson](../lesson-04/README-EN.md)
