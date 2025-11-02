@echo off
echo.
echo ========================================
echo   Converting Markdown to PDF
echo ========================================
echo.

cd /d "%~dp0"

echo Installing md-to-pdf if needed...
call npm install md-to-pdf
echo.

echo Converting files...
echo.

echo [1/6] Converting README-EN.md...
npx md-to-pdf README-EN.md --dest README-EN.pdf
echo.

echo [2/6] Converting README.md (Arabic)...
npx md-to-pdf README.md --dest README-AR.pdf
echo.

echo [3/6] Converting PRACTICE-GUIDE-EN.md...
npx md-to-pdf PRACTICE-GUIDE-EN.md --dest PRACTICE-GUIDE-English.pdf
echo.

echo [4/6] Converting PRACTICE-GUIDE-AR.md...
npx md-to-pdf PRACTICE-GUIDE-AR.md --dest PRACTICE-GUIDE-Arabic.pdf
echo.

echo [5/6] Converting QUICK-REFERENCE-EN.md...
npx md-to-pdf QUICK-REFERENCE-EN.md --dest QUICK-REFERENCE-English.pdf
echo.

echo [6/6] Converting QUICK-REFERENCE.md (Arabic)...
npx md-to-pdf QUICK-REFERENCE.md --dest QUICK-REFERENCE-Arabic.pdf
echo.

echo.
echo ========================================
echo   Conversion Complete!
echo ========================================
echo.
echo PDFs created in current directory.
echo.

dir /B *.pdf

echo.
pause
