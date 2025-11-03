<?php

use Illuminate\Support\Facades\Route;

// إجابة المهمة الأولى بواسطة م.سليمان صلاح
Route::get('/', function () {
    return "مرحبا بك في متجرنا الإلكتروني";
});

Route::get('/about', function () {
    return "<h1>من نحن</h1><p>نحن شركة متخصصة في البرمجة منذ عام 2020</p>";
});

Route::get('/contact', function () {
    return [
        "email" => "info@example.com",
        "phone" => "+966500000000",
        "address" => "الرياض، المملكة العربية السعودية",
    ];
});

// إجابة المهمة الثانية بواسطة م.سليمان صلاح
Route::get('/product/{id}', function ($id) {
    return "رقم المنتج: {$id}";
})->where('id', '[0-9]+');

Route::get('/user/{username}', function ($username) {
    return "صفحة المستخدم: {$username}";
})->where('username', '[a-z-A-Z]+');

Route::get('/article/{articleId}/comment/{commentId}', function ($articleId, $commentId) {
    return "عرض المقال رقم: {$articleId} , التعليق رقم {$commentId}";
})->where(
    [
    'articleId', '[0-9]+',
    'commentId', '[0-9]+',
    ]
);

// إجابة المهمة الثالثة بواسطة م.سليمان صلاح
Route::get('/welcome/{name?}', function ($name ='ضيفنا العزيز') {
    return "أهلا {$name} , نورت الموقع";
});


// إجابة المهمة الرابعة بواسطة م.سليمان صلاح
Route::get('/dashboard', function () {
    return "لوحة التحكم";
})->name('dashboard');

// Route::get('/admin', function () {
//     return redirect()->route('dashboard');
// });
Route::redirect('/admin', '/dashboard');
// Route::get('/old-shop', function () {
//     return redirect('/', 301);
// });
Route::permanentRedirect('/old-shop', '/');

Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        return "عرض قائمة المستخدمين";
    });
    Route::get('products', function () {
        return "عرض قائمة المنتجات";
    });
    Route::get('orders', function () {
        return "عرض قائمة الطلبات";
    });
});
