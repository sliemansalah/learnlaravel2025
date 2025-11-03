/**
 * Laravel Learning - Interactive Exam Questions
 * Lesson 01: Introduction to Laravel
 */

const examQuestions = [
    {
        id: 1,
        question: "ما هو Laravel؟",
        options: [
            "لغة برمجة جديدة",
            "إطار عمل (Framework) لـ PHP",
            "قاعدة بيانات",
            "محرر نصوص"
        ],
        correctAnswer: 1,
        explanation: "Laravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.",
        points: 2
    },
    {
        id: 2,
        question: "أي من التالي يمثل معمارية MVC بشكل صحيح؟",
        options: [
            "Model = قاعدة البيانات، View = الكود، Controller = التصميم",
            "Model = البيانات والمنطق، View = العرض، Controller = الوسيط",
            "Model = Controller، View = Model، Controller = View",
            "Model = العرض، View = البيانات، Controller = المستخدم"
        ],
        correctAnswer: 1,
        explanation: "في MVC: Model يدير البيانات والمنطق التجاري، View يعرض البيانات للمستخدم، Controller الوسيط الذي يربط بين Model و View.",
        points: 2
    },
    {
        id: 3,
        question: "ما هو Composer؟",
        options: [
            "برنامج لتحرير النصوص",
            "أداة لإدارة الاعتماديات في PHP",
            "قاعدة بيانات",
            "متصفح ويب"
        ],
        correctAnswer: 1,
        explanation: "Composer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.",
        points: 2
    },
    {
        id: 4,
        question: "أي من المجلدات التالية يحتوي على Controllers في Laravel؟",
        options: [
            "resources/controllers/",
            "app/Http/Controllers/",
            "routes/controllers/",
            "public/controllers/"
        ],
        correctAnswer: 1,
        explanation: "في Laravel، جميع Controllers توجد في المجلد app/Http/Controllers/. هذا جزء من الهيكل القياسي للمشروع.",
        points: 2
    },
    {
        id: 5,
        question: "ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟",
        options: [
            "routes/web.php",
            "app/index.php",
            "public/index.php",
            "resources/index.php"
        ],
        correctAnswer: 2,
        explanation: "جميع الطلبات تبدأ من public/index.php. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.",
        points: 2
    },
    {
        id: 6,
        question: "Laravel يدعم فقط قاعدة بيانات MySQL.",
        type: "true-false",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Laravel يدعم عدة أنواع من قواعد البيانات: MySQL 5.7+, PostgreSQL 12.0+, SQLite 3.35.0+, SQL Server 2017+.",
        points: 2
    },
    {
        id: 7,
        question: "ملف .env يحتوي على معلومات حساسة ويجب عدم مشاركته.",
        type: "true-false",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "ملف .env يحتوي على معلومات حساسة مثل مفاتيح التطبيق، بيانات قاعدة البيانات، ومفاتيح API. وهو مُستثنى تلقائياً من Git عبر .gitignore.",
        points: 2
    },
    {
        id: 8,
        question: "الأمر php artisan serve يستخدم لإنشاء مشروع جديد.",
        type: "true-false",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "php artisan serve يستخدم لتشغيل السيرفر المحلي للتطوير. لإنشاء مشروع جديد نستخدم: composer create-project laravel/laravel project-name",
        points: 2
    },
    {
        id: 9,
        question: "في MVC، الـ View يجب أن يحتوي على منطق معقد للتطبيق.",
        type: "true-false",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "View يجب أن يحتوي فقط على كود العرض (HTML/CSS). المنطق المعقد يجب أن يكون في Controller أو Model.",
        points: 2
    },
    {
        id: 10,
        question: "Blade هو محرك القوالب (Template Engine) في Laravel.",
        type: "true-false",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "Blade هو محرك القوالب القوي والبسيط في Laravel. يسمح بكتابة PHP في ملفات العرض بطريقة نظيفة ومختصرة.",
        points: 2
    },
    {
        id: 11,
        question: "ما هو الأمر الصحيح لإنشاء مشروع Laravel جديد؟",
        options: [
            "laravel new project-name",
            "composer create-project laravel/laravel project-name",
            "php artisan create project-name",
            "npm create laravel-app"
        ],
        correctAnswer: 1,
        explanation: "الطريقة الموصى بها هي استخدام Composer: composer create-project laravel/laravel project-name. يمكن أيضاً استخدام Laravel Installer.",
        points: 3
    },
    {
        id: 12,
        question: "أي من الملفات التالية يحتوي على إعدادات البيئة (Environment Variables)؟",
        options: [
            "config/app.php",
            ".env",
            "routes/web.php",
            "composer.json"
        ],
        correctAnswer: 1,
        explanation: "ملف .env يحتوي على جميع إعدادات البيئة مثل اسم التطبيق، معلومات قاعدة البيانات، ومفاتيح API.",
        points: 3
    },
    {
        id: 13,
        question: "ما هي الطريقة الصحيحة لتعريف route بسيط في Laravel؟",
        options: [
            "Route::define('/', function() { ... });",
            "Route::get('/', function() { ... });",
            "Route::path('/', function() { ... });",
            "Route::create('/', function() { ... });"
        ],
        correctAnswer: 1,
        explanation: "الطريقة الصحيحة هي Route::get('/', function() { ... }); حيث get هي HTTP method والدالة هي callback.",
        points: 3
    },
    {
        id: 14,
        question: "أين يتم تعريف routes الخاصة بصفحات الويب في Laravel؟",
        options: [
            "app/routes.php",
            "config/routes.php",
            "routes/web.php",
            "public/routes.php"
        ],
        correctAnswer: 2,
        explanation: "جميع routes الخاصة بصفحات الويب يتم تعريفها في ملف routes/web.php. هناك أيضاً routes/api.php لـ API routes.",
        points: 3
    },
    {
        id: 15,
        question: "ما هو الأمر المستخدم لتشغيل السيرفر المحلي في Laravel؟",
        options: [
            "php artisan start",
            "php artisan run",
            "php artisan serve",
            "composer serve"
        ],
        correctAnswer: 2,
        explanation: "الأمر php artisan serve يقوم بتشغيل السيرفر المحلي على http://127.0.0.1:8000 افتراضياً. يمكن تغيير المنفذ باستخدام --port.",
        points: 3
    }
];

// Total points calculation
const totalPoints = examQuestions.reduce((sum, q) => sum + q.points, 0);
console.log(`Total exam points: ${totalPoints}`);
