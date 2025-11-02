<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;

/**
 * Page View Tracking Middleware (Terminable)
 *
 * Tracks page views and stores analytics AFTER the response is sent to the user.
 * This is a "terminable" middleware - the terminate() method runs after response.
 *
 * Usage: Applied globally in bootstrap/app.php
 */
class TrackPageViews
{
    /**
     * @var float Start time of the request
     */
    private $startTime;

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Record start time
        $this->startTime = microtime(true);

        // Continue with request
        return $next($request);
    }

    /**
     * Perform any final actions after the response is sent to the browser.
     *
     * This method runs AFTER the response has been sent to the user,
     * so heavy operations here won't slow down the user experience.
     */
    public function terminate(Request $request, $response): void
    {
        // Calculate response time
        $duration = round((microtime(true) - $this->startTime) * 1000);

        // Store page view analytics (happens after response sent to user)
        try {
            PageView::create([
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'user_id' => auth()->id(),
                'response_time_ms' => $duration,
                'status_code' => $response->status(),
            ]);
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to track page view: ' . $e->getMessage());
        }
    }
}
