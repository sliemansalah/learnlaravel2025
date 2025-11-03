/**
 * Improved Markdown to HTML Converter
 * Uses marked library for proper conversion
 */

const fs = require('fs');
const path = require('path');
const { marked } = require('marked');

// Configure marked
marked.setOptions({
    breaks: true,
    gfm: true,
    headerIds: true,
    mangle: false,
    pedantic: false,
    sanitize: false,
    smartLists: true,
    smartypants: true,
    xhtml: false
});

// HTML Template
const HTML_TEMPLATE = `<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{description}}">
    <title>{{title}} | Laravel Learning</title>
    <link rel="stylesheet" href="{{cssPath}}">
    <style>
        /* Additional RTL and code block fixes */
        pre {
            direction: ltr;
            text-align: left;
            position: relative;
        }

        code {
            direction: ltr;
            text-align: left;
        }

        table {
            direction: rtl;
            text-align: right;
        }

        .content > * {
            max-width: 100%;
        }

        /* Fix for lists */
        .content ul,
        .content ol {
            padding-right: 40px;
            padding-left: 0;
        }

        /* Fix for blockquotes */
        .content blockquote {
            border-right: 4px solid var(--primary-color);
            border-left: none;
            padding-right: 20px;
            padding-left: 10px;
            margin-right: 0;
            margin-left: 20px;
        }
    </style>
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
                <li><a href="{{homeLink}}index.html">الرئيسية</a></li>
                <li><a href="{{homeLink}}01-theory.html">النظري</a></li>
                <li><a href="{{homeLink}}02-practice.html">العملي</a></li>
                <li><a href="{{homeLink}}03-exam-with-answers.html">الاختبار + الحلول</a></li>
                <li><a href="{{homeLink}}04-exam-only.html">الاختبار فقط</a></li>
                <li><a href="{{homeLink}}code-examples/README.html">أمثلة الكود</a></li>
                <li><a href="{{homeLink}}exercises/README.html">التمارين</a></li>
                <li><a href="{{homeLink}}resources/cheatsheet.html">الموارد</a></li>
            </ul>
        </div>
    </nav>

    <div class="breadcrumb container">
        <a href="{{homeLink}}index.html">الرئيسية</a>
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
                    <a href="{{homeLink}}01-theory.html">الدرس النظري</a>
                    <a href="{{homeLink}}02-practice.html">التطبيق العملي</a>
                    <a href="{{homeLink}}exercises/README.html">التمارين</a>
                </div>
                <div class="footer-section">
                    <h3>الموارد</h3>
                    <a href="{{homeLink}}resources/cheatsheet.html">ورقة الغش</a>
                    <a href="{{homeLink}}resources/troubleshooting.html">حل المشاكل</a>
                    <a href="{{homeLink}}resources/further-reading.html">قراءات إضافية</a>
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

// Get all markdown files recursively
function getAllMarkdownFiles(dir, fileList = []) {
    const files = fs.readdirSync(dir);

    files.forEach(file => {
        const filePath = path.join(dir, file);
        const stat = fs.statSync(filePath);

        if (stat.isDirectory()) {
            // Skip html and node_modules directories
            if (file !== 'html' && file !== 'node_modules') {
                getAllMarkdownFiles(filePath, fileList);
            }
        } else if (path.extname(file) === '.md') {
            fileList.push(filePath);
        }
    });

    return fileList;
}

// Calculate relative path
function getRelativePath(from, to) {
    const rel = path.relative(path.dirname(from), to);
    return rel.replace(/\\/g, '/');
}

// Calculate home link (back to index)
function getHomeLink(htmlFile, htmlDir) {
    const depth = path.relative(htmlDir, htmlFile).split(path.sep).length - 1;
    return depth > 0 ? '../'.repeat(depth) : './';
}

// Convert a single markdown file
function convertFile(mdPath, baseDir, htmlDir) {
    console.log(`Converting: ${path.basename(mdPath)}`);

    // Read markdown
    const markdown = fs.readFileSync(mdPath, 'utf8');

    // Convert to HTML using marked
    let htmlContent = marked.parse(markdown);

    // Extract title from first h1
    const titleMatch = markdown.match(/^#\s+(.+)$/m);
    const title = titleMatch ? titleMatch[1].replace(/[#*_]/g, '') : path.basename(mdPath, '.md');

    // Extract description from first paragraph
    const lines = markdown.split('\n');
    let description = 'Laravel Learning';
    for (let line of lines) {
        line = line.trim();
        if (line && !line.startsWith('#') && !line.startsWith('-') && line.length > 20) {
            description = line.substring(0, 150).replace(/[#*_\[\]]/g, '');
            break;
        }
    }

    // Breadcrumb
    const breadcrumb = path.basename(mdPath, '.md').replace(/-/g, ' ');

    // Calculate HTML path
    const relativePath = path.relative(baseDir, mdPath);
    const htmlPath = path.join(htmlDir, relativePath.replace('.md', '.html'));

    // Calculate relative paths to assets
    const relativeToAssets = getRelativePath(htmlPath, path.join(htmlDir, 'assets'));
    const cssPath = path.join(relativeToAssets, 'style.css').replace(/\\/g, '/');
    const jsPath = path.join(relativeToAssets, 'script.js').replace(/\\/g, '/');

    // Calculate home link
    const homeLink = getHomeLink(htmlPath, htmlDir);

    // Create full HTML
    let fullHtml = HTML_TEMPLATE
        .replace(/{{title}}/g, title)
        .replace(/{{description}}/g, description)
        .replace(/{{breadcrumb}}/g, breadcrumb)
        .replace(/{{content}}/g, htmlContent)
        .replace(/{{cssPath}}/g, cssPath)
        .replace(/{{jsPath}}/g, jsPath)
        .replace(/{{homeLink}}/g, homeLink);

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
    console.log('Improved Markdown to HTML Converter (with marked)');
    console.log('='.repeat(60));
    console.log();

    const baseDir = __dirname;
    const htmlDir = path.join(baseDir, 'html');

    // Get all markdown files
    const mdFiles = getAllMarkdownFiles(baseDir);

    console.log(`Found ${mdFiles.length} markdown files`);
    console.log();

    // Convert each file
    let successCount = 0;
    let errorCount = 0;

    mdFiles.forEach(mdFile => {
        try {
            convertFile(mdFile, baseDir, htmlDir);
            successCount++;
        } catch (error) {
            console.error(`✗ Error converting ${path.basename(mdFile)}:`, error.message);
            errorCount++;
        }
    });

    console.log();
    console.log('='.repeat(60));
    console.log(`✓ Conversion complete!`);
    console.log(`   Success: ${successCount} files`);
    if (errorCount > 0) {
        console.log(`   Errors: ${errorCount} files`);
    }
    console.log(`   Output: ${htmlDir}`);
    console.log('='.repeat(60));
    console.log();
    console.log('Open html/index.html in your browser!');
}

// Run
main();
