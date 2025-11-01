<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// User Registration Routes
Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'show']);

// Post Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'show']);
});
