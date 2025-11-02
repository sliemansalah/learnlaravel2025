<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Maintenance Mode Middleware
 *
 * Enables maintenance mode with IP whitelist and admin bypass.
 *
 * Configuration:
 * - MAINTENANCE_MODE=true/false in .env
 * - MAINTENANCE_ALLOWED_IPS=127.0.0.1,192.168.1.100 in .env
 * - config/app.php: 'maintenance_mode' => env('MAINTENANCE_MODE', false)
 *
 * Usage: Apply globally in bootstrap/app.php
 */
class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if maintenance mode is enabled
        if (!config('app.maintenance_mode', false)) {
            return $next($request);
        }

        // Allow whitelisted IPs
        $allowedIps = $this->getAllowedIps();

        if (in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }

        // Allow authenticated admin users
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Show maintenance page
        return response()->view('errors.maintenance', [
            'message' => 'We are currently performing maintenance. Please check back soon.',
            'retry_after' => now()->addMinutes(30)->toDateTimeString(),
        ], 503);
    }

    /**
     * Get allowed IP addresses from environment.
     */
    protected function getAllowedIps(): array
    {
        $ips = env('MAINTENANCE_ALLOWED_IPS', '127.0.0.1');

        return array_map('trim', explode(',', $ips));
    }
}
