# الدرس الثالث - التمارين: Controllers في Laravel

## 📋 نظرة عامة

هذه التمارين مصممة لتطبيق ما تعلمته عن Controllers في Laravel. تبدأ من المستوى السهل وتتدرج إلى المتقدم.

**الوقت المقدر**: 120-150 دقيقة

---

## 🎯 التمرين 1: إنشاء Controller بسيط (سهل)

### المطلوب:

1. أنشئ Controller باسم `PageController`
2. أضف methods التالية:
   - `home()` - تعرض صفحة رئيسية
   - `about()` - تعرض صفحة من نحن
   - `contact()` - تعرض صفحة اتصل بنا
   - `services()` - تعرض قائمة الخدمات
3. أنشئ routes لجميع methods

### الحل المتوقع:

```bash
php artisan make:controller PageController
```

```php
<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        $company = [
            'name' => 'شركتنا',
            'founded' => 2020,
            'description' => 'نحن شركة رائدة في المجال'
        ];

        return view('pages.about', compact('company'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function services()
    {
        $services = [
            'تطوير المواقع',
            'تطوير التطبيقات',
            'التسويق الإلكتروني',
            'استشارات تقنية'
        ];

        return view('pages.services', compact('services'));
    }
}
```

```php
// routes/web.php
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/services', [PageController::class, 'services'])->name('services');
```

### اختبر نفسك:
- [ ] هل جميع الصفحات تعمل؟
- [ ] هل البيانات تُمرر بشكل صحيح؟
- [ ] استخدم `php artisan route:list` للتحقق

---

## 🎯 التمرين 2: Resource Controller (متوسط)

### المطلوب:

أنشئ Resource Controller لإدارة المنتجات:

1. أنشئ `ProductController` كـ Resource Controller
2. املأ جميع الـ 7 methods بمنطق بسيط
3. استخدم array للبيانات (لا تحتاج قاعدة بيانات بعد)
4. أنشئ Route Resource

### الحل المتوقع:

```bash
php artisan make:controller ProductController --resource
```

```php
<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // بيانات وهمية
    private $products = [
        1 => ['id' => 1, 'name' => 'لابتوب', 'price' => 3000],
        2 => ['id' => 2, 'name' => 'هاتف', 'price' => 1500],
        3 => ['id' => 3, 'name' => 'تابلت', 'price' => 2000],
    ];

    public function index()
    {
        $products = $this->products;
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // في الواقع، سيتم الحفظ في قاعدة البيانات
        return redirect()
            ->route('products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function show($id)
    {
        if (!isset($this->products[$id])) {
            abort(404, 'المنتج غير موجود');
        }

        $product = $this->products[$id];
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        if (!isset($this->products[$id])) {
            abort(404);
        }

        $product = $this->products[$id];
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        return redirect()
            ->route('products.show', $id)
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy($id)
    {
        return redirect()
            ->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }
}
```

```php
// routes/web.php
Route::resource('products', ProductController::class);
```

### اختبر نفسك:
- [ ] استخدم `php artisan route:list` وتحقق من الـ 7 routes
- [ ] اختبر كل route في المتصفح
- [ ] تأكد من validation يعمل

---

## 🎯 التمرين 3: Route Model Binding (متوسط)

### المطلوب:

حوّل ProductController لاستخدام Route Model Binding:

1. أنشئ Model للمنتج
2. أنشئ Migration
3. عدّل Controller لاستخدام Route Model Binding
4. اختبر جميع العمليات

### الحل المتوقع:

```bash
php artisan make:model Product -m
```

```php
// database/migrations/xxxx_create_products_table.php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->text('description')->nullable();
        $table->integer('stock')->default(0);
        $table->timestamps();
    });
}
```

```bash
php artisan migrate
```

```php
<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'stock'];
}
```

```php
<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    // Route Model Binding!
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }
}
```

### اختبر نفسك:
- [ ] أنشئ عدة منتجات في قاعدة البيانات
- [ ] اختبر عرض، تعديل، حذف منتج
- [ ] اختبر ماذا يحدث مع id غير موجود (404)

---

## 🎯 التمرين 4: API Controller (متقدم)

### المطلوب:

أنشئ API Controller لنفس المنتجات:

1. أنشئ `API/ProductController` كـ API Controller
2. جميع responses يجب أن تكون JSON
3. استخدم status codes مناسبة
4. أضف error handling

### الحل المتوقع:

```bash
php artisan make:controller API/ProductController --api
```

```php
<?php
// app/Http/Controllers/API/ProductController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable',
                'stock' => 'required|integer|min:0',
            ]);

            $product = Product::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|max:255',
                'price' => 'sometimes|numeric|min:0',
                'description' => 'nullable',
                'stock' => 'sometimes|integer|min:0',
            ]);

            $product->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
```

```php
// routes/api.php
use App\Http\Controllers\API\ProductController;

Route::apiResource('products', ProductController::class);
```

### اختبر API:

```bash
# GET all products
curl http://localhost:8000/api/products

# POST create product
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"لابتوب","price":3000,"stock":10}'

# GET single product
curl http://localhost:8000/api/products/1

# PUT update product
curl -X PUT http://localhost:8000/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"لابتوب محدّث","price":2800}'

# DELETE product
curl -X DELETE http://localhost:8000/api/products/1
```

### اختبر نفسك:
- [ ] جميع endpoints تعمل؟
- [ ] responses بصيغة JSON؟
- [ ] status codes صحيحة؟
- [ ] error handling يعمل؟

---

## 🎯 التمرين 5: Dependency Injection و Services (متقدم)

### المطلوب:

أعد هيكلة ProductController لاستخدام Service Class:

1. أنشئ `ProductService` class
2. انقل المنطق من Controller إلى Service
3. احقن Service في Controller
4. استخدم Repository Pattern

### الحل المتوقع:

```php
<?php
// app/Services/ProductService.php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAllProducts()
    {
        return Product::latest()->paginate(15);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data)
    {
        $product->update($data);
        return $product->fresh();
    }

    public function deleteProduct(Product $product)
    {
        return $product->delete();
    }

    public function searchProducts($query)
    {
        return Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }

    public function getLowStockProducts($threshold = 5)
    {
        return Product::where('stock', '<', $threshold)->get();
    }
}
```

```php
<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'stock' => 'required|integer|min:0',
        ]);

        $product = $this->productService->createProduct($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'stock' => 'required|integer|min:0',
        ]);

        $product = $this->productService->updateProduct($product, $validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()
            ->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $products = $this->productService->searchProducts($query);

        return view('products.search', compact('products', 'query'));
    }

    public function lowStock()
    {
        $products = $this->productService->getLowStockProducts();
        return view('products.low-stock', compact('products'));
    }
}
```

### اختبر نفسك:
- [ ] هل Service محقون بشكل صحيح؟
- [ ] هل Controller أصبح أنظف (thin)?
- [ ] هل يمكن إعادة استخدام Service في controllers أخرى؟

---

## 🎯 التمرين 6: المشروع النهائي - نظام إدارة مكتبة (متقدم جداً)

### المطلوب:

أنشئ نظام كامل لإدارة مكتبة يحتوي على:

### Models و Relationships:
```
Book (الكتاب)
- id, title, isbn, description, pages, price, quantity, author_id, category_id

Author (المؤلف)
- id, name, email, bio, country

Category (التصنيف)
- id, name, slug, description

Member (العضو)
- id, name, email, phone, membership_date

Borrowing (الاستعارة)
- id, book_id, member_id, borrowed_at, due_date, returned_at
```

### Controllers المطلوبة:

1. **BookController** (Resource) - إدارة الكتب
2. **AuthorController** (Resource) - إدارة المؤلفين
3. **CategoryController** - عرض التصنيفات والكتب حسب التصنيف
4. **MemberController** (Resource) - إدارة الأعضاء
5. **BorrowingController** - إدارة الاستعارات
6. **API/BookController** - API للكتب

### الحل المتوقع:

```bash
# إنشاء Models و Controllers
php artisan make:model Book -mcr
php artisan make:model Author -mcr
php artisan make:model Category -mc
php artisan make:model Member -mcr
php artisan make:model Borrowing -mc
php artisan make:controller API/BookController --api
```

**BookController:**

```php
<?php
// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $books = Book::with(['author', 'category'])
            ->when(request('category'), function ($query, $category) {
                $query->whereHas('category', fn($q) => $q->where('slug', $category));
            })
            ->when(request('author'), function ($query, $author) {
                $query->where('author_id', $author);
            })
            ->when(request('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('books')->get();
        $authors = Author::orderBy('name')->get();

        return view('books.index', compact('books', 'categories', 'authors'));
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn',
            'description' => 'nullable',
            'pages' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'تم إضافة الكتاب بنجاح');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'category', 'borrowings.member']);

        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }

    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'description' => 'nullable',
            'pages' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'تم تحديث الكتاب بنجاح');
    }

    public function destroy(Book $book)
    {
        // تحقق إذا كان الكتاب مستعار
        if ($book->borrowings()->whereNull('returned_at')->exists()) {
            return back()->with('error', 'لا يمكن حذف كتاب مستعار حالياً');
        }

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'تم حذف الكتاب بنجاح');
    }
}
```

**BorrowingController:**

```php
<?php
// app/Http/Controllers/BorrowingController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'member'])
            ->latest()
            ->paginate(20);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('quantity', '>', 0)->get();
        $members = Member::all();

        return view('borrowings.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'due_date' => 'required|date|after:today',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        // تحقق من توفر الكتاب
        if ($book->quantity < 1) {
            return back()->with('error', 'الكتاب غير متوفر');
        }

        // إنشاء استعارة
        $borrowing = Borrowing::create([
            'book_id' => $validated['book_id'],
            'member_id' => $validated['member_id'],
            'borrowed_at' => now(),
            'due_date' => $validated['due_date'],
        ]);

        // تقليل الكمية
        $book->decrement('quantity');

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'تم تسجيل الاستعارة بنجاح');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->returned_at) {
            return back()->with('error', 'الكتاب تم إرجاعه مسبقاً');
        }

        $borrowing->update(['returned_at' => now()]);
        $borrowing->book->increment('quantity');

        return back()->with('success', 'تم إرجاع الكتاب بنجاح');
    }

    public function overdue()
    {
        $borrowings = Borrowing::with(['book', 'member'])
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->get();

        return view('borrowings.overdue', compact('borrowings'));
    }
}
```

**Routes:**

```php
// routes/web.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;

// الصفحة الرئيسية
Route::get('/', function () {
    $recentBooks = Book::latest()->take(6)->get();
    return view('home', compact('recentBooks'));
})->name('home');

// Books
Route::resource('books', BookController::class);

// Authors
Route::resource('authors', AuthorController::class);

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Members
Route::resource('members', MemberController::class)->middleware('auth');

// Borrowings
Route::middleware('auth')->group(function () {
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    Route::get('/borrowings/overdue', [BorrowingController::class, 'overdue'])->name('borrowings.overdue');
});

// API
Route::prefix('api/v1')->name('api.')->group(function () {
    Route::apiResource('books', API\BookController::class);
});
```

### اختبر المشروع:

```bash
# عرض جميع routes
php artisan route:list

# تشغيل السيرفر
php artisan serve

# اختبار:
# 1. عرض جميع الكتب
# 2. إضافة كتاب جديد
# 3. استعارة كتاب
# 4. إرجاع كتاب
# 5. عرض الاستعارات المتأخرة
# 6. اختبار API endpoints
```

---

## ✅ Checklist النهائي

بعد إكمال جميع التمارين، تأكد من:

- [ ] جميع Controllers تعمل بشكل صحيح
- [ ] استخدمت Route Model Binding
- [ ] استخدمت Dependency Injection
- [ ] Controllers نظيفة (Thin Controllers)
- [ ] Validation موجود في جميع المكان المناسب
- [ ] API responses بصيغة JSON صحيحة
- [ ] Error handling موجود
- [ ] Middleware مطبق بشكل صحيح
- [ ] الكود منظم وسهل القراءة

---

## 🎯 التحدي الإضافي

إذا أكملت جميع التمارين، جرّب:

1. **Form Request Classes**: أنشئ Form Request لكل عملية validation
2. **Policies**: أضف Policies للتحقق من صلاحيات المستخدمين
3. **Service Layer**: انقل جميع المنطق إلى Service Classes
4. **API Authentication**: أضف authentication للـ API باستخدام Sanctum
5. **Testing**: اكتب Unit Tests للـ Controllers

---

**بالتوفيق في التمارين!** 🚀
