const fs = require('fs');
const path = require('path');
const { exec } = require('child_process');

console.log('==========================================');
console.log('Converting Markdown Files to PDF');
console.log('تحويل ملفات Markdown إلى PDF');
console.log('==========================================\n');

// Find Chrome executable
const chromePaths = [
    'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe',
    process.env.LOCALAPPDATA + '\\Google\\Chrome\\Application\\chrome.exe'
];

let chromePath = null;
for (const p of chromePaths) {
    if (fs.existsSync(p)) {
        chromePath = p;
        break;
    }
}

if (!chromePath) {
    console.error('❌ Chrome not found!');
    console.error('❌ لم يتم العثور على Chrome!');
    process.exit(1);
}

console.log('✓ Found Chrome:', chromePath, '\n');

// Simple Markdown to HTML converter
function markdownToHtml(mdContent, title) {
    // Basic markdown conversion (simplified)
    let html = mdContent
        .replace(/^# (.+)$/gm, '<h1>$1</h1>')
        .replace(/^## (.+)$/gm, '<h2>$1</h2>')
        .replace(/^### (.+)$/gm, '<h3>$1</h3>')
        .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.+?)\*/g, '<em>$1</em>')
        .replace(/`(.+?)`/g, '<code>$1</code>')
        .replace(/^- (.+)$/gm, '<li>$1</li>')
        .replace(/\n\n/g, '</p><p>')
        .replace(/```(\w+)?\n([\s\S]+?)```/g, '<pre><code>$2</code></pre>');

    // Wrap in HTML template
    return `<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>${title}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', 'Segoe UI', sans-serif;
            line-height: 1.8;
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            color: #2c3e50;
            background: white;
        }
        h1 { color: #2c3e50; font-size: 2.5em; margin: 30px 0 20px; border-bottom: 3px solid #3498db; padding-bottom: 15px; }
        h2 { color: #34495e; font-size: 2em; margin: 25px 0 15px; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        h3 { color: #34495e; font-size: 1.5em; margin: 20px 0 10px; }
        p { margin: 15px 0; }
        code { background: #2c3e50; color: #ecf0f1; padding: 3px 8px; border-radius: 4px; font-family: 'Courier New', monospace; }
        pre { background: #2c3e50; color: #ecf0f1; padding: 20px; border-radius: 8px; overflow-x: auto; margin: 20px 0; }
        pre code { background: none; padding: 0; }
        li { margin: 8px 0; margin-right: 20px; }
        strong { color: #3498db; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th { background: #34495e; color: white; padding: 12px; text-align: right; }
        td { padding: 10px; border-bottom: 1px solid #ecf0f1; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 15px; font-size: 0.85em; margin: 0 5px; }
        .correct { background: #d4edda; color: #155724; }
        .incorrect { background: #f8d7da; color: #721c24; }
        @media print {
            body { padding: 20px; }
            pre, code { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
${html}
</body>
</html>`;
}

async function convertToPDF(mdFile, outputPdf) {
    return new Promise((resolve, reject) => {
        console.log(`📄 Converting ${mdFile}...`);

        // Read markdown file
        const mdContent = fs.readFileSync(mdFile, 'utf8');
        const title = path.basename(mdFile, '.md');

        // Convert to HTML
        const htmlContent = markdownToHtml(mdContent, title);
        const tempHtmlFile = mdFile.replace('.md', '-temp.html');

        // Write HTML file
        fs.writeFileSync(tempHtmlFile, htmlContent);

        // Convert HTML to PDF using Chrome
        const cmd = `"${chromePath}" --headless --disable-gpu --print-to-pdf="${outputPdf}" "${tempHtmlFile}"`;

        exec(cmd, (error) => {
            // Delete temp HTML file
            try {
                fs.unlinkSync(tempHtmlFile);
            } catch (e) { }

            if (error) {
                console.error(`❌ Failed: ${mdFile}`);
                reject(error);
            } else {
                console.log(`✅ Created: ${outputPdf}\n`);
                resolve();
            }
        });
    });
}

// Convert files
async function main() {
    const files = [
        {
            md: 'MY-ERRORS-AND-CORRECTIONS.md',
            pdf: 'MY-ERRORS-AND-CORRECTIONS.pdf'
        },
        {
            md: 'QUIZ-MODEL-ANSWERS.md',
            pdf: 'QUIZ-MODEL-ANSWERS.pdf'
        }
    ];

    for (const file of files) {
        if (fs.existsSync(file.md)) {
            try {
                await convertToPDF(file.md, file.pdf);
                // Wait a bit for Chrome to close
                await new Promise(resolve => setTimeout(resolve, 2000));
            } catch (error) {
                console.error(`Error converting ${file.md}:`, error.message);
            }
        } else {
            console.log(`⚠️  File not found: ${file.md}`);
        }
    }

    console.log('==========================================');
    console.log('✅ Conversion Complete!');
    console.log('✅ تم التحويل بنجاح!');
    console.log('==========================================\n');
    console.log('PDF Files Created / ملفات PDF المُنشأة:');
    console.log('1. QUIZ-CORRECTION.pdf (Already done / تم سابقاً)');
    console.log('2. MY-ERRORS-AND-CORRECTIONS.pdf');
    console.log('3. QUIZ-MODEL-ANSWERS.pdf');
    console.log('\nLocation:', __dirname);
}

main().catch(console.error);
