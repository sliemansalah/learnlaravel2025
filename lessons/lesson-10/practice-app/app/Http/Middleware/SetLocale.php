<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * Localization Middleware
 *
 * Sets the application locale based on:
 * 1. URL parameter (?lang=ar)
 * 2. Session value
 * 3. Default locale from config
 *
 * Usage: Add to 'web' middleware group in bootstrap/app.php
 */
class SetLocale
{
    /**
     * Supported locales
     */
    protected $locales = ['en', 'ar', 'fr', 'es'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if locale is provided in URL
        if ($request->has('lang')) {
            $locale = $request->input('lang');

            if (in_array($locale, $this->locales)) {
                // Store in session for persistence
                Session::put('locale', $locale);
                App::setLocale($locale);
            }
        }
        // Check session
        elseif (Session::has('locale')) {
            $locale = Session::get('locale');

            if (in_array($locale, $this->locales)) {
                App::setLocale($locale);
            }
        }
        // Use default from config
        else {
            App::setLocale(config('app.locale', 'en'));
        }

        return $next($request);
    }

    /**
     * Get supported locales.
     */
    public function getSupportedLocales(): array
    {
        return $this->locales;
    }
}
