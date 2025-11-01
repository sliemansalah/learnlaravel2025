@extends('layouts.app')

@section('title', 'Home - Laravel Lesson 3')

@section('content')
<div class="card text-center">
    <h1>{{ $title }}</h1>
    <h2>{{ $subtitle }}</h2>

    <p style="margin-top: 2rem; font-size: 1.1rem; color: #555;">
        مرحباً بك في الدرس الثالث عن Controllers و MVC Pattern
    </p>
    <p style="font-size: 1.1rem; color: #555;">
        Welcome to Lesson 3 about Controllers and MVC Pattern
    </p>

    <div style="margin-top: 3rem;">
        <h3>What you'll learn / ماذا ستتعلم:</h3>
        <ul style="list-style: none; padding: 0; margin-top: 1rem;">
            <li style="margin: 0.5rem 0;">✓ Creating Controllers / إنشاء Controllers</li>
            <li style="margin: 0.5rem 0;">✓ Resource Controllers / Resource Controllers</li>
            <li style="margin: 0.5rem 0;">✓ Single Action Controllers / Single Action Controllers</li>
            <li style="margin: 0.5rem 0;">✓ MVC Pattern / نمط MVC</li>
            <li style="margin: 0.5rem 0;">✓ Passing Data to Views / تمرير البيانات للعرض</li>
        </ul>
    </div>

    <div class="flex" style="justify-content: center; margin-top: 2rem;">
        <a href="{{ route('products.index') }}" class="btn">View Products / عرض المنتجات</a>
        <a href="{{ route('dashboard') }}" class="btn btn-success">Dashboard / لوحة التحكم</a>
    </div>
</div>
@endsection
