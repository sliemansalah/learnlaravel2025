<?php
/**
 * ==============================================
 * مثال 3: Controllers في Laravel
 * Example 3: Controllers in Laravel
 * ==============================================
 *
 * الغرض من هذا المثال:
 * - فهم دور Controller في MVC
 * - إنشاء Controllers
 * - ربط Controllers بالـ Routes
 * - أفضل الممارسات
 *
 * المكان المناسب لهذا الكود:
 * app/Http/Controllers/
 * ==============================================
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * ==============================================
 * القسم 1: Controller بسيط
 * Section 1: Simple Controller
 * ==============================================
 */

/**
 * مثال 1: أبسط Controller ممكن
 *
 * لإنشاء هذا الـ Controller:
 * php artisan make:controller HomeController
 *
 * اسم الملف: app/Http/Controllers/HomeController.php
 */
class HomeController extends Controller
{
    /**
     * عرض الصفحة الرئيسية
     */
    public function index()
    {
        return view('home');
    }

    /**
     * عرض صفحة "من نحن"
     */
    public function about()
    {
        return view('about', [
            'title' => 'من نحن',
            'description' => 'نحن شركة رائدة في مجال البرمجة'
        ]);
    }

    /**
     * عرض صفحة الاتصال
     */
    public function contact()
    {
        $data = [
            'email' => 'info@example.com',
            'phone' => '+966500000000',
            'address' => 'الرياض، المملكة العربية السعودية'
        ];

        return view('contact', $data);
    }
}

/**
 * في routes/web.php:
 *
 * use App\Http\Controllers\HomeController;
 *
 * Route::get('/', [HomeController::class, 'index']);
 * Route::get('/about', [HomeController::class, 'about']);
 * Route::get('/contact', [HomeController::class, 'contact']);
 */

/**
 * ==============================================
 * القسم 2: Controller مع Parameters
 * Section 2: Controller with Parameters
 * ==============================================
 */

/**
 * مثال 2: Controller يستقبل parameters
 *
 * لإنشاء:
 * php artisan make:controller UserController
 *
 * اسم الملف: app/Http/Controllers/UserController.php
 */
class UserController extends Controller
{
    /**
     * عرض قائمة جميع المستخدمين
     */
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => 'أحمد محمد', 'email' => 'ahmed@example.com'],
            ['id' => 2, 'name' => 'محمد علي', 'email' => 'mohamed@example.com'],
            ['id' => 3, 'name' => 'سارة أحمد', 'email' => 'sara@example.com'],
        ];

        return view('users.index', compact('users'));
    }

    /**
     * عرض تفاصيل مستخدم معين
     */
    public function show($id)
    {
        // في الحقيقة، نجلب البيانات من قاعدة البيانات
        // User::find($id)

        $user = [
            'id' => $id,
            'name' => 'أحمد محمد',
            'email' => 'ahmed@example.com',
            'phone' => '+966500000000',
            'bio' => 'مطور ويب محترف'
        ];

        return view('users.show', ['user' => $user]);
    }

    /**
     * عرض صفحة إنشاء مستخدم جديد
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * حفظ مستخدم جديد
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        // حفظ المستخدم (في الحقيقة في قاعدة البيانات)
        // User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح!');
    }

    /**
     * عرض صفحة تعديل مستخدم
     */
    public function edit($id)
    {
        $user = [
            'id' => $id,
            'name' => 'أحمد محمد',
            'email' => 'ahmed@example.com'
        ];

        return view('users.edit', compact('user'));
    }

    /**
     * تحديث بيانات مستخدم
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        // تحديث في قاعدة البيانات
        // $user = User::find($id);
        // $user->update($validated);

        return redirect()->route('users.show', $id)
            ->with('success', 'تم تحديث البيانات بنجاح!');
    }

    /**
     * حذف مستخدم
     */
    public function destroy($id)
    {
        // حذف من قاعدة البيانات
        // User::destroy($id);

        return redirect()->route('users.index')
            ->with('success', 'تم حذف المستخدم بنجاح!');
    }
}

/**
 * في routes/web.php:
 *
 * use App\Http\Controllers\UserController;
 *
 * // Route واحد لجميع العمليات (CRUD)
 * Route::resource('users', UserController::class);
 *
 * // أو بشكل منفصل:
 * Route::get('/users', [UserController::class, 'index'])->name('users.index');
 * Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
 * Route::post('/users', [UserController::class, 'store'])->name('users.store');
 * Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
 * Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
 * Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
 * Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
 */

/**
 * ==============================================
 * القسم 3: Single Action Controller
 * Section 3: Single Action Controller
 * ==============================================
 */

/**
 * مثال 3: Controller بوظيفة واحدة فقط
 *
 * لإنشاء:
 * php artisan make:controller ShowProfileController --invokable
 *
 * اسم الملف: app/Http/Controllers/ShowProfileController.php
 */
class ShowProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $profile = [
            'id' => $id,
            'name' => 'أحمد محمد',
            'avatar' => 'https://via.placeholder.com/150',
            'bio' => 'مطور ويب محترف',
            'followers' => 1250,
            'following' => 340
        ];

        return view('profile', compact('profile'));
    }
}

/**
 * في routes/web.php:
 *
 * use App\Http\Controllers\ShowProfileController;
 *
 * Route::get('/profile/{id}', ShowProfileController::class);
 */

/**
 * ==============================================
 * القسم 4: Resource Controller
 * Section 4: Resource Controller
 * ==============================================
 */

/**
 * مثال 4: Resource Controller كامل
 *
 * لإنشاء:
 * php artisan make:controller ArticleController --resource
 *
 * اسم الملف: app/Http/Controllers/ArticleController.php
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /articles
     */
    public function index()
    {
        $articles = [
            [
                'id' => 1,
                'title' => 'تعلم Laravel من الصفر',
                'excerpt' => 'مقدمة شاملة لتعلم Laravel...',
                'author' => 'أحمد محمد',
                'date' => '2025-11-01'
            ],
            [
                'id' => 2,
                'title' => 'أساسيات PHP',
                'excerpt' => 'تعلم PHP من البداية...',
                'author' => 'محمد علي',
                'date' => '2025-11-02'
            ]
        ];

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /articles/create
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /articles
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required'
        ]);

        // Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'تم نشر المقال بنجاح!');
    }

    /**
     * Display the specified resource.
     * GET /articles/{id}
     */
    public function show($id)
    {
        $article = [
            'id' => $id,
            'title' => 'تعلم Laravel من الصفر',
            'content' => 'محتوى المقال الكامل...',
            'author' => 'أحمد محمد',
            'date' => '2025-11-01',
            'views' => 1520
        ];

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /articles/{id}/edit
     */
    public function edit($id)
    {
        $article = [
            'id' => $id,
            'title' => 'تعلم Laravel من الصفر',
            'content' => 'محتوى المقال...',
            'author' => 'أحمد محمد'
        ];

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /articles/{id}
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        // $article = Article::find($id);
        // $article->update($validated);

        return redirect()->route('articles.show', $id)
            ->with('success', 'تم تحديث المقال بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /articles/{id}
     */
    public function destroy($id)
    {
        // Article::destroy($id);

        return redirect()->route('articles.index')
            ->with('success', 'تم حذف المقال بنجاح!');
    }
}

/**
 * في routes/web.php:
 *
 * use App\Http\Controllers\ArticleController;
 *
 * Route::resource('articles', ArticleController::class);
 */

/**
 * ==============================================
 * القسم 5: API Controller
 * Section 5: API Controller
 * ==============================================
 */

/**
 * مثال 5: API Controller (يرجع JSON)
 *
 * لإنشاء:
 * php artisan make:controller Api/ProductController --api
 *
 * اسم الملف: app/Http/Controllers/Api/ProductController.php
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'لابتوب', 'price' => 3000],
            ['id' => 2, 'name' => 'هاتف', 'price' => 2000],
            ['id' => 3, 'name' => 'تابلت', 'price' => 1500]
        ];

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        // Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة المنتج بنجاح'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = [
            'id' => $id,
            'name' => 'لابتوب',
            'price' => 3000,
            'description' => 'لابتوب عالي الأداء'
        ];

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
            'price' => 'sometimes|required|numeric'
        ]);

        // $product = Product::find($id);
        // $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المنتج بنجاح'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'تم حذف المنتج بنجاح'
        ]);
    }
}

/**
 * في routes/api.php:
 *
 * use App\Http\Controllers\Api\ProductController;
 *
 * Route::apiResource('products', ProductController::class);
 */

/**
 * ==============================================
 * تمارين للتطبيق
 * Practice Exercises
 * ==============================================
 */

/**
 * تمرين 1: أنشئ TaskController
 * - index: عرض قائمة المهام
 * - show: عرض تفاصيل مهمة
 * - store: إضافة مهمة جديدة
 * - toggle: تبديل حالة المهمة (مكتملة/غير مكتملة)
 */

/**
 * تمرين 2: أنشئ CategoryController مع nested resources
 * - /categories/{category}/products
 * - عرض جميع المنتجات في تصنيف معين
 */

/**
 * تمرين 3: أنشئ SearchController (Single Action)
 * - يستقبل كلمة بحث
 * - يرجع نتائج من مصادر متعددة
 */

/**
 * ==============================================
 * أفضل الممارسات
 * Best Practices
 * ==============================================
 */

/**
 * ✅ افعل:
 *
 * 1. اتبع نمط REST للتسمية
 * 2. استخدم Resource Controllers للـ CRUD
 * 3. اجعل كل method يقوم بشيء واحد فقط
 * 4. استخدم Request Validation
 * 5. ارجع responses مناسبة (views للـ web، JSON للـ API)
 */

/**
 * ❌ لا تفعل:
 *
 * 1. لا تضع logic معقد في Controller
 * 2. لا تستعلم من Database مباشرة (استخدم Models)
 * 3. لا تكرر الكود
 * 4. لا تنسى التحقق من البيانات
 */

/**
 * ==============================================
 * أوامر مفيدة
 * Useful Commands
 * ==============================================
 */

/**
 * إنشاء Controllers:
 *
 * php artisan make:controller ControllerName
 * php artisan make:controller ControllerName --resource
 * php artisan make:controller ControllerName --api
 * php artisan make:controller ControllerName --invokable
 * php artisan make:controller Admin/ControllerName
 */

/**
 * عرض جميع Routes:
 *
 * php artisan route:list
 * php artisan route:list --path=articles
 * php artisan route:list --method=GET
 */
