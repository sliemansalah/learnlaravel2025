<?php

require 'vendor/autoload.php';

use Mpdf\Mpdf;

// Function to convert markdown to PDF using mPDF
function markdownToPdfMpdf($markdownFile, $pdfFile, $isArabic = false) {
    echo "Processing: " . basename($markdownFile) . "\n";

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

    // Add CSS for better formatting - Quick Reference Card Style
    $css = '
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            line-height: 1.6;
            color: #2D3748;
            direction: ' . ($isArabic ? 'rtl' : 'ltr') . ';
            text-align: ' . ($isArabic ? 'right' : 'left') . ';
            font-size: 11pt;
        }
        h1 {
            color: #FF2D20;
            border-bottom: 4px solid #FF2D20;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 24px;
            text-align: center;
            page-break-after: avoid;
        }
        h2 {
            color: #2D3748;
            background-color: #EDF2F7;
            padding: 8px 12px;
            margin-top: 20px;
            margin-bottom: 12px;
            font-size: 16px;
            border-' . ($isArabic ? 'right' : 'left') . ': 4px solid #FF2D20;
            page-break-after: avoid;
        }
        h3 {
            color: #4A5568;
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 14px;
            page-break-after: avoid;
        }
        p {
            margin: 8px 0;
            line-height: 1.6;
        }
        code {
            background-color: #F7FAFC;
            padding: 2px 5px;
            border-radius: 3px;
            font-family: "Courier New", monospace;
            font-size: 10pt;
            color: #C53030;
            border: 1px solid #E2E8F0;
        }
        pre {
            background-color: #2D3748;
            color: #F7FAFC;
            padding: 12px;
            border-radius: 5px;
            overflow-x: auto;
            margin: 12px 0;
            line-height: 1.4;
            direction: ltr;
            text-align: left;
            page-break-inside: avoid;
            font-size: 9pt;
        }
        pre code {
            background-color: transparent;
            color: #F7FAFC;
            padding: 0;
            border: none;
            font-size: 9pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background-color: white;
            page-break-inside: avoid;
            font-size: 10pt;
        }
        table th,
        table td {
            border: 1px solid #CBD5E0;
            padding: 8px;
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
            margin: 12px 0;
            padding-' . ($isArabic ? 'right' : 'left') . ': 25px;
            line-height: 1.6;
        }
        li {
            margin: 6px 0;
        }
        blockquote {
            border-' . ($isArabic ? 'right' : 'left') . ': 4px solid #FF2D20;
            padding: 10px 15px;
            margin: 15px 0;
            background-color: #FFF5F5;
            border-radius: 3px;
            page-break-inside: avoid;
        }
        hr {
            border: none;
            border-top: 2px solid #E2E8F0;
            margin: 20px 0;
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
        /* Special styling for quick reference */
        .quick-ref-section {
            background-color: #F7FAFC;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
    ';

    // Combine CSS and HTML
    $fullHtml = '
    <!DOCTYPE html>
    <html lang="' . ($isArabic ? 'ar' : 'en') . '" dir="' . ($isArabic ? 'rtl' : 'ltr') . '">
    <head>
        <meta charset="UTF-8">
        <title>Quick Reference - Lesson 1</title>
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
echo "╔════════════════════════════════════════╗\n";
echo "║  Generating Quick Reference PDFs...    ║\n";
echo "╚════════════════════════════════════════╝\n\n";

try {
    // Arabic PDF
    echo "📄 Creating Arabic PDF...\n";
    markdownToPdfMpdf(
        'lessons/lesson-01/QUICK-REFERENCE.md',
        'lessons/lesson-01/QUICK-REFERENCE-Arabic.pdf',
        true
    );
    echo "\n";

    // English PDF
    echo "📄 Creating English PDF...\n";
    markdownToPdfMpdf(
        'lessons/lesson-01/QUICK-REFERENCE-EN.md',
        'lessons/lesson-01/QUICK-REFERENCE-English.pdf',
        false
    );
    echo "\n";

    echo "╔════════════════════════════════════════╗\n";
    echo "║  ✅ All PDFs generated successfully!   ║\n";
    echo "╚════════════════════════════════════════╝\n";

    echo "\n📁 Files created:\n";
    echo "  - lessons/lesson-01/QUICK-REFERENCE-Arabic.pdf\n";
    echo "  - lessons/lesson-01/QUICK-REFERENCE-English.pdf\n";

} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
