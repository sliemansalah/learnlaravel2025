<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 10px;
            font-size: 24pt;
            border-bottom: 3px solid #3498db;
            padding-bottom: 15px;
        }
        .date {
            text-align: center;
            color: #7f8c8d;
            font-size: 10pt;
            margin-bottom: 30px;
        }
        .middleware-card {
            margin: 20px 0;
            padding: 15px;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #f8f9fa;
            page-break-inside: avoid;
        }
        .middleware-header {
            background-color: #3498db;
            color: white;
            padding: 10px;
            margin: -15px -15px 15px -15px;
            border-radius: 6px 6px 0 0;
        }
        .middleware-name {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
        }
        .middleware-alias {
            font-size: 10pt;
            opacity: 0.9;
            margin-top: 3px;
        }
        .info-row {
            margin: 10px 0;
            padding: 8px;
            background-color: white;
            border-left: 4px solid #3498db;
        }
        .info-label {
            font-weight: bold;
            color: #2c3e50;
            display: inline-block;
            width: 100px;
        }
        .info-value {
            color: #555;
        }
        .code-block {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 12px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 9pt;
            border-radius: 4px;
            overflow-wrap: break-word;
        }
        .type-badge {
            display: inline-block;
            padding: 4px 10px;
            background-color: #e74c3c;
            color: white;
            border-radius: 12px;
            font-size: 9pt;
            font-weight: bold;
            margin-left: 10px;
        }
        h2 {
            color: #3498db;
            margin-top: 30px;
            font-size: 16pt;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
        .summary-box {
            background-color: #d5f4e6;
            border-left: 4px solid #27ae60;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p class="date">Generated: {{ $date }}</p>

    <div class="summary-box">
        <h3 style="margin-top: 0; color: #27ae60;">Overview</h3>
        <p>This document provides detailed documentation for all {{ count($middlewares) }} custom middleware implementations in Lesson 10.</p>
    </div>

    <h2>Middleware Implementations</h2>

    @foreach($middlewares as $index => $middleware)
    <div class="middleware-card">
        <div class="middleware-header">
            <div class="middleware-name">{{ $index + 1 }}. {{ $middleware['name'] }}</div>
            <div class="middleware-alias">Alias: {{ $middleware['alias'] }}</div>
        </div>

        <div class="info-row">
            <span class="info-label">Type:</span>
            <span class="info-value">{{ $middleware['type'] }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Purpose:</span>
            <span class="info-value">{{ $middleware['purpose'] }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">File Location:</span>
            <span class="info-value" style="font-family: monospace; font-size: 9pt;">{{ $middleware['file'] }}</span>
        </div>

        <div style="margin-top: 15px;">
            <strong style="color: #2c3e50;">Usage Example:</strong>
            <div class="code-block">{{ $middleware['usage'] }}</div>
        </div>
    </div>
    @endforeach

    <div style="margin-top: 40px; padding: 20px; background-color: #ecf0f1; border-radius: 8px;">
        <h3 style="margin-top: 0; color: #2c3e50;">Middleware Types Explained</h3>
        <ul style="line-height: 2;">
            <li><strong>Before Middleware:</strong> Executes logic before the request reaches the controller</li>
            <li><strong>After Middleware:</strong> Executes logic after the controller processes the request</li>
            <li><strong>Before & After Middleware:</strong> Performs operations both before and after request handling</li>
            <li><strong>With Parameters:</strong> Accepts additional arguments for dynamic behavior</li>
        </ul>
    </div>
</body>
</html>
