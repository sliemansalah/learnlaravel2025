@extends('layouts.app')

@section('title', 'Edit Product - Laravel Lesson 3')

@section('content')
<div class="card">
    <h1>Edit Product</h1>
    <h2>تعديل المنتج</h2>

    <p style="margin-top: 1rem;">
        <strong>Note:</strong> This is the edit() method of ProductController
    </p>
    <p>
        <strong>ملاحظة:</strong> هذه هي method edit() من ProductController
    </p>
</div>

<div class="card">
    <form method="POST" action="{{ route('products.update', $product['id']) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Product ID / معرف المنتج:</label>
            <input type="text" value="{{ $product['id'] }}" disabled style="background: #f4f4f4;">
        </div>

        <div class="form-group">
            <label>Product Name / اسم المنتج:</label>
            <input type="text" name="name" value="{{ $product['name'] }}" required>
        </div>

        <div class="form-group">
            <label>Price / السعر:</label>
            <input type="number" name="price" value="{{ $product['price'] }}" required step="0.01">
        </div>

        <div class="flex">
            <button type="submit" class="btn btn-success">
                Update Product / تحديث المنتج
            </button>
            <a href="{{ route('products.show', $product['id']) }}" class="btn">
                Cancel / إلغاء
            </a>
        </div>
    </form>
</div>

<div class="card">
    <h3>HTTP Method Spoofing / محاكاة طرق HTTP:</h3>
    <p style="margin-top: 1rem;">
        HTML forms only support GET and POST, but Laravel provides <code>@method('PUT')</code> to simulate PUT requests.
    </p>
    <p>
        نماذج HTML تدعم فقط GET و POST، لكن Laravel توفر <code>@method('PUT')</code> لمحاكاة طلبات PUT.
    </p>

    <pre style="background: #f4f4f4; padding: 1rem; border-radius: 5px; margin-top: 1rem; overflow-x: auto;">
&lt;form method="POST" action="{{ route('products.update', $id) }}"&gt;
    @csrf
    @method('PUT')  &lt;!-- This tells Laravel to treat it as PUT --&gt;
    ...
&lt;/form&gt;</pre>
</div>
@endsection
