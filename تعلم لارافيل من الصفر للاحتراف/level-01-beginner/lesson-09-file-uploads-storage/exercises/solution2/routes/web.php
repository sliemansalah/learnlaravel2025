<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('gallery.index');
});

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/upload', [GalleryController::class, 'create'])->name('gallery.create');
Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');
Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
