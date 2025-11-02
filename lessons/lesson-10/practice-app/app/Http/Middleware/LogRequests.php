<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Request Logger Middleware
 *
 * Logs all HTTP requests with timing information.
 * Demonstrates both "before" and "after" middleware logic.
 *
 * Usage: Applied globally in bootstrap/app.php
 */
class LogRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Record start time
        $startTime = microtime(true);

        // Log request started (BEFORE middleware)
        Log::info('Request Started', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => auth()->id(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        // Process the request
        $response = $next($request);

        // Calculate duration
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        // Log request completed (AFTER middleware)
        Log::info('Request Completed', [
            'status' => $response->status(),
            'duration_ms' => $duration,
        ]);

        // Optionally add timing header to response
        $response->headers->set('X-Response-Time', $duration . 'ms');

        return $response;
    }
}
