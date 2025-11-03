# التمرين 1: إنشاء Routes بسيطة
# Exercise 1: Creating Simple Routes

---

## 📋 وصف التمرين

في هذا التمرين، ستتعلم كيفية إنشاء Routes مختلفة في Laravel وكيفية التعامل مع Route Parameters.

**المستوى:** ⭐☆☆ (سهل)
**الوقت المقترح:** 15-20 دقيقة
**الملفات المطلوبة:** `routes/web.php`

---

## 🎯 الأهداف التعليمية

بنهاية هذا التمرين، ستكون قادراً على:
- ✅ إنشاء routes بسيطة
- ✅ استخدام route parameters
- ✅ تطبيق validation على parameters
- ✅ استخدام named routes
- ✅ عمل redirects

---

## 📝 المطلوب

### المهمة 1: Routes البسيطة (5 دقائق)

أنشئ الـ routes التالية في ملف `routes/web.php`:

#### 1. الصفحة الرئيسية
- **URL:** `/`
- **النتيجة:** عرض نص "مرحباً بك في متجرنا الإلكتروني"

#### 2. صفحة من نحن
- **URL:** `/about`
- **النتيجة:** عرض HTML يحتوي على:
  - عنوان `<h1>`: "من نحن"
  - فقرة `<p>`: "نحن شركة متخصصة في البرمجة منذ عام 2020"

#### 3. صفحة الاتصال
- **URL:** `/contact`
- **النتيجة:** عرض JSON يحتوي على:
  ```json
  {
    "email": "info@example.com",
    "phone": "+966500000000",
    "address": "الرياض، المملكة العربية السعودية"
  }
  ```

---

### المهمة 2: Routes مع Parameters (5 دقائق)

#### 4. صفحة المنتج
- **URL:** `/product/{id}`
- **النتيجة:** عرض "رقم المنتج: {id}"
- **مثال:** `/product/123` يعرض "رقم المنتج: 123"
- **Validation:** يجب أن يكون id رقماً فقط

#### 5. صفحة المستخدم
- **URL:** `/user/{username}`
- **النتيجة:** عرض "صفحة المستخدم: {username}"
- **مثال:** `/user/ahmed` يعرض "صفحة المستخدم: ahmed"
- **Validation:** يجب أن يكون username حروف إنجليزية فقط (a-z)

#### 6. صفحة المقال مع التعليق
- **URL:** `/article/{articleId}/comment/{commentId}`
- **النتيجة:** عرض "المقال رقم {articleId}، التعليق رقم {commentId}"
- **Validation:** كلا الـ parameters يجب أن تكون أرقاماً

---

### المهمة 3: Optional Parameters (3 دقائق)

#### 7. صفحة الترحيب
- **URL:** `/welcome/{name?}`
- **النتيجة:**
  - إذا تم تمرير اسم: "أهلاً {name}، نورت الموقع!"
  - إذا لم يتم تمرير اسم: "أهلاً ضيفنا العزيز، نورت الموقع!"
- **مثال 1:** `/welcome/أحمد` يعرض "أهلاً أحمد، نورت الموقع!"
- **مثال 2:** `/welcome` يعرض "أهلاً ضيفنا العزيز، نورت الموقع!"

---

### المهمة 4: Named Routes و Redirects (5 دقائق)

#### 8. Dashboard Route
- **URL:** `/dashboard`
- **النتيجة:** عرض "لوحة التحكم"
- **الاسم:** `dashboard`

#### 9. Admin Panel Route
- **URL:** `/admin`
- **النتيجة:** Redirect إلى `/dashboard`

#### 10. Old Shop Route
- **URL:** `/old-shop`
- **النتيجة:** Permanent Redirect (301) إلى `/`

---

### المهمة 5: Route Groups (3 دقائق)

#### 11. مجموعة Admin Routes
أنشئ route group بـ prefix `/admin` تحتوي على:

- `/admin/users` → عرض "قائمة المستخدمين"
- `/admin/products` → عرض "قائمة المنتجات"
- `/admin/orders` → عرض "قائمة الطلبات"

---

## 🧪 كيفية الاختبار

### 1. تشغيل السيرفر

```bash
php artisan serve
```

### 2. اختبار Routes

افتح المتصفح واختبر كل URL:

```
✅ http://localhost:8000/
✅ http://localhost:8000/about
✅ http://localhost:8000/contact
✅ http://localhost:8000/product/123
✅ http://localhost:8000/user/ahmed
✅ http://localhost:8000/article/5/comment/10
✅ http://localhost:8000/welcome/أحمد
✅ http://localhost:8000/welcome
✅ http://localhost:8000/dashboard
✅ http://localhost:8000/admin
✅ http://localhost:8000/old-shop
✅ http://localhost:8000/admin/users
✅ http://localhost:8000/admin/products
✅ http://localhost:8000/admin/orders
```

### 3. اختبار Validation

جرّب:
- ❌ `/product/abc` (يجب أن يفشل)
- ✅ `/product/123` (يجب أن ينجح)
- ❌ `/user/123` (يجب أن يفشل)
- ✅ `/user/ahmed` (يجب أن ينجح)

### 4. التحقق من Routes

```bash
php artisan route:list
```

يجب أن ترى جميع الـ routes التي أنشأتها.

---

## ✅ معايير التقييم

### المطلوب للنجاح:

- [ ] جميع الـ routes تعمل بشكل صحيح
- [ ] Validation على Parameters يعمل
- [ ] Optional parameter يعمل مع وبدون قيمة
- [ ] Redirects تعمل بشكل صحيح
- [ ] Route group يعمل بشكل صحيح
- [ ] الكود منظم ومعلّق

### معايير التقييم:

| المعيار | النقاط |
|---------|--------|
| Routes البسيطة (1-3) | 20 نقطة |
| Routes مع Parameters (4-6) | 30 نقطة |
| Optional Parameters (7) | 10 نقطة |
| Named Routes و Redirects (8-10) | 20 نقطة |
| Route Groups (11) | 20 نقطة |
| **المجموع** | **100 نقطة** |

---

## 💡 نصائح

### نصيحة 1: استخدم التعليقات

```php
// 1. الصفحة الرئيسية
Route::get('/', function () {
    return 'مرحباً بك في متجرنا الإلكتروني';
});
```

### نصيحة 2: اختبر بعد كل route

لا تكتب جميع الـ routes مرة واحدة. اكتب واحداً واختبره، ثم انتقل للتالي.

### نصيحة 3: استخدم أوامر artisan

```bash
# لعرض جميع الـ routes
php artisan route:list

# لمسح route cache
php artisan route:clear
```

### نصيحة 4: راجع الأمثلة

إذا نسيت syntax معين، راجع ملف `code-examples/example-01-route.php`

---

## 🐛 مشاكل شائعة

### المشكلة 1: 404 Not Found

**السبب:** خطأ في كتابة URL أو لم يتم حفظ الملف

**الحل:**
1. تأكد من حفظ `routes/web.php`
2. تأكد من كتابة URL بشكل صحيح
3. شغّل `php artisan route:list` للتحقق

### المشكلة 2: Regex لا يعمل

**السبب:** خطأ في كتابة regular expression

**الحل:**
```php
// صحيح
->where('id', '[0-9]+')

// خطأ
->where('id', '[0-9]')  // ينقص +
```

### المشكلة 3: Redirect لا يعمل

**السبب:** خطأ في syntax

**الحل:**
```php
// صحيح
Route::redirect('/old', '/new');

// خطأ
Route::get('/old', redirect('/new'));  // syntax خاطئ
```

---

## 📚 مراجع مفيدة

- [Laravel Routing Documentation](https://laravel.com/docs/11.x/routing)
- `code-examples/example-01-route.php`
- `01-theory.md` - قسم Routing

---

## ⏭️ بعد الانتهاء

✅ **إذا أنهيت التمرين:**
1. تأكد من اختبار جميع الـ routes
2. راجع `exercise-01-solution.md`
3. قارن حلك بالحل النموذجي
4. انتقل إلى `exercise-02-problem.md`

⚠️ **إذا واجهت صعوبة:**
1. راجع الأمثلة في `code-examples/`
2. راجع الدرس النظري
3. حاول مرة أخرى
4. إذا لم تنجح، راجع الحل

---

**بالتوفيق! 🚀**
