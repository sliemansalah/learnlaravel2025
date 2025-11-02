<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Bootstrap Application - Middleware Registration
 *
 * Lesson 10: Middleware Practice Application
 */

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // ========================================
        // Register Middleware Aliases
        // ========================================

        $middleware->alias([
            // Age verification
            'check.age' => \App\Http\Middleware\CheckAge::class,

            // API key authentication
            'api.key' => \App\Http\Middleware\ValidateApiKey::class,

            // Role-based access control
            'role' => \App\Http\Middleware\CheckRole::class,

            // Custom rate limiting
            'rate.limit' => \App\Http\Middleware\RateLimitRequests::class,
        ]);

        // ========================================
        // Global Middleware (Runs on Every Request)
        // ========================================

        // Enable request logging
        $middleware->append(\App\Http\Middleware\LogRequests::class);

        // Enable page view tracking
        $middleware->append(\App\Http\Middleware\TrackPageViews::class);

        // Optional: Enable maintenance mode check
        // $middleware->append(\App\Http\Middleware\CheckMaintenanceMode::class);

        // ========================================
        // Append to Web Middleware Group
        // ========================================

        // Add localization to web routes
        $middleware->appendToGroup('web', \App\Http\Middleware\SetLocale::class);

        // ========================================
        // Custom Middleware Groups
        // ========================================

        // API group with authentication and rate limiting
        $middleware->group('api.protected', [
            \App\Http\Middleware\ValidateApiKey::class,
            \App\Http\Middleware\RateLimitRequests::class . ':60,1',
        ]);

        // Admin group
        $middleware->group('admin', [
            'auth',
            \App\Http\Middleware\CheckRole::class . ':admin',
        ]);

        // ========================================
        // Middleware Priority
        // ========================================

        $middleware->priority([
            \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class,
            \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
            \Illuminate\Contracts\Session\Middleware\AuthenticatesSessions::class,
            \Illuminate\Auth\Middleware\Authorize::class,
            // Custom middleware
            \App\Http\Middleware\CheckMaintenanceMode::class,
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\CheckRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
