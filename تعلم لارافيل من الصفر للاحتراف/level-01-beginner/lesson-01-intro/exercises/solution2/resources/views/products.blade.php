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
