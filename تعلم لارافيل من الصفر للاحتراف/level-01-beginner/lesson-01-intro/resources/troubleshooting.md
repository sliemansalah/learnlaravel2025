# حل المشاكل الشائعة
# Troubleshooting Guide

---

## 🔧 مشاكل التثبيت

### المشكلة 1: composer: command not found

**الأعراض:**
```bash
composer: command not found
```

**الحل:**

**Windows:**
1. أعد تشغيل Command Prompt كـ Administrator
2. تأكد من إضافة Composer إلى PATH
3. أعد تشغيل الكمبيوتر

**macOS/Linux:**
```bash
# تأكد من التثبيت
which composer

# إذا لم يكن مثبت
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

---

### المشكلة 2: PHP version not supported

**الأعراض:**
```
Your requirements could not be resolved to an installable set of packages.
laravel/framework requires php ^8.2
```

**الحل:**

**تحديث PHP:**

**Windows (XAMPP/WAMP):**
1. حمّل أحدث نسخة من XAMPP
2. ثبّت النسخة الجديدة
3. تأكد من PATH

**macOS (Homebrew):**
```bash
brew update
brew upgrade php
```

**Ubuntu/Debian:**
```bash
sudo apt update
sudo apt install php8.2
```

**التحقق:**
```bash
php -v
```

---

### المشكلة 3: Extensions مفقودة

**الأعراض:**
```
Class 'PDO' not found
mbstring extension is missing
```

**الحل:**

**Windows:**
1. افتح `php.ini`
2. ابحث عن Extensions المطلوبة:
```ini
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=curl
extension=fileinfo
extension=tokenizer
extension=xml
```
3. احذف `;` من بداية السطر
4. احفظ وأعد تشغيل السيرفر

**macOS/Linux:**
```bash
# Ubuntu/Debian
sudo apt install php8.2-mbstring php8.2-xml php8.2-mysql php8.2-curl

# macOS (Homebrew)
# عادة تأتي مع PHP
```

**التحقق:**
```bash
php -m | grep mbstring
```

---

## 🚀 مشاكل تشغيل السيرفر

### المشكلة 4: Port already in use

**الأعراض:**
```
Failed to listen on 127.0.0.1:8000 (reason: Address already in use)
```

**الحل:**

**الطريقة 1: استخدام port مختلف**
```bash
php artisan serve --port=8080
```

**الطريقة 2: إيقاف العملية القديمة**

**Windows:**
```bash
netstat -ano | findstr :8000
taskkill /PID [PID_NUMBER] /F
```

**macOS/Linux:**
```bash
lsof -ti:8000 | xargs kill -9
```

---

### المشكلة 5: 404 Not Found لجميع الصفحات

**الأعراض:**
- `/` يعمل
- أي صفحة أخرى تعطي 404

**الحل:**

1. **تأكد من تشغيل السيرفر بشكل صحيح:**
```bash
php artisan serve
```

2. **تحقق من الـ Routes:**
```bash
php artisan route:list
```

3. **امسح route cache:**
```bash
php artisan route:clear
php artisan route:cache
```

---

## 📄 مشاكل Routes

### المشكلة 6: Route لا يعمل

**الأعراض:**
```
404 | Not Found
```

**الحل:**

**1. تحقق من syntax:**
```php
// ✅ صحيح
Route::get('/users', function () {
    return 'Users';
});

// ❌ خطأ
Route::get('users', function () {  // ينقص /
    return 'Users';
});
```

**2. تحقق من ترتيب Routes:**
```php
// ❌ خطأ - الـ specific route بعد dynamic
Route::get('/user/{id}', ...);
Route::get('/user/profile', ...);  // لن يعمل

// ✅ صحيح
Route::get('/user/profile', ...);
Route::get('/user/{id}', ...);
```

**3. امسح route cache:**
```bash
php artisan route:clear
```

---

### المشكلة 7: Parameter validation لا يعمل

**الأعراض:**
```php
Route::get('/user/{id}', ...)
    ->where('id', '[0-9]+');
// لكن /user/abc يعمل!
```

**الحل:**

**تحقق من syntax:**
```php
// ✅ صحيح
->where('id', '[0-9]+')

// ❌ خطأ شائع
->where('id', '[0-9]')  // ينقص +
->where('id', '\d+')    // لا تستخدم \d
```

---

## 👀 مشاكل Views

### المشكلة 8: View not found

**الأعراض:**
```
View [welcome] not found.
```

**الحل:**

**1. تحقق من المسار:**
```php
// الملف: resources/views/welcome.blade.php
return view('welcome');  // ✅

// الملف: resources/views/admin/dashboard.blade.php
return view('admin.dashboard');  // ✅
return view('admin/dashboard');  // ✅ أيضاً

// ❌ خطأ شائع
return view('admin\dashboard');  // Windows - لا تستخدم \
```

**2. تحقق من التسمية:**
- يجب أن ينتهي بـ `.blade.php`
- Laravel case-sensitive في Linux/macOS

**3. امسح view cache:**
```bash
php artisan view:clear
```

---

### المشكلة 9: متغير غير معرّف في View

**الأعراض:**
```
Undefined variable $name
```

**الحل:**

**1. تأكد من تمرير المتغير:**
```php
// ❌ خطأ
return view('user');

// ✅ صحيح
return view('user', ['name' => 'John']);
```

**2. استخدم قيمة افتراضية:**
```blade
{{-- في View --}}
{{ $name ?? 'Guest' }}
```

**3. تحقق من اسم المتغير:**
```php
// في Controller
return view('user', ['userName' => 'John']);
```
```blade
{{-- في View - يجب أن يطابق الاسم --}}
{{ $userName }}  ✅
{{ $name }}      ❌
```

---

### المشكلة 10: Blade directive لا يعمل

**الأعراض:**
```blade
{{-- يظهر كـ text بدلاً من تنفيذه --}}
@if ($user)
    Hello
@endif
```

**الحل:**

**تأكد من امتداد الملف:**
- ❌ `welcome.php`
- ✅ `welcome.blade.php`

---

## 🎮 مشاكل Controllers

### المشكلة 11: Class not found

**الأعراض:**
```
Class 'App\Http\Controllers\UserController' not found
```

**الحل:**

**1. تحقق من namespace:**
```php
// في Controller
namespace App\Http\Controllers;

class UserController extends Controller
{
    // ...
}
```

**2. تحقق من use statement في Routes:**
```php
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
```

**3. شغّل composer dump-autoload:**
```bash
composer dump-autoload
```

---

### المشكلة 12: Method not found

**الأعراض:**
```
Method App\Http\Controllers\UserController::show does not exist
```

**الحل:**

**1. تحقق من اسم Method:**
```php
// في Controller
public function show($id)  // ✅
{
    // ...
}

// في Route
Route::get('/users/{id}', [UserController::class, 'show']);  // ✅
```

**2. تحقق من typos:**
```php
Route::get('/users/{id}', [UserController::class, 'shwo']);  // ❌ typo
```

---

## 🔒 مشاكل Permissions (Linux/macOS)

### المشكلة 13: Permission denied

**الأعراض:**
```
file_put_contents(...): failed to open stream: Permission denied
```

**الحل:**

```bash
# امنح صلاحيات للمجلدات
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# إذا لم يعمل
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
```

---

## 🐛 مشاكل عامة

### المشكلة 14: صفحة بيضاء فارغة

**الحل:**

**1. فعّل عرض الأخطاء:**

في `.env`:
```env
APP_DEBUG=true
```

**2. تحقق من logs:**
```
storage/logs/laravel.log
```

**3. امسح cache:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

### المشكلة 15: CSRF token mismatch

**الأعراض:**
```
419 | Page Expired
```

**الحل:**

**في Forms:**
```blade
<form method="POST" action="/submit">
    @csrf  {{-- لا تنسى! --}}
    <!-- ... -->
</form>
```

---

## 📋 Checklist عند حدوث مشكلة

```bash
# 1. امسح جميع الـ caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. أعد تحميل autoloader
composer dump-autoload

# 3. تحقق من الـ logs
tail -f storage/logs/laravel.log

# 4. تأكد من البيئة
php artisan about

# 5. اختبر الـ routes
php artisan route:list
```

---

## 💡 نصائح لتجنب المشاكل

✅ **افعل:**
- احفظ الملفات دائماً (Ctrl+S / Cmd+S)
- استخدم `php artisan route:list` للتحقق
- راجع logs في `storage/logs/`
- استخدم `dd()` للـ debugging
- اقرأ رسائل الأخطاء بعناية

❌ **لا تفعل:**
- لا تعدّل vendor/
- لا تنسى .env
- لا تستخدم `\` في paths
- لا تنسخ كود بدون فهم

---

**إذا لم تجد الحل هنا، ابحث في:**
- [Laravel Documentation](https://laravel.com/docs)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel)
- [Laravel.io Forum](https://laravel.io)

**حظاً موفقاً! 🚀**
