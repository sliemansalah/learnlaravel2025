# Final PDF Creator - Converts MD -> HTML -> PDF
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Creating PDFs from Markdown" -ForegroundColor Cyan
Write-Host "========================================`n" -ForegroundColor Cyan

# Check for Chrome
$chromePath = "C:\Program Files\Google\Chrome\Application\chrome.exe"
if (-not (Test-Path $chromePath)) {
    $chromePath = "C:\Program Files (x86)\Google\Chrome\Application\chrome.exe"
}

if (-not (Test-Path $chromePath)) {
    Write-Host "ERROR: Chrome not found. Please install Google Chrome." -ForegroundColor Red
    Write-Host "`nAlternative: Open each .md file in VS Code" -ForegroundColor Yellow
    Write-Host "Then press Ctrl+Shift+V (preview) and Ctrl+P (print to PDF)`n" -ForegroundColor Yellow
    pause
    exit
}

# Function to convert markdown to simple HTML
function ConvertTo-HTML {
    param($mdFile, $htmlFile)

    $content = Get-Content $mdFile -Raw -Encoding UTF8

    # Basic markdown to HTML conversion
    $html = @"
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
        pre { background: #f4f4f4; padding: 15px; border-radius: 5px; overflow-x: auto; }
        h1 { color: #333; border-bottom: 2px solid #333; padding-bottom: 10px; }
        h2 { color: #555; border-bottom: 1px solid #ddd; padding-bottom: 8px; margin-top: 30px; }
        h3 { color: #666; margin-top: 25px; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        ul, ol { margin: 15px 0; padding-left: 30px; }
    </style>
</head>
<body>
<pre>$content</pre>
</body>
</html>
"@

    $html | Out-File -FilePath $htmlFile -Encoding UTF8
}

$files = @(
    @{Input="README-EN.md"; Output="README-EN.pdf"},
    @{Input="README.md"; Output="README-AR.pdf"},
    @{Input="PRACTICE-GUIDE-EN.md"; Output="PRACTICE-GUIDE-English.pdf"},
    @{Input="PRACTICE-GUIDE-AR.md"; Output="PRACTICE-GUIDE-Arabic.pdf"},
    @{Input="QUICK-REFERENCE-EN.md"; Output="QUICK-REFERENCE-English.pdf"},
    @{Input="QUICK-REFERENCE.md"; Output="QUICK-REFERENCE-Arabic.pdf"}
)

$count = 0
$success = 0

foreach ($file in $files) {
    $count++
    $mdPath = Join-Path $PSScriptRoot $file.Input
    $pdfPath = Join-Path $PSScriptRoot $file.Output
    $htmlPath = Join-Path $PSScriptRoot "temp_$count.html"

    if (Test-Path $mdPath) {
        Write-Host "[$count/6] $($file.Input) -> $($file.Output)" -ForegroundColor Cyan

        # Convert MD to HTML
        ConvertTo-HTML -mdFile $mdPath -htmlFile $htmlPath

        # Convert HTML to PDF using Chrome
        $args = @(
            "--headless",
            "--disable-gpu",
            "--no-pdf-header-footer",
            "--print-to-pdf=`"$pdfPath`"",
            "`"$htmlPath`""
        )

        Start-Process -FilePath $chromePath -ArgumentList $args -Wait -NoNewWindow

        # Clean up temp HTML
        if (Test-Path $htmlPath) {
            Remove-Item $htmlPath -Force
        }

        if (Test-Path $pdfPath) {
            Write-Host "       SUCCESS!" -ForegroundColor Green
            $success++
        } else {
            Write-Host "       FAILED" -ForegroundColor Red
        }
    } else {
        Write-Host "[$count/6] ERROR: $($file.Input) not found!" -ForegroundColor Red
    }
}

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "  Complete: $success/6 PDFs created" -ForegroundColor Cyan
Write-Host "========================================`n" -ForegroundColor Cyan

if ($success -gt 0) {
    Write-Host "Created PDFs:" -ForegroundColor Green
    Get-ChildItem -Path $PSScriptRoot -Filter "*.pdf" | ForEach-Object {
        Write-Host "  - $($_.Name)" -ForegroundColor White
    }
}

Write-Host ""
pause
