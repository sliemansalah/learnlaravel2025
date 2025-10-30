<?php

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Function to convert markdown to PDF
function markdownToPdf($markdownFile, $pdfFile, $isArabic = false) {
    // Read markdown content
    $markdown = file_get_contents($markdownFile);

    // Convert markdown to HTML using Parsedown
    $parsedown = new Parsedown();
    $html = $parsedown->text($markdown);

    // Add CSS for better formatting
    $css = '
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: "DejaVu Sans", sans-serif;
            line-height: 1.6;
            color: #333;
            direction: ' . ($isArabic ? 'rtl' : 'ltr') . ';
            text-align: ' . ($isArabic ? 'right' : 'left') . ';
        }
        h1 {
            color: #FF2D20;
            border-bottom: 3px solid #FF2D20;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        h2 {
            color: #2D3748;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 8px;
            margin-top: 25px;
        }
        h3 {
            color: #4A5568;
            margin-top: 20px;
        }
        code {
            background-color: #F7FAFC;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: "Courier New", monospace;
            font-size: 90%;
        }
        pre {
            background-color: #2D3748;
            color: #F7FAFC;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        pre code {
            background-color: transparent;
            color: #F7FAFC;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th,
        table td {
            border: 1px solid #E2E8F0;
            padding: 10px;
            text-align: ' . ($isArabic ? 'right' : 'left') . ';
        }
        table th {
            background-color: #EDF2F7;
            font-weight: bold;
        }
        ul, ol {
            margin: 15px 0;
            padding-' . ($isArabic ? 'right' : 'left') . ': 25px;
        }
        li {
            margin: 8px 0;
        }
        blockquote {
            border-' . ($isArabic ? 'right' : 'left') . ': 4px solid #FF2D20;
            padding-' . ($isArabic ? 'right' : 'left') . ': 20px;
            margin: 20px 0;
            background-color: #FFF5F5;
        }
        hr {
            border: none;
            border-top: 2px solid #E2E8F0;
            margin: 30px 0;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
    ';

    // Combine CSS and HTML
    $fullHtml = '
    <!DOCTYPE html>
    <html lang="' . ($isArabic ? 'ar' : 'en') . '">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel Lesson</title>
        ' . $css . '
    </head>
    <body>
        ' . $html . '
    </body>
    </html>
    ';

    // Configure DomPDF
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isFontSubsettingEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');

    // Create PDF
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($fullHtml);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Save PDF
    file_put_contents($pdfFile, $dompdf->output());

    echo "✓ Created: " . basename($pdfFile) . "\n";
}

// Generate PDFs
echo "Generating PDFs...\n\n";

// Arabic PDF
markdownToPdf(
    'lessons/lesson-01/README.md',
    'lessons/lesson-01/Lesson-01-Arabic.pdf',
    true
);

// English PDF
markdownToPdf(
    'lessons/lesson-01/README-EN.md',
    'lessons/lesson-01/Lesson-01-English.pdf',
    false
);

echo "\n✓ All PDFs generated successfully!\n";
