<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        // كل {id} يجب أن يكون رقم
        Route::pattern('id', '[0-9]+');

        // كل {slug} يجب أن يكون حروف وأرقام
        Route::pattern('slug', '[a-z0-9-]+');
    }
}
