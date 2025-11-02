<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Middleware Examples
|--------------------------------------------------------------------------
|
| This file demonstrates various middleware usage patterns from Lesson 10.
|
*/

// ========================================
// Public Routes (No Middleware)
// ========================================

Route::get('/', function () {
    return view('welcome');
});

// ========================================
// Age Verification Middleware Example
// ========================================

Route::get('/adults-only', function () {
    return view('adults-only', [
        'message' => 'Welcome! You are 18 or older.'
    ]);
})->middleware('check.age');

// ========================================
// Authentication Middleware Examples
// ========================================

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'user' => auth()->user()
        ]);
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile', [
            'user' => auth()->user()
        ]);
    })->name('profile');
});

// ========================================
// Role-Based Middleware Examples
// ========================================

// Admin only routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'message' => 'Welcome, Admin!'
        ]);
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.users', [
            'users' => \App\Models\User::all()
        ]);
    })->name('admin.users');
});

// Admin OR Moderator routes
Route::middleware(['auth', 'role:admin,moderator'])->group(function () {

    Route::get('/moderate', function () {
        return view('moderate', [
            'message' => 'Moderation Panel',
            'role' => auth()->user()->role
        ]);
    })->name('moderate');
});

// ========================================
// Localization Example
// ========================================

Route::get('/welcome', function () {
    return response()->json([
        'locale' => app()->getLocale(),
        'message' => __('messages.welcome'),
        'goodbye' => __('messages.goodbye'),
    ]);
});

// ========================================
// Analytics Dashboard
// ========================================

Route::get('/analytics', function () {
    $views = \App\Models\PageView::latest()->take(10)->get();

    $stats = [
        'total_views' => \App\Models\PageView::count(),
        'unique_visitors' => \App\Models\PageView::distinct('ip')->count('ip'),
        'avg_response_time' => round(\App\Models\PageView::avg('response_time_ms'), 2),
        'slowest_page' => \App\Models\PageView::orderBy('response_time_ms', 'desc')->first(),
        'most_visited' => \App\Models\PageView::select('url', \DB::raw('count(*) as views'))
            ->groupBy('url')
            ->orderBy('views', 'desc')
            ->first(),
    ];

    return response()->json([
        'stats' => $stats,
        'recent_views' => $views,
    ]);
})->name('analytics');

// ========================================
// Testing Routes
// ========================================

// Test rate limiting
Route::get('/test-rate-limit', function () {
    return response()->json([
        'message' => 'Request successful',
        'timestamp' => now()->toDateTimeString(),
    ]);
})->middleware('rate.limit:10,1');

// Test maintenance mode
Route::get('/test-maintenance', function () {
    return response()->json([
        'message' => 'Site is operational',
        'maintenance_mode' => config('app.maintenance_mode', false),
    ]);
});

// ========================================
// PDF Generation Routes
// ========================================

use App\Http\Controllers\PdfController;

// PDF Index Page
Route::get('/pdf', function () {
    return view('pdf-index');
})->name('pdf.index');

// Basic PDF examples
Route::get('/pdf/sample', [PdfController::class, 'generatePdf'])->name('pdf.sample');
Route::get('/pdf/invoice', [PdfController::class, 'downloadPdf'])->name('pdf.invoice');
Route::get('/pdf/landscape', [PdfController::class, 'customPdf'])->name('pdf.landscape');

// Lesson 10 Documentation PDFs
Route::get('/pdf/lesson10/complete', [PdfController::class, 'lesson10Complete'])->name('pdf.lesson10.complete');
Route::get('/pdf/lesson10/middleware', [PdfController::class, 'middlewareDocumentation'])->name('pdf.lesson10.middleware');
Route::get('/pdf/lesson10/code-examples', [PdfController::class, 'codeExamples'])->name('pdf.lesson10.code');
Route::get('/pdf/lesson10/routes', [PdfController::class, 'routesDocumentation'])->name('pdf.lesson10.routes');

// Markdown to PDF Conversion Routes
Route::get('/pdf/md/all', [PdfController::class, 'allMarkdownPdfs'])->name('pdf.md.all');
Route::get('/pdf/md/README', fn() => app(PdfController::class)->markdownToPdf('README'))->name('pdf.md.readme');
Route::get('/pdf/md/README-EN', fn() => app(PdfController::class)->markdownToPdf('README-EN'))->name('pdf.md.readme-en');
Route::get('/pdf/md/QUICK-REFERENCE', fn() => app(PdfController::class)->markdownToPdf('QUICK-REFERENCE'))->name('pdf.md.quick-ref');
Route::get('/pdf/md/QUICK-REFERENCE-EN', fn() => app(PdfController::class)->markdownToPdf('QUICK-REFERENCE-EN'))->name('pdf.md.quick-ref-en');
Route::get('/pdf/md/PRACTICE-GUIDE-AR', fn() => app(PdfController::class)->markdownToPdf('PRACTICE-GUIDE-AR'))->name('pdf.md.practice-ar');
Route::get('/pdf/md/PRACTICE-GUIDE-EN', fn() => app(PdfController::class)->markdownToPdf('PRACTICE-GUIDE-EN'))->name('pdf.md.practice-en');
Route::get('/pdf/md/FULL-EXAM-100-QUESTIONS', fn() => app(PdfController::class)->markdownToPdf('FULL-EXAM-100-QUESTIONS'))->name('pdf.md.exam');
