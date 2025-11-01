<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Lesson 3: Controllers and MVC - Practice Routes
|--------------------------------------------------------------------------
| الدرس الثالث: Controllers و MVC - مسارات التطبيق العملي
|
| This file demonstrates controller routing concepts from Lesson 3
*/

// ========================================
// 1. مسارات Controller البسيطة
// Simple Controller Routes
// ========================================

// الصفحة الرئيسية / Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحة حول / About Page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// صفحة الاتصال / Contact Page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// ========================================
// 2. Resource Controller - طريقة كاملة
// Full Resource Controller
// ========================================

/**
 * Resource Controller يوفر جميع المسارات السبعة تلقائياً:
 * Resource Controller automatically provides all 7 routes:
 *
 * GET    /products           -> index()    قائمة المنتجات / List products
 * GET    /products/create    -> create()   نموذج إنشاء / Create form
 * POST   /products           -> store()    حفظ جديد / Store new
 * GET    /products/{id}      -> show()     عرض واحد / Show one
 * GET    /products/{id}/edit -> edit()     نموذج تعديل / Edit form
 * PUT    /products/{id}      -> update()   تحديث / Update
 * DELETE /products/{id}      -> destroy()  حذف / Delete
 */
Route::resource('products', ProductController::class);

// ========================================
// 3. Single Action Controller
// Controller بوظيفة واحدة
// ========================================

/**
 * Single Action Controller - يستخدم __invoke()
 * فقط اسم الـ Controller بدون اسم method
 * Just the Controller class without method name
 */
Route::get('/dashboard', DashboardController::class)->name('dashboard');
