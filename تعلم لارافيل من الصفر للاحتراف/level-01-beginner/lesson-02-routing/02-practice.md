# 💻 الدرس الثاني: Routing - الجزء العملي

## 🎯 نظرة عامة

في هذا الجزء العملي سنطبق ما تعلمناه عن Routing من خلال أمثلة عملية وتمارين تطبيقية.

---

## 🚀 المشروع العملي: نظام إدارة مدونة بسيط

سنبني routes لنظام مدونة يحتوي على:
- الصفحة الرئيسية
- قائمة المقالات
- عرض مقال منفرد
- إنشاء مقال جديد
- تعديل مقال
- حذف مقال
- صفحة من نحن
- صفحة التواصل

---

## 📝 الخطوة 1: Routes الأساسية

### 1.1 إنشاء مشروع Laravel جديد (اختياري)

```bash
# إنشاء مشروع جديد
composer create-project laravel/laravel blog-routing

# الدخول للمشروع
cd blog-routing

# تشغيل السيرفر
php artisan serve
```

### 1.2 الصفحة الرئيسية

في `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// أو يمكن استخدام Route::view
Route::view('/', 'welcome');
```

### 1.3 صفحات ثابتة

```php
// صفحة "من نحن"
Route::get('/about', function () {
    return view('about');
});

// صفحة "التواصل"
Route::get('/contact', function () {
    return view('contact');
});

// أو باستخدام Route::view
Route::view('/about', 'about');
Route::view('/contact', 'contact');
```

---

## 📄 الخطوة 2: Routes المقالات (Posts)

### 2.1 عرض جميع المقالات

```php
// قائمة المقالات
Route::get('/posts', function () {
    $posts = [
        ['id' => 1, 'title' => 'مقدمة في Laravel', 'author' => 'أحمد'],
        ['id' => 2, 'title' => 'تعلم Routing', 'author' => 'محمد'],
        ['id' => 3, 'title' => 'Controllers في Laravel', 'author' => 'فاطمة'],
    ];

    return view('posts.index', ['posts' => $posts]);
})->name('posts.index');
```

### 2.2 عرض مقال واحد (مع Route Parameter)

```php
// عرض مقال واحد
Route::get('/posts/{id}', function ($id) {
    $posts = [
        1 => ['id' => 1, 'title' => 'مقدمة في Laravel', 'content' => 'محتوى المقال الأول...'],
        2 => ['id' => 2, 'title' => 'تعلم Routing', 'content' => 'محتوى المقال الثاني...'],
        3 => ['id' => 3, 'title' => 'Controllers في Laravel', 'content' => 'محتوى المقال الثالث...'],
    ];

    if (!isset($posts[$id])) {
        abort(404, 'المقال غير موجود');
    }

    return view('posts.show', ['post' => $posts[$id]]);
})->where('id', '[0-9]+')->name('posts.show');
```

### 2.3 صفحة إنشاء مقال جديد

```php
// عرض نموذج إنشاء مقال
Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

// حفظ المقال الجديد
Route::post('/posts', function () {
    // هنا سيتم حفظ البيانات لاحقاً
    return redirect()->route('posts.index')
        ->with('success', 'تم إنشاء المقال بنجاح!');
})->name('posts.store');
```

⚠️ **ملاحظة مهمة:** `/posts/create` يجب أن يكون **قبل** `/posts/{id}` لتجنب اعتباره id!

```php
// ✅ صحيح
Route::get('/posts/create', ...);
Route::get('/posts/{id}', ...);

// ❌ خطأ
Route::get('/posts/{id}', ...);
Route::get('/posts/create', ...); // سيعتبر "create" كـ id!
```

### 2.4 تعديل مقال

```php
// عرض نموذج التعديل
Route::get('/posts/{id}/edit', function ($id) {
    $post = ['id' => $id, 'title' => 'عنوان المقال', 'content' => 'المحتوى...'];
    return view('posts.edit', ['post' => $post]);
})->where('id', '[0-9]+')->name('posts.edit');

// تحديث المقال
Route::put('/posts/{id}', function ($id) {
    return redirect()->route('posts.show', $id)
        ->with('success', 'تم تحديث المقال بنجاح!');
})->where('id', '[0-9]+')->name('posts.update');
```

### 2.5 حذف مقال

```php
// حذف مقال
Route::delete('/posts/{id}', function ($id) {
    return redirect()->route('posts.index')
        ->with('success', 'تم حذف المقال بنجاح!');
})->where('id', '[0-9]+')->name('posts.destroy');
```

---

## 🎨 الخطوة 3: استخدام Route Groups

### 3.1 تجميع Routes المقالات

بدلاً من تكرار الأمور، نستخدم Group:

```php
// تجميع routes المقالات
Route::prefix('posts')->name('posts.')->group(function () {

    // GET /posts - posts.index
    Route::get('/', function () {
        $posts = [
            ['id' => 1, 'title' => 'مقدمة في Laravel'],
            ['id' => 2, 'title' => 'تعلم Routing'],
        ];
        return view('posts.index', ['posts' => $posts]);
    })->name('index');

    // GET /posts/create - posts.create
    Route::get('/create', function () {
        return view('posts.create');
    })->name('create');

    // POST /posts - posts.store
    Route::post('/', function () {
        return redirect()->route('posts.index');
    })->name('store');

    // GET /posts/{id} - posts.show
    Route::get('/{id}', function ($id) {
        return view('posts.show', ['id' => $id]);
    })->where('id', '[0-9]+')->name('show');

    // GET /posts/{id}/edit - posts.edit
    Route::get('/{id}/edit', function ($id) {
        return view('posts.edit', ['id' => $id]);
    })->where('id', '[0-9]+')->name('edit');

    // PUT /posts/{id} - posts.update
    Route::put('/{id}', function ($id) {
        return redirect()->route('posts.show', $id);
    })->where('id', '[0-9]+')->name('update');

    // DELETE /posts/{id} - posts.destroy
    Route::delete('/{id}', function ($id) {
        return redirect()->route('posts.index');
    })->where('id', '[0-9]+')->name('destroy');
});
```

---

## 👤 الخطوة 4: Routes المستخدمين

### 4.1 ملف شخصي بمعامل اختياري

```php
// الملف الشخصي - يقبل username اختياري
Route::get('/profile/{username?}', function ($username = null) {
    if ($username) {
        return "الملف الشخصي للمستخدم: {$username}";
    } else {
        return "ملفك الشخصي";
    }
})->name('profile');
```

**الاستخدام:**
```
/profile          → "ملفك الشخصي"
/profile/ahmed    → "الملف الشخصي للمستخدم: ahmed"
```

### 4.2 بحث عن مستخدم

```php
// البحث عن مستخدم
Route::get('/users/{username}', function ($username) {
    return "البحث عن: {$username}";
})->where('username', '[a-zA-Z0-9_]+')->name('users.show');
```

---

## 🔐 الخطوة 5: Routes الإدارة (Admin)

```php
// لوحة التحكم - مع middleware (سنتعلمها لاحقاً)
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    Route::get('/posts', function () {
        return view('admin.posts');
    })->name('posts');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});
```

**النتائج:**
```
/admin/dashboard  → admin.dashboard
/admin/users      → admin.users
/admin/posts      → admin.posts
/admin/settings   → admin.settings
```

---

## 🌐 الخطوة 6: API Routes

في `routes/api.php`:

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API لجلب جميع المقالات
Route::get('/posts', function () {
    return response()->json([
        'data' => [
            ['id' => 1, 'title' => 'مقدمة في Laravel'],
            ['id' => 2, 'title' => 'تعلم Routing'],
        ]
    ]);
});

// API لجلب مقال واحد
Route::get('/posts/{id}', function ($id) {
    return response()->json([
        'data' => [
            'id' => $id,
            'title' => 'عنوان المقال',
            'content' => 'محتوى المقال...'
        ]
    ]);
})->where('id', '[0-9]+');

// API لإنشاء مقال
Route::post('/posts', function (Request $request) {
    return response()->json([
        'message' => 'تم إنشاء المقال بنجاح',
        'data' => $request->all()
    ], 201);
});
```

**الوصول:**
```
GET  http://localhost:8000/api/posts
GET  http://localhost:8000/api/posts/1
POST http://localhost:8000/api/posts
```

---

## 🔄 الخطوة 7: Redirects

```php
// إعادة توجيه من صفحة قديمة
Route::redirect('/old-about', '/about', 301);

// إعادة توجيه دائمة
Route::permanentRedirect('/home', '/');

// إعادة توجيه لـ route مسمى
Route::get('/go-to-posts', function () {
    return redirect()->route('posts.index');
});
```

---

## 🎨 الخطوة 8: إنشاء Views

### 8.1 `resources/views/posts/index.blade.php`

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة المقالات</title>
</head>
<body>
    <h1>قائمة المقالات</h1>

    <a href="{{ route('posts.create') }}">إنشاء مقال جديد</a>

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post['id']) }}">
                    {{ $post['title'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ url('/') }}">العودة للرئيسية</a>
</body>
</html>
```

### 8.2 `resources/views/posts/show.blade.php`

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عرض المقال</title>
</head>
<body>
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

    <a href="{{ route('posts.edit', $post['id']) }}">تعديل</a>

    <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">حذف</button>
    </form>

    <br><br>
    <a href="{{ route('posts.index') }}">العودة للقائمة</a>
</body>
</html>
```

---

## 🧪 الخطوة 9: اختبار Routes

### 9.1 عرض جميع Routes

```bash
php artisan route:list
```

**النتيجة:**
```
+--------+----------+-------------------+---------------+
| Method | URI      | Name              | Action        |
+--------+----------+-------------------+---------------+
| GET    | /        |                   | Closure       |
| GET    | posts    | posts.index       | Closure       |
| GET    | posts/create | posts.create  | Closure       |
| POST   | posts    | posts.store       | Closure       |
| GET    | posts/{id} | posts.show      | Closure       |
| GET    | posts/{id}/edit | posts.edit | Closure       |
| PUT    | posts/{id} | posts.update    | Closure       |
| DELETE | posts/{id} | posts.destroy   | Closure       |
+--------+----------+-------------------+---------------+
```

### 9.2 اختبار في المتصفح

```
http://localhost:8000/
http://localhost:8000/posts
http://localhost:8000/posts/1
http://localhost:8000/posts/create
```

---

## 📚 تمرين عملي شامل

### المطلوب:
أنشئ routes لنظام مكتبة بسيط يحتوي على:

1. **الصفحة الرئيسية** (`/`)
2. **قائمة الكتب** (`/books`)
3. **عرض كتاب** (`/books/{id}`)
4. **إنشاء كتاب** (`/books/create`)
5. **تعديل كتاب** (`/books/{id}/edit`)
6. **حذف كتاب** (`DELETE /books/{id}`)
7. **بحث عن كتاب** (`/books/search/{keyword?}`)
8. **كتب حسب المؤلف** (`/authors/{author}/books`)

### الحل المقترح:

```php
<?php

use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('home');
})->name('home');

// Routes الكتب
Route::prefix('books')->name('books.')->group(function () {

    // قائمة الكتب
    Route::get('/', function () {
        $books = [
            ['id' => 1, 'title' => 'تعلم Laravel', 'author' => 'أحمد'],
            ['id' => 2, 'title' => 'PHP المتقدمة', 'author' => 'محمد'],
        ];
        return view('books.index', compact('books'));
    })->name('index');

    // بحث
    Route::get('/search/{keyword?}', function ($keyword = null) {
        return view('books.search', compact('keyword'));
    })->name('search');

    // إنشاء
    Route::get('/create', function () {
        return view('books.create');
    })->name('create');

    Route::post('/', function () {
        return redirect()->route('books.index');
    })->name('store');

    // عرض
    Route::get('/{id}', function ($id) {
        $book = ['id' => $id, 'title' => 'عنوان الكتاب'];
        return view('books.show', compact('book'));
    })->where('id', '[0-9]+')->name('show');

    // تعديل
    Route::get('/{id}/edit', function ($id) {
        $book = ['id' => $id, 'title' => 'عنوان الكتاب'];
        return view('books.edit', compact('book'));
    })->where('id', '[0-9]+')->name('edit');

    Route::put('/{id}', function ($id) {
        return redirect()->route('books.show', $id);
    })->where('id', '[0-9]+')->name('update');

    // حذف
    Route::delete('/{id}', function ($id) {
        return redirect()->route('books.index');
    })->where('id', '[0-9]+')->name('destroy');
});

// كتب حسب المؤلف
Route::get('/authors/{author}/books', function ($author) {
    return view('authors.books', compact('author'));
})->name('authors.books');
```

---

## ✅ نقاط مهمة يجب تذكرها

1. ✅ **الترتيب مهم**: Routes الأكثر تحديداً قبل العامة
   ```php
   Route::get('/posts/create', ...);  // أولاً
   Route::get('/posts/{id}', ...);    // ثانياً
   ```

2. ✅ **استخدم Named Routes**: للمرونة
   ```php
   route('posts.show', 1)  // أفضل من '/posts/1'
   ```

3. ✅ **ضع قيود على Parameters**: للأمان
   ```php
   ->where('id', '[0-9]+')
   ```

4. ✅ **استخدم Groups**: للتنظيم
   ```php
   Route::prefix('admin')->name('admin.')->group(...)
   ```

5. ✅ **اختبر Routes**: قبل الانتقال للخطوة التالية
   ```bash
   php artisan route:list
   ```

---

## 🎯 الخطوة القادمة

الآن بعد إتقان Routing، في الدرس القادم سنتعلم **Controllers** وكيفية نقل المنطق من Routes إلى Controllers منظمة.

---

**💡 نصيحة:** احفظ ملف `routes/web.php` كمرجع، وحاول إعادة كتابته من الذاكرة لتثبيت المعلومات!

---

**🎓 تم بواسطة:** Laravel Learning System
**📅 التاريخ:** 2025-11-03
