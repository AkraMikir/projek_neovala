# Script Instalasi Cloudflare Tunnel untuk Windows
# Jalankan script ini dengan: powershell -ExecutionPolicy Bypass -File install-cloudflare-tunnel.ps1

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Cloudflare Tunnel Installation" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# 1. Buat folder untuk cloudflared
$cloudflaredPath = "C:\cloudflared"
Write-Host "[1/4] Membuat folder cloudflared..." -ForegroundColor Yellow
if (-not (Test-Path $cloudflaredPath)) {
    New-Item -ItemType Directory -Path $cloudflaredPath -Force | Out-Null
    Write-Host "  [OK] Folder dibuat: $cloudflaredPath" -ForegroundColor Green
} else {
    Write-Host "  [OK] Folder sudah ada: $cloudflaredPath" -ForegroundColor Green
}

# 2. Download cloudflared
Write-Host ""
Write-Host "[2/4] Download cloudflared..." -ForegroundColor Yellow
$downloadUrl = "https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-windows-amd64.exe"
$outputFile = "$cloudflaredPath\cloudflared.exe"

if (Test-Path $outputFile) {
    Write-Host "  [INFO] cloudflared.exe sudah ada. Skip download." -ForegroundColor Yellow
    Write-Host "  [OK] Menggunakan file yang sudah ada" -ForegroundColor Green
} else {
    Write-Host "  Downloading dari GitHub..." -ForegroundColor Yellow
    try {
        Invoke-WebRequest -Uri $downloadUrl -OutFile $outputFile -UseBasicParsing
        Write-Host "  [OK] Download selesai!" -ForegroundColor Green
    } catch {
        Write-Host "  [ERROR] Download gagal: $_" -ForegroundColor Red
        Write-Host ""
        Write-Host "  Silakan download manual dari:" -ForegroundColor Yellow
        Write-Host "  $downloadUrl" -ForegroundColor Cyan
        Write-Host "  Simpan sebagai: $outputFile" -ForegroundColor Yellow
        exit 1
    }
}

# 3. Test cloudflared
Write-Host ""
Write-Host "[3/4] Testing cloudflared..." -ForegroundColor Yellow
try {
    $version = & $outputFile --version 2>&1
    Write-Host "  [OK] Cloudflared berhasil diinstall!" -ForegroundColor Green
    Write-Host "  Version: $version" -ForegroundColor Cyan
} catch {
    Write-Host "  [ERROR] Error: $_" -ForegroundColor Red
    exit 1
}

# 4. Buat script helper untuk menjalankan tunnel
Write-Host ""
Write-Host "[4/4] Membuat script helper..." -ForegroundColor Yellow
$helperScriptContent = "@echo off`necho ========================================`necho   Cloudflare Tunnel - Neovala Project`necho ========================================`necho.`necho Memastikan Laravel server berjalan di http://localhost:8000`necho.`npause`necho.`necho Menjalankan Cloudflare Tunnel...`necho.`nC:\cloudflared\cloudflared.exe tunnel --url http://localhost:8000`npause"

$helperScriptPath = "$cloudflaredPath\run-tunnel.bat"
$helperScriptContent | Out-File -FilePath $helperScriptPath -Encoding ASCII -NoNewline
Write-Host "  [OK] Script helper dibuat: $helperScriptPath" -ForegroundColor Green

# Selesai
Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Instalasi Selesai!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Cara menggunakan:" -ForegroundColor Cyan
Write-Host "  1. Jalankan Laravel: php artisan serve" -ForegroundColor White
Write-Host "  2. Jalankan tunnel:" -ForegroundColor White
Write-Host "     - Double-click: $helperScriptPath" -ForegroundColor Yellow
Write-Host "     - Atau di terminal: C:\cloudflared\cloudflared.exe tunnel --url http://localhost:8000" -ForegroundColor Yellow
Write-Host ""
Write-Host "File cloudflared ada di: $outputFile" -ForegroundColor Cyan
Write-Host ""
