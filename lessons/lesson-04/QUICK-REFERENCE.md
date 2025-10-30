# الدرس 4 - بطاقة مرجعية سريعة

## 📝 عرض البيانات

```blade
{{-- عرض آمن (مع Escape) --}}
{{ $variable }}

{{-- عرض خام (بدون Escape) - خطر --}}
{!! $htmlContent !!}

{{-- قيمة افتراضية --}}
{{ $name ?? 'Guest' }}

{{-- تعليق Blade --}}
{{-- هذا تعليق لن يظهر --}}
```

---

## 🔀 الشروط

```blade
@if($condition)
    محتوى
@elseif($other)
    محتوى آخر
@else
    محتوى بديل
@endif

@unless($condition)
    عكس if
@endunless

@isset($var)
    إذا كان موجود
@endisset

@empty($var)
    إذا كان فارغ
@endempty

@auth
    مسجل دخول
@endauth

@guest
    زائر
@endguest
```

---

## 🔁 الحلقات

```blade
@foreach($items as $item)
    {{ $item->name }}
@endforeach

@forelse($items as $item)
    {{ $item->name }}
@empty
    لا توجد عناصر
@endforelse

@for($i = 0; $i < 10; $i++)
    {{ $i }}
@endfor

@while($condition)
    محتوى
@endwhile
```

### متغير $loop

```blade
$loop->index       {{-- 0, 1, 2... --}}
$loop->iteration   {{-- 1, 2, 3... --}}
$loop->first       {{-- أول عنصر؟ --}}
$loop->last        {{-- آخر عنصر؟ --}}
$loop->count       {{-- العدد الكلي --}}
$loop->remaining   {{-- المتبقي --}}
```

---

## 📐 التخطيطات Layouts

```blade
{{-- Layout: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @stack('styles')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>

{{-- الصفحة --}}
@extends('layouts.app')

@section('title', 'العنوان')

@section('content')
    <h1>المحتوى</h1>
@endsection

@push('scripts')
    <script>...</script>
@endpush
```

---

## 🧩 المكونات Components

```blade
{{-- تعريف Component: resources/views/components/alert.blade.php --}}
@props(['type' => 'info'])

<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>

{{-- الاستخدام --}}
<x-alert type="success">تم بنجاح!</x-alert>

{{-- مع Slots متعددة --}}
<x-modal title="العنوان">
    المحتوى الرئيسي

    <x-slot name="footer">
        محتوى Footer
    </x-slot>
</x-modal>
```

---

## 📦 التضمين Includes

```blade
@include('partials.header')

@include('partials.alert', ['type' => 'success'])

@includeIf('partials.sidebar')

@includeWhen($condition, 'partials.menu')

@includeUnless($condition, 'partials.guest')

@includeFirst(['custom', 'default'])
```

---

## 📝 الفورم Forms

```blade
<form method="POST" action="/posts">
    @csrf

    {{-- PUT/DELETE Method --}}
    @method('PUT')

    <input type="text" name="title" value="{{ old('title') }}">

    @error('title')
        <span>{{ $message }}</span>
    @enderror

    <button>إرسال</button>
</form>
```

---

## 💉 تمرير البيانات

```php
// من Controller
return view('home', compact('users', 'posts'));
return view('home', ['users' => $users]);
return view('home')->with('title', 'العنوان');

// View Composer (في AppServiceProvider)
View::composer('dashboard', function ($view) {
    $view->with('stats', Stats::get());
});

// مشاركة عامة
View::share('appName', 'موقعي');
```

---

## 🎨 توجيهات مفيدة

```blade
@switch($status)
    @case('active')
        نشط
        @break
    @default
        غير نشط
@endswitch

@php
    $total = 100;
@endphp

@verbatim
    {{ لن يعالج }}
@endverbatim

@json($array)

@continue
@break
```

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [الدرس التالي](../lesson-05/README.md)
