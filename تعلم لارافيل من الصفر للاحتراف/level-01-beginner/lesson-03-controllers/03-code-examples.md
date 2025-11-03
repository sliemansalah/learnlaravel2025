# الدرس الثالث - أمثلة الكود: Controllers في Laravel

## 📋 المحتويات
1. [إنشاء Controllers](#creating-controllers)
2. [Controllers الأساسية](#basic-controllers)
3. [Resource Controllers](#resource-controllers)
4. [Single Action Controllers](#single-action-controllers)
5. [API Controllers](#api-controllers)
6. [Route Model Binding](#route-model-binding)
7. [Dependency Injection](#dependency-injection)
8. [Middleware في Controllers](#middleware)
9. [تمرير البيانات](#passing-data)
10. [مشروع كامل](#complete-project)

---

## 1. إنشاء Controllers {#creating-controllers}

### مثال 1: إنشاء Controller بسيط

```bash
# إنشاء controller عادي
php artisan make:controller PostController
```

**الناتج:**
```php
<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // methods هنا
}
```

---

### مثال 2: إنشاء Resource Controller

```bash
php artisan make:controller PostController --resource
```

**الناتج:**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // عرض قائمة المقالات
    }

    public function create()
    {
        // عرض نموذج الإنشاء
    }

    public function store(Request $request)
    {
        // حفظ مقال جديد
    }

    public function show($id)
    {
        // عرض مقال منفرد
    }

    public function edit($id)
    {
        // عرض نموذج التعديل
    }

    public function update(Request $request, $id)
    {
        // حفظ التعديلات
    }

    public function destroy($id)
    {
        // حذف مقال
    }
}
```

---

### مثال 3: إنشاء API Controller

```bash
php artisan make:controller API/PostController --api
```

**الناتج:**
```php
<?php
// app/Http/Controllers/API/PostController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // GET /api/posts
    }

    public function store(Request $request)
    {
        // POST /api/posts
    }

    public function show($id)
    {
        // GET /api/posts/{id}
    }

    public function update(Request $request, $id)
    {
        // PUT/PATCH /api/posts/{id}
    }

    public function destroy($id)
    {
        // DELETE /api/posts/{id}
    }
}
```

---

### مثال 4: إنشاء Single Action Controller

```bash
php artisan make:controller ShowProfileController --invokable
```

**الناتج:**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        // منطق واحد فقط
    }
}
```

---

## 2. Controllers الأساسية {#basic-controllers}

### مثال 5: Controller بسيط لعرض قائمة

```php
<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'مقال أول', 'body' => 'محتوى المقال الأول'],
            ['id' => 2, 'title' => 'مقال ثاني', 'body' => 'محتوى المقال الثاني'],
            ['id' => 3, 'title' => 'مقال ثالث', 'body' => 'محتوى المقال الثالث'],
        ];

        return view('posts.index', compact('posts'));
    }
}
```

**Route:**
```php
// routes/web.php
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);
```

---

### مثال 6: Controller مع parameter

```php
<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function show($id)
    {
        $post = [
            'id' => $id,
            'title' => 'عنوان المقال',
            'body' => 'محتوى المقال...',
        ];

        return view('posts.show', compact('post'));
    }
}
```

**Route:**
```php
Route::get('/posts/{id}', [PostController::class, 'show'])->whereNumber('id');
```

---

### مثال 7: Controller مع عدة methods

```php
<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    // عرض القائمة
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // عرض منفرد
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // البحث
    public function search()
    {
        $query = request('q');
        $posts = Post::where('title', 'like', "%{$query}%")->get();
        return view('posts.search', compact('posts', 'query'));
    }
}
```

**Routes:**
```php
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
```

---

## 3. Resource Controllers {#resource-controllers}

### مثال 8: Resource Controller كامل

```php
<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'category')
            ->latest()
            ->paginate(15);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'تم إنشاء المقال بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user', 'category', 'comments');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // تحقق من الصلاحية
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'تم تحديث المقال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'تم حذف المقال بنجاح');
    }
}
```

**Route:**
```php
Route::resource('posts', PostController::class);
```

هذا Route واحد ينشئ 7 routes!

---

### مثال 9: Resource Controller مع only/except

```php
// فقط index و show
Route::resource('posts', PostController::class)->only(['index', 'show']);

// كل شيء ما عدا destroy
Route::resource('posts', PostController::class)->except(['destroy']);
```

---

### مثال 10: Resource Controller مع Middleware

```php
Route::resource('posts', PostController::class)->middleware('auth');

// أو في Controller
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}
```

---

## 4. Single Action Controllers {#single-action-controllers}

### مثال 11: عرض ملف مستخدم

```php
<?php
// app/Http/Controllers/ShowProfileController.php

namespace App\Http\Controllers;

use App\Models\User;

class ShowProfileController extends Controller
{
    public function __invoke(User $user)
    {
        $user->load('posts', 'comments');

        return view('profile.show', compact('user'));
    }
}
```

**Route:**
```php
Route::get('/profile/{user}', ShowProfileController::class)->name('profile.show');
```

---

### مثال 12: تصدير تقرير

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ExportPostsController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('user')->get();

        $csv = "ID,Title,Author,Created\n";
        foreach ($posts as $post) {
            $csv .= "{$post->id},{$post->title},{$post->user->name},{$post->created_at}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="posts.csv"');
    }
}
```

**Route:**
```php
Route::get('/export/posts', ExportPostsController::class)
    ->middleware('auth')
    ->name('posts.export');
```

---

### مثال 13: إرسال بريد إلكتروني

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailController extends Controller
{
    public function __invoke(User $user)
    {
        Mail::to($user->email)->send(new WelcomeEmail($user));

        return back()->with('success', 'تم إرسال البريد بنجاح');
    }
}
```

---

## 5. API Controllers {#api-controllers}

### مثال 14: API Controller كامل

```php
<?php
// app/Http/Controllers/API/PostController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index()
    {
        $posts = Post::with('user', 'category')
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post->load('user', 'category')
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post->load('user', 'category', 'comments.user');

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        // تحقق من الصلاحية
        if ($request->user()->id !== $post->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        }

        $validated = $request->validate([
            'title' => 'sometimes|max:255',
            'body' => 'sometimes',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $post->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $post->fresh()->load('user', 'category')
        ]);
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Request $request, Post $post)
    {
        if ($request->user()->id !== $post->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
}
```

**Route:**
```php
// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', API\PostController::class);
});
```

---

### مثال 15: API مع Error Handling

```php
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    public function show($id)
    {
        try {
            $post = Post::with('user', 'category')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $post
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
```

---

## 6. Route Model Binding {#route-model-binding}

### مثال 16: Implicit Binding

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        // $post جاهز للاستخدام!
        // Laravel جلبه تلقائياً من DB
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
```

**Routes:**
```php
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'destroy']);
```

---

### مثال 17: Custom Key (استخدام slug)

```php
// في Model
class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

// في Controller
public function show(Post $post)
{
    // الآن $post يُجلب بـ slug وليس id
    return view('posts.show', compact('post'));
}
```

**أو في Route:**
```php
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
```

---

### مثال 18: Scoped Binding

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class UserPostController extends Controller
{
    public function show(User $user, Post $post)
    {
        // Laravel يتحقق تلقائياً أن $post يعود لـ $user
        return view('users.posts.show', compact('user', 'post'));
    }
}
```

**Route:**
```php
Route::get('/users/{user}/posts/{post}', [UserPostController::class, 'show'])
    ->scopeBindings();
```

---

## 7. Dependency Injection {#dependency-injection}

### مثال 19: حقن Request

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Request محقون تلقائياً
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = Post::create($validated);

        return redirect()->route('posts.show', $post);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $posts = Post::where('title', 'like', "%{$query}%")->get();

        return view('posts.search', compact('posts', 'query'));
    }
}
```

---

### مثال 20: حقن Service في Constructor

```php
<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        // Laravel يحقن PostService تلقائياً
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $post = $this->postService->createPost($request->validated());
        return redirect()->route('posts.show', $post);
    }
}
```

**PostService:**
```php
<?php
// app/Services/PostService.php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getAllPosts()
    {
        return Post::with('user', 'category')
            ->latest()
            ->paginate(15);
    }

    public function createPost(array $data)
    {
        return Post::create([
            ...$data,
            'user_id' => auth()->id(),
        ]);
    }

    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }
}
```

---

### مثال 21: حقن متعدد

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected CategoryRepository $categoryRepository
    ) {}

    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request, Cache $cache)
    {
        $post = $this->postService->createPost($request->validated());

        // مسح cache
        $cache->forget('latest_posts');

        return redirect()->route('posts.show', $post);
    }
}
```

---

## 8. Middleware في Controllers {#middleware}

### مثال 22: Middleware في Constructor

```php
<?php

namespace App\Http\Controllers;

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
    public function create() { } // auth + admin
    public function store() { } // auth + admin
    public function show() { } // auth فقط
    public function destroy() { } // auth + admin
}
```

---

### مثال 23: Middleware مع Parameters

```php
<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function __construct()
    {
        // rate limiting
        $this->middleware('throttle:60,1')->only('store');

        // role-based
        $this->middleware('role:admin,editor')->only(['create', 'destroy']);
    }
}
```

---

## 9. تمرير البيانات {#passing-data}

### مثال 24: طرق مختلفة لتمرير البيانات

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    // الطريقة 1: Array
    public function method1()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    // الطريقة 2: compact()
    public function method2()
    {
        $posts = Post::all();
        $title = 'جميع المقالات';
        return view('posts.index', compact('posts', 'title'));
    }

    // الطريقة 3: with()
    public function method3()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    // الطريقة 4: with() متعددة
    public function method4()
    {
        return view('posts.index')
            ->with('posts', Post::all())
            ->with('categories', Category::all())
            ->with('title', 'المقالات');
    }
}
```

---

### مثال 25: تمرير بيانات معقدة

```php
public function dashboard()
{
    $data = [
        'posts' => Post::latest()->take(5)->get(),
        'users' => User::count(),
        'comments' => Comment::count(),
        'stats' => [
            'today' => Post::whereDate('created_at', today())->count(),
            'week' => Post::whereBetween('created_at', [now()->subWeek(), now()])->count(),
            'month' => Post::whereMonth('created_at', now()->month)->count(),
        ],
        'topAuthors' => User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get(),
    ];

    return view('admin.dashboard', $data);
}
```

---

## 10. مشروع كامل {#complete-project}

### مثال 26: نظام مدونة كامل

```php
<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->only(['create', 'store']);
    }

    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->when(request('category'), function ($query, $category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'excerpt' => Str::limit($request->body, 150),
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'published_at' => $request->published ? now() : null,
        ]);

        // رفع صورة
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->update(['image' => $path]);
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'تم نشر المقال بنجاح!');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category', 'comments.user']);
        $post->increment('views');

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::orderBy('name')->get();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'excerpt' => Str::limit($request->body, 150),
            'category_id' => $request->category_id,
            'published_at' => $request->published ? ($post->published_at ?? now()) : null,
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $path = $request->file('image')->store('posts', 'public');
            $post->update(['image' => $path]);
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'تم تحديث المقال بنجاح!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // حذف الصورة
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'تم حذف المقال بنجاح!');
    }
}
```

**Form Requests:**

```php
<?php
// app/Http/Requests/StorePostRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:posts,title',
            'body' => 'required|min:100',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'published' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'title.unique' => 'هذا العنوان موجود مسبقاً',
            'body.required' => 'المحتوى مطلوب',
            'body.min' => 'المحتوى يجب أن يكون 100 حرف على الأقل',
        ];
    }
}
```

**Routes:**

```php
// routes/web.php
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);

// أو بشكل مفصل:
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
```

---

## 🎯 أوامر مفيدة

```bash
# إنشاء controller
php artisan make:controller PostController

# إنشاء resource controller
php artisan make:controller PostController --resource

# إنشاء API controller
php artisan make:controller API/PostController --api

# إنشاء invokable controller
php artisan make:controller ShowPost --invokable

# إنشاء controller مع model
php artisan make:controller PostController --model=Post

# إنشاء controller مع resource و model
php artisan make:controller PostController --resource --model=Post

# عرض جميع routes
php artisan route:list

# عرض routes محددة
php artisan route:list --name=posts
```

---

## 📚 مصادر إضافية

- [Laravel Controllers Documentation](https://laravel.com/docs/controllers)
- [Resource Controllers](https://laravel.com/docs/controllers#resource-controllers)
- [Form Requests](https://laravel.com/docs/validation#form-request-validation)

---

**الدرس التالي**: Views و Blade 🎨
