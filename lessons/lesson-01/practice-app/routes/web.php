<?php

use Illuminate\Support\Facades\Route;

// المسار الرئيسي / Main Route
Route::get('/', function () {
    return view('welcome');
});

// التمرين 3: إنشاء مسار /hello
Route::get('/hello', function () {
    return '<h1>مرحباً، أنا أتعلم Laravel!</h1>';
});

// التحدي: إنشاء مسار /about
Route::get('/about', function () {
    return '
        <html dir="rtl" lang="ar">
        <head>
            <meta charset="UTF-8">
            <title>عني</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 800px;
                    margin: 50px auto;
                    padding: 20px;
                    text-align: center;
                    background-color: #f7fafc;
                }
                h1 {
                    color: #FF2D20;
                }
                p {
                    line-height: 1.8;
                    color: #2d3748;
                }
            </style>
        </head>
        <body>
            <h1>من أنا؟</h1>
            <p>أنا طالب أتعلم Laravel من خلال دورة شاملة</p>
            <p>هذا هو الدرس الأول - مقدمة في Laravel</p>
            <p><a href="/">العودة للصفحة الرئيسية</a></p>
        </body>
        </html>
    ';
});

// التحدي: إنشاء مسار /contact
Route::get('/contact', function () {
    return '
        <html dir="rtl" lang="ar">
        <head>
            <meta charset="UTF-8">
            <title>اتصل بنا</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 800px;
                    margin: 50px auto;
                    padding: 20px;
                    text-align: center;
                    background-color: #f7fafc;
                }
                h1 {
                    color: #FF2D20;
                }
                .contact-info {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <h1>اتصل بنا</h1>
            <div class="contact-info">
                <p>📧 البريد الإلكتروني: info@laravel-course.com</p>
                <p>📱 الهاتف: 123-456-7890</p>
                <p>🌐 الموقع: www.laravel-course.com</p>
            </div>
            <p><a href="/">العودة للصفحة الرئيسية</a></p>
        </body>
        </html>
    ';
});

// التمرين 5: إنشاء عرض Blade
Route::get('/mypage', function () {
    return view('mypage');
});
