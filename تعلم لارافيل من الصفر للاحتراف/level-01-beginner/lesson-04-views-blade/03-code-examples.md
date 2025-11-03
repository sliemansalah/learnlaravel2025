# أمثلة عملية: Views و Blade Templates

## 📚 المحتويات

تحتوي هذه الصفحة على 30 مثالاً عملياً لاستخدام Views و Blade في Laravel

---

## القسم الأول: Blade Basics

### مثال 1: View بسيط

**resources/views/hello.blade.php:**
```blade
<!DOCTYPE html>
<html>
<head>
    <title>مرحباً</title>
</head>
<body>
    <h1>مرحباً بك في Laravel!</h1>
</body>
</html>
```

**في Controller:**
```php
public function hello()
{
    return view('hello');
}
```

---

### مثال 2: عرض البيانات (Displaying Data)

**Controller:**
```php
public function welcome()
{
    $name = 'أحمد';
    $age = 25;

    return view('welcome', compact('name', 'age'));
}
```

**View:**
```blade
<h1>مرحباً {{ $name }}</h1>
<p>عمرك {{ $age }} سنة</p>
```

---

### مثال 3: Escaping vs Non-Escaping

```blade
{{-- مع Escaping (آمن) --}}
<p>{{ $userInput }}</p>
{{-- سيتم تحويل <script> إلى &lt;script&gt; --}}

{{-- بدون Escaping (خطر) --}}
<div>{!! $trustedHtml !!}</div>
{{-- سيتم عرض HTML كما هو --}}
```

**مثال عملي:**
```php
$userInput = '<script>alert("XSS")</script>';
$trustedHtml = '<strong>Bold Text</strong>';

return view('example', compact('userInput', 'trustedHtml'));
```

```blade
{{ $userInput }}
{{-- النتيجة: &lt;script&gt;alert("XSS")&lt;/script&gt; --}}

{!! $trustedHtml !!}
{{-- النتيجة: <strong>Bold Text</strong> --}}
```

---

## القسم الثاني: Control Structures

### مثال 4: @if Statement

```blade
@php
    $score = 85;
@endphp

@if ($score >= 90)
    <div class="alert alert-success">ممتاز</div>
@elseif ($score >= 70)
    <div class="alert alert-info">جيد جداً</div>
@elseif ($score >= 50)
    <div class="alert alert-warning">جيد</div>
@else
    <div class="alert alert-danger">راسب</div>
@endif
```

---

### مثال 5: @unless

```blade
@unless (auth()->check())
    <a href="/login">يرجى تسجيل الدخول</a>
@endunless

{{-- يعادل --}}
@if (!auth()->check())
    <a href="/login">يرجى تسجيل الدخول</a>
@endif
```

---

### مثال 6: @isset و @empty

```blade
@isset($user)
    <p>المستخدم: {{ $user->name }}</p>
@else
    <p>لا يوجد مستخدم</p>
@endisset

@empty($posts)
    <p>لا توجد مقالات</p>
@else
    <p>عدد المقالات: {{ count($posts) }}</p>
@endempty
```

---

### مثال 7: @auth و @guest

```blade
<nav>
    @guest
        <a href="/login">تسجيل الدخول</a>
        <a href="/register">التسجيل</a>
    @endguest

    @auth
        <a href="/profile">الملف الشخصي</a>
        <form action="/logout" method="POST">
            @csrf
            <button>تسجيل الخروج</button>
        </form>
    @endauth
</nav>
```

**مع Guard محدد:**
```blade
@auth('admin')
    <a href="/admin/dashboard">لوحة التحكم</a>
@endauth

@guest('admin')
    <a href="/admin/login">تسجيل دخول المدير</a>
@endguest
```

---

## القسم الثالث: Loops

### مثال 8: @foreach الأساسي

```php
$users = [
    ['name' => 'أحمد', 'email' => 'ahmad@example.com'],
    ['name' => 'فاطمة', 'email' => 'fatima@example.com'],
    ['name' => 'محمد', 'email' => 'mohamed@example.com'],
];

return view('users', compact('users'));
```

```blade
<table>
    <thead>
        <tr>
            <th>الاسم</th>
            <th>البريد</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
```

---

### مثال 9: $loop Variable

```blade
@foreach ($posts as $post)
    <div class="post {{ $loop->even ? 'bg-gray' : 'bg-white' }}">
        <span class="badge">{{ $loop->iteration }}/{{ $loop->count }}</span>

        @if ($loop->first)
            <span class="label">جديد</span>
        @endif

        <h3>{{ $post->title }}</h3>

        @if ($loop->last)
            <hr>
            <p>نهاية القائمة</p>
        @endif
    </div>
@endforeach
```

**خصائص $loop:**
```blade
@foreach ($items as $item)
    <p>Index: {{ $loop->index }}</p>         {{-- 0, 1, 2... --}}
    <p>Iteration: {{ $loop->iteration }}</p> {{-- 1, 2, 3... --}}
    <p>Remaining: {{ $loop->remaining }}</p>
    <p>Count: {{ $loop->count }}</p>
    <p>First: {{ $loop->first ? 'Yes' : 'No' }}</p>
    <p>Last: {{ $loop->last ? 'Yes' : 'No' }}</p>
    <p>Depth: {{ $loop->depth }}</p>
@endforeach
```

---

### مثال 10: @forelse (مع Empty)

```blade
<h2>المقالات</h2>

@forelse ($posts as $post)
    <article>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->excerpt }}</p>
    </article>
@empty
    <div class="alert alert-info">
        <p>لا توجد مقالات لعرضها حالياً</p>
        <a href="/posts/create">أنشئ أول مقال</a>
    </div>
@endforelse
```

---

### مثال 11: Nested Loops مع $loop->parent

```blade
@foreach ($categories as $category)
    <div class="category">
        <h2>{{ $category->name }}</h2>

        @foreach ($category->posts as $post)
            <div class="post">
                <p>التصنيف {{ $loop->parent->iteration }}: المقال {{ $loop->iteration }}</p>
                <h3>{{ $post->title }}</h3>
            </div>
        @endforeach
    </div>
@endforeach
```

---

### مثال 12: @break و @continue

```blade
@foreach ($posts as $post)
    @if ($post->draft)
        @continue {{-- تجاوز المسودات --}}
    @endif

    <div class="post">
        <h3>{{ $post->title }}</h3>
    </div>

    @if ($loop->iteration === 10)
        @break {{-- عرض 10 مقالات فقط --}}
    @endif
@endforeach
```

**مع شرط مباشر:**
```blade
@foreach ($users as $user)
    @continue($user->banned)
    @break($loop->iteration > 20)

    <div>{{ $user->name }}</div>
@endforeach
```

---

## القسم الرابع: Layouts & Sections

### مثال 13: Layout أساسي

**resources/views/layouts/app.blade.php:**
```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'الموقع')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <header>
        @include('partials.header')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('partials.footer')
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
```

---

### مثال 14: استخدام Layout في View

**resources/views/posts/show.blade.php:**
```blade
@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <div class="meta">
            <span>{{ $post->author->name }}</span>
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>
        <div class="content">
            {!! $post->content !!}
        </div>
    </article>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endpush
```

---

### مثال 15: @section مع @parent

**Layout:**
```blade
@section('sidebar')
    <div>Default Sidebar Content</div>
@show
```

**Child View:**
```blade
@section('sidebar')
    @parent {{-- يحتفظ بمحتوى الـ Layout --}}
    <div>Additional Sidebar Content</div>
@endsection
```

**النتيجة:**
```html
<div>Default Sidebar Content</div>
<div>Additional Sidebar Content</div>
```

---

### مثال 16: Multiple Layouts

**resources/views/layouts/guest.blade.php:** (للزوار)
```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body class="guest-layout">
    @yield('content')
</body>
</html>
```

**resources/views/layouts/auth.blade.php:** (للمستخدمين المسجلين)
```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body class="auth-layout">
    <nav>@include('partials.navbar')</nav>
    <aside>@include('partials.sidebar')</aside>
    <main>@yield('content')</main>
</body>
</html>
```

**استخدام:**
```blade
{{-- للزوار --}}
@extends('layouts.guest')

{{-- للمستخدمين --}}
@extends('layouts.auth')
```

---

## القسم الخامس: Components

### مثال 17: Anonymous Component بسيط

**resources/views/components/button.blade.php:**
```blade
<button {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $slot }}
</button>
```

**استخدام:**
```blade
<x-button class="btn-primary" id="submit">
    حفظ
</x-button>

{{-- النتيجة --}}
<button class="btn btn-primary" id="submit">
    حفظ
</button>
```

---

### مثال 18: Component مع Props

**resources/views/components/alert.blade.php:**
```blade
@props(['type' => 'info', 'dismissible' => false])

<div class="alert alert-{{ $type }} {{ $dismissible ? 'alert-dismissible' : '' }}">
    @if ($dismissible)
        <button class="close">&times;</button>
    @endif
    {{ $slot }}
</div>
```

**استخدام:**
```blade
<x-alert type="success">
    تم حفظ البيانات بنجاح!
</x-alert>

<x-alert type="danger" :dismissible="true">
    حدث خطأ! يرجى المحاولة مرة أخرى.
</x-alert>
```

---

### مثال 19: Component مع Named Slots

**resources/views/components/card.blade.php:**
```blade
@props(['title'])

<div class="card">
    <div class="card-header">
        <h3>{{ $title }}</h3>
        @isset($actions)
            <div class="actions">{{ $actions }}</div>
        @endisset
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>
```

**استخدام:**
```blade
<x-card title="معلومات المستخدم">
    <x-slot name="actions">
        <button>تعديل</button>
        <button>حذف</button>
    </x-slot>

    <p>الاسم: أحمد محمد</p>
    <p>البريد: ahmad@example.com</p>

    <x-slot name="footer">
        <small>آخر تحديث: منذ ساعة</small>
    </x-slot>
</x-card>
```

---

### مثال 20: Class-based Component

**إنشاء Component:**
```bash
php artisan make:component UserCard
```

**app/View/Components/UserCard.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserCard extends Component
{
    public $user;
    public $showEmail;

    public function __construct($user, $showEmail = true)
    {
        $this->user = $user;
        $this->showEmail = $showEmail;
    }

    public function render()
    {
        return view('components.user-card');
    }

    public function isOnline()
    {
        return $this->user->last_seen_at > now()->subMinutes(5);
    }
}
```

**resources/views/components/user-card.blade.php:**
```blade
<div class="user-card">
    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
    <h3>{{ $user->name }}</h3>

    @if ($showEmail)
        <p>{{ $user->email }}</p>
    @endif

    @if ($isOnline())
        <span class="badge online">متصل</span>
    @else
        <span class="badge offline">غير متصل</span>
    @endif

    {{ $slot }}
</div>
```

**استخدام:**
```blade
<x-user-card :user="$user" :show-email="false">
    <button>إرسال رسالة</button>
</x-user-card>
```

---

## القسم السادس: Including Views

### مثال 21: @include الأساسي

**resources/views/partials/alert.blade.php:**
```blade
<div class="alert alert-{{ $type }}">
    {{ $message }}
</div>
```

**استخدام:**
```blade
@include('partials.alert', ['type' => 'success', 'message' => 'تم الحفظ'])
@include('partials.alert', ['type' => 'error', 'message' => 'حدث خطأ'])
```

---

### مثال 22: @includeIf, @includeWhen, @includeUnless

```blade
{{-- Include إذا كان الملف موجوداً --}}
@includeIf('partials.analytics')

{{-- Include بناءً على شرط --}}
@includeWhen($user->isAdmin(), 'partials.admin-menu')

{{-- Include إلا إذا كان الشرط صحيح --}}
@includeUnless($user->isBanned(), 'partials.comments')
```

---

### مثال 23: @includeFirst

```blade
{{-- Include أول view موجود من القائمة --}}
@includeFirst(['partials.custom-header', 'partials.default-header'])
```

---

### مثال 24: @each لعرض Array

```blade
{{-- عرض كل عنصر في array باستخدام view معين --}}
@each('partials.product-card', $products, 'product', 'partials.no-products')
```

**يعادل:**
```blade
@forelse($products as $product)
    @include('partials.product-card', ['product' => $product])
@empty
    @include('partials.no-products')
@endforelse
```

---

## القسم السابع: Forms & CSRF

### مثال 25: Form مع CSRF

```blade
<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>العنوان</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>المحتوى</label>
        <textarea name="content">{{ old('content') }}</textarea>
        @error('content')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">حفظ</button>
</form>
```

---

### مثال 26: Form مع Method Spoofing

```blade
{{-- Update Form (PUT method) --}}
<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $post->title) }}">
    <button>تحديث</button>
</form>

{{-- Delete Form --}}
<form action="{{ route('posts.destroy', $post) }}" method="POST">
    @csrf
    @method('DELETE')
    <button>حذف</button>
</form>
```

---

### مثال 27: عرض جميع Validation Errors

```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <h4>يرجى تصحيح الأخطاء التالية:</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

---

## القسم الثامن: Conditional Classes & Styles

### مثال 28: @class Directive

```blade
@php
    $active = true;
    $hasError = false;
@endphp

<div @class([
    'btn',
    'btn-primary' => $active,
    'btn-disabled' => !$active,
    'has-error' => $hasError,
])>
    زر
</div>

{{-- النتيجة --}}
<div class="btn btn-primary">زر</div>
```

**مثال متقدم:**
```blade
<button @class([
    'px-4 py-2 rounded',
    'bg-blue-500 text-white' => !$disabled,
    'bg-gray-300 text-gray-500 cursor-not-allowed' => $disabled,
])>
    {{ $label }}
</button>
```

---

### مثال 29: @style Directive

```blade
<div @style([
    'background-color: red' => $hasError,
    'color: green' => $success,
    'font-weight: bold',
])>
    رسالة
</div>
```

---

## القسم التاسع: Switch Statement

### مثال 30: @switch

```blade
@switch($user->role)
    @case('admin')
        <span class="badge badge-danger">مدير</span>
        <p>لديك صلاحيات كاملة</p>
        @break

    @case('editor')
        <span class="badge badge-warning">محرر</span>
        <p>يمكنك تعديل المحتوى</p>
        @break

    @case('author')
        <span class="badge badge-info">كاتب</span>
        <p>يمكنك إنشاء مقالات</p>
        @break

    @default
        <span class="badge badge-secondary">مستخدم</span>
        <p>يمكنك قراءة المحتوى فقط</p>
@endswitch
```

---

## القسم العاشر: Advanced Techniques

### مثال 31: @once

```blade
{{-- سيتم تنفيذ هذا مرة واحدة فقط حتى لو تم include عدة مرات --}}
@once
    @push('scripts')
        <script src="https://cdn.example.com/library.js"></script>
    @endpush
@endonce
```

---

### مثال 32: @verbatim (لـ Vue.js)

```blade
{{-- سيتجاهل Blade هذا القسم --}}
@verbatim
    <div id="app">
        {{ message }}  {{-- سيتم معالجته بواسطة Vue --}}
    </div>
@endverbatim

<script>
    new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!'
        }
    });
</script>
```

---

### مثال 33: Custom If Statements

**في Service Provider:**
```php
use Illuminate\Support\Facades\Blade;

public function boot()
{
    Blade::if('admin', function () {
        return auth()->check() && auth()->user()->isAdmin();
    });

    Blade::if('env', function ($environment) {
        return app()->environment($environment);
    });
}
```

**استخدام:**
```blade
@admin
    <a href="/admin">لوحة التحكم</a>
@endadmin

@env('local')
    <div class="debug-bar">Debug Mode</div>
@endenv
```

---

### مثال 34: Blade::directive مخصص

**في Service Provider:**
```php
use Illuminate\Support\Facades\Blade;

public function boot()
{
    // @datetime($date)
    Blade::directive('datetime', function ($expression) {
        return "<?php echo ($expression)->format('Y-m-d H:i:s'); ?>";
    });

    // @money($amount)
    Blade::directive('money', function ($expression) {
        return "<?php echo number_format($expression, 2) . ' ريال'; ?>";
    });
}
```

**استخدام:**
```blade
<p>تاريخ النشر: @datetime($post->created_at)</p>
<p>السعر: @money($product->price)</p>
```

---

### مثال 35: مشروع كامل - Dashboard

**Layout:**
```blade
{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            @include('dashboard.partials.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow">
                @include('dashboard.partials.header')
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
```

**Sidebar:**
```blade
{{-- resources/views/dashboard/partials/sidebar.blade.php --}}
<div class="p-4">
    <h2 class="text-2xl font-bold mb-6">لوحة التحكم</h2>

    <nav>
        <a href="{{ route('dashboard') }}"
           class="block py-2 px-4 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            الرئيسية
        </a>
        <a href="{{ route('dashboard.posts') }}"
           class="block py-2 px-4 rounded {{ request()->routeIs('dashboard.posts*') ? 'bg-gray-700' : '' }}">
            المقالات
        </a>
        <a href="{{ route('dashboard.users') }}"
           class="block py-2 px-4 rounded {{ request()->routeIs('dashboard.users*') ? 'bg-gray-700' : '' }}">
            المستخدمون
        </a>
    </nav>
</div>
```

**Dashboard Page:**
```blade
@extends('layouts.dashboard')

@section('title', 'الرئيسية')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <x-stat-card
            title="إجمالي المقالات"
            :value="$totalPosts"
            icon="📝"
            color="blue"
        />

        <x-stat-card
            title="إجمالي المستخدمين"
            :value="$totalUsers"
            icon="👥"
            color="green"
        />

        <x-stat-card
            title="المشاهدات"
            :value="$totalViews"
            icon="👁"
            color="purple"
        />

        <x-stat-card
            title="التعليقات"
            :value="$totalComments"
            icon="💬"
            color="orange"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Posts -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">أحدث المقالات</h3>
            @forelse($recentPosts as $post)
                <div class="flex items-center justify-between py-3 border-b">
                    <div>
                        <h4 class="font-semibold">{{ $post->title }}</h4>
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="text-sm text-gray-600">{{ $post->views }} مشاهدة</span>
                </div>
            @empty
                <p class="text-gray-500">لا توجد مقالات</p>
            @endforelse
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">أحدث المستخدمين</h3>
            @each('dashboard.partials.user-item', $recentUsers, 'user', 'dashboard.partials.no-users')
        </div>
    </div>
@endsection
```

---

## ملخص الأمثلة

✅ **30+ مثال عملي** يغطي جميع جوانب Blade
✅ **من الأساسيات إلى المتقدم**
✅ **أمثلة واقعية** يمكن استخدامها في المشاريع
✅ **Best Practices** مطبقة في جميع الأمثلة

---

**الخطوة التالية:** انتقل إلى **التمارين العملية** لتطبيق ما تعلمته! 🚀
