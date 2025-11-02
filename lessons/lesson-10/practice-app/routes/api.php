<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Middleware Examples
|--------------------------------------------------------------------------
|
| API routes demonstrating API key authentication, rate limiting, and more.
|
*/

// ========================================
// Public API Routes (No Authentication)
// ========================================

Route::get('/status', function () {
    return response()->json([
        'status' => 'operational',
        'version' => '1.0.0',
        'timestamp' => now()->toDateTimeString(),
    ]);
});

// ========================================
// API Key Protected Routes
// ========================================

Route::middleware('api.key')->group(function () {

    // Get users list
    Route::get('/users', function (Request $request) {
        return response()->json([
            'message' => 'Welcome ' . $request->attributes->get('api_user'),
            'users' => [
                ['id' => 1, 'name' => 'John Doe'],
                ['id' => 2, 'name' => 'Jane Smith'],
                ['id' => 3, 'name' => 'Bob Johnson'],
            ]
        ]);
    });

    // Get user by ID
    Route::get('/users/{id}', function (Request $request, $id) {
        return response()->json([
            'user' => [
                'id' => $id,
                'name' => 'User ' . $id,
                'email' => 'user' . $id . '@example.com',
            ],
            'requested_by' => $request->attributes->get('api_user'),
        ]);
    });

    // Create user
    Route::post('/users', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => array_merge($validated, ['id' => rand(100, 999)]),
        ], 201);
    });
});

// ========================================
// Rate Limited API Endpoints
// ========================================

Route::middleware('rate.limit:10,1')->prefix('limited')->group(function () {

    Route::get('/', function () {
        return response()->json([
            'message' => 'Success - within rate limit',
            'requests_limit' => '10 per minute',
        ]);
    });

    Route::post('/data', function (Request $request) {
        return response()->json([
            'message' => 'Data received',
            'data' => $request->all(),
        ]);
    });
});

// ========================================
// Laravel Sanctum Protected Routes (Optional)
// ========================================

// Uncomment if you have Sanctum installed
/*
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/posts', function (Request $request) {
        // Create post logic
    });
});
*/

// ========================================
// Combined Middleware Example
// ========================================

// API key + rate limiting together
Route::middleware(['api.key', 'rate.limit:30,1'])->prefix('premium')->group(function () {

    Route::get('/data', function (Request $request) {
        return response()->json([
            'message' => 'Premium endpoint accessed',
            'user' => $request->attributes->get('api_user'),
            'data' => [
                'premium_feature_1' => 'value',
                'premium_feature_2' => 'value',
            ],
        ]);
    });
});

// ========================================
// Testing Endpoints
// ========================================

Route::get('/test-middleware', function (Request $request) {
    return response()->json([
        'message' => 'Middleware test endpoint',
        'headers' => $request->headers->all(),
        'ip' => $request->ip(),
        'method' => $request->method(),
    ]);
});
