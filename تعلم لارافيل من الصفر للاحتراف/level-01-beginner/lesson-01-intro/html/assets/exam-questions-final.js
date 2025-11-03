/**
 * Final Exam - 100 Points Total
 * Section 1: Theory (15 questions, 30 points)
 * Section 2: Practical (15 questions, 40 points)
 * Section 3: Project (1 project, 30 points)
 * Total: 31 items = 100 points
 */

const advancedExamQuestions = [

    // ============================================
    // القسم الأول: النظري (30 نقطة)
    // ============================================

    // --- اختيار من متعدد (5 أسئلة × 2 نقطة = 10 نقاط) ---
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
        explanation: "Laravel هو إطار عمل مفتوح المصدر مبني على PHP، أنشأه Taylor Otwell في 2011",
        points: 2
    },
    {
        id: 2,
        type: "multiple-choice",
        question: "أي من التالي يمثل معمارية MVC بشكل صحيح؟",
        options: [
            "Model = قاعدة البيانات، View = الكود، Controller = التصميم",
            "Model = البيانات والمنطق، View = العرض، Controller = الوسيط",
            "Model = Controller، View = Model، Controller = View",
            "Model = العرض، View = البيانات، Controller = المستخدم"
        ],
        correctAnswer: 1,
        explanation: "Model يدير البيانات والمنطق، View يعرض البيانات، Controller الوسيط بينهما",
        points: 2
    },
    {
        id: 3,
        type: "multiple-choice",
        question: "ما هو Composer؟",
        options: [
            "برنامج لتحرير النصوص",
            "أداة لإدارة الاعتماديات في PHP",
            "قاعدة بيانات",
            "متصفح ويب"
        ],
        correctAnswer: 1,
        explanation: "Composer هو dependency manager لـ PHP، مشابه لـ npm في Node.js",
        points: 2
    },
    {
        id: 4,
        type: "multiple-choice",
        question: "أي من المجلدات التالية يحتوي على Controllers في Laravel؟",
        options: [
            "resources/controllers/",
            "app/Http/Controllers/",
            "routes/controllers/",
            "public/controllers/"
        ],
        correctAnswer: 1,
        explanation: "Controllers توجد في app/Http/Controllers/ حسب الهيكل القياسي",
        points: 2
    },
    {
        id: 5,
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
        points: 2
    },

    // --- صح وخطأ (5 أسئلة × 2 نقطة = 10 نقاط) ---
    {
        id: 6,
        type: "true-false",
        question: "Laravel يدعم فقط قاعدة بيانات MySQL",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Laravel يدعم MySQL, PostgreSQL, SQLite, SQL Server",
        points: 2
    },
    {
        id: 7,
        type: "true-false",
        question: "ملف .env يحتوي على معلومات حساسة ويجب عدم مشاركته",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "ملف .env يحتوي على مفاتيح ومعلومات حساسة ومستثنى من Git",
        points: 2
    },
    {
        id: 8,
        type: "true-false",
        question: "الأمر php artisan serve يستخدم لإنشاء مشروع جديد",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "php artisan serve لتشغيل السيرفر، وليس لإنشاء مشروع",
        points: 2
    },
    {
        id: 9,
        type: "true-false",
        question: "في MVC، الـ View يجب أن يحتوي على منطق معقد للتطبيق",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "View للعرض فقط، المنطق المعقد يكون في Controller أو Model",
        points: 2
    },
    {
        id: 10,
        type: "true-false",
        question: "Blade هو محرك القوالب الافتراضي في Laravel",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Blade هو محرك القوالب القوي والبسيط في Laravel",
        points: 2
    },

    // --- مقالية قصيرة (2 سؤال × 5 نقاط = 10 نقاط) ---
    {
        id: 11,
        type: "essay",
        question: "اشرح خطوات تثبيت Laravel على جهازك (5-6 خطوات رئيسية)",
        keywords: [
            "composer", "php", "artisan", "serve",
            "mysql", "database", "env", "متطلبات",
            "تثبيت", "create-project", "laravel"
        ],
        minWords: 30,
        maxWords: 200,
        sampleAnswer: "1. التحقق من تثبيت PHP 8.1+ و Composer\n2. تثبيت Laravel: composer create-project laravel/laravel project-name\n3. الدخول للمجلد: cd project-name\n4. إعداد قاعدة البيانات في .env\n5. تشغيل: php artisan serve\n6. فتح المتصفح: http://localhost:8000",
        explanation: "الخطوات الأساسية: التحقق من المتطلبات، التثبيت عبر Composer، إعداد .env، تشغيل السيرفر",
        points: 5
    },
    {
        id: 12,
        type: "essay",
        question: "ما الفرق بين Model و Controller في Laravel؟ (3-4 نقاط رئيسية)",
        keywords: [
            "model", "controller", "بيانات", "منطق",
            "database", "eloquent", "request", "response",
            "view", "وسيط", "عرض", "business logic"
        ],
        minWords: 25,
        maxWords: 150,
        sampleAnswer: "Model: يتعامل مع البيانات وقاعدة البيانات عبر Eloquent، يحتوي على المنطق التجاري\nController: يتلقى طلبات HTTP، يعالجها، يتواصل مع Model، يرسل البيانات لـ View\nالفرق: Model للبيانات والمنطق التجاري، Controller للتحكم بتدفق التطبيق",
        explanation: "Model يدير البيانات، Controller يربط بين Model و View ويتحكم بالتدفق",
        points: 5
    },

    // ============================================
    // القسم الثاني: العملي (40 نقطة)
    // ============================================

    // --- أوامر Terminal (5 أسئلة × 2 نقطة = 10 نقاط) ---
    {
        id: 13,
        type: "command",
        question: "ما هو الأمر لإنشاء مشروع Laravel جديد باسم 'blog'؟",
        placeholder: "composer create-project ...",
        acceptedAnswers: [
            "composer create-project laravel/laravel blog",
            "composer create-project laravel/laravel blog --prefer-dist",
            "laravel new blog"
        ],
        caseSensitive: false,
        explanation: "الأمر الصحيح: composer create-project laravel/laravel blog",
        points: 2
    },
    {
        id: 14,
        type: "command",
        question: "ما هو الأمر لتشغيل السيرفر المحلي على المنفذ 8080؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan serve --port=8080",
            "php artisan serve --port 8080"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan serve --port=8080",
        points: 2
    },
    {
        id: 15,
        type: "command",
        question: "ما هو الأمر لإنشاء controller باسم UserController؟",
        placeholder: "php artisan make:...",
        acceptedAnswers: [
            "php artisan make:controller UserController"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan make:controller UserController",
        points: 2
    },
    {
        id: 16,
        type: "command",
        question: "ما هو الأمر لتشغيل migrations؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan migrate"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan migrate",
        points: 2
    },
    {
        id: 17,
        type: "command",
        question: "ما هو الأمر لعرض قائمة جميع الـ routes المتاحة؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan route:list"
        ],
        caseSensitive: false,
        explanation: "الأمر: php artisan route:list",
        points: 2
    },

    // --- قراءة كود (3 أسئلة × 5 نقاط = 15 نقطة) ---
    {
        id: 18,
        type: "code-reading",
        question: "ماذا يفعل هذا الكود؟\n\nRoute::get('/user/{id}', function ($id) {\n    return 'User ' . $id;\n});",
        options: [
            "ينشئ route يستقبل معامل id ويعرضه",
            "ينشئ جدول users في قاعدة البيانات",
            "ينشئ view لعرض المستخدمين",
            "يحذف المستخدم برقم id"
        ],
        correctAnswer: 0,
        explanation: "الكود ينشئ route للمسار /user/{id} يستقبل المعامل ويعرضه",
        points: 5
    },
    {
        id: 19,
        type: "code-reading",
        question: "ما هو نوع HTTP method المستخدم في هذا الـ route؟\n\nRoute::post('/submit', [FormController::class, 'store']);",
        options: [
            "GET",
            "POST",
            "PUT",
            "DELETE"
        ],
        correctAnswer: 1,
        explanation: "Route::post تعني أن HTTP method هو POST",
        points: 5
    },
    {
        id: 20,
        type: "code-reading",
        question: "ماذا يفعل هذا الكود في Blade؟\n\n{{ $name }}",
        options: [
            "يعرض قيمة المتغير name مع حماية من XSS",
            "يعرض قيمة المتغير name بدون حماية",
            "ينشئ متغير جديد name",
            "يحذف المتغير name"
        ],
        correctAnswer: 0,
        explanation: "{{ }} يعرض المتغير مع escape تلقائي للحماية من XSS",
        points: 5
    },

    // --- ملء فراغات (5 أسئلة × 3 نقاط = 15 نقاط) ---
    {
        id: 21,
        type: "fill-blank",
        question: "جميع routes الويب يتم تعريفها في ملف _____",
        correctAnswers: ["routes/web.php", "routes\\web.php", "web.php"],
        caseSensitive: false,
        placeholder: "routes/...",
        explanation: "الملف: routes/web.php",
        points: 3
    },
    {
        id: 22,
        type: "fill-blank",
        question: "محرك القوالب الافتراضي في Laravel يسمى _____",
        correctAnswers: ["Blade", "blade"],
        caseSensitive: false,
        placeholder: "اسم محرك القوالب",
        explanation: "محرك القوالب: Blade",
        points: 3
    },
    {
        id: 23,
        type: "fill-blank",
        question: "نقطة الدخول الرئيسية لتطبيق Laravel هي _____",
        correctAnswers: ["public/index.php", "public\\index.php"],
        caseSensitive: false,
        placeholder: "path/file.php",
        explanation: "نقطة الدخول: public/index.php",
        points: 3
    },
    {
        id: 24,
        type: "fill-blank",
        question: "Controllers توجد في مجلد _____",
        correctAnswers: ["app/Http/Controllers", "app\\Http\\Controllers"],
        caseSensitive: false,
        placeholder: "app/...",
        explanation: "المجلد: app/Http/Controllers",
        points: 3
    },
    {
        id: 25,
        type: "fill-blank",
        question: "للوصول للبيئة المحلية نستخدم الدومين _____",
        correctAnswers: ["localhost", "127.0.0.1"],
        caseSensitive: false,
        placeholder: "domain",
        explanation: "الدومين المحلي: localhost أو 127.0.0.1",
        points: 3
    },

    // ============================================
    // القسم الثالث: التطبيقي (30 نقطة)
    // ============================================

    // --- المشروع: صفحة "من نحن" كاملة ---
    {
        id: 26,
        type: "project",
        question: "المشروع العملي: إنشاء صفحة 'من نحن' (About Us) كاملة",
        subQuestions: [
            {
                id: "26a",
                question: "الخطوة 1: اكتب route للمسار '/about' (5 نقاط)",
                type: "code",
                language: "php",
                placeholder: "Route::get(...)",
                correctPatterns: [
                    /Route::get\(['"]\/about['"]\s*,\s*function/i,
                    /Route::get\(['"]\/about['"]\s*,\s*\[.+Controller/i
                ],
                sampleAnswer: "Route::get('/about', function() {\n    return view('about');\n});",
                points: 5
            },
            {
                id: "26b",
                question: "الخطوة 2: اكتب محتوى ملف resources/views/about.blade.php (10 نقاط)\nيجب أن يحتوي على:\n- عنوان الصفحة\n- فقرة عن الموقع\n- Laravel version\n- رابط للعودة",
                type: "code",
                language: "blade",
                placeholder: "<!DOCTYPE html>...",
                correctPatterns: [
                    /<h1>.*عن.*<\/h1>/i,
                    /{{\s*app\(\).*version/i,
                    /<a.*href.*>\s*.*<\/a>/i
                ],
                sampleAnswer: "<!DOCTYPE html>\n<html>\n<head>\n    <title>من نحن</title>\n</head>\n<body>\n    <h1>من نحن</h1>\n    <p>نحن موقع تعليمي متخصص في Laravel</p>\n    <p>Laravel Version: {{ app()->version() }}</p>\n    <a href='/'>العودة للرئيسية</a>\n</body>\n</html>",
                points: 10
            },
            {
                id: "26c",
                question: "الخطوة 3: اكتب أمر إنشاء PageController (5 نقاط)",
                type: "command",
                placeholder: "php artisan make:...",
                acceptedAnswers: [
                    "php artisan make:controller PageController"
                ],
                caseSensitive: false,
                points: 5
            },
            {
                id: "26d",
                question: "الخطوة 4: اكتب method في PageController لصفحة about (5 نقاط)",
                type: "code",
                language: "php",
                placeholder: "public function about() {...}",
                correctPatterns: [
                    /public\s+function\s+about\s*\(\)\s*{\s*return\s+view/i
                ],
                sampleAnswer: "public function about() {\n    return view('about');\n}",
                points: 5
            },
            {
                id: "26e",
                question: "الخطوة 5: اكتب route محدّث يستخدم PageController (5 نقاط)",
                type: "code",
                language: "php",
                placeholder: "Route::get(...)",
                correctPatterns: [
                    /Route::get\(['"]\/about['"]\s*,\s*\[PageController::class,\s*['"]about['"]\]/i
                ],
                sampleAnswer: "Route::get('/about', [PageController::class, 'about']);",
                points: 5
            }
        ],
        explanation: "مشروع متكامل يغطي Routes, Views, Controllers",
        points: 30
    }
];

// Calculate total points
const totalPoints = advancedExamQuestions.reduce((sum, q) => {
    if (q.type === 'project') {
        return sum + q.subQuestions.reduce((subSum, sq) => subSum + sq.points, 0);
    }
    return sum + q.points;
}, 0);

console.log(`✅ تم تحميل ${advancedExamQuestions.length} عنصر`);
console.log(`📊 مجموع النقاط: ${totalPoints}`);

// Export
if (typeof module !== 'undefined' && module.exports) {
    module.exports = advancedExamQuestions;
}
