# الدرس 2 - بطاقة مرجعية سريعة

## 🚀 أنواع المسارات HTTP

```php
// GET - قراءة البيانات
Route::get('/users', function () { });

// POST - إنشاء جديد
Route::post('/users', function () { });

// PUT - تحديث كامل
Route::put('/users/{id}', function ($id) { });

// PATCH - تحديث جزئي
Route::patch('/users/{id}', function ($id) { });

// DELETE - حذف
Route::delete('/users/{id}', function ($id) { });

// عدة Methods
Route::match(['get', 'post'], '/form', function () { });
Route::any('/test', function () { });
```

---

## 📌 معاملات المسار

```php
// إلزامي
Route::get('/user/{id}', function ($id) { });

// اختياري
Route::get('/user/{name?}', function ($name = 'ضيف') { });

// مع قيود
Route::get('/user/{id}', function ($id) { })
    ->where('id', '[0-9]+');

// عدة قيود
Route::get('/user/{id}/{name}', function ($id, $name) { })
    ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

---

## 🏷️ المسارات المسماة

```php
// تعريف
Route::get('/profile', function () { })
    ->name('profile');

// الاستخدام في Blade
<a href="{{ route('profile') }}">الملف الشخصي</a>
<a href="{{ route('user.show', ['id' => 1]) }}">المستخدم</a>

// Redirect
return redirect()->route('dashboard');
return redirect()->route('user.show', ['id' => $id]);
```

---

## 📦 مجموعات المسارات

```php
// Prefix
Route::prefix('admin')->group(function () {
    Route::get('/users', function () { });  // /admin/users
});

// Middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { });
});

// Name prefix
Route::name('admin.')->group(function () {
    Route::get('/dashboard', function () { })
        ->name('dashboard');  // admin.dashboard
});

// دمج كل الخصائص
Route::prefix('admin')
     ->middleware(['auth'])
     ->name('admin.')
     ->group(function () {
         Route::get('/dashboard', function () { })
             ->name('dashboard');
     });
```

---

## 🔗 Route Model Binding

```php
use App\Models\User;

// Implicit Binding
Route::get('/user/{user}', function (User $user) {
    return $user->name;
});

// مع custom key
Route::get('/post/{post:slug}', function (Post $post) {
    return $post;
});

// في Model
public function getRouteKeyName()
{
    return 'slug';
}
```

---

## ↩️ إعادة التوجيه

```php
// بسيط
return redirect('/new-page');

// إلى مسار مسمى
return redirect()->route('dashboard');

// دائم (301)
Route::redirect('/old', '/new', 301);

// للخلف
return back();

// مع بيانات
return redirect()->route('home')
                 ->with('success', 'نجح!');
```

---

## 📋 أوامر مفيدة

```bash
# عرض جميع المسارات
php artisan route:list

# مسارات معينة
php artisan route:list --path=api

# بحث بالاسم
php artisan route:list --name=user

# مع middleware
php artisan route:list --middleware=auth

# تفصيلي
php artisan route:list -v
```

---

## 🎯 نمط CRUD Routes

```php
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
```

---

## ⚡ Global Constraints

في `RouteServiceProvider.php`:

```php
public function boot(): void
{
    Route::pattern('id', '[0-9]+');
    Route::pattern('slug', '[a-z0-9-]+');
}
```

---

## 💡 أفضل الممارسات

✅ **استخدم المسارات المسماة**
✅ **نظم المسارات في مجموعات**
✅ **استخدم Model Binding**
✅ **ضع قيود على المعاملات**
✅ **لا تضع logic في routes**

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [الدرس التالي](../lesson-03/README.md)
