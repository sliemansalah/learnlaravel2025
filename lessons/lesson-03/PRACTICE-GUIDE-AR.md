# دليل التطبيق العملي للدرس الثالث

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-03\practice-app
php artisan serve
```

الخادم سيعمل على: `http://localhost:8000`

---

## 📋 المسارات المتاحة

### 1. الصفحات الأساسية
- **GET** `/` - الصفحة الرئيسية
- **GET** `/about` - من نحن
- **GET** `/contact` - اتصل بنا

### 2. المنتجات (Products) - Resource Controller
- **GET** `/products` - قائمة المنتجات
- **GET** `/products/create` - نموذج إضافة منتج
- **POST** `/products` - حفظ منتج جديد
- **GET** `/products/{id}` - عرض منتج واحد
- **GET** `/products/{id}/edit` - نموذج تعديل منتج
- **PUT/PATCH** `/products/{id}` - تحديث منتج
- **DELETE** `/products/{id}` - حذف منتج

### 3. المقالات (Posts) - Resource Controller
- **GET** `/posts` - قائمة المقالات
- **GET** `/posts/create` - نموذج إضافة مقال
- **POST** `/posts` - حفظ مقال جديد
- **GET** `/posts/{id}` - عرض مقال واحد
- **GET** `/posts/{id}/edit` - نموذج تعديل مقال
- **PUT/PATCH** `/posts/{id}` - تحديث مقال
- **DELETE** `/posts/{id}` - حذف مقال

### 4. لوحة التحكم
- **GET** `/dashboard` - لوحة التحكم (Single Action Controller)

### 5. المستخدمين
- **POST** `/users` - إنشاء مستخدم جديد (مع validation)
- **PUT** `/users/{id}` - تحديث مستخدم (مع validation)

---

## ✅ Controllers المنفذة

### 1. PageController - الصفحات الأساسية

```bash
php artisan make:controller PageController
```

```php
class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
```

**المسارات:**
```php
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
```

---

### 2. ProductController - Resource Controller

```bash
php artisan make:controller ProductController --resource
```

```php
class ProductController extends Controller
{
    // عرض جميع المنتجات
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'لابتوب HP', 'price' => 5000, 'stock' => 10],
            ['id' => 2, 'name' => 'هاتف iPhone', 'price' => 4000, 'stock' => 15],
            ['id' => 3, 'name' => 'تابلت Samsung', 'price' => 2000, 'stock' => 8],
        ];

        return view('products.index', compact('products'));
    }

    // نموذج إنشاء منتج جديد
    public function create()
    {
        return view('products.create');
    }

    // حفظ المنتج الجديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // في التطبيق الحقيقي: Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'تم إضافة المنتج بنجاح');
    }

    // عرض منتج واحد
    public function show($id)
    {
        $products = [
            1 => ['id' => 1, 'name' => 'لابتوب HP', 'price' => 5000, 'stock' => 10],
            2 => ['id' => 2, 'name' => 'هاتف iPhone', 'price' => 4000, 'stock' => 15],
            3 => ['id' => 3, 'name' => 'تابلت Samsung', 'price' => 2000, 'stock' => 8],
        ];

        $product = $products[$id] ?? abort(404);

        return view('products.show', compact('product'));
    }

    // نموذج تعديل منتج
    public function edit($id)
    {
        $products = [
            1 => ['id' => 1, 'name' => 'لابتوب HP', 'price' => 5000, 'stock' => 10],
            2 => ['id' => 2, 'name' => 'هاتف iPhone', 'price' => 4000, 'stock' => 15],
            3 => ['id' => 3, 'name' => 'تابلت Samsung', 'price' => 2000, 'stock' => 8],
        ];

        $product = $products[$id] ?? abort(404);

        return view('products.edit', compact('product'));
    }

    // تحديث المنتج
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // في التطبيق الحقيقي: $product->update($validated);

        return redirect()->route('products.show', $id)
                         ->with('success', 'تم تحديث المنتج بنجاح');
    }

    // حذف المنتج
    public function destroy($id)
    {
        // في التطبيق الحقيقي: $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'تم حذف المنتج بنجاح');
    }
}
```

**المسارات:**
```php
Route::resource('products', ProductController::class);
```

---

### 3. PostController - Resource Controller

```bash
php artisan make:controller PostController --resource
```

```php
class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'مقدمة في Laravel', 'author' => 'أحمد محمد', 'date' => '2024-01-15'],
            ['id' => 2, 'title' => 'تعلم Controllers', 'author' => 'محمد علي', 'date' => '2024-01-20'],
            ['id' => 3, 'title' => 'نمط MVC', 'author' => 'سارة أحمد', 'date' => '2024-01-25'],
        ];

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'author' => 'required|max:100',
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'تم إنشاء المقال بنجاح');
    }

    public function show($id)
    {
        $posts = [
            1 => [
                'id' => 1,
                'title' => 'مقدمة في Laravel',
                'content' => 'Laravel هو إطار عمل PHP حديث...',
                'author' => 'أحمد محمد',
                'date' => '2024-01-15'
            ],
            2 => [
                'id' => 2,
                'title' => 'تعلم Controllers',
                'content' => 'Controllers هي الطبقة التي تربط...',
                'author' => 'محمد علي',
                'date' => '2024-01-20'
            ],
        ];

        $post = $posts[$id] ?? abort(404);

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $posts = [
            1 => ['id' => 1, 'title' => 'مقدمة في Laravel', 'content' => 'Laravel هو...', 'author' => 'أحمد'],
            2 => ['id' => 2, 'title' => 'تعلم Controllers', 'content' => 'Controllers هي...', 'author' => 'محمد'],
        ];

        $post = $posts[$id] ?? abort(404);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'author' => 'required|max:100',
        ]);

        return redirect()->route('posts.show', $id)
                         ->with('success', 'تم تحديث المقال بنجاح');
    }

    public function destroy($id)
    {
        return redirect()->route('posts.index')
                         ->with('success', 'تم حذف المقال بنجاح');
    }
}
```

**المسارات:**
```php
Route::resource('posts', PostController::class);
```

---

### 4. ShowDashboardController - Single Action

```bash
php artisan make:controller ShowDashboardController --invokable
```

```php
class ShowDashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'users' => 1250,
            'products' => 85,
            'posts' => 342,
            'revenue' => 125000,
            'orders' => 567,
            'visitors' => 8932
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

---

### 5. UserController - Dependency Injection & Validation

```bash
php artisan make:controller UserController
```

```php
use Illuminate\Http\Request;

class UserController extends Controller
{
    // إنشاء مستخدم جديد مع validation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|regex:/^[0-9]{10}$/',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
        ]);

        // User::create($validated);

        return redirect()->route('home')
                         ->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    // تحديث مستخدم
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|regex:/^[0-9]{10}$/',
        ]);

        // $user->update($validated);

        return redirect()->route('home')
                         ->with('success', 'تم تحديث المستخدم بنجاح');
    }
}
```

**المسارات:**
```php
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
```

---

## 🎯 ما تعلمناه

### 1. أنواع Controllers
- ✅ Controller بسيط (PageController)
- ✅ Resource Controller (ProductController, PostController)
- ✅ Single Action Controller (ShowDashboardController)
- ✅ Controller مع Dependency Injection (UserController)

### 2. Resource Controller Methods
- `index()` - عرض القائمة
- `create()` - نموذج الإنشاء
- `store()` - حفظ البيانات
- `show($id)` - عرض عنصر واحد
- `edit($id)` - نموذج التعديل
- `update($id)` - تحديث البيانات
- `destroy($id)` - حذف عنصر

### 3. التحقق من البيانات (Validation)
- استخدام `validate()` في Controller
- رسائل خطأ مخصصة
- قواعد التحقق المختلفة

### 4. Responses
- `return view()` - عرض صفحة
- `return redirect()` - إعادة توجيه
- `->with('success', 'message')` - رسائل flash

---

## 📝 أوامر مفيدة

```bash
# عرض جميع المسارات
php artisan route:list

# عرض مسارات products فقط
php artisan route:list --name=products

# عرض مسارات posts فقط
php artisan route:list --name=posts

# إنشاء controller جديد
php artisan make:controller ControllerName --resource

# عرض تفصيلي للمسارات
php artisan route:list -v
```

---

## 🔍 اختبار المسارات

### اختبار Products:
1. ✅ `http://localhost:8000/products` - قائمة المنتجات
2. ✅ `http://localhost:8000/products/1` - عرض منتج رقم 1
3. ✅ `http://localhost:8000/products/create` - نموذج إضافة منتج
4. ✅ `http://localhost:8000/products/1/edit` - نموذج تعديل منتج

### اختبار Posts:
1. ✅ `http://localhost:8000/posts` - قائمة المقالات
2. ✅ `http://localhost:8000/posts/1` - عرض مقال رقم 1
3. ✅ `http://localhost:8000/posts/create` - نموذج إضافة مقال
4. ✅ `http://localhost:8000/posts/1/edit` - نموذج تعديل مقال

### اختبار الصفحات:
1. ✅ `http://localhost:8000/` - الصفحة الرئيسية
2. ✅ `http://localhost:8000/about` - من نحن
3. ✅ `http://localhost:8000/contact` - اتصل بنا
4. ✅ `http://localhost:8000/dashboard` - لوحة التحكم

---

## 💡 نصائح

1. **استخدم `php artisan route:list`** لعرض جميع المسارات
2. **Resource Controllers** توفر وقتك - استخدمها!
3. **Single Action Controllers** مفيدة للصفحات المعقدة
4. **Validation** مهم جداً - لا تنساه
5. **اختبر كل مسار** للتأكد من عمله

---

## 🎓 تمارين إضافية

### تمرين 1: إنشاء Category Controller
قم بإنشاء Resource Controller للتصنيفات مع جميع الـ 7 methods.

### تمرين 2: إضافة Middleware
أضف middleware للتحقق من تسجيل الدخول على `create`, `store`, `edit`, `update`, `destroy`.

### تمرين 3: Form Request
قم بإنشاء Form Request للـ validation بدلاً من وضعه في Controller.

```bash
php artisan make:request StoreProductRequest
```

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 4**: Blade Templates وواجهات المستخدم
- محرك القوالب Blade
- التوجيهات (Directives)
- المكونات (Components)
- التخطيطات (Layouts)

---

**تعلم سعيد! 🚀**
