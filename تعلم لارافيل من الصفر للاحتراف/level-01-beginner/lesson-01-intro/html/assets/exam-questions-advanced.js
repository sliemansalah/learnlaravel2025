/**
 * Laravel Learning - Advanced Interactive Exam Questions
 * Includes: MCQ, True/False, Essay, Code Writing, Commands, Fill-in-blanks
 */

const advancedExamQuestions = [
    // ============================================
    // Multiple Choice Questions (MCQ)
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
        explanation: "Laravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب.",
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
        explanation: "في MVC: Model يدير البيانات والمنطق، View يعرض البيانات، Controller الوسيط بينهما.",
        points: 2
    },

    // ============================================
    // True/False Questions
    // ============================================
    {
        id: 3,
        type: "true-false",
        question: "Laravel يدعم فقط قاعدة بيانات MySQL.",
        options: ["صح", "خطأ"],
        correctAnswer: 1,
        explanation: "Laravel يدعم MySQL, PostgreSQL, SQLite, SQL Server.",
        points: 2
    },
    {
        id: 4,
        type: "true-false",
        question: "ملف .env يحتوي على معلومات حساسة ويجب عدم مشاركته.",
        options: ["صح", "خطأ"],
        correctAnswer: 0,
        explanation: "ملف .env يحتوي على معلومات حساسة ومُستثنى من Git.",
        points: 2
    },

    // ============================================
    // Essay Questions (Short Answer)
    // ============================================
    {
        id: 5,
        type: "essay",
        question: "اشرح خطوات تثبيت Laravel على جهازك (5-6 خطوات رئيسية)",
        keywords: [
            "composer", "php", "artisan", "serve",
            "mysql", "database", "env", "متطلبات",
            "تثبيت", "create-project", "laravel"
        ],
        minWords: 20,
        maxWords: 200,
        sampleAnswer: "1. التأكد من تثبيت PHP 8.1+ و Composer\n2. تثبيت Laravel عبر Composer: composer create-project laravel/laravel project-name\n3. إعداد قاعدة البيانات في ملف .env\n4. تشغيل السيرفر: php artisan serve\n5. فتح المتصفح على localhost:8000",
        correctAnswer: null, // Will be graded by keywords
        explanation: "الخطوات الرئيسية: التحقق من المتطلبات، تثبيت عبر Composer، إعداد .env، تشغيل السيرفر",
        points: 5
    },
    {
        id: 6,
        type: "essay",
        question: "ما الفرق بين Model و Controller في Laravel؟ (3-4 نقاط)",
        keywords: [
            "model", "controller", "بيانات", "منطق",
            "database", "eloquent", "request", "response",
            "view", "وسيط", "عرض"
        ],
        minWords: 15,
        maxWords: 150,
        sampleAnswer: "Model: يتعامل مع البيانات وقاعدة البيانات ويحتوي على المنطق التجاري\nController: يتلقى الطلبات من المستخدم ويعالجها ويربط بين Model و View\nالفرق: Model للبيانات، Controller للتحكم بالتدفق",
        correctAnswer: null,
        explanation: "Model للبيانات والمنطق التجاري، Controller للتحكم بالتدفق بين Model و View",
        points: 5
    },

    // ============================================
    // Command Questions
    // ============================================
    {
        id: 7,
        type: "command",
        question: "ما هو الأمر الصحيح لإنشاء مشروع Laravel جديد باسم 'blog'؟",
        placeholder: "composer create-project ...",
        acceptedAnswers: [
            "composer create-project laravel/laravel blog",
            "composer create-project laravel/laravel blog --prefer-dist",
            "laravel new blog"
        ],
        caseSensitive: false,
        explanation: "الأمر الصحيح: composer create-project laravel/laravel blog",
        points: 3
    },
    {
        id: 8,
        type: "command",
        question: "ما هو الأمر لتشغيل السيرفر المحلي على المنفذ 8080؟",
        placeholder: "php artisan ...",
        acceptedAnswers: [
            "php artisan serve --port=8080",
            "php artisan serve --port 8080"
        ],
        caseSensitive: false,
        explanation: "الأمر الصحيح: php artisan serve --port=8080",
        points: 3
    },

    // ============================================
    // Code Writing Questions
    // ============================================
    {
        id: 9,
        type: "code",
        question: "اكتب الكود لتعريف route بسيط للمسار '/' يعرض رسالة 'مرحباً بك'",
        language: "php",
        placeholder: "Route::...",
        correctPatterns: [
            /Route::get\(['"]\/['"]\s*,\s*function\s*\(\)\s*{\s*return\s+['"].*مرحب.*['"]\s*;\s*}\)/i,
            /Route::get\(['"]\/['"]\s*,\s*fn\(\)\s*=>\s*['"].*مرحب.*['"]\)/i
        ],
        sampleAnswer: "Route::get('/', function() {\n    return 'مرحباً بك في Laravel';\n});",
        explanation: "استخدم Route::get() مع closure يعيد string",
        points: 5
    },
    {
        id: 10,
        type: "code",
        question: "اكتب كود view بسيط في Blade يعرض متغير \$name داخل h1",
        language: "blade",
        placeholder: "<!DOCTYPE html>...",
        correctPatterns: [
            /<h1>.*{{\s*\$name\s*}}.*<\/h1>/i,
            /<h1>.*{!!\s*\$name\s*!!}.*<\/h1>/i
        ],
        sampleAnswer: "<!DOCTYPE html>\n<html>\n<head>\n    <title>Welcome</title>\n</head>\n<body>\n    <h1>{{ $name }}</h1>\n</body>\n</html>",
        explanation: "استخدم {{ $name }} لعرض المتغير بشكل آمن",
        points: 5
    },

    // ============================================
    // Fill in the Blanks
    // ============================================
    {
        id: 11,
        type: "fill-blank",
        question: "في Laravel، جميع الـ Routes يتم تعريفها في ملف _____ لصفحات الويب",
        correctAnswers: ["routes/web.php", "routes\\web.php", "web.php"],
        caseSensitive: false,
        placeholder: "routes/...",
        explanation: "الملف الصحيح: routes/web.php",
        points: 2
    },
    {
        id: 12,
        type: "fill-blank",
        question: "محرك القوالب الافتراضي في Laravel يسمى _____",
        correctAnswers: ["Blade", "blade"],
        caseSensitive: false,
        placeholder: "اسم محرك القوالب",
        explanation: "محرك القوالب: Blade",
        points: 2
    },
    {
        id: 13,
        type: "fill-blank",
        question: "نقطة الدخول الرئيسية لتطبيق Laravel هي ملف _____",
        correctAnswers: ["public/index.php", "public\\index.php"],
        caseSensitive: false,
        placeholder: "path/to/file.php",
        explanation: "نقطة الدخول: public/index.php",
        points: 2
    },

    // ============================================
    // More Multiple Choice
    // ============================================
    {
        id: 14,
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
        points: 2
    },
    {
        id: 15,
        type: "multiple-choice",
        question: "ما هو الأمر المستخدم لتشغيل السيرفر المحلي؟",
        options: [
            "php artisan start",
            "php artisan run",
            "php artisan serve",
            "composer serve"
        ],
        correctAnswer: 2,
        explanation: "الأمر: php artisan serve",
        points: 2
    }
];

// Calculate total points
const totalPoints = advancedExamQuestions.reduce((sum, q) => sum + q.points, 0);
console.log(`Total exam points: ${totalPoints}`);

// Export for use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = advancedExamQuestions;
}
