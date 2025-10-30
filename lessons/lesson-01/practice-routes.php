<?php

/**
 * الدرس 1 - مسارات التدريب
 *
 * انسخ هذه المسارات إلى ملف routes/web.php للتدريب!
 * ثم قم بزيارتها في متصفحك على http://localhost:8000
 */

// مسار بسيط يعيد نصاً
Route::get('/lesson1/hello', function () {
    return '<h1 style="text-align: center; padding: 50px;">مرحباً من الدرس 1!</h1>';
});

// مسار يعيد HTML
Route::get('/lesson1/welcome', function () {
    return '
        <!DOCTYPE html>
        <html lang="ar" dir="rtl">
        <head>
            <title>مرحباً</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                }
            </style>
        </head>
        <body>
            <h1>مرحباً بك في تعلم Laravel!</h1>
            <p>أنت تحرز تقدماً رائعاً!</p>
        </body>
        </html>
    ';
});

// مسار مع بيانات أساسية
Route::get('/lesson1/info', function () {
    $laravelVersion = app()->version();
    $phpVersion = PHP_VERSION;

    return "
        <div style='font-family: Arial; padding: 50px; direction: rtl; text-align: right;'>
            <h1>معلومات النظام</h1>
            <ul>
                <li>إصدار Laravel: {$laravelVersion}</li>
                <li>إصدار PHP: {$phpVersion}</li>
                <li>الوقت الحالي: " . date('Y-m-d H:i:s') . "</li>
            </ul>
        </div>
    ";
});

// مسار يعيد JSON (بأسلوب API)
Route::get('/lesson1/json', function () {
    return response()->json([
        'message' => 'مرحباً من Laravel API',
        'lesson' => 1,
        'topic' => 'مقدمة في Laravel',
        'status' => 'نجح',
        'language' => 'العربية'
    ]);
});

// تمارين التدريب - قم بإزالة التعليق وإكمال هذه المسارات:

// التمرين 1: أنشئ مسار "عني"
// Route::get('/lesson1/about', function () {
//     return '<div style="direction: rtl; padding: 50px;"><h1>عني</h1><p>محتواك هنا...</p></div>';
// });

// التمرين 2: أنشئ مسار "اتصل بنا"
// Route::get('/lesson1/contact', function () {
//     return '<div style="direction: rtl; padding: 50px;"><h1>اتصل بنا</h1><p>البريد الإلكتروني: your-email@example.com</p></div>';
// });

// التمرين 3: أنشئ مساراً يعرض التاريخ والوقت الحالي
// Route::get('/lesson1/datetime', function () {
//     // كودك هنا
// });

// التمرين 4: أنشئ مساراً يعرض معلومات عنك (الاسم، العمر، الهواية)
// Route::get('/lesson1/profile', function () {
//     // كودك هنا
// });
