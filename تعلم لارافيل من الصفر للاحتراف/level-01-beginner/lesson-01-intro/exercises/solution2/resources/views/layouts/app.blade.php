<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'متجري')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        nav { background: #333; color: white; padding: 15px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        footer { background: #f4f4f4; padding: 20px; text-align: center; margin-top: 40px; }
        .product-card { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .price { color: #28a745; font-weight: bold; font-size: 18px; }
    </style>
</head>

<body>
    <nav>
        <div class="container">
            <a href="/">الرئيسية</a>
            <a href="/products">المنتجات</a>
            <a href="/cart">سلة المشتريات</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        <p>&copy; 2025 متجري - جميع الحقوق محفوظة</p>
    </footer>
</body>

</html>
