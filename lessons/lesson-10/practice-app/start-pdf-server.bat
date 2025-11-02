@echo off
echo.
echo ========================================
echo   PDF Documentation System
echo   Lesson 10 - Laravel Middleware
echo ========================================
echo.
echo Starting Laravel server...
echo.
echo Once the server starts, open your browser to:
echo http://localhost:8000/pdf
echo.
echo Press Ctrl+C to stop the server
echo.
echo ========================================
echo.

cd /d "%~dp0"
php artisan serve

pause
