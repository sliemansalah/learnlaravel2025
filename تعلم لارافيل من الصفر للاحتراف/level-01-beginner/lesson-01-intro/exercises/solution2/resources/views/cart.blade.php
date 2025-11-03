@extends('layouts.app')

@section('title', 'السلة')

@section('content')
    <h1>سلة المشتريات</h1>

    @if(count($cartItems) > 0)
        @php($total = 0)

        @foreach($cartItems as $item)
            <div class="product-card">
                <h3>{{ $item['name'] }}</h3>
                <p>السعر: {{ $item['price'] }} ريال</p>
                <p>الكمية: {{ $item['quantity'] }}</p>
                <p class="price">المجموع: {{ $item['price'] * $item['quantity'] }} ريال</p>
            </div>
            @php($total += $item['price'] * $item['quantity'])
        @endforeach

        <h2>المجموع الكلي: <span class="price">{{ $total }} ريال</span></h2>
    @else
        <p>سلة المشتريات فارغة</p>
    @endif
@endsection
