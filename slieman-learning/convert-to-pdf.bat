@echo off
echo ================================================
echo Converting Files to PDF
echo تحويل الملفات إلى PDF
echo ================================================
echo.

REM Find Chrome executable
set CHROME_PATH=""

if exist "C:\Program Files\Google\Chrome\Application\chrome.exe" (
    set CHROME_PATH="C:\Program Files\Google\Chrome\Application\chrome.exe"
) else if exist "C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" (
    set CHROME_PATH="C:\Program Files (x86)\Google\Chrome\Application\chrome.exe"
) else if exist "%LOCALAPPDATA%\Google\Chrome\Application\chrome.exe" (
    set CHROME_PATH="%LOCALAPPDATA%\Google\Chrome\Application\chrome.exe"
) else (
    echo Chrome not found! Please install Google Chrome.
    echo لم يتم العثور على Chrome! الرجاء تثبيت Google Chrome.
    pause
    exit /b
)

echo Found Chrome: %CHROME_PATH%
echo.

REM Get current directory
set CURRENT_DIR=%~dp0

echo Converting QUIZ-CORRECTION.html to PDF...
echo جاري تحويل QUIZ-CORRECTION.html...
%CHROME_PATH% --headless --disable-gpu --print-to-pdf="%CURRENT_DIR%QUIZ-CORRECTION.pdf" "%CURRENT_DIR%QUIZ-CORRECTION.html"
echo Done! ✓
echo.

echo ================================================
echo Conversion Complete!
echo تم التحويل بنجاح!
echo ================================================
echo.
echo PDF files created:
echo تم إنشاء ملفات PDF:
echo - QUIZ-CORRECTION.pdf
echo.
echo Location: %CURRENT_DIR%
echo.
echo ================================================
echo.
echo For Markdown files (.md), please use one of these methods:
echo للملفات Markdown (.md)، استخدم إحدى هذه الطرق:
echo.
echo 1. Online: https://www.markdowntopdf.com
echo 2. VS Code: Ctrl+Shift+P → "Markdown PDF"
echo 3. Read: HOW-TO-CONVERT-TO-PDF.md
echo.
pause
