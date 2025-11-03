/**
 * Auto-generated 100 Questions for Interactive Exam
 * Generated on: 2025-11-03T10:34:42.724Z
 * Total Points: 108
 */

const advancedExamQuestions = [
    {
        "id": 1,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 2,
        "type": "multiple-choice",
        "question": "أي من التالي يمثل معمارية MVC بشكل صحيح؟",
        "options": [
            "Model = العرض، View = البيانات، Controller = المستخدم"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 3,
        "type": "multiple-choice",
        "question": "ما هو Composer؟",
        "options": [
            "متصفح ويب"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 4,
        "type": "multiple-choice",
        "question": "أي من المجلدات التالية يحتوي على Controllers في Laravel؟",
        "options": [
            "public/controllers/"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 5,
        "type": "multiple-choice",
        "question": "ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟",
        "options": [
            "resources/index.php"
        ],
        "correctAnswer": 2,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 6,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL.",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 7,
        "type": "true-false",
        "question": "ملف .env يحتوي على معلومات حساسة ويجب عدم مشاركته.",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 0,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 8,
        "type": "true-false",
        "question": "الأمر php artisan serve يستخدم لإنشاء مشروع جديد.",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 9,
        "type": "true-false",
        "question": "في MVC، الـ View يجب أن يحتوي على منطق معقد للتطبيق.",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 10,
        "type": "true-false",
        "question": "Laravel 11 يتطلب PHP 8.2 أو أحدث.",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 0,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 11,
        "type": "essay",
        "question": "اشرح خطوات تثبيت Laravel على جهازك بالتفصيل",
        "keywords": [
            "composer",
            "php",
            "artisan",
            "serve",
            "mysql",
            "database",
            "env",
            "تثبيت"
        ],
        "minWords": 30,
        "maxWords": 200,
        "sampleAnswer": "راجع الدرس النظري للإجابة النموذجية",
        "explanation": "يجب تغطية النقاط الرئيسية المذكورة في keywords",
        "points": 2
    },
    {
        "id": 12,
        "type": "essay",
        "question": "ما الفرق بين Model و Controller في Laravel؟",
        "keywords": [
            "model",
            "controller",
            "بيانات",
            "منطق",
            "database",
            "request",
            "response"
        ],
        "minWords": 20,
        "maxWords": 150,
        "sampleAnswer": "راجع الدرس النظري للإجابة النموذجية",
        "explanation": "يجب تغطية النقاط الرئيسية المذكورة في keywords",
        "points": 2
    },
    {
        "id": 13,
        "type": "essay",
        "question": "اشرح دورة حياة الطلب (Request Lifecycle) في Laravel",
        "keywords": [
            "index.php",
            "kernel",
            "middleware",
            "route",
            "controller",
            "response"
        ],
        "minWords": 25,
        "maxWords": 180,
        "sampleAnswer": "راجع الدرس النظري للإجابة النموذجية",
        "explanation": "يجب تغطية النقاط الرئيسية المذكورة في keywords",
        "points": 2
    },
    {
        "id": 14,
        "type": "essay",
        "question": "ما هي فوائد استخدام Laravel مقارنة بـ PHP النقي؟",
        "keywords": [
            "framework",
            "mvc",
            "security",
            "eloquent",
            "blade",
            "routing",
            "middleware"
        ],
        "minWords": 20,
        "maxWords": 150,
        "sampleAnswer": "راجع الدرس النظري للإجابة النموذجية",
        "explanation": "يجب تغطية النقاط الرئيسية المذكورة في keywords",
        "points": 2
    },
    {
        "id": 15,
        "type": "essay",
        "question": "اشرح مفهوم Middleware في Laravel وأهميته",
        "keywords": [
            "middleware",
            "request",
            "filter",
            "authentication",
            "authorization",
            "before",
            "after"
        ],
        "minWords": 20,
        "maxWords": 150,
        "sampleAnswer": "راجع الدرس النظري للإجابة النموذجية",
        "explanation": "يجب تغطية النقاط الرئيسية المذكورة في keywords",
        "points": 2
    },
    {
        "id": 16,
        "type": "code",
        "question": "اكتب route بسيط للمسار '/welcome' يعرض رسالة 'مرحباً بك'",
        "language": "php",
        "placeholder": "Route::...",
        "correctPatterns": [
            {}
        ],
        "sampleAnswer": "Route::get('/welcome', function() {\n    return 'مرحباً بك';\n});",
        "points": 2,
        "explanation": "راجع أمثلة الكود في الدرس"
    },
    {
        "id": 17,
        "type": "code",
        "question": "اكتب view blade بسيط يعرض عنوان h1 مع متغير $title",
        "language": "blade",
        "placeholder": "<!DOCTYPE html>...",
        "correctPatterns": [
            {}
        ],
        "sampleAnswer": "<h1>{{ $title }}</h1>",
        "points": 2,
        "explanation": "راجع أمثلة الكود في الدرس"
    },
    {
        "id": 18,
        "type": "code",
        "question": "اكتب route يستقبل معامل {id} ويعرضه",
        "language": "php",
        "placeholder": "Route::...",
        "correctPatterns": [
            {}
        ],
        "sampleAnswer": "Route::get('/user/{id}', function($id) {\n    return 'User: ' . $id;\n});",
        "points": 2,
        "explanation": "راجع أمثلة الكود في الدرس"
    },
    {
        "id": 19,
        "type": "command",
        "question": "ما هو الأمر لإنشاء مشروع Laravel جديد باسم 'myapp'؟",
        "placeholder": "composer...",
        "acceptedAnswers": [
            "composer create-project laravel/laravel myapp",
            "laravel new myapp"
        ],
        "caseSensitive": false,
        "points": 1,
        "explanation": "راجع قسم الأوامر في الدرس"
    },
    {
        "id": 20,
        "type": "command",
        "question": "ما هو الأمر لتشغيل السيرفر المحلي على المنفذ 8000؟",
        "placeholder": "php artisan...",
        "acceptedAnswers": [
            "php artisan serve",
            "php artisan serve --port=8000"
        ],
        "caseSensitive": false,
        "points": 1,
        "explanation": "راجع قسم الأوامر في الدرس"
    },
    {
        "id": 21,
        "type": "command",
        "question": "ما هو الأمر لإنشاء controller باسم HomeController؟",
        "placeholder": "php artisan...",
        "acceptedAnswers": [
            "php artisan make:controller HomeController"
        ],
        "caseSensitive": false,
        "points": 1,
        "explanation": "راجع قسم الأوامر في الدرس"
    },
    {
        "id": 22,
        "type": "command",
        "question": "ما هو الأمر لإنشاء model باسم User؟",
        "placeholder": "php artisan...",
        "acceptedAnswers": [
            "php artisan make:model User"
        ],
        "caseSensitive": false,
        "points": 1,
        "explanation": "راجع قسم الأوامر في الدرس"
    },
    {
        "id": 23,
        "type": "command",
        "question": "ما هو الأمر لتشغيل migrations؟",
        "placeholder": "php artisan...",
        "acceptedAnswers": [
            "php artisan migrate"
        ],
        "caseSensitive": false,
        "points": 1,
        "explanation": "راجع قسم الأوامر في الدرس"
    },
    {
        "id": 24,
        "type": "fill-blank",
        "question": "جميع routes الويب يتم تعريفها في ملف _____",
        "correctAnswers": [
            "routes/web.php",
            "routes\\web.php",
            "web.php"
        ],
        "caseSensitive": false,
        "placeholder": "routes/...",
        "points": 1,
        "explanation": "راجع الدرس النظري"
    },
    {
        "id": 25,
        "type": "fill-blank",
        "question": "محرك القوالب في Laravel يسمى _____",
        "correctAnswers": [
            "Blade",
            "blade"
        ],
        "caseSensitive": false,
        "placeholder": "اسم محرك القوالب",
        "points": 1,
        "explanation": "راجع الدرس النظري"
    },
    {
        "id": 26,
        "type": "fill-blank",
        "question": "نقطة الدخول الرئيسية لتطبيق Laravel هي _____",
        "correctAnswers": [
            "public/index.php",
            "public\\index.php"
        ],
        "caseSensitive": false,
        "placeholder": "path/file.php",
        "points": 1,
        "explanation": "راجع الدرس النظري"
    },
    {
        "id": 27,
        "type": "fill-blank",
        "question": "Controllers توجد في مجلد _____",
        "correctAnswers": [
            "app/Http/Controllers",
            "app\\Http\\Controllers"
        ],
        "caseSensitive": false,
        "placeholder": "app/...",
        "points": 1,
        "explanation": "راجع الدرس النظري"
    },
    {
        "id": 28,
        "type": "fill-blank",
        "question": "الأمر _____ يستخدم لتشغيل السيرفر المحلي",
        "correctAnswers": [
            "php artisan serve",
            "artisan serve"
        ],
        "caseSensitive": false,
        "placeholder": "php...",
        "points": 1,
        "explanation": "راجع الدرس النظري"
    },
    {
        "id": 29,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 30,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 31,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 32,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 33,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 34,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 35,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 36,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 37,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 38,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 39,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 40,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 41,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 42,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 43,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 44,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 45,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 46,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 47,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 48,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 49,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 50,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 51,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 52,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 53,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 54,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 55,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 56,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 57,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 58,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 59,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 60,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 61,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 62,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 63,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 64,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 65,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 66,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 67,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 68,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 69,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 70,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 71,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 72,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 73,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 74,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 75,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 76,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 77,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 78,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 79,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 80,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 81,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 82,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 83,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 84,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 85,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 86,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 87,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 88,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 89,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 90,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 91,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 92,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 93,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 94,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 95,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 96,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 97,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 98,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    },
    {
        "id": 99,
        "type": "multiple-choice",
        "question": "ما هو Laravel؟ (مراجعة)",
        "options": [
            "محرر نصوص"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري للمزيد من التفاصيل",
        "points": 1
    },
    {
        "id": 100,
        "type": "true-false",
        "question": "ما هو Laravel؟\n\na) لغة برمجة جديدة\nb) إطار عمل (Framework) لـ PHP\nc) قاعدة بيانات\nd) محرر نصوص\n\n**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**\n\n**الشرح:**\nLaravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.\n\n---\n\n#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟\n\na) Model = قاعدة البيانات، View = الكود، Controller = التصميم\nb) Model = البيانات والمنطق، View = العرض، Controller = الوسيط\nc) Model = Controller، View = Model، Controller = View\nd) Model = العرض، View = البيانات، Controller = المستخدم\n\n**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**\n\n**الشرح:**\n- **Model:** يدير البيانات والمنطق التجاري (Business Logic)\n- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)\n- **Controller:** الوسيط الذي يربط بين Model و View\n\n---\n\n#### 1.3 ما هو Composer؟\n\na) برنامج لتحرير النصوص\nb) أداة لإدارة الاعتماديات في PHP\nc) قاعدة بيانات\nd) متصفح ويب\n\n**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**\n\n**الشرح:**\nComposer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.\n\n---\n\n#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟\n\na) resources/controllers/\nb) app/Http/Controllers/\nc) routes/controllers/\nd) public/controllers/\n\n**✅ الإجابة الصحيحة: b) app/Http/Controllers/**\n\n**الشرح:**\nفي Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.\n\n---\n\n#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟\n\na) routes/web.php\nb) app/index.php\nc) public/index.php\nd) resources/index.php\n\n**✅ الإجابة الصحيحة: c) public/index.php**\n\n**الشرح:**\nجميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.\n\n---\n\n### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)\n\n#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL. (تأكيد)",
        "options": [
            "صح",
            "خطأ"
        ],
        "correctAnswer": 1,
        "explanation": "راجع الدرس النظري",
        "points": 1
    }
];

// Total points calculation
const totalPoints = advancedExamQuestions.reduce((sum, q) => sum + q.points, 0);
console.log(`✅ تم تحميل ${advancedExamQuestions.length} سؤال`);
console.log(`📊 مجموع النقاط: ${totalPoints}`);

// Export
if (typeof module !== 'undefined' && module.exports) {
    module.exports = advancedExamQuestions;
}
