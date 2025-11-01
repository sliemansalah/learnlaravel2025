@extends('layouts.app')

@section('title', 'Create Product - Laravel Lesson 3')

@section('content')
<div class="card">
    <h1>Create New Product</h1>
    <h2>إنشاء منتج جديد</h2>

    <p style="margin-top: 1rem;">
        <strong>Note:</strong> This is the create() method of ProductController
    </p>
    <p>
        <strong>ملاحظة:</strong> هذه هي method create() من ProductController
    </p>

    <form method="POST" action="{{ route('products.store') }}" style="margin-top: 2rem;">
        @csrf

        <div class="form-group">
            <label>Product Name / اسم المنتج:</label>
            <input type="text" name="name" required placeholder="Enter product name">
        </div>

        <div class="form-group">
            <label>Price / السعر:</label>
            <input type="number" name="price" required placeholder="Enter price" step="0.01">
        </div>

        <div class="form-group">
            <label>Description / الوصف:</label>
            <textarea name="description" rows="5" placeholder="Enter product description"></textarea>
        </div>

        <div class="flex">
            <button type="submit" class="btn btn-success">
                Create Product / إنشاء المنتج
            </button>
            <a href="{{ route('products.index') }}" class="btn">
                Cancel / إلغاء
            </a>
        </div>
    </form>
</div>

<div class="card">
    <h3>Understanding the Flow / فهم التدفق:</h3>
    <ol style="margin-top: 1rem; line-height: 2;">
        <li>User clicks "Add Product" button / المستخدم ينقر زر "إضافة منتج"</li>
        <li>Route <code>GET /products/create</code> calls <code>create()</code> method</li>
        <li>create() returns this view with the form / create() تعرض هذا النموذج</li>
        <li>User submits form to <code>POST /products</code> / المستخدم يرسل النموذج</li>
        <li>Route calls <code>store()</code> method to save data / store() تحفظ البيانات</li>
    </ol>
</div>
@endsection
