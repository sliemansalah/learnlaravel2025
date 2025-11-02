<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Age Verification Middleware
 *
 * Checks if the user is 18 or older based on the 'age' query parameter.
 *
 * Usage: Route::get('/adults-only', ...)->middleware('check.age');
 */
class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if age parameter exists and is less than 18
        if ($request->has('age') && $request->age < 18) {
            return redirect('/')
                ->with('error', 'You must be 18 or older to access this content.');
        }

        return $next($request);
    }
}
