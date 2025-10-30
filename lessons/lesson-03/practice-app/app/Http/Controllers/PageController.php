<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        return "
            <!DOCTYPE html>
            <html lang='ar'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>الصفحة الرئيسية - Home Page</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        max-width: 1200px;
                        margin: 0 auto;
                        padding: 20px;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        min-height: 100vh;
                    }
                    .container {
                        background: white;
                        padding: 40px;
                        border-radius: 15px;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                    }
                    h1 {
                        color: #667eea;
                        text-align: center;
                    }
                    .nav {
                        background: #f8f9fa;
                        padding: 15px;
                        border-radius: 8px;
                        margin: 20px 0;
                    }
                    .nav a {
                        color: #667eea;
                        text-decoration: none;
                        padding: 10px 15px;
                        margin: 0 5px;
                        border-radius: 5px;
                        display: inline-block;
                        transition: all 0.3s;
                    }
                    .nav a:hover {
                        background: #667eea;
                        color: white;
                    }
                    .content {
                        margin-top: 30px;
                        line-height: 1.8;
                    }
                    .features {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                        gap: 20px;
                        margin-top: 30px;
                    }
                    .feature {
                        background: #f8f9fa;
                        padding: 20px;
                        border-radius: 8px;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>🏠 الصفحة الرئيسية - Home Page</h1>

                    <div class='nav'>
                        <a href='/'>الرئيسية / Home</a>
                        <a href='/about'>من نحن / About</a>
                        <a href='/contact'>اتصل بنا / Contact</a>
                        <a href='/dashboard'>لوحة التحكم / Dashboard</a>
                        <a href='/products'>المنتجات / Products</a>
                        <a href='/posts'>المقالات / Posts</a>
                    </div>

                    <div class='content'>
                        <h2>مرحباً بك في الدرس الثالث - Welcome to Lesson 3</h2>
                        <p><strong>الدرس الثالث:</strong> المتحكمات ونمط MVC</p>
                        <p><strong>Lesson 3:</strong> Controllers and MVC Pattern</p>

                        <div class='features'>
                            <div class='feature'>
                                <h3>📄 PageController</h3>
                                <p>Simple Controller<br>متحكم بسيط</p>
                            </div>
                            <div class='feature'>
                                <h3>📦 ProductController</h3>
                                <p>Resource Controller<br>متحكم موارد</p>
                            </div>
                            <div class='feature'>
                                <h3>📝 PostController</h3>
                                <p>Resource Controller<br>متحكم موارد</p>
                            </div>
                            <div class='feature'>
                                <h3>📊 DashboardController</h3>
                                <p>Single Action<br>إجراء واحد</p>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        ";
    }

    /**
     * Display about page
     */
    public function about()
    {
        return "
            <!DOCTYPE html>
            <html lang='ar'>
            <head>
                <meta charset='UTF-8'>
                <title>من نحن - About Us</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        max-width: 800px;
                        margin: 50px auto;
                        padding: 20px;
                        background: #f0f2f5;
                    }
                    .container {
                        background: white;
                        padding: 40px;
                        border-radius: 10px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    }
                    h1 { color: #667eea; }
                    a {
                        color: #667eea;
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>من نحن - About Us</h1>
                    <p>هذه صفحة &quot;من نحن&quot; تُعرض من خلال PageController</p>
                    <p>This is the &quot;About Us&quot; page displayed through PageController</p>
                    <p><a href='/'>← العودة للرئيسية / Back to Home</a></p>
                </div>
            </body>
            </html>
        ";
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return "
            <!DOCTYPE html>
            <html lang='ar'>
            <head>
                <meta charset='UTF-8'>
                <title>اتصل بنا - Contact Us</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        max-width: 800px;
                        margin: 50px auto;
                        padding: 20px;
                        background: #f0f2f5;
                    }
                    .container {
                        background: white;
                        padding: 40px;
                        border-radius: 10px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    }
                    h1 { color: #667eea; }
                    .info {
                        background: #f8f9fa;
                        padding: 20px;
                        border-radius: 8px;
                        margin: 20px 0;
                    }
                    a {
                        color: #667eea;
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>اتصل بنا - Contact Us</h1>
                    <div class='info'>
                        <p><strong>البريد الإلكتروني / Email:</strong> info@example.com</p>
                        <p><strong>الهاتف / Phone:</strong> +966 50 123 4567</p>
                        <p><strong>العنوان / Address:</strong> الرياض، المملكة العربية السعودية</p>
                    </div>
                    <p>صفحة الاتصال - تُعرض من خلال PageController</p>
                    <p>Contact page - displayed through PageController</p>
                    <p><a href='/'>← العودة للرئيسية / Back to Home</a></p>
                </div>
            </body>
            </html>
        ";
    }
}
