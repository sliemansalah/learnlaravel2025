<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Middleware Practice App</title>
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
            max-width: 900px;
            width: 100%;
            padding: 50px;
        }

        h1 {
            color: #667eea;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .info-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .info-card h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .info-card p {
            color: #666;
            line-height: 1.6;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .examples {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 2px solid #e9ecef;
        }

        .examples h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .example-list {
            list-style: none;
        }

        .example-list li {
            padding: 15px;
            background: #f8f9fa;
            margin-bottom: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .example-list li:hover {
            background: #e9ecef;
        }

        code {
            background: #f1f3f5;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            color: #e83e8c;
        }

        .badge {
            background: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Middleware Practice App</h1>
        <p class="subtitle">Laravel 11 - Lesson 10: Middleware Examples</p>

        <div class="info-grid">
            <div class="info-card">
                <h3>📚 Learning Path</h3>
                <p>Hands-on examples demonstrating Laravel middleware concepts including authentication, authorization, rate limiting, and more.</p>
            </div>

            <div class="info-card">
                <h3>🎯 Current Locale</h3>
                <p>Language: <code><?php echo e(app()->getLocale()); ?></code></p>
                <p>Change: <a href="?lang=en">EN</a> | <a href="?lang=ar">AR</a> | <a href="?lang=fr">FR</a></p>
            </div>

            <div class="info-card">
                <h3>⏱️ Response Time</h3>
                <p>All requests are logged with timing information. Check <code>storage/logs/laravel.log</code></p>
            </div>
        </div>

        <div class="examples">
            <h2>📋 Available Examples</h2>
            <ul class="example-list">
                <li>
                    <span><strong>Age Verification</strong> - <code>/adults-only?age=21</code></span>
                    <span class="badge">CheckAge</span>
                </li>
                <li>
                    <span><strong>Dashboard</strong> - <code>/dashboard</code></span>
                    <span class="badge">Auth Required</span>
                </li>
                <li>
                    <span><strong>Admin Panel</strong> - <code>/admin/dashboard</code></span>
                    <span class="badge">Role: Admin</span>
                </li>
                <li>
                    <span><strong>Moderation</strong> - <code>/moderate</code></span>
                    <span class="badge">Role: Admin/Moderator</span>
                </li>
                <li>
                    <span><strong>API Users</strong> - <code>/api/users</code></span>
                    <span class="badge">API Key Required</span>
                </li>
                <li>
                    <span><strong>Rate Limited</strong> - <code>/api/limited</code></span>
                    <span class="badge">10 req/min</span>
                </li>
                <li>
                    <span><strong>Analytics</strong> - <code>/analytics</code></span>
                    <span class="badge">Page Views</span>
                </li>
            </ul>
        </div>

        <div class="links">
            <a href="/adults-only?age=21" class="btn">Test Age Check</a>
            <a href="/dashboard" class="btn">Go to Dashboard</a>
            <a href="/analytics" class="btn btn-secondary">View Analytics</a>
        </div>

        <div style="margin-top: 40px; padding: 20px; background: #fff3cd; border-radius: 10px; border-left: 4px solid #ffc107;">
            <strong>💡 Tip:</strong> Login credentials for testing:
            <ul style="margin-top: 10px; margin-left: 20px;">
                <li><code>admin@example.com</code> / <code>password</code> (Admin)</li>
                <li><code>moderator@example.com</code> / <code>password</code> (Moderator)</li>
                <li><code>user@example.com</code> / <code>password</code> (User)</li>
            </ul>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\learnlaravel2025\lessons\lesson-10\practice-app\resources\views/welcome.blade.php ENDPATH**/ ?>