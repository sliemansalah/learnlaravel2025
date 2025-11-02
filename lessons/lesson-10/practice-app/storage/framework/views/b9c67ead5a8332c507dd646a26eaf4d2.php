<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($title); ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #333;
            margin: 40px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 22pt;
            border-bottom: 3px solid #e74c3c;
            padding-bottom: 15px;
            margin-bottom: 10px;
        }
        .date {
            text-align: center;
            color: #7f8c8d;
            font-size: 9pt;
            margin-bottom: 30px;
        }
        .example-section {
            margin: 25px 0;
            page-break-inside: avoid;
        }
        .example-title {
            background-color: #e74c3c;
            color: white;
            padding: 12px;
            font-size: 13pt;
            font-weight: bold;
            border-radius: 6px 6px 0 0;
            margin-bottom: 0;
        }
        .example-description {
            background-color: #fadbd8;
            padding: 10px 12px;
            font-size: 10pt;
            color: #555;
            border-left: 4px solid #e74c3c;
            border-right: 4px solid #e74c3c;
            margin: 0;
        }
        .code-container {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            font-family: 'Courier New', monospace;
            font-size: 8.5pt;
            line-height: 1.6;
            border-radius: 0 0 6px 6px;
            border: 4px solid #e74c3c;
            border-top: none;
            overflow-wrap: break-word;
            white-space: pre-wrap;
        }
        .intro-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 30px;
        }
        .intro-box h3 {
            margin-top: 0;
            color: #856404;
        }
        h2 {
            color: #e74c3c;
            margin-top: 30px;
            font-size: 16pt;
            border-bottom: 2px solid #fadbd8;
            padding-bottom: 8px;
        }
        .highlight {
            background-color: #ffffcc;
            padding: 2px 5px;
        }
    </style>
</head>
<body>
    <h1><?php echo e($title); ?></h1>
    <p class="date">Generated: <?php echo e($date); ?></p>

    <div class="intro-box">
        <h3>About This Document</h3>
        <p>This document contains practical code examples demonstrating how to create and use middleware in Laravel. Each example includes detailed explanations and real-world use cases.</p>
    </div>

    <h2>Code Examples</h2>

    <?php $__currentLoopData = $examples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $example): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="example-section">
        <div class="example-title">
            Example <?php echo e($index + 1); ?>: <?php echo e($example['title']); ?>

        </div>
        <div class="example-description">
            <?php echo e($example['description']); ?>

        </div>
        <div class="code-container"><?php echo e($example['code']); ?></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div style="margin-top: 40px; padding: 20px; background-color: #d4edda; border-left: 4px solid #28a745; border-radius: 6px;">
        <h3 style="margin-top: 0; color: #155724;">Best Practices</h3>
        <ul style="line-height: 2; color: #155724;">
            <li>Keep middleware focused on a single responsibility</li>
            <li>Use descriptive names for middleware classes</li>
            <li>Register middleware with meaningful aliases</li>
            <li>Consider performance impact when adding global middleware</li>
            <li>Document middleware parameters clearly</li>
            <li>Handle errors gracefully in middleware</li>
            <li>Test middleware independently</li>
        </ul>
    </div>

    <div style="margin-top: 30px; padding: 15px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px;">
        <h3 style="margin-top: 0; color: #2c3e50;">Common Use Cases</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background-color: #e9ecef;">
                <td style="padding: 10px; font-weight: bold; border: 1px solid #dee2e6;">Use Case</td>
                <td style="padding: 10px; font-weight: bold; border: 1px solid #dee2e6;">Middleware Type</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #dee2e6;">Authentication</td>
                <td style="padding: 8px; border: 1px solid #dee2e6;">Before Middleware</td>
            </tr>
            <tr style="background-color: #f8f9fa;">
                <td style="padding: 8px; border: 1px solid #dee2e6;">Authorization</td>
                <td style="padding: 8px; border: 1px solid #dee2e6;">Before Middleware</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #dee2e6;">Logging</td>
                <td style="padding: 8px; border: 1px solid #dee2e6;">Before & After Middleware</td>
            </tr>
            <tr style="background-color: #f8f9fa;">
                <td style="padding: 8px; border: 1px solid #dee2e6;">Rate Limiting</td>
                <td style="padding: 8px; border: 1px solid #dee2e6;">Before Middleware</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #dee2e6;">CORS Headers</td>
                <td style="padding: 8px; border: 1px solid #dee2e6;">After Middleware</td>
            </tr>
            <tr style="background-color: #f8f9fa;">
                <td style="padding: 8px; border: 1px solid #dee2e6;">Response Modification</td>
                <td style="padding: 8px; border: 1px solid #dee2e6;">After Middleware</td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php /**PATH D:\learnlaravel2025\lessons\lesson-10\practice-app\resources\views/pdf/code-examples.blade.php ENDPATH**/ ?>