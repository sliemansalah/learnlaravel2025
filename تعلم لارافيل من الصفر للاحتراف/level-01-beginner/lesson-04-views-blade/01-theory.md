# الدرس الرابع: Views و Blade Templates في Laravel

## 📚 المحتويات

1. [مقدمة عن Views](#مقدمة-عن-views)
2. [Blade Template Engine](#blade-template-engine)
3. [Blade Syntax الأساسي](#blade-syntax-الأساسي)
4. [Blade Directives](#blade-directives)
5. [Layouts و Sections](#layouts-و-sections)
6. [Components](#components)
7. [Including Views](#including-views)
8. [Passing Data to Views](#passing-data-to-views)
9. [View Composers](#view-composers)
10. [Best Practices](#best-practices)

---

## مقدمة عن Views

### ما هي Views؟

**Views** هي الطبقة المسؤولة عن عرض المحتوى للمستخدم في نمط MVC. تحتوي على HTML و CSS و JavaScript اللازم لعرض البيانات.

### لماذا نستخدم Views؟

```
✅ فصل المنطق عن العرض (Separation of Concerns)
✅ إعادة استخدام الكود (Code Reusability)
✅ سهولة الصيانة (Easy Maintenance)
✅ تنظيم أفضل للمشروع (Better Organization)
```

### موقع Views في Laravel

```
resources/
└── views/
    ├── welcome.blade.php
    ├── home.blade.php
    └── layouts/
        └── app.blade.php
```

### إنشاء View بسيط

**في Controller:**
```php
public function index()
{
    return view('welcome');
}
```

**في الـ Route:**
```php
Route::get('/', function () {
    return view('welcome');
});
```

---

## Blade Template Engine

### ما هو Blade؟

**Blade** هو محرك القوالب (Template Engine) الخاص بـ Laravel. يوفر:

- ✅ Syntax سهل وواضح
- ✅ Template Inheritance (الوراثة)
- ✅ Components قابلة لإعادة الاستخدام
- ✅ Performance عالي (يتم تحويل Blade إلى PHP)
- ✅ لا يمنعك من استخدام PHP العادي

### امتداد ملفات Blade

```
اسم_الملف.blade.php
```

مثال:
```
home.blade.php
posts/index.blade.php
layouts/app.blade.php
```

### مميزات Blade

| الميزة | الوصف |
|--------|--------|
| **Clean Syntax** | Syntax نظيف وسهل القراءة |
| **Template Inheritance** | يمكن وراثة layouts |
| **Components** | إنشاء مكونات قابلة لإعادة الاستخدام |
| **No Performance Overhead** | يتم compile إلى PHP عادي |
| **Automatic Escaping** | حماية تلقائية من XSS |

---

## Blade Syntax الأساسي

### 1. عرض البيانات (Displaying Data)

#### Echo مع Escaping (حماية من XSS)

```blade
{{ $name }}
{{ $user->name }}
{{ $post['title'] }}
```

يتم تحويلها إلى:
```php
<?php echo htmlspecialchars($name); ?>
```

#### Echo بدون Escaping

```blade
{!! $htmlContent !!}
```

⚠️ **تحذير:** استخدم فقط مع البيانات الموثوقة!

### 2. التعليقات (Comments)

```blade
{{-- هذا تعليق في Blade --}}
{{--
    تعليق متعدد
    الأسطر
--}}
```

لن تظهر في HTML النهائي.

### 3. استخدام PHP في Blade

```blade
@php
    $count = 0;
    $total = 100;
@endphp

{{ $count }} / {{ $total }}
```

---

## Blade Directives

### 1. Control Structures

#### @if, @elseif, @else

```blade
@if ($user->role === 'admin')
    <p>مرحباً أيها المدير</p>
@elseif ($user->role === 'editor')
    <p>مرحباً أيها المحرر</p>
@else
    <p>مرحباً أيها المستخدم</p>
@endif
```

#### @unless (عكس if)

```blade
@unless ($user->isPremium())
    <div class="ad">إعلان</div>
@endunless
```

يعادل:
```blade
@if (!$user->isPremium())
    <div class="ad">إعلان</div>
@endif
```

#### @isset, @empty

```blade
@isset($name)
    <p>الاسم: {{ $name }}</p>
@endisset

@empty($posts)
    <p>لا توجد مقالات</p>
@endempty
```

#### @auth, @guest

```blade
@auth
    <a href="/profile">الملف الشخصي</a>
@endauth

@guest
    <a href="/login">تسجيل الدخول</a>
@endguest
```

مع Guard محدد:
```blade
@auth('admin')
    <a href="/admin/dashboard">لوحة التحكم</a>
@endauth
```

### 2. Loops

#### @foreach

```blade
@foreach ($posts as $post)
    <div class="post">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    </div>
@endforeach
```

#### $loop Variable

```blade
@foreach ($posts as $post)
    <div class="post-{{ $loop->index }}">
        @if ($loop->first)
            <span>أول عنصر</span>
        @endif

        <h2>{{ $post->title }}</h2>

        العنصر {{ $loop->iteration }} من {{ $loop->count }}

        @if ($loop->last)
            <span>آخر عنصر</span>
        @endif
    </div>
@endforeach
```

**$loop Properties:**

| Property | الوصف |
|----------|--------|
| `$loop->index` | Index الحالي (يبدأ من 0) |
| `$loop->iteration` | التكرار الحالي (يبدأ من 1) |
| `$loop->remaining` | العناصر المتبقية |
| `$loop->count` | إجمالي عدد العناصر |
| `$loop->first` | هل هو أول عنصر؟ |
| `$loop->last` | هل هو آخر عنصر؟ |
| `$loop->even` | هل رقم التكرار زوجي؟ |
| `$loop->odd` | هل رقم التكرار فردي؟ |
| `$loop->depth` | مستوى التداخل |
| `$loop->parent` | الـ loop الأب في حالة التداخل |

#### @forelse (foreach مع else)

```blade
@forelse ($posts as $post)
    <div class="post">
        <h2>{{ $post->title }}</h2>
    </div>
@empty
    <p>لا توجد مقالات لعرضها</p>
@endforelse
```

#### @for

```blade
@for ($i = 0; $i < 10; $i++)
    <p>العدد: {{ $i }}</p>
@endfor
```

#### @while

```blade
@while ($count < 100)
    <p>{{ $count }}</p>
    @php $count++; @endphp
@endwhile
```

#### @break, @continue

```blade
@foreach ($posts as $post)
    @if ($post->draft)
        @continue
    @endif

    <div>{{ $post->title }}</div>

    @if ($loop->iteration === 10)
        @break
    @endif
@endforeach
```

مع شرط:
```blade
@foreach ($posts as $post)
    @continue($post->draft)
    @break($loop->iteration === 10)

    <div>{{ $post->title }}</div>
@endforeach
```

### 3. Switch Statement

```blade
@switch($user->role)
    @case('admin')
        <p>صلاحيات المدير</p>
        @break

    @case('editor')
        <p>صلاحيات المحرر</p>
        @break

    @default
        <p>صلاحيات المستخدم</p>
@endswitch
```

---

## Layouts و Sections

### المفهوم

**Layouts** تسمح لك بإنشاء قالب رئيسي ثم "توريثه" في صفحات أخرى.

### إنشاء Layout رئيسي

**resources/views/layouts/app.blade.php:**

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'الموقع الافتراضي')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header>
        @include('layouts.header')
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        @include('layouts.footer')
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
```

### استخدام Layout في View

**resources/views/posts/index.blade.php:**

```blade
@extends('layouts.app')

@section('title', 'قائمة المقالات')

@section('content')
    <div class="container">
        <h1>جميع المقالات</h1>

        @forelse ($posts as $post)
            <article>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->excerpt }}</p>
            </article>
        @empty
            <p>لا توجد مقالات</p>
        @endforelse
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endpush
```

### الفرق بين @yield و @section

#### @yield

```blade
{{-- في الـ layout --}}
@yield('content')
@yield('title', 'Default Title')

{{-- في الـ view --}}
@section('content', 'المحتوى هنا')
```

- يُستخدم لمحتوى بسيط
- يمكن تحديد قيمة افتراضية
- لا يمكن استخدام @parent

#### @section...@endsection

```blade
{{-- في الـ layout --}}
@section('sidebar')
    <div>Sidebar الافتراضي</div>
@show

{{-- في الـ view --}}
@section('sidebar')
    @parent
    <div>محتوى إضافي</div>
@endsection
```

- يُستخدم لمحتوى معقد
- يدعم @parent لإضافة المحتوى
- @show في Layout، @endsection في View

### @stack و @push

#### استخدام @stack

في الـ layout:
```blade
<head>
    @stack('styles')
</head>
<body>
    @stack('scripts')
</body>
```

في الـ views:
```blade
@push('styles')
    <link rel="stylesheet" href="custom.css">
@endpush

@push('scripts')
    <script src="custom.js"></script>
@endpush
```

#### @prepend (الإضافة في البداية)

```blade
@prepend('scripts')
    <script src="first.js"></script>
@endprepend
```

---

## Components

### المفهوم

**Components** هي قطع قابلة لإعادة الاستخدام من الـ UI.

### أنواع Components

1. **Anonymous Components** (بدون class)
2. **Class-based Components** (مع class)

### 1. Anonymous Components

#### إنشاء Component

**resources/views/components/alert.blade.php:**

```blade
<div class="alert alert-{{ $type }}">
    <strong>{{ $title }}</strong>
    <p>{{ $slot }}</p>
</div>
```

#### استخدام Component

```blade
<x-alert type="success" title="نجاح">
    تم حفظ البيانات بنجاح!
</x-alert>
```

### 2. Class-based Components

#### إنشاء Component

```bash
php artisan make:component Alert
```

**app/View/Components/Alert.php:**

```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $title;

    public function __construct($type = 'info', $title = '')
    {
        $this->type = $type;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.alert');
    }
}
```

**resources/views/components/alert.blade.php:**

```blade
<div class="alert alert-{{ $type }}">
    @if ($title)
        <strong>{{ $title }}</strong>
    @endif
    <div>{{ $slot }}</div>
</div>
```

### Component Slots

#### Named Slots

**Component:**
```blade
{{-- resources/views/components/card.blade.php --}}
<div class="card">
    <div class="card-header">
        {{ $header }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer">
        {{ $footer }}
    </div>
</div>
```

**استخدام:**
```blade
<x-card>
    <x-slot name="header">
        <h3>عنوان البطاقة</h3>
    </x-slot>

    محتوى البطاقة الرئيسي

    <x-slot name="footer">
        <button>إجراء</button>
    </x-slot>
</x-card>
```

### Component Attributes

```blade
{{-- Component --}}
<div {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $slot }}
</div>

{{-- استخدام --}}
<x-button class="btn-primary" id="submit-btn">
    إرسال
</x-button>

{{-- النتيجة --}}
<div class="btn btn-primary" id="submit-btn">
    إرسال
</div>
```

#### Conditional Classes

```blade
<div @class([
    'btn',
    'btn-primary' => $primary,
    'btn-large' => $large,
])>
    {{ $slot }}
</div>
```

---

## Including Views

### @include

#### Include بسيط

```blade
@include('partials.header')
```

#### Include مع بيانات

```blade
@include('partials.post', ['post' => $post])
```

#### Include مع شرط

```blade
@includeIf('partials.sidebar')
@includeWhen($showSidebar, 'partials.sidebar')
@includeUnless($hideSidebar, 'partials.sidebar')
```

#### Include أول View موجود

```blade
@includeFirst(['partials.custom-header', 'partials.header'])
```

### @each

لعرض view لكل عنصر في array:

```blade
@each('partials.post-card', $posts, 'post', 'partials.no-posts')
```

المعاملات:
1. اسم الـ view
2. الـ array
3. اسم المتغير لكل عنصر
4. View في حالة الـ array فارغ

---

## Passing Data to Views

### 1. من Controller

#### طريقة Array

```php
return view('posts.index', [
    'posts' => $posts,
    'title' => 'جميع المقالات'
]);
```

#### طريقة compact()

```php
$posts = Post::all();
$title = 'جميع المقالات';

return view('posts.index', compact('posts', 'title'));
```

#### طريقة with()

```php
return view('posts.index')
    ->with('posts', $posts)
    ->with('title', 'جميع المقالات');
```

### 2. مشاركة بيانات مع جميع Views

#### في Service Provider

**app/Providers/AppServiceProvider.php:**

```php
use Illuminate\Support\Facades\View;

public function boot()
{
    View::share('siteName', 'موقعي الرائع');

    // أو
    View::composer('*', function ($view) {
        $view->with('siteName', 'موقعي الرائع');
    });
}
```

الآن يمكن استخدام `{{ $siteName }}` في أي view.

---

## View Composers

### المفهوم

**View Composers** تسمح لك بربط بيانات مع view معين في كل مرة يتم عرضه.

### إنشاء View Composer

#### 1. Using Closure

**في AppServiceProvider:**

```php
use Illuminate\Support\Facades\View;

public function boot()
{
    View::composer('posts.*', function ($view) {
        $view->with('categories', Category::all());
    });
}
```

#### 2. Using Class

**إنشاء Composer Class:**

```bash
php artisan make:provider ViewServiceProvider
```

**app/Http/View/Composers/PostComposer.php:**

```php
<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class PostComposer
{
    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}
```

**تسجيل في Service Provider:**

```php
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\PostComposer;

public function boot()
{
    View::composer('posts.*', PostComposer::class);

    // أو لعدة views
    View::composer(
        ['posts.create', 'posts.edit'],
        PostComposer::class
    );
}
```

### View Creators

مشابه لـ View Composers لكن يتم تنفيذه فور إنشاء الـ view:

```php
View::creator('posts.*', PostCreator::class);
```

---

## Best Practices

### ✅ 1. تنظيم الملفات

```
resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── guest.blade.php
│   └── admin.blade.php
├── components/
│   ├── alert.blade.php
│   ├── button.blade.php
│   └── card.blade.php
├── partials/
│   ├── header.blade.php
│   ├── footer.blade.php
│   └── sidebar.blade.php
├── posts/
│   ├── index.blade.php
│   ├── show.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── users/
    ├── index.blade.php
    └── profile.blade.php
```

### ✅ 2. استخدام Components للكود المتكرر

بدلاً من:
```blade
{{-- تكرار في كل صفحة --}}
<div class="alert alert-success">
    <strong>نجاح!</strong> {{ $message }}
</div>
```

استخدم:
```blade
<x-alert type="success" :message="$message" />
```

### ✅ 3. استخدام @forelse بدلاً من @foreach + @if

❌ **سيئ:**
```blade
@if (count($posts) > 0)
    @foreach ($posts as $post)
        <div>{{ $post->title }}</div>
    @endforeach
@else
    <p>لا توجد مقالات</p>
@endif
```

✅ **جيد:**
```blade
@forelse ($posts as $post)
    <div>{{ $post->title }}</div>
@empty
    <p>لا توجد مقالات</p>
@endforelse
```

### ✅ 4. استخدام @auth بدلاً من التحقق اليدوي

❌ **سيئ:**
```blade
@if (auth()->check())
    <a href="/profile">الملف الشخصي</a>
@endif
```

✅ **جيد:**
```blade
@auth
    <a href="/profile">الملف الشخصي</a>
@endauth
```

### ✅ 5. استخدام Named Slots للوضوح

❌ **سيئ:**
```blade
<x-card>
    <h3>العنوان</h3>
    <p>المحتوى</p>
    <button>زر</button>
</x-card>
```

✅ **جيد:**
```blade
<x-card>
    <x-slot name="header">
        <h3>العنوان</h3>
    </x-slot>

    <p>المحتوى</p>

    <x-slot name="footer">
        <button>زر</button>
    </x-slot>
</x-card>
```

### ✅ 6. حماية من XSS

```blade
{{-- آمن - يتم escape تلقائياً --}}
{{ $userInput }}

{{-- غير آمن - استخدم فقط مع محتوى موثوق --}}
{!! $trustedHtml !!}
```

### ✅ 7. استخدام asset() للـ Assets

```blade
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
<img src="{{ asset('images/logo.png') }}" alt="Logo">
```

### ✅ 8. استخدام old() للـ Form Values

```blade
<input type="text" name="title" value="{{ old('title', $post->title) }}">
```

### ✅ 9. عرض Validation Errors

```blade
@error('title')
    <div class="error">{{ $message }}</div>
@enderror

{{-- أو --}}
@if ($errors->has('title'))
    <div class="error">{{ $errors->first('title') }}</div>
@endif
```

### ✅ 10. استخدام @once

عندما تريد تنفيذ كود مرة واحدة فقط:

```blade
@once
    @push('styles')
        <link rel="stylesheet" href="custom.css">
    @endpush
@endonce
```

---

## ملخص الدرس

### ما تعلمناه:

✅ **Views**: مسؤولة عن عرض المحتوى للمستخدم
✅ **Blade**: محرك القوالب في Laravel
✅ **Blade Syntax**: `{{ }}` للعرض، `{{-- --}}` للتعليقات
✅ **Directives**: @if, @foreach, @forelse, @auth, etc.
✅ **Layouts**: استخدام @extends و @section
✅ **Components**: قطع قابلة لإعادة الاستخدام
✅ **Including**: @include لإدراج views أخرى
✅ **Data Passing**: طرق متعددة لتمرير البيانات
✅ **View Composers**: ربط بيانات مع views
✅ **Best Practices**: أفضل الممارسات

### الدوال والـ Directives المهمة:

```blade
{{-- عرض البيانات --}}
{{ $variable }}
{!! $html !!}

{{-- Control Structures --}}
@if, @elseif, @else, @endif
@unless, @endunless
@isset, @endisset
@empty, @endempty
@auth, @guest, @endauth, @endguest

{{-- Loops --}}
@foreach, @endforeach
@forelse, @empty, @endforelse
@for, @endfor
@while, @endwhile
@break, @continue

{{-- Layouts --}}
@extends('layout')
@section('name')...@endsection
@yield('name')
@stack('name')
@push('name')...@endpush

{{-- Components --}}
<x-component-name />
{{ $slot }}
<x-slot name="name">

{{-- Including --}}
@include('view')
@includeIf('view')
@includeWhen($condition, 'view')

{{-- Other --}}
@csrf
@method('PUT')
@error('field')
@once
```

---

## الخطوة التالية 🚀

بعد إتمام هذا الدرس، انتقل إلى:
- **التطبيق العملي** (`02-practice.md`)
- **أمثلة الكود** (`03-code-examples.md`)
- **التمارين** (`04-exercises.md`)
- **الاختبار** (`05-exam-with-answers.md`)

---

**تهانينا! 🎉 أنت الآن تفهم Views و Blade في Laravel!**
