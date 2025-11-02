<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($title); ?></title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1.5cm;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 20pt;
            border-bottom: 3px solid #9b59b6;
            padding-bottom: 12px;
            margin-bottom: 8px;
        }
        .date {
            text-align: center;
            color: #7f8c8d;
            font-size: 9pt;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 8.5pt;
        }
        thead {
            background-color: #9b59b6;
            color: white;
        }
        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #8e44ad;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e8daef;
        }
        .method-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            color: white;
            font-size: 8pt;
        }
        .method-get {
            background-color: #27ae60;
        }
        .method-post {
            background-color: #3498db;
        }
        .method-put {
            background-color: #f39c12;
        }
        .method-delete {
            background-color: #e74c3c;
        }
        .path-column {
            font-family: 'Courier New', monospace;
            color: #2c3e50;
            font-weight: bold;
        }
        .middleware-column {
            font-family: 'Courier New', monospace;
            font-size: 7.5pt;
            color: #8e44ad;
        }
        .intro-box {
            background-color: #ebdef0;
            border-left: 4px solid #9b59b6;
            padding: 12px;
            margin-bottom: 20px;
        }
        .legend {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }
        .legend h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 11pt;
        }
        .legend-item {
            margin: 8px 0;
            font-size: 8.5pt;
        }
        .legend-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    <h1><?php echo e($title); ?></h1>
    <p class="date">Generated: <?php echo e($date); ?> | Lesson 10: Middleware</p>

    <div class="intro-box">
        <strong>Routes Overview:</strong> This document lists all <?php echo e(count($routes)); ?> routes defined in the Lesson 10 practice application, including their HTTP methods, paths, middleware configuration, and descriptions.
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">Method</th>
                <th style="width: 25%;">Path</th>
                <th style="width: 25%;">Middleware</th>
                <th style="width: 42%;">Description</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <span class="method-badge method-<?php echo e(strtolower($route['method'])); ?>">
                        <?php echo e($route['method']); ?>

                    </span>
                </td>
                <td class="path-column"><?php echo e($route['path']); ?></td>
                <td class="middleware-column"><?php echo e($route['middleware']); ?></td>
                <td><?php echo e($route['description']); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="legend">
        <h3>Middleware Legend</h3>
        <div class="legend-item">
            <span class="legend-label">auth</span>
            <span>Authentication required - user must be logged in</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">check.age</span>
            <span>Age verification - user must be 18 or older</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">role:admin</span>
            <span>Role-based access - user must have admin role</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">role:admin,moderator</span>
            <span>Role-based access - user must have admin OR moderator role</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">rate.limit:10,1</span>
            <span>Rate limiting - maximum 10 requests per 1 minute</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">api.key</span>
            <span>API key authentication - valid API key required in headers</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">None</span>
            <span>Public route - no middleware protection</span>
        </div>
    </div>

    <div style="margin-top: 20px; padding: 12px; background-color: #d5f4e6; border-left: 4px solid #27ae60; border-radius: 4px;">
        <strong style="color: #155724;">Route Groups:</strong> Routes are organized into logical groups:
        <ul style="margin: 10px 0; color: #155724;">
            <li><strong>Public Routes:</strong> No authentication required (/, /welcome, /api/status)</li>
            <li><strong>Authenticated Routes:</strong> Require login (/dashboard, /profile)</li>
            <li><strong>Admin Routes:</strong> Require admin role (/admin/*)</li>
            <li><strong>API Routes:</strong> API endpoints with key authentication (/api/*)</li>
            <li><strong>Rate-Limited Routes:</strong> Protected against abuse (/test-rate-limit, /api/limited/*)</li>
        </ul>
    </div>
</body>
</html>
<?php /**PATH D:\learnlaravel2025\lessons\lesson-10\practice-app\resources\views/pdf/routes-docs.blade.php ENDPATH**/ ?>