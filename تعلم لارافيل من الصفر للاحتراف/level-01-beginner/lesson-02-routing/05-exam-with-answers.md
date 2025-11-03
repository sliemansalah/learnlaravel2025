# الدرس الثاني - الاختبار مع الإجابات: Routing في Laravel

## 📋 معلومات الاختبار

- **عدد الأسئلة**: 50 سؤال
- **الوقت المقدر**: 60 دقيقة
- **الدرجة الكلية**: 100 درجة
- **درجة النجاح**: 70%

---

## القسم الأول: أسئلة الاختيار من متعدد (30 سؤال × 2 درجة = 60 درجة)

### السؤال 1
ما هو Routing في Laravel؟

A) نظام لإدارة قواعد البيانات
B) آلية لتحديد كيفية استجابة التطبيق للطلبات
C) محرك قوالب العرض
D) أداة لتشفير البيانات

**الإجابة الصحيحة: B**

**التفسير**: Routing هو نظام يحدد كيفية استجابة التطبيق للطلبات القادمة على مسارات (URLs) معينة.

---

### السؤال 2
أين يتم تعريف Web Routes في Laravel؟

A) app/routes.php
B) config/routes.php
C) routes/web.php
D) resources/routes.php

**الإجابة الصحيحة: C**

**التفسير**: Web routes يتم تعريفها في ملف `routes/web.php`.

---

### السؤال 3
ما الأمر الصحيح لتعريف GET route؟

A) Route::get('/about', function() { });
B) Route::create('/about', function() { });
C) Route::make('/about', function() { });
D) Route::path('/about', function() { });

**الإجابة الصحيحة: A**

**التفسير**: نستخدم `Route::get()` لتعريف route يستجيب لـ GET requests.

---

### السؤال 4
أي HTTP Method يُستخدم لإنشاء مورد جديد؟

A) GET
B) POST
C) PUT
D) DELETE

**الإجابة الصحيحة: B**

**التفسير**: POST يُستخدم لإرسال بيانات جديدة وإنشاء موارد.

---

### السؤال 5
ما الطريقة الصحيحة لتعريف route parameter إلزامي؟

A) Route::get('/users/:id')
B) Route::get('/users/{id}')
C) Route::get('/users/[id]')
D) Route::get('/users/<id>')

**الإجابة الصحيحة: B**

**التفسير**: Route parameters تُكتب داخل أقواس معقوفة `{parameter}`.

---

### السؤال 6
كيف تُعرّف route parameter اختياري؟

A) Route::get('/users/{name}')
B) Route::get('/users/{name*}')
C) Route::get('/users/{name?}')
D) Route::get('/users/{name|optional}')

**الإجابة الصحيحة: C**

**التفسير**: علامة الاستفهام `?` تجعل parameter اختيارياً: `{name?}`.

---

### السؤال 7
ما الطريقة الصحيحة لتطبيق قيد على route parameter ليكون أرقاماً فقط؟

A) ->where('id', 'numbers')
B) ->where('id', '[0-9]+')
C) ->where('id', 'numeric')
D) ->constraint('id', 'numbers')

**الإجابة الصحيحة: B**

**التفسير**: نستخدم regular expression: `->where('id', '[0-9]+')` أو `->whereNumber('id')`.

---

### السؤال 8
ما فائدة Named Routes؟

A) تسريع الموقع
B) سهولة إنشاء روابط وإعادة التوجيه
C) تحسين الأمان
D) تقليل حجم الملفات

**الإجابة الصحيحة: B**

**التفسير**: Named Routes تسهل إنشاء الروابط وإعادة التوجيه بدون كتابة URLs مباشرة.

---

### السؤال 9
كيف تُسمي route؟

A) Route::get('/profile')->setName('profile')
B) Route::get('/profile')->named('profile')
C) Route::get('/profile')->name('profile')
D) Route::get('/profile')->title('profile')

**الإجابة الصحيحة: C**

**التفسير**: نستخدم `->name('name')` لتسمية route.

---

### السؤال 10
ما الطريقة الصحيحة لإنشاء رابط لـ named route في Blade؟

A) <a href="route('profile')">
B) <a href="{{ route('profile') }}">
C) <a href="@route('profile')">
D) <a href="{!! route('profile') !!}">

**الإجابة الصحيحة: B**

**التفسير**: نستخدم `{{ route('name') }}` في Blade لتوليد URL.

---

### السؤال 11
ما فائدة Route Groups؟

A) تجميع routes بخصائص مشتركة
B) تسريع تحميل Routes
C) إخفاء Routes من المستخدمين
D) تشفير Routes

**الإجابة الصحيحة: A**

**التفسير**: Route Groups تجمع routes تشترك في middleware، prefix، أو خصائص أخرى.

---

### السؤال 12
كيف تضيف prefix لمجموعة routes؟

A) Route::group(['prefix' => 'admin'])
B) Route::prefix('admin')->group()
C) Route::addPrefix('admin')->group()
D) A و B صحيحة

**الإجابة الصحيحة: D**

**التفسير**: كلا الطريقتين صحيحة، لكن `Route::prefix()` أكثر شيوعاً.

---

### السؤال 13
ما الأمر الصحيح لإنشاء redirect route؟

A) Route::redirect('/old', '/new')
B) Route::forward('/old', '/new')
C) Route::move('/old', '/new')
D) Route::transfer('/old', '/new')

**الإجابة الصحيحة: A**

**التفسير**: `Route::redirect()` يُنشئ route لإعادة التوجيه التلقائية.

---

### السؤال 14
ما status code الافتراضي لـ Route::redirect()؟

A) 200
B) 301
C) 302
D) 404

**الإجابة الصحيحة: C**

**التفسير**: الافتراضي هو 302 (temporary redirect)، يمكن تغييره إلى 301.

---

### السؤال 15
كيف تعرض view مباشرة بدون controller؟

A) Route::show('/about', 'about')
B) Route::display('/about', 'about')
C) Route::view('/about', 'about')
D) Route::render('/about', 'about')

**الإجابة الصحيحة: C**

**التفسير**: `Route::view()` تعرض view مباشرة بدون الحاجة لـ controller.

---

### السؤال 16
ما المقصود بـ Route Model Binding؟

A) ربط route بـ controller
B) جلب Model تلقائياً من قاعدة البيانات بناءً على parameter
C) ربط routes بـ middleware
D) إنشاء routes تلقائياً من Models

**الإجابة الصحيحة: B**

**التفسير**: Route Model Binding يجلب Model تلقائياً بناءً على route parameter.

---

### السؤال 17
ما الطريقة الصحيحة لاستخدام Route Model Binding؟

A) Route::get('/users/{id}', function($id) { })
B) Route::get('/users/{user}', function(User $user) { })
C) Route::get('/users/{user}', function($user) { })
D) Route::get('/users/{user:id}', function($user) { })

**الإجابة الصحيحة: B**

**التفسير**: نستخدم type-hint للـ Model: `function(User $user)`.

---

### السؤال 18
كيف تستخدم عمود مخصص (مثل slug) في Route Model Binding؟

A) Route::get('/posts/{post:slug}')
B) Route::get('/posts/{post.slug}')
C) Route::get('/posts/{post}')->column('slug')
D) Route::get('/posts/{post}')->where('slug')

**الإجابة الصحيحة: A**

**التفسير**: نستخدم `:` لتحديد العمود: `{post:slug}`.

---

### السؤال 19
أين يتم تعريف API Routes؟

A) routes/web.php
B) routes/api.php
C) routes/rest.php
D) app/Http/routes.php

**الإجابة الصحيحة: B**

**التفسير**: API routes يتم تعريفها في `routes/api.php`.

---

### السؤال 20
ما prefix الافتراضي لـ API routes؟

A) /rest
B) /api
C) /v1
D) لا يوجد prefix

**الإجابة الصحيحة: B**

**التفسير**: Laravel يضيف `/api` تلقائياً لجميع routes في `api.php`.

---

### السؤال 21
ما الأمر لعرض جميع Routes المعرفة؟

A) php artisan routes
B) php artisan list:routes
C) php artisan route:list
D) php artisan show:routes

**الإجابة الصحيحة: C**

**التفسير**: `php artisan route:list` يعرض جميع routes مع تفاصيلها.

---

### السؤال 22
ما فائدة Route Caching؟

A) حماية Routes من الاختراق
B) تسريع تحميل Routes في الإنتاج
C) تشفير Routes
D) إخفاء Routes من المستخدمين

**الإجابة الصحيحة: B**

**التفسير**: Route Caching يخزن routes مؤقتاً لتسريع التطبيق في بيئة الإنتاج.

---

### السؤال 23
ما الأمر لتخزين Routes مؤقتاً؟

A) php artisan cache:routes
B) php artisan route:save
C) php artisan route:cache
D) php artisan optimize:routes

**الإجابة الصحيحة: C**

**التفسير**: `php artisan route:cache` يخزن routes في ملف مؤقت.

---

### السؤال 24
متى يجب استخدام Route::match()؟

A) عندما تريد route يقبل HTTP methods متعددة
B) عندما تريد route يقبل parameters متعددة
C) عندما تريد مطابقة pattern معين
D) عندما تريد route مع middleware

**الإجابة الصحيحة: A**

**التفسير**: `Route::match()` يُستخدم لتعريف route يقبل عدة HTTP methods.

---

### السؤال 25
ما الفرق بين Route::match() و Route::any()؟

A) لا يوجد فرق
B) match يقبل methods محددة، any يقبل جميع methods
C) any أسرع من match
D) match للـ web، any للـ API

**الإجابة الصحيحة: B**

**التفسير**: `match()` يقبل methods محددة، `any()` يقبل جميع HTTP methods.

---

### السؤال 26
ما الطريقة الصحيحة لتطبيق middleware على route؟

A) Route::get('/admin')->addMiddleware('auth')
B) Route::get('/admin')->middleware('auth')
C) Route::get('/admin')->protect('auth')
D) Route::get('/admin')->guard('auth')

**الإجابة الصحيحة: B**

**التفسير**: نستخدم `->middleware('name')` لتطبيق middleware.

---

### السؤال 27
كيف تطبق عدة middlewares على route واحد؟

A) ->middleware('auth', 'verified')
B) ->middleware(['auth', 'verified'])
C) ->middlewares('auth', 'verified')
D) A و B صحيحة

**الإجابة الصحيحة: D**

**التفسير**: كلا الطريقتين صحيحة، لكن array أوضح.

---

### السؤال 28
ما المقصود بـ Fallback Route؟

A) route احتياطي في حالة فشل routes أخرى
B) route يتم تنفيذه عند عدم مطابقة أي route (404)
C) route يعيد المحاولة تلقائياً
D) route للـ errors

**الإجابة الصحيحة: B**

**التفسير**: Fallback route يتم تنفيذه عندما لا يتطابق أي route آخر (مثل صفحة 404 مخصصة).

---

### السؤال 29
أين يجب وضع Fallback Route؟

A) في بداية ملف routes
B) في منتصف ملف routes
C) في نهاية ملف routes
D) لا يهم الموضع

**الإجابة الصحيحة: C**

**التفسير**: Fallback route يجب أن يكون آخر route لأنه يطابق أي طلب لم يطابق routes سابقة.

---

### السؤال 30
ما الطريقة الصحيحة لإرجاع JSON response؟

A) return json(['data' => $data])
B) return response()->json(['data' => $data])
C) return Response::json(['data' => $data])
D) B و C صحيحة

**الإجابة الصحيحة: D**

**التفسير**: كلا الطريقتين صحيحة لإرجاع JSON response.

---

## القسم الثاني: أسئلة صح أو خطأ (20 سؤال × 1 درجة = 20 درجة)

### السؤال 31
Routes في Laravel يمكن أن تُعرّف في أي ملف داخل مجلد routes.

**الإجابة: صح ✓**

**التفسير**: يمكن إنشاء ملفات routes إضافية، لكن يجب تسجيلها في `RouteServiceProvider`.

---

### السؤال 32
جميع API routes تبدأ تلقائياً بـ /api.

**الإجابة: صح ✓**

**التفسير**: Laravel يضيف prefix `/api` تلقائياً لجميع routes في `api.php`.

---

### السؤال 33
Route parameters يجب أن تكون دائماً إلزامية.

**الإجابة: خطأ ✗**

**التفسير**: يمكن جعل parameters اختيارية باستخدام `?` مثل `{name?}`.

---

### السؤال 34
يمكن استخدام نفس اسم route لأكثر من route.

**الإجابة: خطأ ✗**

**التفسير**: أسماء routes يجب أن تكون فريدة في التطبيق.

---

### السؤال 35
Route::view() يمكن أن يمرر بيانات إلى View.

**الإجابة: صح ✓**

**التفسير**: `Route::view('/about', 'about', ['title' => 'من نحن'])` يمرر بيانات.

---

### السؤال 36
PUT و PATCH لهما نفس الوظيفة تماماً.

**الإجابة: خطأ ✗**

**التفسير**: PUT للتحديث الكامل، PATCH للتحديث الجزئي (عرفياً).

---

### السؤال 37
Route Model Binding يعمل فقط مع id.

**الإجابة: خطأ ✗**

**التفسير**: يمكن استخدام أي عمود مثل slug باستخدام `{post:slug}` أو `getRouteKeyName()`.

---

### السؤال 38
يمكن تطبيق middleware على Route Group.

**الإجابة: صح ✓**

**التفسير**: `Route::middleware('auth')->group(function() { })`.

---

### السؤال 39
Route Caching يعمل مع Closures في Routes.

**الإجابة: خطأ ✗**

**التفسير**: Route Caching لا يعمل مع Closures، يجب استخدام Controllers.

---

### السؤال 40
whereNumber() و whereAlpha() هي shortcuts لـ where() مع regex.

**الإجابة: صح ✓**

**التفسير**: هي helpers تسهل كتابة regular expressions شائعة.

---

### السؤال 41
يمكن إنشاء Subdomain Routing في Laravel.

**الإجابة: صح ✓**

**التفسير**: `Route::domain('admin.example.com')->group()` للـ subdomain routing.

---

### السؤال 42
Named Routes تجعل الكود أكثر مرونة وسهولة في الصيانة.

**الإجابة: صح ✓**

**التفسير**: إذا تغير URL، تحتاج فقط لتغييره في مكان واحد (route definition).

---

### السؤال 43
Route::redirect() يمكن أن يُرجع status code 301 (permanent redirect).

**الإجابة: صح ✓**

**التفسير**: `Route::redirect('/old', '/new', 301)` أو `Route::permanentRedirect()`.

---

### السؤال 44
API Routes لها CSRF protection افتراضياً.

**الإجابة: خطأ ✗**

**التفسير**: API routes (في api.php) لا تحتوي على CSRF middleware افتراضياً.

---

### السؤال 45
يمكن استخدام Regular Expressions في Route Parameters.

**الإجابة: صح ✓**

**التفسير**: `->where('id', '[0-9]+')` يطبق regex على parameter.

---

### السؤال 46
Route Model Binding يرمي 404 تلقائياً إذا لم يجد Model.

**الإجابة: صح ✓**

**التفسير**: Laravel يستخدم `findOrFail()` تلقائياً ويرمي ModelNotFoundException (404).

---

### السؤال 47
Route Groups يمكن أن تكون متداخلة (Nested).

**الإجابة: صح ✓**

**التفسير**: يمكن إنشاء groups داخل groups للتنظيم الأفضل.

---

### السؤال 48
Global Route Patterns تطبق على جميع routes تلقائياً.

**الإجابة: صح ✓**

**التفسير**: `Route::pattern('id', '[0-9]+')` في `RouteServiceProvider` يطبق على كل parameter اسمه `id`.

---

### السؤال 49
يمكن الحصول على اسم Route الحالي باستخدام request()->routeIs().

**الإجابة: صح ✓**

**التفسير**: `request()->routeIs('posts.index')` للتحقق من route الحالي.

---

### السؤال 50
Rate Limiting يمكن تطبيقه على Routes.

**الإجابة: صح ✓**

**التفسير**: `->middleware('throttle:60,1')` يحدد عدد الطلبات المسموحة.

---

## القسم الثالث: أسئلة مقالية قصيرة (5 أسئلة × 4 درجات = 20 درجة)

### السؤال 51
اكتب الكود الكامل لـ Route Group يحتوي على:
- Prefix: `/admin`
- Name prefix: `admin.`
- Middleware: `auth` و `admin`
- Routes: dashboard, users, posts

**الإجابة النموذجية:**

```php
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/users', function () {
            return view('admin.users');
        })->name('users');

        Route::get('/posts', function () {
            return view('admin.posts');
        })->name('posts');
    });
```

**الدرجة**: 4 درجات (1 لكل عنصر: prefix, name, middleware, routes)

---

### السؤال 52
اشرح الفرق بين Implicit و Explicit Route Model Binding مع مثال لكل منهما.

**الإجابة النموذجية:**

**Implicit Binding (الضمني)**:
Laravel يجلب Model تلقائياً بناءً على type-hint:

```php
Route::get('/posts/{post}', function (Post $post) {
    return $post;
});
```

Laravel يبحث تلقائياً في `Post` table عن record بـ id = parameter.

**Explicit Binding (الصريح)**:
نحدد يدوياً كيف يتم جلب Model في `RouteServiceProvider`:

```php
Route::bind('post', function ($value) {
    return Post::where('slug', $value)->firstOrFail();
});
```

**الدرجة**: 4 درجات (1 للشرح، 1 لمثال implicit، 1 لمثال explicit، 1 للفرق)

---

### السؤال 53
اكتب كود API Route كامل يقبل POST request لإنشاء post جديد، مع:
- Validation للـ title و body
- إرجاع JSON response مع status code 201

**الإجابة النموذجية:**

```php
Route::post('/posts', function () {
    $validated = request()->validate([
        'title' => 'required|max:255',
        'body' => 'required'
    ]);

    $post = Post::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Post created successfully',
        'data' => $post
    ], 201);
});
```

**الدرجة**: 4 درجات (1 للـ route، 1 للـ validation، 1 للـ response، 1 للـ status code)

---

### السؤال 54
ما الفرق بين `routes/web.php` و `routes/api.php`؟ اذكر 3 فروقات على الأقل.

**الإجابة النموذجية:**

1. **Middleware Groups**:
   - `web.php`: تطبق `web` middleware group (sessions, CSRF, cookies)
   - `api.php`: تطبق `api` middleware group (stateless, rate limiting)

2. **Prefix**:
   - `web.php`: لا يوجد prefix افتراضي
   - `api.php`: يبدأ تلقائياً بـ `/api`

3. **CSRF Protection**:
   - `web.php`: تطبق CSRF protection للـ POST/PUT/DELETE
   - `api.php`: لا تطبق CSRF (لأن APIs stateless)

4. **Response Type** (إضافي):
   - `web.php`: عادة تُرجع views (HTML)
   - `api.php`: عادة تُرجع JSON

**الدرجة**: 4 درجات (1.33 لكل فرق، 3 فروقات مطلوبة)

---

### السؤال 55
اكتب الأوامر الثلاثة المهمة لإدارة Route Cache واشرح متى يجب استخدام كل منها.

**الإجابة النموذجية:**

```bash
# 1. تخزين routes مؤقتاً
php artisan route:cache
```
**الاستخدام**: في بيئة الإنتاج لتسريع التطبيق. **لا تستخدمه** في التطوير لأنك تحتاج لتشغيله بعد كل تغيير.

```bash
# 2. مسح route cache
php artisan route:clear
```
**الاستخدام**: عند تغيير routes في بيئة الإنتاج أو عند حدوث مشاكل مع cached routes.

```bash
# 3. عرض جميع routes
php artisan route:list
```
**الاستخدام**: للتحقق من جميع routes المعرفة وتفاصيلها (في أي بيئة).

**الدرجة**: 4 درجات (1 لكل أمر، 0.33 لكل شرح)

---

## 🎯 ملخص الدرجات

- **القسم الأول**: 30 سؤال × 2 = 60 درجة
- **القسم الثاني**: 20 سؤال × 1 = 20 درجة
- **القسم الثالث**: 5 أسئلة × 4 = 20 درجة
- **المجموع الكلي**: **100 درجة**

---

## 📊 معايير التقييم

- **90-100**: ممتاز - فهم عميق للـ Routing
- **80-89**: جيد جداً - فهم قوي مع بعض النقاط للتحسين
- **70-79**: جيد - فهم جيد، يحتاج لمزيد من التمرين
- **60-69**: مقبول - يحتاج لمراجعة بعض المفاهيم
- **أقل من 60**: راسب - يحتاج لإعادة دراسة الدرس

---

**بالتوفيق في الاختبار!** 🚀
