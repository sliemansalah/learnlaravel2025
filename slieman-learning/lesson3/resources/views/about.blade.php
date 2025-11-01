@extends('layouts.app')

@section('title', 'About - Laravel Lesson 3')

@section('content')
<div class="card">
    <h1>About This Project</h1>
    <h2>حول هذا المشروع</h2>

    <div style="margin-top: 2rem;">
        <h3>English:</h3>
        <p>This is a practice project for Laravel Lesson 3, focusing on Controllers and the MVC pattern.</p>
        <p>You will learn how to create different types of controllers and how they interact with routes and views.</p>

        <h3 style="margin-top: 2rem;">العربية:</h3>
        <p>هذا مشروع تطبيقي للدرس الثالث من Laravel، يركز على Controllers ونمط MVC.</p>
        <p>ستتعلم كيفية إنشاء أنواع مختلفة من Controllers وكيف تتفاعل مع المسارات والعروض.</p>
    </div>

    <div style="margin-top: 2rem;">
        <h3>Topics Covered / المواضيع المشمولة:</h3>
        <ul>
            <li>Basic Controllers / Controllers الأساسية</li>
            <li>Resource Controllers (CRUD) / Controllers الموارد</li>
            <li>Single Action Controllers / Controllers بوظيفة واحدة</li>
            <li>Dependency Injection / حقن التبعيات</li>
            <li>Request Handling / معالجة الطلبات</li>
        </ul>
    </div>
</div>
@endsection
