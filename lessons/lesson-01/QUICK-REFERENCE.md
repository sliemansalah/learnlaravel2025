# الدرس 1 - بطاقة مرجعية سريعة

## 🚀 الأوامر الأساسية

```bash
# بدء خادم التطوير
php artisan serve

# قائمة جميع المسارات
php artisan route:list

# مسح التخزين المؤقت
php artisan cache:clear

# عرض جميع أوامر artisan
php artisan list

# التحقق من إصدار Laravel
php artisan --version
```

---

## 📁 المجلدات الرئيسية

| المسار | الغرض |
|--------|--------|
| `app/Http/Controllers/` | ملفات المتحكمات |
| `app/Models/` | نماذج Eloquent |
| `routes/web.php` | مسارات الويب |
| `resources/views/` | قوالب Blade |
| `config/` | ملفات الإعدادات |
| `database/migrations/` | هجرات قاعدة البيانات |
| `public/` | الملفات العامة ونقطة الدخول |

---

## 🛣️ صياغة المسارات الأساسية

```php
// مسار بسيط
Route::get('/path', function () {
    return 'مرحباً بالعالم';
});

// إرجاع عرض
Route::get('/page', function () {
    return view('viewname');
});

// إرجاع JSON
Route::get('/api/data', function () {
    return response()->json(['key' => 'value']);
});
```

---

## 📄 إنشاء عرض Blade

**الملف**: `resources/views/myview.blade.php`

```html
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>عرضي</title>
</head>
<body>
    <h1>مرحباً من Blade!</h1>
    <p>الوقت الحالي: {{ date('H:i:s') }}</p>
</body>
</html>
```

**المسار**:
```php
Route::get('/myview', function () {
    return view('myview');
});
```

---

## 🔧 دورة حياة الطلب (مبسطة)

```
طلب المتصفح
    ↓
public/index.php
    ↓
routes/web.php
    ↓
Controller (اختياري)
    ↓
Model (اختياري)
    ↓
View
    ↓
الاستجابة للمتصفح
```

---

## ⚙️ ملف البيئة (.env)

```
APP_NAME=MyLaravelApp
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

**لا تضف .env أبداً إلى Git!**

---

## 🎯 نمط MVC

- **Model (النموذج)**: البيانات ومنطق الأعمال (قاعدة البيانات)
- **View (العرض)**: طبقة العرض (HTML/Blade)
- **Controller (المتحكم)**: يعالج الطلبات وينسق بين النموذج والعرض

---

## ✅ قائمة التحقق للدرس 1

- [ ] فهم ما هو Laravel
- [ ] معرفة هيكل المشروع
- [ ] القدرة على بدء خادم التطوير
- [ ] القدرة على إنشاء مسارات أساسية
- [ ] القدرة على إنشاء عروض Blade بسيطة
- [ ] فهم دورة حياة الطلب
- [ ] معرفة أوامر Artisan الأساسية

---

## 💡 النقاط الرئيسية

1. Laravel يستخدم معمارية MVC
2. المسارات يتم تعريفها في `routes/web.php`
3. العروض يتم تخزينها في `resources/views/`
4. Artisan هو مساعدك في سطر الأوامر
5. ملف `.env` يحتوي على إعدادات البيئة

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [مسارات التدريب](./practice-routes.php)
- [الدرس التالي](../lesson-02/README.md)
