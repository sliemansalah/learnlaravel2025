# الدرس 1: التطبيق العملي - تثبيت Laravel وإنشاء أول مشروع
# Lesson 1: Practical Application - Installing Laravel and Creating First Project

**المدة المقدرة:** 2-3 ساعات | Estimated Duration: 2-3 hours
**المستوى:** مبتدئ | Level: Beginner

---

## 📋 جدول المحتويات | Table of Contents

1. [تثبيت المتطلبات](#تثبيت-المتطلبات)
2. [إنشاء مشروع Laravel](#إنشاء-مشروع-laravel)
3. [تشغيل المشروع](#تشغيل-المشروع)
4. [استكشاف المشروع](#استكشاف-المشروع)
5. [إعداد قاعدة البيانات](#إعداد-قاعدة-البيانات)
6. [أول تعديل](#أول-تعديل)
7. [Artisan Commands](#artisan-commands)

---

## 🎯 أهداف الدرس العملي

بنهاية هذا الدرس، ستكون قد:

- ✅ ثبّتَّ جميع المتطلبات (PHP, Composer)
- ✅ أنشأتَ مشروع Laravel جديد
- ✅ شغّلتَ السيرفر المحلي
- ✅ استكشفتَ هيكل المشروع
- ✅ أعددتَ قاعدة البيانات
- ✅ قمتَ بأول تعديل على الصفحة الرئيسية
- ✅ تعلمتَ أوامر Artisan الأساسية

---

## 📥 تثبيت المتطلبات

### الخطوة 1: تثبيت PHP

#### Windows:

**الطريقة الأولى: استخدام Laravel Herd (موصى بها)**

```bash
# 1. تحميل Laravel Herd من:
https://herd.laravel.com/windows

# 2. تثبيت البرنامج (Double-click)
# 3. Laravel Herd سيثبت PHP, Composer, Nginx تلقائياً

# 4. التحقق من التثبيت
herd --version
php --version
composer --version
```

**الطريقة الثانية: استخدام XAMPP**

```bash
# 1. تحميل XAMPP من:
https://www.apachefriends.org/download.html

# 2. تثبيت XAMPP
# 3. إضافة PHP إلى PATH:
#    - افتح System Properties
#    - Environment Variables
#    - أضف: C:\xampp\php إلى Path

# 4. التحقق
php --version
```

#### macOS:

```bash
# الطريقة الأولى: Laravel Herd
# تحميل من: https://herd.laravel.com

# الطريقة الثانية: Homebrew
brew install php@8.2

# التحقق
php --version
```

#### Linux (Ubuntu/Debian):

```bash
# تثبيت PHP 8.2
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-common php8.2-mysql \
php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath

# التحقق
php --version
```

### الخطوة 2: تثبيت Composer

#### Windows:

```bash
# 1. تحميل من:
https://getcomposer.org/Composer-Setup.exe

# 2. تشغيل المثبت واتباع الخطوات

# 3. التحقق (في CMD أو PowerShell جديد)
composer --version
```

#### macOS/Linux:

```bash
# تثبيت Composer عالمياً
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer

# التحقق
composer --version
```

### الخطوة 3: التحقق من Extensions

```bash
# عرض جميع Extensions المثبتة
php -m

# التحقق من extensions مهمة
php -m | grep mbstring
php -m | grep openssl
php -m | grep pdo
php -m | grep tokenizer
php -m | grep xml
```

---

## 🚀 إنشاء مشروع Laravel

### الطريقة الأولى: باستخدام Composer (موصى بها)

```bash
# الانتقال إلى مجلد المشاريع
cd C:\xampp\htdocs     # Windows
cd ~/Sites             # macOS
cd ~/projects          # Linux

# إنشاء مشروع جديد
composer create-project laravel/laravel my-first-app

# سيستغرق هذا 2-5 دقائق
```

### الطريقة الثانية: باستخدام Laravel Installer

```bash
# تثبيت Laravel Installer (مرة واحدة فقط)
composer global require laravel/installer

# إضافة Composer bin إلى PATH
# Windows: %USERPROFILE%\AppData\Roaming\Composer\vendor\bin
# macOS/Linux: ~/.composer/vendor/bin

# إنشاء مشروع جديد
laravel new my-first-app
```

### الطريقة الثالثة: باستخدام Laravel Herd

```bash
# إذا كنت تستخدم Herd، فقط:
cd ~/Herd        # macOS
cd C:\Herd       # Windows

# أنشئ مجلد جديد
mkdir my-first-app
cd my-first-app

# استخدم Composer
composer create-project laravel/laravel .
```

### ما يحدث أثناء التثبيت:

```
Installing Laravel...
  ↓
⏳ تحميل Laravel framework
⏳ تحميل dependencies من Composer
⏳ إنشاء هيكل المشروع
⏳ إنشاء .env file
⏳ توليد Application Key
✅ Application ready!
```

---

## 🏃 تشغيل المشروع

### الخطوة 1: الدخول إلى مجلد المشروع

```bash
cd my-first-app
```

### الخطوة 2: تشغيل السيرفر المحلي

```bash
# استخدام Artisan Serve
php artisan serve

# ستظهر رسالة:
# Starting Laravel development server: http://127.0.0.1:8000
```

**ملاحظة:** اترك Terminal مفتوحاً أثناء التطوير!

### الخطوة 3: فتح المتصفح

```
افتح المتصفح واذهب إلى:
http://localhost:8000
أو
http://127.0.0.1:8000
```

### يجب أن ترى صفحة Laravel الافتراضية! 🎉

```
╔══════════════════════════════════╗
║                                  ║
║          Laravel                 ║
║                                  ║
║     Welcome to Laravel 11        ║
║                                  ║
║   [Documentation] [Laracasts]   ║
║                                  ║
╚══════════════════════════════════╝
```

---

## 🔍 استكشاف المشروع

### الخطوة 1: فتح المشروع في VS Code

```bash
# في Terminal، من داخل مجلد المشروع:
code .

# أو افتح VS Code يدوياً:
# File → Open Folder → اختر my-first-app
```

### الخطوة 2: استكشاف الملفات الرئيسية

#### 1. ملف `.env` - إعدادات البيئة

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost

# قاعدة البيانات
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

**🔒 مهم جداً:**
- لا تشارك ملف `.env` أبداً!
- يحتوي على معلومات حساسة
- مُستثنى من Git تلقائياً

#### 2. ملف `routes/web.php` - التوجيه

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
```

**الشرح:**
- `Route::get()` - يعرف route لـ GET request
- `'/'` - المسار (الصفحة الرئيسية)
- `function()` - ما سيحدث عند زيارة هذا المسار
- `view('welcome')` - يعرض view اسمه welcome

#### 3. ملف `resources/views/welcome.blade.php` - العرض

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- ... -->
</head>
<body>
    <h1>Welcome to Laravel!</h1>
</body>
</html>
```

#### 4. ملف `composer.json` - الاعتماديات

```json
{
    "name": "laravel/laravel",
    "type": "project",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^11.0"
    }
}
```

### الخطوة 3: تصفح المجلدات

```
my-first-app/
│
├── 📁 app/                    ← افتح هذا!
│   ├── Http/Controllers/     ← سنعمل هنا كثيراً
│   └── Models/               ← وهنا أيضاً
│
├── 📁 routes/                 ← افتح هذا!
│   └── web.php              ← سنعدل هذا الملف كثيراً
│
├── 📁 resources/              ← افتح هذا!
│   └── views/               ← ملفات Blade هنا
│       └── welcome.blade.php
│
├── 📁 database/               ← سنستخدمه لاحقاً
│   └── migrations/
│
└── 📄 .env                    ← ملف الإعدادات
```

---

## 💾 إعداد قاعدة البيانات

### الخطوة 1: إنشاء قاعدة بيانات

#### باستخدام MySQL (XAMPP/WAMP):

```sql
-- افتح phpMyAdmin: http://localhost/phpmyadmin

-- أنشئ قاعدة بيانات جديدة:
CREATE DATABASE my_first_app;
```

#### باستخدام SQLite (أسهل للتجربة):

```bash
# Laravel يدعم SQLite خارج الصندوق
# أنشئ ملف database:
touch database/database.sqlite    # macOS/Linux
type nul > database\database.sqlite    # Windows
```

### الخطوة 2: تحديث ملف `.env`

#### للـ MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_first_app    ← اسم القاعدة التي أنشأتها
DB_USERNAME=root
DB_PASSWORD=                ← كلمة المرور (فارغة في XAMPP)
```

#### للـ SQLite:

```env
DB_CONNECTION=sqlite
# احذف أو علّق على البقية:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

### الخطوة 3: تشغيل Migrations

```bash
# هذا ينشئ الجداول الأساسية
php artisan migrate

# ستظهر رسالة:
# Migration table created successfully.
# Migrating: 2014_10_12_000000_create_users_table
# Migrated:  2014_10_12_000000_create_users_table (45.23ms)
# ...
```

**ماذا حدث؟**
- تم إنشاء جدول `users`
- تم إنشاء جدول `password_reset_tokens`
- تم إنشاء جدول `sessions`
- تم إنشاء جدول `migrations` لتتبع Migrations

### الخطوة 4: التحقق من الجداول

```bash
# باستخدام Artisan Tinker (REPL)
php artisan tinker

# داخل Tinker:
>>> DB::select('SHOW TABLES');
# أو للـ SQLite:
>>> DB::select("SELECT name FROM sqlite_master WHERE type='table'");

# للخروج:
>>> exit
```

---

## ✏️ أول تعديل - تخصيص الصفحة الرئيسية

### التعديل 1: تغيير النص الرئيسي

افتح `resources/views/welcome.blade.php` وعدّل:

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مشروعي الأول</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .container {
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        h1 {
            color: #667eea;
            font-size: 3em;
            margin: 0 0 20px 0;
        }
        p {
            color: #666;
            font-size: 1.2em;
        }
        .badge {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 مرحباً بك في Laravel!</h1>
        <p>هذا هو مشروعك الأول</p>
        <p>أنت الآن مطور Laravel 🚀</p>
        <div class="badge">Laravel {{ app()->version() }}</div>
    </div>
</body>
</html>
```

**احفظ الملف وأعد تحميل الصفحة في المتصفح!** 🎨

### التعديل 2: إضافة route جديد

افتح `routes/web.php` وأضف:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route جديد!
Route::get('/hello', function () {
    return '<h1 style="text-align:center; margin-top:100px; color:#667eea;">مرحباً من Laravel! 👋</h1>';
});

// Route مع parameter
Route::get('/hello/{name}', function ($name) {
    return "<h1 style='text-align:center; margin-top:100px; color:#764ba2;'>مرحباً {$name}! 🎉</h1>";
});
```

**جرّب في المتصفح:**
- `http://localhost:8000/hello`
- `http://localhost:8000/hello/محمد`
- `http://localhost:8000/hello/Ahmed`

### التعديل 3: إنشاء view جديد

#### 1. أنشئ ملف `resources/views/about.blade.php`:

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عن المشروع</title>
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
    </style>
</head>
<body>
    <h1>عن هذا المشروع</h1>

    <div class="info-box">
        <h2>📚 ماذا تعلمت؟</h2>
        <ul>
            <li>تثبيت Laravel</li>
            <li>إنشاء أول مشروع</li>
            <li>استكشاف هيكل Laravel</li>
            <li>إنشاء Routes</li>
            <li>إنشاء Views</li>
        </ul>
    </div>

    <div class="info-box">
        <h2>🚀 ماذا بعد؟</h2>
        <p>في الدروس القادمة سنتعلم:</p>
        <ul>
            <li>Controllers</li>
            <li>Blade Templates</li>
            <li>Database & Models</li>
            <li>Authentication</li>
            <li>وأكثر!</li>
        </ul>
    </div>

    <p style="text-align: center; color: #999; margin-top: 50px;">
        Laravel {{ app()->version() }} | PHP {{ PHP_VERSION }}
    </p>
</body>
</html>
```

#### 2. أضف route في `routes/web.php`:

```php
Route::get('/about', function () {
    return view('about');
});
```

#### 3. جرّب: `http://localhost:8000/about`

---

## 🛠️ Artisan Commands - أوامر مهمة

### معلومات عن Artisan

```bash
# عرض جميع الأوامر المتاحة
php artisan list

# الحصول على مساعدة حول أمر معين
php artisan help migrate
```

### أوامر أساسية

#### 1. تشغيل السيرفر

```bash
# تشغيل على المنفذ الافتراضي (8000)
php artisan serve

# تشغيل على منفذ آخر
php artisan serve --port=8080

# تشغيل على host معين
php artisan serve --host=192.168.1.100
```

#### 2. معلومات التطبيق

```bash
# عرض إصدار Laravel
php artisan --version

# عرض معلومات البيئة
php artisan about

# عرض Routes
php artisan route:list
```

#### 3. Cache

```bash
# مسح cache
php artisan cache:clear

# مسح config cache
php artisan config:clear

# مسح route cache
php artisan route:clear

# مسح view cache
php artisan view:clear

# مسح كل شيء
php artisan optimize:clear
```

#### 4. قاعدة البيانات

```bash
# تشغيل migrations
php artisan migrate

# rollback آخر migration
php artisan migrate:rollback

# إعادة تشغيل جميع migrations
php artisan migrate:fresh

# تشغيل migrations مع seeders
php artisan migrate:fresh --seed
```

#### 5. إنشاء ملفات

```bash
# إنشاء Controller
php artisan make:controller UserController

# إنشاء Model
php artisan make:model Post

# إنشاء Model مع Migration
php artisan make:model Post -m

# إنشاء Migration
php artisan make:migration create_posts_table

# إنشاء Seeder
php artisan make:seeder UserSeeder
```

#### 6. Tinker (REPL)

```bash
# فتح Tinker
php artisan tinker

# داخل Tinker، يمكنك:
>>> $users = App\Models\User::all();
>>> $users->count();
>>> $user = App\Models\User::first();
>>> $user->name;
>>> exit
```

### مثال عملي كامل

```bash
# 1. إنشاء Model مع Migration
php artisan make:model Article -m

# 2. سيُنشئ:
#    - app/Models/Article.php
#    - database/migrations/YYYY_MM_DD_HHMMSS_create_articles_table.php

# 3. افتح Migration وعدّله
# 4. ثم شغّل:
php artisan migrate

# 5. استخدم Tinker لإنشاء بيانات:
php artisan tinker
>>> App\Models\Article::create(['title' => 'First Article', 'content' => 'Hello World']);
```

---

## ✅ التحقق من الإنجاز

تأكد من إكمال جميع الخطوات:

- [x] تثبيت PHP و Composer
- [x] إنشاء مشروع Laravel جديد
- [x] تشغيل `php artisan serve`
- [x] فتح `http://localhost:8000` ورؤية الصفحة
- [x] إعداد قاعدة البيانات
- [x] تشغيل `php artisan migrate`
- [x] تعديل `welcome.blade.php`
- [x] إنشاء route جديد
- [x] إنشاء view جديد (`about.blade.php`)
- [x] تجربة أوامر Artisan

---

## 🐛 حل المشاكل الشائعة

### مشكلة 1: `composer` command not found

**الحل:**
```bash
# تأكد من إضافة Composer إلى PATH
# أعد فتح Terminal/CMD بعد التثبيت
```

### مشكلة 2: `Class "PDO" not found`

**الحل:**
```bash
# تأكد من تفعيل extension=pdo_mysql في php.ini
# أعد تشغيل Apache/Server
```

### مشكلة 3: Permission denied (macOS/Linux)

**الحل:**
```bash
# أعطِ صلاحيات للمجلدات:
chmod -R 775 storage bootstrap/cache
```

### مشكلة 4: Port 8000 already in use

**الحل:**
```bash
# استخدم منفذ آخر:
php artisan serve --port=8080
```

### مشكلة 5: Database connection failed

**الحل:**
```env
# تحقق من إعدادات .env
# تأكد من:
# 1. اسم قاعدة البيانات صحيح
# 2. MySQL/Server يعمل
# 3. اسم المستخدم وكلمة المرور صحيحة
```

---

## 📝 ملخص الدرس العملي

### ما أنجزته اليوم:

```
✅ تثبيت بيئة التطوير الكاملة
✅ إنشاء أول مشروع Laravel
✅ فهم هيكل المشروع
✅ إعداد قاعدة البيانات
✅ إنشاء Routes و Views
✅ استخدام Artisan Commands
✅ تعديل الصفحات
```

### المفاهيم المهمة:

```
🔑 PHP & Composer = أدوات أساسية
🔑 php artisan serve = تشغيل المشروع
🔑 routes/web.php = تعريف المسارات
🔑 resources/views/ = ملفات العرض
🔑 .env = إعدادات البيئة
🔑 php artisan = أداة CLI قوية
```

---

## 🎯 الخطوة التالية

في الدرس التالي (الدرس 2)، سنتعلم:

- **Routing بالتفصيل**
  - Route Parameters
  - Named Routes
  - Route Groups
  - Route Methods (GET, POST, etc.)

**استعد! 🚀**

---

## 📚 مهام إضافية (اختيارية)

### مهمة 1: تخصيص صفحة الترحيب

```
عدّل welcome.blade.php لتضيف:
- اسمك
- تاريخ اليوم
- معلومات عن PHP و Laravel version
```

### مهمة 2: إنشاء صفحة Contact

```
1. أنشئ view اسمه contact.blade.php
2. أضف route له في web.php
3. ضع فيه نموذج اتصال بسيط
```

### مهمة 3: تجربة Tinker

```bash
php artisan tinker

# جرّب:
>>> now()
>>> app()->version()
>>> config('app.name')
>>> bcrypt('password')
```

---

**🎉 ممتاز! أنت الآن جاهز للدرس التالي!**

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
