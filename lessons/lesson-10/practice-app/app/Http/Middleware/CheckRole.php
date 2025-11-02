<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Role-Based Access Control Middleware
 *
 * Checks if the authenticated user has one of the required roles.
 *
 * Usage:
 * - Route::middleware('role:admin')->get(...);
 * - Route::middleware('role:admin,moderator')->get(...);
 */
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  string  ...$roles  One or more roles that are allowed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect('login')
                ->with('error', 'Please login to access this page');
        }

        $user = auth()->user();

        // Check if user has one of the required roles
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized. Required role: ' . implode(' or ', $roles));
        }

        return $next($request);
    }
}
