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
            direction: {{ str_contains($filename, 'AR') || $filename === 'README' || str_contains($filename, 'QUICK-REFERENCE') && !str_contains($filename, 'EN') ? 'rtl' : 'ltr' }};
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
        }
        h1 {
            color: white;
            font-size: 24pt;
            margin: 0 0 10px 0;
        }
        .meta {
            font-size: 10pt;
            opacity: 0.9;
        }
        .content {
            margin-top: 20px;
        }
        .content h1 {
            color: #2c3e50;
            font-size: 20pt;
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 3px solid #3498db;
        }
        .content h2 {
            color: #3498db;
            font-size: 16pt;
            margin-top: 20px;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #ecf0f1;
        }
        .content h3 {
            color: #34495e;
            font-size: 13pt;
            margin-top: 18px;
            margin-bottom: 10px;
        }
        .content h4 {
            color: #555;
            font-size: 12pt;
            margin-top: 15px;
            margin-bottom: 8px;
        }
        .content p {
            margin: 10px 0;
            text-align: justify;
        }
        .content ul, .content ol {
            margin: 15px 0;
            padding-left: 30px;
        }
        .content li {
            margin: 8px 0;
            line-height: 1.8;
        }
        .content pre {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 6px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 9pt;
            line-height: 1.5;
            margin: 15px 0;
            page-break-inside: avoid;
        }
        .content code {
            background-color: #f8f9fa;
            color: #e74c3c;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 10pt;
        }
        .content pre code {
            background-color: transparent;
            color: #ecf0f1;
            padding: 0;
        }
        .content blockquote {
            border-left: 4px solid #3498db;
            padding-left: 15px;
            margin: 15px 0;
            background-color: #f8f9fa;
            padding: 15px;
            font-style: italic;
            color: #555;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 10pt;
        }
        .content th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .content td {
            padding: 8px;
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
        .content em {
            font-style: italic;
            color: #555;
        }
        .content hr {
            border: none;
            border-top: 2px solid #ecf0f1;
            margin: 25px 0;
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
        .toc {
            background-color: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #3498db;
            margin: 20px 0;
            page-break-inside: avoid;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="meta">
            <p>Generated: {{ $date }} | Source: {{ $filename }}.md</p>
        </div>
    </div>

    <div class="content">
        {!! $content !!}
    </div>

    <div class="footer">
        <p>Lesson 10: Laravel Middleware | {{ $filename }} | Generated with Laravel PDF</p>
    </div>
</body>
</html>
