<?php

require 'vendor/autoload.php';

use Mpdf\Mpdf;

function markdownToHtml($markdown) {
    $parsedown = new Parsedown();
    return $parsedown->text($markdown);
}

function generatePdf($mdFile, $pdfFile, $isRtl = false) {
    if (!file_exists($mdFile)) {
        echo "❌ File not found: $mdFile\n";
        return false;
    }

    $markdown = file_get_contents($mdFile);
    $html = markdownToHtml($markdown);

    $config = [
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 16,
        'margin_bottom' => 16,
        'margin_header' => 9,
        'margin_footer' => 9,
        'default_font' => 'dejavusans',
    ];

    if ($isRtl) {
        $config['directionality'] = 'rtl';
        $config['autoScriptToLang'] = true;
        $config['autoLangToFont'] = true;
    }

    $mpdf = new Mpdf($config);

    $css = '
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            font-size: 28px;
        }
        h2 {
            color: #2980b9;
            margin-top: 25px;
            font-size: 22px;
        }
        h3 {
            color: #16a085;
            font-size: 18px;
        }
        h4 {
            color: #27ae60;
            font-size: 16px;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: "Courier New", monospace;
            font-size: 13px;
        }
        pre {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            direction: ltr;
            text-align: left;
        }
        pre code {
            background-color: transparent;
            color: #ecf0f1;
            padding: 0;
        }
        blockquote {
            border-left: 4px solid #3498db;
            padding-left: 15px;
            color: #555;
            font-style: italic;
            margin: 15px 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 15px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: right;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        ul, ol {
            margin: 10px 0;
            padding-right: 20px;
        }
        li {
            margin: 5px 0;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        hr {
            border: none;
            border-top: 2px solid #ecf0f1;
            margin: 20px 0;
        }
    ';

    $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output($pdfFile, 'F');

    $fileSize = filesize($pdfFile);
    $fileSizeKB = round($fileSize / 1024);
    echo "✅ Generated: $pdfFile ($fileSizeKB KB)\n";
    return true;
}

echo "🚀 Generating Lesson 5 PDFs...\n\n";

$lesson5Dir = __DIR__ . '/lessons/lesson-05';

// Generate main lesson PDFs
echo "📘 Generating Main Lesson PDFs...\n";
generatePdf(
    "$lesson5Dir/README.md",
    "$lesson5Dir/Lesson-05-Arabic.pdf",
    true
);

echo "\n";

// Generate Practice Guide PDFs
echo "📗 Generating Practice Guide PDFs...\n";
generatePdf(
    "$lesson5Dir/PRACTICE-GUIDE-AR.md",
    "$lesson5Dir/PRACTICE-GUIDE-Arabic.pdf",
    true
);
generatePdf(
    "$lesson5Dir/PRACTICE-GUIDE-EN.md",
    "$lesson5Dir/PRACTICE-GUIDE-English.pdf",
    false
);

echo "\n";

// Generate Quick Reference PDFs
echo "📙 Generating Quick Reference PDFs...\n";
generatePdf(
    "$lesson5Dir/QUICK-REFERENCE.md",
    "$lesson5Dir/QUICK-REFERENCE-Arabic.pdf",
    true
);
generatePdf(
    "$lesson5Dir/QUICK-REFERENCE-EN.md",
    "$lesson5Dir/QUICK-REFERENCE-English.pdf",
    false
);

echo "\n✨ All Lesson 5 PDFs generated successfully!\n";
