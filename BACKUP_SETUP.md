# Panduan Automated Database Backup

## Daftar File Yang Dibuat

1. **app/Console/Commands/BackupDatabase.php** - Command Artisan untuk backup
2. **app/Console/Kernel.php** - Scheduler untuk mengatur jadwal backup
3. **backup-database.bat** - Script batch untuk Windows Task Scheduler
4. **storage/backups/** - Folder untuk menyimpan backup file

---

## 🚀 Setup Automated Backup

### Opsi 1: Menggunakan Laravel Scheduler + Windows Task Scheduler (Recommended)

#### Step 1: Buat Task di Windows Task Scheduler

1. Buka **Task Scheduler**:
   - Tekan `Win + R`
   - Ketik `taskschd.msc` dan tekan Enter

2. Di panel kanan, klik **"Create Basic Task..."**

3. Isi form dengan:
   - **Name**: `P Project Indonesia - Database Backup`
   - **Description**: `Backup database secara otomatis setiap hari`
   - Click **Next**

4. Di **Trigger** (Pemicu):
   - Pilih **Daily**
   - Tentukan waktu (contoh: 02:00 - jam 2 pagi)
   - Click **Next**

5. Di **Action** (Aksi):
   - Pilih **Start a program**
   - **Program/script**: 
     ```
     C:\PHP\php.exe
     ```
     (Atau gunakan path PHP dari Laragon: `D:\laragon\bin\php\php-8.x.x-Win32-nts-x64\php.exe`)
   
   - **Add arguments (optional)**:
     ```
     D:\laragon\www\p-projectindonesia\artisan backup:database
     ```
   
   - **Start in (optional)**:
     ```
     D:\laragon\www\p-projectindonesia
     ```
   
   - Click **Next**

6. Review summary dan click **Finish**

7. **Test Task** (opsional):
   - Klik kanan task yang baru dibuat
   - Pilih **Run** untuk test

---

### Opsi 2: Manual Backup (Cepat)

Jalankan command ini di terminal:

```bash
php artisan backup:database
```

Output contoh:
```
➤ Memulai backup database...
✓ Backup berhasil dibuat!
  File: p_projectindonesia_2026-03-24_14-30-45.sql
  Ukuran: 5.23 MB
  Path: D:\laragon\www\p-projectindonesia\storage\backups\p_projectindonesia_2026-03-24_14-30-45.sql
```

---

### Opsi 3: Menggunakan Batch File

Jalankan file batch yang sudah dibuat:
```
backup-database.bat
```

Atau setup di Windows Task Scheduler dengan:
- **Program/script**: `D:\laragon\www\p-projectindonesia\backup-database.bat`

---

## 📂 Lokasi Backup File

Semua file backup disimpan di:
```
D:\laragon\www\p-projectindonesia\storage\backups\
```

Nama file format: `p_projectindonesia_YYYY-MM-DD_HH-mm-ss.sql`

Contoh:
- `p_projectindonesia_2026-03-24_14-30-45.sql`
- `p_projectindonesia_2026-03-25_02-00-00.sql`

---

## 🧹 Auto Cleanup

Backup file yang lebih dari **7 hari** akan otomatis dihapus saat backup baru dibuat.

Untuk mengubah durasi, edit file `app/Console/Commands/BackupDatabase.php`:
```php
$this->cleanOldBackups($backupPath, 7);  // Ubah 7 ke angka hari yang diinginkan
```

---

## 🔧 Troubleshooting

### Problem: PHP tidak ditemukan di Task Scheduler

**Solusi 1**: Gunakan full path PHP dari Laragon
```
D:\laragon\bin\php\php-8.3.25-Win32-nts-x64\php.exe
```

**Solusi 2**: Ubah environment variable PATH Windows

---

### Problem: mysqldump tidak ditemukan

Command akan otomatis mencari mysqldump di:
- `D:\laragon\bin\mysql\mysql-5.7.39-winx64\bin\mysqldump.exe`
- `D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe`
- System PATH

Jika masih tidak ditemukan, bersihkan dan reinstall Laragon.

---

### Problem: Backup gagal karena permission

**Solusi**:
1. Pastikan folder `storage/backups/` writeable
2. Jalankan Task Scheduler dengan administrator privilege
3. Check log di `storage/logs/laravel.log`

---

## 📊 Cek Status Backup

### Lihat backup file yang sudah ada:
```bash
php artisan tinker
>>> collect(glob(storage_path('backups/*.sql')))->map(fn($f) => basename($f) . ' (' . human_filesize(filesize($f)) . ')')
```

### Lihat log backup:
```bash
tail -f storage/logs/laravel.log
```

---

## 💾 Restore dari Backup

### Method 1: Menggunakan MySQL Command

```bash
mysql -u root p_projectindonesia < storage/backups/p_projectindonesia_2026-03-24_14-30-45.sql
```

### Method 2: Menggunakan phpMyAdmin

1. Buka phpMyAdmin: `http://127.0.0.1/phpmyadmin`
2. Pilih database `p_projectindonesia`
3. Klik tab **Import**
4. Pilih file backup
5. Click **Go**

---

## 🛡️ Best Practices

1. ✅ **Backup reguler** - Minimal 1x per hari
2. ✅ **Cek log** - Verifikasi backup berhasil
3. ✅ **Test restore** - Pastikan backup bisa di-restore
4. ✅ **Cloud backup** - Copy backup ke cloud storage (Google Drive, etc)
5. ✅ **Monitor ukuran** - Pastikan disk cukup untuk backup

---

## 📝 Jadwal Backup yang Direkomendasikan

| Frekuensi | Waktu Optimal | Use Case |
|-----------|--------------|----------|
| 1x/hari   | 02:00 (dini hari) | Produksi normal |
| 2x/hari   | 01:00 dan 13:00 | High traffic |
| Setiap 6 jam | 00:00, 06:00, 12:00, 18:00 | Critical data |

---

## ❓ FAQ

**Q: Berapa ukuran backup yang diharapkan?**
A: Tergantung data. Rata-rata 5-10 MB untuk database yang normal.

**Q: Apakah backup mempengaruhi performa aplikasi?**
A: Tidak signifikan, backup berjalan di background. Durasi tergantung ukuran database.

**Q: Bagaimana jika backup gagal?**
A: Command akan log error ke `storage/logs/laravel.log`. Check file log untuk detail error.

**Q: Bisakah backup di-schedule lebih sering?**
A: Ya, ubah di `app/Console/Kernel.php`:
```php
// Setiap 6 jam
->everyFourHours()

// Setiap 2 jam
->everyTwoHours()

// Setiap jam
->hourly()
```

---

## 📞 Support

Jika ada masalah:
1. Check `storage/logs/laravel.log`
2. Test manual: `php artisan backup:database`
3. Verifikasi path PHP dan MySQL
4. Cek storage/backups folder permissions

