# دليل التطبيق العملي للدرس الأول

---

## 🚀 كيفية تشغيل المشروع

### الخطوة 1: تشغيل خادم التطوير

```bash
cd D:\learnlaravel2025\lessons\lesson-01\practice-app
php artisan serve
```

الخادم سيعمل على: `http://localhost:8000`

---

## 📋 المسارات المتاحة

### 1. الصفحة الرئيسية
- **URL**: `http://localhost:8000/`
- **الوصف**: صفحة الترحيب الافتراضية لـ Laravel

### 2. مسار Hello (التمرين 3)
- **URL**: `http://localhost:8000/hello`
- **الوصف**: مسار بسيط يعرض رسالة ترحيب
- **الكود**:
```php
Route::get('/hello', function () {
    return '<h1>مرحباً، أنا أتعلم Laravel!</h1>';
});
```

### 3. صفحة "عني" (التحدي)
- **URL**: `http://localhost:8000/about`
- **الوصف**: صفحة HTML كاملة تعرف بالمطور
- **المميزات**:
  - تصميم كامل بـ HTML و CSS
  - محتوى عربي
  - رابط للعودة للصفحة الرئيسية

### 4. صفحة "اتصل بنا" (التحدي)
- **URL**: `http://localhost:8000/contact`
- **الوصف**: صفحة معلومات الاتصال
- **المحتوى**:
  - البريد الإلكتروني
  - رقم الهاتف
  - الموقع الإلكتروني

### 5. صفحتي (التمرين 5 - Blade View)
- **URL**: `http://localhost:8000/mypage`
- **الوصف**: أول صفحة Blade كاملة
- **المميزات**:
  - استخدام Blade Template Engine
  - عرض التاريخ والوقت الحالي باستخدام `{{ date() }}`
  - تصميم احترافي مع gradient background
  - محتوى ديناميكي

---

## ✅ التمارين المنفذة

### التمرين 1: استكشاف المشروع ✅
- [x] تحديد نقطة الدخول: `public/index.php`
- [x] تحديد مكان المسارات: `routes/web.php`
- [x] تحديد مكان العروض: `resources/views/`
- [x] فحص ملف `.env`

### التمرين 2: تشغيل خادم التطوير ✅
```bash
php artisan serve
```

### التمرين 3: إنشاء المسار الأول ✅
- تم إنشاء مسار `/hello`

### التمرين 3 (التحدي): المسارات الإضافية ✅
- تم إنشاء مسار `/about`
- تم إنشاء مسار `/contact`

### التمرين 4: استكشاف أوامر Artisan
```bash
# عرض جميع المسارات
php artisan route:list

# مسح التخزين المؤقت
php artisan cache:clear

# عرض جميع الأوامر
php artisan list

# عرض إصدار Laravel
php artisan --version
```

### التمرين 5: إنشاء عرض Blade ✅
- تم إنشاء `resources/views/mypage.blade.php`
- تم إضافة المسار `/mypage`

---

## 🎯 ما تعلمناه

### 1. المسارات (Routes)
- كيفية تعريف مسارات GET البسيطة
- إرجاع HTML مباشرة من المسار
- إرجاع Views من المسار

### 2. العروض (Views)
- إنشاء ملفات Blade بامتداد `.blade.php`
- استخدام Blade syntax: `{{ }}`
- تمرير البيانات وعرضها

### 3. هيكل Laravel
- فهم مجلد `routes/`
- فهم مجلد `resources/views/`
- فهم دورة حياة الطلب

### 4. أوامر Artisan
- `php artisan serve` - تشغيل الخادم
- `php artisan route:list` - عرض المسارات
- `php artisan --version` - عرض الإصدار

---

## 📝 أوامر مفيدة

```bash
# تشغيل الخادم
php artisan serve

# عرض جميع المسارات
php artisan route:list

# عرض معلومات Laravel
php artisan about

# مسح جميع الـ cache
php artisan optimize:clear

# عرض المساعدة
php artisan help

# إنشاء مفتاح التطبيق
php artisan key:generate
```

---

## 🔍 اختبار المسارات

قم بزيارة كل مسار للتأكد من عمله:

1. ✅ `http://localhost:8000/` - الصفحة الرئيسية
2. ✅ `http://localhost:8000/hello` - رسالة Hello
3. ✅ `http://localhost:8000/about` - صفحة عني
4. ✅ `http://localhost:8000/contact` - صفحة اتصل بنا
5. ✅ `http://localhost:8000/mypage` - صفحة Blade

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس بنجاح، أنت الآن جاهز لـ:

1. **الدرس 2**: أساسيات التوجيه (Routing)
   - Route Parameters (معاملات المسار)
   - Named Routes (المسارات المسماة)
   - Route Groups (مجموعات المسارات)
   - Route Methods (POST, PUT, DELETE)

2. **الدرس 3**: المتحكمات (Controllers)
   - إنشاء Controllers
   - Resource Controllers
   - نمط MVC

---

## 💡 نصائح

1. **دائماً استخدم `php artisan route:list`** لعرض جميع المسارات المتاحة
2. **احفظ التغييرات** قبل تحديث المتصفح
3. **استخدم Ctrl+C** لإيقاف خادم التطوير
4. **اقرأ رسائل الأخطاء بعناية** - Laravel يوفر رسائل أخطاء واضحة ومفيدة

---

## ✨ ملخص الإنجازات

✅ تم إنشاء مشروع Laravel كامل
✅ تم إنشاء 4 مسارات مخصصة
✅ تم إنشاء أول Blade view
✅ تم فهم هيكل Laravel الأساسي
✅ تم استخدام أوامر Artisan

**مبروك! أنت الآن تفهم أساسيات Laravel! 🎉**

---

## 🆘 المساعدة

إذا واجهت أي مشكلة:

1. تحقق من أن خادم التطوير يعمل (`php artisan serve`)
2. تحقق من أن المسار صحيح
3. تحقق من ملف `routes/web.php`
4. راجع رسائل الأخطاء في Terminal
5. راجع الدرس النظري في `README.md`

---

## 📁 هيكل المشروع

```
practice-app/
├── app/                    # كود التطبيق الأساسي
│   ├── Http/
│   │   ├── Controllers/    # فئات المتحكمات
│   │   └── Middleware/     # البرمجيات الوسيطة
│   └── Models/             # نماذج Eloquent
├── routes/
│   └── web.php            # جميع مسارات الويب هنا
├── resources/
│   └── views/
│       ├── welcome.blade.php    # صفحة الترحيب الافتراضية
│       └── mypage.blade.php     # عرض Blade المخصص
├── public/                # نقطة الدخول والملفات العامة
│   └── index.php          # نقطة دخول التطبيق
├── database/              # الهجرات، البذور، المصانع
├── .env                   # إعدادات البيئة
└── artisan               # أداة Artisan CLI
```

---

## 🎨 المميزات

✅ **5 مسارات مخصصة** - الرئيسية، Hello، عني، اتصل بنا، صفحتي
✅ **عرض Blade احترافي** - مع محتوى ديناميكي
✅ **دعم كامل للعربية** - RTL ونصوص عربية
✅ **محتوى ديناميكي** - باستخدام Blade syntax
✅ **كود موثق** - تعليقات وهيكلة واضحة

---

## 🛠️ أوامر Artisan متقدمة

```bash
# عرض معلومات تفصيلية عن المسارات
php artisan route:list -v

# مسح أنواع محددة من الـ cache
php artisan cache:clear      # مسح cache التطبيق
php artisan config:clear     # مسح cache الإعدادات
php artisan route:clear      # مسح cache المسارات
php artisan view:clear       # مسح العروض المجمعة

# إنشاء مفتاح لتثبيت جديد
php artisan key:generate

# التشغيل في وضع الإنتاج
php artisan serve --host=0.0.0.0 --port=8080

# عرض معلومات التطبيق
php artisan about
```

---

## 📖 فهم الكود

### تعريف المسار
```php
Route::get('/path', function () {
    return 'Response';
});
```

- `Route::get()` - تعريف مسار GET
- `/path` - مسار URL
- `function()` - دالة مجهولة (Closure)
- `return` - ما يُرسل للمتصفح

### صياغة Blade
```php
{{ $variable }}          // عرض متغير
{{ date('Y-m-d') }}     // عرض نتيجة دالة
@if($condition)          // هيكل تحكم
```

---

## 🎓 المفاهيم الأساسية المكتسبة

### 1. نمط MVC
- **Model**: البيانات ومنطق قاعدة البيانات (لم نستخدمه بعد)
- **View**: طبقة العرض (قوالب Blade)
- **Controller**: منطق الأعمال (سنتعلمه في الدرس 3)

### 2. دورة حياة الطلب
```
المتصفح → public/index.php → Bootstrap → Route → Middleware → Response
```

### 3. محرك قوالب Blade
- امتداد `.blade.php`
- `{{ }}` للعرض
- توجيهات مثل `@if`، `@foreach`، إلخ.

---

## 🔬 نصائح لتصحيح الأخطاء

### تحقق من تشغيل الخادم
```bash
php artisan serve
```

### عرض جميع المسارات
```bash
php artisan route:list
```

### تحقق من إصدار Laravel
```bash
php artisan --version
```

### مسح جميع أنواع الـ cache
```bash
php artisan optimize:clear
```

---

## 🌟 أفضل الممارسات

1. **نظم المسارات**: جمّع المسارات ذات الصلة معاً
2. **استخدم التعليقات**: وثّق مساراتك
3. **التسمية المتسقة**: استخدم أسماء واضحة ووصفية
4. **ابدأ بسيطاً**: ابدأ بمسارات بسيطة، ثم أضف التعقيد لاحقاً

---

## 📚 موارد إضافية

- [توثيق Laravel الرسمي](https://laravel.com/docs)
- [Laravel News](https://laravel-news.com)
- [Laracasts](https://laracasts.com) - دروس فيديو
- [Laravel Daily](https://laraveldaily.com)

---

## 🎯 تمارين للتطبيق الذاتي

جرب هذه بنفسك:

1. أنشئ مسار `/services` يعرض خدماتك
2. أنشئ مسار `/portfolio` مع مشاريعك
3. أنشئ مسار `/testimonials` مع آراء العملاء
4. أضف روابط تنقل بين جميع الصفحات

---

## ✅ قائمة التحقق قبل الدرس التالي

- [ ] يمكنني تشغيل خادم Laravel
- [ ] أفهم كيفية تعريف المسارات
- [ ] يمكنني إنشاء عروض Blade
- [ ] أعرف أوامر Artisan الأساسية
- [ ] أفهم هيكل المشروع

---

**تعلم سعيد! 🚀**

**جاهز للدرس الثاني: أساسيات التوجيه!**
