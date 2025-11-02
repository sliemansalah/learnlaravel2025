@echo off
REM فتح PowerShell مع دعم أفضل للعربية

chcp 65001 > nul
powershell.exe -NoExit -Command "cd 'D:\learnlaravel2025'; [Console]::OutputEncoding = [System.Text.Encoding]::UTF8; $Host.UI.RawUI.WindowTitle = 'Laravel - Arabic Support'; Clear-Host; Write-Host '=====================================' -ForegroundColor Cyan; Write-Host 'مرحباً بك في بيئة Laravel' -ForegroundColor Green; Write-Host 'Welcome to Laravel Environment' -ForegroundColor Green; Write-Host '=====================================' -ForegroundColor Cyan; Write-Host ''; Write-Host 'المجلد الحالي: D:\learnlaravel2025' -ForegroundColor Yellow; Write-Host 'Current Directory: D:\learnlaravel2025' -ForegroundColor Yellow; Write-Host ''"
