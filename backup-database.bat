@echo off
REM Script Backup Database untuk Windows Task Scheduler
REM Jalankan command artisan backup:database

cd /d D:\laragon\www\p-projectindonesia

REM Jalankan backup
php artisan backup:database

REM Pause agar bisa lihat output (optional, bisa dihapus)
REM pause
