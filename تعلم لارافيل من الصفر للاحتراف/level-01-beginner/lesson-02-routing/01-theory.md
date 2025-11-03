# 🚀 الدرس الثاني: Routing الأساسي في Laravel

## 📋 نظرة عامة

في هذا الدرس سنتعلم أحد أهم المفاهيم في Laravel وهو **Routing** (التوجيه). الـ Routing هو الآلية التي تحدد كيفية استجابة تطبيقك للطلبات القادمة من المستخدمين.

### 🎯 أهداف الدرس

بنهاية هذا الدرس ستكون قادراً على:
- ✅ فهم مفهوم Routing وأهميته
- ✅ إنشاء Routes بأنواعها المختلفة
- ✅ استخدام Route Parameters
- ✅ إنشاء Named Routes
- ✅ استخدام Route Groups
- ✅ فهم HTTP Methods المختلفة
- ✅ إنشاء Routes للـ API

---

## 📚 الجزء الأول: ما هو Routing؟

### 1.1 تعريف Routing

**Routing** هو عملية تحديد المسارات (URLs) التي يستجيب لها تطبيقك وكيفية معالجة الطلبات القادمة على هذه المسارات.

#### مثال بسيط من الحياة:
```
تخيل الـ Router كأنه موظف الاستقبال في فندق:
- عندما يأتي زائر (Request) ويطلب الذهاب للغرفة 101
- الموظف يوجهه (Route) للمكان الصحيح
- ويخبره بما يجب فعله هناك (Controller/Action)
```

### 1.2 أين توجد ملفات Routing؟

في Laravel، ملفات Routing توجد في مجلد `routes/`:

```
routes/
├── web.php      // Routes الخاصة بالمتصفح (Sessions, CSRF)
├── api.php      // Routes الخاصة بـ API (Stateless)
├── console.php  // Routes للـ Artisan Commands
└── channels.php // Routes للـ Broadcasting
```

**الأكثر استخداماً:**
- `web.php` → للصفحات التقليدية
- `api.php` → لـ RESTful APIs

---

## 🌐 الجزء الثاني: HTTP Methods

### 2.1 ما هي HTTP Methods؟

HTTP Methods (أو HTTP Verbs) هي الطرق التي يستخدمها المتصفح للتواصل مع السيرفر:

| Method | الاستخدام | مثال من الحياة |
|--------|-----------|----------------|
| **GET** | جلب البيانات | فتح صفحة، قراءة مقال |
| **POST** | إرسال بيانات جديدة | إرسال نموذج، التسجيل |
| **PUT/PATCH** | تحديث بيانات موجودة | تعديل ملف شخصي |
| **DELETE** | حذف بيانات | حذف حساب، مسح منشور |

### 2.2 أمثلة عملية

```php
// GET - لعرض قائمة المستخدمين
Route::get('/users', function() {
    return "قائمة المستخدمين";
});

// POST - لإنشاء مستخدم جديد
Route::post('/users', function() {
    return "تم إنشاء مستخدم جديد";
});

// PUT - لتحديث مستخدم موجود
Route::put('/users/{id}', function($id) {
    return "تم تحديث المستخدم رقم $id";
});

// DELETE - لحذف مستخدم
Route::delete('/users/{id}', function($id) {
    return "تم حذف المستخدم رقم $id";
});
```

### 2.3 Route::match و Route::any

```php
// استجابة لعدة Methods محددة
Route::match(['get', 'post'], '/profile', function() {
    return "الملف الشخصي";
});

// استجابة لجميع Methods
Route::any('/contact', function() {
    return "صفحة التواصل";
});
```

---

## 🎯 الجزء الثالث: Route Parameters

### 3.1 Required Parameters (معاملات إلزامية)

```php
// معامل واحد
Route::get('/user/{id}', function($id) {
    return "عرض المستخدم رقم: " . $id;
});

// عدة معاملات
Route::get('/posts/{post}/comments/{comment}', function($post, $comment) {
    return "المنشور $post - التعليق $comment";
});
```

**مثال عملي:**
```
URL: http://localhost:8000/user/42
النتيجة: "عرض المستخدم رقم: 42"
```

### 3.2 Optional Parameters (معاملات اختيارية)

```php
// معامل اختياري مع قيمة افتراضية
Route::get('/greeting/{name?}', function($name = 'ضيف') {
    return "مرحباً، " . $name;
});
```

**أمثلة:**
```
/greeting/أحمد  →  "مرحباً، أحمد"
/greeting       →  "مرحباً، ضيف"
```

### 3.3 Regular Expression Constraints

يمكنك تحديد نمط معين للمعامل:

```php
// قبول الأرقام فقط
Route::get('/user/{id}', function($id) {
    return "المستخدم: $id";
})->where('id', '[0-9]+');

// قبول الحروف فقط
Route::get('/user/{name}', function($name) {
    return "المستخدم: $name";
})->where('name', '[A-Za-z]+');

// عدة قيود
Route::get('/user/{id}/{name}', function($id, $name) {
    return "رقم $id - اسم $name";
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

### 3.4 Global Constraints

تحديد قيود عامة في `RouteServiceProvider`:

```php
// في app/Providers/RouteServiceProvider.php
public function boot()
{
    Route::pattern('id', '[0-9]+');
    Route::pattern('slug', '[a-z0-9-]+');

    parent::boot();
}
```

الآن جميع `{id}` و `{slug}` سيتبعون هذه القيود تلقائياً.

---

## 🏷️ الجزء الرابع: Named Routes

### 4.1 لماذا Named Routes؟

بدلاً من كتابة `/user/profile` في كل مكان، يمكنك تسمية الـ route واستخدام الاسم.

**الفوائد:**
- ✅ سهولة التعديل (تغيير URL في مكان واحد)
- ✅ قراءة أفضل للكود
- ✅ تجنب الأخطاء الإملائية

### 4.2 إنشاء Named Route

```php
// تسمية route
Route::get('/user/profile', function() {
    return "الملف الشخصي";
})->name('profile');

// مع controller
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
```

### 4.3 استخدام Named Routes

```php
// في Blade Templates
<a href="{{ route('profile') }}">الملف الشخصي</a>

// توليد URL
$url = route('profile');

// Redirect
return redirect()->route('profile');

// مع معاملات
Route::get('/user/{id}', [UserController::class, 'show'])
    ->name('user.show');

// استخدام
<a href="{{ route('user.show', ['id' => 1]) }}">المستخدم 1</a>
// أو
<a href="{{ route('user.show', 1) }}">المستخدم 1</a>
```

### 4.4 التحقق من Route الحالي

```php
// في Blade
@if(Route::currentRouteName() === 'profile')
    <li class="active">الملف الشخصي</li>
@endif

// أو
@if(Route::is('user.*'))
    <!-- أي route يبدأ بـ user. -->
@endif
```

---

## 📁 الجزء الخامس: Route Groups

### 5.1 ما هي Route Groups؟

تجميع عدة routes تشترك في خصائص معينة (Middleware, Prefix, Namespace, etc.)

### 5.2 Prefix (البادئة)

```php
// بدلاً من:
Route::get('/admin/users', function() {});
Route::get('/admin/posts', function() {});
Route::get('/admin/comments', function() {});

// استخدم Group:
Route::prefix('admin')->group(function() {
    Route::get('/users', function() {});     // /admin/users
    Route::get('/posts', function() {});     // /admin/posts
    Route::get('/comments', function() {}); // /admin/comments
});
```

### 5.3 Name Prefix (بادئة الأسماء)

```php
Route::name('admin.')->group(function() {
    Route::get('/users', function() {})->name('users');     // admin.users
    Route::get('/posts', function() {})->name('posts');     // admin.posts
    Route::get('/settings', function() {})->name('settings'); // admin.settings
});
```

### 5.4 Middleware Group

```php
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', function() {});
    Route::get('/profile', function() {});
    Route::get('/settings', function() {});
});
```

### 5.5 دمج عدة خصائص

```php
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/posts', [PostController::class, 'index'])
            ->name('posts.index');
    });

// الآن:
// URL: /admin/users
// Route Name: admin.users.index
// Middleware: auth, admin
```

---

## 🔀 الجزء السادس: Route Redirect

### 6.1 Redirect بسيط

```php
// إعادة توجيه من URL لآخر
Route::redirect('/here', '/there');

// مع status code
Route::redirect('/here', '/there', 301); // Permanent redirect
```

### 6.2 Permanent Redirect

```php
Route::permanentRedirect('/old-page', '/new-page');
// مساوي لـ:
Route::redirect('/old-page', '/new-page', 301);
```

---

## 👁️ الجزء السابع: View Routes

عرض View مباشرة بدون controller:

```php
// عرض view مباشرة
Route::view('/welcome', 'welcome');

// مع بيانات
Route::view('/about', 'about', ['name' => 'Laravel']);
```

**متى نستخدمها؟**
- صفحات ثابتة (من نحن، الشروط والأحكام، إلخ)
- لا تحتاج منطق معقد

---

## 🎨 الجزء الثامن: Fallback Routes

### 8.1 معالجة 404

```php
// في نهاية ملف routes/web.php
Route::fallback(function() {
    return view('errors.404');
});
```

هذا الـ route يُستدعى إذا لم يطابق أي route آخر.

---

## 🔧 الجزء التاسع: Route Model Binding

### 9.1 Implicit Binding

Laravel تلقائياً تبحث عن Model بناءً على المعامل:

```php
// تلقائياً يبحث عن User بـ id
Route::get('/users/{user}', function(User $user) {
    return $user->name;
});
```

**كيف يعمل؟**
```
/users/1  →  يبحث عن User::find(1)
/users/5  →  يبحث عن User::find(5)
إذا لم يجد → 404 تلقائياً
```

### 9.2 Customizing the Key

```php
// استخدام slug بدلاً من id
Route::get('/posts/{post:slug}', function(Post $post) {
    return $post->title;
});

// الآن: /posts/my-first-post
```

### 9.3 Explicit Binding

في `RouteServiceProvider`:

```php
public function boot()
{
    Route::model('user', User::class);

    // أو مع custom logic
    Route::bind('user', function($value) {
        return User::where('username', $value)->firstOrFail();
    });
}
```

---

## 📊 الجزء العاشر: Rate Limiting

تحديد عدد الطلبات المسموح بها:

```php
// 60 طلب في الدقيقة
Route::middleware('throttle:60,1')->group(function() {
    Route::get('/api/users', function() {});
});

// تسمية Rate Limiter مخصص
Route::middleware('throttle:api')->group(function() {
    // ...
});
```

تعريف Custom Rate Limiter في `RouteServiceProvider`:

```php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});
```

---

## 🌐 الجزء الحادي عشر: API Routes

### 11.1 الفرق بين web.php و api.php

| الخاصية | web.php | api.php |
|---------|---------|---------|
| **Prefix** | / | /api |
| **Middleware** | web (sessions, CSRF) | api (stateless) |
| **الاستخدام** | تطبيقات ويب تقليدية | RESTful APIs |

### 11.2 مثال API Route

```php
// في routes/api.php
Route::get('/users', function() {
    return User::all();
});

// الوصول: http://localhost:8000/api/users
```

### 11.3 API Resource Routes

```php
Route::apiResource('posts', PostController::class);
```

يُنشئ:
```
GET    /api/posts          → index
POST   /api/posts          → store
GET    /api/posts/{id}     → show
PUT    /api/posts/{id}     → update
DELETE /api/posts/{id}     → destroy
```

---

## 🛠️ الجزء الثاني عشر: Useful Artisan Commands

```bash
# عرض جميع Routes
php artisan route:list

# تصفية Routes
php artisan route:list --path=api
php artisan route:list --name=user

# عرض route معين
php artisan route:list --name=users.show

# cache الـ routes (للإنتاج فقط)
php artisan route:cache

# مسح cache الـ routes
php artisan route:clear
```

---

## 📝 أفضل الممارسات (Best Practices)

### 1. استخدم Named Routes دائماً

```php
// ❌ سيء
<a href="/user/profile">Profile</a>
return redirect('/dashboard');

// ✅ جيد
<a href="{{ route('profile') }}">Profile</a>
return redirect()->route('dashboard');
```

### 2. استخدم Resource Routes للـ CRUD

```php
// ❌ سيء - كتابة كل route يدوياً
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
// ...

// ✅ جيد
Route::resource('posts', PostController::class);
```

### 3. استخدم Route Groups للتنظيم

```php
// ✅ جيد
Route::middleware('auth')->group(function() {
    Route::prefix('admin')->name('admin.')->group(function() {
        // Admin routes
    });
});
```

### 4. استخدم Route Model Binding

```php
// ❌ سيء
Route::get('/users/{id}', function($id) {
    $user = User::findOrFail($id);
    return $user->name;
});

// ✅ جيد
Route::get('/users/{user}', function(User $user) {
    return $user->name;
});
```

### 5. ضع قيود على Parameters

```php
// ✅ جيد
Route::get('/users/{id}', ...)
    ->where('id', '[0-9]+');
```

---

## 🎯 ملخص الدرس

في هذا الدرس تعلمنا:

1. ✅ **مفهوم Routing** - تحديد المسارات والاستجابة للطلبات
2. ✅ **HTTP Methods** - GET, POST, PUT, DELETE
3. ✅ **Route Parameters** - إلزامية واختيارية
4. ✅ **Named Routes** - تسهيل الإشارة للـ routes
5. ✅ **Route Groups** - تنظيم Routes متشابهة
6. ✅ **Route Model Binding** - ربط تلقائي بالـ Models
7. ✅ **API Routes** - بناء RESTful APIs
8. ✅ **Best Practices** - أفضل الممارسات

---

## 📚 مصادر إضافية

- [Laravel Routing Documentation](https://laravel.com/docs/routing)
- [RESTful API Design](https://restfulapi.net/)
- [HTTP Status Codes](https://httpstatuses.com/)

---

## ⏭️ الخطوة التالية

في الدرس القادم سنتعلم عن **Controllers** وكيفية فصل منطق التطبيق عن Routes.

---

**🎓 تم بواسطة:** Laravel Learning System
**📅 التاريخ:** 2025-11-03
**📖 المستوى:** Beginner - Level 01
**📝 الدرس:** 02 - Routing
