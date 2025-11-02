@echo off
echo Converting Lesson 9 Markdown files to PDF...
echo.

cd /d "%~dp0"

echo Converting README-EN.md to README-EN.pdf...
pandoc README-EN.md -o README-EN.pdf --pdf-engine=xelatex

echo Converting README.md to README-AR.pdf...
pandoc README.md -o README-AR.pdf --pdf-engine=xelatex

echo Converting PRACTICE-GUIDE-EN.md to PRACTICE-GUIDE-English.pdf...
pandoc PRACTICE-GUIDE-EN.md -o PRACTICE-GUIDE-English.pdf --pdf-engine=xelatex

echo Converting PRACTICE-GUIDE-AR.md to PRACTICE-GUIDE-Arabic.pdf...
pandoc PRACTICE-GUIDE-AR.md -o PRACTICE-GUIDE-Arabic.pdf --pdf-engine=xelatex

echo Converting QUICK-REFERENCE-EN.md to QUICK-REFERENCE-English.pdf...
pandoc QUICK-REFERENCE-EN.md -o QUICK-REFERENCE-English.pdf --pdf-engine=xelatex

echo Converting QUICK-REFERENCE.md to QUICK-REFERENCE-Arabic.pdf...
pandoc QUICK-REFERENCE.md -o QUICK-REFERENCE-Arabic.pdf --pdf-engine=xelatex

echo.
echo Conversion complete! All PDFs have been created.
echo.
pause
