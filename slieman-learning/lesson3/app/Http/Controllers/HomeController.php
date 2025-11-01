<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * HomeController - Simple Controller Example
 * مثال على controller بسيط
 */
class HomeController extends Controller
{
    /**
     * Display the home page
     * عرض الصفحة الرئيسية
     */
    public function index()
    {
        $title = 'Welcome to Laravel Lesson 3';
        $subtitle = 'Controllers and MVC Pattern';

        return view('home', compact('title', 'subtitle'));
    }

    /**
     * Display about page
     * عرض صفحة حول
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display contact page
     * عرض صفحة الاتصال
     */
    public function contact()
    {
        return view('contact');
    }
}
