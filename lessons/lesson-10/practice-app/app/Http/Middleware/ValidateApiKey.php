<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * API Key Validation Middleware
 *
 * Validates API keys passed via X-API-Key header.
 *
 * Usage: Route::middleware('api.key')->group(...);
 */
class ValidateApiKey
{
    /**
     * Valid API keys and their associated users
     */
    private $validKeys = [
        'test-key-123' => 'Test User',
        'prod-key-456' => 'Production User',
        'dev-key-789' => 'Development User',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');

        // Check if API key is provided
        if (!$apiKey) {
            return response()->json([
                'error' => 'API key is required',
                'message' => 'Please provide an API key via X-API-Key header'
            ], 401);
        }

        // Validate API key
        if (!isset($this->validKeys[$apiKey])) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'The provided API key is not valid'
            ], 401);
        }

        // Attach API user info to request for use in controllers
        $request->attributes->set('api_user', $this->validKeys[$apiKey]);
        $request->attributes->set('api_key', $apiKey);

        return $next($request);
    }
}
