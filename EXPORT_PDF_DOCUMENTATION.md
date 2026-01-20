# Export PDF Laporan Pesanan - Dokumentasi

## Deskripsi Fitur
Fitur ini memungkinkan Anda untuk export data pesanan dalam bentuk PDF dengan berbagai pilihan filter dan ringkasan. Anda dapat memilih periode tertentu, tipe laporan yang ingin ditampilkan, dan filter berdasarkan customer atau package/service.

## Lokasi Fitur
Fitur export PDF tersedia di menu **Orders > Laporan Pesanan** (OrderReportResource) dan dapat diakses melalui tombol **Export PDF** di bagian header halaman.

## Cara Menggunakan

### 1. Buka Halaman Laporan Pesanan
- Navigasi ke menu **Orders** > **Laporan Pesanan**
- Atau akses langsung di URL: `/admin/order-reports`

### 2. Klik Tombol "Export PDF"
- Tombol "Export PDF" berada di bagian atas halaman (header actions)
- Tombol berwarna hijau dengan ikon download

### 3. Isi Form Export
Setelah klik tombol export, akan muncul modal form dengan field berikut:

#### a. Tanggal Mulai (Wajib)
- Pilih tanggal awal periode yang ingin di-export
- Default: Awal bulan berjalan

#### b. Tanggal Selesai (Wajib)
- Pilih tanggal akhir periode yang ingin di-export
- Default: Hari ini

#### c. Tipe Export (Wajib)
Pilih salah satu tipe laporan:

1. **Semua Data** - Menampilkan semua detail pesanan dalam bentuk tabel lengkap
   - Kolom: Kode Pesanan, Customer, Tanggal, Package, Total Harga, Status
   - Cocok untuk audit lengkap atau arsip

2. **Ringkasan Per Customer** - Data dikelompokkan berdasarkan customer
   - Setiap customer menampilkan daftar pesanannya
   - Menampilkan total harga per customer
   - Cocok untuk billing atau laporan per account

3. **Ringkasan Per Service/Package** - Data dikelompokkan berdasarkan package
   - Setiap package menampilkan pesanan yang menggunakan package tersebut
   - Menampilkan total penjualan per package
   - Cocok untuk analisis penjualan produk

4. **Ringkasan Per Status** - Data dikelompokkan berdasarkan status pembayaran
   - Pesanan dikelompokkan: Unpaid, Paid In Progress, Paid Completed, Completed, Cancelled
   - Cocok untuk cash flow analysis atau outstanding payment tracking

#### d. Filter Customer (Opsional)
- Multi-select dropdown untuk memilih satu atau lebih customer
- Jika dikosongkan, semua customer akan ditampilkan
- Mulai ketik nama customer untuk mencari

#### e. Filter Package/Service (Opsional)
- Multi-select dropdown untuk memilih satu atau lebih package
- Jika dikosongkan, semua package akan ditampilkan
- Hanya pesanan dengan package terpilih yang akan ditampilkan

### 4. Klik "Export"
- Sistem akan memproses data sesuai filter yang dipilih
- File PDF akan otomatis diunduh dengan nama format: `laporan-pesanan-[YYYY-MM-DD]-[YYYY-MM-DD].pdf`

## Ringkasan PDF

Setiap PDF yang di-export akan menampilkan:

### Header
- Judul: "LAPORAN PESANAN"
- Periode: Tanggal mulai - Tanggal selesai
- Tipe Laporan: Sesuai pilihan

### Summary Statistics (Card)
Menampilkan 4 metrik utama:
- **Total Pesanan**: Jumlah pesanan dalam periode
- **Total Revenue**: Total nilai pesanan
- **Sudah Lunas**: Total pesanan dengan status "Paid Completed"
- **Belum Lunas**: Total pesanan unpaid dan in progress

### Detail Laporan
Isi berbeda sesuai tipe export yang dipilih

### Footer
- Timestamp kapan laporan dibuat

## Status Pesanan dalam PDF

Setiap pesanan menampilkan status dengan warna badge:

| Status | Badge | Warna | Arti |
|--------|-------|-------|------|
| paid completed | Lunas | Hijau | Pembayaran selesai |
| paid in progress | Proses | Kuning | Pembayaran sedang diproses |
| confirmed | Belum Bayar | Merah | Menunggu pembayaran |
| completed | Selesai | Biru | Pesanan selesai |
| cancelled | Dibatalkan | Merah | Pesanan dibatalkan |

## Format Mata Uang
Semua nilai uang ditampilkan dalam format:
- Simbol: Rp
- Pemisah ribuan: Titik (.)
- Contoh: Rp 1.000.000

## Kombinasi Filter Contoh

### Contoh 1: Laporan Semua Data untuk Audit Bulanan
- Tanggal Mulai: 1 Januari 2026
- Tanggal Selesai: 31 Januari 2026
- Tipe Export: Semua Data
- Filter Customer: Kosong
- Filter Package: Kosong
→ Result: Tabel lengkap semua pesanan Januari 2026

### Contoh 2: Laporan Customer Tertentu
- Tanggal Mulai: 1 Januari 2026
- Tanggal Selesai: 31 Januari 2026
- Tipe Export: Ringkasan Per Customer
- Filter Customer: Pilih "PT ABC" dan "Budi Santoso"
- Filter Package: Kosong
→ Result: Detail pesanan hanya untuk 2 customer terpilih, dikelompokkan per customer

### Contoh 3: Laporan Penjualan Package Tertentu
- Tanggal Mulai: 1 Januari 2026
- Tanggal Selesai: 31 Januari 2026
- Tipe Export: Ringkasan Per Service/Package
- Filter Customer: Kosong
- Filter Package: Pilih "Paket Premium" dan "Paket Gold"
→ Result: Semua pesanan yang menggunakan Paket Premium atau Gold, dikelompokkan per package

### Contoh 4: Laporan Outstanding Payment
- Tanggal Mulai: 1 Januari 2026
- Tanggal Selesai: 31 Januari 2026
- Tipe Export: Ringkasan Per Status
- Filter Customer: Kosong
- Filter Package: Kosong
→ Result: Semua pesanan dikelompokkan berdasarkan status, fokus pada pesanan "Belum Lunas"

## Integrasi dengan Halaman Utama

### Filter pada Tabel Laporan
Di halaman Laporan Pesanan juga tersedia filter:
- **Status Order**: Filter berdasarkan status pembayaran
- **Tanggal Event**: Range picker untuk filter tanggal

Filter ini berbeda dengan export - digunakan untuk viewing data di halaman, bukan untuk export.

### Fitur Tambahan
- **View Invoice**: Setiap baris pesanan memiliki tombol untuk melihat/membuka invoice yang sesuai
- **Search**: Cari berdasarkan Kode Pesanan, Nama Customer
- **Sort**: Klik kolom header untuk sort

## Tips & Trik

1. **Performa PDF Besar**: Jika export data terlalu banyak (>5000 pesanan), gunakan filter customer atau date range yang lebih sempit untuk performa lebih baik

2. **Format Export Terbaik**:
   - Untuk print: Pilih "Ringkasan Per Customer" atau "Ringkasan Per Service"
   - Untuk archive: Pilih "Semua Data" tanpa filter
   - Untuk analisis: Pilih tipe yang sesuai kebutuhan (Per Customer, Per Service, atau Per Status)

3. **Nama File**: File PDF otomatis diberi nama berdasarkan date range untuk memudahkan identifikasi

4. **Print ke Printer**: PDF dapat langsung diprint atau disimpan sebagai file

## Troubleshooting

### PDF tidak download
- Periksa pop-up blocker browser
- Pastikan sudah mengklik "Export" pada form
- Cek console browser (F12) untuk error

### Data tidak muncul di PDF
- Pastikan ada data dalam periode yang dipilih
- Verifikasi filter customer/package sudah benar
- Cek status pesanan sesuai kriteria

### PDF blank atau error
- Refresh halaman dan coba lagi
- Pastikan user memiliki permission mengakses Laporan Pesanan
- Check Laravel logs di `storage/logs/`

## File Terkait

- **PHP Controller**: `app/Filament/Resources/OrderReports/Pages/ManageOrderReports.php`
- **Resource**: `app/Filament/Resources/OrderReports/OrderReportResource.php`
- **View Blade**: `resources/views/pdf/order-report.blade.php`
- **Model**: `app/Models/Order.php`, `app/Models/Customer.php`, `app/Models/Package.php`

## Update Log

- **v1.0** (2026-01-18): Fitur export PDF awal dengan 4 tipe laporan
  - Semua Data
  - Ringkasan Per Customer
  - Ringkasan Per Service/Package
  - Ringkasan Per Status

---
**Dibuat oleh**: GitHub Copilot
**Terakhir diupdate**: 18 Januari 2026
