#!/usr/bin/env python3
"""
Markdown to HTML Converter
Converts all .md files in lesson-01-intro to HTML with CSS and JS
"""

import os
import re
from pathlib import Path
from html import escape

# Configuration
BASE_DIR = Path(__file__).parent
HTML_DIR = BASE_DIR / 'html'
ASSETS_DIR = HTML_DIR / 'assets'

# HTML Template
HTML_TEMPLATE = '''<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{description}">
    <title>{title} | Laravel Learning</title>
    <link rel="stylesheet" href="{css_path}">
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
                <li><a href="code-examples.html">أمثلة الكود</a></li>
                <li><a href="exercises.html">التمارين</a></li>
                <li><a href="resources.html">الموارد</a></li>
            </ul>
        </div>
    </nav>

    <div class="breadcrumb container">
        <a href="index.html">الرئيسية</a>
        <span>›</span>
        <span>{breadcrumb}</span>
    </div>

    <main class="content container">
        {content}
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
                    <a href="exercises.html">التمارين</a>
                </div>
                <div class="footer-section">
                    <h3>الموارد</h3>
                    <a href="resources-cheatsheet.html">ورقة الغش</a>
                    <a href="resources-troubleshooting.html">حل المشاكل</a>
                    <a href="resources-further-reading.html">قراءات إضافية</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Laravel Learning Platform. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <script src="{js_path}"></script>
</body>
</html>'''


class MarkdownConverter:
    def __init__(self):
        self.in_code_block = False
        self.code_language = ''
        self.in_list = False
        self.list_type = ''

    def convert_heading(self, line):
        """Convert markdown heading to HTML"""
        match = re.match(r'^(#{1,6})\s+(.+)$', line)
        if match:
            level = len(match.group(1))
            text = match.group(2).strip()
            # Create ID for heading
            heading_id = re.sub(r'[^\w\s-]', '', text)
            heading_id = re.sub(r'[\s_]+', '-', heading_id).lower()
            return f'<h{level} id="{heading_id}">{self.convert_inline(text)}</h{level}>'
        return None

    def convert_code_block(self, line):
        """Handle code blocks"""
        if line.startswith('```'):
            if not self.in_code_block:
                self.in_code_block = True
                lang = line[3:].strip()
                self.code_language = lang if lang else 'plaintext'
                return f'<pre><code class="language-{self.code_language}">'
            else:
                self.in_code_block = False
                self.code_language = ''
                return '</code></pre>'

        if self.in_code_block:
            return escape(line) + '\n'

        return None

    def convert_list(self, line):
        """Convert lists"""
        # Unordered list
        if re.match(r'^\s*[-*+]\s+', line):
            content = re.sub(r'^\s*[-*+]\s+', '', line)
            if not self.in_list or self.list_type != 'ul':
                self.in_list = True
                self.list_type = 'ul'
                return f'<ul>\n<li>{self.convert_inline(content)}</li>'
            return f'<li>{self.convert_inline(content)}</li>'

        # Ordered list
        if re.match(r'^\s*\d+\.\s+', line):
            content = re.sub(r'^\s*\d+\.\s+', '', line)
            if not self.in_list or self.list_type != 'ol':
                self.in_list = True
                self.list_type = 'ol'
                return f'<ol>\n<li>{self.convert_inline(content)}</li>'
            return f'<li>{self.convert_inline(content)}</li>'

        # Close list if needed
        if self.in_list and line.strip() == '':
            result = f'</{self.list_type}>'
            self.in_list = False
            self.list_type = ''
            return result

        return None

    def convert_blockquote(self, line):
        """Convert blockquote"""
        if line.startswith('>'):
            content = line[1:].strip()
            return f'<blockquote>{self.convert_inline(content)}</blockquote>'
        return None

    def convert_hr(self, line):
        """Convert horizontal rule"""
        if re.match(r'^-{3,}$|^\*{3,}$|^_{3,}$', line.strip()):
            return '<hr>'
        return None

    def convert_table(self, lines, idx):
        """Convert markdown table to HTML"""
        # Check if it's a table
        if '|' not in lines[idx]:
            return None, idx

        table_lines = []
        i = idx

        while i < len(lines) and '|' in lines[i]:
            table_lines.append(lines[i])
            i += 1

        if len(table_lines) < 2:
            return None, idx

        html = '<table>\n<thead>\n<tr>'

        # Header
        headers = [cell.strip() for cell in table_lines[0].split('|') if cell.strip()]
        for header in headers:
            html += f'<th>{self.convert_inline(header)}</th>'
        html += '</tr>\n</thead>\n<tbody>\n'

        # Skip separator line (index 1)
        # Body rows
        for row in table_lines[2:]:
            cells = [cell.strip() for cell in row.split('|') if cell.strip()]
            html += '<tr>'
            for cell in cells:
                html += f'<td>{self.convert_inline(cell)}</td>'
            html += '</tr>\n'

        html += '</tbody>\n</table>'

        return html, i

    def convert_inline(self, text):
        """Convert inline markdown (bold, italic, code, links, etc.)"""
        # Escape HTML first
        text = escape(text)

        # Bold: **text** or __text__
        text = re.sub(r'\*\*(.+?)\*\*', r'<strong>\1</strong>', text)
        text = re.sub(r'__(.+?)__', r'<strong>\1</strong>', text)

        # Italic: *text* or _text_
        text = re.sub(r'\*(.+?)\*', r'<em>\1</em>', text)
        text = re.sub(r'_(.+?)_', r'<em>\1</em>', text)

        # Inline code: `code`
        text = re.sub(r'`([^`]+)`', r'<code>\1</code>', text)

        # Links: [text](url)
        text = re.sub(r'\[([^\]]+)\]\(([^\)]+)\)', r'<a href="\2">\1</a>', text)

        # Images: ![alt](url)
        text = re.sub(r'!\[([^\]]*)\]\(([^\)]+)\)', r'<img src="\2" alt="\1">', text)

        # Checkboxes
        text = re.sub(r'\[ \]', r'<input type="checkbox" disabled>', text)
        text = re.sub(r'\[x\]', r'<input type="checkbox" checked disabled>', text)
        text = re.sub(r'\[X\]', r'<input type="checkbox" checked disabled>', text)

        return text

    def convert_paragraph(self, line):
        """Convert paragraph"""
        if line.strip():
            return f'<p>{self.convert_inline(line)}</p>'
        return ''

    def convert_md_to_html(self, md_content):
        """Main conversion function"""
        lines = md_content.split('\n')
        html_lines = []
        i = 0

        while i < len(lines):
            line = lines[i]

            # Code block
            code_result = self.convert_code_block(line)
            if code_result is not None:
                html_lines.append(code_result)
                i += 1
                continue

            # Skip if in code block
            if self.in_code_block:
                html_lines.append(escape(line) + '\n')
                i += 1
                continue

            # Empty line
            if not line.strip():
                # Close list if needed
                if self.in_list:
                    html_lines.append(f'</{self.list_type}>')
                    self.in_list = False
                    self.list_type = ''
                i += 1
                continue

            # Heading
            heading = self.convert_heading(line)
            if heading:
                html_lines.append(heading)
                i += 1
                continue

            # Horizontal rule
            hr = self.convert_hr(line)
            if hr:
                html_lines.append(hr)
                i += 1
                continue

            # Blockquote
            blockquote = self.convert_blockquote(line)
            if blockquote:
                html_lines.append(blockquote)
                i += 1
                continue

            # Table
            table, new_idx = self.convert_table(lines, i)
            if table:
                html_lines.append(table)
                i = new_idx
                continue

            # List
            list_item = self.convert_list(line)
            if list_item:
                html_lines.append(list_item)
                i += 1
                continue

            # Paragraph
            html_lines.append(self.convert_paragraph(line))
            i += 1

        # Close any open lists
        if self.in_list:
            html_lines.append(f'</{self.list_type}>')

        return '\n'.join(html_lines)


def get_relative_path(from_file, to_file):
    """Calculate relative path between files"""
    from_parts = Path(from_file).parts
    to_parts = Path(to_file).parts

    # Count common parts
    common = 0
    for i in range(min(len(from_parts), len(to_parts))):
        if from_parts[i] == to_parts[i]:
            common += 1
        else:
            break

    # Go up from source
    up_levels = len(from_parts) - common - 1
    rel_path = '../' * up_levels

    # Add remaining path to target
    rel_path += '/'.join(to_parts[common:])

    return rel_path


def convert_file(md_path, html_path, css_path, js_path):
    """Convert a single markdown file to HTML"""
    print(f'Converting: {md_path.name} -> {html_path.name}')

    # Read markdown
    with open(md_path, 'r', encoding='utf-8') as f:
        md_content = f.read()

    # Convert to HTML
    converter = MarkdownConverter()
    html_content = converter.convert_md_to_html(md_content)

    # Extract title from first heading or filename
    title_match = re.search(r'^#\s+(.+)$', md_content, re.MULTILINE)
    title = title_match.group(1) if title_match else md_path.stem

    # Description (first paragraph)
    desc_match = re.search(r'^[^#\n].{20,}$', md_content, re.MULTILINE)
    description = desc_match.group(0)[:150] + '...' if desc_match else 'Laravel Learning'

    # Breadcrumb
    breadcrumb = md_path.stem.replace('-', ' ').title()

    # Create full HTML
    full_html = HTML_TEMPLATE.format(
        title=title,
        description=description,
        breadcrumb=breadcrumb,
        content=html_content,
        css_path=css_path,
        js_path=js_path
    )

    # Write HTML
    html_path.parent.mkdir(parents=True, exist_ok=True)
    with open(html_path, 'w', encoding='utf-8') as f:
        f.write(full_html)

    print(f'✓ Created: {html_path.relative_to(BASE_DIR)}')


def main():
    """Main conversion process"""
    print('=' * 60)
    print('Markdown to HTML Converter')
    print('=' * 60)
    print()

    # Find all markdown files
    md_files = list(BASE_DIR.rglob('*.md'))
    md_files = [f for f in md_files if 'html' not in f.parts]  # Exclude html folder

    print(f'Found {len(md_files)} markdown files')
    print()

    # Convert each file
    for md_file in md_files:
        # Calculate HTML path
        rel_path = md_file.relative_to(BASE_DIR)
        html_file = HTML_DIR / rel_path.with_suffix('.html')

        # Calculate relative paths to CSS and JS
        depth = len(html_file.relative_to(HTML_DIR).parts) - 1
        prefix = '../' * depth
        css_rel = f'{prefix}assets/style.css'
        js_rel = f'{prefix}assets/script.js'

        # Convert
        try:
            convert_file(md_file, html_file, css_rel, js_rel)
        except Exception as e:
            print(f'✗ Error converting {md_file.name}: {e}')

    print()
    print('=' * 60)
    print(f'✓ Conversion complete! HTML files in: {HTML_DIR}')
    print('=' * 60)
    print()
    print('Open html/README.html or html/index.html in your browser!')


if __name__ == '__main__':
    main()
