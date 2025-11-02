<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .date {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .content {
            line-height: 1.6;
            color: #444;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p class="date">Generated on: {{ $date }}</p>
    <div class="content">
        <p>{{ $content }}</p>
    </div>
    <div class="footer">
        <p>This document was generated automatically by Laravel PDF System</p>
    </div>
</body>
</html>
