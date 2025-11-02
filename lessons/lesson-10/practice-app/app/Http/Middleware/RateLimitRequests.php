<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Custom Rate Limiting Middleware
 *
 * Limits requests per IP address with configurable max attempts and decay time.
 *
 * Usage: Route::middleware('rate.limit:60,1')->get(...);
 *        Parameters: maxAttempts, decayMinutes
 */
class RateLimitRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  int  $maxAttempts  Maximum number of requests allowed
     * @param  int  $decayMinutes  Time window in minutes
     */
    public function handle(Request $request, Closure $next, int $maxAttempts = 60, int $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        // Get current attempt count
        $attempts = Cache::get($key, 0);

        // Check if limit exceeded
        if ($attempts >= $maxAttempts) {
            $retryAfter = Cache::get($key . ':timer');

            return response()->json([
                'error' => 'Too many requests. Please try again later.',
                'retry_after' => $retryAfter,
                'max_attempts' => $maxAttempts,
            ], 429);
        }

        // Increment attempt count
        Cache::put($key, $attempts + 1, now()->addMinutes($decayMinutes));
        Cache::put($key . ':timer', now()->addMinutes($decayMinutes)->timestamp, now()->addMinutes($decayMinutes));

        $response = $next($request);

        // Add rate limit headers
        $remaining = max(0, $maxAttempts - $attempts - 1);
        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', $remaining);
        $response->headers->set('X-RateLimit-Reset', Cache::get($key . ':timer', now()->timestamp));

        return $response;
    }

    /**
     * Resolve unique signature for the request.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        return 'rate_limit:' . $request->ip() . ':' . $request->path();
    }
}
