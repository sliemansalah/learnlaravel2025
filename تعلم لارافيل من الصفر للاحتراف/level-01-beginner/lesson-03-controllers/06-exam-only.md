# الدرس الثالث - الاختبار: Controllers في Laravel

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
ما هو Controller في Laravel؟

A) ملف يحتوي على Views
B) class يحتوي على منطق معالجة الطلبات
C) ملف لتخزين البيانات
D) أداة لإنشاء قاعدة البيانات

**الإجابة**: ___________

---

### السؤال 2
ما الأمر الصحيح لإنشاء Controller؟

A) php artisan create:controller PostController
B) php artisan make:controller PostController
C) php artisan new:controller PostController
D) php artisan generate:controller PostController

**الإجابة**: ___________

---

### السؤال 3
أين يتم حفظ Controllers في Laravel؟

A) app/Controllers/
B) app/Http/Controllers/
C) resources/controllers/
D) routes/controllers/

**الإجابة**: ___________

---

### السؤال 4
كم عدد methods الافتراضية في Resource Controller؟

A) 5 methods
B) 6 methods
C) 7 methods
D) 8 methods

**الإجابة**: ___________

---

### السؤال 5
ما الأمر لإنشاء Resource Controller؟

A) php artisan make:controller PostController
B) php artisan make:controller PostController --resource
C) php artisan make:controller PostController -r
D) B و C صحيحة

**الإجابة**: ___________

---

### السؤال 6
ما method في Resource Controller المسؤول عن عرض قائمة العناصر؟

A) list()
B) index()
C) show()
D) get()

**الإجابة**: ___________

---

### السؤال 7
ما method المسؤول عن عرض نموذج إنشاء عنصر جديد؟

A) new()
B) form()
C) create()
D) add()

**الإجابة**: ___________

---

### السؤال 8
ما method المسؤول عن حفظ عنصر جديد في قاعدة البيانات؟

A) save()
B) create()
C) store()
D) insert()

**الإجابة**: ___________

---

### السؤال 9
ما HTTP Method المستخدم مع store() في Resource Controller؟

A) GET
B) POST
C) PUT
D) DELETE

**الإجابة**: ___________

---

### السؤال 10
ما method المسؤول عن حذف عنصر؟

A) remove()
B) delete()
C) destroy()
D) drop()

**الإجابة**: ___________

---

### السؤال 11
كم method يحتوي API Resource Controller؟

A) 4 methods
B) 5 methods
C) 6 methods
D) 7 methods

**الإجابة**: ___________

---

### السؤال 12
ما الأمر لإنشاء API Controller؟

A) php artisan make:controller API/PostController
B) php artisan make:controller PostController --api
C) php artisan make:controller PostController --rest
D) php artisan make:controller PostController --json

**الإجابة**: ___________

---

### السؤال 13
ما اسم method الوحيد في Single Action Controller؟

A) handle()
B) execute()
C) __invoke()
D) run()

**الإجابة**: ___________

---

### السؤال 14
ما الأمر لإنشاء Single Action Controller؟

A) php artisan make:controller ShowPost --single
B) php artisan make:controller ShowPost --invokable
C) php artisan make:controller ShowPost --one
D) php artisan make:controller ShowPost --action

**الإجابة**: ___________

---

### السؤال 15
ما الطريقة الصحيحة لربط Route بـ Controller في Laravel 8+؟

A) Route::get('/posts', 'PostController@index')
B) Route::get('/posts', [PostController::class, 'index'])
C) Route::get('/posts', PostController->index)
D) Route::get('/posts', PostController::index)

**الإجابة**: ___________

---

### السؤال 16
ما الطريقة الصحيحة لاستخدام Route Model Binding؟

A) public function show($id)
B) public function show(Post $post)
C) public function show(Model $post)
D) public function show(int $post)

**الإجابة**: ___________

---

### السؤال 17
ما المقصود بـ Dependency Injection في Controllers؟

A) إضافة dependencies يدوياً
B) حقن dependencies تلقائياً بواسطة Laravel
C) استيراد classes في بداية الملف
D) إنشاء dependencies في constructor

**الإجابة**: ___________

---

### السؤال 18
كيف تحقن Request في method؟

A) public function store($request)
B) public function store(Request $request)
C) public function store(Input $request)
D) public function store(Form $request)

**الإجابة**: ___________

---

### السؤال 19
ما الطريقة الصحيحة لتطبيق Middleware على Controller؟

A) في constructor: $this->middleware('auth')
B) في method: @middleware('auth')
C) في Model: protected $middleware = ['auth']
D) في config: 'middleware' => ['auth']

**الإجابة**: ___________

---

### السؤال 20
كيف تطبق Middleware على methods محددة فقط؟

A) $this->middleware('auth')->for(['index', 'show'])
B) $this->middleware('auth')->only(['index', 'show'])
C) $this->middleware('auth')->methods(['index', 'show'])
D) $this->middleware('auth')->apply(['index', 'show'])

**الإجابة**: ___________

---

### السؤال 21
ما الطريقة الصحيحة لتمرير البيانات إلى View؟

A) return view('posts', $posts)
B) return view('posts')->data('posts', $posts)
C) return view('posts', compact('posts'))
D) return view('posts')->send('posts', $posts)

**الإجابة**: ___________

---

### السؤال 22
ما المقصود بـ 'Thin Controllers'؟

A) controllers صغيرة الحجم
B) controllers بدون methods كثيرة
C) controllers تحتوي على منطق بسيط فقط
D) controllers سريعة التنفيذ

**الإجابة**: ___________

---

### السؤال 23
أين يجب وضع المنطق المعقد بدلاً من Controller؟

A) في View
B) في Route
C) في Service Class
D) في Migration

**الإجابة**: ___________

---

### السؤال 24
ما الطريقة الصحيحة لإرجاع JSON response؟

A) return json(['data' => $posts])
B) return response()->json(['data' => $posts])
C) return response(['data' => $posts])->json()
D) return json_encode(['data' => $posts])

**الإجابة**: ___________

---

### السؤال 25
كيف تعيد redirect إلى route محدد؟

A) return redirect('posts.index')
B) return redirect()->to('posts.index')
C) return redirect()->route('posts.index')
D) return back()->route('posts.index')

**الإجابة**: ___________

---

### السؤال 26
كيف تمرر رسالة مع redirect؟

A) return redirect()->route('posts.index', 'Success')
B) return redirect()->route('posts.index')->message('Success')
C) return redirect()->route('posts.index')->with('success', 'Success')
D) return redirect()->route('posts.index')->flash('Success')

**الإجابة**: ___________

---

### السؤال 27
ما الطريقة الصحيحة لتعريف Resource Route؟

A) Route::resources('posts', PostController::class)
B) Route::resource('posts', PostController::class)
C) Route::crud('posts', PostController::class)
D) Route::restful('posts', PostController::class)

**الإجابة**: ___________

---

### السؤال 28
كيف تحدد Routes معينة فقط من Resource Controller؟

A) ->select(['index', 'show'])
B) ->only(['index', 'show'])
C) ->methods(['index', 'show'])
D) ->allow(['index', 'show'])

**الإجابة**: ___________

---

### السؤال 29
كيف تستثني Routes معينة من Resource Controller؟

A) ->except(['destroy'])
B) ->without(['destroy'])
C) ->ignore(['destroy'])
D) ->skip(['destroy'])

**الإجابة**: ___________

---

### السؤال 30
ما أفضل ممارسة للـ validation في Controllers؟

A) كتابة validation مباشرة في Controller
B) استخدام Form Request Classes
C) عدم استخدام validation
D) كتابة validation في View

**الإجابة**: ___________

---

## القسم الثاني: أسئلة صح أو خطأ (20 سؤال × 1 درجة = 20 درجة)

### السؤال 31
Controllers في Laravel يجب أن ترث من Controller base class.

**الإجابة**: ___________

---

### السؤال 32
يمكن وضع Controllers في أي مجلد في Laravel.

**الإجابة**: ___________

---

### السؤال 33
Resource Controller يحتوي على 5 methods.

**الإجابة**: ___________

---

### السؤال 34
يمكن إنشاء Controller بدون استخدام Artisan command.

**الإجابة**: ___________

---

### السؤال 35
Route::resource() تنشئ 7 routes تلقائياً.

**الإجابة**: ___________

---

### السؤال 36
API Controller يحتوي على create() و edit() methods.

**الإجابة**: ___________

---

### السؤال 37
Single Action Controller يحتوي على method واحد فقط اسمه __invoke().

**الإجابة**: ___________

---

### السؤال 38
يمكن استخدام Middleware في Constructor فقط.

**الإجابة**: ___________

---

### السؤال 39
Route Model Binding يجلب Model تلقائياً من قاعدة البيانات.

**الإجابة**: ___________

---

### السؤال 40
Laravel يدعم Dependency Injection في Controllers تلقائياً.

**الإجابة**: ___________

---

### السؤال 41
يجب استخدام compact() دائماً لتمرير البيانات إلى View.

**الإجابة**: ___________

---

### السؤال 42
index() method مسؤول عن عرض قائمة جميع العناصر.

**الإجابة**: ___________

---

### السؤال 43
create() method مسؤول عن حفظ عنصر جديد.

**الإجابة**: ___________

---

### السؤال 44
store() method يستخدم GET request.

**الإجابة**: ___________

---

### السؤال 45
update() method يستخدم PUT أو PATCH.

**الإجابة**: ___________

---

### السؤال 46
destroy() method يستخدم DELETE request.

**الإجابة**: ___________

---

### السؤال 47
يمكن استخدام only() لتحديد methods معينة في Resource Controller.

**الإجابة**: ___________

---

### السؤال 48
Controller يجب أن يحتوي على منطق معقد للتطبيق.

**الإجابة**: ___________

---

### السؤال 49
Form Request Classes أفضل من validation مباشرة في Controller.

**الإجابة**: ___________

---

### السؤال 50
Route Model Binding يعمل فقط مع id.

**الإجابة**: ___________

---

## القسم الثالث: أسئلة مقالية قصيرة (5 أسئلة × 4 درجات = 20 درجة)

### السؤال 51
اكتب Resource Controller كامل لإدارة المقالات (Posts) مع جميع الـ 7 methods. استخدم Route Model Binding و validation مناسب.

**الإجابة:**

```php
// اكتب الكود هنا


























```

---

### السؤال 52
اشرح الفرق بين Resource Controller و API Resource Controller. اذكر 3 فروقات مع أمثلة.

**الإجابة:**

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

---

### السؤال 53
اكتب مثال على استخدام Dependency Injection في Controller. احقن Service class في constructor واستخدمه في methods.

**الإجابة:**

```php
// اكتب الكود هنا


















```

---

### السؤال 54
اشرح مفهوم "Thin Controllers" وكيف تحقق ذلك في Laravel. أعطِ مثالاً على controller "سميك" وكيف تحوله إلى "نحيف".

**الإجابة:**

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

___________________________________________________________________________

---

### السؤال 55
اكتب API Controller method كامل للـ update مع:
- Route Model Binding
- Validation
- Error handling
- JSON response مع status code مناسب

**الإجابة:**

```php
// اكتب الكود هنا


























```

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
