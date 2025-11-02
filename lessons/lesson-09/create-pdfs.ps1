# PowerShell Script to Create PDFs from Markdown
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Markdown to PDF Converter" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$files = @(
    @{Input="README-EN.md"; Output="README-EN.pdf"},
    @{Input="README.md"; Output="README-AR.pdf"},
    @{Input="PRACTICE-GUIDE-EN.md"; Output="PRACTICE-GUIDE-English.pdf"},
    @{Input="PRACTICE-GUIDE-AR.md"; Output="PRACTICE-GUIDE-Arabic.pdf"},
    @{Input="QUICK-REFERENCE-EN.md"; Output="QUICK-REFERENCE-English.pdf"},
    @{Input="QUICK-REFERENCE.md"; Output="QUICK-REFERENCE-Arabic.pdf"}
)

# Check if Chrome is installed
$chromePath = "C:\Program Files\Google\Chrome\Application\chrome.exe"
$edgePath = "C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"

$browser = $null
if (Test-Path $chromePath) {
    $browser = $chromePath
    Write-Host "Found Chrome browser" -ForegroundColor Green
} elseif (Test-Path $edgePath) {
    $browser = $edgePath
    Write-Host "Found Edge browser" -ForegroundColor Green
} else {
    Write-Host "ERROR: Chrome or Edge browser not found!" -ForegroundColor Red
    Write-Host "Please install Chrome or Edge to continue." -ForegroundColor Yellow
    pause
    exit
}

Write-Host ""
Write-Host "Converting markdown files to PDF..." -ForegroundColor Yellow
Write-Host ""

$count = 0
foreach ($file in $files) {
    $count++
    $inputFile = Join-Path $PSScriptRoot $file.Input
    $outputFile = Join-Path $PSScriptRoot $file.Output

    if (Test-Path $inputFile) {
        Write-Host "[$count/6] Converting $($file.Input) -> $($file.Output)..." -ForegroundColor Cyan

        # Convert using Chrome/Edge headless
        & $browser --headless --disable-gpu --print-to-pdf="$outputFile" $inputFile 2>$null

        if (Test-Path $outputFile) {
            Write-Host "      SUCCESS: Created successfully!" -ForegroundColor Green
        } else {
            Write-Host "      FAILED: Could not create PDF" -ForegroundColor Red
        }
    } else {
        Write-Host "[$count/6] ERROR: $($file.Input) not found!" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Conversion Complete!" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "PDF files created:" -ForegroundColor Green
Get-ChildItem -Path $PSScriptRoot -Filter "*.pdf" | ForEach-Object {
    Write-Host "  - $($_.Name)" -ForegroundColor White
}
Write-Host ""
pause
