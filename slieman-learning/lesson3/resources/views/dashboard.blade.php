@extends('layouts.app')

@section('title', 'Dashboard - Laravel Lesson 3')

@section('content')
<div class="card">
    <h1>Dashboard</h1>
    <h2>لوحة التحكم</h2>

    <p style="margin-top: 1rem;">
        This page is rendered by a Single Action Controller (DashboardController)
    </p>
    <p>
        هذه الصفحة يتم عرضها بواسطة Single Action Controller
    </p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Products</h3>
        <div class="stat-value">{{ $stats['total_products'] }}</div>
        <p>إجمالي المنتجات</p>
    </div>

    <div class="stat-card">
        <h3>Total Users</h3>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <p>إجمالي المستخدمين</p>
    </div>

    <div class="stat-card">
        <h3>Total Orders</h3>
        <div class="stat-value">{{ $stats['total_orders'] }}</div>
        <p>إجمالي الطلبات</p>
    </div>

    <div class="stat-card">
        <h3>Revenue</h3>
        <div class="stat-value">{{ $stats['revenue'] }}</div>
        <p>الإيرادات</p>
    </div>
</div>

<div class="card">
    <h3>About Single Action Controllers</h3>
    <h4>حول Single Action Controllers</h4>

    <p style="margin-top: 1rem;">
        <strong>English:</strong> Single Action Controllers have only one method: __invoke().
        This makes them perfect for simple, focused functionality like this dashboard.
    </p>

    <p style="margin-top: 1rem;">
        <strong>العربية:</strong> تحتوي Single Action Controllers على method واحدة فقط: __invoke().
        هذا يجعلها مثالية للوظائف البسيطة والمركزة مثل هذه اللوحة.
    </p>
</div>
@endsection
