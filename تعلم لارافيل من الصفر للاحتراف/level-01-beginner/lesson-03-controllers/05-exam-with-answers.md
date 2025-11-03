# الدرس الثالث - الاختبار مع الإجابات: Controllers في Laravel

## 📋 معلومات الاختبار

- **عدد الأسئلة**: 50 سؤال
- **الوقت المقدر**: 60 دقيقة
- **الدرجة الكلية**: 100 درجة
- **درجة النجاح**: 70%

---

## القسم الأول: أسئلة الاختيار من متعدد (30 سؤال × 2 درجة = 60 درجة)

### السؤال 1
ما هو Controller في Laravel؟

A) ملف يحتوي على Views
B) class يحتوي على منطق معالجة الطلبات
C) ملف لتخزين البيانات
D) أداة لإنشاء قاعدة البيانات

**الإجابة الصحيحة: B**

**التفسير**: Controller هو class يحتوي على المنطق الخاص بمعالجة الطلبات وتنظيم التفاعل بين Models و Views.

---

### السؤال 2
ما الأمر الصحيح لإنشاء Controller؟

A) php artisan create:controller PostController
B) php artisan make:controller PostController
C) php artisan new:controller PostController
D) php artisan generate:controller PostController

**الإجابة الصحيحة: B**

**التفسير**: الأمر الصحيح هو `php artisan make:controller PostController`.

---

### السؤال 3
أين يتم حفظ Controllers في Laravel؟

A) app/Controllers/
B) app/Http/Controllers/
C) resources/controllers/
D) routes/controllers/

**الإجابة الصحيحة: B**

**التفسير**: Controllers يتم حفظها في مجلد `app/Http/Controllers/`.

---

### السؤال 4
كم عدد methods الافتراضية في Resource Controller؟

A) 5 methods
B) 6 methods
C) 7 methods
D) 8 methods

**الإجابة الصحيحة: C**

**التفسير**: Resource Controller يحتوي على 7 methods: index, create, store, show, edit, update, destroy.

---

### السؤال 5
ما الأمر لإنشاء Resource Controller؟

A) php artisan make:controller PostController
B) php artisan make:controller PostController --resource
C) php artisan make:controller PostController -r
D) B و C صحيحة

**الإجابة الصحيحة: D**

**التفسير**: كلا `--resource` و `-r` صحيحة لإنشاء Resource Controller.

---

### السؤال 6
ما method في Resource Controller المسؤول عن عرض قائمة العناصر؟

A) list()
B) index()
C) show()
D) get()

**الإجابة الصحيحة: B**

**التفسير**: Method `index()` مسؤول عن عرض قائمة جميع العناصر.

---

### السؤال 7
ما method المسؤول عن عرض نموذج إنشاء عنصر جديد؟

A) new()
B) form()
C) create()
D) add()

**الإجابة الصحيحة: C**

**التفسير**: Method `create()` مسؤول عن عرض نموذج (form) لإنشاء عنصر جديد.

---

### السؤال 8
ما method المسؤول عن حفظ عنصر جديد في قاعدة البيانات؟

A) save()
B) create()
C) store()
D) insert()

**الإجابة الصحيحة: C**

**التفسير**: Method `store()` مسؤول عن حفظ عنصر جديد في قاعدة البيانات.

---

### السؤال 9
ما HTTP Method المستخدم مع store() في Resource Controller؟

A) GET
B) POST
C) PUT
D) DELETE

**الإجابة الصحيحة: B**

**التفسير**: `store()` يستخدم POST لإنشاء عنصر جديد.

---

### السؤال 10
ما method المسؤول عن حذف عنصر؟

A) remove()
B) delete()
C) destroy()
D) drop()

**الإجابة الصحيحة: C**

**التفسير**: Method `destroy()` مسؤول عن حذف عنصر من قاعدة البيانات.

---

### السؤال 11
كم method يحتوي API Resource Controller؟

A) 4 methods
B) 5 methods
C) 6 methods
D) 7 methods

**الإجابة الصحيحة: B**

**التفسير**: API Controller يحتوي على 5 methods فقط (بدون create و edit): index, store, show, update, destroy.

---

### السؤال 12
ما الأمر لإنشاء API Controller؟

A) php artisan make:controller API/PostController
B) php artisan make:controller PostController --api
C) php artisan make:controller PostController --rest
D) php artisan make:controller PostController --json

**الإجابة الصحيحة: B**

**التفسير**: الأمر الصحيح هو `php artisan make:controller PostController --api`.

---

### السؤال 13
ما اسم method الوحيد في Single Action Controller؟

A) handle()
B) execute()
C) __invoke()
D) run()

**الإجابة الصحيحة: C**

**التفسير**: Single Action Controller يستخدم `__invoke()` كـ method وحيد.

---

### السؤال 14
ما الأمر لإنشاء Single Action Controller؟

A) php artisan make:controller ShowPost --single
B) php artisan make:controller ShowPost --invokable
C) php artisan make:controller ShowPost --one
D) php artisan make:controller ShowPost --action

**الإجابة الصحيحة: B**

**التفسير**: الأمر الصحيح هو `php artisan make:controller ShowPost --invokable`.

---

### السؤال 15
ما الطريقة الصحيحة لربط Route بـ Controller في Laravel 8+؟

A) Route::get('/posts', 'PostController@index')
B) Route::get('/posts', [PostController::class, 'index'])
C) Route::get('/posts', PostController->index)
D) Route::get('/posts', PostController::index)

**الإجابة الصحيحة: B**

**التفسير**: الطريقة الحديثة في Laravel 8+ هي: `Route::get('/posts', [PostController::class, 'index'])`.

---

### السؤال 16
ما الطريقة الصحيحة لاستخدام Route Model Binding؟

A) public function show($id)
B) public function show(Post $post)
C) public function show(Model $post)
D) public function show(int $post)

**الإجابة الصحيحة: B**

**التفسير**: الطريقة الصحيحة هي type-hint للـ Model: `public function show(Post $post)`.

---

### السؤال 17
ما المقصود بـ Dependency Injection في Controllers؟

A) إضافة dependencies يدوياً
B) حقن dependencies تلقائياً بواسطة Laravel
C) استيراد classes في بداية الملف
D) إنشاء dependencies في constructor

**الإجابة الصحيحة: B**

**التفسير**: Dependency Injection هو حقن dependencies تلقائياً بواسطة Laravel Service Container.

---

### السؤال 18
كيف تحقن Request في method؟

A) public function store($request)
B) public function store(Request $request)
C) public function store(Input $request)
D) public function store(Form $request)

**الإجابة الصحيحة: B**

**التفسير**: تستخدم type-hint: `public function store(Request $request)`.

---

### السؤال 19
ما الطريقة الصحيحة لتطبيق Middleware على Controller؟

A) في constructor: $this->middleware('auth')
B) في method: @middleware('auth')
C) في Model: protected $middleware = ['auth']
D) في config: 'middleware' => ['auth']

**الإجابة الصحيحة: A**

**التفسير**: الطريقة الصحيحة هي في `__construct()`: `$this->middleware('auth')`.

---

### السؤال 20
كيف تطبق Middleware على methods محددة فقط؟

A) $this->middleware('auth')->for(['index', 'show'])
B) $this->middleware('auth')->only(['index', 'show'])
C) $this->middleware('auth')->methods(['index', 'show'])
D) $this->middleware('auth')->apply(['index', 'show'])

**الإجابة الصحيحة: B**

**التفسير**: تستخدم `only()`: `$this->middleware('auth')->only(['index', 'show'])`.

---

### السؤال 21
ما الطريقة الصحيحة لتمرير البيانات إلى View؟

A) return view('posts', $posts)
B) return view('posts')->data('posts', $posts)
C) return view('posts', compact('posts'))
D) return view('posts')->send('posts', $posts)

**الإجابة الصحيحة: C**

**التفسير**: الطريقة الصحيحة هي: `return view('posts', compact('posts'))`.

---

### السؤال 22
ما المقصود بـ 'Thin Controllers'؟

A) controllers صغيرة الحجم
B) controllers بدون methods كثيرة
C) controllers تحتوي على منطق بسيط فقط
D) controllers سريعة التنفيذ

**الإجابة الصحيحة: C**

**التفسير**: Thin Controllers تعني إبقاء Controllers بسيطة ونقل المنطق المعقد إلى Service Classes.

---

### السؤال 23
أين يجب وضع المنطق المعقد بدلاً من Controller؟

A) في View
B) في Route
C) في Service Class
D) في Migration

**الإجابة الصحيحة: C**

**التفسير**: المنطق المعقد يجب أن يكون في Service Classes أو Repositories.

---

### السؤال 24
ما الطريقة الصحيحة لإرجاع JSON response؟

A) return json(['data' => $posts])
B) return response()->json(['data' => $posts])
C) return response(['data' => $posts])->json()
D) return json_encode(['data' => $posts])

**الإجابة الصحيحة: B**

**التفسير**: الطريقة الصحيحة هي: `return response()->json(['data' => $posts])`.

---

### السؤال 25
كيف تعيد redirect إلى route محدد؟

A) return redirect('posts.index')
B) return redirect()->to('posts.index')
C) return redirect()->route('posts.index')
D) return back()->route('posts.index')

**الإجابة الصحيحة: C**

**التفسير**: الطريقة الصحيحة هي: `return redirect()->route('posts.index')`.

---

### السؤال 26
كيف تمرر رسالة مع redirect؟

A) return redirect()->route('posts.index', 'Success')
B) return redirect()->route('posts.index')->message('Success')
C) return redirect()->route('posts.index')->with('success', 'Success')
D) return redirect()->route('posts.index')->flash('Success')

**الإجابة الصحيحة: C**

**التفسير**: الطريقة الصحيحة هي: `->with('success', 'Success')`.

---

### السؤال 27
ما الطريقة الصحيحة لتعريف Resource Route؟

A) Route::resources('posts', PostController::class)
B) Route::resource('posts', PostController::class)
C) Route::crud('posts', PostController::class)
D) Route::restful('posts', PostController::class)

**الإجابة الصحيحة: B**

**التفسير**: الطريقة الصحيحة هي: `Route::resource('posts', PostController::class)`.

---

### السؤال 28
كيف تحدد Routes معينة فقط من Resource Controller؟

A) ->select(['index', 'show'])
B) ->only(['index', 'show'])
C) ->methods(['index', 'show'])
D) ->allow(['index', 'show'])

**الإجابة الصحيحة: B**

**التفسير**: تستخدم `only()`: `Route::resource()->only(['index', 'show'])`.

---

### السؤال 29
كيف تستثني Routes معينة من Resource Controller؟

A) ->except(['destroy'])
B) ->without(['destroy'])
C) ->ignore(['destroy'])
D) ->skip(['destroy'])

**الإجابة الصحيحة: A**

**التفسير**: تستخدم `except()`: `Route::resource()->except(['destroy'])`.

---

### السؤال 30
ما أفضل ممارسة للـ validation في Controllers؟

A) كتابة validation مباشرة في Controller
B) استخدام Form Request Classes
C) عدم استخدام validation
D) كتابة validation في View

**الإجابة الصحيحة: B**

**التفسير**: أفضل ممارسة هي استخدام Form Request Classes لفصل validation logic.

---

## القسم الثاني: أسئلة صح أو خطأ (20 سؤال × 1 درجة = 20 درجة)

### السؤال 31
Controllers في Laravel يجب أن ترث من Controller base class.

**الإجابة: صح ✓**

**التفسير**: جميع Controllers يجب أن ترث من `App\Http\Controllers\Controller`.

---

### السؤال 32
يمكن وضع Controllers في أي مجلد في Laravel.

**الإجابة: خطأ ✗**

**التفسير**: Controllers يجب أن تكون في `app/Http/Controllers/` أو مجلد فرعي منه.

---

### السؤال 33
Resource Controller يحتوي على 5 methods.

**الإجابة: خطأ ✗**

**التفسير**: Resource Controller يحتوي على 7 methods.

---

### السؤال 34
يمكن إنشاء Controller بدون استخدام Artisan command.

**الإجابة: صح ✓**

**التفسير**: يمكن إنشاء Controller يدوياً، لكن Artisan أسهل وأسرع.

---

### السؤال 35
Route::resource() تنشئ 7 routes تلقائياً.

**الإجابة: صح ✓**

**التفسير**: `Route::resource()` تنشئ 7 routes لجميع CRUD operations.

---

### السؤال 36
API Controller يحتوي على create() و edit() methods.

**الإجابة: خطأ ✗**

**التفسير**: API Controller لا يحتوي على create و edit لأن APIs لا تحتاج views.

---

### السؤال 37
Single Action Controller يحتوي على method واحد فقط اسمه __invoke().

**الإجابة: صح ✓**

**التفسير**: Single Action Controller يستخدم `__invoke()` كـ method وحيد.

---

### السؤال 38
يمكن استخدام Middleware في Constructor فقط.

**الإجابة: خطأ ✗**

**التفسير**: يمكن تطبيق Middleware في Constructor أو في Routes.

---

### السؤال 39
Route Model Binding يجلب Model تلقائياً من قاعدة البيانات.

**الإجابة: صح ✓**

**التفسير**: Route Model Binding يجلب Model تلقائياً بناءً على route parameter.

---

### السؤال 40
Laravel يدعم Dependency Injection في Controllers تلقائياً.

**الإجابة: صح ✓**

**التفسير**: Laravel Service Container يحقن Dependencies تلقائياً.

---

### السؤال 41
يجب استخدام compact() دائماً لتمرير البيانات إلى View.

**الإجابة: خطأ ✗**

**التفسير**: `compact()` طريقة واحدة فقط، يمكن استخدام array أو `with()` أيضاً.

---

### السؤال 42
index() method مسؤول عن عرض قائمة جميع العناصر.

**الإجابة: صح ✓**

**التفسير**: `index()` يعرض قائمة جميع العناصر.

---

### السؤال 43
create() method مسؤول عن حفظ عنصر جديد.

**الإجابة: خطأ ✗**

**التفسير**: `create()` يعرض نموذج الإنشاء، `store()` يحفظ البيانات.

---

### السؤال 44
store() method يستخدم GET request.

**الإجابة: خطأ ✗**

**التفسير**: `store()` يستخدم POST request.

---

### السؤال 45
update() method يستخدم PUT أو PATCH.

**الإجابة: صح ✓**

**التفسير**: `update()` يستخدم PUT أو PATCH لتحديث البيانات.

---

### السؤال 46
destroy() method يستخدم DELETE request.

**الإجابة: صح ✓**

**التفسير**: `destroy()` يستخدم DELETE request لحذف عنصر.

---

### السؤال 47
يمكن استخدام only() لتحديد methods معينة في Resource Controller.

**الإجابة: صح ✓**

**التفسير**: `only()` تستخدم لتحديد methods معينة فقط.

---

### السؤال 48
Controller يجب أن يحتوي على منطق معقد للتطبيق.

**الإجابة: خطأ ✗**

**التفسير**: Controllers يجب أن تكون 'thin' والمنطق المعقد يذهب إلى Service Classes.

---

### السؤال 49
Form Request Classes أفضل من validation مباشرة في Controller.

**الإجابة: صح ✓**

**التفسير**: Form Requests تفصل validation logic وتجعل Controller أنظف.

---

### السؤال 50
Route Model Binding يعمل فقط مع id.

**الإجابة: خطأ ✗**

**التفسير**: يمكن استخدام أي عمود مثل slug باستخدام `{post:slug}` أو `getRouteKeyName()`.

---

## القسم الثالث: أسئلة مقالية قصيرة (5 أسئلة × 4 درجات = 20 درجة)

### السؤال 51
اكتب Resource Controller كامل لإدارة المقالات (Posts) مع جميع الـ 7 methods. استخدم Route Model Binding و validation مناسب.

**الإجابة النموذجية:**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
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
            'body' => 'required',
        ]);

        $post = Post::create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'تم إنشاء المقال');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'تم التحديث');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'تم الحذف');
    }
}
```

**الدرجة**: 4 درجات (0.5 لكل method صحيح)

---

### السؤال 52
اشرح الفرق بين Resource Controller و API Resource Controller. اذكر 3 فروقات مع أمثلة.

**الإجابة النموذجية:**

**1. عدد Methods:**
- Resource Controller: 7 methods (index, create, store, show, edit, update, destroy)
- API Controller: 5 methods (بدون create و edit)

**2. الغرض:**
- Resource Controller: لتطبيقات web التي تحتاج views
- API Controller: لـ APIs التي تُرجع JSON فقط

**3. أمر الإنشاء:**
```bash
# Resource Controller
php artisan make:controller PostController --resource

# API Controller
php artisan make:controller API/PostController --api
```

**الدرجة**: 4 درجات (1.33 لكل فرق مع مثال)

---

### السؤال 53
اكتب مثال على استخدام Dependency Injection في Controller. احقن Service class في constructor واستخدمه في methods.

**الإجابة النموذجية:**

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

**الدرجة**: 4 درجات (1 للـ constructor، 1 للـ property، 2 للاستخدام في methods)

---

### السؤال 54
اشرح مفهوم "Thin Controllers" وكيف تحقق ذلك في Laravel. أعطِ مثالاً على controller "سميك" وكيف تحوله إلى "نحيف".

**الإجابة النموذجية:**

**Thin Controllers** تعني إبقاء Controllers بسيطة تحتوي فقط على:
- استقبال Request
- استدعاء Service/Repository
- إرجاع Response

**مثال Controller سميك:**
```php
public function store(Request $request)
{
    $validated = $request->validate([...]);
    $post = Post::create($validated);
    $post->tags()->attach($request->tags);
    event(new PostCreated($post));
    Cache::forget('posts');
    Mail::to($admin)->send(new NewPost($post));
    return redirect()->route('posts.show', $post);
}
```

**Controller نحيف مع Service:**
```php
public function store(Request $request, PostService $service)
{
    $post = $service->createPost($request->validated());
    return redirect()->route('posts.show', $post);
}
```

**الدرجة**: 4 درجات (1 للشرح، 1.5 للمثال السميك، 1.5 للنحيف)

---

### السؤال 55
اكتب API Controller method كامل للـ update مع:
- Route Model Binding
- Validation
- Error handling
- JSON response مع status code مناسب

**الإجابة النموذجية:**

```php
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function update(Request $request, Post $post)
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|max:255',
                'body' => 'sometimes',
            ]);

            $post->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'data' => $post->fresh()
            ], Response::HTTP_OK);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
```

**الدرجة**: 4 درجات (1 للـ binding، 1 للـ validation، 1 للـ error handling، 1 للـ response)

---

## 🎯 ملخص الدرجات

- **القسم الأول**: 30 سؤال × 2 = 60 درجة
- **القسم الثاني**: 20 سؤال × 1 = 20 درجة
- **القسم الثالث**: 5 أسئلة × 4 = 20 درجة
- **المجموع الكلي**: **100 درجة**

---

## 📊 معايير التقييم

- **90-100**: ممتاز - فهم عميق للـ Controllers
- **80-89**: جيد جداً - فهم قوي مع بعض النقاط للتحسين
- **70-79**: جيد - فهم جيد، يحتاج لمزيد من التمرين
- **60-69**: مقبول - يحتاج لمراجعة بعض المفاهيم
- **أقل من 60**: راسب - يحتاج لإعادة دراسة الدرس

---

**بالتوفيق في الاختبار!** 🚀
