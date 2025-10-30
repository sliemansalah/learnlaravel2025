<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShowDashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Lesson 3: Controllers and MVC Pattern - Practice Routes
|--------------------------------------------------------------------------
| الدرس الثالث: المتحكمات ونمط MVC - مسارات التطبيق العملي
|
| This file demonstrates all controller concepts from Lesson 3
*/

// ========================================
// 1. PageController - Simple Controller
//    متحكم بسيط للصفحات الأساسية
// ========================================

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ========================================
// 2. ProductController - Resource Controller
//    متحكم موارد للمنتجات (7 مسارات تلقائياً)
// ========================================

Route::resource('products', ProductController::class);

/*
 * هذا السطر الواحد ينشئ 7 مسارات:
 * This single line creates 7 routes:
 *
 * GET    /products              - index()   قائمة المنتجات
 * GET    /products/create       - create()  نموذج إضافة منتج
 * POST   /products              - store()   حفظ منتج جديد
 * GET    /products/{id}         - show()    عرض منتج واحد
 * GET    /products/{id}/edit    - edit()    نموذج تعديل منتج
 * PUT    /products/{id}         - update()  تحديث منتج
 * DELETE /products/{id}         - destroy() حذف منتج
 */

// ========================================
// 3. PostController - Resource Controller
//    متحكم موارد للمقالات
// ========================================

Route::resource('posts', PostController::class);

// ========================================
// 4. ShowDashboardController - Single Action Controller
//    متحكم بإجراء واحد للوحة التحكم
// ========================================

Route::get('/dashboard', ShowDashboardController::class)
    ->name('dashboard');

/*
 * Single Action Controller يستخدم __invoke()
 * لا حاجة لتحديد اسم method
 */

// ========================================
// 5. UserController - Dependency Injection & Validation
//    متحكم مع حقن التبعيات والتحقق من البيانات
// ========================================

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');

Route::put('/users/{id}', [UserController::class, 'update'])
    ->name('users.update');

/*
 * يمكنك عرض جميع المسارات باستخدام:
 * You can view all routes using:
 * php artisan route:list
 *
 * لعرض مسارات معينة:
 * To view specific routes:
 * php artisan route:list --name=products
 * php artisan route:list --name=posts
 */
