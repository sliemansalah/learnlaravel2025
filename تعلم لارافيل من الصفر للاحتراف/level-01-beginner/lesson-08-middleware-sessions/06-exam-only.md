# الدرس 8: الامتحان - Middleware والجلسات
# Lesson 8: Exam - Middleware and Sessions

**المستوى:** مبتدئ | Beginner
**المدة:** ساعتان | Duration: 2 hours
**مجموع الدرجات:** 100 نقطة | Total Points: 100

---

## 📋 تعليمات الامتحان | Exam Instructions

- ⏱️ **المدة المخصصة:** ساعتان
- 📝 **يجب الإجابة على جميع الأسئلة**
- 💻 **الأسئلة العملية يجب اختبارها**
- 🚫 **لا تنظر للإجابات قبل المحاولة**
- ✅ **درجة النجاح:** 70/100
- 📄 **اكتب إجاباتك في ملف منفصل**

---

## القسم الأول: أسئلة الاختيار من متعدد (30 نقطة)

### السؤال 1 (2 نقطة)
**ما هو دور Middleware في Laravel?**

A) تخزين البيانات في قاعدة البيانات
B) فلترة الطلبات قبل وصولها للـ Controller
C) عرض الصفحات للمستخدم
D) إدارة Routes

**إجابتك:**

---

### السؤال 2 (2 نقطة)
**أي من التالي يُستخدم لإنشاء Middleware جديد?**

A) `php artisan create:middleware CheckAge`
B) `php artisan make:middleware CheckAge`
C) `php artisan new:middleware CheckAge`
D) `php artisan generate:middleware CheckAge`

**إجابتك:**

---

### السؤال 3 (2 نقطة)
**أين يتم تسجيل Route Middleware في Laravel 11?**

A) `config/middleware.php`
B) `app/Http/Kernel.php`
C) `bootstrap/app.php`
D) `routes/web.php`

**إجابتك:**

---

### السؤال 4 (2 نقطة)
**ما هي الطريقة الصحيحة لتمرير معامل لـ Middleware?**

A) `->middleware('role', 'admin')`
B) `->middleware('role:admin')`
C) `->middleware('role' => 'admin')`
D) `->middleware(['role', 'admin'])`

**إجابتك:**

---

### السؤال 5 (2 نقطة)
**ما الفرق بين Global Middleware و Route Middleware?**

A) لا يوجد فرق
B) Global يعمل على جميع الطلبات، Route على مسارات محددة
C) Global أسرع من Route
D) Route أكثر أماناً من Global

**إجابتك:**

---

### السؤال 6 (2 نقطة)
**كيف يتم حفظ بيانات في Session?**

A) `session()->save('key', 'value')`
B) `session()->store('key', 'value')`
C) `session()->put('key', 'value')`
D) `session()->set('key', 'value')`

**إجابتك:**

---

### السؤال 7 (2 نقطة)
**ما هو Session Driver الأنسب للمشاريع الكبيرة?**

A) file
B) cookie
C) array
D) redis

**إجابتك:**

---

### السؤال 8 (2 نقطة)
**ما هي Flash Messages?**

A) رسائل دائمة في Session
B) رسائل تُحذف بعد قراءتها مرة واحدة
C) رسائل email
D) رسائل في قاعدة البيانات

**إجابتك:**

---

### السؤال 9 (2 نقطة)
**كيف يتم إنشاء Flash Message?**

A) `session()->flash('message', 'text')`
B) `redirect()->with('message', 'text')`
C) كلاهما صحيح
D) لا شيء مما سبق

**إجابتك:**

---

### السؤال 10 (2 نقطة)
**أي method يُستخدم لحذف بيانات من Session?**

A) `session()->delete('key')`
B) `session()->remove('key')`
C) `session()->forget('key')`
D) `session()->unset('key')`

**إجابتك:**

---

### السؤال 11 (2 نقطة)
**ما الفرق بين `has()` و `exists()` في Sessions?**

A) لا يوجد فرق
B) `has()` تتحقق من القيمة ليست null، `exists()` تتحقق من وجود المفتاح
C) `has()` أسرع من `exists()`
D) `exists()` للـ arrays فقط

**إجابتك:**

---

### السؤال 12 (2 نقطة)
**ما هو `$next($request)` في Middleware?**

A) إيقاف الطلب
B) تمرير الطلب للطبقة التالية
C) إعادة توجيه المستخدم
D) حفظ الطلب في قاعدة البيانات

**إجابتك:**

---

### السؤال 13 (2 نقطة)
**كيف يتم تطبيق Middleware على Controller?**

A) في الـ Route فقط
B) في الـ Constructor
C) كلاهما صحيح
D) غير ممكن

**إجابتك:**

---

### السؤال 14 (2 نقطة)
**ما هو lifetime الافتراضي لـ Session في Laravel?**

A) 30 دقيقة
B) 60 دقيقة
C) 120 دقيقة
D) 180 دقيقة

**إجابتك:**

---

### السؤال 15 (2 نقطة)
**أي من التالي يُستخدم لحذف جميع بيانات Session?**

A) `session()->delete()`
B) `session()->clear()`
C) `session()->flush()`
D) `session()->removeAll()`

**إجابتك:**

---

## القسم الثاني: أسئلة صح أو خطأ (20 نقطة)

### السؤال 16 (2 نقطة)
**Middleware يمكن أن يعمل قبل وبعد معالجة الطلب.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 17 (2 نقطة)
**يمكن تخزين كائنات PHP كاملة في Session بدون serialization.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 18 (2 نقطة)
**Global Middleware يُنفذ بعد Route Middleware.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 19 (2 نقطة)
**Flash Messages تبقى في Session حتى يتم حذفها يدوياً.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 20 (2 نقطة)
**يمكن تمرير أكثر من معامل واحد لـ Middleware.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 21 (2 نقطة)
**Session Driver 'array' مناسب للإنتاج (Production).**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 22 (2 نقطة)
**يجب تسجيل Middleware قبل استخدامه في Routes.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 23 (2 نقطة)
**Middleware يمكنه تعديل الاستجابة (Response) قبل إرسالها.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 24 (2 نقطة)
**Sessions في Laravel مشفرة تلقائياً.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

### السؤال 25 (2 نقطة)
**يمكن استخدام Middleware على route واحد فقط.**

- [ ] صح (True)
- [ ] خطأ (False)

**إجابتك:**

---

## القسم الثالث: أسئلة برمجية (50 نقطة)

### السؤال 26 (10 نقاط)
**أنشئ Middleware يتحقق من أن المستخدم admin.**

**المتطلبات:**
- تحقق من تسجيل الدخول
- تحقق من أن المستخدم لديه صفة admin
- أعد توجيه غير المصرح لهم بشكل مناسب
- سجل الـ Middleware واستخدمه في route

**اكتب الكود هنا:**

```php
// app/Http/Middleware/CheckAdmin.php




```

```php
// bootstrap/app.php - التسجيل




```

```php
// routes/web.php - الاستخدام




```

---

### السؤال 27 (10 نقاط)
**أنشئ نظام سلة تسوق بسيط باستخدام Sessions يحتوي على: إضافة، حذف، وحساب المجموع.**

**المتطلبات:**
- Service class لإدارة السلة
- دوال: add(), remove(), getTotal(), getCart()
- Controller لاستخدام الـ Service

**اكتب الكود هنا:**

```php
// app/Services/CartService.php




```

```php
// app/Http/Controllers/CartController.php




```

---

### السؤال 28 (10 نقاط)
**أنشئ Middleware يسجل معلومات كل طلب (URL, Method, IP, Time) في ملف log.**

**المتطلبات:**
- تسجيل جميع المعلومات المطلوبة
- قياس وقت الاستجابة
- استخدام Log facade
- تسجيله كـ Global Middleware

**اكتب الكود هنا:**

```php
// app/Http/Middleware/LogRequests.php




```

---

### السؤال 29 (10 نقاط)
**أنشئ نظام Flash Messages يدعم success, error, warning, info مع Component للعرض.**

**المتطلبات:**
- Helper class بدوال للأنواع الأربعة
- Blade Component للعرض
- تصميم جميل مع auto-dismiss
- مثال استخدام في Controller

**اكتب الكود هنا:**

```php
// app/Helpers/Flash.php




```

```blade
{{-- resources/views/components/flash-alert.blade.php --}}




```

```php
// مثال الاستخدام في Controller




```

---

### السؤال 30 (10 نقاط)
**أنشئ Middleware يتحقق من صلاحية معينة مع إمكانية تمرير اسم الصلاحية كمعامل.**

**المتطلبات:**
- دعم معاملات متعددة
- التحقق من وجود الصلاحية للمستخدم
- معالجة الأخطاء بشكل صحيح
- أمثلة استخدام في Routes

**اكتب الكود هنا:**

```php
// app/Http/Middleware/CheckPermission.php




```

```php
// app/Models/User.php - أضف method hasPermission




```

```php
// routes/web.php - أمثلة الاستخدام




```

---

## 📊 جدول الدرجات | Grading Table

| القسم | عدد الأسئلة | الدرجات | درجتي |
|------|------------|---------|--------|
| الاختيار من متعدد | 15 | 30 | |
| صح أو خطأ | 10 | 20 | |
| أسئلة برمجية | 5 | 50 | |
| **المجموع** | **30** | **100** | |

---

## ✅ Checklist قبل التسليم

تأكد من:

- [ ] أجبت على جميع الأسئلة
- [ ] اختبرت الكود البرمجي
- [ ] الكود يعمل بدون أخطاء
- [ ] راجعت الإجابات
- [ ] كتبت تعليقات في الكود
- [ ] نظفت الكود

---

## 🎯 معايير التقييم

| الدرجة | التقدير |
|--------|---------|
| 90-100 | ممتاز |
| 80-89 | جيد جداً |
| 70-79 | جيد |
| 60-69 | مقبول |
| أقل من 60 | راسب |

---

## 💡 نصائح للامتحان

1. ⏱️ **إدارة الوقت:**
   - 30 دقيقة للقسم الأول
   - 20 دقيقة للقسم الثاني
   - 70 دقيقة للقسم الثالث

2. 📝 **الأولويات:**
   - ابدأ بالأسئلة السهلة
   - اترك الصعبة للنهاية
   - راجع إجاباتك

3. 💻 **البرمجة:**
   - اختبر كل كود
   - اكتب تعليقات
   - تأكد من الـ syntax

4. 🤔 **التفكير:**
   - اقرأ السؤال جيداً
   - فكر قبل الكتابة
   - لا تتسرع

---

## 📚 مراجعة سريعة

### Middleware Basics
- `php artisan make:middleware Name`
- تسجيل في `bootstrap/app.php`
- `$next($request)` - تمرير الطلب
- يمكن العمل قبل وبعد الطلب

### Sessions
- `session()->put('key', 'value')` - حفظ
- `session()->get('key')` - استرجاع
- `session()->forget('key')` - حذف
- `session()->flush()` - حذف الكل

### Flash Messages
- `session()->flash('key', 'value')`
- `redirect()->with('key', 'value')`
- تُحذف بعد قراءة واحدة

---

**حظاً موفقاً في الامتحان! 🍀**

**📌 تذكير:** لا تنظر للإجابات قبل إكمال محاولتك!

**تاريخ الامتحان:** ______________
**الاسم:** ______________
**الدرجة:** _____ / 100

---

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
