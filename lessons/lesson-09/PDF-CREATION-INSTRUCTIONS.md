# PDF Creation Instructions for Lesson 9

## Files to Create:
1. README-EN.pdf
2. README-AR.pdf
3. PRACTICE-GUIDE-English.pdf
4. PRACTICE-GUIDE-Arabic.pdf
5. QUICK-REFERENCE-English.pdf
6. QUICK-REFERENCE-Arabic.pdf

---

## Method 1: Using Pandoc (Recommended)

### Step 1: Install Pandoc

**Option A: Using Chocolatey (if installed)**
```bash
choco install pandoc
choco install miktex  # For PDF support
```

**Option B: Download Installer**
1. Visit: https://pandoc.org/installing.html
2. Download Windows installer
3. Install pandoc
4. Install MiKTeX or TinyTeX for PDF support: https://miktex.org/

### Step 2: Run the Conversion Script

Simply double-click the `convert-to-pdf.bat` file in this folder, or run:
```bash
cd D:\learnlaravel2025\lessons\lesson-09
convert-to-pdf.bat
```

This will create all 6 PDF files automatically.

---

## Method 2: Using VS Code Extension

### Step 1: Install Extension
1. Open VS Code
2. Go to Extensions (Ctrl+Shift+X)
3. Search for "Markdown PDF"
4. Install the extension by yzane

### Step 2: Convert Each File
1. Open README-EN.md
2. Right-click in editor → "Markdown PDF: Export (pdf)"
3. Rename to README-EN.pdf
4. Repeat for all 6 markdown files

---

## Method 3: Using Online Converter

### Recommended Sites:
- https://www.markdowntopdf.com/
- https://md2pdf.netlify.app/
- https://cloudconvert.com/md-to-pdf

### Steps:
1. Upload each markdown file
2. Download the generated PDF
3. Save with the correct name in the lesson-09 folder

---

## Method 4: Using Chrome/Edge Print to PDF

### Steps:
1. Install a markdown viewer extension for Chrome/Edge:
   - "Markdown Viewer" or "Markdown Preview Plus"
2. Open each .md file in the browser
3. Press Ctrl+P (Print)
4. Choose "Save as PDF"
5. Save with the correct name

---

## Method 5: Manual Creation

If you want to create PDFs manually:

### Using Microsoft Word:
1. Open Word
2. Copy content from markdown file
3. Format as needed
4. File → Save As → PDF

### Using Google Docs:
1. Open Google Docs
2. Paste markdown content
3. Format as needed
4. File → Download → PDF

---

## Expected File Names:

| Markdown File | PDF File Name |
|--------------|---------------|
| README-EN.md | README-EN.pdf |
| README.md (Arabic) | README-AR.pdf |
| PRACTICE-GUIDE-EN.md | PRACTICE-GUIDE-English.pdf |
| PRACTICE-GUIDE-AR.md | PRACTICE-GUIDE-Arabic.pdf |
| QUICK-REFERENCE-EN.md | QUICK-REFERENCE-English.pdf |
| QUICK-REFERENCE.md (Arabic) | QUICK-REFERENCE-Arabic.pdf |

---

## Verification

After creating PDFs, verify by running:
```bash
cd D:\learnlaravel2025\lessons\lesson-09
ls -la *.pdf
```

You should see 6 PDF files listed.

---

## Troubleshooting

### Pandoc: "pdflatex not found"
- Install MiKTeX: https://miktex.org/
- Or use `--pdf-engine=wkhtmltopdf` instead of xelatex

### Arabic text not displaying correctly
- Use `--pdf-engine=xelatex` (supports Unicode)
- Install appropriate Arabic fonts

### Permission denied errors
- Run command prompt as Administrator
- Check file is not open in another program

---

## Quick Command (if pandoc is installed):

```bash
cd D:\learnlaravel2025\lessons\lesson-09

pandoc README-EN.md -o README-EN.pdf
pandoc README.md -o README-AR.pdf
pandoc PRACTICE-GUIDE-EN.md -o PRACTICE-GUIDE-English.pdf
pandoc PRACTICE-GUIDE-AR.md -o PRACTICE-GUIDE-Arabic.pdf
pandoc QUICK-REFERENCE-EN.md -o QUICK-REFERENCE-English.pdf
pandoc QUICK-REFERENCE.md -o QUICK-REFERENCE-Arabic.pdf
```

---

**Note:** The `convert-to-pdf.bat` script in this folder does exactly this automatically!
