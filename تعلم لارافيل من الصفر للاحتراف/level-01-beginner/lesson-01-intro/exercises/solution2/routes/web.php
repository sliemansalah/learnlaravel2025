<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/products', function () {
    $products = [
        ['id' => 1, 'name' => 'لابتوب HP', 'price' => 3000, 'description' => 'لابتوب قوي للعمل'],
        ['id' => 2, 'name' => 'هاتف Samsung', 'price' => 2000, 'description' => 'هاتف ذكي حديث'],
        ['id' => 3, 'name' => 'سماعات Sony', 'price' => 500, 'description' => 'سماعات عالية الجودة'],
    ];

    return view('products', compact('products'));
});

Route::get('/cart', function () {
    $cartItems = [
        ['name' => 'لابتوب HP', 'price' => 3000, 'quantity' => 1],
        ['name' => 'سماعات Sony', 'price' => 500, 'quantity' => 2],
    ];

    return view('cart', compact('cartItems'));
});
