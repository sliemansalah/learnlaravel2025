<?php

require 'vendor/autoload.php';

use Mpdf\Mpdf;

// Function to convert markdown to PDF using mPDF
function markdownToPdfMpdf($markdownFile, $pdfFile, $isArabic = false) {
    // Read markdown content
    $markdown = file_get_contents($markdownFile);

    // Convert markdown to HTML using Parsedown
    $parsedown = new Parsedown();
    $html = $parsedown->text($markdown);

    // Configure mPDF with Arabic support
    $config = [
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 20,
        'margin_bottom' => 20,
        'margin_header' => 10,
        'margin_footer' => 10,
    ];

    if ($isArabic) {
        $config['default_font'] = 'dejavusans';
        $config['directionality'] = 'rtl';
        $config['autoScriptToLang'] = true;
        $config['autoLangToFont'] = true;
    }

    $mpdf = new Mpdf($config);

    // Add CSS for better formatting
    $css = '
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            line-height: 1.8;
            color: #2D3748;
            direction: ' . ($isArabic ? 'rtl' : 'ltr') . ';
            text-align: ' . ($isArabic ? 'right' : 'left') . ';
        }
        h1 {
            color: #FF2D20;
            border-bottom: 4px solid #FF2D20;
            padding-bottom: 12px;
            margin-top: 35px;
            margin-bottom: 20px;
            font-size: 28px;
        }
        h2 {
            color: #2D3748;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 10px;
            margin-top: 28px;
            margin-bottom: 15px;
            font-size: 22px;
        }
        h3 {
            color: #4A5568;
            margin-top: 22px;
            margin-bottom: 12px;
            font-size: 18px;
        }
        h4 {
            color: #718096;
            margin-top: 18px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        p {
            margin: 12px 0;
            line-height: 1.8;
        }
        code {
            background-color: #F7FAFC;
            padding: 3px 7px;
            border-radius: 4px;
            font-family: "Courier New", monospace;
            font-size: 13px;
            color: #C53030;
            border: 1px solid #E2E8F0;
        }
        pre {
            background-color: #2D3748;
            color: #F7FAFC;
            padding: 18px;
            border-radius: 6px;
            overflow-x: auto;
            margin: 18px 0;
            line-height: 1.5;
            direction: ltr;
            text-align: left;
        }
        pre code {
            background-color: transparent;
            color: #F7FAFC;
            padding: 0;
            border: none;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 22px 0;
            background-color: white;
        }
        table th,
        table td {
            border: 1px solid #CBD5E0;
            padding: 12px;
            text-align: ' . ($isArabic ? 'right' : 'left') . ';
        }
        table th {
            background-color: #EDF2F7;
            font-weight: bold;
            color: #2D3748;
        }
        table tr:nth-child(even) {
            background-color: #F7FAFC;
        }
        ul, ol {
            margin: 18px 0;
            padding-' . ($isArabic ? 'right' : 'left') . ': 30px;
            line-height: 1.8;
        }
        li {
            margin: 10px 0;
        }
        blockquote {
            border-' . ($isArabic ? 'right' : 'left') . ': 5px solid #FF2D20;
            padding: 15px 20px;
            margin: 22px 0;
            background-color: #FFF5F5;
            border-radius: 4px;
        }
        hr {
            border: none;
            border-top: 2px solid #E2E8F0;
            margin: 35px 0;
        }
        strong {
            color: #2D3748;
            font-weight: bold;
        }
        em {
            font-style: italic;
        }
        a {
            color: #3182CE;
            text-decoration: none;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
    ';

    // Combine CSS and HTML
    $fullHtml = '
    <!DOCTYPE html>
    <html lang="' . ($isArabic ? 'ar' : 'en') . '" dir="' . ($isArabic ? 'rtl' : 'ltr') . '">
    <head>
        <meta charset="UTF-8">
        <title>Laravel Lesson 1</title>
        ' . $css . '
    </head>
    <body>
        ' . $html . '
    </body>
    </html>
    ';

    // Write HTML to PDF
    $mpdf->WriteHTML($fullHtml);

    // Save PDF
    $mpdf->Output($pdfFile, 'F');

    echo "✓ Created: " . basename($pdfFile) . "\n";
}

// Generate PDFs
echo "Generating PDFs with mPDF...\n\n";

try {
    // Arabic PDF
    echo "Creating Arabic PDF...\n";
    markdownToPdfMpdf(
        'lessons/lesson-01/README.md',
        'lessons/lesson-01/Lesson-01-Arabic.pdf',
        true
    );

    // English PDF
    echo "Creating English PDF...\n";
    markdownToPdfMpdf(
        'lessons/lesson-01/README-EN.md',
        'lessons/lesson-01/Lesson-01-English.pdf',
        false
    );

    echo "\n✅ All PDFs generated successfully!\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
}
