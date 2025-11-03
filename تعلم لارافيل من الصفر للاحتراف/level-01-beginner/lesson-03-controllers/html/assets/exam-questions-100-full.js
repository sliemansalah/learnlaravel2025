/**
 * Laravel Learning - Lesson 03: Controllers
 * Advanced Exam Questions - 100 Questions
 *
 * Structure:
 * - 40 Multiple Choice Questions (1-40) = 40 points
 * - 40 True/False Questions (41-80) = 40 points
 * - 12 Fill in the Blank (81-92) = 12 points
 * - 8 Command Questions (93-100) = 8 points
 * Total: 100 Questions = 100 Points
 */

const advancedExamQuestions = [
    // ============================================
    // Multiple Choice Questions (1-40) - 40 Points
    // ============================================
    {
        id: 1,
        type: "multiple-choice",
        question: "ما هو Controller في Laravel؟",
        options: [
            "ملف يحتوي على Views",
            "class يحتوي على منطق معالجة الطلبات",
            "ملف لتخزين البيانات",
            "أداة لإنشاء قاعدة البيانات"
        ],
        correctAnswer: 1,
        explanation: "Controller هو class يحتوي على المنطق الخاص بمعالجة الطلبات (requests) وتنظيم التفاعل بين Models و Views",
        points: 1
    },
    {
        id: 2,
        type: "multiple-choice",
        question: "ما الأمر الصحيح لإنشاء Controller؟",
        options: [
            "php artisan create:controller PostController",
            "php artisan make:controller PostController",
            "php artisan new:controller PostController",
            "php artisan generate:controller PostController"
        ],
        correctAnswer: 1,
        explanation: "الأمر الصحيح هو: php artisan make:controller PostController",
        points: 1
    },
    {
        id: 3,
        type: "multiple-choice",
        question: "أين يتم حفظ Controllers في Laravel؟",
        options: [
            "app/Controllers/",
            "app/Http/Controllers/",
            "resources/controllers/",
            "routes/controllers/"
        ],
        correctAnswer: 1,
        explanation: "Controllers يتم حفظها في مجلد app/Http/Controllers/",
        points: 1
    },
    {
        id: 4,
        type: "multiple-choice",
        question: "ما الطريقة الصحيحة لربط Route بـ Controller في Laravel 8+؟",
        options: [
            "Route::get('/posts', 'PostController@index')",
            "Route::get('/posts', [PostController::class, 'index'])",
            "Route::get('/posts', PostController->index)",
            "Route::get('/posts', PostController::index)"
        ],
        correctAnswer: 1,
        explanation: "الطريقة الحديثة في Laravel 8+ هي: Route::get('/posts', [PostController::class, 'index'])",
        points: 1
    },
    {
        id: 5,
        type: "multiple-choice",
        question: "كم عدد methods الافتراضية في Resource Controller؟",
        options: [
            "5 methods",
            "6 methods",
            "7 methods",
            "8 methods"
        ],
        correctAnswer: 2,
        explanation: "Resource Controller يحتوي على 7 methods: index, create, store, show, edit, update, destroy",
        points: 1
    },
    {
        id: 6,
        type: "multiple-choice",
        question: "ما الأمر لإنشاء Resource Controller؟",
        options: [
            "php artisan make:controller PostController",
            "php artisan make:controller PostController --resource",
            "php artisan make:controller PostController -r",
            "php artisan make:controller PostController --crud"
        ],
        correctAnswer: 1,
        explanation: "الأمر الصحيح هو: php artisan make:controller PostController --resource",
        points: 1
    },
    {
        id: 7,
        type: "multiple-choice",
        question: "ما الطريقة الصحيحة لتعريف Resource Route؟",
        options: [
            "Route::resources('posts', PostController::class)",
            "Route::resource('posts', PostController::class)",
            "Route::crud('posts', PostController::class)",
            "Route::restful('posts', PostController::class)"
        ],
        correctAnswer: 1,
        explanation: "الطريقة الصحيحة هي: Route::resource('posts', PostController::class)",
        points: 1
    },
    {
        id: 8,
        type: "multiple-choice",
        question: "ما method في Resource Controller المسؤول عن عرض قائمة العناصر؟",
        options: [
            "list()",
            "index()",
            "show()",
            "get()"
        ],
        correctAnswer: 1,
        explanation: "Method index() مسؤول عن عرض قائمة جميع العناصر",
        points: 1
    },
    {
        id: 9,
        type: "multiple-choice",
        question: "ما method المسؤول عن عرض نموذج إنشاء عنصر جديد؟",
        options: [
            "new()",
            "form()",
            "create()",
            "add()"
        ],
        correctAnswer: 2,
        explanation: "Method create() مسؤول عن عرض نموذج (form) لإنشاء عنصر جديد",
        points: 1
    },
    {
        id: 10,
        type: "multiple-choice",
        question: "ما method المسؤول عن حفظ عنصر جديد في قاعدة البيانات؟",
        options: [
            "save()",
            "create()",
            "store()",
            "insert()"
        ],
        correctAnswer: 2,
        explanation: "Method store() مسؤول عن حفظ عنصر جديد في قاعدة البيانات",
        points: 1
    },
    {
        id: 11,
        type: "multiple-choice",
        question: "ما HTTP Method المستخدم مع store() في Resource Controller؟",
        options: [
            "GET",
            "POST",
            "PUT",
            "DELETE"
        ],
        correctAnswer: 1,
        explanation: "store() يستخدم POST لإنشاء عنصر جديد",
        points: 1
    },
    {
        id: 12,
        type: "multiple-choice",
        question: "ما method المسؤول عن عرض عنصر منفرد؟",
        options: [
            "view()",
            "display()",
            "show()",
            "get()"
        ],
        correctAnswer: 2,
        explanation: "Method show() مسؤول عن عرض تفاصيل عنصر منفرد",
        points: 1
    },
    {
        id: 13,
        type: "multiple-choice",
        question: "ما method المسؤول عن عرض نموذج تعديل عنصر؟",
        options: [
            "modify()",
            "update()",
            "edit()",
            "change()"
        ],
        correctAnswer: 2,
        explanation: "Method edit() مسؤول عن عرض نموذج (form) لتعديل عنصر موجود",
        points: 1
    },
    {
        id: 14,
        type: "multiple-choice",
        question: "ما method المسؤول عن حفظ التعديلات في قاعدة البيانات؟",
        options: [
            "save()",
            "modify()",
            "update()",
            "edit()"
        ],
        correctAnswer: 2,
        explanation: "Method update() مسؤول عن حفظ التعديلات في قاعدة البيانات",
        points: 1
    },
    {
        id: 15,
        type: "multiple-choice",
        question: "ما HTTP Methods المستخدمة مع update()؟",
        options: [
            "GET و POST",
            "POST و DELETE",
            "PUT و PATCH",
            "PUT و DELETE"
        ],
        correctAnswer: 2,
        explanation: "update() يستخدم PUT أو PATCH لتحديث عنصر موجود",
        points: 1
    },
    {
        id: 16,
        type: "multiple-choice",
        question: "ما method المسؤول عن حذف عنصر؟",
        options: [
            "remove()",
            "delete()",
            "destroy()",
            "drop()"
        ],
        correctAnswer: 2,
        explanation: "Method destroy() مسؤول عن حذف عنصر من قاعدة البيانات",
        points: 1
    },
    {
        id: 17,
        type: "multiple-choice",
        question: "ما الأمر لإنشاء API Controller؟",
        options: [
            "php artisan make:controller API/PostController",
            "php artisan make:controller PostController --api",
            "php artisan make:controller PostController --rest",
            "php artisan make:controller PostController --json"
        ],
        correctAnswer: 1,
        explanation: "الأمر الصحيح هو: php artisan make:controller PostController --api",
        points: 1
    },
    {
        id: 18,
        type: "multiple-choice",
        question: "كم method يحتوي API Resource Controller؟",
        options: [
            "4 methods",
            "5 methods",
            "6 methods",
            "7 methods"
        ],
        correctAnswer: 1,
        explanation: "API Controller يحتوي على 5 methods فقط (بدون create و edit): index, store, show, update, destroy",
        points: 1
    },
    {
        id: 19,
        type: "multiple-choice",
        question: "ما الأمر لإنشاء Single Action Controller؟",
        options: [
            "php artisan make:controller ShowPost --single",
            "php artisan make:controller ShowPost --invokable",
            "php artisan make:controller ShowPost --one",
            "php artisan make:controller ShowPost --action"
        ],
        correctAnswer: 1,
        explanation: "الأمر الصحيح هو: php artisan make:controller ShowPost --invokable",
        points: 1
    },
    {
        id: 20,
        type: "multiple-choice",
        question: "ما اسم method الوحيد في Single Action Controller؟",
        options: [
            "handle()",
            "execute()",
            "__invoke()",
            "run()"
        ],
        correctAnswer: 2,
        explanation: "Single Action Controller يستخدم __invoke() كـ method وحيد",
        points: 1
    },
    {
        id: 21,
        type: "multiple-choice",
        question: "ما الطريقة الصحيحة لتمرير البيانات إلى View؟",
        options: [
            "return view('posts', $posts)",
            "return view('posts')->data('posts', $posts)",
            "return view('posts', compact('posts'))",
            "return view('posts')->send('posts', $posts)"
        ],
        correctAnswer: 2,
        explanation: "الطريقة الصحيحة هي: return view('posts', compact('posts'))",
        points: 1
    },
    {
        id: 22,
        type: "multiple-choice",
        question: "ما فائدة Route Model Binding؟",
        options: [
            "تسريع الاستعلامات",
            "جلب Model تلقائياً بناءً على parameter",
            "إنشاء Routes تلقائياً",
            "ربط Controllers بـ Models"
        ],
        correctAnswer: 1,
        explanation: "Route Model Binding يجلب Model تلقائياً بناءً على route parameter",
        points: 1
    },
    {
        id: 23,
        type: "multiple-choice",
        question: "ما الطريقة الصحيحة لاستخدام Route Model Binding؟",
        options: [
            "public function show($id)",
            "public function show(Post $post)",
            "public function show(Model $post)",
            "public function show(int $post)"
        ],
        correctAnswer: 1,
        explanation: "الطريقة الصحيحة هي type-hint للـ Model: public function show(Post $post)",
        points: 1
    },
    {
        id: 24,
        type: "multiple-choice",
        question: "كيف تغير المفتاح المستخدم في Route Model Binding من id إلى slug؟",
        options: [
            "في Route: Route::get('/posts/{post:slug}')",
            "في Controller: $this->setRouteKey('slug')",
            "في View: @bind('slug')",
            "في Migration: $table->slug()"
        ],
        correctAnswer: 0,
        explanation: "تستخدم Route::get('/posts/{post:slug}') لتحديد المفتاح",
        points: 1
    },
    {
        id: 25,
        type: "multiple-choice",
        question: "ما الطريقة الصحيحة لتطبيق Middleware على Controller؟",
        options: [
            "في constructor: $this->middleware('auth')",
            "في method: @middleware('auth')",
            "في Model: protected $middleware = ['auth']",
            "في config: 'middleware' => ['auth']"
        ],
        correctAnswer: 0,
        explanation: "الطريقة الصحيحة هي في __construct(): $this->middleware('auth')",
        points: 1
    },
    {
        id: 26,
        type: "multiple-choice",
        question: "كيف تطبق Middleware على methods محددة فقط؟",
        options: [
            "$this->middleware('auth')->for(['index', 'show'])",
            "$this->middleware('auth')->only(['index', 'show'])",
            "$this->middleware('auth')->methods(['index', 'show'])",
            "$this->middleware('auth')->apply(['index', 'show'])"
        ],
        correctAnswer: 1,
        explanation: "تستخدم only(): $this->middleware('auth')->only(['index', 'show'])",
        points: 1
    },
    {
        id: 27,
        type: "multiple-choice",
        question: "ما المقصود بـ Dependency Injection في Controllers؟",
        options: [
            "إضافة dependencies يدوياً",
            "حقن dependencies تلقائياً بواسطة Laravel",
            "استيراد classes في بداية الملف",
            "إنشاء dependencies في constructor"
        ],
        correctAnswer: 1,
        explanation: "Dependency Injection هو حقن dependencies تلقائياً بواسطة Laravel Service Container",
        points: 1
    },
    {
        id: 28,
        type: "multiple-choice",
        question: "كيف تحقن Request في method؟",
        options: [
            "public function store($request)",
            "public function store(Request $request)",
            "public function store(Input $request)",
            "public function store(Form $request)"
        ],
        correctAnswer: 1,
        explanation: "تستخدم type-hint: public function store(Request $request)",
        points: 1
    },
    {
        id: 29,
        type: "multiple-choice",
        question: "ما المقصود بـ 'Thin Controllers'؟",
        options: [
            "controllers صغيرة الحجم",
            "controllers بدون methods كثيرة",
            "controllers تحتوي على منطق بسيط فقط",
            "controllers سريعة التنفيذ"
        ],
        correctAnswer: 2,
        explanation: "Thin Controllers تعني إبقاء Controllers بسيطة ونقل المنطق المعقد إلى Service Classes أو Repositories",
        points: 1
    },
    {
        id: 30,
        type: "multiple-choice",
        question: "أين يجب وضع المنطق المعقد بدلاً من Controller؟",
        options: [
            "في View",
            "في Route",
            "في Service Class",
            "في Migration"
        ],
        correctAnswer: 2,
        explanation: "المنطق المعقد يجب أن يكون في Service Classes أو Repositories",
        points: 1
    },
    {
        id: 31,
        type: "multiple-choice",
        question: "ما الطريقة الصحيحة لإرجاع JSON response في API Controller؟",
        options: [
            "return json(['data' => $posts])",
            "return response()->json(['data' => $posts])",
            "return response(['data' => $posts])->json()",
            "return json_encode(['data' => $posts])"
        ],
        correctAnswer: 1,
        explanation: "الطريقة الصحيحة هي: return response()->json(['data' => $posts])",
        points: 1
    },
    {
        id: 32,
        type: "multiple-choice",
        question: "كيف تعيد redirect إلى route محدد؟",
        options: [
            "return redirect('posts.index')",
            "return redirect()->to('posts.index')",
            "return redirect()->route('posts.index')",
            "return back()->route('posts.index')"
        ],
        correctAnswer: 2,
        explanation: "الطريقة الصحيحة هي: return redirect()->route('posts.index')",
        points: 1
    },
    {
        id: 33,
        type: "multiple-choice",
        question: "كيف تمرر رسالة مع redirect؟",
        options: [
            "return redirect()->route('posts.index', 'Success')",
            "return redirect()->route('posts.index')->message('Success')",
            "return redirect()->route('posts.index')->with('success', 'Success')",
            "return redirect()->route('posts.index')->flash('Success')"
        ],
        correctAnswer: 2,
        explanation: "الطريقة الصحيحة هي: ->with('success', 'Success')",
        points: 1
    },
    {
        id: 34,
        type: "multiple-choice",
        question: "ما الفرق بين Resource Controller و API Resource Controller؟",
        options: [
            "API Controller أسرع",
            "API Controller لا يحتوي على create و edit methods",
            "API Controller يعمل مع JSON فقط",
            "لا يوجد فرق"
        ],
        correctAnswer: 1,
        explanation: "API Controller لا يحتوي على create و edit لأن APIs لا تحتاج views",
        points: 1
    },
    {
        id: 35,
        type: "multiple-choice",
        question: "كيف تحدد Routes معينة فقط من Resource Controller؟",
        options: [
            "Route::resource('posts', PostController::class)->select(['index', 'show'])",
            "Route::resource('posts', PostController::class)->only(['index', 'show'])",
            "Route::resource('posts', PostController::class)->methods(['index', 'show'])",
            "Route::resource('posts', PostController::class)->allow(['index', 'show'])"
        ],
        correctAnswer: 1,
        explanation: "تستخدم only(): Route::resource()->only(['index', 'show'])",
        points: 1
    },
    {
        id: 36,
        type: "multiple-choice",
        question: "كيف تستثني Routes معينة من Resource Controller؟",
        options: [
            "->except(['destroy'])",
            "->without(['destroy'])",
            "->ignore(['destroy'])",
            "->skip(['destroy'])"
        ],
        correctAnswer: 0,
        explanation: "تستخدم except(): Route::resource()->except(['destroy'])",
        points: 1
    },
    {
        id: 37,
        type: "multiple-choice",
        question: "ما method في Model لتغيير المفتاح الافتراضي في Route Model Binding؟",
        options: [
            "getRouteKey()",
            "getRouteKeyName()",
            "setRouteKey()",
            "routeKey()"
        ],
        correctAnswer: 1,
        explanation: "تستخدم getRouteKeyName() في Model لتحديد المفتاح المستخدم",
        points: 1
    },
    {
        id: 38,
        type: "multiple-choice",
        question: "كيف تنشئ Controller في مجلد فرعي؟",
        options: [
            "php artisan make:controller Admin.PostController",
            "php artisan make:controller Admin/PostController",
            "php artisan make:controller Admin:PostController",
            "php artisan make:controller --path=Admin PostController"
        ],
        correctAnswer: 1,
        explanation: "تستخدم /: php artisan make:controller Admin/PostController",
        points: 1
    },
    {
        id: 39,
        type: "multiple-choice",
        question: "ما أفضل ممارسة للـ validation في Controllers؟",
        options: [
            "كتابة validation مباشرة في Controller",
            "استخدام Form Request Classes",
            "عدم استخدام validation",
            "كتابة validation في View"
        ],
        correctAnswer: 1,
        explanation: "أفضل ممارسة هي استخدام Form Request Classes لفصل validation logic",
        points: 1
    },
    {
        id: 40,
        type: "multiple-choice",
        question: "ما الأمر لعرض جميع Routes المعرفة في التطبيق؟",
        options: [
            "php artisan routes",
            "php artisan list:routes",
            "php artisan route:list",
            "php artisan show:routes"
        ],
        correctAnswer: 2,
        explanation: "الأمر الصحيح هو: php artisan route:list",
        points: 1
    },

    // ============================================
    // True/False Questions (41-80) - 40 Points
    // ============================================
    {
        id: 41,
        type: "true-false",
        question: "Controllers في Laravel يجب أن ترث من Controller base class",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - جميع Controllers يجب أن ترث من App\\Http\\Controllers\\Controller",
        points: 1
    },
    {
        id: 42,
        type: "true-false",
        question: "يمكن وضع Controllers في أي مجلد في Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Controllers يجب أن تكون في app/Http/Controllers/ أو مجلد فرعي منه",
        points: 1
    },
    {
        id: 43,
        type: "true-false",
        question: "Resource Controller يحتوي على 5 methods",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Resource Controller يحتوي على 7 methods",
        points: 1
    },
    {
        id: 44,
        type: "true-false",
        question: "يمكن إنشاء Controller بدون استخدام Artisan command",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - يمكن إنشاء Controller يدوياً، لكن Artisan أسهل وأسرع",
        points: 1
    },
    {
        id: 45,
        type: "true-false",
        question: "Route::resource() تنشئ 7 routes تلقائياً",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route::resource() تنشئ 7 routes لجميع CRUD operations",
        points: 1
    },
    {
        id: 46,
        type: "true-false",
        question: "API Controller يحتوي على create() و edit() methods",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - API Controller لا يحتوي على create و edit لأن APIs لا تحتاج views",
        points: 1
    },
    {
        id: 47,
        type: "true-false",
        question: "Single Action Controller يحتوي على method واحد فقط اسمه __invoke()",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Single Action Controller يستخدم __invoke() كـ method وحيد",
        points: 1
    },
    {
        id: 48,
        type: "true-false",
        question: "يمكن استخدام Middleware في Constructor فقط",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يمكن تطبيق Middleware في Constructor أو في Routes",
        points: 1
    },
    {
        id: 49,
        type: "true-false",
        question: "Route Model Binding يجلب Model تلقائياً من قاعدة البيانات",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route Model Binding يجلب Model تلقائياً بناءً على route parameter",
        points: 1
    },
    {
        id: 50,
        type: "true-false",
        question: "Laravel يدعم Dependency Injection في Controllers تلقائياً",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Laravel Service Container يحقن Dependencies تلقائياً",
        points: 1
    },
    {
        id: 51,
        type: "true-false",
        question: "يجب استخدام compact() دائماً لتمرير البيانات إلى View",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - compact() طريقة واحدة فقط، يمكن استخدام array أو with() أيضاً",
        points: 1
    },
    {
        id: 52,
        type: "true-false",
        question: "index() method مسؤول عن عرض قائمة جميع العناصر",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - index() يعرض قائمة جميع العناصر",
        points: 1
    },
    {
        id: 53,
        type: "true-false",
        question: "create() method مسؤول عن حفظ عنصر جديد",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - create() يعرض نموذج الإنشاء، store() يحفظ البيانات",
        points: 1
    },
    {
        id: 54,
        type: "true-false",
        question: "store() method يستخدم GET request",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - store() يستخدم POST request",
        points: 1
    },
    {
        id: 55,
        type: "true-false",
        question: "edit() method مسؤول عن حفظ التعديلات",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - edit() يعرض نموذج التعديل، update() يحفظ التعديلات",
        points: 1
    },
    {
        id: 56,
        type: "true-false",
        question: "update() method يستخدم PUT أو PATCH",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - update() يستخدم PUT أو PATCH لتحديث البيانات",
        points: 1
    },
    {
        id: 57,
        type: "true-false",
        question: "destroy() method يستخدم DELETE request",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - destroy() يستخدم DELETE request لحذف عنصر",
        points: 1
    },
    {
        id: 58,
        type: "true-false",
        question: "يمكن استخدام only() لتحديد methods معينة في Resource Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - only() تستخدم لتحديد methods معينة فقط",
        points: 1
    },
    {
        id: 59,
        type: "true-false",
        question: "except() تستخدم لاستثناء methods معينة من Resource Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - except() تستثني methods محددة من Resource Controller",
        points: 1
    },
    {
        id: 60,
        type: "true-false",
        question: "يمكن تطبيق Middleware على methods معينة باستخدام only()",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - $this->middleware('auth')->only(['create', 'store'])",
        points: 1
    },
    {
        id: 61,
        type: "true-false",
        question: "except() تستخدم لاستثناء methods من Middleware",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - $this->middleware('auth')->except(['index', 'show'])",
        points: 1
    },
    {
        id: 62,
        type: "true-false",
        question: "Controller يجب أن يحتوي على منطق معقد للتطبيق",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Controllers يجب أن تكون 'thin' والمنطق المعقد يذهب إلى Service Classes",
        points: 1
    },
    {
        id: 63,
        type: "true-false",
        question: "يمكن كتابة استعلامات قاعدة البيانات المعقدة مباشرة في Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - الاستعلامات المعقدة يجب أن تكون في Repository أو Model Scopes",
        points: 1
    },
    {
        id: 64,
        type: "true-false",
        question: "Form Request Classes أفضل من validation مباشرة في Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Form Requests تفصل validation logic وتجعل Controller أنظف",
        points: 1
    },
    {
        id: 65,
        type: "true-false",
        question: "Route Model Binding يعمل فقط مع id",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يمكن استخدام أي عمود مثل slug باستخدام {post:slug} أو getRouteKeyName()",
        points: 1
    },
    {
        id: 66,
        type: "true-false",
        question: "getRouteKeyName() method تُعرّف في Model لتحديد المفتاح المستخدم",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - getRouteKeyName() في Model تحدد العمود المستخدم في Route Binding",
        points: 1
    },
    {
        id: 67,
        type: "true-false",
        question: "يمكن حقن Request في أي method في Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Laravel يحقن Request تلقائياً في أي method عند استخدام type-hint",
        points: 1
    },
    {
        id: 68,
        type: "true-false",
        question: "يمكن حقن Services في Constructor فقط",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يمكن حقن Services في Constructor أو في Methods",
        points: 1
    },
    {
        id: 69,
        type: "true-false",
        question: "response()->json() تستخدم لإرجاع JSON response",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - response()->json() تُستخدم في API Controllers لإرجاع JSON",
        points: 1
    },
    {
        id: 70,
        type: "true-false",
        question: "redirect()->route() تستخدم لإعادة التوجيه إلى route محدد",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - redirect()->route('posts.index') لإعادة التوجيه",
        points: 1
    },
    {
        id: 71,
        type: "true-false",
        question: "with() method تستخدم لتمرير رسائل مع redirect",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - ->with('success', 'تم الحفظ بنجاح') لتمرير رسالة",
        points: 1
    },
    {
        id: 72,
        type: "true-false",
        question: "يمكن إنشاء Controller مع Model معاً باستخدام -m flag",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - php artisan make:model Post -mc ينشئ Model مع Migration و Controller",
        points: 1
    },
    {
        id: 73,
        type: "true-false",
        question: "Route::apiResource() تنشئ routes لـ API Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route::apiResource() تنشئ 5 routes بدون create و edit",
        points: 1
    },
    {
        id: 74,
        type: "true-false",
        question: "يمكن تعريف multiple resources في سطر واحد",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route::resources(['posts' => PostController::class, 'users' => UserController::class])",
        points: 1
    },
    {
        id: 75,
        type: "true-false",
        question: "Controller يمكن أن يُرجع View أو JSON أو Redirect",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Controller يمكنه إرجاع أنواع مختلفة من responses",
        points: 1
    },
    {
        id: 76,
        type: "true-false",
        question: "يجب استخدام namespace كامل عند ربط Controller بـ Route",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يمكن استخدام use statement في بداية الملف ثم Controller::class",
        points: 1
    },
    {
        id: 77,
        type: "true-false",
        question: "Route Model Binding يرمي 404 تلقائياً إذا لم يجد Model",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route Model Binding يرمي ModelNotFoundException (404) تلقائياً",
        points: 1
    },
    {
        id: 78,
        type: "true-false",
        question: "Controller يجب أن يحتوي على logic للتعامل مع Views",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Controller يحضّر البيانات فقط، View مسؤول عن عرض البيانات",
        points: 1
    },
    {
        id: 79,
        type: "true-false",
        question: "يمكن استخدام Controller::class في Route بدلاً من string",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - هذه الطريقة الحديثة والمفضلة في Laravel 8+",
        points: 1
    },
    {
        id: 80,
        type: "true-false",
        question: "php artisan route:list يعرض جميع Routes المعرفة",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - php artisan route:list يعرض قائمة شاملة بجميع Routes",
        points: 1
    },

    // ============================================
    // Fill in the Blank (81-92) - 12 Points
    // ============================================
    {
        id: 81,
        type: "fill-blank",
        question: "Controllers يتم حفظها في مجلد _____",
        correctAnswers: ["app/Http/Controllers", "app\\Http\\Controllers", "app/Http/Controllers/"],
        caseSensitive: false,
        explanation: "Controllers يتم حفظها في app/Http/Controllers/",
        points: 1
    },
    {
        id: 82,
        type: "fill-blank",
        question: "Resource Controller يحتوي على _____ methods",
        correctAnswers: ["7", "سبعة", "seven"],
        caseSensitive: false,
        explanation: "Resource Controller يحتوي على 7 methods للـ CRUD operations",
        points: 1
    },
    {
        id: 83,
        type: "fill-blank",
        question: "Method المسؤول عن عرض قائمة العناصر هو _____",
        correctAnswers: ["index", "index()"],
        caseSensitive: false,
        explanation: "Method index() مسؤول عن عرض قائمة العناصر",
        points: 1
    },
    {
        id: 84,
        type: "fill-blank",
        question: "Method المسؤول عن حفظ عنصر جديد هو _____",
        correctAnswers: ["store", "store()"],
        caseSensitive: false,
        explanation: "Method store() مسؤول عن حفظ عنصر جديد في قاعدة البيانات",
        points: 1
    },
    {
        id: 85,
        type: "fill-blank",
        question: "Method المسؤول عن حذف عنصر هو _____",
        correctAnswers: ["destroy", "destroy()"],
        caseSensitive: false,
        explanation: "Method destroy() مسؤول عن حذف عنصر من قاعدة البيانات",
        points: 1
    },
    {
        id: 86,
        type: "fill-blank",
        question: "Single Action Controller يحتوي على method واحد اسمه _____",
        correctAnswers: ["__invoke", "__invoke()"],
        caseSensitive: false,
        explanation: "Single Action Controller يستخدم __invoke() كـ method وحيد",
        points: 1
    },
    {
        id: 87,
        type: "fill-blank",
        question: "API Controller يحتوي على _____ methods",
        correctAnswers: ["5", "خمسة", "five"],
        caseSensitive: false,
        explanation: "API Controller يحتوي على 5 methods (بدون create و edit)",
        points: 1
    },
    {
        id: 88,
        type: "fill-blank",
        question: "لتمرير البيانات إلى View نستخدم _____",
        correctAnswers: ["compact", "compact()", "with", "with()"],
        caseSensitive: false,
        explanation: "نستخدم compact() أو with() لتمرير البيانات إلى View",
        points: 1
    },
    {
        id: 89,
        type: "fill-blank",
        question: "لإرجاع JSON response نستخدم _____",
        correctAnswers: ["response()->json()", "response()->json", "json()"],
        caseSensitive: false,
        explanation: "نستخدم response()->json() لإرجاع JSON response",
        points: 1
    },
    {
        id: 90,
        type: "fill-blank",
        question: "لإعادة التوجيه إلى route نستخدم _____",
        correctAnswers: ["redirect()->route()", "redirect()->route", "route()"],
        caseSensitive: false,
        explanation: "نستخدم redirect()->route('name') لإعادة التوجيه",
        points: 1
    },
    {
        id: 91,
        type: "fill-blank",
        question: "Method في Model لتحديد المفتاح في Route Binding هو _____",
        correctAnswers: ["getRouteKeyName", "getRouteKeyName()"],
        caseSensitive: false,
        explanation: "getRouteKeyName() في Model تحدد المفتاح المستخدم في Route Binding",
        points: 1
    },
    {
        id: 92,
        type: "fill-blank",
        question: "لتطبيق Middleware في Controller نستخدم _____",
        correctAnswers: ["$this->middleware()", "$this->middleware", "middleware()"],
        caseSensitive: false,
        explanation: "نستخدم $this->middleware('name') في __construct()",
        points: 1
    },

    // ============================================
    // Command Questions (93-100) - 8 Points
    // ============================================
    {
        id: 93,
        type: "command",
        question: "ما الأمر لإنشاء Controller عادي باسم PostController؟",
        acceptedAnswers: [
            "php artisan make:controller PostController"
        ],
        caseSensitive: false,
        explanation: "php artisan make:controller PostController",
        points: 1
    },
    {
        id: 94,
        type: "command",
        question: "ما الأمر لإنشاء Resource Controller باسم PostController؟",
        acceptedAnswers: [
            "php artisan make:controller PostController --resource",
            "php artisan make:controller PostController -r"
        ],
        caseSensitive: false,
        explanation: "php artisan make:controller PostController --resource",
        points: 1
    },
    {
        id: 95,
        type: "command",
        question: "ما الأمر لإنشاء API Controller باسم PostController؟",
        acceptedAnswers: [
            "php artisan make:controller PostController --api"
        ],
        caseSensitive: false,
        explanation: "php artisan make:controller PostController --api",
        points: 1
    },
    {
        id: 96,
        type: "command",
        question: "ما الأمر لإنشاء Single Action Controller باسم ShowPost؟",
        acceptedAnswers: [
            "php artisan make:controller ShowPost --invokable",
            "php artisan make:controller ShowPost -i"
        ],
        caseSensitive: false,
        explanation: "php artisan make:controller ShowPost --invokable",
        points: 1
    },
    {
        id: 97,
        type: "command",
        question: "ما الأمر لإنشاء Controller مع Model و Migration؟",
        acceptedAnswers: [
            "php artisan make:model Post -mc",
            "php artisan make:model Post -cm"
        ],
        caseSensitive: false,
        explanation: "php artisan make:model Post -mc (m=migration, c=controller)",
        points: 1
    },
    {
        id: 98,
        type: "command",
        question: "ما الأمر لإنشاء Resource Controller مع Model باسم Post؟",
        acceptedAnswers: [
            "php artisan make:model Post -mcr",
            "php artisan make:model Post -mrc",
            "php artisan make:model Post -crm"
        ],
        caseSensitive: false,
        explanation: "php artisan make:model Post -mcr (m=migration, c=controller, r=resource)",
        points: 1
    },
    {
        id: 99,
        type: "command",
        question: "ما الأمر لعرض جميع Routes المعرفة في التطبيق؟",
        acceptedAnswers: [
            "php artisan route:list"
        ],
        caseSensitive: false,
        explanation: "php artisan route:list يعرض جميع Routes",
        points: 1
    },
    {
        id: 100,
        type: "command",
        question: "ما الأمر لإنشاء Controller في مجلد Admin؟",
        acceptedAnswers: [
            "php artisan make:controller Admin/PostController",
            "php artisan make:controller Admin\\PostController"
        ],
        caseSensitive: false,
        explanation: "php artisan make:controller Admin/PostController",
        points: 1
    }
];

// Export for use in exam engine
if (typeof module !== 'undefined' && module.exports) {
    module.exports = advancedExamQuestions;
}
