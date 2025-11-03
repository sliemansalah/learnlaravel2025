/**
 * Final Exam - 100 Questions = 100 Points
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
        question: "ما هو Laravel؟",
        options: [
            "لغة برمجة جديدة",
            "إطار عمل (Framework) لـ PHP",
            "قاعدة بيانات",
            "محرر نصوص"
        ],
        correctAnswer: 1,
        explanation: "Laravel هو إطار عمل مفتوح المصدر مبني على PHP",
        points: 1
    },
    {
        id: 2,
        type: "multiple-choice",
        question: "من هو مطور Laravel؟",
        options: [
            "Mark Zuckerberg",
            "Taylor Otwell",
            "Linus Torvalds",
            "Bill Gates"
        ],
        correctAnswer: 1,
        explanation: "Taylor Otwell أنشأ Laravel في 2011",
        points: 1
    },
    {
        id: 3,
        type: "multiple-choice",
        question: "أي من التالي يمثل معمارية MVC بشكل صحيح؟",
        options: [
            "Model = قاعدة البيانات، View = الكود، Controller = التصميم",
            "Model = البيانات والمنطق، View = العرض، Controller = الوسيط",
            "Model = Controller، View = Model، Controller = View",
            "Model = العرض، View = البيانات، Controller = المستخدم"
        ],
        correctAnswer: 1,
        explanation: "Model يدير البيانات، View يعرض، Controller الوسيط",
        points: 1
    },
    {
        id: 4,
        type: "multiple-choice",
        question: "ما هو Composer؟",
        options: [
            "برنامج لتحرير النصوص",
            "أداة لإدارة الاعتماديات في PHP",
            "قاعدة بيانات",
            "متصفح ويب"
        ],
        correctAnswer: 1,
        explanation: "Composer هو dependency manager لـ PHP",
        points: 1
    },
    {
        id: 5,
        type: "multiple-choice",
        question: "أي من المجلدات التالية يحتوي على Controllers؟",
        options: [
            "resources/controllers/",
            "app/Http/Controllers/",
            "routes/controllers/",
            "public/controllers/"
        ],
        correctAnswer: 1,
        explanation: "Controllers توجد في app/Http/Controllers/",
        points: 1
    },
    {
        id: 6,
        type: "multiple-choice",
        question: "ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟",
        options: [
            "routes/web.php",
            "app/index.php",
            "public/index.php",
            "resources/index.php"
        ],
        correctAnswer: 2,
        explanation: "جميع الطلبات تبدأ من public/index.php",
        points: 1
    },
    {
        id: 7,
        type: "multiple-choice",
        question: "ما هو محرك القوالب الافتراضي في Laravel؟",
        options: [
            "Twig",
            "Blade",
            "Smarty",
            "Mustache"
        ],
        correctAnswer: 1,
        explanation: "Blade هو محرك القوالب الافتراضي",
        points: 1
    },
    {
        id: 8,
        type: "multiple-choice",
        question: "أي ملف يحتوي على routes الويب؟",
        options: [
            "web.php",
            "routes/api.php",
            "routes/web.php",
            "app/routes.php"
        ],
        correctAnswer: 2,
        explanation: "Routes الويب توجد في routes/web.php",
        points: 1
    },
    {
        id: 9,
        type: "multiple-choice",
        question: "ما هو Artisan في Laravel؟",
        options: [
            "محرر نصوص",
            "أداة سطر الأوامر (CLI)",
            "قاعدة بيانات",
            "متصفح"
        ],
        correctAnswer: 1,
        explanation: "Artisan هو CLI الخاص بـ Laravel",
        points: 1
    },
    {
        id: 10,
        type: "multiple-choice",
        question: "ما هي لغة البرمجة التي بُني عليها Laravel؟",
        options: [
            "Python",
            "JavaScript",
            "PHP",
            "Ruby"
        ],
        correctAnswer: 2,
        explanation: "Laravel مبني على PHP",
        points: 1
    },
    {
        id: 11,
        type: "multiple-choice",
        question: "أين توجد ملفات Views في Laravel؟",
        options: [
            "app/views/",
            "public/views/",
            "resources/views/",
            "storage/views/"
        ],
        correctAnswer: 2,
        explanation: "Views توجد في resources/views/",
        points: 1
    },
    {
        id: 12,
        type: "multiple-choice",
        question: "ما هو امتداد ملفات Blade؟",
        options: [
            ".php",
            ".html",
            ".blade.php",
            ".tpl"
        ],
        correctAnswer: 2,
        explanation: "ملفات Blade تنتهي بـ .blade.php",
        points: 1
    },
    {
        id: 13,
        type: "multiple-choice",
        question: "أي من التالي يُستخدم لعرض متغير في Blade؟",
        options: [
            "<% $variable %>",
            "{{ $variable }}",
            "{$ variable $}",
            "<? $variable ?>"
        ],
        correctAnswer: 1,
        explanation: "{{ }} يُستخدم لعرض المتغيرات في Blade",
        points: 1
    },
    {
        id: 14,
        type: "multiple-choice",
        question: "ما هو الأمر الصحيح لإنشاء controller؟",
        options: [
            "php artisan controller:make",
            "php artisan create:controller",
            "php artisan make:controller",
            "php artisan new:controller"
        ],
        correctAnswer: 2,
        explanation: "php artisan make:controller هو الأمر الصحيح",
        points: 1
    },
    {
        id: 15,
        type: "multiple-choice",
        question: "في أي مجلد توجد Models في Laravel؟",
        options: [
            "app/",
            "app/Models/",
            "resources/models/",
            "database/models/"
        ],
        correctAnswer: 1,
        explanation: "Models توجد في app/Models/",
        points: 1
    },
    {
        id: 16,
        type: "multiple-choice",
        question: "ما هو ORM الذي يستخدمه Laravel؟",
        options: [
            "Doctrine",
            "Eloquent",
            "Hibernate",
            "ActiveRecord"
        ],
        correctAnswer: 1,
        explanation: "Eloquent هو ORM الخاص بـ Laravel",
        points: 1
    },
    {
        id: 17,
        type: "multiple-choice",
        question: "أي ملف يحتوي على إعدادات قاعدة البيانات؟",
        options: [
            "config/database.php",
            ".env",
            "database.php",
            "الاثنان a و b"
        ],
        correctAnswer: 3,
        explanation: "الإعدادات في .env و config/database.php",
        points: 1
    },
    {
        id: 18,
        type: "multiple-choice",
        question: "ما هو الأمر لتشغيل migrations؟",
        options: [
            "php artisan migrate",
            "php artisan db:migrate",
            "php artisan migration:run",
            "php artisan run:migrations"
        ],
        correctAnswer: 0,
        explanation: "php artisan migrate لتشغيل migrations",
        points: 1
    },
    {
        id: 19,
        type: "multiple-choice",
        question: "أي HTTP method يُستخدم لجلب البيانات؟",
        options: [
            "POST",
            "GET",
            "PUT",
            "DELETE"
        ],
        correctAnswer: 1,
        explanation: "GET يُستخدم لجلب البيانات",
        points: 1
    },
    {
        id: 20,
        type: "multiple-choice",
        question: "أي HTTP method يُستخدم لإرسال البيانات؟",
        options: [
            "POST",
            "GET",
            "UPDATE",
            "SEND"
        ],
        correctAnswer: 0,
        explanation: "POST يُستخدم لإرسال البيانات",
        points: 1
    },
    {
        id: 21,
        type: "multiple-choice",
        question: "ما هو الـ Middleware في Laravel؟",
        options: [
            "قاعدة بيانات",
            "طبقة وسيطة لتصفية الطلبات",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 1,
        explanation: "Middleware طبقة لتصفية HTTP requests",
        points: 1
    },
    {
        id: 22,
        type: "multiple-choice",
        question: "أين توجد ملفات Middleware؟",
        options: [
            "app/Middleware/",
            "app/Http/Middleware/",
            "middleware/",
            "app/middlewares/"
        ],
        correctAnswer: 1,
        explanation: "Middleware توجد في app/Http/Middleware/",
        points: 1
    },
    {
        id: 23,
        type: "multiple-choice",
        question: "ما هو CSRF في Laravel؟",
        options: [
            "نوع من القوالب",
            "حماية من هجمات Cross-Site Request Forgery",
            "قاعدة بيانات",
            "أداة تشفير"
        ],
        correctAnswer: 1,
        explanation: "CSRF حماية من هجمات Cross-Site Request Forgery",
        points: 1
    },
    {
        id: 24,
        type: "multiple-choice",
        question: "ما هو Session في Laravel؟",
        options: [
            "قاعدة بيانات",
            "طريقة لتخزين بيانات المستخدم عبر الطلبات",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 1,
        explanation: "Session لتخزين بيانات المستخدم",
        points: 1
    },
    {
        id: 25,
        type: "multiple-choice",
        question: "ما هو Validation في Laravel؟",
        options: [
            "قاعدة بيانات",
            "محرك قوالب",
            "التحقق من صحة البيانات المُدخلة",
            "أداة تشفير"
        ],
        correctAnswer: 2,
        explanation: "Validation للتحقق من صحة البيانات",
        points: 1
    },
    {
        id: 26,
        type: "multiple-choice",
        question: "ما هو Service Provider في Laravel؟",
        options: [
            "مزود الخدمات لتسجيل الخدمات في التطبيق",
            "قاعدة بيانات",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 0,
        explanation: "Service Provider لتسجيل الخدمات",
        points: 1
    },
    {
        id: 27,
        type: "multiple-choice",
        question: "أين توجد Service Providers؟",
        options: [
            "app/Providers/",
            "providers/",
            "app/services/",
            "config/providers/"
        ],
        correctAnswer: 0,
        explanation: "Service Providers في app/Providers/",
        points: 1
    },
    {
        id: 28,
        type: "multiple-choice",
        question: "ما هو Facade في Laravel؟",
        options: [
            "واجهة بسيطة للوصول إلى الخدمات",
            "قاعدة بيانات",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 0,
        explanation: "Facade واجهة بسيطة للخدمات",
        points: 1
    },
    {
        id: 29,
        type: "multiple-choice",
        question: "ما هو Route Parameter؟",
        options: [
            "قاعدة بيانات",
            "معامل يُمرر عبر الـ URL",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 1,
        explanation: "Route Parameter معامل في URL",
        points: 1
    },
    {
        id: 30,
        type: "multiple-choice",
        question: "كيف تُعرّف route parameter؟",
        options: [
            "/user/:id",
            "/user/{id}",
            "/user/[id]",
            "/user/<id>"
        ],
        correctAnswer: 1,
        explanation: "Route parameters تُعرّف بـ {parameter}",
        points: 1
    },
    {
        id: 31,
        type: "multiple-choice",
        question: "ما هو Request في Laravel؟",
        options: [
            "كائن يحتوي على بيانات الطلب HTTP",
            "قاعدة بيانات",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 0,
        explanation: "Request كائن بيانات HTTP",
        points: 1
    },
    {
        id: 32,
        type: "multiple-choice",
        question: "ما هو Response في Laravel؟",
        options: [
            "قاعدة بيانات",
            "كائن الاستجابة المُرسلة للمستخدم",
            "محرك قوالب",
            "أداة تشفير"
        ],
        correctAnswer: 1,
        explanation: "Response كائن الاستجابة HTTP",
        points: 1
    },
    {
        id: 33,
        type: "multiple-choice",
        question: "ما هو المنفذ الافتراضي لـ Laravel development server؟",
        options: [
            "3000",
            "8080",
            "8000",
            "80"
        ],
        correctAnswer: 2,
        explanation: "المنفذ الافتراضي 8000",
        points: 1
    },
    {
        id: 34,
        type: "multiple-choice",
        question: "ما هو الأمر لتشغيل development server؟",
        options: [
            "php artisan run",
            "php artisan start",
            "php artisan serve",
            "php artisan server"
        ],
        correctAnswer: 2,
        explanation: "php artisan serve لتشغيل السيرفر",
        points: 1
    },
    {
        id: 35,
        type: "multiple-choice",
        question: "أي قاعدة بيانات لا يدعمها Laravel؟",
        options: [
            "MySQL",
            "PostgreSQL",
            "MongoDB (مباشرة)",
            "SQLite"
        ],
        correctAnswer: 2,
        explanation: "MongoDB يحتاج package إضافي",
        points: 1
    },
    {
        id: 36,
        type: "multiple-choice",
        question: "ما هو namespace الافتراضي للـ Controllers؟",
        options: [
            "App\\Controllers",
            "App\\Http\\Controllers",
            "Controllers",
            "Http\\Controllers"
        ],
        correctAnswer: 1,
        explanation: "Namespace هو App\\Http\\Controllers",
        points: 1
    },
    {
        id: 37,
        type: "multiple-choice",
        question: "ما هو الأمر لعرض قائمة Routes؟",
        options: [
            "php artisan routes",
            "php artisan route:list",
            "php artisan list:routes",
            "php artisan show:routes"
        ],
        correctAnswer: 1,
        explanation: "php artisan route:list لعرض Routes",
        points: 1
    },
    {
        id: 38,
        type: "multiple-choice",
        question: "ما هو الأمر لمسح الـ cache؟",
        options: [
            "php artisan cache:clear",
            "php artisan clear:cache",
            "php artisan cache:clean",
            "php artisan clean:cache"
        ],
        correctAnswer: 0,
        explanation: "php artisan cache:clear لمسح cache",
        points: 1
    },
    {
        id: 39,
        type: "multiple-choice",
        question: "أين يتم تخزين الملفات المرفوعة افتراضياً؟",
        options: [
            "public/",
            "storage/",
            "uploads/",
            "files/"
        ],
        correctAnswer: 1,
        explanation: "الملفات تُخزن في storage/",
        points: 1
    },
    {
        id: 40,
        type: "multiple-choice",
        question: "ما هو الأمر لإنشاء Model؟",
        options: [
            "php artisan model:make",
            "php artisan create:model",
            "php artisan make:model",
            "php artisan new:model"
        ],
        correctAnswer: 2,
        explanation: "php artisan make:model هو الأمر الصحيح",
        points: 1
    },

    // ============================================
    // القسم الثاني: صح/خطأ (40 سؤال × 1 نقطة = 40 نقطة)
    // ============================================

    {
        id: 41,
        type: "true-false",
        question: "Laravel يدعم فقط قاعدة بيانات MySQL",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Laravel يدعم MySQL, PostgreSQL, SQLite, SQL Server",
        points: 1
    },
    {
        id: 42,
        type: "true-false",
        question: "ملف .env يحتوي على معلومات حساسة ويجب عدم مشاركته",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "ملف .env يحتوي على معلومات حساسة",
        points: 1
    },
    {
        id: 43,
        type: "true-false",
        question: "الأمر php artisan serve يستخدم لإنشاء مشروع جديد",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "php artisan serve لتشغيل السيرفر، وليس لإنشاء مشروع",
        points: 1
    },
    {
        id: 44,
        type: "true-false",
        question: "في MVC، الـ View يجب أن يحتوي على منطق معقد للتطبيق",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "View للعرض فقط، المنطق في Controller/Model",
        points: 1
    },
    {
        id: 45,
        type: "true-false",
        question: "Blade هو محرك القوالب الافتراضي في Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Blade هو محرك القوالب القوي في Laravel",
        points: 1
    },
    {
        id: 46,
        type: "true-false",
        question: "يمكن استخدام PHP عادي داخل ملفات Blade",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "يمكن استخدام @php و @endphp أو <?php ?>",
        points: 1
    },
    {
        id: 47,
        type: "true-false",
        question: "Laravel مبني على CodeIgniter",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Laravel مبني من الصفر وليس على framework آخر",
        points: 1
    },
    {
        id: 48,
        type: "true-false",
        question: "Composer مطلوب لتثبيت Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Composer ضروري لتثبيت Laravel",
        points: 1
    },
    {
        id: 49,
        type: "true-false",
        question: "Laravel يتطلب PHP 7.0 أو أحدث",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel الحديث يتطلب PHP 8.0+",
        points: 1
    },
    {
        id: 50,
        type: "true-false",
        question: "يمكن تشغيل Laravel على shared hosting",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "يمكن تشغيله لكن يُفضل VPS",
        points: 1
    },
    {
        id: 51,
        type: "true-false",
        question: "Routes API توجد في ملف routes/api.php",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "API routes في routes/api.php",
        points: 1
    },
    {
        id: 52,
        type: "true-false",
        question: "Eloquent هو Query Builder فقط",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Eloquent هو ORM كامل",
        points: 1
    },
    {
        id: 53,
        type: "true-false",
        question: "يجب إنشاء controller لكل route",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "يمكن استخدام Closures مباشرة",
        points: 1
    },
    {
        id: 54,
        type: "true-false",
        question: "Laravel يدعم Real-time events",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يدعم Broadcasting",
        points: 1
    },
    {
        id: 55,
        type: "true-false",
        question: "يمكن استخدام multiple databases في Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يدعم multiple database connections",
        points: 1
    },
    {
        id: 56,
        type: "true-false",
        question: "Middleware يعمل قبل الوصول للـ Controller فقط",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Middleware يمكن أن يعمل قبل وبعد",
        points: 1
    },
    {
        id: 57,
        type: "true-false",
        question: "Laravel يوفر نظام authentication جاهز",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يوفر Auth scaffold",
        points: 1
    },
    {
        id: 58,
        type: "true-false",
        question: "يمكن تشغيل Laravel بدون web server",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "يمكن تشغيله بـ php artisan serve",
        points: 1
    },
    {
        id: 59,
        type: "true-false",
        question: "ملف composer.json يحتوي على قائمة المكتبات المطلوبة",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "composer.json يحدد dependencies",
        points: 1
    },
    {
        id: 60,
        type: "true-false",
        question: "مجلد vendor يجب رفعه على Git",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "vendor يُستبعد من Git",
        points: 1
    },
    {
        id: 61,
        type: "true-false",
        question: "Laravel يدعم Queue jobs",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel له نظام Queues قوي",
        points: 1
    },
    {
        id: 62,
        type: "true-false",
        question: "يمكن إنشاء custom Artisan commands",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يسمح بإنشاء custom commands",
        points: 1
    },
    {
        id: 63,
        type: "true-false",
        question: "Storage و public هما نفس المجلد",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "storage و public مجلدان مختلفان",
        points: 1
    },
    {
        id: 64,
        type: "true-false",
        question: "Laravel يوفر Task Scheduling",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel له نظام Task Scheduling",
        points: 1
    },
    {
        id: 65,
        type: "true-false",
        question: "يمكن استخدام Blade بدون Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Blade يمكن استخدامه standalone",
        points: 1
    },
    {
        id: 66,
        type: "true-false",
        question: "CSRF token إلزامي لجميع POST requests",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "CSRF token مطلوب للحماية",
        points: 1
    },
    {
        id: 67,
        type: "true-false",
        question: "Laravel يدعم Testing out of the box",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel مدمج مع PHPUnit",
        points: 1
    },
    {
        id: 68,
        type: "true-false",
        question: "يجب استخدام Eloquent لكل عمليات Database",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "يمكن استخدام Query Builder أو Raw SQL",
        points: 1
    },
    {
        id: 69,
        type: "true-false",
        question: "Laravel مجاني ومفتوح المصدر",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel مرخص بـ MIT",
        points: 1
    },
    {
        id: 70,
        type: "true-false",
        question: "يمكن تغيير App Key بعد التطوير بدون مشاكل",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "تغيير App Key يكسر encrypted data",
        points: 1
    },
    {
        id: 71,
        type: "true-false",
        question: "Laravel يستخدم Symfony components",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يستخدم بعض Symfony components",
        points: 1
    },
    {
        id: 72,
        type: "true-false",
        question: "يمكن استخدام Vue.js مع Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يدعم Vue.js و React",
        points: 1
    },
    {
        id: 73,
        type: "true-false",
        question: "Migration هو SQL script فقط",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Migration هو PHP class",
        points: 1
    },
    {
        id: 74,
        type: "true-false",
        question: "Laravel Valet يعمل على Windows",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Valet لـ macOS فقط (هناك Valet+ لـ Windows)",
        points: 1
    },
    {
        id: 75,
        type: "true-false",
        question: "يمكن إرجاع JSON مباشرة من Controller",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يحول arrays تلقائياً لـ JSON",
        points: 1
    },
    {
        id: 76,
        type: "true-false",
        question: "Laravel Mix يُستخدم لـ asset compilation",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Mix wrapper حول Webpack",
        points: 1
    },
    {
        id: 77,
        type: "true-false",
        question: "يمكن إنشاء RESTful API بسهولة في Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel ممتاز لبناء APIs",
        points: 1
    },
    {
        id: 78,
        type: "true-false",
        question: "Seeder يُستخدم لملء قاعدة البيانات ببيانات وهمية",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Seeders لإدخال بيانات تجريبية",
        points: 1
    },
    {
        id: 79,
        type: "true-false",
        question: "يمكن استخدام Redis مع Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Laravel يدعم Redis للـ cache/sessions",
        points: 1
    },
    {
        id: 80,
        type: "true-false",
        question: "Laravel Passport يُستخدم للـ OAuth",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Passport يوفر OAuth2 server",
        points: 1
    },

    // ============================================
    // القسم الثالث: ملء الفراغات + أوامر (20 سؤال × 1 نقطة = 20 نقطة)
    // ============================================

    {
        id: 81,
        type: "fill-blank",
        question: "جميع routes الويب يتم تعريفها في ملف _____",
        correctAnswers: ["routes/web.php", "routes\\web.php", "web.php"],
        caseSensitive: false,
        placeholder: "routes/...",
        explanation: "الملف: routes/web.php",
        points: 1
    },
    {
        id: 82,
        type: "fill-blank",
        question: "محرك القوالب في Laravel يسمى _____",
        correctAnswers: ["Blade", "blade"],
        caseSensitive: false,
        placeholder: "اسم محرك القوالب",
        explanation: "محرك القوالب: Blade",
        points: 1
    },
    {
        id: 83,
        type: "fill-blank",
        question: "نقطة الدخول الرئيسية لتطبيق Laravel هي _____",
        correctAnswers: ["public/index.php", "public\\index.php"],
        caseSensitive: false,
        placeholder: "path/file.php",
        explanation: "نقطة الدخول: public/index.php",
        points: 1
    },
    {
        id: 84,
        type: "fill-blank",
        question: "Controllers توجد في مجلد _____",
        correctAnswers: ["app/Http/Controllers", "app\\Http\\Controllers"],
        caseSensitive: false,
        placeholder: "app/...",
        explanation: "المجلد: app/Http/Controllers",
        points: 1
    },
    {
        id: 85,
        type: "fill-blank",
        question: "للوصول للبيئة المحلية نستخدم الدومين _____",
        correctAnswers: ["localhost", "127.0.0.1"],
        caseSensitive: false,
        placeholder: "domain",
        explanation: "الدومين المحلي: localhost",
        points: 1
    },
    {
        id: 86,
        type: "command",
        question: "ما هو الأمر لإنشاء مشروع Laravel جديد باسم 'blog'؟",
        placeholder: "composer create-project ...",
        acceptedAnswers: [
            "composer create-project laravel/laravel blog",
            "composer create-project laravel/laravel blog --prefer-dist",
            "laravel new blog"
        ],
        caseSensitive: false,
        explanation: "الأمر: composer create-project laravel/laravel blog",
        points: 1
    },
    {
        id: 87,
        type: "command",
        question: "ما هو الأمر لتشغيل السيرفر المحلي على المنفذ 8080؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan serve --port=8080",
            "php artisan serve --port 8080"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan serve --port=8080",
        points: 1
    },
    {
        id: 88,
        type: "command",
        question: "ما هو الأمر لإنشاء controller باسم UserController؟",
        placeholder: "php artisan make:...",
        acceptedAnswers: [
            "php artisan make:controller UserController"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan make:controller UserController",
        points: 1
    },
    {
        id: 89,
        type: "command",
        question: "ما هو الأمر لتشغيل migrations؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan migrate"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan migrate",
        points: 1
    },
    {
        id: 90,
        type: "command",
        question: "ما هو الأمر لعرض قائمة جميع الـ routes؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan route:list"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan route:list",
        points: 1
    },
    {
        id: 91,
        type: "fill-blank",
        question: "Views توجد في مجلد _____",
        correctAnswers: ["resources/views", "resources\\views"],
        caseSensitive: false,
        placeholder: "resources/...",
        explanation: "Views في resources/views",
        points: 1
    },
    {
        id: 92,
        type: "fill-blank",
        question: "امتداد ملفات Blade هو _____",
        correctAnswers: [".blade.php", "blade.php"],
        caseSensitive: false,
        placeholder: ".blade...",
        explanation: "الامتداد: .blade.php",
        points: 1
    },
    {
        id: 93,
        type: "fill-blank",
        question: "لعرض متغير في Blade نستخدم _____",
        correctAnswers: ["{{ }}", "{{ $variable }}", "{{  }}"],
        caseSensitive: false,
        placeholder: "{{ ... }}",
        explanation: "نستخدم {{ $variable }}",
        points: 1
    },
    {
        id: 94,
        type: "command",
        question: "ما هو الأمر لإنشاء model باسم Post؟",
        placeholder: "php artisan make:...",
        acceptedAnswers: [
            "php artisan make:model Post"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan make:model Post",
        points: 1
    },
    {
        id: 95,
        type: "command",
        question: "ما هو الأمر لمسح cache؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan cache:clear"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan cache:clear",
        points: 1
    },
    {
        id: 96,
        type: "fill-blank",
        question: "المنفذ الافتراضي لـ Laravel development server هو _____",
        correctAnswers: ["8000", "port 8000", ":8000"],
        caseSensitive: false,
        placeholder: "8...",
        explanation: "المنفذ الافتراضي: 8000",
        points: 1
    },
    {
        id: 97,
        type: "fill-blank",
        question: "لحماية من CSRF نستخدم directive _____",
        correctAnswers: ["@csrf", "@CSRF"],
        caseSensitive: false,
        placeholder: "@...",
        explanation: "نستخدم @csrf في forms",
        points: 1
    },
    {
        id: 98,
        type: "command",
        question: "ما هو الأمر لإنشاء migration؟",
        placeholder: "php artisan make:...",
        acceptedAnswers: [
            "php artisan make:migration create_users_table",
            "php artisan make:migration"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan make:migration",
        points: 1
    },
    {
        id: 99,
        type: "fill-blank",
        question: "ORM الخاص بـ Laravel يسمى _____",
        correctAnswers: ["Eloquent", "eloquent"],
        caseSensitive: false,
        placeholder: "E...",
        explanation: "ORM: Eloquent",
        points: 1
    },
    {
        id: 100,
        type: "fill-blank",
        question: "CLI الخاص بـ Laravel يسمى _____",
        correctAnswers: ["Artisan", "artisan"],
        caseSensitive: false,
        placeholder: "A...",
        explanation: "CLI: Artisan",
        points: 1
    }
];

// Calculate total points
const totalPoints = advancedExamQuestions.reduce((sum, q) => sum + q.points, 0);

console.log(`✅ تم تحميل ${advancedExamQuestions.length} سؤال`);
console.log(`📊 مجموع النقاط: ${totalPoints}`);

// Export
if (typeof module !== 'undefined' && module.exports) {
    module.exports = advancedExamQuestions;
}
