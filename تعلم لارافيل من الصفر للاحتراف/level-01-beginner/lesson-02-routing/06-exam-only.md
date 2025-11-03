# الدرس الثاني - الاختبار: Routing في Laravel

## 📋 معلومات الاختبار

- **عدد الأسئلة**: 50 سؤال
- **الوقت المقدر**: 60 دقيقة
- **الدرجة الكلية**: 100 درجة
- **درجة النجاح**: 70%

**تعليمات:**
- اقرأ كل سؤال بعناية
- اختر الإجابة الأنسب
- يمكنك الرجوع للمادة النظرية إذا احتجت
- بعد الانتهاء، قارن إجاباتك بملف الإجابات النموذجية

---

## القسم الأول: أسئلة الاختيار من متعدد (30 سؤال × 2 درجة = 60 درجة)

### السؤال 1
ما هو Routing في Laravel؟

A) نظام لإدارة قواعد البيانات
B) آلية لتحديد كيفية استجابة التطبيق للطلبات
C) محرك قوالب العرض
D) أداة لتشفير البيانات

**الإجابة**: ___________

---

### السؤال 2
أين يتم تعريف Web Routes في Laravel؟

A) app/routes.php
B) config/routes.php
C) routes/web.php
D) resources/routes.php

**الإجابة**: ___________

---

### السؤال 3
ما الأمر الصحيح لتعريف GET route؟

A) Route::get('/about', function() { });
B) Route::create('/about', function() { });
C) Route::make('/about', function() { });
D) Route::path('/about', function() { });

**الإجابة**: ___________

---

### السؤال 4
أي HTTP Method يُستخدم لإنشاء مورد جديد؟

A) GET
B) POST
C) PUT
D) DELETE

**الإجابة**: ___________

---

### السؤال 5
ما الطريقة الصحيحة لتعريف route parameter إلزامي؟

A) Route::get('/users/:id')
B) Route::get('/users/{id}')
C) Route::get('/users/[id]')
D) Route::get('/users/<id>')

**الإجابة**: ___________

---

### السؤال 6
كيف تُعرّف route parameter اختياري؟

A) Route::get('/users/{name}')
B) Route::get('/users/{name*}')
C) Route::get('/users/{name?}')
D) Route::get('/users/{name|optional}')

**الإجابة**: ___________

---

### السؤال 7
ما الطريقة الصحيحة لتطبيق قيد على route parameter ليكون أرقاماً فقط؟

A) ->where('id', 'numbers')
B) ->where('id', '[0-9]+')
C) ->where('id', 'numeric')
D) ->constraint('id', 'numbers')

**الإجابة**: ___________

---

### السؤال 8
ما فائدة Named Routes؟

A) تسريع الموقع
B) سهولة إنشاء روابط وإعادة التوجيه
C) تحسين الأمان
D) تقليل حجم الملفات

**الإجابة**: ___________

---

### السؤال 9
كيف تُسمي route؟

A) Route::get('/profile')->setName('profile')
B) Route::get('/profile')->named('profile')
C) Route::get('/profile')->name('profile')
D) Route::get('/profile')->title('profile')

**الإجابة**: ___________

---

### السؤال 10
ما الطريقة الصحيحة لإنشاء رابط لـ named route في Blade؟

A) <a href="route('profile')">
B) <a href="{{ route('profile') }}">
C) <a href="@route('profile')">
D) <a href="{!! route('profile') !!}">

**الإجابة**: ___________

---

### السؤال 11
ما فائدة Route Groups؟

A) تجميع routes بخصائص مشتركة
B) تسريع تحميل Routes
C) إخفاء Routes من المستخدمين
D) تشفير Routes

**الإجابة**: ___________

---

### السؤال 12
كيف تضيف prefix لمجموعة routes؟

A) Route::group(['prefix' => 'admin'])
B) Route::prefix('admin')->group()
C) Route::addPrefix('admin')->group()
D) A و B صحيحة

**الإجابة**: ___________

---

### السؤال 13
ما الأمر الصحيح لإنشاء redirect route؟

A) Route::redirect('/old', '/new')
B) Route::forward('/old', '/new')
C) Route::move('/old', '/new')
D) Route::transfer('/old', '/new')

**الإجابة**: ___________

---

### السؤال 14
ما status code الافتراضي لـ Route::redirect()؟

A) 200
B) 301
C) 302
D) 404

**الإجابة**: ___________

---

### السؤال 15
كيف تعرض view مباشرة بدون controller؟

A) Route::show('/about', 'about')
B) Route::display('/about', 'about')
C) Route::view('/about', 'about')
D) Route::render('/about', 'about')

**الإجابة**: ___________

---

### السؤال 16
ما المقصود بـ Route Model Binding؟

A) ربط route بـ controller
B) جلب Model تلقائياً من قاعدة البيانات بناءً على parameter
C) ربط routes بـ middleware
D) إنشاء routes تلقائياً من Models

**الإجابة**: ___________

---

### السؤال 17
ما الطريقة الصحيحة لاستخدام Route Model Binding؟

A) Route::get('/users/{id}', function($id) { })
B) Route::get('/users/{user}', function(User $user) { })
C) Route::get('/users/{user}', function($user) { })
D) Route::get('/users/{user:id}', function($user) { })

**الإجابة**: ___________

---

### السؤال 18
كيف تستخدم عمود مخصص (مثل slug) في Route Model Binding؟

A) Route::get('/posts/{post:slug}')
B) Route::get('/posts/{post.slug}')
C) Route::get('/posts/{post}')->column('slug')
D) Route::get('/posts/{post}')->where('slug')

**الإجابة**: ___________

---

### السؤال 19
أين يتم تعريف API Routes؟

A) routes/web.php
B) routes/api.php
C) routes/rest.php
D) app/Http/routes.php

**الإجابة**: ___________

---

### السؤال 20
ما prefix الافتراضي لـ API routes؟

A) /rest
B) /api
C) /v1
D) لا يوجد prefix

**الإجابة**: ___________

---

### السؤال 21
ما الأمر لعرض جميع Routes المعرفة؟

A) php artisan routes
B) php artisan list:routes
C) php artisan route:list
D) php artisan show:routes

**الإجابة**: ___________

---

### السؤال 22
ما فائدة Route Caching؟

A) حماية Routes من الاختراق
B) تسريع تحميل Routes في الإنتاج
C) تشفير Routes
D) إخفاء Routes من المستخدمين

**الإجابة**: ___________

---

### السؤال 23
ما الأمر لتخزين Routes مؤقتاً؟

A) php artisan cache:routes
B) php artisan route:save
C) php artisan route:cache
D) php artisan optimize:routes

**الإجابة**: ___________

---

### السؤال 24
متى يجب استخدام Route::match()؟

A) عندما تريد route يقبل HTTP methods متعددة
B) عندما تريد route يقبل parameters متعددة
C) عندما تريد مطابقة pattern معين
D) عندما تريد route مع middleware

**الإجابة**: ___________

---

### السؤال 25
ما الفرق بين Route::match() و Route::any()؟

A) لا يوجد فرق
B) match يقبل methods محددة، any يقبل جميع methods
C) any أسرع من match
D) match للـ web، any للـ API

**الإجابة**: ___________

---

### السؤال 26
ما الطريقة الصحيحة لتطبيق middleware على route؟

A) Route::get('/admin')->addMiddleware('auth')
B) Route::get('/admin')->middleware('auth')
C) Route::get('/admin')->protect('auth')
D) Route::get('/admin')->guard('auth')

**الإجابة**: ___________

---

### السؤال 27
كيف تطبق عدة middlewares على route واحد؟

A) ->middleware('auth', 'verified')
B) ->middleware(['auth', 'verified'])
C) ->middlewares('auth', 'verified')
D) A و B صحيحة

**الإجابة**: ___________

---

### السؤال 28
ما المقصود بـ Fallback Route؟

A) route احتياطي في حالة فشل routes أخرى
B) route يتم تنفيذه عند عدم مطابقة أي route (404)
C) route يعيد المحاولة تلقائياً
D) route للـ errors

**الإجابة**: ___________

---

### السؤال 29
أين يجب وضع Fallback Route؟

A) في بداية ملف routes
B) في منتصف ملف routes
C) في نهاية ملف routes
D) لا يهم الموضع

**الإجابة**: ___________

---

### السؤال 30
ما الطريقة الصحيحة لإرجاع JSON response؟

A) return json(['data' => $data])
B) return response()->json(['data' => $data])
C) return Response::json(['data' => $data])
D) B و C صحيحة

**الإجابة**: ___________

---

## القسم الثاني: أسئلة صح أو خطأ (20 سؤال × 1 درجة = 20 درجة)

### السؤال 31
Routes في Laravel يمكن أن تُعرّف في أي ملف داخل مجلد routes.

**الإجابة**: ___________

---

### السؤال 32
جميع API routes تبدأ تلقائياً بـ /api.

**الإجابة**: ___________

---

### السؤال 33
Route parameters يجب أن تكون دائماً إلزامية.

**الإجابة**: ___________

---

### السؤال 34
يمكن استخدام نفس اسم route لأكثر من route.

**الإجابة**: ___________

---

### السؤال 35
Route::view() يمكن أن يمرر بيانات إلى View.

**الإجابة**: ___________

---

### السؤال 36
PUT و PATCH لهما نفس الوظيفة تماماً.

**الإجابة**: ___________

---

### السؤال 37
Route Model Binding يعمل فقط مع id.

**الإجابة**: ___________

---

### السؤال 38
يمكن تطبيق middleware على Route Group.

**الإجابة**: ___________

---

### السؤال 39
Route Caching يعمل مع Closures في Routes.

**الإجابة**: ___________

---

### السؤال 40
whereNumber() و whereAlpha() هي shortcuts لـ where() مع regex.

**الإجابة**: ___________

---

### السؤال 41
يمكن إنشاء Subdomain Routing في Laravel.

**الإجابة**: ___________

---

### السؤال 42
Named Routes تجعل الكود أكثر مرونة وسهولة في الصيانة.

**الإجابة**: ___________

---

### السؤال 43
Route::redirect() يمكن أن يُرجع status code 301 (permanent redirect).

**الإجابة**: ___________

---

### السؤال 44
API Routes لها CSRF protection افتراضياً.

**الإجابة**: ___________

---

### السؤال 45
يمكن استخدام Regular Expressions في Route Parameters.

**الإجابة**: ___________

---

### السؤال 46
Route Model Binding يرمي 404 تلقائياً إذا لم يجد Model.

**الإجابة**: ___________

---

### السؤال 47
Route Groups يمكن أن تكون متداخلة (Nested).

**الإجابة**: ___________

---

### السؤال 48
Global Route Patterns تطبق على جميع routes تلقائياً.

**الإجابة**: ___________

---

### السؤال 49
يمكن الحصول على اسم Route الحالي باستخدام request()->routeIs().

**الإجابة**: ___________

---

### السؤال 50
Rate Limiting يمكن تطبيقه على Routes.

**الإجابة**: ___________

---

## القسم الثالث: أسئلة مقالية قصيرة (5 أسئلة × 4 درجات = 20 درجة)

### السؤال 51
اكتب الكود الكامل لـ Route Group يحتوي على:
- Prefix: `/admin`
- Name prefix: `admin.`
- Middleware: `auth` و `admin`
- Routes: dashboard, users, posts

**الإجابة:**

```php
// اكتب الكود هنا














```

---

### السؤال 52
اشرح الفرق بين Implicit و Explicit Route Model Binding مع مثال لكل منهما.

**الإجابة:**

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

---

### السؤال 53
اكتب كود API Route كامل يقبل POST request لإنشاء post جديد، مع:
- Validation للـ title و body
- إرجاع JSON response مع status code 201

**الإجابة:**

```php
// اكتب الكود هنا














```

---

### السؤال 54
ما الفرق بين `routes/web.php` و `routes/api.php`؟ اذكر 3 فروقات على الأقل.

**الإجابة:**

1. ___________________________________________________________________

2. ___________________________________________________________________

3. ___________________________________________________________________

---

### السؤال 55
اكتب الأوامر الثلاثة المهمة لإدارة Route Cache واشرح متى يجب استخدام كل منها.

**الإجابة:**

**الأمر 1:**
```bash

```
**الاستخدام:** ___________________________________________________________

**الأمر 2:**
```bash

```
**الاستخدام:** ___________________________________________________________

**الأمر 3:**
```bash

```
**الاستخدام:** ___________________________________________________________

---

## 🎯 جدول الإجابات السريع

| السؤال | الإجابة | السؤال | الإجابة | السؤال | الإجابة |
|---------|----------|---------|----------|---------|----------|
| 1       |          | 18      |          | 35      |          |
| 2       |          | 19      |          | 36      |          |
| 3       |          | 20      |          | 37      |          |
| 4       |          | 21      |          | 38      |          |
| 5       |          | 22      |          | 39      |          |
| 6       |          | 23      |          | 40      |          |
| 7       |          | 24      |          | 41      |          |
| 8       |          | 25      |          | 42      |          |
| 9       |          | 26      |          | 43      |          |
| 10      |          | 27      |          | 44      |          |
| 11      |          | 28      |          | 45      |          |
| 12      |          | 29      |          | 46      |          |
| 13      |          | 30      |          | 47      |          |
| 14      |          | 31      |          | 48      |          |
| 15      |          | 32      |          | 49      |          |
| 16      |          | 33      |          | 50      |          |
| 17      |          | 34      |          |         |          |

---

## 📊 حساب الدرجات

- **القسم الأول (1-30)**: _____ / 60
- **القسم الثاني (31-50)**: _____ / 20
- **القسم الثالث (51-55)**: _____ / 20
- **المجموع الكلي**: _____ / 100

---

## 📝 ملاحظات

بعد الانتهاء من الاختبار:
1. قارن إجاباتك بملف `05-exam-with-answers.md`
2. احسب درجتك الكلية
3. راجع الأسئلة التي أخطأت فيها
4. ارجع للمادة النظرية إذا احتجت توضيح

---

**بالتوفيق!** 🚀
