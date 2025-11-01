@extends('layouts.app')

@section('title', 'Products List - Laravel Lesson 3')

@section('content')
<div class="card">
    <div class="flex-between">
        <div>
            <h1>Products List</h1>
            <h2>قائمة المنتجات</h2>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            + Add Product / إضافة منتج
        </a>
    </div>

    <p style="margin-top: 1rem;">
        <strong>Note:</strong> This is the index() method of ProductController (Resource Controller)
    </p>
    <p>
        <strong>ملاحظة:</strong> هذه هي method index() من ProductController (Resource Controller)
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name / الاسم</th>
                <th>Price / السعر</th>
                <th>Actions / العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>${{ $product['price'] }}</td>
                <td class="flex">
                    <a href="{{ route('products.show', $product['id']) }}" class="btn btn-sm">
                        View / عرض
                    </a>
                    <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-sm">
                        Edit / تعديل
                    </a>
                    <form method="POST" action="{{ route('products.destroy', $product['id']) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete / حذف
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <h3>Resource Controller Routes / مسارات Resource Controller</h3>
    <p style="margin-top: 1rem;">
        Resource controllers automatically provide 7 RESTful routes:
    </p>
    <ul style="margin-top: 1rem;">
        <li><code>GET /products</code> → index() - List all / قائمة الكل</li>
        <li><code>GET /products/create</code> → create() - Show create form / نموذج الإنشاء</li>
        <li><code>POST /products</code> → store() - Store new / حفظ جديد</li>
        <li><code>GET /products/{id}</code> → show() - Show one / عرض واحد</li>
        <li><code>GET /products/{id}/edit</code> → edit() - Show edit form / نموذج التعديل</li>
        <li><code>PUT /products/{id}</code> → update() - Update / تحديث</li>
        <li><code>DELETE /products/{id}</code> → destroy() - Delete / حذف</li>
    </ul>
</div>
@endsection
