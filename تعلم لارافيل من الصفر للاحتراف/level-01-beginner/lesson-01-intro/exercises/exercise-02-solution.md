# حل التمرين 2: إنشاء Views و Layout
# Exercise 2 Solution

---

## 💻 الحل الكامل

### 1. Layout: `resources/views/layouts/app.blade.php`

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'متجري')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        nav { background: #333; color: white; padding: 15px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        footer { background: #f4f4f4; padding: 20px; text-align: center; margin-top: 40px; }
        .product-card { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .price { color: #28a745; font-weight: bold; font-size: 18px; }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <a href="/">الرئيسية</a>
            <a href="/products">المنتجات</a>
            <a href="/cart">سلة المشتريات</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2025 متجري - جميع الحقوق محفوظة</p>
    </footer>
</body>
</html>
```

### 2. Home: `resources/views/home.blade.php`

```blade
@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <h1>مرحباً بك في متجرنا الإلكتروني!</h1>
    <p>نقدم لك أفضل المنتجات بأسعار منافسة</p>

    <h2>مميزات متجرنا:</h2>
    <ul>
        <li>شحن مجاني للطلبات فوق 500 ريال</li>
        <li>ضمان استرجاع المنتج خلال 14 يوم</li>
        <li>دعم فني متوفر 24/7</li>
    </ul>
@endsection
```

### 3. Products: `resources/views/products.blade.php`

```blade
@extends('layouts.app')

@section('title', 'المنتجات')

@section('content')
    <h1>منتجاتنا</h1>

    @forelse($products as $product)
        <div class="product-card">
            <h3>{{ $product['name'] }}</h3>
            <p class="price">{{ $product['price'] }} ريال</p>
            <p>{{ $product['description'] }}</p>
        </div>
    @empty
        <p>لا توجد منتجات حالياً</p>
    @endforelse
@endsection
```

### 4. Cart: `resources/views/cart.blade.php`

```blade
@extends('layouts.app')

@section('title', 'سلة المشتريات')

@section('content')
    <h1>سلة المشتريات</h1>

    @if(count($cartItems) > 0)
        @php($total = 0)

        @foreach($cartItems as $item)
            <div class="product-card">
                <h3>{{ $item['name'] }}</h3>
                <p>السعر: {{ $item['price'] }} ريال</p>
                <p>الكمية: {{ $item['quantity'] }}</p>
                <p class="price">المجموع: {{ $item['price'] * $item['quantity'] }} ريال</p>
            </div>
            @php($total += $item['price'] * $item['quantity'])
        @endforeach

        <h2>المجموع الكلي: <span class="price">{{ $total }} ريال</span></h2>
    @else
        <p>سلة المشتريات فارغة</p>
    @endif
@endsection
```

### 5. Routes: `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/products', function () {
    $products = [
        ['id' => 1, 'name' => 'لابتوب HP', 'price' => 3000, 'description' => 'لابتوب قوي للعمل'],
        ['id' => 2, 'name' => 'هاتف Samsung', 'price' => 2000, 'description' => 'هاتف ذكي حديث'],
        ['id' => 3, 'name' => 'سماعات Sony', 'price' => 500, 'description' => 'سماعات عالية الجودة'],
    ];

    return view('products', compact('products'));
});

Route::get('/cart', function () {
    $cartItems = [
        ['name' => 'لابتوب HP', 'price' => 3000, 'quantity' => 1],
        ['name' => 'سماعات Sony', 'price' => 500, 'quantity' => 2],
    ];

    return view('cart', compact('cartItems'));
});
```

---

## 📖 شرح الحل

### استخدام @extends و @yield

```blade
{{-- في Layout --}}
@yield('content')

{{-- في View --}}
@extends('layouts.app')
@section('content')
    المحتوى هنا
@endsection
```

### استخدام @forelse

```blade
@forelse($items as $item)
    {{ $item }}
@empty
    لا توجد عناصر
@endforelse
```

أفضل من `@foreach` لأنه يتعامل مع الحالة الفارغة تلقائياً.

### حساب المجموع

```blade
@php($total = 0)
@foreach($items as $item)
    @php($total += $item['price'])
@endforeach
<p>المجموع: {{ $total }}</p>
```

---

**مبروك! 🎉**
