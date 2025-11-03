# الدرس 1: الاختبار الشامل مع الحلول
# Lesson 1: Comprehensive Exam with Answers

**المدة المقترحة:** 90 دقيقة | Suggested Duration: 90 minutes
**الدرجة الكلية:** 100 نقطة | Total Score: 100 points

---

## 📋 تعليمات الاختبار | Exam Instructions

### طريقة الاستخدام:

1. **للدراسة والمراجعة:**
   - اقرأ السؤال
   - حاول الإجابة ذهنياً أو على ورقة
   - اقرأ الحل النموذجي
   - تأكد من فهمك الكامل

2. **معايير التقييم:**
   - الأسئلة النظرية: 30 نقطة (30%)
   - الأسئلة العملية: 40 نقطة (40%)
   - الأسئلة التطبيقية: 30 نقطة (30%)

3. **مستويات الإتقان:**
   - 90-100: ممتاز ✅ - انتقل للدرس التالي
   - 80-89: جيد جداً ✅ - راجع النقاط الضعيفة
   - 70-79: جيد ⚠️ - راجع الدرس مرة أخرى
   - أقل من 70: ❌ - أعد دراسة الدرس

---

## 📚 القسم الأول: الأسئلة النظرية (30 نقطة)

### السؤال 1: اختيار من متعدد (10 نقاط - نقطتان لكل سؤال)

#### 1.1 ما هو Laravel؟

a) لغة برمجة جديدة
b) إطار عمل (Framework) لـ PHP
c) قاعدة بيانات
d) محرر نصوص

**✅ الإجابة الصحيحة: b) إطار عمل (Framework) لـ PHP**

**الشرح:**
Laravel هو إطار عمل مفتوح المصدر مبني على لغة PHP، يستخدم لتطوير تطبيقات الويب. تم إنشاؤه بواسطة Taylor Otwell في 2011.

---

#### 1.2 أي من التالي يمثل معمارية MVC بشكل صحيح؟

a) Model = قاعدة البيانات، View = الكود، Controller = التصميم
b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط
c) Model = Controller، View = Model، Controller = View
d) Model = العرض، View = البيانات، Controller = المستخدم

**✅ الإجابة الصحيحة: b) Model = البيانات والمنطق، View = العرض، Controller = الوسيط**

**الشرح:**
- **Model:** يدير البيانات والمنطق التجاري (Business Logic)
- **View:** يعرض البيانات للمستخدم (HTML/CSS/JS)
- **Controller:** الوسيط الذي يربط بين Model و View

---

#### 1.3 ما هو Composer؟

a) برنامج لتحرير النصوص
b) أداة لإدارة الاعتماديات في PHP
c) قاعدة بيانات
d) متصفح ويب

**✅ الإجابة الصحيحة: b) أداة لإدارة الاعتماديات في PHP**

**الشرح:**
Composer هو أداة dependency manager لـ PHP، مشابه لـ npm في Node.js. يستخدم لتثبيت وإدارة المكتبات والحزم في مشاريع PHP.

---

#### 1.4 أي من المجلدات التالية يحتوي على Controllers في Laravel؟

a) resources/controllers/
b) app/Http/Controllers/
c) routes/controllers/
d) public/controllers/

**✅ الإجابة الصحيحة: b) app/Http/Controllers/**

**الشرح:**
في Laravel، جميع Controllers توجد في المجلد `app/Http/Controllers/`. هذا جزء من الهيكل القياسي للمشروع.

---

#### 1.5 ما هي نقطة الدخول الرئيسية لتطبيق Laravel؟

a) routes/web.php
b) app/index.php
c) public/index.php
d) resources/index.php

**✅ الإجابة الصحيحة: c) public/index.php**

**الشرح:**
جميع الطلبات تبدأ من `public/index.php`. هذا الملف يقوم بتحميل autoloader وإنشاء instance من التطبيق.

---

### السؤال 2: صح أم خطأ (10 نقاط - نقطتان لكل سؤال)

#### 2.1 Laravel يدعم فقط قاعدة بيانات MySQL.

**❌ خطأ - False**

**الشرح:**
Laravel يدعم عدة أنواع من قواعد البيانات:
- MySQL 5.7+
- PostgreSQL 12.0+
- SQLite 3.35.0+
- SQL Server 2017+

---

#### 2.2 ملف .env يحتوي على معلومات حساسة ويجب عدم مشاركته.

**✅ صح - True**

**الشرح:**
ملف `.env` يحتوي على معلومات حساسة مثل:
- مفاتيح التطبيق (APP_KEY)
- بيانات قاعدة البيانات
- مفاتيح API
- وهو مُستثنى تلقائياً من Git عبر `.gitignore`

---

#### 2.3 الأمر php artisan serve يستخدم لإنشاء مشروع جديد.

**❌ خطأ - False**

**الشرح:**
`php artisan serve` يستخدم لتشغيل السيرفر المحلي للتطوير.
لإنشاء مشروع جديد نستخدم:
```bash
composer create-project laravel/laravel project-name
```

---

#### 2.4 في MVC، الـ View يجب أن يحتوي على منطق معقد للتطبيق.

**❌ خطأ - False**

**الشرح:**
View يجب أن يحتوي فقط على:
- عرض البيانات
- منطق عرض بسيط (loops, conditions للعرض فقط)
- المنطق المعقد يجب أن يكون في Controller أو Model

---

#### 2.5 Laravel 11 يتطلب PHP 8.2 أو أحدث.

**✅ صح - True**

**الشرح:**
Laravel 11.x يتطلب:
- PHP >= 8.2
- Composer (أحدث إصدار)
- Extensions معينة (mbstring, openssl, pdo, etc.)

---

### السؤال 3: أسئلة مقالية قصيرة (10 نقاط)

#### 3.1 اشرح دورة حياة الطلب (Request Lifecycle) في Laravel بإيجاز. (5 نقاط)

**✅ الإجابة النموذجية:**

دورة حياة الطلب في Laravel تمر بالخطوات التالية:

1. **Entry Point:** يبدأ من `public/index.php`
2. **HTTP Kernel:** يتم تحميل HTTP Kernel
3. **Service Providers:** يتم تسجيل وتشغيل Service Providers
4. **Router:** يبحث عن Route المناسب للطلب
5. **Middleware:** يتم تشغيل Middleware (Authentication, CSRF, etc.)
6. **Controller:** ينفذ كود Controller المناسب
7. **Response:** يتم إنشاء Response (HTML, JSON, etc.)
8. **Middleware (Return):** يمر Response عبر Middleware مرة أخرى
9. **Browser:** يُرسل Response للمتصفح

**معايير التقييم:**
- ذكر 5-6 خطوات رئيسية: 3 نقاط
- شرح مختصر لكل خطوة: 2 نقطة

---

#### 3.2 ما الفرق بين Model و Controller في Laravel؟ (5 نقاط)

**✅ الإجابة النموذجية:**

**Model:**
- يمثل البيانات وجداول قاعدة البيانات
- يحتوي على المنطق التجاري (Business Logic)
- يدير العلاقات بين الجداول
- يستخدم Eloquent ORM
- مثال: `User`, `Post`, `Product`

**Controller:**
- يستقبل طلبات المستخدم (HTTP Requests)
- يعالج البيانات ويحضرها
- يستدعي Models للحصول على البيانات
- يُرجع Views أو Responses
- مثال: `UserController`, `PostController`

**الفرق الأساسي:**
- Model = **ماذا** (What) - البيانات والمنطق
- Controller = **كيف** (How) - معالجة الطلبات

**معايير التقييم:**
- شرح Model: نقطتان
- شرح Controller: نقطتان
- ذكر الفرق الأساسي: نقطة واحدة

---

## 💻 القسم الثاني: الأسئلة العملية (40 نقطة)

### السؤال 4: أوامر Terminal (10 نقاط - نقطتان لكل سؤال)

#### 4.1 ما هو الأمر الصحيح لإنشاء مشروع Laravel جديد باسم "blog"؟

**✅ الإجابة الصحيحة:**
```bash
composer create-project laravel/laravel blog
```

**أو:**
```bash
laravel new blog
```

**الشرح:**
- الطريقة الأولى تستخدم Composer مباشرة
- الطريقة الثانية تتطلب تثبيت Laravel Installer أولاً

---

#### 4.2 ما هو الأمر لتشغيل السيرفر المحلي على المنفذ 8080؟

**✅ الإجابة الصحيحة:**
```bash
php artisan serve --port=8080
```

**الشرح:**
- `php artisan serve` يشغل على المنفذ 8000 افتراضياً
- `--port=8080` يحدد منفذ مختلف
- يمكن أيضاً تحديد host: `--host=192.168.1.100`

---

#### 4.3 ما هو الأمر لتشغيل Migrations؟

**✅ الإجابة الصحيحة:**
```bash
php artisan migrate
```

**أوامر ذات صلة:**
```bash
php artisan migrate:fresh    # إعادة إنشاء كل الجداول
php artisan migrate:rollback # التراجع عن آخر migration
php artisan migrate:status   # عرض حالة migrations
```

---

#### 4.4 ما هو الأمر لمسح جميع أنواع Cache؟

**✅ الإجابة الصحيحة:**
```bash
php artisan optimize:clear
```

**أو بشكل منفصل:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

#### 4.5 ما هو الأمر لفتح Laravel Tinker؟

**✅ الإجابة الصحيحة:**
```bash
php artisan tinker
```

**الشرح:**
Tinker هو REPL (Read-Eval-Print Loop) يسمح بتنفيذ كود PHP بشكل تفاعلي.

مثال:
```php
>>> App\Models\User::count()
=> 10
>>> $user = App\Models\User::first()
>>> $user->name
=> "John Doe"
```

---

### السؤال 5: قراءة وفهم الكود (15 نقطة)

#### 5.1 اشرح ماذا يفعل هذا الكود: (5 نقاط)

```php
Route::get('/users/{id}', function ($id) {
    return "User ID: " . $id;
});
```

**✅ الإجابة النموذجية:**

هذا الكود يُعرّف route في Laravel:

1. **`Route::get()`**: يحدد أن هذا route يستجيب لـ GET request
2. **`'/users/{id}'`**: المسار، حيث `{id}` هو parameter متغير
3. **`function ($id)`**: دالة مجهولة (closure) تستقبل قيمة `{id}`
4. **`return`**: يُرجع نص يحتوي على User ID

**أمثلة على الاستخدام:**
- زيارة `/users/5` → يعرض "User ID: 5"
- زيارة `/users/123` → يعرض "User ID: 123"

**معايير التقييم:**
- شرح Route::get(): نقطة
- شرح parameter: نقطتان
- شرح الناتج: نقطتان

---

#### 5.2 ما الخطأ في هذا الكود؟ (5 نقاط)

```php
Route::get('/about', function () {
    return view('about-page');
});
```

**الكود الصحيح يجب أن يكون:**
```php
Route::get('/about', function () {
    return view('about-page');  // أو 'about_page' أو 'about'
});
```

**✅ الإجابة النموذجية:**

الكود نفسه **ليس خطأ** من الناحية التقنية، لكن:

**المشكلة المحتملة:**
- اسم View `'about-page'` يحتوي على شرطة (-)
- Laravel سيبحث عن ملف: `resources/views/about-page.blade.php`
- **التسمية القياسية:** يُفضل استخدام underscore أو camelCase

**الطريقة الموصى بها:**
```php
return view('about');      // about.blade.php
return view('about_page'); // about_page.blade.php
return view('aboutPage');  // aboutPage.blade.php
```

**ملاحظة:** إذا كان الملف موجود بالاسم `about-page.blade.php`، فالكود سيعمل بدون مشاكل.

---

#### 5.3 اشرح هذا الكود: (5 نقاط)

```php
$users = User::where('status', 'active')
              ->orderBy('created_at', 'desc')
              ->limit(10)
              ->get();
```

**✅ الإجابة النموذجية:**

هذا كود Eloquent ORM يقوم بالتالي:

1. **`User::where('status', 'active')`**
   - يبحث عن المستخدمين الذين status = 'active'

2. **`->orderBy('created_at', 'desc')`**
   - يرتب النتائج حسب تاريخ الإنشاء من الأحدث للأقدم

3. **`->limit(10)`**
   - يحدد النتائج بـ 10 صفوف فقط

4. **`->get()`**
   - ينفذ الاستعلام ويُرجع Collection من النتائج

**الناتج:** Collection يحتوي على أحدث 10 مستخدمين نشطين.

**SQL المقابل:**
```sql
SELECT * FROM users
WHERE status = 'active'
ORDER BY created_at DESC
LIMIT 10;
```

**معايير التقييم:**
- شرح where: نقطة
- شرح orderBy: نقطة
- شرح limit: نقطة
- شرح get(): نقطة
- ذكر الناتج النهائي: نقطة

---

### السؤال 6: ملء الفراغات (15 نقطة - 3 نقاط لكل فراغ)

#### 6.1 أكمل الكود لإنشاء route يعرض view اسمه "contact":

```php
Route::___('/contact', function () {
    return ___('contact');
});
```

**✅ الإجابة الصحيحة:**
```php
Route::get('/contact', function () {
    return view('contact');
});
```

---

#### 6.2 أكمل الكود لتعريف Model اسمه Post يرث من Eloquent:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends ___
{
    protected $fillable = ['___', '___', '___'];
}
```

**✅ الإجابة الصحيحة:**
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];
    // أو أي أعمدة أخرى مناسبة: ['title', 'body', 'status']
}
```

---

#### 6.3 أكمل الأمر لإنشاء Controller اسمه PostController:

```bash
php artisan ___:___ PostController
```

**✅ الإجابة الصحيحة:**
```bash
php artisan make:controller PostController
```

---

#### 6.4 أكمل الكود لعرض Laravel version في Blade:

```blade
<p>Laravel Version: {{ ___()->version() }}</p>
```

**✅ الإجابة الصحيحة:**
```blade
<p>Laravel Version: {{ app()->version() }}</p>
```

---

#### 6.5 أكمل متغيرات .env لقاعدة بيانات MySQL:

```env
DB_CONNECTION=___
DB_HOST=___
DB_PORT=___
DB_DATABASE=my_app
DB_USERNAME=root
DB_PASSWORD=
```

**✅ الإجابة الصحيحة:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_app
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🚀 القسم الثالث: الأسئلة التطبيقية (30 نقطة)

### السؤال 7: مشروع عملي صغير (30 نقطة)

**المطلوب:** إنشاء صفحة "من نحن" (About Us) في مشروع Laravel

#### 7.1 الخطوة 1: إنشاء Route (5 نقاط)

**المطلوب:** أضف route في `routes/web.php` للمسار `/about`

**✅ الحل النموذجي:**
```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route جديد
Route::get('/about', function () {
    return view('about');
});
```

**معايير التقييم:**
- استخدام Route::get() صحيح: نقطتان
- المسار '/about' صحيح: نقطة
- return view() صحيح: نقطتان

---

#### 7.2 الخطوة 2: إنشاء View (10 نقاط)

**المطلوب:** أنشئ ملف `resources/views/about.blade.php` يعرض:
- عنوان الصفحة "من نحن"
- فقرة عن الموقع
- Laravel version
- رابط للعودة للصفحة الرئيسية

**✅ الحل النموذجي:**
```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>من نحن</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            line-height: 1.8;
        }
        h1 {
            color: #667eea;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-right: 5px solid #667eea;
            margin: 20px 0;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        a:hover {
            background: #5568d3;
        }
    </style>
</head>
<body>
    <h1>من نحن</h1>

    <div class="info-box">
        <h2>عن موقعنا</h2>
        <p>
            نحن موقع تعليمي متخصص في تعليم Laravel من الصفر إلى الاحتراف.
            نهدف إلى توفير محتوى تعليمي عالي الجودة باللغة العربية.
        </p>
    </div>

    <div class="info-box">
        <h2>تقنياتنا</h2>
        <p>نستخدم أحدث التقنيات:</p>
        <ul>
            <li>Laravel {{ app()->version() }}</li>
            <li>PHP {{ PHP_VERSION }}</li>
            <li>MySQL Database</li>
        </ul>
    </div>

    <a href="/">← العودة للصفحة الرئيسية</a>
</body>
</html>
```

**معايير التقييم:**
- HTML structure صحيح: نقطتان
- عنوان "من نحن": نقطة
- محتوى مناسب: نقطتان
- عرض Laravel version: نقطتان
- رابط العودة: نقطة
- تنسيق CSS: نقطتان

---

#### 7.3 الخطوة 3: تحسين Route (5 نقاط)

**المطلوب:** بدلاً من استخدام Closure، أنشئ Controller

**الأمر لإنشاء Controller:**
```bash
php artisan make:controller PageController
```

**✅ محتوى PageController:**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $data = [
            'page_title' => 'من نحن',
            'site_name' => 'موقع تعليم Laravel',
            'description' => 'نحن موقع متخصص في تعليم Laravel'
        ];

        return view('about', $data);
    }
}
```

**✅ تحديث Route:**
```php
use App\Http\Controllers\PageController;

Route::get('/about', [PageController::class, 'about']);
```

**معايير التقييم:**
- إنشاء Controller: نقطة
- Method صحيح: نقطتان
- تحديث Route: نقطتان

---

#### 7.4 الخطوة 4: تمرير البيانات (5 نقاط)

**المطلوب:** عدّل View لاستخدام البيانات الممررة

**✅ View محدّث:**
```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title }}</title>
    <!-- ... -->
</head>
<body>
    <h1>{{ $page_title }}</h1>

    <div class="info-box">
        <h2>عن {{ $site_name }}</h2>
        <p>{{ $description }}</p>
    </div>

    <!-- ... -->
</body>
</html>
```

**معايير التقييم:**
- استخدام {{ $page_title }}: نقطة
- استخدام {{ $site_name }}: نقطة
- استخدام {{ $description }}: نقطة
- Blade syntax صحيح: نقطتان

---

#### 7.5 الخطوة 5: التحقق من العمل (5 نقاط)

**خطوات التحقق:**

1. تشغيل السيرفر:
```bash
php artisan serve
```

2. زيارة: `http://localhost:8000/about`

3. التأكد من:
   - ✅ الصفحة تعرض بشكل صحيح
   - ✅ العنوان يظهر
   - ✅ المحتوى يظهر
   - ✅ Laravel version يظهر
   - ✅ رابط العودة يعمل

**✅ لقطة شاشة أو وصف للناتج المتوقع:**
```
╔════════════════════════════════════╗
║                                    ║
║          من نحن                    ║
║ ──────────────────────────────     ║
║                                    ║
║  عن موقع تعليم Laravel            ║
║  نحن موقع متخصص في تعليم Laravel  ║
║                                    ║
║  التقنيات المستخدمة:               ║
║  • Laravel 11.x                    ║
║  • PHP 8.2                         ║
║                                    ║
║  [← العودة للصفحة الرئيسية]        ║
║                                    ║
╚════════════════════════════════════╝
```

**معايير التقييم:**
- الصفحة تعمل: 3 نقاط
- جميع العناصر تظهر: نقطتان

---

## 📊 ملخص الاختبار

### توزيع الدرجات:

| القسم | عدد الأسئلة | الدرجة |
|-------|-------------|--------|
| **القسم الأول: النظري** | 15 سؤال | 30 نقطة |
| - اختيار من متعدد | 5 أسئلة | 10 نقاط |
| - صح وخطأ | 5 أسئلة | 10 نقاط |
| - مقالية قصيرة | 2 سؤال | 10 نقاط |
| **القسم الثاني: العملي** | 15 سؤال | 40 نقطة |
| - أوامر Terminal | 5 أسئلة | 10 نقاط |
| - قراءة كود | 3 أسئلة | 15 نقطة |
| - ملء فراغات | 5 أسئلة | 15 نقطة |
| **القسم الثالث: التطبيقي** | مشروع واحد | 30 نقطة |
| **الإجمالي** | | **100 نقطة** |

---

## 🎯 معايير التقييم النهائية

### احسب نقاطك:

```
النقاط الكلية: _____ / 100

النسبة المئوية: _____%

المستوى:
□ 90-100%: ممتاز ✅
□ 80-89%: جيد جداً ✅
□ 70-79%: جيد ⚠️
□ أقل من 70%: يحتاج مراجعة ❌
```

### التوصيات حسب النتيجة:

#### ✅ 90-100% (ممتاز)
```
مبروك! أنت جاهز للدرس التالي!
- فهمك ممتاز للمفاهيم الأساسية
- يمكنك الانتقال للدرس 2: Routing
```

#### ✅ 80-89% (جيد جداً)
```
أداء جيد! راجع النقاط التالية:
- الأسئلة التي أخطأت فيها
- أعد قراءة الأقسام المتعلقة بها
- ثم انتقل للدرس التالي
```

#### ⚠️ 70-79% (جيد)
```
تحتاج لمراجعة:
- أعد دراسة الدرس النظري
- طبّق التمارين العملية مرة أخرى
- أعد الاختبار بعد المراجعة
```

#### ❌ أقل من 70% (يحتاج مراجعة)
```
يُنصح بـ:
- إعادة دراسة الدرس كاملاً
- مشاهدة فيديوهات تعليمية إضافية
- التطبيق العملي أكثر
- طلب المساعدة من المجتمع
- إعادة الاختبار
```

---

## 📝 ملاحظات مهمة

### للحصول على أقصى استفادة:

1. **لا تحفظ الإجابات**
   - افهم المفاهيم بعمق
   - الحفظ لن يفيدك في المشاريع الحقيقية

2. **طبّق عملياً**
   - اكتب الكود بنفسك
   - جرّب تعديلات مختلفة
   - اكسر الكود وصلحه (Learn by Doing)

3. **استخدم المصادر**
   - وثائق Laravel الرسمية
   - Laracasts
   - مجتمع Laravel

4. **لا تتردد في السؤال**
   - Laravel IO Forum
   - Laravel Discord
   - Stack Overflow

---

## 🔄 الخطوة التالية

**بعد إتمام هذا الاختبار بنجاح:**

1. ✅ راجع أي أخطاء
2. ✅ تأكد من فهم جميع المفاهيم
3. ✅ انتقل إلى ملف `04-exam-only.md` لاختبار نفسك بدون حلول
4. ✅ ثم انتقل إلى **الدرس 2: Routing**

---

**تاريخ الإنشاء:** 2025-11-03
**الإصدار:** 1.0
**المستوى:** مبتدئ
**متوافق مع:** Laravel 11.x

**حظاً موفقاً! 🚀**
