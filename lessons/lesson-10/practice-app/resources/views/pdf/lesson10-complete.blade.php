<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin: 2cm 1.5cm;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #3498db;
        }
        h1 {
            color: #2c3e50;
            font-size: 24pt;
            margin-bottom: 10px;
        }
        .meta {
            color: #7f8c8d;
            font-size: 10pt;
        }
        h2 {
            color: #3498db;
            font-size: 16pt;
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #ecf0f1;
        }
        h3 {
            color: #34495e;
            font-size: 13pt;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .concept-box {
            background-color: #ecf0f1;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #3498db;
        }
        .concept-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .concept-desc {
            color: #555;
            font-size: 10pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 9pt;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .middleware-item {
            margin: 15px 0;
            padding: 12px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .middleware-name {
            font-weight: bold;
            color: #2980b9;
            font-size: 12pt;
        }
        .middleware-meta {
            color: #7f8c8d;
            font-size: 9pt;
            margin-top: 5px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8pt;
            color: #999;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="meta">
            <p><strong>Lesson:</strong> {{ $lesson }} | <strong>Topic:</strong> {{ $topic }}</p>
            <p><strong>Generated:</strong> {{ $date }}</p>
        </div>
    </div>

    <!-- Key Concepts Section -->
    <h2>Key Concepts</h2>
    @foreach($concepts as $title => $description)
    <div class="concept-box">
        <div class="concept-title">{{ $title }}</div>
        <div class="concept-desc">{{ $description }}</div>
    </div>
    @endforeach

    <div class="page-break"></div>

    <!-- Middleware Documentation -->
    <h2>Middleware Implementations</h2>
    <p>This lesson includes {{ count($middlewares) }} custom middleware implementations:</p>

    @foreach($middlewares as $middleware)
    <div class="middleware-item">
        <div class="middleware-name">{{ $middleware['name'] }}</div>
        <div class="middleware-meta">
            <strong>Alias:</strong> {{ $middleware['alias'] }} |
            <strong>Type:</strong> {{ $middleware['type'] }}
        </div>
        <p style="margin-top: 8px;"><strong>Purpose:</strong> {{ $middleware['purpose'] }}</p>
        <p style="margin-top: 5px; font-size: 9pt; background-color: #f8f9fa; padding: 8px; font-family: monospace;">
            {{ $middleware['usage'] }}
        </p>
        <p style="margin-top: 5px; color: #7f8c8d; font-size: 9pt;">
            <strong>File:</strong> {{ $middleware['file'] }}
        </p>
    </div>
    @endforeach

    <div class="page-break"></div>

    <!-- Routes Documentation -->
    <h2>Routes Overview</h2>
    <p>Complete list of routes with their middleware configuration:</p>

    <table>
        <thead>
            <tr>
                <th>Method</th>
                <th>Path</th>
                <th>Middleware</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
            <tr>
                <td><strong>{{ $route['method'] }}</strong></td>
                <td style="font-family: monospace; font-size: 8pt;">{{ $route['path'] }}</td>
                <td style="font-size: 8pt;">{{ $route['middleware'] }}</td>
                <td>{{ $route['description'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary -->
    <h2>Summary</h2>
    <div class="concept-box">
        <p>This lesson covered Laravel Middleware - a powerful mechanism for filtering HTTP requests. You learned how to:</p>
        <ul>
            <li>Create custom middleware (Before, After, and Terminable)</li>
            <li>Register middleware globally and as route middleware</li>
            <li>Pass parameters to middleware for dynamic behavior</li>
            <li>Implement common patterns: authentication, authorization, logging, rate limiting</li>
            <li>Apply middleware to routes and route groups</li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Lesson 10: Laravel Middleware | Laravel Learning Series | Page <span class="pagenum"></span></p>
    </div>
</body>
</html>
