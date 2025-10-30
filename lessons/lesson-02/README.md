# الدرس 2: أساسيات التوجيه (Routing)

## 📖 جدول المحتويات
1. [مقدمة في نظام التوجيه](#مقدمة-في-نظام-التوجيه)
2. [أنواع المسارات HTTP](#أنواع-المسارات-http)
3. [معاملات المسار](#معاملات-المسار)
4. [المسارات المسماة](#المسارات-المسماة)
5. [مجموعات المسارات](#مجموعات-المسارات)
6. [Route Model Binding](#route-model-binding)
7. [التمارين العملية](#التمارين-العملية)

---

## مقدمة في نظام التوجيه

نظام التوجيه في Laravel هو **بوابة التطبيق**. كل طلب يصل إلى تطبيقك يمر عبر نظام التوجيه الذي يقرر كيفية معالجته.

### لماذا التوجيه مهم؟

- 🎯 **ينظم طلبات التطبيق**: يربط URLs بالمنطق المناسب
- 🔒 **يوفر الأمان**: يمكنك إضافة middleware للحماية
- 📝 **يسهل الصيانة**: كل المسارات في مكان واحد
- 🚀 **يدعم RESTful APIs**: بناء APIs احترافية

### أين توجد المسارات؟

```
routes/
├── web.php      # مسارات الويب (صفحات HTML)
├── api.php      # مسارات API (JSON responses)
├── console.php  # أوامر Artisan
└── channels.php # Broadcasting channels
```

---

## أنواع المسارات HTTP

Laravel يدعم جميع أنواع HTTP Methods الأساسية.

### 1. GET - قراءة البيانات

يُستخدم لعرض البيانات فقط (لا يغير شيئاً في قاعدة البيانات).

```php
Route::get('/users', function () {
    return 'قائمة المستخدمين';
});

Route::get('/user/{id}', function ($id) {
    return "عرض المستخدم رقم: $id";
});
```

**متى تستخدمه؟**
- عرض صفحة
- قراءة بيانات
- البحث

### 2. POST - إنشاء بيانات جديدة

يُستخدم لإرسال بيانات جديدة للخادم.

```php
Route::post('/users', function () {
    // إنشاء مستخدم جديد
    return 'تم إنشاء المستخدم';
});
```

**متى تستخدمه؟**
- إرسال نموذج (Form)
- إنشاء سجل جديد
- تحميل ملف

### 3. PUT/PATCH - تحديث بيانات موجودة

```php
// PUT - تحديث كامل
Route::put('/users/{id}', function ($id) {
    return "تحديث المستخدم $id بالكامل";
});

// PATCH - تحديث جزئي
Route::patch('/users/{id}', function ($id) {
    return "تحديث بعض بيانات المستخدم $id";
});
```

**الفرق بين PUT و PATCH:**
- **PUT**: تحديث كامل (كل الحقول)
- **PATCH**: تحديث جزئي (بعض الحقول)

### 4. DELETE - حذف بيانات

```php
Route::delete('/users/{id}', function ($id) {
    return "حذف المستخدم $id";
});
```

### 5. مسار يقبل عدة Methods

```php
Route::match(['get', 'post'], '/form', function () {
    return 'يقبل GET و POST';
});

// جميع الـ Methods
Route::any('/test', function () {
    return 'يقبل أي method';
});
```

### جدول ملخص Methods:

| Method | الاستخدام | مثال |
|--------|----------|-------|
| **GET** | قراءة/عرض | عرض قائمة المنتجات |
| **POST** | إنشاء جديد | إضافة منتج جديد |
| **PUT** | تحديث كامل | تحديث كل بيانات منتج |
| **PATCH** | تحديث جزئي | تحديث سعر منتج فقط |
| **DELETE** | حذف | حذف منتج |

---

## معاملات المسار

معاملات المسار تسمح لك بالتقاط قيم من الـ URL.

### 1. معاملات إلزامية

```php
// معامل واحد
Route::get('/user/{id}', function ($id) {
    return "المستخدم رقم: $id";
});

// عدة معاملات
Route::get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
    return "المقال $postId - التعليق $commentId";
});
```

**أمثلة URLs:**
- `/user/5` → `$id = 5`
- `/post/10/comment/3` → `$postId = 10`, `$commentId = 3`

### 2. معاملات اختيارية

```php
Route::get('/user/{name?}', function ($name = 'ضيف') {
    return "مرحباً $name";
});
```

**أمثلة:**
- `/user/أحمد` → "مرحباً أحمد"
- `/user` → "مرحباً ضيف"

### 3. قيود على المعاملات (Regular Expressions)

```php
// أرقام فقط
Route::get('/user/{id}', function ($id) {
    return "المستخدم: $id";
})->where('id', '[0-9]+');

// حروف فقط
Route::get('/user/{name}', function ($name) {
    return "المستخدم: $name";
})->where('name', '[A-Za-z]+');

// عدة قيود
Route::get('/user/{id}/{name}', function ($id, $name) {
    return "ID: $id, الاسم: $name";
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

### 4. قيود عامة (Global Constraints)

في `app/Providers/RouteServiceProvider.php`:

```php
public function boot(): void
{
    // كل {id} يجب أن يكون رقم
    Route::pattern('id', '[0-9]+');

    // كل {slug} يجب أن يكون حروف وأرقام
    Route::pattern('slug', '[a-z0-9-]+');
}
```

---

## المسارات المسماة

المسارات المسماة تسهل الإشارة إلى المسارات في التطبيق.

### لماذا المسارات المسماة؟

✅ **سهولة التعديل**: غيّر الـ URL دون تغيير الكود
✅ **وضوح الكود**: أسماء واضحة بدلاً من URLs
✅ **تجنب الأخطاء**: لا داعي لكتابة URLs يدوياً

### تعريف مسار مسمى

```php
Route::get('/user/profile', function () {
    return 'صفحة الملف الشخصي';
})->name('profile');

Route::get('/dashboard', function () {
    return 'لوحة التحكم';
})->name('dashboard');
```

### استخدام المسارات المسماة

#### في Blade Templates:

```blade
<!-- رابط بسيط -->
<a href="{{ route('profile') }}">الملف الشخصي</a>

<!-- رابط مع معاملات -->
<a href="{{ route('user.show', ['id' => 1]) }}">عرض المستخدم</a>

<!-- Redirect -->
return redirect()->route('dashboard');
```

#### في Controllers:

```php
// Redirect
return redirect()->route('profile');

// مع معاملات
return redirect()->route('user.show', ['id' => $userId]);

// مع رسالة
return redirect()->route('dashboard')
                 ->with('success', 'تم بنجاح');
```

#### الحصول على URL للمسار:

```php
$url = route('profile');  // http://yourapp.com/user/profile
```

### تسمية المسارات بشكل منظم

```php
// تسمية واضحة
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
```

**نمط التسمية الموصى به:** `resource.action`

---

## مجموعات المسارات

مجموعات المسارات تساعد في تنظيم المسارات المتشابهة.

### 1. Route Prefix

```php
// بدون مجموعة
Route::get('/admin/users', function () { });
Route::get('/admin/posts', function () { });
Route::get('/admin/settings', function () { });

// مع مجموعة - أفضل!
Route::prefix('admin')->group(function () {
    Route::get('/users', function () { });      // /admin/users
    Route::get('/posts', function () { });      // /admin/posts
    Route::get('/settings', function () { });   // /admin/settings
});
```

### 2. Route Middleware

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return 'لوحة التحكم';
    });

    Route::get('/profile', function () {
        return 'الملف الشخصي';
    });
});
```

### 3. Name Prefix

```php
Route::name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        // ...
    })->name('dashboard');  // الاسم الكامل: admin.dashboard

    Route::get('/users', function () {
        // ...
    })->name('users');      // الاسم الكامل: admin.users
});
```

### 4. دمج كل الخصائص

```php
Route::prefix('admin')
     ->middleware(['auth', 'admin'])
     ->name('admin.')
     ->group(function () {

         Route::get('/dashboard', function () {
             return 'لوحة التحكم';
         })->name('dashboard'); // admin.dashboard

         Route::get('/users', function () {
             return 'المستخدمون';
         })->name('users');     // admin.users

         Route::get('/posts', function () {
             return 'المقالات';
         })->name('posts');     // admin.posts
     });
```

**النتيجة:**
- URL: `/admin/dashboard`, `/admin/users`, `/admin/posts`
- Names: `admin.dashboard`, `admin.users`, `admin.posts`
- Middleware: `auth`, `admin` على كل المسارات

---

## Route Model Binding

ميزة قوية تسمح لـ Laravel بجلب النماذج تلقائياً من قاعدة البيانات.

### 1. Implicit Binding (تلقائي)

```php
use App\Models\User;

// بدون Model Binding
Route::get('/user/{id}', function ($id) {
    $user = User::findOrFail($id);
    return view('user.profile', ['user' => $user]);
});

// مع Model Binding - أبسط!
Route::get('/user/{user}', function (User $user) {
    // Laravel يجلب المستخدم تلقائياً
    return view('user.profile', ['user' => $user]);
});
```

**كيف يعمل؟**
1. Laravel يلاحظ أن المعامل اسمه `{user}`
2. ويلاحظ أن النوع هو `User $user`
3. يبحث عن `User::find($id)` تلقائياً
4. إذا لم يجد، يرجع 404

### 2. Custom Key

افتراضياً، Laravel يبحث بـ `id`. لكن يمكنك تغيير ذلك:

```php
// البحث بـ slug بدلاً من id
Route::get('/post/{post:slug}', function (Post $post) {
    return view('post.show', ['post' => $post]);
});
```

**مثال URL:** `/post/laravel-routing-tutorial`

### 3. تخصيص في Model

في `App\Models\Post.php`:

```php
public function getRouteKeyName()
{
    return 'slug';  // استخدم slug بدلاً من id
}
```

الآن يمكنك:
```php
Route::get('/post/{post}', function (Post $post) {
    // يبحث بـ slug تلقائياً
    return view('post.show', ['post' => $post]);
});
```

---

## إعادة التوجيه (Redirects)

### أنواع Redirects:

```php
// 1. Redirect بسيط
Route::get('/old-page', function () {
    return redirect('/new-page');
});

// 2. Redirect إلى مسار مسمى
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

// 3. Redirect دائم (301)
Route::redirect('/old', '/new', 301);

// 4. Redirect للخلف
return back();

// 5. Redirect مع بيانات
return redirect()->route('dashboard')
                 ->with('success', 'تم بنجاح!');
```

---

## Fallback Route

مسار احتياطي عند عدم تطابق أي مسار:

```php
Route::fallback(function () {
    return view('errors.404');
});
```

---

## عرض جميع المسارات

```bash
php artisan route:list
```

خيارات مفيدة:
```bash
# مسارات معينة فقط
php artisan route:list --path=api

# بحث
php artisan route:list --name=user

# مع middleware
php artisan route:list --middleware=auth
```

---

## أفضل الممارسات

### ✅ افعل:

1. **استخدم أسماء واضحة**
   ```php
   Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
   ```

2. **نظم المسارات في مجموعات**
   ```php
   Route::prefix('admin')->group(function () {
       // مسارات الأدمن
   });
   ```

3. **استخدم Resource Routes للـ CRUD**
   ```php
   Route::resource('posts', PostController::class);
   ```

4. **استخدم Model Binding**
   ```php
   Route::get('/user/{user}', function (User $user) {
       return view('user', compact('user'));
   });
   ```

### ❌ لا تفعل:

1. **لا تضع logic في routes**
   ```php
   // ❌ سيء
   Route::get('/users', function () {
       $users = User::all();
       // 50 سطر من الكود...
   });

   // ✅ جيد
   Route::get('/users', [UserController::class, 'index']);
   ```

2. **لا تكرر نفس الكود**
   ```php
   // ❌ سيء
   Route::get('/admin/users', ...)->middleware('auth');
   Route::get('/admin/posts', ...)->middleware('auth');

   // ✅ جيد
   Route::middleware('auth')->prefix('admin')->group(...);
   ```

---

## التمارين العملية

### التمرين 1: مسارات أساسية ✅

أنشئ المسارات التالية في `routes/web.php`:

```php
// 1. صفحة رئيسية
Route::get('/', function () {
    return view('welcome');
});

// 2. صفحة "عنّا"
Route::get('/about', function () {
    return view('about');
});

// 3. صفحة اتصل بنا
Route::get('/contact', function () {
    return view('contact');
});
```

### التمرين 2: معاملات المسار

```php
// 1. عرض منتج بـ ID
Route::get('/product/{id}', function ($id) {
    return "عرض المنتج رقم: $id";
})->where('id', '[0-9]+');

// 2. عرض منتج بـ slug
Route::get('/product/{slug}', function ($slug) {
    return "عرض المنتج: $slug";
})->where('slug', '[a-z0-9-]+');

// 3. معاملات متعددة
Route::get('/category/{category}/product/{product}', function ($category, $product) {
    return "التصنيف: $category - المنتج: $product";
});
```

### التمرين 3: المسارات المسماة

```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// في Blade:
// <a href="{{ route('dashboard') }}">لوحة التحكم</a>
```

### التمرين 4: مجموعات المسارات

```php
// مجموعة مسارات الأدمن
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'لوحة تحكم الأدمن';
    })->name('dashboard');

    Route::get('/users', function () {
        return 'إدارة المستخدمين';
    })->name('users');

    Route::get('/posts', function () {
        return 'إدارة المقالات';
    })->name('posts');
});
```

### التمرين 5: أنواع HTTP Methods المختلفة

```php
// نموذج اتصل بنا
Route::get('/contact', function () {
    return view('contact');
})->name('contact.show');

Route::post('/contact', function () {
    // معالجة البيانات
    return redirect()->route('contact.show')
                     ->with('success', 'تم إرسال رسالتك!');
})->name('contact.submit');
```

### التحدي: نظام CRUD كامل

```php
// Posts CRUD
Route::get('/posts', function () {
    return 'قائمة المقالات';
})->name('posts.index');

Route::get('/posts/create', function () {
    return 'إضافة مقال جديد';
})->name('posts.create');

Route::post('/posts', function () {
    return 'حفظ المقال';
})->name('posts.store');

Route::get('/posts/{id}', function ($id) {
    return "عرض المقال $id";
})->name('posts.show');

Route::get('/posts/{id}/edit', function ($id) {
    return "تعديل المقال $id";
})->name('posts.edit');

Route::put('/posts/{id}', function ($id) {
    return "تحديث المقال $id";
})->name('posts.update');

Route::delete('/posts/{id}', function ($id) {
    return "حذف المقال $id";
})->name('posts.destroy');
```

---

## 🎯 الملخص

في هذا الدرس، تعلمت:

✅ أنواع HTTP Methods (GET, POST, PUT, DELETE)
✅ معاملات المسار (إلزامية واختيارية)
✅ قيود المعاملات (Regular Expressions)
✅ المسارات المسماة وفوائدها
✅ مجموعات المسارات وتنظيمها
✅ Route Model Binding
✅ أفضل ممارسات التوجيه

---

## 📚 موارد إضافية

- [Laravel Routing Documentation](https://laravel.com/docs/routing)
- [RESTful Resource Controllers](https://laravel.com/docs/controllers#resource-controllers)
- [Route Model Binding](https://laravel.com/docs/routing#route-model-binding)

---

## ✅ اختبر نفسك

قبل الانتقال إلى الدرس 3، تأكد من قدرتك على:

1. ما الفرق بين GET و POST؟
2. كيف تنشئ معامل مسار اختياري؟
3. لماذا نستخدم المسارات المسماة؟
4. كيف تنشئ مجموعة مسارات بـ prefix؟
5. ما هو Route Model Binding؟

---

## الدرس التالي

مستعد للمزيد؟ انتقل إلى **[الدرس 3: المتحكمات ونمط MVC](../lesson-03/README.md)**

في الدرس 3، ستتعلم:
- إنشاء Controllers
- تنظيم منطق التطبيق
- Resource Controllers
- Dependency Injection
- والمزيد!

---

**تعلم سعيد! 🚀**
