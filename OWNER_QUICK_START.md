# Quick Start - Akses Pemilik

## 1. Jalankan Seeder untuk Membuat User Test

```bash
php artisan db:seed --class=OwnerUserSeeder
```

Atau buat user manual via Tinker:

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'name' => 'Pemilik',
    'email' => 'pemilik@test.com',
    'password' => bcrypt('password123'),
    'no_hp' => '081234567890',
    'alamat' => 'Jakarta',
    'role' => 'pemilik',
]);
```

## 2. Login dengan Role Pemilik

- URL: http://localhost:8000/panel
- Email: pemilik@projectindonesia.test
- Password: password123

## 3. Menu yang Tersedia untuk Pemilik

Setelah login, pemilik akan melihat menu:

- **Dashboard Pemilik** - Overview statistik dan order terbaru
- **Order Masuk** - Daftar semua order yang masuk dengan status
- **Laporan Pesanan** - Detail laporan semua pesanan
- **Laporan Pendapatan** - Laporan pendapatan dari order yang terbayar

## 4. Fitur Utama

### Dashboard Pemilik
- Total Order (jumlah semua order)
- Total Pendapatan (total revenue)
- Order Terbayar (order dengan status paid/completed)
- Order Pending (order yang baru dikonfirmasi)
- Order Proses (order dalam pembayaran)
- Widget Recent Orders (10 order terakhir)

### Order Masuk
- Lihat semua order dengan status lengkap
- Filter berdasarkan status order
- View detail order
- Status yang tersedia:
  - Pending (Menunggu konfirmasi)
  - Confirmed (Dikonfirmasi)
  - Paid in Progress (Pembayaran diproses)
  - Paid Completed (Pembayaran selesai)
  - Completed (Selesai)
  - Cancelled (Dibatalkan)

### Laporan Pesanan
- List semua pesanan dengan detail lengkap
- Filter berdasarkan status
- Informasi: Kode, Customer, Acara, Paket, Tanggal, Status, Harga

### Laporan Pendapatan
- Hanya menampilkan order yang sudah terbayar
- Filter berdasarkan range tanggal pembayaran
- Informasi: Kode, Customer, Acara, Tanggal Pembayaran, Total Harga

## 5. Verifikasi Implementasi

Untuk memastikan semua berfungsi:

1. Check apakah user memiliki role 'pemilik':
   ```bash
   php artisan tinker
   App\Models\User::where('email', 'pemilik@test.com')->first()->role
   # Output: "pemilik"
   ```

2. Verify halaman accessible:
   - /panel/owner-dashboard
   - /panel/owner-orders
   - /panel/order-reports
   - /panel/revenue-reports

3. Check authorization di browser console jika ada error

## 6. Troubleshooting

**Error: "Unauthorized" saat login**
- Pastikan user role = 'pemilik' (lowercase)
- Update User.php canAccessPanel() method sudah benar

**Menu tidak muncul**
- Clear cache: `php artisan cache:clear`
- Clear browser cache
- Restart development server

**Data tidak muncul di widget**
- Pastikan ada order di database: `SELECT COUNT(*) FROM orders;`
- Check order status values valid

## 7. Struktur Database

Pastikan tabel `users` memiliki kolom:
- `role` (varchar) - nilai: 'admin', 'pelanggan', 'pemilik'

Verifikasi dengan:
```bash
php artisan migrate:status
```

Semua migration harus "Ran".
