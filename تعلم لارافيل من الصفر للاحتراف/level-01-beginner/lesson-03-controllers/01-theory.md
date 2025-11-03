# الدرس الثالث: Controllers (المتحكمات) في Laravel

## 📚 المحتويات
1. [ما هو Controller؟](#what-is-controller)
2. [دور Controllers في معمارية MVC](#controllers-in-mvc)
3. [إنشاء Controllers](#creating-controllers)
4. [ربط Routes بـ Controllers](#routing-to-controllers)
5. [أنواع Controllers](#types-of-controllers)
6. [Resource Controllers](#resource-controllers)
7. [Single Action Controllers](#single-action-controllers)
8. [Controller Middleware](#controller-middleware)
9. [Dependency Injection في Controllers](#dependency-injection)
10. [تمرير البيانات من Controller إلى View](#passing-data-to-views)
11. [Route Model Binding](#route-model-binding)
12. [أفضل الممارسات](#best-practices)

---

## 1. ما هو Controller؟ {#what-is-controller}

### التعريف
**Controller** هو class في Laravel يحتوي على المنطق (logic) الخاص بمعالجة الطلبات (requests) وتنظيم التفاعل بين Models و Views.

### لماذا نستخدم Controllers؟

بدلاً من كتابة كل المنطق داخل Routes:

```php
// ❌ سيء - منطق في Route
Route::get('/users', function () {
    $users = DB::table('users')->get();
    $activeUsers = $users->where('status', 'active');
    return view('users.index', ['users' => $activeUsers]);
});
```

نستخدم Controller:

```php
// ✅ جيد - منطق في Controller
Route::get('/users', [UserController::class, 'index']);

// UserController.php
public function index()
{
    $users = User::where('status', 'active')->get();
    return view('users.index', compact('users'));
}
```

### الفوائد:
- ✅ **تنظيم الكود**: فصل المنطق عن Routes
- ✅ **إعادة الاستخدام**: يمكن استخدام نفس Method في أكثر من Route
- ✅ **سهولة الصيانة**: الكود أسهل في القراءة والتعديل
- ✅ **اختبار أفضل**: يمكن اختبار Controllers بسهولة

---

## 2. دور Controllers في معمارية MVC {#controllers-in-mvc}

### معمارية MVC

```
┌─────────────┐
│   Request   │
└──────┬──────┘
       │
       ↓
┌─────────────┐
│   Routes    │  ← يحدد أي Controller يُستخدم
└──────┬──────┘
       │
       ↓
┌─────────────┐
│ Controller  │  ← يعالج الطلب ويتعامل مع Model
└──────┬──────┘
       │
       ↓
┌─────────────┐
│    Model    │  ← يتعامل مع قاعدة البيانات
└──────┬──────┘
       │
       ↓
┌─────────────┐
│ Controller  │  ← يحضّر البيانات
└──────┬──────┘
       │
       ↓
┌─────────────┐
│    View     │  ← يعرض البيانات
└──────┬──────┘
       │
       ↓
┌─────────────┐
│  Response   │
└─────────────┘
```

### مسؤوليات Controller:
1. **استقبال الطلب**: من Route
2. **معالجة البيانات**: validation, business logic
3. **التفاعل مع Model**: جلب أو تعديل البيانات
4. **إرجاع الاستجابة**: View أو JSON أو Redirect

---

## 3. إنشاء Controllers {#creating-controllers}

### إنشاء Controller بسيط

```bash
php artisan make:controller PostController
```

سيتم إنشاء الملف في:
```
app/Http/Controllers/PostController.php
```

محتوى الملف:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Methods هنا
}
```

### إنشاء Controller في مجلد فرعي

```bash
php artisan make:controller Admin/PostController
```

سيتم إنشاء:
```
app/Http/Controllers/Admin/PostController.php
```

---

## 4. ربط Routes بـ Controllers {#routing-to-controllers}

### الطريقة الحديثة (Laravel 8+)

```php
use App\Http\Controllers\PostController;

// Single method
Route::get('/posts', [PostController::class, 'index']);

// مع parameters
Route::get('/posts/{id}', [PostController::class, 'show']);

// POST request
Route::post('/posts', [PostController::class, 'store']);
```

### الطريقة القديمة (قبل Laravel 8)

```php
// String syntax (deprecated)
Route::get('/posts', 'PostController@index');
```

⚠️ **لا تستخدم هذه الطريقة في المشاريع الجديدة!**

### ربط مجموعة من Routes

```php
use App\Http\Controllers\PostController;

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{id}', 'show');
    Route::post('/posts', 'store');
});
```

---

## 5. أنواع Controllers {#types-of-controllers}

### أ) Controller عادي

```php
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
```

### ب) Resource Controller

يحتوي على 7 methods جاهزة لـ CRUD operations:

```bash
php artisan make:controller PostController --resource
```

سيتم إنشاء:

```php
class PostController extends Controller
{
    public function index()     { } // عرض قائمة
    public function create()    { } // نموذج إنشاء
    public function store()     { } // حفظ جديد
    public function show($id)   { } // عرض منفرد
    public function edit($id)   { } // نموذج تعديل
    public function update($id) { } // حفظ التعديل
    public function destroy($id){ } // حذف
}
```

ربطها بـ Route:

```php
Route::resource('posts', PostController::class);
```

هذا السطر يُنشئ تلقائياً 7 routes!

### ج) API Resource Controller

بدون methods للـ views (create, edit):

```bash
php artisan make:controller API/PostController --api
```

سيتم إنشاء:

```php
class PostController extends Controller
{
    public function index()     { } // GET /posts
    public function store()     { } // POST /posts
    public function show($id)   { } // GET /posts/{id}
    public function update($id) { } // PUT /posts/{id}
    public function destroy($id){ } // DELETE /posts/{id}
}
```

ربطها:

```php
Route::apiResource('posts', PostController::class);
```

---

## 6. Resource Controllers {#resource-controllers}

### جدول Resource Routes

عند تنفيذ:
```php
Route::resource('posts', PostController::class);
```

يتم إنشاء:

| HTTP Method | URI                  | Action  | Route Name     |
|-------------|----------------------|---------|----------------|
| GET         | /posts               | index   | posts.index    |
| GET         | /posts/create        | create  | posts.create   |
| POST        | /posts               | store   | posts.store    |
| GET         | /posts/{post}        | show    | posts.show     |
| GET         | /posts/{post}/edit   | edit    | posts.edit     |
| PUT/PATCH   | /posts/{post}        | update  | posts.update   |
| DELETE      | /posts/{post}        | destroy | posts.destroy  |

### عرض جميع Routes:

```bash
php artisan route:list
```

### تحديد Routes محددة فقط

```php
// فقط index و show
Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

// كل شيء ما عدا destroy
Route::resource('posts', PostController::class)
    ->except(['destroy']);
```

### تسمية Routes

```php
Route::resource('posts', PostController::class)
    ->names([
        'index' => 'posts.all',
        'show' => 'posts.detail'
    ]);
```

### Parameters مخصصة

```php
Route::resource('posts', PostController::class)
    ->parameters([
        'posts' => 'post_id'
    ]);
// سيصبح: /posts/{post_id}
```

### Multiple Resources

```php
Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
]);
```

---

## 7. Single Action Controllers {#single-action-controllers}

Controllers بـ method واحد فقط `__invoke()`.

### إنشاء Single Action Controller

```bash
php artisan make:controller ShowProfileController --invokable
```

```php
<?php

namespace App\Http\Controllers;

class ShowProfileController extends Controller
{
    public function __invoke($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile.show', compact('user'));
    }
}
```

### ربطه بـ Route:

```php
use App\Http\Controllers\ShowProfileController;

// بدون اسم method
Route::get('/profile/{username}', ShowProfileController::class);
```

### متى نستخدمه؟
- عندما يكون Controller له **مهمة واحدة فقط**
- مثل: إرسال email، تصدير ملف، عرض صفحة خاصة

---

## 8. Controller Middleware {#controller-middleware}

### في Constructor:

```php
class PostController extends Controller
{
    public function __construct()
    {
        // تطبيق على جميع methods
        $this->middleware('auth');

        // تطبيق على methods محددة
        $this->middleware('admin')->only(['create', 'store', 'destroy']);

        // تطبيق على كل شيء ما عدا
        $this->middleware('log')->except(['index', 'show']);
    }

    public function index() { }
    public function store() { }
}
```

### في Routes:

```php
Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::resource('posts', PostController::class);
    });
```

---

## 9. Dependency Injection في Controllers {#dependency-injection}

Laravel يدعم Dependency Injection تلقائياً!

### في Constructor:

```php
use App\Services\PostService;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }
}
```

### في Methods:

```php
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Laravel يحقن Request تلقائياً
        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        Post::create($data);

        return redirect()->route('posts.index');
    }
}
```

### أمثلة أخرى:

```php
use Illuminate\Support\Facades\Cache;
use App\Repositories\PostRepository;

public function show($id, PostRepository $posts, Cache $cache)
{
    // Laravel يحقن التبعيات تلقائياً
    $post = $posts->find($id);
    $cache->put('last_post', $post->id, 3600);

    return view('posts.show', compact('post'));
}
```

---

## 10. تمرير البيانات من Controller إلى View {#passing-data-to-views}

### الطريقة 1: Array

```php
public function index()
{
    $posts = Post::all();
    return view('posts.index', ['posts' => $posts]);
}
```

### الطريقة 2: compact()

```php
public function index()
{
    $posts = Post::all();
    $title = 'All Posts';
    return view('posts.index', compact('posts', 'title'));
}
```

### الطريقة 3: with()

```php
public function index()
{
    $posts = Post::all();
    return view('posts.index')->with('posts', $posts);
}
```

### الطريقة 4: with() متعددة

```php
public function index()
{
    return view('posts.index')
        ->with('posts', Post::all())
        ->with('categories', Category::all())
        ->with('title', 'All Posts');
}
```

### في Blade:

```blade
<!-- resources/views/posts/index.blade.php -->
<h1>{{ $title }}</h1>

@foreach($posts as $post)
    <h2>{{ $post->title }}</h2>
@endforeach
```

---

## 11. Route Model Binding {#route-model-binding}

### Implicit Binding (التلقائي)

بدلاً من:

```php
public function show($id)
{
    $post = Post::findOrFail($id);
    return view('posts.show', compact('post'));
}
```

استخدم:

```php
public function show(Post $post)
{
    // Laravel يجلب Post تلقائياً!
    return view('posts.show', compact('post'));
}
```

في Route:

```php
// المفتاح يجب أن يطابق اسم Parameter
Route::get('/posts/{post}', [PostController::class, 'show']);
```

### Custom Key

```php
public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

// في Route:
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
// الآن يبحث بـ slug بدلاً من id
```

### في Model:

```php
class Post extends Model
{
    // استخدم slug دائماً في Route Binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
```

### Explicit Binding

في `RouteServiceProvider.php`:

```php
use App\Models\Post;
use Illuminate\Support\Facades\Route;

public function boot()
{
    Route::model('post', Post::class);

    // أو مخصص:
    Route::bind('post', function ($value) {
        return Post::where('slug', $value)->firstOrFail();
    });
}
```

---

## 12. أفضل الممارسات {#best-practices}

### ✅ افعل:

#### 1. استخدم Resource Controllers للـ CRUD

```php
// بدلاً من:
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
// ... إلخ

// استخدم:
Route::resource('posts', PostController::class);
```

#### 2. استخدم Form Requests للـ Validation

```php
// بدلاً من:
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
    ]);
}

// استخدم:
public function store(StorePostRequest $request)
{
    // Validation تلقائياً
}
```

#### 3. استخدم Route Model Binding

```php
// بدلاً من:
public function show($id)
{
    $post = Post::findOrFail($id);
}

// استخدم:
public function show(Post $post)
{
    // $post جاهز للاستخدام
}
```

#### 4. أبقِ Controllers نحيفة (Thin Controllers)

```php
// ❌ سيء - منطق معقد في Controller
public function store(Request $request)
{
    $data = $request->validate([...]);
    $post = Post::create($data);
    $post->categories()->attach($request->categories);
    $post->author()->associate(auth()->user());
    event(new PostCreated($post));
    Cache::forget('posts');
    // ... المزيد من المنطق
}

// ✅ جيد - استخدم Service Class
public function store(StorePostRequest $request, PostService $service)
{
    $post = $service->createPost($request->validated());
    return redirect()->route('posts.show', $post);
}
```

#### 5. استخدم النموذج الصحيح للـ Response

```php
// للـ views
return view('posts.show', compact('post'));

// للـ redirects
return redirect()->route('posts.index');

// للـ JSON (APIs)
return response()->json(['data' => $posts]);

// للتحميل
return response()->download($pathToFile);
```

### ❌ لا تفعل:

#### 1. لا تكتب استعلامات قاعدة البيانات المعقدة في Controller

```php
// ❌ سيء
public function index()
{
    $posts = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('posts.*', 'users.name', 'categories.name as category')
        ->where('posts.status', 'published')
        ->orderBy('posts.created_at', 'desc')
        ->get();

    return view('posts.index', compact('posts'));
}

// ✅ جيد - استخدم Repository أو Model Scopes
public function index(PostRepository $posts)
{
    $posts = $posts->getPublishedWithRelations();
    return view('posts.index', compact('posts'));
}
```

#### 2. لا تضع HTML في Controller

```php
// ❌ سيء
public function show($id)
{
    $post = Post::find($id);
    $html = '<h1>' . $post->title . '</h1>';
    return $html;
}

// ✅ جيد
public function show(Post $post)
{
    return view('posts.show', compact('post'));
}
```

#### 3. لا تكرر الكود

```php
// ❌ سيء
public function store(Request $request)
{
    if (!auth()->check()) {
        abort(403);
    }
    // ...
}

public function update(Request $request, $id)
{
    if (!auth()->check()) {
        abort(403);
    }
    // ...
}

// ✅ جيد - استخدم Middleware
public function __construct()
{
    $this->middleware('auth');
}
```

---

## 📌 خلاصة

### Controllers في Laravel:
1. ✅ تنظم المنطق وتفصله عن Routes
2. ✅ تتبع معمارية MVC
3. ✅ يتم إنشاؤها باستخدام Artisan
4. ✅ تدعم Dependency Injection
5. ✅ Resource Controllers توفر الوقت
6. ✅ Route Model Binding يبسط الكود
7. ✅ يجب أن تكون نحيفة (thin) قدر الإمكان

### الأوامر المهمة:

```bash
# إنشاء controller عادي
php artisan make:controller PostController

# إنشاء resource controller
php artisan make:controller PostController --resource

# إنشاء API controller
php artisan make:controller PostController --api

# إنشاء invokable controller
php artisan make:controller ShowPostController --invokable

# عرض جميع routes
php artisan route:list
```

---

## 🔗 مصادر إضافية

- [Laravel Controllers Documentation](https://laravel.com/docs/controllers)
- [Resource Controllers](https://laravel.com/docs/controllers#resource-controllers)
- [Dependency Injection](https://laravel.com/docs/controllers#dependency-injection)

---

**الدرس التالي**: Views و Blade Template Engine 🎨
