# دليل التطبيق العملي للدرس الرابع

## 🚀 كيفية تشغيل المشروع

```bash
cd D:\learnlaravel2025\lessons\lesson-04\practice-app
php artisan serve
```

الخادم سيعمل على: `http://localhost:8000`

---

## 📋 المسارات والصفحات المتاحة

### 1. الصفحات الأساسية
- **GET** `/` - الصفحة الرئيسية (مع Layout)
- **GET** `/about` - من نحن
- **GET** `/services` - خدماتنا

### 2. أمثلة Blade
- **GET** `/blade/conditionals` - أمثلة الشروط
- **GET** `/blade/loops` - أمثلة الحلقات
- **GET** `/blade/components` - أمثلة المكونات

### 3. المنتجات
- **GET** `/products` - قائمة المنتجات (مع Components)
- **GET** `/products/{id}` - تفاصيل منتج

### 4. النماذج
- **GET** `/contact` - نموذج اتصل بنا
- **POST** `/contact` - إرسال النموذج

---

## ✅ الملفات المنفذة

### 1. Layout الرئيسي

**ملف `resources/views/layouts/app.blade.php`:**

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'موقعي')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        nav { background: #667eea; padding: 15px; }
        nav a { color: white; margin: 0 10px; text-decoration: none; }
        footer { background: #333; color: white; text-align: center; padding: 20px; margin-top: 50px; }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
```

---

### 2. Navbar (Partial)

**ملف `resources/views/partials/navbar.blade.php`:**

```blade
<nav>
    <a href="/">الرئيسية</a>
    <a href="/about">من نحن</a>
    <a href="/services">خدماتنا</a>
    <a href="/products">المنتجات</a>
    <a href="/contact">اتصل بنا</a>
</nav>
```

---

### 3. الصفحة الرئيسية

**ملف `resources/views/home.blade.php`:**

```blade
@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <h1>مرحباً بك في الدرس الرابع - Blade Templates</h1>

    <p>هذا مثال على استخدام Layout مع @extends و @section</p>

    <x-alert type="success">
        تم تحميل الصفحة بنجاح!
    </x-alert>

    <h2>المميزات</h2>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        <x-card title="التخطيطات">
            استخدام Layouts لإعادة استخدام الهيكل
        </x-card>

        <x-card title="المكونات">
            Components قابلة لإعادة الاستخدام
        </x-card>

        <x-card title="التوجيهات">
            Directives قوية ومرنة
        </x-card>
    </div>
@endsection
```

---

### 4. Component: Alert

**ملف `resources/views/components/alert.blade.php`:**

```blade
@props(['type' => 'info'])

<div style="padding: 15px; margin: 15px 0; border-radius: 5px;
    @if($type == 'success') background: #d4edda; color: #155724; border: 1px solid #c3e6cb;
    @elseif($type == 'danger') background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;
    @elseif($type == 'warning') background: #fff3cd; color: #856404; border: 1px solid #ffeaa7;
    @else background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb;
    @endif">
    {{ $slot }}
</div>
```

**الاستخدام:**
```blade
<x-alert type="success">تم بنجاح!</x-alert>
<x-alert type="danger">حدث خطأ!</x-alert>
```

---

### 5. Component: Card

**ملف `resources/views/components/card.blade.php`:**

```blade
@props(['title'])

<div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <h3 style="margin-top: 0; color: #667eea;">{{ $title }}</h3>
    <div>
        {{ $slot }}
    </div>
</div>
```

---

### 6. صفحة الشروط

**ملف `resources/views/blade/conditionals.blade.php`:**

```blade
@extends('layouts.app')

@section('title', 'أمثلة الشروط')

@section('content')
    <h1>أمثلة الشروط في Blade</h1>

    <h2>1. @if & @else</h2>
    @php $score = 85; @endphp

    @if($score >= 90)
        <x-alert type="success">ممتاز!</x-alert>
    @elseif($score >= 70)
        <x-alert type="info">جيد جداً</x-alert>
    @else
        <x-alert type="warning">يحتاج تحسين</x-alert>
    @endif

    <h2>2. @auth & @guest</h2>
    @guest
        <x-alert type="warning">أنت غير مسجل دخول</x-alert>
    @endguest

    <h2>3. @isset & @empty</h2>
    @php $username = 'أحمد'; @endphp

    @isset($username)
        <p>اسم المستخدم: {{ $username }}</p>
    @endisset

    @php $items = []; @endphp

    @empty($items)
        <x-alert type="info">القائمة فارغة</x-alert>
    @endempty
@endsection
```

---

### 7. صفحة الحلقات

**ملف `resources/views/blade/loops.blade.php`:**

```blade
@extends('layouts.app')

@section('title', 'أمثلة الحلقات')

@section('content')
    <h1>أمثلة الحلقات في Blade</h1>

    <h2>1. @foreach مع $loop</h2>
    @php
        $products = [
            ['name' => 'لابتوب', 'price' => 5000],
            ['name' => 'هاتف', 'price' => 3000],
            ['name' => 'تابلت', 'price' => 2000],
        ];
    @endphp

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>التكرار</th>
                <th>المنتج</th>
                <th>السعر</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr style="{{ $loop->even ? 'background: #f9f9f9;' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $product['name'] }}
                    @if($loop->first)
                        <span style="color: green;">⭐ جديد</span>
                    @endif
                </td>
                <td>{{ $product['price'] }} ريال</td>
                <td>
                    @if($loop->last)
                        آخر منتج
                    @else
                        متبقي: {{ $loop->remaining }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>2. @forelse</h2>
    @php $emptyList = []; @endphp

    <ul>
    @forelse($emptyList as $item)
        <li>{{ $item }}</li>
    @empty
        <li><x-alert type="info">لا توجد عناصر في القائمة</x-alert></li>
    @endforelse
    </ul>
@endsection
```

---

### 8. صفحة المنتجات

**ملف `resources/views/products/index.blade.php`:**

```blade
@extends('layouts.app')

@section('title', 'المنتجات')

@section('content')
    <h1>قائمة المنتجات</h1>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        @forelse($products as $product)
            <x-card title="{{ $product['name'] }}">
                <p><strong>السعر:</strong> {{ $product['price'] }} ريال</p>
                <p><strong>المخزون:</strong> {{ $product['stock'] }}</p>

                @if($product['stock'] > 0)
                    <x-alert type="success">متوفر</x-alert>
                @else
                    <x-alert type="danger">غير متوفر</x-alert>
                @endif

                <a href="/products/{{ $product['id'] }}" style="color: #667eea;">عرض التفاصيل</a>
            </x-card>
        @empty
            <p>لا توجد منتجات</p>
        @endforelse
    </div>
@endsection
```

---

### 9. نموذج اتصل بنا

**ملف `resources/views/contact.blade.php`:**

```blade
@extends('layouts.app')

@section('title', 'اتصل بنا')

@section('content')
    <h1>نموذج الاتصال</h1>

    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    <form method="POST" action="/contact" style="max-width: 600px;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>الاسم:</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            @error('name')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            @error('email')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>الرسالة:</label>
            <textarea name="message" rows="5"
                      style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('message') }}</textarea>
            @error('message')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                style="background: #667eea; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            إرسال
        </button>
    </form>
@endsection
```

---

## 🎯 ما تعلمناه

### 1. التخطيطات (Layouts)
- ✅ إنشاء Layout رئيسي مع `@extends`
- ✅ استخدام `@section` و `@yield`
- ✅ `@stack` و `@push` للـ CSS/JS

### 2. المكونات (Components)
- ✅ إنشاء Components قابلة لإعادة الاستخدام
- ✅ استخدام `@props` للخصائص
- ✅ `{{ $slot }}` للمحتوى

### 3. الشروط والحلقات
- ✅ `@if`, `@foreach`, `@forelse`
- ✅ استخدام `$loop` للحصول على معلومات التكرار
- ✅ `@auth`, `@guest` للتحقق من المستخدم

### 4. النماذج
- ✅ `@csrf` للحماية
- ✅ `@error` لعرض أخطاء التحقق
- ✅ `old()` للحفاظ على القيم

---

## 📝 أوامر مفيدة

```bash
# إنشاء Component
php artisan make:component Alert

# إنشاء Component مع Class
php artisan make:component Button --class

# مسح cache الـ Views
php artisan view:clear

# تشغيل الخادم
php artisan serve
```

---

## 🔍 اختبار الصفحات

1. ✅ `http://localhost:8000/` - الصفحة الرئيسية
2. ✅ `http://localhost:8000/blade/conditionals` - أمثلة الشروط
3. ✅ `http://localhost:8000/blade/loops` - أمثلة الحلقات
4. ✅ `http://localhost:8000/products` - قائمة المنتجات
5. ✅ `http://localhost:8000/contact` - نموذج الاتصال

---

## 💡 نصائح

1. **استخدم Layouts** لإعادة استخدام الهيكل العام
2. **Components** مفيدة للعناصر المتكررة
3. **@forelse** أفضل من @foreach عند وجود قائمة قد تكون فارغة
4. **لا تنسَ @csrf** في جميع النماذج
5. **استخدم @error** لعرض رسائل الخطأ

---

## 📚 الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 5**: قواعد البيانات والـ Migrations
- إنشاء قواعد البيانات
- Migrations
- Schema Builder

---

**تعلم سعيد! 🚀**
