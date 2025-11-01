# Laravel Lesson 3: Controllers and MVC Pattern
# الدرس الثالث: Controllers ونمط MVC

This is a practice application for Laravel Lesson 3, demonstrating Controllers and the MVC (Model-View-Controller) pattern.

هذا تطبيق تدريبي للدرس الثالث من Laravel، يوضح Controllers ونمط MVC.

## Features / الميزات

### 1. Controllers Created / Controllers المُنشأة

- **HomeController** - Simple controller with multiple methods
  - `index()` - Display home page
  - `about()` - Display about page
  - `contact()` - Display contact page

- **ProductController** - Resource controller (CRUD operations)
  - `index()` - List all products
  - `create()` - Show create form
  - `store()` - Save new product
  - `show($id)` - Show single product
  - `edit($id)` - Show edit form
  - `update($id)` - Update product
  - `destroy($id)` - Delete product

- **DashboardController** - Single action controller
  - `__invoke()` - Display dashboard with statistics

- **UserController** - API Resource controller (lesson example)

## Routes / المسارات

All routes are defined in `routes/web.php`:

### Simple Routes
```php
GET  /              → HomeController@index
GET  /about         → HomeController@about
GET  /contact       → HomeController@contact
```

### Resource Routes (All 7 RESTful routes)
```php
GET     /products           → ProductController@index
GET     /products/create    → ProductController@create
POST    /products           → ProductController@store
GET     /products/{id}      → ProductController@show
GET     /products/{id}/edit → ProductController@edit
PUT     /products/{id}      → ProductController@update
DELETE  /products/{id}      → ProductController@destroy
```

### Single Action Route
```php
GET  /dashboard    → DashboardController
```

## Views / العروض

All views extend the base layout `layouts/app.blade.php`:

- `home.blade.php` - Home page
- `about.blade.php` - About page
- `contact.blade.php` - Contact page
- `dashboard.blade.php` - Dashboard with stats
- `products/index.blade.php` - Products list
- `products/create.blade.php` - Create product form
- `products/show.blade.php` - Product details
- `products/edit.blade.php` - Edit product form

## Running the Application / تشغيل التطبيق

1. Make sure you're in the lesson3 directory:
   ```bash
   cd D:\learnlaravel2025\slieman-learning\lesson3
   ```

2. Start the development server:
   ```bash
   php artisan serve
   ```

3. Visit the application:
   ```
   http://localhost:8000
   ```

## Key Concepts Demonstrated / المفاهيم الأساسية

### 1. Controller Types / أنواع Controllers

- **Simple Controllers**: Basic controllers with custom methods
- **Resource Controllers**: Full CRUD controllers (7 methods)
- **Single Action Controllers**: Controllers with only `__invoke()` method
- **API Controllers**: Resource controllers without `create()` and `edit()`

### 2. MVC Pattern / نمط MVC

- **Model**: Data layer (will be covered in database lessons)
- **View**: Presentation layer (Blade templates)
- **Controller**: Business logic layer (handles requests, processes data)

### 3. Passing Data to Views / تمرير البيانات للعروض

```php
// Method 1: compact()
return view('products.index', compact('products'));

// Method 2: array
return view('products.show', ['product' => $product]);

// Method 3: with()
return view('dashboard')->with('stats', $stats);
```

### 4. Resource Controller Commands / أوامر Resource Controller

```bash
# Create resource controller
php artisan make:controller ProductController --resource

# Create API resource controller (no create/edit)
php artisan make:controller UserController --api

# Create single action controller
php artisan make:controller DashboardController --invokable
```

### 5. Route Registration / تسجيل المسارات

```php
// Simple route
Route::get('/', [HomeController::class, 'index']);

// Resource route (all 7 routes automatically)
Route::resource('products', ProductController::class);

// Single action route
Route::get('/dashboard', DashboardController::class);
```

## File Structure / هيكل الملفات

```
lesson3/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Controller.php
│           ├── HomeController.php
│           ├── ProductController.php
│           ├── DashboardController.php
│           └── UserController.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── products/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── show.blade.php
│       │   └── edit.blade.php
│       ├── home.blade.php
│       ├── about.blade.php
│       ├── contact.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## Practice Exercises / تمارين تطبيقية

1. **Add a new method** to HomeController (e.g., `services()`)
2. **Create a CategoryController** as a resource controller
3. **Add validation** to ProductController's `store()` and `update()` methods
4. **Create an API endpoint** using UserController
5. **Add middleware** to protect admin routes

## Next Steps / الخطوات التالية

- Lesson 4: Blade Templates (Advanced)
- Lesson 5: Databases and Migrations
- Lesson 6: Eloquent ORM
- Lesson 7: Validation and Forms

## Notes / ملاحظات

- **ProductController** uses **session storage** for CRUD operations (Create, Read, Update, Delete work!)
- يستخدم ProductController تخزين الجلسة للعمليات (الإنشاء، القراءة، التحديث، الحذف تعمل!)
- Data persists during your browser session but resets when you restart the server
- البيانات تبقى خلال جلسة المتصفح لكن تُعاد عند إعادة تشغيل الخادم
- In real applications, controllers interact with Models to fetch database data
- في التطبيقات الحقيقية، Controllers تتفاعل مع Models لجلب البيانات من قاعدة البيانات
- Validation is included in ProductController (required fields, data types)
- التحقق من البيانات مضمن في ProductController (الحقول المطلوبة، أنواع البيانات)
- Database operations will be covered in Lesson 5: Databases and Migrations
- عمليات قاعدة البيانات سيتم تغطيتها في الدرس 5

---

**Created for Laravel Learning Practice**
**تم الإنشاء للتدريب على تعلم Laravel**
