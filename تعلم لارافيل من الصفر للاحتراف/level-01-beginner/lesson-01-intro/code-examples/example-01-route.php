<?php
/**
 * ==============================================
 * مثال 1: Routes البسيطة في Laravel
 * Example 1: Simple Routes in Laravel
 * ==============================================
 *
 * الغرض من هذا المثال:
 * - فهم كيفية إنشاء routes بسيطة
 * - التعرف على أنواع HTTP Methods
 * - استخدام Route Parameters
 *
 * المكان المناسب لهذا الكود:
 * routes/web.php
 * ==============================================
 */

use Illuminate\Support\Facades\Route;

// ==================================================
// القسم 1: Routes البسيطة
// Section 1: Basic Routes
// ==================================================

/**
 * مثال 1: أبسط route ممكن
 * يعرض نص بسيط عند زيارة الصفحة الرئيسية
 */
Route::get('/', function () {
    return 'مرحباً بك في Laravel!';
});

/**
 * مثال 2: route يعرض HTML
 * يمكنك إرجاع HTML مباشرة
 */
Route::get('/hello', function () {
    return '<h1>مرحباً!</h1><p>هذا أول تطبيق Laravel لي</p>';
});

/**
 * مثال 3: route يعرض JSON
 * مفيد جداً عند بناء APIs
 */
Route::get('/api/user', function () {
    return [
        'name' => 'أحمد محمد',
        'email' => 'ahmed@example.com',
        'age' => 25
    ];
});

// ==================================================
// القسم 2: Route Parameters
// Section 2: Route Parameters
// ==================================================

/**
 * مثال 4: route مع parameter واحد
 * جرّب: http://localhost:8000/user/ahmed
 */
Route::get('/user/{name}', function ($name) {
    return "مرحباً، {$name}!";
});

/**
 * مثال 5: route مع عدة parameters
 * جرّب: http://localhost:8000/post/5/comment/12
 */
Route::get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
    return "Post ID: {$postId}, Comment ID: {$commentId}";
});

/**
 * مثال 6: route مع optional parameter
 * جرّب: http://localhost:8000/greet
 * أو: http://localhost:8000/greet/محمد
 */
Route::get('/greet/{name?}', function ($name = 'ضيف') {
    return "مرحباً، {$name}!";
});

/**
 * مثال 7: route مع parameter validation
 * يقبل فقط الأرقام
 * جرّب: http://localhost:8000/product/123 ✅
 * لن يعمل: http://localhost:8000/product/abc ❌
 */
Route::get('/product/{id}', function ($id) {
    return "Product ID: {$id}";
})->where('id', '[0-9]+');

/**
 * مثال 8: route مع عدة validations
 * username يقبل حروف فقط
 * id يقبل أرقام فقط
 */
Route::get('/profile/{username}/{id}', function ($username, $id) {
    return "Username: {$username}, ID: {$id}";
})->where([
    'username' => '[a-zA-Z]+',
    'id' => '[0-9]+'
]);

// ==================================================
// القسم 3: Named Routes
// Section 3: Named Routes
// ==================================================

/**
 * مثال 9: route مع اسم
 * يمكنك الرجوع له بسهولة في الكود
 */
Route::get('/dashboard', function () {
    return 'لوحة التحكم';
})->name('dashboard');

/**
 * مثال 10: استخدام named route للـ redirect
 */
Route::get('/go-to-dashboard', function () {
    return redirect()->route('dashboard');
});

// ==================================================
// القسم 4: HTTP Methods المختلفة
// Section 4: Different HTTP Methods
// ==================================================

/**
 * مثال 11: GET Request
 * لعرض البيانات
 */
Route::get('/articles', function () {
    return 'عرض جميع المقالات';
});

/**
 * مثال 12: POST Request
 * لإنشاء بيانات جديدة
 * ملاحظة: لن تستطيع تجربته من المتصفح مباشرة
 * تحتاج Postman أو form
 */
Route::post('/articles', function () {
    return 'إنشاء مقال جديد';
});

/**
 * مثال 13: PUT Request
 * لتحديث البيانات
 */
Route::put('/articles/{id}', function ($id) {
    return "تحديث المقال رقم {$id}";
});

/**
 * مثال 14: DELETE Request
 * لحذف البيانات
 */
Route::delete('/articles/{id}', function ($id) {
    return "حذف المقال رقم {$id}";
});

/**
 * مثال 15: route يقبل عدة methods
 */
Route::match(['get', 'post'], '/form', function () {
    return 'هذا الـ route يقبل GET و POST';
});

/**
 * مثال 16: route يقبل جميع الـ methods
 */
Route::any('/anything', function () {
    return 'يقبل أي HTTP method';
});

// ==================================================
// القسم 5: Route Groups
// Section 5: Route Groups
// ==================================================

/**
 * مثال 17: مجموعة routes بنفس الـ prefix
 * جميع الـ routes ستبدأ بـ /admin
 */
Route::prefix('admin')->group(function () {
    // /admin/dashboard
    Route::get('/dashboard', function () {
        return 'لوحة تحكم المدير';
    });

    // /admin/users
    Route::get('/users', function () {
        return 'قائمة المستخدمين';
    });

    // /admin/settings
    Route::get('/settings', function () {
        return 'إعدادات النظام';
    });
});

/**
 * مثال 18: مجموعة routes مع name prefix
 */
Route::name('admin.')->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'لوحة تحكم المدير';
    })->name('dashboard'); // اسمه: admin.dashboard

    Route::get('/admin/profile', function () {
        return 'ملف المدير الشخصي';
    })->name('profile'); // اسمه: admin.profile
});

// ==================================================
// القسم 6: Routes مع Views
// Section 6: Routes with Views
// ==================================================

/**
 * مثال 19: route يعرض view
 * تأكد من وجود ملف: resources/views/welcome.blade.php
 */
Route::get('/welcome', function () {
    return view('welcome');
});

/**
 * مثال 20: route يعرض view مع بيانات
 */
Route::get('/about', function () {
    return view('about', [
        'title' => 'من نحن',
        'description' => 'نحن شركة رائدة في مجال البرمجة'
    ]);
});

/**
 * مثال 21: route بسيط جداً باستخدام view helper
 */
Route::view('/contact', 'contact');

/**
 * مثال 22: route view مع بيانات
 */
Route::view('/terms', 'terms', [
    'title' => 'الشروط والأحكام',
    'lastUpdate' => '2025-01-01'
]);

// ==================================================
// القسم 7: Redirect Routes
// Section 7: Redirect Routes
// ==================================================

/**
 * مثال 23: redirect بسيط
 */
Route::redirect('/old-page', '/new-page');

/**
 * مثال 24: redirect مع status code
 * 301 = Permanent redirect
 */
Route::redirect('/old-url', '/new-url', 301);

/**
 * مثال 25: permanent redirect (اختصار للـ 301)
 */
Route::permanentRedirect('/very-old-page', '/current-page');

// ==================================================
// القسم 8: Fallback Route
// Section 8: Fallback Route
// ==================================================

/**
 * مثال 26: route يظهر عندما لا يوجد route مطابق
 * ضعه دائماً في نهاية ملف routes/web.php
 */
Route::fallback(function () {
    return 'عذراً! الصفحة التي تبحث عنها غير موجودة.';
});

// ==================================================
// تمارين للتطبيق
// Practice Exercises
// ==================================================

/**
 * تمرين 1: أنشئ route يعرض اسمك
 * URL: /my-name
 */
// اكتب كودك هنا:


/**
 * تمرين 2: أنشئ route يستقبل رقم ويعرض مربعه
 * مثال: /square/5 يعرض "25"
 */
// اكتب كودك هنا:


/**
 * تمرين 3: أنشئ route group للـ API
 * جميع الـ routes تبدأ بـ /api/v1
 */
// اكتب كودك هنا:


// ==================================================
// ملاحظات مهمة
// Important Notes
// ==================================================

/**
 * 📝 ملاحظة 1: ترتيب الـ Routes مهم!
 *
 * ❌ خطأ:
 * Route::get('/user/{id}', ...);
 * Route::get('/user/profile', ...);  // لن يعمل!
 *
 * ✅ صحيح:
 * Route::get('/user/profile', ...);
 * Route::get('/user/{id}', ...);
 */

/**
 * 📝 ملاحظة 2: لعرض جميع الـ Routes
 *
 * في Terminal:
 * php artisan route:list
 */

/**
 * 📝 ملاحظة 3: لتنظيف route cache
 *
 * في Terminal:
 * php artisan route:clear
 * php artisan route:cache
 */

/**
 * 📝 ملاحظة 4: لاختبار route معين
 *
 * استخدم Postman أو curl:
 * curl http://localhost:8000/api/user
 */
