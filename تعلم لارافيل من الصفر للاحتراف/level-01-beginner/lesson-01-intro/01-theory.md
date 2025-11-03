# الدرس 1: مقدمة إلى Laravel والبيئة التطويرية
# Lesson 1: Introduction to Laravel and Development Environment

**المستوى:** مبتدئ | Beginner
**المدة المقدرة:** 3-4 ساعات | 3-4 hours
**المتطلبات السابقة:** معرفة أساسية بـ PHP و HTML | Basic knowledge of PHP and HTML

---

## 📑 جدول المحتويات | Table of Contents

1. [ما هو Laravel؟](#ما-هو-laravel)
2. [لماذا نستخدم Laravel؟](#لماذا-نستخدم-laravel)
3. [معمارية MVC](#معمارية-mvc)
4. [متطلبات النظام](#متطلبات-النظام)
5. [أدوات التطوير](#أدوات-التطوير)
6. [Composer وإدارة الحزم](#composer-وإدارة-الحزم)
7. [هيكل مشروع Laravel](#هيكل-مشروع-laravel)
8. [دورة حياة الطلب](#دورة-حياة-الطلب)

---

## 🎯 أهداف الدرس | Lesson Objectives

بنهاية هذا الدرس، ستكون قادراً على:

- ✅ فهم ماهية Laravel ولماذا نستخدمه
- ✅ فهم معمارية MVC بشكل واضح
- ✅ تثبيت وإعداد بيئة تطوير Laravel
- ✅ فهم دور Composer في Laravel
- ✅ التعرف على هيكل ملفات ومجلدات Laravel
- ✅ فهم دورة حياة الطلب في Laravel

By the end of this lesson, you will be able to:

- ✅ Understand what Laravel is and why we use it
- ✅ Understand MVC architecture clearly
- ✅ Install and set up Laravel development environment
- ✅ Understand the role of Composer in Laravel
- ✅ Know Laravel's file and folder structure
- ✅ Understand request lifecycle in Laravel

---

## 📚 ما هو Laravel؟

### التعريف | Definition

**Laravel** هو إطار عمل (Framework) مفتوح المصدر لتطوير تطبيقات الويب باستخدام لغة PHP. تم إنشاؤه بواسطة **Taylor Otwell** في عام 2011، وهو الآن أحد أكثر أطر عمل PHP شعبية واستخداماً في العالم.

**Laravel** is an open-source web application framework written in PHP. Created by **Taylor Otwell** in 2011, it is now one of the most popular and widely used PHP frameworks in the world.

### الفلسفة | Philosophy

Laravel يتبع فلسفة "البساطة والأناقة"، ويهدف إلى:

- **جعل عملية التطوير ممتعة** دون التضحية بالوظائف
- **توفير صياغة واضحة وأنيقة** (Expressive Syntax)
- **تسريع عملية التطوير** من خلال أدوات جاهزة
- **توفير أفضل الممارسات** بشكل افتراضي

Laravel follows the philosophy of "simplicity and elegance," aiming to:

- **Make development enjoyable** without sacrificing functionality
- **Provide clear and elegant syntax**
- **Speed up development** through ready-made tools
- **Provide best practices** by default

### الإصدارات | Versions

Laravel يتبع نظام **Semantic Versioning**:

```
الإصدار الحالي (2025): Laravel 11.x
Current Version (2025): Laravel 11.x

نظام الإصدارات:
- Major.Minor.Patch
- مثال: 11.2.5
  - 11 = إصدار رئيسي (Major)
  - 2 = إصدار ثانوي (Minor)
  - 5 = تحديث صيانة (Patch)
```

**دورة الإصدارات:**
- إصدار رئيسي جديد كل عام (فبراير)
- دعم Bug Fixes لمدة 18 شهر
- دعم الأمان لمدة سنتين

---

## 💡 لماذا نستخدم Laravel؟

### 1. الإنتاجية العالية | High Productivity

```
✅ Authentication & Authorization جاهزة
✅ ORM قوي (Eloquent)
✅ Queue System متكامل
✅ Email & Notifications سهلة
✅ File Storage مبسط
✅ Task Scheduling مدمج
```

### 2. المجتمع النشط | Active Community

- 📊 أكثر من 75,000 نجمة على GitHub
- 📚 وثائق شاملة ومُحدثة باستمرار
- 🎥 Laracasts - منصة تعليمية متخصصة
- 💬 منتديات ومجموعات نشطة
- 🔧 آلاف الحزم (Packages) الجاهزة

### 3. الأمان | Security

Laravel يوفر حماية ضد:

```php
// SQL Injection
✅ Laravel يستخدم PDO Prepared Statements

// XSS (Cross-Site Scripting)
✅ Blade Engine ينظف البيانات تلقائياً

// CSRF (Cross-Site Request Forgery)
✅ CSRF Token تلقائي في كل نموذج

// Clickjacking
✅ X-Frame-Options header

// SQL Injection via Mass Assignment
✅ Fillable/Guarded في Models
```

### 4. قابلية التوسع | Scalability

Laravel مناسب لجميع أحجام المشاريع:

- 🏠 **Small Projects:** مدونة شخصية، موقع شركة صغيرة
- 🏢 **Medium Projects:** متجر إلكتروني، نظام إدارة
- 🏭 **Large Projects:** منصات اجتماعية، تطبيقات Enterprise

### 5. الأدوات المساعدة | Helpful Tools

```
🔧 Artisan CLI - واجهة سطر أوامر قوية
🔍 Laravel Telescope - أداة debugging
📊 Laravel Horizon - لوحة تحكم للـ Queues
🚀 Laravel Forge - إدارة السيرفرات
☁️  Laravel Vapor - Serverless deployment
```

### 6. النظام البيئي | Ecosystem

```
📦 Laravel Packages:
   - Laravel Sanctum (API Authentication)
   - Laravel Passport (OAuth2)
   - Laravel Cashier (Payments)
   - Laravel Scout (Full-text Search)
   - Laravel Socialite (Social Login)
   - Laravel Echo (WebSockets)
   - وآلاف الحزم الأخرى
```

---

## 🏗️ معمارية MVC

### ما هي MVC؟

**MVC** تعني **Model-View-Controller**، وهي نمط معماري لتنظيم الكود.

### المكونات الثلاثة | Three Components

#### 1️⃣ Model (النموذج)

**الدور:** إدارة البيانات والمنطق التجاري

```php
// مثال: User Model
class User extends Model
{
    // يتعامل مع جدول users في قاعدة البيانات
    // Handles the 'users' table in the database

    protected $fillable = ['name', 'email', 'password'];

    // العلاقات | Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

**المسؤوليات:**
- ✅ التعامل مع قاعدة البيانات
- ✅ تطبيق قواعد العمل (Business Logic)
- ✅ التحقق من صحة البيانات
- ✅ إدارة العلاقات بين الجداول

#### 2️⃣ View (العرض)

**الدور:** عرض البيانات للمستخدم (HTML/CSS/JS)

```blade
{{-- مثال: welcome.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>مرحباً</title>
</head>
<body>
    <h1>مرحباً {{ $user->name }}</h1>
    <p>لديك {{ $posts->count() }} منشور</p>

    @foreach($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        </div>
    @endforeach
</body>
</html>
```

**المسؤوليات:**
- ✅ عرض البيانات بشكل جميل
- ✅ التنسيق والتصميم
- ✅ التفاعل مع المستخدم (UI)
- ❌ لا يحتوي على منطق معقد

#### 3️⃣ Controller (المتحكم)

**الدور:** الوسيط بين Model و View

```php
// مثال: UserController
class UserController extends Controller
{
    public function index()
    {
        // 1. الحصول على البيانات من Model
        $users = User::with('posts')->get();

        // 2. إرسال البيانات إلى View
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // 1. التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // 2. إنشاء مستخدم جديد
        $user = User::create($validated);

        // 3. إعادة التوجيه
        return redirect()->route('users.show', $user);
    }
}
```

**المسؤوليات:**
- ✅ استقبال طلبات المستخدم
- ✅ معالجة البيانات
- ✅ استدعاء Models
- ✅ إرجاع Views أو Responses

### تدفق البيانات | Data Flow

```
المستخدم (User)
     ↓
     ↓ (1) يرسل طلب (HTTP Request)
     ↓
Controller (المتحكم)
     ↓
     ↓ (2) يطلب البيانات
     ↓
Model (النموذج)
     ↓
     ↓ (3) يستعلم عن البيانات
     ↓
Database (قاعدة البيانات)
     ↓
     ↓ (4) يُرجع البيانات
     ↓
Model
     ↓
     ↓ (5) يُرسل البيانات
     ↓
Controller
     ↓
     ↓ (6) يُمرر البيانات
     ↓
View (العرض)
     ↓
     ↓ (7) يُرجع HTML
     ↓
المستخدم (User)
```

### مثال عملي كامل | Complete Practical Example

**السيناريو:** عرض قائمة المستخدمين

#### 1. Route (web.php)
```php
Route::get('/users', [UserController::class, 'index']);
```

#### 2. Controller
```php
class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Model
        return view('users.index', compact('users')); // View
    }
}
```

#### 3. Model
```php
class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email'];
}
```

#### 4. View (resources/views/users/index.blade.php)
```blade
@foreach($users as $user)
    <p>{{ $user->name }} - {{ $user->email }}</p>
@endforeach
```

### فوائد MVC | Benefits of MVC

```
✅ فصل الاهتمامات (Separation of Concerns)
   - كل جزء له مسؤولية واضحة

✅ سهولة الصيانة (Maintainability)
   - يمكن تعديل جزء دون التأثير على الأجزاء الأخرى

✅ إعادة الاستخدام (Reusability)
   - يمكن استخدام نفس Model في Controllers متعددة

✅ قابلية الاختبار (Testability)
   - يمكن اختبار كل جزء بشكل منفصل

✅ العمل الجماعي (Teamwork)
   - يمكن للفريق العمل على أجزاء مختلفة بنفس الوقت
```

---

## 💻 متطلبات النظام

### المتطلبات الأساسية | Basic Requirements

#### لـ Laravel 11.x:

```
✅ PHP >= 8.2
✅ Composer (أحدث إصدار)
✅ Extensions مطلوبة:
   - Ctype PHP Extension
   - cURL PHP Extension
   - DOM PHP Extension
   - Fileinfo PHP Extension
   - Filter PHP Extension
   - Hash PHP Extension
   - Mbstring PHP Extension
   - OpenSSL PHP Extension
   - PCRE PHP Extension
   - PDO PHP Extension
   - Session PHP Extension
   - Tokenizer PHP Extension
   - XML PHP Extension
```

### قاعدة البيانات | Database

Laravel يدعم:

```
✅ MySQL 5.7+ / 8.0+
✅ PostgreSQL 12.0+
✅ SQLite 3.35.0+
✅ SQL Server 2017+
```

### التحقق من PHP | Check PHP

```bash
# التحقق من إصدار PHP
php -v

# التحقق من Extensions المثبتة
php -m

# التحقق من extension معين
php -m | grep mbstring
```

---

## 🛠️ أدوات التطوير

### 1. بيئة التطوير المحلية | Local Development Environment

#### الخيار الأول: Laravel Herd (موصى به للمبتدئين)

```
🚀 Laravel Herd
- سهل التثبيت والاستخدام
- يحتوي على PHP, Nginx, MySQL
- تشغيل تلقائي للمشاريع
- متوفر لـ Windows و macOS

التحميل:
https://herd.laravel.com
```

#### الخيار الثاني: XAMPP/WAMP

```
📦 XAMPP (Windows, macOS, Linux)
- Apache, MySQL, PHP, PhpMyAdmin
- سهل للمبتدئين
- https://www.apachefriends.org

📦 WAMP (Windows)
- Apache, MySQL, PHP
- https://www.wampserver.com
```

#### الخيار الثالث: Docker

```
🐳 Laravel Sail (Docker)
- بيئة متكاملة معزولة
- يعمل على جميع أنظمة التشغيل
- موصى به للمشاريع الكبيرة

# تثبيت مشروع جديد مع Sail
curl -s https://laravel.build/example-app | bash
cd example-app
./vendor/bin/sail up
```

### 2. محرر النصوص | Code Editor

#### Visual Studio Code (موصى به)

```
💻 VS Code
- مجاني ومفتوح المصدر
- Extensions مفيدة:
  ✅ Laravel Extension Pack
  ✅ Laravel Blade Snippets
  ✅ Laravel goto view
  ✅ PHP Intelephense
  ✅ PHP Namespace Resolver

التحميل:
https://code.visualstudio.com
```

#### بدائل أخرى:

```
💻 PhpStorm (مدفوع، احترافي)
💻 Sublime Text (خفيف وسريع)
💻 Atom (مجاني)
```

### 3. أدوات إضافية | Additional Tools

```
🔧 Git - نظام التحكم بالإصدارات
   https://git-scm.com

🔧 Node.js & NPM - لإدارة Assets
   https://nodejs.org

🔧 Postman - لاختبار APIs
   https://www.postman.com

🔧 TablePlus/DBeaver - إدارة قواعد البيانات
   https://tableplus.com
   https://dbeaver.io
```

---

## 📦 Composer وإدارة الحزم

### ما هو Composer؟

**Composer** هو أداة لإدارة الاعتماديات (Dependencies) في PHP، مشابه لـ npm في Node.js أو pip في Python.

### لماذا نحتاج Composer؟

```
✅ إدارة مكتبات PHP بسهولة
✅ تثبيت Laravel والحزم
✅ تحديث الحزم بأمان
✅ Autoloading تلقائي للكلاسات
✅ إدارة إصدارات الحزم
```

### تثبيت Composer

#### Windows:
```bash
# تحميل من:
https://getcomposer.org/Composer-Setup.exe
# ثم اتبع خطوات التثبيت
```

#### macOS/Linux:
```bash
# تثبيت عبر Terminal
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

### التحقق من التثبيت

```bash
composer --version
# Expected output: Composer version 2.x.x
```

### ملف composer.json

هذا الملف يحدد اعتماديات المشروع:

```json
{
    "name": "laravel/laravel",
    "type": "project",
    "description": "Laravel Application",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^11.0",
        "laravel/sanctum": "^4.0",
        "laravel/tinker": "^2.9"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/pint": "^1.13",
        "mockery/mockery": "^1.6",
        "phpunit/phpunit": "^10.5"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    }
}
```

### أوامر Composer الأساسية

```bash
# تثبيت جميع الاعتماديات
composer install

# تحديث الاعتماديات
composer update

# إضافة حزمة جديدة
composer require package-name

# إضافة حزمة للتطوير فقط
composer require --dev package-name

# إزالة حزمة
composer remove package-name

# إعادة بناء autoload
composer dump-autoload
```

---

## 📁 هيكل مشروع Laravel

عند إنشاء مشروع Laravel جديد، ستجد الهيكل التالي:

```
my-laravel-app/
│
├── 📁 app/                    # كود التطبيق الأساسي
│   ├── Console/              # Artisan Commands
│   ├── Exceptions/           # معالجة الأخطاء
│   ├── Http/                 # Controllers, Middleware
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/               # Eloquent Models
│   └── Providers/            # Service Providers
│
├── 📁 bootstrap/              # ملفات بدء التطبيق
│   ├── app.php              # إنشاء تطبيق Laravel
│   └── cache/               # ملفات cache للأداء
│
├── 📁 config/                 # ملفات الإعدادات
│   ├── app.php              # إعدادات التطبيق الرئيسية
│   ├── database.php         # إعدادات قاعدة البيانات
│   ├── mail.php             # إعدادات البريد
│   └── ...
│
├── 📁 database/               # قاعدة البيانات
│   ├── factories/           # Model Factories
│   ├── migrations/          # جداول قاعدة البيانات
│   └── seeders/             # بيانات تجريبية
│
├── 📁 public/                 # المجلد العام (Document Root)
│   ├── index.php            # نقطة الدخول
│   ├── css/
│   ├── js/
│   └── images/
│
├── 📁 resources/              # الموارد غير المعالجة
│   ├── css/                 # CSS files
│   ├── js/                  # JavaScript files
│   └── views/               # Blade Templates
│       └── welcome.blade.php
│
├── 📁 routes/                 # ملفات التوجيه
│   ├── web.php              # Web routes
│   ├── api.php              # API routes
│   ├── console.php          # Console routes
│   └── channels.php         # Broadcast channels
│
├── 📁 storage/                # الملفات المُنشأة
│   ├── app/                 # ملفات التطبيق
│   ├── framework/           # ملفات Framework
│   └── logs/                # Log files
│
├── 📁 tests/                  # ملفات الاختبار
│   ├── Feature/             # Feature Tests
│   └── Unit/                # Unit Tests
│
├── 📁 vendor/                 # Composer packages
│
├── 📄 .env                    # متغيرات البيئة (لا تُرفع لـ Git)
├── 📄 .env.example           # مثال على .env
├── 📄 artisan                # Artisan CLI
├── 📄 composer.json          # Composer dependencies
├── 📄 package.json           # NPM dependencies
└── 📄 phpunit.xml            # PHPUnit configuration
```

### شرح المجلدات المهمة:

#### 1. app/ - قلب التطبيق

```
app/
├── Http/Controllers/     ← Controllers هنا
├── Models/              ← Models هنا
├── Http/Middleware/     ← Middleware هنا
└── Providers/           ← Service Providers
```

#### 2. resources/ - الموارد

```
resources/
├── views/               ← Blade templates
├── css/                 ← CSS files
└── js/                  ← JavaScript files
```

#### 3. routes/ - التوجيه

```
routes/
├── web.php              ← للصفحات العادية
├── api.php              ← للـ APIs
└── console.php          ← للـ Commands
```

#### 4. database/ - قاعدة البيانات

```
database/
├── migrations/          ← تعريف الجداول
├── seeders/            ← بيانات تجريبية
└── factories/          ← إنشاء بيانات وهمية
```

#### 5. config/ - الإعدادات

```
config/
├── app.php             ← إعدادات عامة
├── database.php        ← إعدادات DB
├── mail.php            ← إعدادات البريد
└── ...
```

---

## 🔄 دورة حياة الطلب

فهم كيف يعالج Laravel الطلبات مهم جداً:

### الخطوات:

```
1. Entry Point (public/index.php)
   ↓
2. HTTP Kernel (app/Http/Kernel.php)
   ↓
3. Service Providers
   ↓
4. Router
   ↓
5. Middleware
   ↓
6. Controller
   ↓
7. Response
   ↓
8. Middleware (مرة أخرى)
   ↓
9. HTTP Response للمتصفح
```

### بالتفصيل:

#### 1️⃣ نقطة الدخول (public/index.php)

```php
// جميع الطلبات تبدأ من هنا
require __DIR__.'/../vendor/autoload.php';

// إنشاء التطبيق
$app = require_once __DIR__.'/../bootstrap/app.php';

// معالجة الطلب
$kernel = $app->make(Kernel::class);
$response = $kernel->handle(
    $request = Request::capture()
);
$response->send();
```

#### 2️⃣ HTTP Kernel

```php
// يحتوي على Middleware والإعدادات
class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global Middleware
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        // ...
    ];
}
```

#### 3️⃣ Service Providers

```php
// يتم تشغيل Service Providers
// لتسجيل الخدمات وإعداد التطبيق
AppServiceProvider
AuthServiceProvider
RouteServiceProvider
// ...
```

#### 4️⃣ Router

```php
// يبحث عن Route المناسب
Route::get('/users', [UserController::class, 'index']);
```

#### 5️⃣ Middleware

```php
// يتم تشغيل Middleware قبل الوصول للـ Controller
- Authentication
- CSRF Protection
- Session
// ...
```

#### 6️⃣ Controller

```php
// يُنفّذ كود Controller
public function index()
{
    $users = User::all();
    return view('users.index', compact('users'));
}
```

#### 7️⃣ Response

```php
// يتم إنشاء Response (HTML, JSON, etc.)
return view('welcome');
return response()->json(['data' => $data]);
return redirect('/home');
```

### رسم توضيحي:

```
المستخدم يطلب: http://example.com/users
         ↓
    public/index.php
         ↓
    HTTP Kernel
         ↓
  🔧 Global Middleware
         ↓
    Router → routes/web.php
         ↓
    🛡️ Route Middleware
         ↓
    UserController@index
         ↓
    User::all() → Database
         ↓
    return view('users.index')
         ↓
    Blade Engine
         ↓
    HTML Response
         ↓
    المستخدم يرى الصفحة
```

---

## 📝 ملخص الدرس | Lesson Summary

### النقاط الرئيسية:

1. **Laravel** هو إطار عمل PHP قوي وشائع
2. **MVC** يفصل الكود إلى Model, View, Controller
3. **Composer** يدير اعتماديات PHP
4. **هيكل Laravel** منظم ويتبع best practices
5. **دورة حياة الطلب** تمر بعدة مراحل قبل الوصول للمستخدم

### المفاهيم الأساسية:

```
✅ Framework vs Library
✅ MVC Pattern
✅ Dependency Management
✅ Request Lifecycle
✅ Directory Structure
```

---

## 🎯 ماذا بعد؟

في الدرس التالي، سنتعلم:

- ✅ تثبيت Laravel فعلياً
- ✅ إنشاء أول مشروع
- ✅ تشغيل السيرفر المحلي
- ✅ استكشاف التطبيق

**استعد للدرس العملي! 🚀**

---

## 📚 مصادر إضافية | Additional Resources

### الوثائق الرسمية:
- 📖 [Laravel Documentation](https://laravel.com/docs)
- 📖 [Laravel API Reference](https://laravel.com/api/11.x/)

### دروس فيديو:
- 🎥 [Laracasts](https://laracasts.com)
- 🎥 [Laravel Daily](https://www.youtube.com/@LaravelDaily)

### مجتمعات:
- 💬 [Laravel Forums](https://laravel.io)
- 💬 [Laravel Discord](https://discord.gg/laravel)
- 💬 [r/laravel](https://reddit.com/r/laravel)

---

**📌 ملاحظة:** تأكد من فهم جميع المفاهيم قبل الانتقال للدرس العملي!

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
