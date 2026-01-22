# Panduan Implementasi Akses Pemilik (Owner)

## Deskripsi Fitur

Fitur akses pemilik (owner) telah berhasil diimplementasikan dengan fitur-fitur berikut:

### 1. **Dashboard Pemilik**
   - Statistik real-time dengan 5 widgets utama
   - Total Order, Total Pendapatan, Order Terbayar, Order Pending, Order Proses
   - List order terbaru (10 order terakhir)
   - Path akses: `/panel/owner-dashboard`

### 2. **Order Masuk (Incoming Orders)**
   - View semua order dengan status lengkap
   - Filter berdasarkan status order
   - Kolom informasi:
     - Kode Order
     - Nama Customer
     - Acara
     - Paket yang dipesan
     - Tanggal Acara
     - Tanggal Pemesanan
     - Status Order
     - Total Harga
   - Path akses: `/panel/owner-orders` atau via menu "Order Masuk"

### 3. **Laporan Pesanan (Order Reports)**
   - Detail lengkap semua pesanan
   - Filter berdasarkan status
   - Informasi: Kode Order, Customer, Acara, Paket, Tanggal, Total Harga
   - Path akses: `/panel/order-reports` atau via menu "Laporan Pesanan"

### 4. **Laporan Pendapatan (Revenue Reports)**
   - Data pendapatan dari order yang sudah terbayar
   - Filter berdasarkan tanggal pembayaran
   - Informasi: Kode Order, Customer, Acara, Tanggal Pembayaran, Total Harga
   - Path akses: `/panel/revenue-reports` atau via menu "Laporan Pendapatan"

## Setup Instructions

### 1. Membuat User Pemilik Baru

Gunakan command berikut di terminal Laravel:

```bash
php artisan tinker
```

Kemudian jalankan:

```php
$user = App\Models\User::create([
    'name' => 'Nama Pemilik',
    'email' => 'pemilik@example.com',
    'password' => bcrypt('password123'),
    'no_hp' => '0812345678',
    'alamat' => 'Alamat Pemilik',
    'role' => 'pemilik',
]);

exit;
```

### 2. Update User Existing ke Role Pemilik

```php
$user = App\Models\User::where('email', 'email@example.com')->first();
$user->update(['role' => 'pemilik']);
```

### 3. Login sebagai Pemilik

Setelah user dibuat, akses panel Filament di:
```
http://localhost:8000/panel
```

Login dengan email dan password yang telah dibuat.

## File-File yang Ditambahkan/Diubah

### Model
- `app/Models/User.php` - Ditambahkan konstanta `ROLE_PEMILIK = 'pemilik'`

### Pages
- `app/Filament/Pages/OwnerDashboard.php` - Dashboard untuk pemilik
- `app/Filament/Pages/OwnerOrderReports.php` - Laporan pesanan
- `app/Filament/Pages/OwnerRevenueReports.php` - Laporan pendapatan

### Widgets
- `app/Filament/Pages/Widgets/OwnerDashboardStats.php` - Stats untuk dashboard
- `app/Filament/Pages/Widgets/OwnerRecentOrdersWidget.php` - Recent orders widget

### Resources
- `app/Filament/Resources/OwnerOrders/OwnerOrderResource.php` - Resource untuk order masuk
- `app/Filament/Resources/OwnerOrders/Pages/ListOwnerOrders.php` - List page
- `app/Filament/Resources/OwnerOrders/Pages/ViewOwnerOrder.php` - View page

### Views
- `resources/views/filament/pages/owner-order-reports.blade.php`
- `resources/views/filament/pages/owner-revenue-reports.blade.php`

### Configuration
- `app/Providers/Filament/AdminPanelProvider.php` - Diupdate untuk include new pages

## Fitur Keamanan

1. **Role-Based Access Control**: Hanya user dengan role 'pemilik' yang bisa akses fitur owner
2. **Navigation Filtering**: Menu hanya muncul untuk user yang punya akses
3. **Canalization Methods**: Setiap page dan resource memiliki `canAccess()` method

## User Interface

### Menu Structure untuk Owner:
```
├── Dashboard Pemilik (OwnerDashboard)
├── Order
│   └── Order Masuk (OwnerOrderResource)
└── Laporan
    ├── Laporan Pesanan (OwnerOrderReports)
    └── Laporan Pendapatan (OwnerRevenueReports)
```

## Customization

### Mengubah Tampilan Dashboard
Edit file: `app/Filament/Pages/Widgets/OwnerDashboardStats.php`

### Mengubah Kolom di Order List
Edit file: `app/Filament/Resources/OwnerOrders/OwnerOrderResource.php`

### Menambah Filter di Laporan
Edit file: `app/Filament/Pages/OwnerOrderReports.php` atau `OwnerRevenueReports.php`

## Testing

1. **Test Dashboard Access**:
   - Login sebagai pemilik
   - Verify dashboard muncul dan menampilkan data yang benar

2. **Test Order Masuk**:
   - Klik menu "Order Masuk"
   - Verify semua order muncul dengan status
   - Test filter berdasarkan status

3. **Test Laporan Pesanan**:
   - Klik menu "Laporan Pesanan"
   - Verify data lengkap pesanan muncul

4. **Test Laporan Pendapatan**:
   - Klik menu "Laporan Pendapatan"
   - Verify hanya order yang terbayar yang muncul
   - Test date range filter

## Troubleshooting

### Pemilik tidak bisa login
- Pastikan role di database adalah 'pemilik' (lowercase)
- Check di table `users` kolom `role`

### Menu tidak muncul
- Clear browser cache
- Run `php artisan cache:clear`

### Data tidak muncul
- Verify ada order di database
- Check dengan SQL: `SELECT COUNT(*) FROM orders;`

## Future Enhancements

1. Export laporan ke PDF/Excel
2. Chart/grafik untuk revenue trends
3. Email notifications untuk order masuk
4. Mobile-friendly dashboard
5. Custom date ranges untuk report
