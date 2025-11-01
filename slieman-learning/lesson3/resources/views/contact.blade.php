@extends('layouts.app')

@section('title', 'Contact - Laravel Lesson 3')

@section('content')
<div class="card">
    <h1>Contact Us</h1>
    <h2>اتصل بنا</h2>

    <div style="margin-top: 2rem;">
        <p><strong>Email:</strong> student@example.com</p>
        <p><strong>البريد الإلكتروني:</strong> student@example.com</p>
    </div>

    <div style="margin-top: 2rem;">
        <p>This is a simple static contact page demonstrating a basic controller method.</p>
        <p>هذه صفحة اتصال ثابتة بسيطة توضح طريقة controller أساسية.</p>
    </div>

    <div style="margin-top: 2rem;">
        <p><em>Note: In a real application, this would include a contact form.</em></p>
        <p><em>ملاحظة: في تطبيق حقيقي، ستتضمن هذه الصفحة نموذج اتصال.</em></p>
    </div>
</div>
@endsection
