@extends('layouts.app')

@section('title', 'Product Details - Laravel Lesson 3')

@section('content')
<div class="card">
    <h1>Product Details</h1>
    <h2>تفاصيل المنتج</h2>

    <p style="margin-top: 1rem;">
        <strong>Note:</strong> This is the show() method of ProductController
    </p>
    <p>
        <strong>ملاحظة:</strong> هذه هي method show() من ProductController
    </p>
</div>

<div class="card">
    <table>
        <tr>
            <th>ID:</th>
            <td>{{ $product['id'] }}</td>
        </tr>
        <tr>
            <th>Name / الاسم:</th>
            <td>{{ $product['name'] }}</td>
        </tr>
        <tr>
            <th>Price / السعر:</th>
            <td>${{ $product['price'] }}</td>
        </tr>
        <tr>
            <th>Description / الوصف:</th>
            <td>{{ $product['description'] }}</td>
        </tr>
    </table>

    <div class="flex mt-2">
        <a href="{{ route('products.edit', $product['id']) }}" class="btn">
            Edit Product / تعديل المنتج
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-success">
            Back to List / العودة للقائمة
        </a>
        <form method="POST" action="{{ route('products.destroy', $product['id']) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                Delete / حذف
            </button>
        </form>
    </div>
</div>

<div class="card">
    <h3>Controller Method / Method في Controller:</h3>
    <pre style="background: #f4f4f4; padding: 1rem; border-radius: 5px; overflow-x: auto;">
public function show(string $id)
{
    // Fetch product from database
    $product = Product::find($id);

    // Pass data to view
    return view('products.show', compact('product'));
}</pre>
</div>
@endsection
