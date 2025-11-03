/**
 * Markdown to HTML Converter (Node.js)
 * Converts all .md files to HTML with CSS and JS
 */

const fs = require('fs');
const path = require('path');

// HTML Template
const HTML_TEMPLATE = `<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{description}}">
    <title>{{title}} | Laravel Learning</title>
    <link rel="stylesheet" href="{{cssPath}}">
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>🚀 تعلم Laravel من الصفر</h1>
            <p>الدرس الأول: مقدمة إلى Laravel والبيئة التطويرية</p>
        </div>
    </div>

    <nav class="nav-menu">
        <div class="container">
            <ul>
                <li><a href="index.html">الرئيسية</a></li>
                <li><a href="01-theory.html">النظري</a></li>
                <li><a href="02-practice.html">العملي</a></li>
                <li><a href="03-exam-with-answers.html">الاختبار + الحلول</a></li>
                <li><a href="04-exam-only.html">الاختبار فقط</a></li>
                <li><a href="code-examples/README.html">أمثلة الكود</a></li>
                <li><a href="exercises/README.html">التمارين</a></li>
                <li><a href="resources/cheatsheet.html">الموارد</a></li>
            </ul>
        </div>
    </nav>

    <div class="breadcrumb container">
        <a href="index.html">الرئيسية</a>
        <span>›</span>
        <span>{{breadcrumb}}</span>
    </div>

    <main class="content container">
        {{content}}
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>عن الدورة</h3>
                    <p>دورة شاملة لتعلم Laravel من الصفر حتى الاحتراف باللغة العربية</p>
                </div>
                <div class="footer-section">
                    <h3>روابط سريعة</h3>
                    <a href="01-theory.html">الدرس النظري</a>
                    <a href="02-practice.html">التطبيق العملي</a>
                    <a href="exercises/README.html">التمارين</a>
                </div>
                <div class="footer-section">
                    <h3>الموارد</h3>
                    <a href="resources/cheatsheet.html">ورقة الغش</a>
                    <a href="resources/troubleshooting.html">حل المشاكل</a>
                    <a href="resources/further-reading.html">قراءات إضافية</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Laravel Learning Platform. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <script src="{{jsPath}}"></script>
</body>
</html>`;

// Simple Markdown to HTML converter
function markdownToHtml(markdown) {
    let html = markdown;

    // Headings
    html = html.replace(/^### (.*$)/gim, '<h3>$1</h3>');
    html = html.replace(/^## (.*$)/gim, '<h2>$1</h2>');
    html = html.replace(/^# (.*$)/gim, '<h1>$1</h1>');

    // Bold
    html = html.replace(/\*\*(.*?)\*\*/gim, '<strong>$1</strong>');
    html = html.replace(/\_\_(.*?)\_\_/gim, '<strong>$1</strong>');

    // Italic
    html = html.replace(/\*(.*?)\*/gim, '<em>$1</em>');
    html = html.replace(/\_(.*?)\_/gim, '<em>$1</em>');

    // Links
    html = html.replace(/\[([^\]]+)\]\(([^\)]+)\)/gim, '<a href="$2">$1</a>');

    // Images
    html = html.replace(/!\[([^\]]*)\]\(([^\)]+)\)/gim, '<img src="$2" alt="$1">');

    // Inline code
    html = html.replace(/`([^`]+)`/gim, '<code>$1</code>');

    // Code blocks
    html = html.replace(/```(\w+)?\n([\s\S]*?)```/gim, '<pre><code class="language-$1">$2</code></pre>');

    // Lists (unordered)
    html = html.replace(/^\s*[-*+]\s+(.+)$/gim, '<li>$1</li>');
    html = html.replace(/(<li>.*<\/li>)/s, '<ul>$1</ul>');

    // Horizontal rule
    html = html.replace(/^---$/gim, '<hr>');
    html = html.replace(/^\*\*\*$/gim, '<hr>');

    // Blockquote
    html = html.replace(/^>\s+(.+)$/gim, '<blockquote>$1</blockquote>');

    // Paragraphs (simple approach)
    const lines = html.split('\n');
    const processedLines = [];

    for (let i = 0; i < lines.length; i++) {
        const line = lines[i].trim();

        if (!line) {
            processedLines.push('');
            continue;
        }

        // Skip if already wrapped in tag
        if (line.match(/^<(h[1-6]|ul|ol|li|pre|blockquote|table|tr|td|th|hr|div)/)) {
            processedLines.push(line);
        } else if (i === 0 || lines[i-1].trim() === '') {
            processedLines.push(`<p>${line}</p>`);
        } else {
            processedLines.push(line);
        }
    }

    return processedLines.join('\n');
}

// Get all markdown files recursively
function getAllMarkdownFiles(dir, fileList = []) {
    const files = fs.readdirSync(dir);

    files.forEach(file => {
        const filePath = path.join(dir, file);
        const stat = fs.statSync(filePath);

        if (stat.isDirectory()) {
            // Skip html directory
            if (file !== 'html') {
                getAllMarkdownFiles(filePath, fileList);
            }
        } else if (path.extname(file) === '.md') {
            fileList.push(filePath);
        }
    });

    return fileList;
}

// Calculate relative path for CSS/JS
function getRelativePath(htmlFile, baseDir) {
    const relativePath = path.relative(path.dirname(htmlFile), baseDir);
    return relativePath === '' ? '.' : relativePath;
}

// Convert a single markdown file
function convertFile(mdPath, baseDir, htmlDir) {
    console.log(`Converting: ${path.basename(mdPath)}`);

    // Read markdown
    const markdown = fs.readFileSync(mdPath, 'utf8');

    // Convert to HTML
    const htmlContent = markdownToHtml(markdown);

    // Extract title
    const titleMatch = markdown.match(/^#\s+(.+)$/m);
    const title = titleMatch ? titleMatch[1] : path.basename(mdPath, '.md');

    // Extract description
    const descMatch = markdown.match(/^[^#\n].{20,}$/m);
    const description = descMatch ? descMatch[0].substring(0, 150) + '...' : 'Laravel Learning';

    // Breadcrumb
    const breadcrumb = path.basename(mdPath, '.md').replace(/-/g, ' ');

    // Calculate HTML path
    const relativePath = path.relative(baseDir, mdPath);
    const htmlPath = path.join(htmlDir, relativePath.replace('.md', '.html'));

    // Calculate relative paths to assets
    const relativeToAssets = getRelativePath(htmlPath, path.join(htmlDir, 'assets'));
    const cssPath = path.join(relativeToAssets, 'style.css').replace(/\\/g, '/');
    const jsPath = path.join(relativeToAssets, 'script.js').replace(/\\/g, '/');

    // Create full HTML
    let fullHtml = HTML_TEMPLATE
        .replace('{{title}}', title)
        .replace('{{description}}', description)
        .replace('{{breadcrumb}}', breadcrumb)
        .replace('{{content}}', htmlContent)
        .replace('{{cssPath}}', cssPath)
        .replace('{{jsPath}}', jsPath);

    // Create directory if doesn't exist
    const htmlDir2 = path.dirname(htmlPath);
    if (!fs.existsSync(htmlDir2)) {
        fs.mkdirSync(htmlDir2, { recursive: true });
    }

    // Write HTML file
    fs.writeFileSync(htmlPath, fullHtml, 'utf8');

    console.log(`✓ Created: ${path.relative(baseDir, htmlPath)}`);
}

// Main function
function main() {
    console.log('='.repeat(60));
    console.log('Markdown to HTML Converter');
    console.log('='.repeat(60));
    console.log();

    const baseDir = __dirname;
    const htmlDir = path.join(baseDir, 'html');

    // Get all markdown files
    const mdFiles = getAllMarkdownFiles(baseDir);

    console.log(`Found ${mdFiles.length} markdown files`);
    console.log();

    // Convert each file
    mdFiles.forEach(mdFile => {
        try {
            convertFile(mdFile, baseDir, htmlDir);
        } catch (error) {
            console.error(`✗ Error converting ${path.basename(mdFile)}:`, error.message);
        }
    });

    console.log();
    console.log('='.repeat(60));
    console.log(`✓ Conversion complete! HTML files in: ${htmlDir}`);
    console.log('='.repeat(60));
    console.log();
    console.log('Open html/README.html in your browser!');
}

// Run
main();
