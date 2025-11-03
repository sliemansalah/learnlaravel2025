# التمرين 2: إنشاء Views و Layout
# Exercise 2: Creating Views and Layout

---

## 📋 وصف التمرين

في هذا التمرين، ستتعلم كيفية إنشاء Views مع Blade Template Engine واستخدام Layouts.

**المستوى:** ⭐⭐☆ (متوسط)
**الوقت المقترح:** 25-30 دقيقة
**الملفات المطلوبة:**
- `resources/views/layouts/app.blade.php`
- `resources/views/home.blade.php`
- `resources/views/products.blade.php`
- `resources/views/cart.blade.php`
- `routes/web.php`

---

## 🎯 الأهداف التعليمية

- ✅ إنشاء Layout أساسي
- ✅ استخدام @yield و @section
- ✅ تمرير بيانات للـ Views
- ✅ استخدام Blade Directives (@foreach, @if, إلخ)
- ✅ استخدام @include

---

## 📝 المطلوب

### المهمة 1: إنشاء Layout (10 دقائق)

أنشئ ملف `resources/views/layouts/app.blade.php` يحتوي على:

#### المتطلبات:
- ✅ HTML5 Structure كامل
- ✅ `<title>` ديناميكي باستخدام `@yield('title')`
- ✅ Navigation Bar يحتوي على:
  - روابط: الرئيسية، المنتجات، سلة المشتريات
- ✅ Main Content Area باستخدام `@yield('content')`
- ✅ Footer يحتوي على: "© 2025 متجري - جميع الحقوق محفوظة"
- ✅ تنسيق CSS بسيط (inline styles أو `<style>` tag)

---

### المهمة 2: صفحة Home (5 دقائق)

أنشئ `resources/views/home.blade.php`:

#### المتطلبات:
- ✅ تستخدم Layout: `layouts.app`
- ✅ العنوان: "الصفحة الرئيسية"
- ✅ محتوى يحتوي على:
  - عنوان ترحيبي
  - فقرة وصفية
  - قائمة بـ 3 مميزات للمتجر

**Route:**
```php
Route::get('/', function () {
    return view('home');
});
```

---

### المهمة 3: صفحة Products (7 دقائق)

أنشئ `resources/views/products.blade.php`:

#### المتطلبات:
- ✅ تستخدم Layout: `layouts.app`
- ✅ العنوان: "المنتجات"
- ✅ عرض قائمة منتجات باستخدام `@foreach`
- ✅ كل منتج يعرض: الاسم، السعر، الوصف
- ✅ إذا كانت القائمة فارغة، عرض رسالة "لا توجد منتجات"

**البيانات:**
```php
$products = [
    ['id' => 1, 'name' => 'لابتوب HP', 'price' => 3000, 'description' => 'لابتوب قوي للعمل'],
    ['id' => 2, 'name' => 'هاتف Samsung', 'price' => 2000, 'description' => 'هاتف ذكي حديث'],
    ['id' => 3, 'name' => 'سماعات Sony', 'price' => 500, 'description' => 'سماعات عالية الجودة'],
];
```

**Route:**
```php
Route::get('/products', function () {
    // البيانات هنا
    return view('products', compact('products'));
});
```

---

### المهمة 4: صفحة Cart (5 دقائق)

أنشئ `resources/views/cart.blade.php`:

#### المتطلبات:
- ✅ تستخدم Layout: `layouts.app`
- ✅ العنوان: "سلة المشتريات"
- ✅ عرض items في السلة
- ✅ حساب المجموع الكلي
- ✅ إذا كانت السلة فارغة، عرض "سلة المشتريات فارغة"

**البيانات:**
```php
$cartItems = [
    ['name' => 'لابتوب HP', 'price' => 3000, 'quantity' => 1],
    ['name' => 'سماعات Sony', 'price' => 500, 'quantity' => 2],
];
```

**Route:**
```php
Route::get('/cart', function () {
    // البيانات هنا
    return view('cart', compact('cartItems'));
});
```

---

## ✅ معايير التقييم

| المعيار | النقاط |
|---------|--------|
| Layout صحيح ومنظم | 25 |
| Home page كاملة | 15 |
| Products page مع loop | 30 |
| Cart page مع حساب المجموع | 20 |
| التنسيق والتصميم | 10 |
| **المجموع** | **100** |

---

## 💡 نصائح

1. ابدأ بالـ Layout أولاً
2. اختبر كل view بعد إنشائه
3. استخدم `@forelse` بدلاً من `@foreach` مع `@empty`
4. لا تنسى `compact()` عند تمرير البيانات

---

**بالتوفيق! 🚀**
