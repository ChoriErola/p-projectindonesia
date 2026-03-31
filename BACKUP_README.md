# 🚀 Quick Start - Automated Database Backup

## Setup dalam 3 Langkah

### 1️⃣ **Otomatis (Recommended)**

Jalankan PowerShell script ini dengan Administrator:

```powershell
# Buka PowerShell sebagai Administrator
cd D:\laragon\www\p-projectindonesia
Set-ExecutionPolicy -ExecutionPolicy Bypass -Scope Process -Force
.\setup-backup-scheduler.ps1
```

✅ Script akan otomatis setup Windows Task Scheduler

---

### 2️⃣ **Manual - Backup Sekarang**

```bash
cd D:\laragon\www\p-projectindonesia
php artisan backup:database
```

Output:
```
➤ Memulai backup database...
✓ Backup berhasil dibuat!
  File: p_projectindonesia_2026-03-24_21-10-29.sql
  Ukuran: 58.19 KB
  Path: D:\laragon\www\p-projectindonesia\storage\backups\p_projectindonesia_2026-03-24_21-10-29.sql
```

---

### 3️⃣ **Lokasi Backup**

Semua backup disimpan di:
```
D:\laragon\www\p-projectindonesia\storage\backups\
```

---

## 📚 Dokumentasi Lengkap

Lihat file `BACKUP_SETUP.md` untuk:
- Setup detailed
- Troubleshooting
- Restore data
- Best practices
- FAQ

---

## ✨ Fitur

✅ Backup otomatis setiap hari jam 02:00  
✅ Auto cleanup backup lama (terhapus setelah 7 hari)  
✅ Log backup ke `storage/logs/laravel.log`  
✅ Kompresi file SQL  
✅ Timestamp di setiap backup  

---

## 🛠️ Troubleshooting

**Backup gagal?**
1. Test manual: `php artisan backup:database`
2. Check log: `storage/logs/laravel.log`
3. Verifikasi PATH PHP dan MySQL
4. Baca `BACKUP_SETUP.md` untuk solusi lengkap

---

## 🎯 Next Steps

- [ ] Setup automated backup (jalankan `setup-backup-scheduler.ps1`)
- [ ] Test backup command
- [ ] Verifikasi file di `storage/backups/`
- [ ] Test restore dari backup (optional)
- [ ] Monitor backup di Task Scheduler

---

**Selesai!** Database Anda sekarang terlindungi dengan automated backup. 🎉
