<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($title); ?></title>
    <style>
        @page {
            margin: 2cm 1.5cm;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #333;
        }
        .cover-page {
            text-align: center;
            padding: 100px 40px;
            page-break-after: always;
        }
        .cover-title {
            font-size: 32pt;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .cover-subtitle {
            font-size: 18pt;
            color: #7f8c8d;
            margin-bottom: 40px;
        }
        .cover-info {
            font-size: 12pt;
            color: #555;
            margin: 20px 0;
        }
        .cover-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin: 40px auto;
            max-width: 500px;
        }
        .toc {
            page-break-after: always;
            padding: 20px;
        }
        .toc h1 {
            color: #2c3e50;
            font-size: 24pt;
            margin-bottom: 30px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 15px;
        }
        .toc-item {
            padding: 15px;
            margin: 10px 0;
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            font-size: 12pt;
        }
        .toc-number {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            margin-right: 15px;
            font-weight: bold;
        }
        .document-section {
            page-break-before: always;
            margin-bottom: 40px;
        }
        .document-header {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        .document-title {
            font-size: 20pt;
            margin: 0;
        }
        .content h1 {
            color: #2c3e50;
            font-size: 18pt;
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 3px solid #3498db;
        }
        .content h2 {
            color: #3498db;
            font-size: 14pt;
            margin-top: 20px;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #ecf0f1;
        }
        .content h3 {
            color: #34495e;
            font-size: 12pt;
            margin-top: 18px;
            margin-bottom: 10px;
        }
        .content h4 {
            color: #555;
            font-size: 11pt;
            margin-top: 15px;
            margin-bottom: 8px;
        }
        .content p {
            margin: 10px 0;
            text-align: justify;
        }
        .content ul, .content ol {
            margin: 12px 0;
            padding-left: 25px;
        }
        .content li {
            margin: 6px 0;
            line-height: 1.7;
        }
        .content pre {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 12px;
            border-radius: 6px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 8pt;
            line-height: 1.4;
            margin: 12px 0;
            page-break-inside: avoid;
        }
        .content code {
            background-color: #f8f9fa;
            color: #e74c3c;
            padding: 2px 5px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 9pt;
        }
        .content pre code {
            background-color: transparent;
            color: #ecf0f1;
            padding: 0;
        }
        .content blockquote {
            border-left: 4px solid #3498db;
            padding-left: 15px;
            margin: 12px 0;
            background-color: #f8f9fa;
            padding: 12px;
            font-style: italic;
            color: #555;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 9pt;
        }
        .content th {
            background-color: #3498db;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        .content td {
            padding: 6px;
            border: 1px solid #ddd;
        }
        .content tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .content a {
            color: #3498db;
            text-decoration: none;
        }
        .content strong {
            color: #2c3e50;
            font-weight: bold;
        }
        .content hr {
            border: none;
            border-top: 2px solid #ecf0f1;
            margin: 20px 0;
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
    </style>
</head>
<body>
    <!-- Cover Page -->
    <div class="cover-page">
        <div class="cover-title"><?php echo e($title); ?></div>
        <div class="cover-subtitle">Complete Markdown Documentation Collection</div>

        <div class="cover-box">
            <h2 style="margin-top: 0; font-size: 18pt;">Lesson 10: Middleware</h2>
            <p style="font-size: 12pt; margin: 15px 0;">
                This comprehensive document contains all <?php echo e($total); ?> markdown files<br>
                converted to PDF format for easy reference and offline access.
            </p>
        </div>

        <div class="cover-info">
            <p><strong>Generated:</strong> <?php echo e($date); ?></p>
            <p><strong>Total Documents:</strong> <?php echo e($total); ?></p>
            <p><strong>Course:</strong> Laravel Learning Series</p>
        </div>
    </div>

    <!-- Table of Contents -->
    <div class="toc">
        <h1>Table of Contents</h1>
        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="toc-item">
            <span class="toc-number"><?php echo e($index + 1); ?></span>
            <strong><?php echo e($doc['title']); ?></strong>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Documents -->
    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="document-section">
        <div class="document-header">
            <h2 class="document-title"><?php echo e($index + 1); ?>. <?php echo e($doc['title']); ?></h2>
        </div>
        <div class="content">
            <?php echo $doc['content']; ?>

        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Footer -->
    <div class="footer">
        <p>Lesson 10: Laravel Middleware - Complete Documentation Package</p>
    </div>
</body>
</html>
<?php /**PATH D:\learnlaravel2025\lessons\lesson-10\practice-app\resources\views/pdf/all-markdown.blade.php ENDPATH**/ ?>