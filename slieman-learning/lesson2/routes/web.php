<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Lesson 2: Routing Basics - Practice Routes
|--------------------------------------------------------------------------
| الدرس الثاني: أساسيات التوجيه - مسارات التطبيق العملي
|
| This file demonstrates all routing concepts from Lesson 2
*/

// ========================================
// 1. الصفحة الرئيسية / Home Page
// ========================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/{id}/{slug}', function ($id, $slug) {
    return 'our id is=' . $id . '- slug = ' . $slug;
})->name('testPage');

// ========================================
// 2. تمرين: أنواع HTTP Methods
// Exercise: HTTP Methods Types
// ========================================

// GET - قراءة البيانات / Read data
Route::get('/products', function () {
    return '<h1>قائمة المنتجات</h1><p>Products List</p>';
});

// POST - إنشاء جديد / Create new
Route::post('/products', function () {
    return '<h1>تم إنشاء منتج جديد</h1><p>New product created</p>';
});

// PUT - تحديث كامل / Full update
Route::put('/products/{id}', function ($id) {
    return "<h1>تحديث المنتج رقم: $id</h1><p>Update product: $id</p>";
});

// DELETE - حذف / Delete
Route::delete('/products/{id}', function ($id) {
    return "<h1>حذف المنتج رقم: $id</h1><p>Delete product: $id</p>";
});

// ========================================
// 3. تمرين: معاملات المسار
// Exercise: Route Parameters
// ========================================

// معامل إلزامي مع قيد (أرقام فقط)
// Required parameter with constraint (numbers only)
Route::get('/product/{id}', function ($id) {
    return "<h1>عرض المنتج رقم: $id</h1><p>Show product number: $id</p>";
})->where('id', '[0-9]+')->name('product.show');

// معامل بـ slug
// Parameter with slug
Route::get('/products/{slug}', function ($slug) {
    return "<h1>المنتج: $slug</h1><p>Product: $slug</p>";
})->where('slug', '[a-z0-9-]+')->name('product.slug');

// معامل اختياري
// Optional parameter
Route::get('/user/{name?}', function ($name = 'ضيف / Guest') {
    return "<h1>مرحباً $name</h1><p>Hello $name</p>";
})->name('user.greeting');

// عدة معاملات
// Multiple parameters
Route::get('/category/{category}/product/{product}', function ($category, $product) {
    return "
        <h1>التصنيف والمنتج</h1>
        <p><strong>التصنيف:</strong> $category</p>
        <p><strong>المنتج:</strong> $product</p>
        <hr>
        <p><strong>Category:</strong> $category</p>
        <p><strong>Product:</strong> $product</p>
    ";
});

// ========================================
// 4. تمرين: المسارات المسماة
// Exercise: Named Routes
// ========================================

Route::get('/dashboard', function () {
    $profileUrl = route('profile');
    return "
        <h1>لوحة التحكم / Dashboard</h1>
        <p>هذا مثال على مسار مسمى</p>
        <p>This is an example of a named route</p>
        <p><a href='$profileUrl'>الملف الشخصي / Profile</a></p>
    ";
})->name('dashboard');

Route::get('/profile', function () {
    $dashboardUrl = route('dashboard');
    return "
        <h1>الملف الشخصي / Profile</h1>
        <p>معلومات المستخدم</p>
        <p>User Information</p>
        <p><a href='$dashboardUrl'>العودة للوحة التحكم / Back to Dashboard</a></p>
    ";
})->name('profile');

// ========================================
// 5. تمرين: مجموعات المسارات
// Exercise: Route Groups
// ========================================

// مجموعة مسارات الأدمن
// Admin routes group
Route::prefix('admin')
     ->name('admin.')
     ->group(function () {

         Route::get('/dashboard', function () {
             return "
                 <h1>لوحة تحكم الأدمن</h1>
                 <h2>Admin Dashboard</h2>
                 <ul>
                     <li><a href='" . route('admin.users') . "'>إدارة المستخدمين / Users</a></li>
                     <li><a href='" . route('admin.products') . "'>إدارة المنتجات / Products</a></li>
                     <li><a href='" . route('admin.settings') . "'>الإعدادات / Settings</a></li>
                 </ul>
             ";
         })->name('dashboard');

         Route::get('/users', function () {
             return "
                 <h1>إدارة المستخدمين</h1>
                 <h2>User Management</h2>
                 <p>قائمة المستخدمين / Users List</p>
                 <p><a href='" . route('admin.dashboard') . "'>العودة / Back</a></p>
             ";
         })->name('users');

         Route::get('/products', function () {
             return "
                 <h1>إدارة المنتجات</h1>
                 <h2>Product Management</h2>
                 <p>قائمة المنتجات / Products List</p>
                 <p><a href='" . route('admin.dashboard') . "'>العودة / Back</a></p>
             ";
         })->name('products');

         Route::get('/settings', function () {
             return "
                 <h1>الإعدادات</h1>
                 <h2>Settings</h2>
                 <p>إعدادات النظام / System Settings</p>
                 <p><a href='" . route('admin.dashboard') . "'>العودة / Back</a></p>
             ";
         })->name('settings');
     });

// ========================================
// 6. تمرين: نموذج مع GET و POST
// Exercise: Form with GET & POST
// ========================================

// عرض النموذج / Display form
Route::get('/contact', function () {
    return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>نموذج الاتصال / Contact Form</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 600px;
                    margin: 50px auto;
                    padding: 20px;
                }
                .form-group {
                    margin-bottom: 15px;
                }
                label {
                    display: block;
                    margin-bottom: 5px;
                    font-weight: bold;
                }
                input, textarea {
                    width: 100%;
                    padding: 8px;
                    box-sizing: border-box;
                }
                button {
                    background-color: #3498db;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    cursor: pointer;
                    font-size: 16px;
                }
                button:hover {
                    background-color: #2980b9;
                }
                .success {
                    background-color: #2ecc71;
                    color: white;
                    padding: 10px;
                    margin-bottom: 20px;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <h1>نموذج الاتصال</h1>
            <h2>Contact Form</h2>

            <form method='POST' action='" . route('contact.submit') . "'>
                " . csrf_field() . "

                <div class='form-group'>
                    <label>الاسم / Name:</label>
                    <input type='text' name='name' required>
                </div>

                <div class='form-group'>
                    <label>البريد الإلكتروني / Email:</label>
                    <input type='email' name='email' required>
                </div>

                <div class='form-group'>
                    <label>الرسالة / Message:</label>
                    <textarea name='message' rows='5' required></textarea>
                </div>

                <button type='submit'>إرسال / Send</button>
            </form>
        </body>
        </html>
    ";
})->name('contact.show');

// معالجة النموذج / Process form
Route::post('/contact', function () {
    // في التطبيق الحقيقي، سنعالج البيانات هنا
    // In a real application, we would process the data here

    return redirect()->route('contact.show')
                     ->with('success', 'تم إرسال رسالتك بنجاح! / Your message has been sent successfully!');
})->name('contact.submit');
