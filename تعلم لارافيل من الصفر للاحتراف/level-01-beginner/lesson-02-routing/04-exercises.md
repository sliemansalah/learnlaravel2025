# الدرس الثاني - التمارين: Routing في Laravel

## 📋 نظرة عامة

هذه التمارين مصممة لتطبيق ما تعلمته عن Routing في Laravel. تبدأ من المستوى السهل وتتدرج إلى المتقدم.

**الوقت المقدر**: 90-120 دقيقة

---

## 🎯 التمرين 1: Routes الأساسية (سهل)

### المطلوب:

أنشئ مشروع Laravel جديد واسمه `routing-practice`، ثم أضف Routes التالية:

1. صفحة رئيسية `/` تعرض "مرحباً بك في موقعي"
2. صفحة من نحن `/about` تعرض معلومات عن الموقع
3. صفحة اتصل بنا `/contact` تعرض نموذج تواصل
4. صفحة الخدمات `/services` تعرض قائمة الخدمات
5. route يعيد redirect من `/home` إلى `/`

### الحل المتوقع:

```php
// routes/web.php

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/services', function () {
    return view('services');
});

Route::redirect('/home', '/');
```

### اختبر نفسك:
- [ ] هل جميع الصفحات تعمل؟
- [ ] هل redirect من /home إلى / يعمل؟

---

## 🎯 التمرين 2: Route Parameters (متوسط)

### المطلوب:

أضف Routes التالية مع parameters:

1. `/users/{id}` - عرض معلومات مستخدم حسب id
2. `/posts/{id}` - عرض مقال حسب id
3. `/posts/{category}/{year?}` - عرض مقالات حسب التصنيف وسنة اختيارية
4. `/profile/{username}` - عرض ملف المستخدم (فقط حروف)
5. `/products/{id}` - عرض منتج (فقط أرقام)

### الحل المتوقع:

```php
Route::get('/users/{id}', function ($id) {
    return "عرض المستخدم رقم: $id";
})->whereNumber('id');

Route::get('/posts/{id}', function ($id) {
    return "عرض المقال رقم: $id";
})->whereNumber('id');

Route::get('/posts/{category}/{year?}', function ($category, $year = null) {
    if ($year) {
        return "مقالات $category لسنة $year";
    }
    return "جميع مقالات $category";
});

Route::get('/profile/{username}', function ($username) {
    return "ملف المستخدم: $username";
})->whereAlpha('username');

Route::get('/products/{id}', function ($id) {
    return "المنتج رقم: $id";
})->where('id', '[0-9]+');
```

### اختبر نفسك:
- [ ] هل `/users/abc` يعطي 404؟ (يجب أن يعطي)
- [ ] هل `/users/123` يعمل؟
- [ ] هل `/posts/tech` يعمل؟
- [ ] هل `/posts/tech/2024` يعمل؟
- [ ] هل `/profile/123` يعطي 404؟ (يجب أن يعطي)

---

## 🎯 التمرين 3: Named Routes (متوسط)

### المطلوب:

1. أنشئ Routes مسماة لـ:
   - الصفحة الرئيسية → `home`
   - صفحة المقالات → `posts.index`
   - عرض مقال منفرد → `posts.show`
   - إنشاء مقال → `posts.create`
   - حفظ مقال → `posts.store`

2. أنشئ route يعيد redirect إلى `posts.index`

3. في view، أنشئ روابط باستخدام named routes

### الحل المتوقع:

```php
// routes/web.php
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/posts', function () {
    return view('posts.index');
})->name('posts.index');

Route::get('/posts/{id}', function ($id) {
    return view('posts.show', ['id' => $id]);
})->name('posts.show');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::post('/posts', function () {
    // حفظ المقال
    return redirect()->route('posts.index');
})->name('posts.store');

Route::get('/blog', function () {
    return redirect()->route('posts.index');
});
```

```blade
<!-- resources/views/posts/index.blade.php -->
<ul>
    <li><a href="{{ route('home') }}">الرئيسية</a></li>
    <li><a href="{{ route('posts.index') }}">المقالات</a></li>
    <li><a href="{{ route('posts.create') }}">مقال جديد</a></li>
    <li><a href="{{ route('posts.show', 1) }}">عرض مقال 1</a></li>
</ul>
```

### اختبر نفسك:
- [ ] هل الروابط في Blade تعمل؟
- [ ] هل redirect يعمل؟
- [ ] استخدم `php artisan route:list` لعرض جميع Routes

---

## 🎯 التمرين 4: Route Groups (متقدم)

### المطلوب:

أنشئ نظام routes لمدونة كاملة مع:

1. **Public Routes** (بدون middleware):
   - الصفحة الرئيسية
   - قائمة المقالات
   - عرض مقال منفرد

2. **Admin Routes** (مع prefix `/admin` و middleware `auth`):
   - لوحة التحكم
   - إدارة المقالات (CRUD)
   - إدارة المستخدمين

3. جميع routes يجب أن تكون مسماة بشكل منظم

### الحل المتوقع:

```php
// routes/web.php

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', function () {
        return view('posts.index');
    })->name('index');

    Route::get('/{post}', function ($post) {
        return view('posts.show', ['post' => $post]);
    })->name('show');
});

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Posts Management
        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/', function () {
                return view('admin.posts.index');
            })->name('index');

            Route::get('/create', function () {
                return view('admin.posts.create');
            })->name('create');

            Route::post('/', function () {
                // حفظ
                return redirect()->route('admin.posts.index');
            })->name('store');

            Route::get('/{id}/edit', function ($id) {
                return view('admin.posts.edit', ['id' => $id]);
            })->name('edit');

            Route::put('/{id}', function ($id) {
                // تحديث
                return redirect()->route('admin.posts.index');
            })->name('update');

            Route::delete('/{id}', function ($id) {
                // حذف
                return redirect()->route('admin.posts.index');
            })->name('destroy');
        });

        // Users Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', function () {
                return view('admin.users.index');
            })->name('index');

            Route::get('/{id}', function ($id) {
                return view('admin.users.show', ['id' => $id]);
            })->name('show');
        });
    });
```

### اختبر نفسك:
- [ ] استخدم `php artisan route:list` وتحقق من الأسماء
- [ ] هل جميع admin routes محمية بـ auth middleware؟
- [ ] هل الـ prefix و name prefix يعملان بشكل صحيح؟

---

## 🎯 التمرين 5: API Routes (متقدم)

### المطلوب:

أنشئ API بسيط في `routes/api.php` يحتوي على:

1. **Posts API**:
   - GET `/api/posts` - قائمة المقالات (JSON)
   - GET `/api/posts/{id}` - مقال منفرد
   - POST `/api/posts` - إنشاء مقال
   - PUT `/api/posts/{id}` - تحديث مقال
   - DELETE `/api/posts/{id}` - حذف مقال

2. **Users API**:
   - GET `/api/users` - قائمة المستخدمين
   - GET `/api/users/{id}` - مستخدم منفرد

3. جميع responses يجب أن تكون JSON

### الحل المتوقع:

```php
// routes/api.php

// Posts API
Route::prefix('posts')->group(function () {
    Route::get('/', function () {
        $posts = [
            ['id' => 1, 'title' => 'مقال أول', 'body' => 'محتوى...'],
            ['id' => 2, 'title' => 'مقال ثاني', 'body' => 'محتوى...'],
        ];

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    });

    Route::get('/{id}', function ($id) {
        $post = ['id' => $id, 'title' => 'مقال', 'body' => 'محتوى...'];

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    })->whereNumber('id');

    Route::post('/', function () {
        $data = request()->all();

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء المقال',
            'data' => $data
        ], 201);
    });

    Route::put('/{id}', function ($id) {
        $data = request()->all();

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المقال',
            'data' => $data
        ]);
    })->whereNumber('id');

    Route::delete('/{id}', function ($id) {
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المقال'
        ]);
    })->whereNumber('id');
});

// Users API
Route::prefix('users')->group(function () {
    Route::get('/', function () {
        $users = [
            ['id' => 1, 'name' => 'أحمد', 'email' => 'ahmed@example.com'],
            ['id' => 2, 'name' => 'محمد', 'email' => 'mohamed@example.com'],
        ];

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    });

    Route::get('/{id}', function ($id) {
        $user = ['id' => $id, 'name' => 'أحمد', 'email' => 'ahmed@example.com'];

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    })->whereNumber('id');
});
```

### اختبر API باستخدام:

```bash
# GET posts
curl http://localhost:8000/api/posts

# GET single post
curl http://localhost:8000/api/posts/1

# POST create post
curl -X POST http://localhost:8000/api/posts \
  -H "Content-Type: application/json" \
  -d '{"title":"مقال جديد","body":"محتوى..."}'

# PUT update post
curl -X PUT http://localhost:8000/api/posts/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"مقال محدّث","body":"محتوى محدّث"}'

# DELETE post
curl -X DELETE http://localhost:8000/api/posts/1
```

### اختبر نفسك:
- [ ] هل جميع endpoints تعمل؟
- [ ] هل responses بصيغة JSON صحيحة؟
- [ ] هل status codes صحيحة (200, 201, إلخ)؟

---

## 🎯 التمرين 6: المشروع النهائي (متقدم جداً)

### المطلوب:

أنشئ نظام كامل لإدارة مكتبة إلكترونية يحتوي على:

### 1. Public Routes:

```php
/ → الصفحة الرئيسية
/books → قائمة الكتب
/books/{book} → عرض كتاب (استخدم slug)
/books/category/{category} → كتب حسب التصنيف
/authors → قائمة المؤلفين
/authors/{author} → ملف المؤلف + كتبه
/search?q=keyword → البحث
```

### 2. User Routes (مع auth):

```php
/my-books → كتبي المستعارة
/borrow/{book} → استعارة كتاب
/return/{book} → إرجاع كتاب
/profile → ملفي الشخصي
```

### 3. Admin Routes (prefix: /admin):

```php
/admin/dashboard → لوحة التحكم
/admin/books → إدارة الكتب (CRUD)
/admin/authors → إدارة المؤلفين (CRUD)
/admin/categories → إدارة التصنيفات (CRUD)
/admin/users → إدارة المستخدمين
/admin/borrowings → إدارة الاستعارات
```

### 4. API Routes (prefix: /api/v1):

```php
GET    /api/v1/books
GET    /api/v1/books/{id}
POST   /api/v1/books
PUT    /api/v1/books/{id}
DELETE /api/v1/books/{id}

GET    /api/v1/authors
GET    /api/v1/authors/{id}

GET    /api/v1/categories
```

### الحل المتوقع:

```php
// routes/web.php

use Illuminate\Support\Facades\Route;

// ============================================
// Public Routes
// ============================================

Route::get('/', function () {
    return view('home');
})->name('home');

// Books
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', function () {
        return view('books.index');
    })->name('index');

    Route::get('/category/{category}', function ($category) {
        return view('books.category', compact('category'));
    })->name('category');

    Route::get('/{book:slug}', function ($book) {
        return view('books.show', compact('book'));
    })->name('show');
});

// Authors
Route::prefix('authors')->name('authors.')->group(function () {
    Route::get('/', function () {
        return view('authors.index');
    })->name('index');

    Route::get('/{author}', function ($author) {
        return view('authors.show', compact('author'));
    })->name('show');
});

// Search
Route::get('/search', function () {
    $query = request('q');
    return view('search', compact('query'));
})->name('search');

// ============================================
// User Routes (Authenticated)
// ============================================

Route::middleware('auth')->group(function () {
    Route::get('/my-books', function () {
        return view('user.my-books');
    })->name('my-books');

    Route::post('/borrow/{book}', function ($book) {
        // منطق الاستعارة
        return redirect()->route('my-books')->with('success', 'تم استعارة الكتاب');
    })->name('borrow');

    Route::post('/return/{book}', function ($book) {
        // منطق الإرجاع
        return redirect()->route('my-books')->with('success', 'تم إرجاع الكتاب');
    })->name('return');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');
});

// ============================================
// Admin Routes
// ============================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Books Management
        Route::prefix('books')->name('books.')->group(function () {
            Route::get('/', function () {
                return view('admin.books.index');
            })->name('index');

            Route::get('/create', function () {
                return view('admin.books.create');
            })->name('create');

            Route::post('/', function () {
                return redirect()->route('admin.books.index')->with('success', 'تم إضافة الكتاب');
            })->name('store');

            Route::get('/{book}/edit', function ($book) {
                return view('admin.books.edit', compact('book'));
            })->name('edit');

            Route::put('/{book}', function ($book) {
                return redirect()->route('admin.books.index')->with('success', 'تم تحديث الكتاب');
            })->name('update');

            Route::delete('/{book}', function ($book) {
                return redirect()->route('admin.books.index')->with('success', 'تم حذف الكتاب');
            })->name('destroy');
        });

        // Authors Management
        Route::resource('authors', Admin\AuthorController::class)->except(['show']);

        // Categories Management
        Route::resource('categories', Admin\CategoryController::class)->except(['show']);

        // Users Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', function () {
                return view('admin.users.index');
            })->name('index');

            Route::get('/{user}', function ($user) {
                return view('admin.users.show', compact('user'));
            })->name('show');
        });

        // Borrowings Management
        Route::get('/borrowings', function () {
            return view('admin.borrowings.index');
        })->name('borrowings.index');
    });
```

```php
// routes/api.php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.')->group(function () {

    // Books API
    Route::apiResource('books', Api\BookController::class);

    // Authors API
    Route::apiResource('authors', Api\AuthorController::class)->only(['index', 'show']);

    // Categories API
    Route::get('/categories', function () {
        $categories = [
            ['id' => 1, 'name' => 'برمجة', 'slug' => 'programming'],
            ['id' => 2, 'name' => 'تصميم', 'slug' => 'design'],
        ];

        return response()->json(['data' => $categories]);
    })->name('categories.index');

    // Authenticated API Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/books/{book}/borrow', function ($book) {
            return response()->json(['message' => 'تم استعارة الكتاب']);
        });

        Route::post('/books/{book}/return', function ($book) {
            return response()->json(['message' => 'تم إرجاع الكتاب']);
        });
    });
});
```

### اختبر المشروع:

```bash
# عرض جميع Routes
php artisan route:list

# تصفية routes معينة
php artisan route:list --name=admin
php artisan route:list --path=api

# عرض routes مع middleware
php artisan route:list --columns=uri,name,method,middleware
```

### المتطلبات الإضافية:

1. جميع routes يجب أن تكون مسماة بشكل منطقي
2. استخدم Route Groups بشكل فعّال
3. استخدم Middleware بشكل صحيح
4. admin routes يجب أن تبدأ بـ `/admin`
5. API routes يجب أن تبدأ بـ `/api/v1`
6. استخدم Route Model Binding حيثما أمكن

---

## ✅ Checklist النهائي

بعد إكمال جميع التمارين، تأكد من:

- [ ] جميع routes تعمل بشكل صحيح
- [ ] استخدمت Named Routes في كل مكان
- [ ] استخدمت Route Groups للتنظيم
- [ ] طبقت Middleware بشكل صحيح
- [ ] استخدمت Route Parameters بأنواعها
- [ ] استخدمت Regular Expression Constraints
- [ ] API routes تُرجع JSON
- [ ] استخدمت `php artisan route:list` للتحقق
- [ ] الكود منظم وسهل القراءة

---

## 🎯 التحدي الإضافي

إذا أكملت جميع التمارين بنجاح، جرّب هذا التحدي:

### أضف ميزات متقدمة:

1. **Rate Limiting**: حدد عدد الطلبات للـ API
2. **Signed URLs**: للتحقق من الروابط الآمنة
3. **Subdomain Routing**: routes لـ subdomains مختلفة
4. **Fallback Route**: صفحة 404 مخصصة
5. **Route Caching**: اختبر performance مع route cache

---

## 📚 مصادر للمساعدة

- [Laravel Routing Docs](https://laravel.com/docs/routing)
- [Laravel Route Groups](https://laravel.com/docs/routing#route-groups)
- [Route Model Binding](https://laravel.com/docs/routing#route-model-binding)

---

**بالتوفيق في التمارين!** 🚀
