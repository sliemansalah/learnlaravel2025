# Lesson 4 - Quick Reference Card

## 📝 Displaying Data

```blade
{{-- Safe display (with Escaping) --}}
{{ $variable }}

{{-- Raw display (without Escaping) - Dangerous --}}
{!! $htmlContent !!}

{{-- Default value --}}
{{ $name ?? 'Guest' }}

{{-- Blade comment --}}
{{-- This comment won't appear --}}
```

---

## 🔀 Conditionals

```blade
@if($condition)
    Content
@elseif($other)
    Other content
@else
    Alternative content
@endif

@unless($condition)
    Opposite of if
@endunless

@isset($var)
    If exists
@endisset

@empty($var)
    If empty
@endempty

@auth
    Logged in
@endauth

@guest
    Guest
@endguest
```

---

## 🔁 Loops

```blade
@foreach($items as $item)
    {{ $item->name }}
@endforeach

@forelse($items as $item)
    {{ $item->name }}
@empty
    No items
@endforelse

@for($i = 0; $i < 10; $i++)
    {{ $i }}
@endfor

@while($condition)
    Content
@endwhile
```

### $loop Variable

```blade
$loop->index       {{-- 0, 1, 2... --}}
$loop->iteration   {{-- 1, 2, 3... --}}
$loop->first       {{-- First item? --}}
$loop->last        {{-- Last item? --}}
$loop->count       {{-- Total count --}}
$loop->remaining   {{-- Remaining --}}
```

---

## 📐 Layouts

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

{{-- Page --}}
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Content</h1>
@endsection

@push('scripts')
    <script>...</script>
@endpush
```

---

## 🧩 Components

```blade
{{-- Define Component: resources/views/components/alert.blade.php --}}
@props(['type' => 'info'])

<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>

{{-- Usage --}}
<x-alert type="success">Success!</x-alert>

{{-- Multiple Slots --}}
<x-modal title="Title">
    Main content

    <x-slot name="footer">
        Footer content
    </x-slot>
</x-modal>
```

---

## 📦 Includes

```blade
@include('partials.header')

@include('partials.alert', ['type' => 'success'])

@includeIf('partials.sidebar')

@includeWhen($condition, 'partials.menu')

@includeUnless($condition, 'partials.guest')

@includeFirst(['custom', 'default'])
```

---

## 📝 Forms

```blade
<form method="POST" action="/posts">
    @csrf

    {{-- PUT/DELETE Method --}}
    @method('PUT')

    <input type="text" name="title" value="{{ old('title') }}">

    @error('title')
        <span>{{ $message }}</span>
    @enderror

    <button>Submit</button>
</form>
```

---

## 💉 Passing Data

```php
// From Controller
return view('home', compact('users', 'posts'));
return view('home', ['users' => $users]);
return view('home')->with('title', 'Title');

// View Composer (in AppServiceProvider)
View::composer('dashboard', function ($view) {
    $view->with('stats', Stats::get());
});

// Global sharing
View::share('appName', 'My App');
```

---

## 🎨 Useful Directives

```blade
@switch($status)
    @case('active')
        Active
        @break
    @default
        Inactive
@endswitch

@php
    $total = 100;
@endphp

@verbatim
    {{ Won't be processed }}
@endverbatim

@json($array)

@continue
@break
```

---

## 🔗 Quick Links

- [Main Lesson](./README-EN.md)
- [Next Lesson](../lesson-05/README-EN.md)
