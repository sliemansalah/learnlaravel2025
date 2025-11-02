<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
        }

        .icon {
            font-size: 5rem;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .info-box p {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .info-box strong {
            color: #667eea;
        }

        .retry-button {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .retry-button:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">🔧</div>
        <h1>Maintenance Mode</h1>
        <p>{{ $message ?? 'We are currently performing maintenance. Please check back soon.' }}</p>

        <div class="info-box">
            <p><strong>Status:</strong> Temporarily Unavailable (503)</p>
            @if(isset($retry_after))
                <p><strong>Expected Return:</strong> {{ $retry_after }}</p>
            @endif
            <p style="margin-top: 15px; font-size: 0.9rem; color: #999;">
                If you are an administrator, please log in or contact support if this persists.
            </p>
        </div>

        <a href="/" class="retry-button">Refresh Page</a>
    </div>
</body>
</html>
