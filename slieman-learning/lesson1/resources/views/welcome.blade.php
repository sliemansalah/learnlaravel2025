<!DOCTYPE html>
<html>
    <head>
        <title>مرحبا</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            direction: rtl;
        }
        h1 {
            color: #FF2D20;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            color: #2d3748;
            line-height: 1.8;
            margin: 15px 0;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #20a9ff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #c4e1f3;
        }
        .inline-block {
            display: inline-block;
            margin: 0 5px;
        }
    </style>
    </head>
    <body>
         <div class="container">
            <h1>مرحبا بك في Laravel</h1>
             <p class="inline-block"><a href="/hello">مرحبا</a></p>
            <p class="inline-block"><a href="/about">عني</a></p>
            <p class="inline-block"><a href="/contact">اتصل بنا</a></p>
             <p class="inline-block"><a href="/mypage">صفحتي</a></p>
             <p class="inline-block"><a href="/slieman">سليمان</a></p>
             <p class="inline-block"><a href="/services">خدماتنا</a></p>
             <p class="inline-block"><a href="/portfolio">مشاريعنا</a></p>
             <p class="inline-block"><a href="/testimonials">آراء العملاء</a></p>
         </div>
    </body>
</html>