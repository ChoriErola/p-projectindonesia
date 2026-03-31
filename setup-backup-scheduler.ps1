# PowerShell Script untuk Setup Windows Task Scheduler
# Jalankan script ini dengan Administrator privileges!
# Right-click PowerShell -> Run as Administrator

# Check if running as Administrator
$currentUser = [Security.Principal.WindowsIdentity]::GetCurrent()
$principal = New-Object Security.Principal.WindowsPrincipal($currentUser)
$isAdmin = $principal.IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "ERROR: Script harus dijalankan sebagai Administrator!" -ForegroundColor Red
    Write-Host "Silakan right-click PowerShell dan pilih 'Run as Administrator'" -ForegroundColor Yellow
    exit 1
}

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Setup Windows Task Scheduler" -ForegroundColor Cyan
Write-Host "  Database Backup P Project Indonesia" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Configuration
$taskName = "P Project Indonesia - Database Backup"
$projectPath = "D:\laragon\www\p-projectindonesia"
$phpPath = "D:\laragon\bin\php\php-8.3.25-Win32-nts-x64\php.exe"
$backupTime = "02:00"

# Verify paths exist
if (-not (Test-Path $projectPath)) {
    Write-Host "ERROR: Project path tidak ditemukan: $projectPath" -ForegroundColor Red
    exit 1
}

if (-not (Test-Path $phpPath)) {
    Write-Host "WARNING: PHP path default tidak ditemukan" -ForegroundColor Yellow
    Write-Host "Mencari PHP di folder Laragon..." -ForegroundColor Yellow
    
    $phpPaths = @(Get-ChildItem "D:\laragon\bin\php" -Filter "php.exe" -Recurse -ErrorAction SilentlyContinue)
    if ($phpPaths.Count -gt 0) {
        $phpPath = $phpPaths[0].FullName
        Write-Host "  ✓ PHP ditemukan: $phpPath" -ForegroundColor Green
    } else {
        Write-Host "ERROR: PHP tidak ditemukan di Laragon" -ForegroundColor Red
        exit 1
    }
}

Write-Host ""
Write-Host "📋 Konfigurasi:" -ForegroundColor Cyan
Write-Host "  Task Name: $taskName"
Write-Host "  Project Path: $projectPath"
Write-Host "  PHP Path: $phpPath"
Write-Host "  Waktu Backup: $backupTime"
Write-Host ""

# Check if task already exists
$existingTask = Get-ScheduledTask -TaskName $taskName -ErrorAction SilentlyContinue
if ($existingTask) {
    Write-Host "⚠️  Task sudah ada. Menghapus task lama..." -ForegroundColor Yellow
    try {
        Unregister-ScheduledTask -TaskName $taskName -Confirm:$false -ErrorAction Stop
        Write-Host "  ✓ Task lama dihapus" -ForegroundColor Green
    } catch {
        Write-Host "  ERROR: Gagal menghapus task lama: $_" -ForegroundColor Red
        exit 1
    }
}

# Create scheduled task
Write-Host "🔧 Membuat scheduled task..." -ForegroundColor Cyan

try {
    # Action
    $action = New-ScheduledTaskAction `
        -Execute $phpPath `
        -Argument "$projectPath\artisan backup:database" `
        -WorkingDirectory $projectPath

    # Trigger (setiap hari jam 02:00)
    $trigger = New-ScheduledTaskTrigger `
        -Daily `
        -At $backupTime

    # Settings
    $settings = New-ScheduledTaskSettingsSet `
        -AllowStartIfOnBatteries `
        -DontStopIfGoingOnBatteries `
        -StartWhenAvailable

    # Principal (Run with SYSTEM privilege)
    $principal = New-ScheduledTaskPrincipal `
        -UserID "NT AUTHORITY\SYSTEM" `
        -LogonType ServiceAccount `
        -RunLevel Highest

    # Register task
    Register-ScheduledTask `
        -TaskName $taskName `
        -Action $action `
        -Trigger $trigger `
        -Settings $settings `
        -Principal $principal `
        -Force | Out-Null

    Write-Host "  ✓ Task berhasil dibuat!" -ForegroundColor Green

} catch {
    Write-Host "  ERROR: Gagal membuat task: $_" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "✅ Setup berhasil!" -ForegroundColor Green
Write-Host ""
Write-Host "📌 Informasi Task:" -ForegroundColor Cyan
Write-Host "  - Nama: $taskName"
Write-Host "  - Jadwal: Setiap hari pukul $backupTime"
Write-Host "  - Status: Aktif dan siap berjalan"
Write-Host ""

Write-Host "🧪 Test Task:" -ForegroundColor Yellow
Write-Host "  Untuk test backup, buka Task Scheduler:"
Write-Host "  1. Tekan Win+R -> ketik 'taskschd.msc'"
Write-Host "  2. Cari task: '$taskName'"
Write-Host "  3. Klik kanan -> Run (untuk test)"
Write-Host ""

Write-Host "📂 Lokasi Backup:" -ForegroundColor Yellow
Write-Host "  $projectPath\storage\backups\"
Write-Host ""

Write-Host "📖 Dokumentasi lengkap di: $projectPath\BACKUP_SETUP.md" -ForegroundColor Cyan
Write-Host ""

# Offer to test the backup
Write-Host "🎯 Apakah ingin test backup sekarang? (Y/n)" -ForegroundColor Yellow
$response = Read-Host
if ($response -eq 'y' -or $response -eq 'Y' -or $response -eq '') {
    Write-Host ""
    Write-Host "⏳ Menjalankan backup test..." -ForegroundColor Cyan
    Write-Host ""
    
    & $phpPath "$projectPath\artisan" backup:database
    
    Write-Host ""
    Write-Host "✓ Backup test selesai!" -ForegroundColor Green
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Setup selesai! Database backup siap." -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
