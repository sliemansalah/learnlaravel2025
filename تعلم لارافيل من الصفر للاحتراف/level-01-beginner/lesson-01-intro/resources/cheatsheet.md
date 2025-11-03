# Laravel - ورقة الغش السريعة
# Laravel Cheat Sheet

---

## 🚀 أوامر Artisan الأساسية

```bash
# إنشاء مشروع جديد
composer create-project laravel/laravel project-name

# تشغيل السيرفر المحلي
php artisan serve
php artisan serve --port=8080

# عرض جميع الأوامر
php artisan list

# مسح الـ cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# عرض معلومات Laravel
php artisan about
```

---

## 🛣️ Routing

### Routes البسيطة

```php
use Illuminate\Support\Facades\Route;

// GET Route
Route::get('/url', function () {
    return 'response';
});

// POST Route
Route::post('/url', function () { /* ... */ });

// PUT/PATCH Route
Route::put('/url', function () { /* ... */ });
Route::patch('/url', function () { /* ... */ });

// DELETE Route
Route::delete('/url', function () { /* ... */ });

// Multiple Methods
Route::match(['get', 'post'], '/url', function () { /* ... */ });
Route::any('/url', function () { /* ... */ });
```

### Route Parameters

```php
// Required Parameter
Route::get('/user/{id}', function ($id) {
    return "User {$id}";
});

// Optional Parameter
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello {$name}";
});

// Parameter Validation
Route::get('/user/{id}', function ($id) { /* ... */ })
    ->where('id', '[0-9]+');

// Multiple Parameters
Route::get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
    // ...
})->where(['postId' => '[0-9]+', 'commentId' => '[0-9]+']);
```

### Named Routes

```php
Route::get('/dashboard', function () { /* ... */ })->name('dashboard');

// استخدام Named Route
redirect()->route('dashboard');
route('dashboard'); // يرجع الـ URL
```

### Route Groups

```php
// Prefix
Route::prefix('admin')->group(function () {
    Route::get('/users', function () { /* ... */ }); // /admin/users
});

// Name Prefix
Route::name('admin.')->group(function () {
    Route::get('/dashboard', function () { /* ... */ })->name('dashboard'); // admin.dashboard
});

// Middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () { /* ... */ });
});
```

---

## 👀 Views

### عرض View

```php
// طريقة 1
return view('welcome');

// طريقة 2 - مع بيانات
return view('user', ['name' => 'John']);

// طريقة 3 - compact
$name = 'John';
return view('user', compact('name'));

// طريقة 4 - with
return view('user')->with('name', 'John');

// View مباشرة من Route
Route::view('/welcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'John']);
```

---

## 🔧 Blade Templates

### Directives الأساسية

```blade
{{-- تعليق --}}

{{-- عرض متغير (محمي من XSS) --}}
{{ $variable }}

{{-- عرض HTML غير محمي --}}
{!! $html !!}

{{-- قيمة افتراضية --}}
{{ $name ?? 'Guest' }}

{{-- تنفيذ PHP --}}
@php
    $total = 100;
@endphp
```

### Control Structures

```blade
{{-- If Statement --}}
@if ($score >= 90)
    ممتاز
@elseif ($score >= 70)
    جيد
@else
    يحتاج تحسين
@endif

{{-- Unless (عكس if) --}}
@unless ($user->isAdmin())
    ليس مدير
@endunless

{{-- Isset و Empty --}}
@isset($user)
    موجود
@endisset

@empty($users)
    فارغ
@endempty

{{-- Auth Checks --}}
@auth
    مسجل دخول
@endauth

@guest
    ضيف
@endguest
```

### Loops

```blade
{{-- For Loop --}}
@for ($i = 0; $i < 10; $i++)
    {{ $i }}
@endfor

{{-- Foreach --}}
@foreach ($users as $user)
    {{ $user->name }}
@endforeach

{{-- Forelse (مع fallback) --}}
@forelse ($users as $user)
    {{ $user->name }}
@empty
    لا يوجد مستخدمين
@endforelse

{{-- While --}}
@while ($condition)
    ...
@endwhile
```

### Loop Variable

```blade
@foreach ($items as $item)
    {{ $loop->index }}       {{-- 0, 1, 2, ... --}}
    {{ $loop->iteration }}   {{-- 1, 2, 3, ... --}}
    {{ $loop->first }}       {{-- true في الدورة الأولى --}}
    {{ $loop->last }}        {{-- true في الدورة الأخيرة --}}
    {{ $loop->count }}       {{-- عدد العناصر --}}
    {{ $loop->remaining }}   {{-- العناصر المتبقية --}}
@endforeach
```

### Layouts

```blade
{{-- Layout: layouts/app.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>

{{-- View يستخدم Layout --}}
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Content</h1>
@endsection

@push('scripts')
    <script src="app.js"></script>
@endpush
```

### Include

```blade
{{-- Include View --}}
@include('partials.header')

{{-- مع بيانات --}}
@include('partials.alert', ['type' => 'success'])

{{-- If exists --}}
@includeIf('partials.header')

{{-- When condition --}}
@includeWhen($condition, 'partials.header')
```

---

## 🎮 Controllers

### إنشاء Controller

```bash
# Controller بسيط
php artisan make:controller UserController

# Resource Controller
php artisan make:controller UserController --resource

# API Controller
php artisan make:controller UserController --api

# Invokable Controller
php artisan make:controller ShowProfile --invokable
```

### Controller Example

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show($id)
    {
        return view('users.show', ['id' => $id]);
    }

    public function store(Request $request)
    {
        // حفظ البيانات
        return redirect()->route('users.index');
    }
}
```

### Resource Routes

```php
// Route واحد لجميع عمليات CRUD
Route::resource('users', UserController::class);

// ينشئ:
// GET    /users           -> index
// GET    /users/create    -> create
// POST   /users           -> store
// GET    /users/{id}      -> show
// GET    /users/{id}/edit -> edit
// PUT    /users/{id}      -> update
// DELETE /users/{id}      -> destroy
```

---

## 🔄 Responses

```php
// String
return 'Hello';

// Array (يتحول لـ JSON)
return ['name' => 'John'];

// View
return view('welcome');

// JSON
return response()->json(['name' => 'John']);

// Redirect
return redirect('/home');
return redirect()->route('dashboard');
return redirect()->back();

// مع رسالة
return redirect()->route('home')->with('success', 'تم الحفظ!');
```

---

## ⚙️ Environment Variables

```php
// قراءة من .env
env('APP_NAME')
env('APP_DEBUG', false) // مع قيمة افتراضية

// في config/app.php
'name' => env('APP_NAME', 'Laravel'),

// استخدام
config('app.name')
```

---

## 📝 التحقق من البيانات (Basic)

```php
$request->validate([
    'name' => 'required|max:255',
    'email' => 'required|email|unique:users',
    'age' => 'required|integer|min:18',
    'password' => 'required|min:8|confirmed',
]);
```

---

## 💡 نصائح سريعة

```bash
# عرض جميع Routes
php artisan route:list

# البحث عن route معين
php artisan route:list --path=users

# تصفية حسب Method
php artisan route:list --method=GET

# عرض التفاصيل
php artisan route:list -v
```

---

**احفظ هذه الورقة للرجوع إليها! 🚀**
