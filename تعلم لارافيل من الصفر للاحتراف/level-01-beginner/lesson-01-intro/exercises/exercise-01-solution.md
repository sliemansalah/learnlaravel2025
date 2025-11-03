# حل التمرين 1: إنشاء Routes بسيطة
# Exercise 1 Solution: Creating Simple Routes

---

## 📋 الحل الكامل

هذا هو الحل النموذجي للتمرين الأول.

**ملاحظة:** قد يكون حلك مختلفاً قليلاً وهذا طبيعي، المهم أن يعمل بشكل صحيح!

---

## 💻 الكود الكامل

### ملف `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;

// ==================================================
// المهمة 1: Routes البسيطة
// ==================================================

// 1. الصفحة الرئيسية
Route::get('/', function () {
    return 'مرحباً بك في متجرنا الإلكتروني';
});

// 2. صفحة من نحن
Route::get('/about', function () {
    return '<h1>من نحن</h1><p>نحن شركة متخصصة في البرمجة منذ عام 2020</p>';
});

// 3. صفحة الاتصال
Route::get('/contact', function () {
    return [
        'email' => 'info@example.com',
        'phone' => '+966500000000',
        'address' => 'الرياض، المملكة العربية السعودية'
    ];
});

// ==================================================
// المهمة 2: Routes مع Parameters
// ==================================================

// 4. صفحة المنتج
Route::get('/product/{id}', function ($id) {
    return "رقم المنتج: {$id}";
})->where('id', '[0-9]+');

// 5. صفحة المستخدم
Route::get('/user/{username}', function ($username) {
    return "صفحة المستخدم: {$username}";
})->where('username', '[a-zA-Z]+');

// 6. صفحة المقال مع التعليق
Route::get('/article/{articleId}/comment/{commentId}', function ($articleId, $commentId) {
    return "المقال رقم {$articleId}، التعليق رقم {$commentId}";
})->where([
    'articleId' => '[0-9]+',
    'commentId' => '[0-9]+'
]);

// ==================================================
// المهمة 3: Optional Parameters
// ==================================================

// 7. صفحة الترحيب
Route::get('/welcome/{name?}', function ($name = null) {
    if ($name) {
        return "أهلاً {$name}، نورت الموقع!";
    }
    return "أهلاً ضيفنا العزيز، نورت الموقع!";
});

// ==================================================
// المهمة 4: Named Routes و Redirects
// ==================================================

// 8. Dashboard Route
Route::get('/dashboard', function () {
    return 'لوحة التحكم';
})->name('dashboard');

// 9. Admin Panel Route
Route::get('/admin', function () {
    return redirect()->route('dashboard');
});

// 10. Old Shop Route
Route::permanentRedirect('/old-shop', '/');

// ==================================================
// المهمة 5: Route Groups
// ==================================================

// 11. مجموعة Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'قائمة المستخدمين';
    });

    Route::get('/products', function () {
        return 'قائمة المنتجات';
    });

    Route::get('/orders', function () {
        return 'قائمة الطلبات';
    });
});
```

---

## 📖 شرح الحل

### المهمة 1: Routes البسيطة

#### الـ Route 1-2: String و HTML

```php
// إرجاع نص بسيط
return 'نص';

// إرجاع HTML
return '<h1>عنوان</h1>';
```

Laravel يدعم إرجاع strings مباشرة من الـ routes.

#### الـ Route 3: JSON

```php
return [
    'key' => 'value'
];
```

عند إرجاع array، Laravel يحوله تلقائياً إلى JSON.

---

### المهمة 2: Routes مع Parameters

#### استقبال Parameters

```php
Route::get('/product/{id}', function ($id) {
    // استخدام $id
});
```

اسم المتغير في الـ function يجب أن يطابق اسمه في الـ URL.

#### Validation على Parameters

```php
->where('id', '[0-9]+')  // أرقام فقط
->where('username', '[a-zA-Z]+')  // حروف فقط
```

الـ `+` تعني "واحد أو أكثر".

#### Multiple Parameters Validation

```php
->where([
    'articleId' => '[0-9]+',
    'commentId' => '[0-9]+'
])
```

---

### المهمة 3: Optional Parameters

```php
Route::get('/welcome/{name?}', function ($name = null) {
    if ($name) {
        // إذا تم تمرير name
    }
    // إذا لم يتم تمرير name
});
```

**ملاحظات:**
- `{name?}` الـ `?` تجعل الـ parameter اختياري
- `$name = null` قيمة افتراضية
- يمكن استخدام `isset($name)` أو `if ($name)`

**طريقة أخرى:**

```php
Route::get('/welcome/{name?}', function ($name = 'ضيفنا العزيز') {
    return "أهلاً {$name}، نورت الموقع!";
});
```

---

### المهمة 4: Named Routes و Redirects

#### Named Routes

```php
Route::get('/dashboard', function () {
    return 'لوحة التحكم';
})->name('dashboard');
```

**فائدة:** يمكن الرجوع له بالاسم بدلاً من URL:

```php
redirect()->route('dashboard')  // بدلاً من redirect('/dashboard')
```

#### Redirects

```php
// Redirect عادي
Route::get('/admin', function () {
    return redirect()->route('dashboard');
});

// Permanent Redirect (301)
Route::permanentRedirect('/old-shop', '/');
```

**الفرق:**
- `redirect()`: 302 (Temporary)
- `permanentRedirect()`: 301 (Permanent)

---

### المهمة 5: Route Groups

```php
Route::prefix('admin')->group(function () {
    Route::get('/users', ...);     // /admin/users
    Route::get('/products', ...);  // /admin/products
});
```

**فائدة:** تجنب تكرار الـ prefix.

---

## ✅ اختبار الحل

### نتائج متوقعة:

| URL | النتيجة المتوقعة |
|-----|-------------------|
| `/` | مرحباً بك في متجرنا الإلكتروني |
| `/about` | HTML مع عنوان وفقرة |
| `/contact` | JSON مع بيانات الاتصال |
| `/product/123` | رقم المنتج: 123 |
| `/product/abc` | 404 (فشل validation) |
| `/user/ahmed` | صفحة المستخدم: ahmed |
| `/user/123` | 404 (فشل validation) |
| `/article/5/comment/10` | المقال رقم 5، التعليق رقم 10 |
| `/welcome/أحمد` | أهلاً أحمد، نورت الموقع! |
| `/welcome` | أهلاً ضيفنا العزيز، نورت الموقع! |
| `/dashboard` | لوحة التحكم |
| `/admin` | Redirect إلى /dashboard |
| `/old-shop` | Redirect إلى / (301) |
| `/admin/users` | قائمة المستخدمين |

---

## 🔍 مقارنة الحلول

### قد تكون كتبت:

#### للـ Optional Parameter:

```php
// حلك (صحيح)
Route::get('/welcome/{name?}', function ($name = 'ضيفنا العزيز') {
    return "أهلاً {$name}، نورت الموقع!";
});

// الحل النموذجي (أيضاً صحيح)
Route::get('/welcome/{name?}', function ($name = null) {
    if ($name) {
        return "أهلاً {$name}، نورت الموقع!";
    }
    return "أهلاً ضيفنا العزيز، نورت الموقع!";
});
```

**كلاهما صحيح!** الفرق فقط في الأسلوب.

---

#### للـ Redirect:

```php
// طريقة 1 (مستخدمة في الحل)
Route::get('/admin', function () {
    return redirect()->route('dashboard');
});

// طريقة 2 (أيضاً صحيحة)
Route::redirect('/admin', '/dashboard');
```

---

## 💡 نقاط تعلمها

### من هذا التمرين تعلمت:

✅ **1. Route Basics**
- كيفية إنشاء routes بسيطة
- الفرق بين string, HTML, و JSON

✅ **2. Route Parameters**
- كيفية استقبال parameters
- كيفية عمل validation عليها
- استخدام multiple parameters

✅ **3. Optional Parameters**
- استخدام `?` للجعل parameter اختياري
- التعامل مع القيم الافتراضية

✅ **4. Named Routes**
- تسمية الـ routes
- استخدام الأسماء في redirects

✅ **5. Redirects**
- الفرق بين temporary و permanent redirects
- استخدام `redirect()`

✅ **6. Route Groups**
- تنظيم الـ routes بالـ groups
- استخدام prefix

---

## 🚀 تحسينات إضافية

### يمكنك تحسين الحل بـ:

#### 1. إضافة Middleware للـ Admin Group

```php
Route::prefix('admin')->middleware('auth')->group(function () {
    // ...
});
```

#### 2. استخدام Name Prefix للـ Admin Routes

```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', function () {
        return 'قائمة المستخدمين';
    })->name('users');  // اسمه: admin.users
});
```

#### 3. استخدام Controller بدلاً من Closures

```php
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->where('id', '[0-9]+');
```

---

## 📊 تقييم الحل

### إذا حصلت على:

✅ **90-100 نقطة:** ممتاز! لديك فهم جيد للـ Routing

✅ **80-89 نقطة:** جيد جداً! راجع النقاط الناقصة

⚠️ **70-79 نقطة:** جيد، لكن تحتاج مراجعة

❌ **أقل من 70:** راجع الدرس النظري وحاول مرة أخرى

---

## ⏭️ الخطوة التالية

✅ **أنهيت التمرين الأول؟**

1. تأكد من فهم جميع النقاط
2. جرّب التحسينات الإضافية
3. انتقل إلى **`exercise-02-problem.md`**

---

**مبروك! أنجزت التمرين الأول بنجاح! 🎉**
