/**
 * Final Exam - 100 Questions about Laravel Routing
 * Total: 100 questions × 1 point each = 100 points
 * Duration: 120 minutes
 */

const advancedExamQuestions = [

    // ============================================
    // القسم الأول: اختيار من متعدد (40 سؤال × 1 نقطة = 40 نقطة)
    // ============================================

    {
        id: 1,
        type: "multiple-choice",
        question: "ما هو Routing في Laravel؟",
        options: [
            "نظام لإدارة قواعد البيانات",
            "آلية لتحديد المسارات والاستجابة للطلبات",
            "محرك قوالب",
            "أداة لتشفير البيانات"
        ],
        correctAnswer: 1,
        explanation: "Routing هو آلية تحدد كيفية استجابة التطبيق للطلبات القادمة على مسارات معينة",
        points: 1
    },
    {
        id: 2,
        type: "multiple-choice",
        question: "أين توجد ملفات Routing في Laravel؟",
        options: [
            "app/routes/",
            "routes/",
            "config/routes/",
            "public/routes/"
        ],
        correctAnswer: 1,
        explanation: "ملفات Routing توجد في مجلد routes/",
        points: 1
    },
    {
        id: 3,
        type: "multiple-choice",
        question: "أي ملف يحتوي على routes الويب؟",
        options: [
            "web.php",
            "routes/web.php",
            "app/web.php",
            "config/web.php"
        ],
        correctAnswer: 1,
        explanation: "routes للويب توجد في routes/web.php",
        points: 1
    },
    {
        id: 4,
        type: "multiple-choice",
        question: "أي HTTP method يُستخدم لجلب البيانات؟",
        options: [
            "POST",
            "GET",
            "PUT",
            "DELETE"
        ],
        correctAnswer: 1,
        explanation: "GET يُستخدم لجلب البيانات من السيرفر",
        points: 1
    },
    {
        id: 5,
        type: "multiple-choice",
        question: "أي HTTP method يُستخدم لإرسال بيانات جديدة؟",
        options: [
            "POST",
            "GET",
            "UPDATE",
            "CREATE"
        ],
        correctAnswer: 0,
        explanation: "POST يُستخدم لإرسال بيانات جديدة للسيرفر",
        points: 1
    },
    {
        id: 6,
        type: "multiple-choice",
        question: "كيف تُنشئ route يستجيب لـ GET request؟",
        options: [
            "Route::create('/path', ...)",
            "Route::get('/path', ...)",
            "Route::make('/path', ...)",
            "Route::add('/path', ...)"
        ],
        correctAnswer: 1,
        explanation: "Route::get() لإنشاء route يستجيب لـ GET",
        points: 1
    },
    {
        id: 7,
        type: "multiple-choice",
        question: "ما هي الصيغة الصحيحة لإنشاء route parameter؟",
        options: [
            "Route::get('/user/:id', ...)",
            "Route::get('/user/{id}', ...)",
            "Route::get('/user/[id]', ...)",
            "Route::get('/user/<id>', ...)"
        ],
        correctAnswer: 1,
        explanation: "Route parameters تُكتب داخل {} مثل {id}",
        points: 1
    },
    {
        id: 8,
        type: "multiple-choice",
        question: "كيف تجعل route parameter اختيارياً؟",
        options: [
            "{id}",
            "{id?}",
            "{id*}",
            "{id!}"
        ],
        correctAnswer: 1,
        explanation: "{id?} يجعل المعامل اختيارياً",
        points: 1
    },
    {
        id: 9,
        type: "multiple-choice",
        question: "كيف تُسمي route؟",
        options: [
            "->name('route.name')",
            "->setName('route.name')",
            "->as('route.name')",
            "->title('route.name')"
        ],
        correctAnswer: 0,
        explanation: "->name() لتسمية route",
        points: 1
    },
    {
        id: 10,
        type: "multiple-choice",
        question: "كيف تستخدم named route في blade؟",
        options: [
            "url('route.name')",
            "route('route.name')",
            "path('route.name')",
            "link('route.name')"
        ],
        correctAnswer: 1,
        explanation: "route() helper لاستخدام named routes",
        points: 1
    },
    {
        id: 11,
        type: "multiple-choice",
        question: "ما فائدة Route Groups؟",
        options: [
            "تسريع الموقع",
            "تجميع routes متشابهة",
            "تشفير البيانات",
            "إنشاء قاعدة بيانات"
        ],
        correctAnswer: 1,
        explanation: "Route Groups لتجميع routes تشترك في خصائص",
        points: 1
    },
    {
        id: 12,
        type: "multiple-choice",
        question: "كيف تضيف prefix لمجموعة routes؟",
        options: [
            "Route::group(['prefix' => 'admin'], ...)",
            "Route::prefix('admin')->group(...)",
            "كلاهما صحيح",
            "لا شيء مما سبق"
        ],
        correctAnswer: 2,
        explanation: "كلا الطريقتين صحيحة لإضافة prefix",
        points: 1
    },
    {
        id: 13,
        type: "multiple-choice",
        question: "ماذا يفعل Route::redirect؟",
        options: [
            "ينشئ route جديد",
            "يحذف route",
            "يعيد التوجيه من URL لآخر",
            "يعرض view"
        ],
        correctAnswer: 2,
        explanation: "Route::redirect يعيد التوجيه من مسار لآخر",
        points: 1
    },
    {
        id: 14,
        type: "multiple-choice",
        question: "كيف تعرض view مباشرة بدون controller؟",
        options: [
            "Route::display()",
            "Route::view()",
            "Route::show()",
            "Route::render()"
        ],
        correctAnswer: 1,
        explanation: "Route::view() لعرض view مباشرة",
        points: 1
    },
    {
        id: 15,
        type: "multiple-choice",
        question: "ما هو Fallback Route؟",
        options: [
            "route احتياطي للصفحات غير الموجودة",
            "route رئيسي",
            "route للـ API",
            "route للإدارة"
        ],
        correctAnswer: 0,
        explanation: "Fallback route يُستدعى عند عدم وجود route مطابق",
        points: 1
    },
    {
        id: 16,
        type: "multiple-choice",
        question: "أين تُعرّف API routes؟",
        options: [
            "routes/web.php",
            "routes/api.php",
            "routes/app.php",
            "routes/rest.php"
        ],
        correctAnswer: 1,
        explanation: "API routes في routes/api.php",
        points: 1
    },
    {
        id: 17,
        type: "multiple-choice",
        question: "ما هو prefix الافتراضي لـ API routes؟",
        options: [
            "/",
            "/api",
            "/rest",
            "/v1"
        ],
        correctAnswer: 1,
        explanation: "API routes تبدأ بـ /api افتراضياً",
        points: 1
    },
    {
        id: 18,
        type: "multiple-choice",
        question: "كيف تضع قيد على route parameter؟",
        options: [
            "->where('id', '[0-9]+')",
            "->constraint('id', '[0-9]+')",
            "->validate('id', '[0-9]+')",
            "->check('id', '[0-9]+')"
        ],
        correctAnswer: 0,
        explanation: "->where() لوضع قيود على parameters",
        points: 1
    },
    {
        id: 19,
        type: "multiple-choice",
        question: "ما هو Route Model Binding؟",
        options: [
            "ربط route بـ view",
            "ربط route بـ model تلقائياً",
            "ربط route بـ controller",
            "ربط route بـ database"
        ],
        correctAnswer: 1,
        explanation: "Route Model Binding يربط parameter بـ model تلقائياً",
        points: 1
    },
    {
        id: 20,
        type: "multiple-choice",
        question: "كيف تستخدم implicit model binding؟",
        options: [
            "Route::get('/users/{id}', function($id) {...})",
            "Route::get('/users/{user}', function(User $user) {...})",
            "Route::get('/users', function() {...})",
            "لا شيء مما سبق"
        ],
        correctAnswer: 1,
        explanation: "Type-hint الـ model في الـ closure",
        points: 1
    },
    {
        id: 21,
        type: "multiple-choice",
        question: "ما الأمر لعرض جميع routes؟",
        options: [
            "php artisan routes",
            "php artisan route:list",
            "php artisan list:routes",
            "php artisan show:routes"
        ],
        correctAnswer: 1,
        explanation: "php artisan route:list لعرض جميع routes",
        points: 1
    },
    {
        id: 22,
        type: "multiple-choice",
        question: "ما فائدة Route Caching؟",
        options: [
            "تسريع تحميل routes",
            "حفظ routes في قاعدة بيانات",
            "تشفير routes",
            "حذف routes القديمة"
        ],
        correctAnswer: 0,
        explanation: "Route caching يسرع تحميل routes في الإنتاج",
        points: 1
    },
    {
        id: 23,
        type: "multiple-choice",
        question: "كيف تنشئ route cache؟",
        options: [
            "php artisan route:cache",
            "php artisan cache:route",
            "php artisan make:cache",
            "php artisan route:store"
        ],
        correctAnswer: 0,
        explanation: "php artisan route:cache لإنشاء route cache",
        points: 1
    },
    {
        id: 24,
        type: "multiple-choice",
        question: "متى يجب استخدام Route::match؟",
        options: [
            "للاستجابة لـ method واحد",
            "للاستجابة لعدة methods",
            "للاستجابة لجميع methods",
            "لا يُستخدم"
        ],
        correctAnswer: 1,
        explanation: "Route::match للاستجابة لعدة HTTP methods محددة",
        points: 1
    },
    {
        id: 25,
        type: "multiple-choice",
        question: "ما الفرق بين Route::match و Route::any؟",
        options: [
            "لا فرق",
            "match لعدة methods، any لجميع methods",
            "match لـ GET فقط، any لـ POST",
            "match أسرع من any"
        ],
        correctAnswer: 1,
        explanation: "match لمethods محددة، any لجميع methods",
        points: 1
    },
    {
        id: 26,
        type: "multiple-choice",
        question: "كيف تُنشئ redirect دائم (301)؟",
        options: [
            "Route::redirect('/old', '/new')",
            "Route::permanentRedirect('/old', '/new')",
            "Route::redirect('/old', '/new', 301)",
            "b و c صحيحان"
        ],
        correctAnswer: 3,
        explanation: "كلا الطريقتين صحيحة للـ permanent redirect",
        points: 1
    },
    {
        id: 27,
        type: "multiple-choice",
        question: "ما هو middleware في context الـ routes؟",
        options: [
            "قاعدة بيانات",
            "طبقة وسيطة لتصفية الطلبات",
            "محرك قوالب",
            "route parameter"
        ],
        correctAnswer: 1,
        explanation: "Middleware طبقة لتصفية requests قبل الوصول للـ route",
        points: 1
    },
    {
        id: 28,
        type: "multiple-choice",
        question: "كيف تضيف middleware لـ route؟",
        options: [
            "->middleware('auth')",
            "->filter('auth')",
            "->use('auth')",
            "->guard('auth')"
        ],
        correctAnswer: 0,
        explanation: "->middleware() لإضافة middleware",
        points: 1
    },
    {
        id: 29,
        type: "multiple-choice",
        question: "ما هو Rate Limiting؟",
        options: [
            "تحديد سرعة التطبيق",
            "تحديد عدد الطلبات المسموحة",
            "تحديد حجم البيانات",
            "تحديد عدد المستخدمين"
        ],
        correctAnswer: 1,
        explanation: "Rate Limiting يحدد عدد الطلبات المسموح بها في فترة زمنية",
        points: 1
    },
    {
        id: 30,
        type: "multiple-choice",
        question: "أي method يُستخدم للتحديث الجزئي؟",
        options: [
            "PUT",
            "PATCH",
            "UPDATE",
            "MODIFY"
        ],
        correctAnswer: 1,
        explanation: "PATCH للتحديث الجزئي، PUT للتحديث الكامل",
        points: 1
    },
    {
        id: 31,
        type: "multiple-choice",
        question: "كيف تجمع عدة routes تحت نفس الـ middleware؟",
        options: [
            "استخدام Route Group",
            "تكرار الكود",
            "استخدام Controller",
            "استخدام Model"
        ],
        correctAnswer: 0,
        explanation: "Route Group لتطبيق middleware على عدة routes",
        points: 1
    },
    {
        id: 32,
        type: "multiple-choice",
        question: "ما الفرق الرئيسي بين web.php و api.php؟",
        options: [
            "اللغة المستخدمة",
            "Sessions و CSRF في web، stateless في api",
            "السرعة",
            "لا فرق"
        ],
        correctAnswer: 1,
        explanation: "web.php يدعم sessions و CSRF، api.php stateless",
        points: 1
    },
    {
        id: 33,
        type: "multiple-choice",
        question: "كيف تُنشئ route يستجيب لـ DELETE؟",
        options: [
            "Route::delete('/path', ...)",
            "Route::remove('/path', ...)",
            "Route::destroy('/path', ...)",
            "Route::erase('/path', ...)"
        ],
        correctAnswer: 0,
        explanation: "Route::delete() للـ DELETE requests",
        points: 1
    },
    {
        id: 34,
        type: "multiple-choice",
        question: "ما هي Resource Routes؟",
        options: [
            "routes لإدارة الموارد (CRUD)",
            "routes للصور",
            "routes للـ CSS",
            "routes للـ JavaScript"
        ],
        correctAnswer: 0,
        explanation: "Resource routes توفر routes جاهزة للـ CRUD operations",
        points: 1
    },
    {
        id: 35,
        type: "multiple-choice",
        question: "كيف تُنشئ resource routes؟",
        options: [
            "Route::resource('posts', PostController::class)",
            "Route::crud('posts', PostController::class)",
            "Route::restful('posts', PostController::class)",
            "Route::model('posts', PostController::class)"
        ],
        correctAnswer: 0,
        explanation: "Route::resource() لإنشاء CRUD routes تلقائياً",
        points: 1
    },
    {
        id: 36,
        type: "multiple-choice",
        question: "كم route ينشئ Route::resource؟",
        options: [
            "4",
            "5",
            "7",
            "10"
        ],
        correctAnswer: 2,
        explanation: "Route::resource ينشئ 7 routes (index, create, store, show, edit, update, destroy)",
        points: 1
    },
    {
        id: 37,
        type: "multiple-choice",
        question: "كيف تحدد استخدام slug بدلاً من id في model binding؟",
        options: [
            "Route::get('/posts/{post}', ...)",
            "Route::get('/posts/{post:slug}', ...)",
            "Route::get('/posts/{slug}', ...)",
            "لا يمكن"
        ],
        correctAnswer: 1,
        explanation: "{post:slug} لاستخدام حقل slug بدلاً من id",
        points: 1
    },
    {
        id: 38,
        type: "multiple-choice",
        question: "ما هو closure route؟",
        options: [
            "route مغلق",
            "route بدون controller (inline function)",
            "route محذوف",
            "route خاص"
        ],
        correctAnswer: 1,
        explanation: "Closure route يستخدم function مباشرة بدون controller",
        points: 1
    },
    {
        id: 39,
        type: "multiple-choice",
        question: "متى يُفضل استخدام closure routes؟",
        options: [
            "للمنطق المعقد",
            "للتطبيقات الكبيرة",
            "للـ routes البسيطة جداً",
            "دائماً"
        ],
        correctAnswer: 2,
        explanation: "Closure routes للمنطق البسيط جداً، controllers للمنطق المعقد",
        points: 1
    },
    {
        id: 40,
        type: "multiple-choice",
        question: "كيف تمرر بيانات لـ Route::view؟",
        options: [
            "Route::view('/about', 'about', ['name' => 'Laravel'])",
            "Route::view('/about', 'about')->with('name', 'Laravel')",
            "Route::view('/about', 'about')->data(['name' => 'Laravel'])",
            "a و b صحيحان"
        ],
        correctAnswer: 0,
        explanation: "المعامل الثالث لـ Route::view هو array of data",
        points: 1
    },

    // ============================================
    // القسم الثاني: صح/خطأ (40 سؤال × 1 نقطة = 40 نقطة)
    // ============================================

    {
        id: 41,
        type: "true-false",
        question: "ملفات Routing توجد في مجلد routes/",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - ملفات routing في مجلد routes/",
        points: 1
    },
    {
        id: 42,
        type: "true-false",
        question: "Route::get يُستخدم لإرسال بيانات جديدة",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - GET لجلب البيانات، POST لإرسال بيانات جديدة",
        points: 1
    },
    {
        id: 43,
        type: "true-false",
        question: "يمكن استخدام عدة route parameters في نفس الـ route",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - مثل /posts/{post}/comments/{comment}",
        points: 1
    },
    {
        id: 44,
        type: "true-false",
        question: "Named Routes تسهل تعديل URLs لاحقاً",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - تغيير URL في مكان واحد يؤثر في كل التطبيق",
        points: 1
    },
    {
        id: 45,
        type: "true-false",
        question: "Route Groups تُستخدم فقط لتطبيق middleware",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - تُستخدم للـ prefix, namespace, middleware, وأكثر",
        points: 1
    },
    {
        id: 46,
        type: "true-false",
        question: "API routes افتراضياً تبدأ بـ /api",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - /api هو الـ prefix الافتراضي",
        points: 1
    },
    {
        id: 47,
        type: "true-false",
        question: "Route caching يُستخدم في التطوير لتسريع reload",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يُستخدم في الإنتاج فقط، يسبب مشاكل في التطوير",
        points: 1
    },
    {
        id: 48,
        type: "true-false",
        question: "PUT و PATCH كلاهما للتحديث لكن PATCH للتحديث الجزئي",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - PUT للتحديث الكامل، PATCH للجزئي",
        points: 1
    },
    {
        id: 49,
        type: "true-false",
        question: "Fallback route يجب أن يكون في بداية ملف routes",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يجب أن يكون في النهاية ليُستدعى عند عدم وجود match",
        points: 1
    },
    {
        id: 50,
        type: "true-false",
        question: "يمكن استخدام Regular Expressions في route parameters",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - باستخدام ->where('param', 'regex')",
        points: 1
    },
    {
        id: 51,
        type: "true-false",
        question: "Route Model Binding يعمل تلقائياً بدون إعداد",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Implicit binding يعمل تلقائياً مع Eloquent models",
        points: 1
    },
    {
        id: 52,
        type: "true-false",
        question: "Closure routes أفضل من Controller methods دائماً",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Closures للمنطق البسيط، Controllers للمنطق المعقد",
        points: 1
    },
    {
        id: 53,
        type: "true-false",
        question: "يمكن إنشاء route يستجيب لجميع HTTP methods باستخدام Route::any",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route::any يستجيب لجميع methods",
        points: 1
    },
    {
        id: 54,
        type: "true-false",
        question: "Route::view يتطلب إنشاء controller",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Route::view يعرض view مباشرة بدون controller",
        points: 1
    },
    {
        id: 55,
        type: "true-false",
        question: "يمكن تطبيق عدة middlewares على route واحد",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - ->middleware(['auth', 'verified'])",
        points: 1
    },
    {
        id: 56,
        type: "true-false",
        question: "ترتيب routes في الملف غير مهم",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - الترتيب مهم جداً! Laravel يطابق أول route مناسب",
        points: 1
    },
    {
        id: 57,
        type: "true-false",
        question: "Route parameters الاختيارية يجب أن يكون لها قيمة افتراضية",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - مثل function($name = 'Guest')",
        points: 1
    },
    {
        id: 58,
        type: "true-false",
        question: "Route::resource ينشئ 10 routes تلقائياً",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - ينشئ 7 routes فقط",
        points: 1
    },
    {
        id: 59,
        type: "true-false",
        question: "يمكن استخدام route() helper في Controllers",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - route() متاح في Blade وControllers وأي مكان",
        points: 1
    },
    {
        id: 60,
        type: "true-false",
        question: "web.php يستخدم session middleware افتراضياً",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - web middleware group يشمل sessions و CSRF",
        points: 1
    },
    {
        id: 61,
        type: "true-false",
        question: "DELETE method يمكن استخدامه مباشرة من HTML form",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يحتاج @method('DELETE') في Laravel",
        points: 1
    },
    {
        id: 62,
        type: "true-false",
        question: "Rate Limiting يمنع DDoS attacks تماماً",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يساعد لكن لا يمنع تماماً، يحتاج حماية إضافية",
        points: 1
    },
    {
        id: 63,
        type: "true-false",
        question: "يمكن إنشاء nested route groups",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - يمكن تداخل groups داخل بعضها",
        points: 1
    },
    {
        id: 64,
        type: "true-false",
        question: "Route::permanentRedirect ينشئ 302 redirect",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - ينشئ 301 permanent redirect",
        points: 1
    },
    {
        id: 65,
        type: "true-false",
        question: "يجب كتابة use statements للـ controllers في routes",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - أو استخدام fully qualified class name",
        points: 1
    },
    {
        id: 66,
        type: "true-false",
        question: "Route constraints تزيد من أمان التطبيق",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - تمنع قيم غير متوقعة",
        points: 1
    },
    {
        id: 67,
        type: "true-false",
        question: "يمكن استخدام Route::view مع parameters",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - يمكن تمرير data كـ array",
        points: 1
    },
    {
        id: 68,
        type: "true-false",
        question: "API routes لا تحتاج CSRF token",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - API routes stateless وبدون CSRF protection",
        points: 1
    },
    {
        id: 69,
        type: "true-false",
        question: "Route::match يقبل array من methods",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route::match(['get', 'post'], ...)",
        points: 1
    },
    {
        id: 70,
        type: "true-false",
        question: "يمكن تسمية route groups",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - باستخدام ->name() prefix",
        points: 1
    },
    {
        id: 71,
        type: "true-false",
        question: "Implicit binding يبحث عن id افتراضياً",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - ما لم تحدد حقل مخصص مثل {post:slug}",
        points: 1
    },
    {
        id: 72,
        type: "true-false",
        question: "Route caching يعمل مع closure routes",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Route caching لا يعمل مع closures، يحتاج controllers",
        points: 1
    },
    {
        id: 73,
        type: "true-false",
        question: "يمكن استخدام route() helper مع route parameters",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - route('user.show', ['id' => 1]) أو route('user.show', 1)",
        points: 1
    },
    {
        id: 74,
        type: "true-false",
        question: "Resource routes تشمل route للـ search",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - Resource routes فقط للـ CRUD الأساسي",
        points: 1
    },
    {
        id: 75,
        type: "true-false",
        question: "يمكن تحديد أي routes تُنشأ من Route::resource",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - باستخدام ->only() أو ->except()",
        points: 1
    },
    {
        id: 76,
        type: "true-false",
        question: "Route groups يمكن أن تحتوي على prefix فقط",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "خطأ - يمكن prefix, middleware, namespace, name, وأكثر",
        points: 1
    },
    {
        id: 77,
        type: "true-false",
        question: "Laravel يدعم Route versioning للـ APIs",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - باستخدام prefixes مثل /api/v1, /api/v2",
        points: 1
    },
    {
        id: 78,
        type: "true-false",
        question: "Route::current() يعيد معلومات عن الـ route الحالي",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - يمكن استخدامه للحصول على معلومات الـ route الحالي",
        points: 1
    },
    {
        id: 79,
        type: "true-false",
        question: "يمكن استخدام domain routing في Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - Route::domain() للـ subdomain routing",
        points: 1
    },
    {
        id: 80,
        type: "true-false",
        question: "كل route يجب أن يكون له اسم فريد",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "صحيح - أسماء Routes يجب أن تكون فريدة",
        points: 1
    },

    // ============================================
    // القسم الثالث: ملء الفراغات + أوامر (20 سؤال × 1 نقطة = 20 نقطة)
    // ============================================

    {
        id: 81,
        type: "fill-blank",
        question: "ملفات routing توجد في مجلد _____",
        correctAnswers: ["routes", "routes/"],
        caseSensitive: false,
        placeholder: "اسم المجلد",
        explanation: "ملفات routing في مجلد routes/",
        points: 1
    },
    {
        id: 82,
        type: "fill-blank",
        question: "للاستجابة لـ GET request نستخدم _____",
        correctAnswers: ["Route::get", "Route::get()"],
        caseSensitive: false,
        placeholder: "Route::...",
        explanation: "Route::get() للـ GET requests",
        points: 1
    },
    {
        id: 83,
        type: "fill-blank",
        question: "لتسمية route نستخدم _____",
        correctAnswers: ["->name()", "->name"],
        caseSensitive: false,
        placeholder: "->...()",
        explanation: "->name() لتسمية routes",
        points: 1
    },
    {
        id: 84,
        type: "fill-blank",
        question: "لإنشاء route parameter نكتبه داخل _____",
        correctAnswers: ["{}", "{ }"],
        caseSensitive: false,
        placeholder: "رمز",
        explanation: "Route parameters داخل {}",
        points: 1
    },
    {
        id: 85,
        type: "fill-blank",
        question: "API routes توجد في ملف _____",
        correctAnswers: ["routes/api.php", "api.php"],
        caseSensitive: false,
        placeholder: "routes/...",
        explanation: "API routes في routes/api.php",
        points: 1
    },
    {
        id: 86,
        type: "fill-blank",
        question: "لعرض view مباشرة نستخدم _____",
        correctAnswers: ["Route::view", "Route::view()"],
        caseSensitive: false,
        placeholder: "Route::...",
        explanation: "Route::view() لعرض view مباشرة",
        points: 1
    },
    {
        id: 87,
        type: "fill-blank",
        question: "لإنشاء redirect نستخدم _____",
        correctAnswers: ["Route::redirect", "Route::redirect()"],
        caseSensitive: false,
        placeholder: "Route::...",
        explanation: "Route::redirect() للإعادة توجيه",
        points: 1
    },
    {
        id: 88,
        type: "fill-blank",
        question: "الـ prefix الافتراضي لـ API routes هو _____",
        correctAnswers: ["/api", "api"],
        caseSensitive: false,
        placeholder: "/...",
        explanation: "الـ prefix الافتراضي: /api",
        points: 1
    },
    {
        id: 89,
        type: "fill-blank",
        question: "لاستخدام named route في blade نكتب _____",
        correctAnswers: ["route()", "{{ route() }}"],
        caseSensitive: false,
        placeholder: "...() helper",
        explanation: "route() helper لاستخدام named routes",
        points: 1
    },
    {
        id: 90,
        type: "fill-blank",
        question: "لإنشاء CRUD routes تلقائياً نستخدم _____",
        correctAnswers: ["Route::resource", "Route::resource()"],
        caseSensitive: false,
        placeholder: "Route::...",
        explanation: "Route::resource() لـ CRUD routes",
        points: 1
    },
    {
        id: 91,
        type: "fill-blank",
        question: "لجعل parameter اختيارياً نضيف _____ بعد الاسم",
        correctAnswers: ["?", "؟"],
        caseSensitive: false,
        placeholder: "رمز",
        explanation: "? لجعل parameter اختيارياً {id?}",
        points: 1
    },
    {
        id: 92,
        type: "fill-blank",
        question: "Route::resource ينشئ _____ routes",
        correctAnswers: ["7", "سبعة"],
        caseSensitive: false,
        placeholder: "عدد",
        explanation: "Route::resource ينشئ 7 routes",
        points: 1
    },

    {
        id: 93,
        type: "command",
        question: "ما الأمر لعرض جميع routes في التطبيق؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan route:list"
        ],
        caseSensitive: false,
        explanation: "php artisan route:list لعرض جميع routes",
        points: 1
    },
    {
        id: 94,
        type: "command",
        question: "ما الأمر لإنشاء route cache؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan route:cache"
        ],
        caseSensitive: false,
        explanation: "php artisan route:cache لتخزين routes مؤقتاً",
        points: 1
    },
    {
        id: 95,
        type: "command",
        question: "ما الأمر لمسح route cache؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan route:clear"
        ],
        caseSensitive: false,
        explanation: "php artisan route:clear لمسح route cache",
        points: 1
    },
    {
        id: 96,
        type: "command",
        question: "ما الأمر لتشغيل السيرفر المحلي؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan serve"
        ],
        caseSensitive: false,
        explanation: "php artisan serve لتشغيل development server",
        points: 1
    },
    {
        id: 97,
        type: "command",
        question: "ما الأمر لعرض routes التي تبدأ بـ api؟",
        placeholder: "php artisan route:list ...",
        acceptedAnswers: [
            "php artisan route:list --path=api"
        ],
        caseSensitive: false,
        explanation: "استخدم --path للتصفية حسب المسار",
        points: 1
    },
    {
        id: 98,
        type: "command",
        question: "ما الأمر لإنشاء Controller باسم PostController؟",
        placeholder: "php artisan make:...",
        acceptedAnswers: [
            "php artisan make:controller PostController"
        ],
        caseSensitive: false,
        explanation: "make:controller لإنشاء controller",
        points: 1
    },
    {
        id: 99,
        type: "command",
        question: "ما الأمر لإنشاء Resource Controller باسم UserController؟",
        placeholder: "php artisan make:controller ...",
        acceptedAnswers: [
            "php artisan make:controller UserController --resource",
            "php artisan make:controller UserController -r"
        ],
        caseSensitive: false,
        explanation: "--resource أو -r لإنشاء resource controller",
        points: 1
    },
    {
        id: 100,
        type: "command",
        question: "ما الأمر لعرض route باسم معين (user.show)؟",
        placeholder: "php artisan route:list ...",
        acceptedAnswers: [
            "php artisan route:list --name=user.show"
        ],
        caseSensitive: false,
        explanation: "استخدم --name للبحث بالاسم",
        points: 1
    }
];

// Calculate total points
const totalPoints = advancedExamQuestions.reduce((sum, q) => sum + q.points, 0);

console.log(`✅ تم تحميل ${advancedExamQuestions.length} سؤال عن Routing`);
console.log(`📊 مجموع النقاط: ${totalPoints}`);

// Export
if (typeof module !== 'undefined' && module.exports) {
    module.exports = advancedExamQuestions;
}
