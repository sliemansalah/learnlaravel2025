<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * DashboardController - Single Action Controller Example
 * مثال على Single Action Controller
 *
 * This controller has only one action (__invoke)
 * هذا الـ controller له وظيفة واحدة فقط
 */
class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     * معالجة الطلب
     */
    public function __invoke(Request $request)
    {
        $stats = [
            'total_products' => 150,
            'total_users' => 1250,
            'total_orders' => 3420,
            'revenue' => '$45,680'
        ];

        return view('dashboard', compact('stats'));
    }
}
