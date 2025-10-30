# دليل التطبيق العملي للدرس الثاني

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-02\practice-app
php artisan serve
```

الخادم سيعمل على: `http://localhost:8000`

---

## 📋 المسارات المتاحة

### 1. الصفحة الرئيسية
- **URL**: `http://localhost:8000/`

### 2. مسارات المنتجات (Products)
- **GET** `/products` - قائمة المنتجات
- **GET** `/products/{id}` - عرض منتج محدد (مع قيد أرقام فقط)
- **GET** `/products/{slug}` - عرض منتج بالـ slug

### 3. مجموعة مسارات الأدمن
- **GET** `/admin/dashboard` - لوحة تحكم الأدمن
- **GET** `/admin/users` - إدارة المستخدمين
- **GET** `/admin/products` - إدارة المنتجات
- **GET** `/admin/settings` - الإعدادات

### 4. مسارات المستخدم
- **GET** `/user/{name?}` - صفحة مستخدم (الاسم اختياري)
- **GET** `/profile` - الملف الشخصي (مسار مسمى)

### 5. نموذج اتصل بنا
- **GET** `/contact` - عرض النموذج
- **POST** `/contact` - إرسال النموذج

---

## ✅ التمارين المنفذة

### التمرين 1: أنواع HTTP Methods
```php
Route::get('/products', function () {
    return 'قائمة المنتجات';
});

Route::post('/products', function () {
    return 'إنشاء منتج جديد';
});

Route::put('/products/{id}', function ($id) {
    return "تحديث المنتج $id";
});

Route::delete('/products/{id}', function ($id) {
    return "حذف المنتج $id";
});
```

### التمرين 2: معاملات المسار
```php
// معامل إلزامي مع قيد
Route::get('/product/{id}', function ($id) {
    return "عرض المنتج رقم: $id";
})->where('id', '[0-9]+')->name('product.show');

// معامل اختياري
Route::get('/user/{name?}', function ($name = 'ضيف') {
    return "مرحباً $name";
})->name('user.greeting');

// عدة معاملات
Route::get('/category/{category}/product/{product}', function ($category, $product) {
    return "التصنيف: $category - المنتج: $product";
});
```

### التمرين 3: المسارات المسماة
```php
Route::get('/dashboard', function () {
    return 'لوحة التحكم';
})->name('dashboard');

Route::get('/profile', function () {
    return 'الملف الشخصي';
})->name('profile');

// في Blade:
// <a href="{{ route('dashboard') }}">لوحة التحكم</a>
// <a href="{{ route('product.show', ['id' => 5]) }}">المنتج 5</a>
```

### التمرين 4: مجموعات المسارات
```php
Route::prefix('admin')
     ->name('admin.')
     ->group(function () {
         Route::get('/dashboard', function () {
             return 'لوحة تحكم الأدمن';
         })->name('dashboard');

         Route::get('/users', function () {
             return 'إدارة المستخدمين';
         })->name('users');

         Route::get('/products', function () {
             return 'إدارة المنتجات';
         })->name('products');

         Route::get('/settings', function () {
             return 'الإعدادات';
         })->name('settings');
     });
```

### التمرين 5: نموذج مع GET و POST
```php
// عرض النموذج
Route::get('/contact', function () {
    return view('contact');
})->name('contact.show');

// معالجة النموذج
Route::post('/contact', function () {
    // معالجة البيانات هنا
    return redirect()->route('contact.show')
                     ->with('success', 'تم إرسال رسالتك بنجاح!');
})->name('contact.submit');
```

---

## 🎯 ما تعلمناه

### 1. أنواع HTTP Methods
- GET للقراءة
- POST للإنشاء
- PUT/PATCH للتحديث
- DELETE للحذف

### 2. معاملات المسار
- معاملات إلزامية `{id}`
- معاملات اختيارية `{name?}`
- قيود المعاملات `->where()`

### 3. المسارات المسماة
- تسهل الإشارة للمسارات
- `->name('route.name')`
- `route('route.name')`

### 4. مجموعات المسارات
- `prefix()` - بادئة URL
- `name()` - بادئة الاسم
- `middleware()` - middleware مشترك
- `group()` - تجميع المسارات

---

## 📝 أوامر مفيدة

```bash
# عرض جميع المسارات
php artisan route:list

# مسارات مع prefix معين
php artisan route:list --path=admin

# بحث بالاسم
php artisan route:list --name=product

# عرض تفصيلي
php artisan route:list -v
```

---

## 🔍 اختبار المسارات

قم بزيارة كل مسار للتأكد من عمله:

1. ✅ `http://localhost:8000/products`
2. ✅ `http://localhost:8000/product/5`
3. ✅ `http://localhost:8000/admin/dashboard`
4. ✅ `http://localhost:8000/user/أحمد`
5. ✅ `http://localhost:8000/user` (بدون اسم)
6. ✅ `http://localhost:8000/contact`

---

## 💡 نصائح

1. **استخدم `route:list`** لعرض جميع المسارات
2. **احفظ التغييرات** قبل تحديث المتصفح
3. **استخدم المسارات المسماة** دائماً
4. **نظم المسارات** في مجموعات منطقية
5. **أضف قيود** على معاملات المسار

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 3**: المتحكمات ونمط MVC
- إنشاء Controllers
- تنظيم منطق التطبيق
- Resource Controllers

---

**تعلم سعيد! 🚀**
