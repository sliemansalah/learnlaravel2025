<?php
/**
 * ==============================================
 * مثال 2: Views في Laravel
 * Example 2: Views in Laravel
 * ==============================================
 *
 * الغرض من هذا المثال:
 * - فهم كيفية إنشاء Views
 * - تمرير البيانات للـ Views
 * - استخدام Blade Template Engine
 *
 * المكان المناسب لهذا الكود:
 * resources/views/
 * ==============================================
 */

/**
 * ==============================================
 * ملاحظة مهمة:
 * هذا الملف يحتوي على أمثلة الـ Views
 * لن تستطيع تشغيله مباشرة
 *
 * تحتاج إلى:
 * 1. إنشاء ملفات .blade.php في مجلد resources/views/
 * 2. إضافة الـ routes المناسبة في routes/web.php
 * ==============================================
 */

// ==================================================
// القسم 1: Views البسيطة
// Section 1: Basic Views
// ==================================================

/**
 * مثال 1: أبسط view ممكن
 *
 * اسم الملف: resources/views/hello.blade.php
 * المحتوى:
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مرحباً</title>
</head>
<body>
    <h1>مرحباً بك في Laravel!</h1>
</body>
</html>

<?php
/**
 * في routes/web.php:
 * Route::get('/hello', function () {
 *     return view('hello');
 * });
 */
?>

<!-- ================================================== -->
<!-- القسم 2: تمرير البيانات للـ Views -->
<!-- Section 2: Passing Data to Views -->
<!-- ================================================== -->

<?php
/**
 * مثال 2: تمرير بيانات بسيطة
 *
 * اسم الملف: resources/views/user.blade.php
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>معلومات المستخدم</title>
</head>
<body>
    <h1>معلومات المستخدم</h1>
    <p>الاسم: {{ $name }}</p>
    <p>البريد: {{ $email }}</p>
</body>
</html>

<?php
/**
 * في routes/web.php:
 * Route::get('/user', function () {
 *     return view('user', [
 *         'name' => 'أحمد محمد',
 *         'email' => 'ahmed@example.com'
 *     ]);
 * });
 */
?>

<!-- ================================================== -->
<!-- مثال 3: تمرير بيانات بطرق مختلفة -->
<!-- ================================================== -->

<?php
/**
 * طريقة 1: Array
 */
// return view('user', ['name' => 'أحمد']);

/**
 * طريقة 2: with() method
 */
// return view('user')->with('name', 'أحمد');

/**
 * طريقة 3: with() method - عدة قيم
 */
// return view('user')
//     ->with('name', 'أحمد')
//     ->with('email', 'ahmed@example.com');

/**
 * طريقة 4: compact()
 */
// $name = 'أحمد';
// $email = 'ahmed@example.com';
// return view('user', compact('name', 'email'));
?>

<!-- ================================================== -->
<!-- القسم 3: Blade Syntax الأساسي -->
<!-- Section 3: Basic Blade Syntax -->
<!-- ================================================== -->

<?php
/**
 * مثال 4: Blade Syntax الأساسي
 *
 * اسم الملف: resources/views/blade-basics.blade.php
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Blade Basics</title>
</head>
<body>
    {{-- هذا تعليق في Blade - لن يظهر في HTML --}}

    {{-- عرض المتغيرات --}}
    <h1>{{ $title }}</h1>

    {{-- Blade يحمي من XSS تلقائياً --}}
    <p>{{ $userInput }}</p>

    {{-- لعرض HTML غير محمي (خطر!) --}}
    {!! $htmlContent !!}

    {{-- عرض مع قيمة افتراضية --}}
    <p>{{ $name ?? 'ضيف' }}</p>

    {{-- عمليات حسابية --}}
    <p>2 + 2 = {{ 2 + 2 }}</p>

    {{-- استدعاء functions --}}
    <p>اليوم: {{ date('Y-m-d') }}</p>
</body>
</html>
















<!-- ================================================== -->
<!-- القسم 4: Blade Control Structures -->
<!-- Section 4: Blade Control Structures -->
<!-- ================================================== -->

<?php
/**
 * مثال 5: If Statements
 *
 * اسم الملف: resources/views/blade-if.blade.php
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Blade If</title>
</head>
<body>
    {{-- If بسيط --}}
    @if ($score >= 90)
        <p>ممتاز!</p>
    @elseif ($score >= 70)
        <p>جيد جداً!</p>
    @elseif ($score >= 50)
        <p>جيد</p>
    @else
        <p>يحتاج تحسين</p>
    @endif

    {{-- Unless (عكس if) --}}
    @unless ($isAdmin)
        <p>أنت لست مدير</p>
    @endunless

    {{-- Isset و Empty --}}
    @isset($user)
        <p>المستخدم موجود: {{ $user->name }}</p>
    @endisset

    @empty($users)
        <p>لا يوجد مستخدمين</p>
    @endempty

    {{-- Auth checks --}}
    @auth
        <p>مرحباً، أنت مسجل دخول</p>
    @endauth

    @guest
        <p>مرحباً، ضيف</p>
    @endguest
</body>
</html>

<?php
/**
 * مثال 6: Loops
 *
 * اسم الملف: resources/views/blade-loops.blade.php
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Blade Loops</title>
</head>
<body>
    {{-- For Loop --}}
    @for ($i = 1; $i <= 5; $i++)
        <p>الرقم: {{ $i }}</p>
    @endfor

    <hr>

    {{-- Foreach Loop --}}
    <h2>قائمة المستخدمين:</h2>
    @foreach ($users as $user)
        <div>
            <h3>{{ $user['name'] }}</h3>
            <p>{{ $user['email'] }}</p>
        </div>
    @endforeach

    <hr>

    {{-- Foreach مع $loop variable --}}
    @foreach ($items as $item)
        <p>
            {{ $loop->index }} - {{ $item }}

            @if ($loop->first)
                (الأول)
            @endif

            @if ($loop->last)
                (الأخير)
            @endif
        </p>
    @endforeach

    <hr>

    {{-- While Loop --}}
    @php($counter = 1)
    @while ($counter <= 3)
        <p>العداد: {{ $counter }}</p>
        @php($counter++)
    @endwhile

    <hr>

    {{-- Forelse (foreach مع fallback) --}}
    <h2>المنتجات:</h2>
    @forelse ($products as $product)
        <div>{{ $product->name }}</div>
    @empty
        <p>لا توجد منتجات</p>
    @endforelse
</body>
</html>

<?php
/**
 * في routes/web.php:
 */
// Route::get('/blade-loops', function () {
//     return view('blade-loops', [
//         'users' => [
//             ['name' => 'أحمد', 'email' => 'ahmed@example.com'],
//             ['name' => 'محمد', 'email' => 'mohamed@example.com'],
//             ['name' => 'سارة', 'email' => 'sara@example.com'],
//         ],
//         'items' => ['تفاح', 'موز', 'برتقال'],
//         'products' => [] // أو collection من المنتجات
//     ]);
// });
?>

<!-- ================================================== -->
<!-- القسم 5: Blade Components و Layouts -->
<!-- Section 5: Blade Components & Layouts -->
<!-- ================================================== -->

<?php
/**
 * مثال 7: Layout أساسي
 *
 * اسم الملف: resources/views/layouts/app.blade.php
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'موقعي')</title>

    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        nav { background: #333; color: white; padding: 10px; }
        footer { background: #f0f0f0; padding: 20px; margin-top: 40px; }
    </style>

    @stack('styles')
</head>
<body>
    <nav>
        <div class="container">
            <a href="/">الرئيسية</a>
            <a href="/about">من نحن</a>
            <a href="/contact">اتصل بنا</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 جميع الحقوق محفوظة</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

<?php
/**
 * مثال 8: صفحة تستخدم الـ Layout
 *
 * اسم الملف: resources/views/home.blade.php
 */
?>
@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@push('styles')
    <style>
        .hero { background: #4CAF50; color: white; padding: 40px; }
    </style>
@endpush

@section('content')
    <div class="hero">
        <h1>مرحباً بك في موقعنا!</h1>
        <p>هذا مثال على استخدام Blade Layouts</p>
    </div>

    <div style="margin-top: 20px;">
        <h2>المحتوى الرئيسي</h2>
        <p>هنا يأتي محتوى صفحتك...</p>
    </div>
@endsection

@push('scripts')
    <script>
        console.log('الصفحة الرئيسية محملة!');
    </script>
@endpush

<?php
/**
 * في routes/web.php:
 * Route::get('/home', function () {
 *     return view('home');
 * });
 */
?>

<!-- ================================================== -->
<!-- القسم 6: Include و Components -->
<!-- Section 6: Include & Components -->
<!-- ================================================== -->

<?php
/**
 * مثال 9: استخدام Include
 *
 * اسم الملف: resources/views/partials/alert.blade.php
 */
?>
<div style="padding: 15px; background: {{ $type === 'success' ? '#4CAF50' : '#f44336' }}; color: white;">
    {{ $message }}
</div>

<?php
/**
 * استخدامه في ملف آخر:
 */
?>
@include('partials.alert', ['type' => 'success', 'message' => 'تم الحفظ بنجاح!'])

<?php
/**
 * مثال 10: Component بسيط
 *
 * إنشاء component:
 * php artisan make:component Alert
 *
 * اسم الملف: resources/views/components/alert.blade.php
 */
?>
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>

<?php
/**
 * استخدامه:
 */
?>
<x-alert type="success">
    تم حفظ البيانات بنجاح!
</x-alert>

<!-- ================================================== -->
<!-- القسم 7: أمثلة عملية كاملة -->
<!-- Section 7: Complete Practical Examples -->
<!-- ================================================== -->

<?php
/**
 * مثال 11: صفحة عرض مقال
 *
 * اسم الملف: resources/views/article.blade.php
 */
?>
@extends('layouts.app')

@section('title', $article['title'])

@section('content')
    <article>
        <h1>{{ $article['title'] }}</h1>

        <div style="color: #666; margin: 10px 0;">
            <small>
                بواسطة: {{ $article['author'] }} |
                تاريخ النشر: {{ $article['date'] }}
            </small>
        </div>

        <div style="line-height: 1.8;">
            {!! nl2br($article['content']) !!}
        </div>

        {{-- Tags --}}
        @if(count($article['tags']) > 0)
            <div style="margin-top: 20px;">
                <strong>الوسوم:</strong>
                @foreach($article['tags'] as $tag)
                    <span style="background: #e0e0e0; padding: 5px 10px; margin: 0 5px; border-radius: 3px;">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Comments --}}
        <div style="margin-top: 40px;">
            <h2>التعليقات ({{ count($article['comments']) }})</h2>

            @forelse($article['comments'] as $comment)
                <div style="border: 1px solid #ddd; padding: 15px; margin: 10px 0;">
                    <strong>{{ $comment['author'] }}</strong>
                    <small style="color: #666;">{{ $comment['date'] }}</small>
                    <p>{{ $comment['text'] }}</p>
                </div>
            @empty
                <p>لا توجد تعليقات بعد. كن أول من يعلق!</p>
            @endforelse
        </div>
    </article>
@endsection

<?php
/**
 * في routes/web.php:
 */
// Route::get('/article/{id}', function ($id) {
//     // في الحقيقة، هذه البيانات تأتي من قاعدة البيانات
//     $article = [
//         'title' => 'تعلم Laravel من الصفر',
//         'author' => 'أحمد محمد',
//         'date' => '2025-11-03',
//         'content' => 'Laravel هو أحد أقوى أطر عمل PHP...',
//         'tags' => ['Laravel', 'PHP', 'برمجة'],
//         'comments' => [
//             [
//                 'author' => 'محمد علي',
//                 'date' => '2025-11-03',
//                 'text' => 'مقال رائع! شكراً لك'
//             ],
//             [
//                 'author' => 'سارة أحمد',
//                 'date' => '2025-11-03',
//                 'text' => 'مفيد جداً'
//             ]
//         ]
//     ];
//
//     return view('article', ['article' => $article]);
// });
?>

<!-- ================================================== -->
<!-- تمارين للتطبيق -->
<!-- Practice Exercises -->
<!-- ================================================== -->

<?php
/**
 * تمرين 1: أنشئ view يعرض قائمة مهام (To-Do List)
 * - استخدم foreach loop
 * - أضف checkbox لكل مهمة
 * - اجعل المهام المكتملة بلون مختلف
 */

/**
 * تمرين 2: أنشئ layout مع header و sidebar و footer
 * - استخدم @yield و @section
 * - أنشئ 3 صفحات مختلفة تستخدم هذا الـ layout
 */

/**
 * تمرين 3: أنشئ component لعرض بطاقة (card)
 * - يستقبل: العنوان، الوصف، الصورة
 * - استخدم <x-card> للعرض
 */
?>

<!-- ================================================== -->
<!-- ملاحظات مهمة -->
<!-- Important Notes -->
<!-- ================================================== -->

<?php
/**
 * 📝 ملاحظة 1: Blade يحمي من XSS
 *
 * {{ $var }}        // محمي (آمن)
 * {!! $var !!}      // غير محمي (خطر!)
 */

/**
 * 📝 ملاحظة 2: تسمية ملفات Blade
 *
 * ✅ الصحيح:
 * - home.blade.php
 * - user-profile.blade.php
 * - admin/dashboard.blade.php
 *
 * ❌ الخطأ:
 * - home.php (ليس blade)
 * - Home.blade.php (Laravel case-sensitive)
 */

/**
 * 📝 ملاحظة 3: استدعاء Views في مجلدات فرعية
 *
 * الملف: resources/views/admin/dashboard.blade.php
 * الاستدعاء: view('admin.dashboard')
 * أو: view('admin/dashboard')
 */

/**
 * 📝 ملاحظة 4: التحقق من وجود View
 *
 * if (view()->exists('email.customer')) {
 *     return view('email.customer');
 * }
 */

/**
 * 📝 ملاحظة 5: لعرض أول view موجود
 *
 * return view()->first(['custom.admin', 'admin'], $data);
 */
?>
