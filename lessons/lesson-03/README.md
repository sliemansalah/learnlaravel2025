# الدرس 3: المتحكمات ونمط MVC

## 📖 جدول المحتويات
1. [مقدمة في نمط MVC](#مقدمة-في-نمط-mvc)
2. [ما هي المتحكمات؟](#ما-هي-المتحكمات)
3. [إنشاء المتحكمات](#إنشاء-المتحكمات)
4. [أنواع المتحكمات](#أنواع-المتحكمات)
5. [Resource Controllers](#resource-controllers)
6. [حقن التبعيات](#حقن-التبعيات-dependency-injection)
7. [Middleware في المتحكمات](#middleware-في-المتحكمات)
8. [التمارين العملية](#التمارين-العملية)

---

## مقدمة في نمط MVC

### ما هو نمط MVC؟

**MVC** اختصار لـ **Model-View-Controller** (النموذج-العرض-المتحكم)، وهو نمط معماري لتنظيم الكود.

```
        ┌─────────────┐
        │   Browser   │
        └──────┬──────┘
               │
               ▼
        ┌─────────────┐
        │  Controller │ ◄─── يستقبل الطلب ويعالجه
        └──────┬──────┘
               │
      ┌────────┴────────┐
      ▼                 ▼
┌──────────┐      ┌──────────┐
│  Model   │      │   View   │
│ (قاعدة   │      │ (واجهة   │
│ البيانات)│      │المستخدم) │
└──────────┘      └──────────┘
```

### مكونات MVC:

#### 1. **Model (النموذج)** 📊
- يتعامل مع قاعدة البيانات
- يحتوي على منطق الأعمال (Business Logic)
- مثال: `User`, `Post`, `Product`

```php
class Product extends Model
{
    public function getDiscountedPrice()
    {
        return $this->price * 0.9;
    }
}
```

#### 2. **View (العرض)** 🎨
- واجهة المستخدم (HTML)
- عرض البيانات للمستخدم
- ملفات Blade في مجلد `resources/views`

```blade
<h1>{{ $product->name }}</h1>
<p>السعر: {{ $product->price }}</p>
```

#### 3. **Controller (المتحكم)** 🎮
- يربط بين Model و View
- يستقبل الطلبات (Requests)
- يعالج المنطق
- يرجع الاستجابة (Response)

```php
class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }
}
```

### لماذا نستخدم MVC؟

✅ **فصل الاهتمامات** (Separation of Concerns)
- كل جزء له مسؤولية محددة

✅ **سهولة الصيانة**
- تغيير واجهة المستخدم بدون تغيير منطق التطبيق

✅ **إعادة الاستخدام**
- استخدام نفس Model في Controllers مختلفة

✅ **العمل الجماعي**
- مطور يعمل على Views، آخر على Controllers

---

## ما هي المتحكمات؟

### التعريف

المتحكم (Controller) هو **كلاس PHP** يحتوي على methods لمعالجة طلبات HTTP.

### قبل المتحكمات - المسارات المباشرة

```php
// في routes/web.php
Route::get('/products', function () {
    $products = DB::table('products')->get();
    return view('products.index', compact('products'));
});

Route::get('/products/{id}', function ($id) {
    $product = DB::table('products')->find($id);
    return view('products.show', compact('product'));
});

Route::post('/products', function () {
    // 50 سطر من الكود...
    DB::table('products')->insert([...]);
    return redirect('/products');
});
```

**المشاكل:**
- ❌ الكود مكرر
- ❌ صعوبة الصيانة
- ❌ ملف routes كبير جداً
- ❌ صعوبة إعادة الاستخدام

### بعد المتحكمات - حل منظم

```php
// في routes/web.php
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
```

```php
// في app/Http/Controllers/ProductController.php
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('/products');
    }
}
```

**المميزات:**
- ✅ كود منظم ونظيف
- ✅ سهولة الصيانة والتطوير
- ✅ إعادة استخدام Methods
- ✅ سهولة الاختبار

---

## إنشاء المتحكمات

### 1. إنشاء Controller يدوياً

يمكنك إنشاء ملف في `app/Http/Controllers`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return 'قائمة المنتجات';
    }
}
```

### 2. إنشاء Controller باستخدام Artisan (الطريقة الموصى بها)

```bash
php artisan make:controller ProductController
```

هذا الأمر ينشئ ملف:
```
app/Http/Controllers/ProductController.php
```

### 3. إنشاء Resource Controller

```bash
php artisan make:controller ProductController --resource
```

ينشئ Controller مع 7 methods جاهزة:
- `index()` - عرض القائمة
- `create()` - نموذج الإنشاء
- `store()` - حفظ البيانات
- `show($id)` - عرض عنصر واحد
- `edit($id)` - نموذج التعديل
- `update($id)` - تحديث البيانات
- `destroy($id)` - حذف عنصر

### 4. إنشاء Controller مع Model

```bash
php artisan make:controller ProductController --resource --model=Product
```

ينشئ Controller مع استيراد Model تلقائياً.

### 5. إنشاء API Controller

```bash
php artisan make:controller API/ProductController --api
```

مثل Resource لكن بدون `create()` و `edit()` (لأن API لا يحتاجهما).

---

## أنواع المتحكمات

### 1. Single Action Controller

متحكم يحتوي على action واحد فقط.

```bash
php artisan make:controller ShowProfileController --invokable
```

```php
class ShowProfileController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);
        return view('profile', compact('user'));
    }
}
```

**الاستخدام:**
```php
Route::get('/profile/{id}', ShowProfileController::class);
```

**متى نستخدمه؟**
- عندما يكون لديك action واحد معقد
- لفصل المنطق المعقد

### 2. Resource Controller

متحكم لإدارة CRUD كاملة.

```php
class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // GET /products/create
    public function create()
    {
        return view('products.create');
    }

    // POST /products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')
                         ->with('success', 'تم إنشاء المنتج بنجاح');
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')
                         ->with('success', 'تم تحديث المنتج بنجاح');
    }

    // DELETE /products/{id}
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'تم حذف المنتج بنجاح');
    }
}
```

**ربط Resource Controller مع المسارات:**

```php
Route::resource('products', ProductController::class);
```

هذا السطر الواحد ينشئ **7 مسارات** تلقائياً!

```bash
php artisan route:list --name=products
```

| Method    | URI                    | Name             | Action   |
|-----------|------------------------|------------------|----------|
| GET       | /products              | products.index   | index    |
| GET       | /products/create       | products.create  | create   |
| POST      | /products              | products.store   | store    |
| GET       | /products/{id}         | products.show    | show     |
| GET       | /products/{id}/edit    | products.edit    | edit     |
| PUT/PATCH | /products/{id}         | products.update  | update   |
| DELETE    | /products/{id}         | products.destroy | destroy  |

### 3. API Resource Controller

للـ APIs، بدون `create` و `edit`:

```bash
php artisan make:controller API/ProductController --api
```

```php
Route::apiResource('products', ProductController::class);
```

ينشئ **5 مسارات** فقط:
- `index`, `store`, `show`, `update`, `destroy`

### 4. Nested Resource Controllers

للموارد المتداخلة (مثل تعليقات على مقال):

```php
Route::resource('posts.comments', CommentController::class);
```

ينشئ مسارات مثل:
- `/posts/{post}/comments`
- `/posts/{post}/comments/{comment}`

```php
class CommentController extends Controller
{
    public function index(Post $post)
    {
        return view('comments.index', [
            'post' => $post,
            'comments' => $post->comments
        ]);
    }

    public function store(Request $request, Post $post)
    {
        $post->comments()->create($request->all());
        return redirect()->route('posts.comments.index', $post);
    }
}
```

---

## Resource Controllers

### تحديد Methods معينة فقط

إذا كنت لا تحتاج جميع الـ 7 methods:

```php
// فقط index و show
Route::resource('products', ProductController::class)
    ->only(['index', 'show']);

// كل شيء ماعدا destroy
Route::resource('products', ProductController::class)
    ->except(['destroy']);
```

### تسمية Parameters

```php
Route::resource('products', ProductController::class)
    ->parameters([
        'products' => 'product_id'
    ]);

// النتيجة: /products/{product_id}
```

### Resource Routes مع Middleware

```php
Route::resource('products', ProductController::class)
    ->middleware('auth');
```

---

## حقن التبعيات (Dependency Injection)

### ما هو حقن التبعيات؟

**Dependency Injection** هو تقنية لإدخال الكائنات التي يحتاجها الـ Controller تلقائياً.

### 1. حقن Request

```php
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Laravel يحقن Request object تلقائياً
        $name = $request->input('name');
        $price = $request->input('price');

        Product::create([
            'name' => $name,
            'price' => $price
        ]);

        return redirect()->route('products.index');
    }
}
```

### 2. حقن Model (Route Model Binding)

```php
class ProductController extends Controller
{
    public function show(Product $product)
    {
        // Laravel يجلب المنتج من قاعدة البيانات تلقائياً
        return view('products.show', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
```

**كيف يعمل؟**
- Laravel يبحث عن `Product::find($id)` تلقائياً
- إذا لم يجد، يرجع 404 تلقائياً

### 3. حقن Services

```php
use App\Services\PaymentService;

class OrderController extends Controller
{
    public function store(Request $request, PaymentService $payment)
    {
        // Laravel يحقن PaymentService تلقائياً
        $order = Order::create($request->all());
        $payment->process($order);

        return redirect()->route('orders.show', $order);
    }
}
```

### 4. حقن في Constructor

لحقن تبعية تستخدم في جميع methods:

```php
class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $this->productService->createProduct($request->all());
        return redirect()->route('products.index');
    }
}
```

### فوائد حقن التبعيات

✅ **كود نظيف وسهل القراءة**
✅ **سهولة الاختبار** (يمكن استخدام Mock Objects)
✅ **فصل الاهتمامات** (Separation of Concerns)
✅ **إعادة الاستخدام**

---

## Middleware في المتحكمات

### 1. استخدام Middleware في Routes

```php
Route::resource('products', ProductController::class)
    ->middleware('auth');
```

### 2. استخدام Middleware في Constructor

```php
class ProductController extends Controller
{
    public function __construct()
    {
        // كل methods تحتاج تسجيل دخول
        $this->middleware('auth');

        // ماعدا index و show
        $this->middleware('auth')->except(['index', 'show']);

        // فقط create و store و edit
        $this->middleware('auth')->only(['create', 'store', 'edit']);
    }
}
```

### 3. Middleware مخصص لـ methods معينة

```php
class ProductController extends Controller
{
    public function __construct()
    {
        // التحقق من الصلاحيات للحذف والتحديث فقط
        $this->middleware('can:update,product')->only(['edit', 'update']);
        $this->middleware('can:delete,product')->only('destroy');
    }
}
```

---

## أفضل الممارسات

### ✅ افعل:

#### 1. استخدم أسماء واضحة

```php
// ✅ جيد
class ProductController extends Controller
class UserProfileController extends Controller
class AdminDashboardController extends Controller

// ❌ سيء
class MyController extends Controller
class Controller1 extends Controller
```

#### 2. لا تضع منطق معقد في Controller

```php
// ❌ سيء
public function store(Request $request)
{
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->save();

    // إرسال إيميل
    Mail::to($user)->send(new ProductCreated($product));

    // تحديث الإحصائيات
    Statistics::increment('products_count');

    // حفظ في الـ log
    Log::info('Product created: ' . $product->id);

    // 50 سطر آخر...

    return redirect()->route('products.index');
}

// ✅ جيد - استخدم Service Classes
public function store(Request $request, ProductService $service)
{
    $product = $service->createProduct($request->validated());
    return redirect()->route('products.index');
}
```

#### 3. استخدم Form Requests للتحقق

```php
// ❌ سيء
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required',
        // 20 قاعدة أخرى...
    ]);
}

// ✅ جيد
public function store(StoreProductRequest $request)
{
    // التحقق يتم تلقائياً
    Product::create($request->validated());
}
```

إنشاء Form Request:
```bash
php artisan make:request StoreProductRequest
```

```php
class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
        ];
    }
}
```

#### 4. استخدم Route Model Binding

```php
// ❌ سيء
public function show($id)
{
    $product = Product::find($id);
    if (!$product) {
        abort(404);
    }
    return view('products.show', compact('product'));
}

// ✅ جيد
public function show(Product $product)
{
    return view('products.show', compact('product'));
}
```

#### 5. استخدم compact() أو Array

```php
// ✅ جيد
return view('products.index', compact('products', 'categories'));

// ✅ جيد أيضاً
return view('products.index', [
    'products' => $products,
    'categories' => $categories
]);

// ❌ قديم (لكن يعمل)
return view('products.index')->with('products', $products);
```

### ❌ لا تفعل:

#### 1. لا تكرر الكود (DRY Principle)

```php
// ❌ سيء
public function adminIndex()
{
    $products = Product::where('status', 'active')->get();
    return view('admin.products', compact('products'));
}

public function userIndex()
{
    $products = Product::where('status', 'active')->get();
    return view('user.products', compact('products'));
}

// ✅ جيد - استخدم method مشترك
protected function getActiveProducts()
{
    return Product::where('status', 'active')->get();
}

public function adminIndex()
{
    $products = $this->getActiveProducts();
    return view('admin.products', compact('products'));
}

public function userIndex()
{
    $products = $this->getActiveProducts();
    return view('user.products', compact('products'));
}
```

#### 2. لا تضع queries معقدة في Controller

```php
// ❌ سيء
public function index()
{
    $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select('products.*', 'categories.name as category_name')
        ->where('products.status', 'active')
        ->orderBy('products.created_at', 'desc')
        ->paginate(10);

    return view('products.index', compact('products'));
}

// ✅ جيد - استخدم Repository أو Query Scopes
public function index(ProductRepository $repository)
{
    $products = $repository->getActiveWithRelations();
    return view('products.index', compact('products'));
}
```

---

## التمارين العملية

### تمرين 1: إنشاء Controller بسيط ✅

```bash
php artisan make:controller PageController
```

```php
class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
```

**المسارات:**
```php
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
```

### تمرين 2: Resource Controller

```bash
php artisan make:controller ProductController --resource
```

**المسارات:**
```php
Route::resource('products', ProductController::class);
```

**التطبيق في ProductController:**

```php
class ProductController extends Controller
{
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'لابتوب', 'price' => 5000],
            ['id' => 2, 'name' => 'هاتف', 'price' => 3000],
            ['id' => 3, 'name' => 'تابلت', 'price' => 2000],
        ];

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $products = [
            1 => ['id' => 1, 'name' => 'لابتوب', 'price' => 5000],
            2 => ['id' => 2, 'name' => 'هاتف', 'price' => 3000],
            3 => ['id' => 3, 'name' => 'تابلت', 'price' => 2000],
        ];

        $product = $products[$id] ?? abort(404);

        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // في التطبيق الحقيقي، نحفظ في قاعدة البيانات
        return redirect()->route('products.index')
                         ->with('success', 'تم إضافة المنتج بنجاح');
    }
}
```

### تمرين 3: Single Action Controller

```bash
php artisan make:controller ShowDashboardController --invokable
```

```php
class ShowDashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'users' => 150,
            'products' => 80,
            'orders' => 320,
            'revenue' => 45000
        ];

        return view('dashboard', compact('stats'));
    }
}
```

**المسار:**
```php
Route::get('/dashboard', ShowDashboardController::class)
    ->name('dashboard');
```

### تمرين 4: Controller مع Dependency Injection

```bash
php artisan make:controller UserController
```

```php
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // في التطبيق الحقيقي: User::create($validated)

        return redirect()->route('users.index')
                         ->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        // في التطبيق الحقيقي: $user->update($validated)

        return redirect()->route('users.show', $id)
                         ->with('success', 'تم تحديث المستخدم بنجاح');
    }
}
```

### تمرين 5: Middleware في Controller

```php
class AdminController extends Controller
{
    public function __construct()
    {
        // كل methods تحتاج تسجيل دخول
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
```

**المسارات:**
```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])
        ->name('users');
    Route::get('/settings', [AdminController::class, 'settings'])
        ->name('settings');
});
```

### التحدي: نظام CRUD كامل

قم بإنشاء نظام CRUD لإدارة المقالات (Posts) مع:

1. **إنشاء Controller:**
```bash
php artisan make:controller PostController --resource
```

2. **تعريف المسارات:**
```php
Route::resource('posts', PostController::class);
```

3. **تطبيق Methods:**

```php
class PostController extends Controller
{
    // عرض جميع المقالات
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'مقدمة في Laravel', 'author' => 'أحمد'],
            ['id' => 2, 'title' => 'تعلم Controllers', 'author' => 'محمد'],
        ];
        return view('posts.index', compact('posts'));
    }

    // عرض نموذج إنشاء مقال جديد
    public function create()
    {
        return view('posts.create');
    }

    // حفظ المقال الجديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Post::create($validated);

        return redirect()->route('posts.index')
                         ->with('success', 'تم إنشاء المقال بنجاح');
    }

    // عرض مقال واحد
    public function show($id)
    {
        $post = [
            'id' => $id,
            'title' => 'مقدمة في Laravel',
            'content' => 'محتوى المقال...',
            'author' => 'أحمد'
        ];
        return view('posts.show', compact('post'));
    }

    // عرض نموذج التعديل
    public function edit($id)
    {
        $post = [
            'id' => $id,
            'title' => 'مقدمة في Laravel',
            'content' => 'محتوى المقال...'
        ];
        return view('posts.edit', compact('post'));
    }

    // تحديث المقال
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // $post->update($validated);

        return redirect()->route('posts.show', $id)
                         ->with('success', 'تم تحديث المقال بنجاح');
    }

    // حذف المقال
    public function destroy($id)
    {
        // $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'تم حذف المقال بنجاح');
    }
}
```

---

## 🎯 ملخص

في هذا الدرس، تعلمت:

✅ نمط MVC وأهميته
✅ ما هي المتحكمات ولماذا نستخدمها
✅ إنشاء Controllers بطرق مختلفة
✅ أنواع Controllers (Single Action, Resource, API)
✅ Resource Controllers والـ 7 methods
✅ حقن التبعيات (Dependency Injection)
✅ استخدام Middleware في Controllers
✅ أفضل الممارسات

---

## 📚 موارد إضافية

- [Laravel Controllers Documentation](https://laravel.com/docs/controllers)
- [Resource Controllers](https://laravel.com/docs/controllers#resource-controllers)
- [Dependency Injection](https://laravel.com/docs/controllers#dependency-injection-and-controllers)

---

## ✅ اختبر نفسك

قبل الانتقال للدرس التالي، تأكد من إجابتك على:

1. ما الفرق بين Model و View و Controller؟
2. ما فائدة استخدام Controllers بدلاً من وضع الكود في routes؟
3. ما الفرق بين Resource Controller و API Resource Controller؟
4. ما هو حقن التبعيات (Dependency Injection)؟
5. كيف تستخدم Middleware في Constructor؟

---

## الدرس التالي

جاهز للمزيد؟ انتقل إلى **[الدرس 4: Blade Templates وواجهات المستخدم](../lesson-04/README.md)**

في الدرس 4، ستتعلم:
- محرك القوالب Blade
- التوجيهات (Directives)
- المكونات (Components)
- التخطيطات (Layouts)
- والمزيد!

---

**تعلم سعيد! 🚀**
