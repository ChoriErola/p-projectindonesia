# Tampilan Pesanan untuk Pemilik (Owner)

## Deskripsi Fitur

Pemilik (owner) dapat melihat detail pesanan pelanggan melalui dua halaman:
1. **Pesanan Masuk** - Daftar pesanan terbaru yang masuk
2. **Laporan Pesanan** - Laporan historis pesanan dengan filter bulan/tahun/status

## Fitur Keamanan

- ✅ Hanya role 'pemilik' yang bisa akses
- ✅ Semua field dalam mode **read-only** (tidak bisa edit)
- ✅ Tidak ada tombol Create, Edit, atau Delete
- ✅ Tidak ada form submission
- ✅ Hanya bisa melihat dan download bukti pembayaran

## Struktur Tampilan Detail Pesanan

### Section 1: Detail Order
Menampilkan informasi dasar pesanan:
- **Customer**: Nama pelanggan
- **Kode Order**: Nomor pesanan (WO-XXXXX)
- **Tanggal Acara**: Kapan acara dilaksanakan

### Section 2: Paket dan Layanan
Menampilkan paket yang dipilih dan layanan yang termasuk:
- **Paket**: Nama paket yang dipilih
- **Daftar Layanan (Dipilih)**: List layanan dengan harga per layanan
- **Harga Paket (Terpilih)**: Total dari paket
- **Total Harga**: Harga final (paket + layanan tambahan)

### Section 3: Detail Pembayaran
Menampilkan status pembayaran pesanan:
- **Status Order**: Status pesanan (Pending, Confirmed, Paid In Progress, dll)
- **Bukti Pembayaran**: Gambar-gambar bukti transfer (bisa di-download)
- **Pembayaran Diterima**: Jumlah uang yang sudah diterima
- **Sisa Pembayaran**: Dihitung otomatis (Total - Pembayaran Diterima)

### Section 4: Informasi Alamat & Catatan
- **Alamat Acara**: Lokasi tempat acara
- **Catatan**: Catatan umum terkait pesanan

## Halaman Pesanan Masuk

### URL
`/admin/pesanan-masuk`

### Fitur Daftar
- Kolom: Kode Order, Customer, Acara, Paket, Tanggal Acara, Tanggal Pemesanan, Status, Total Harga
- Filter: Status (Pending, Confirmed, Paid In Progress, dll)
- Sorting: Ascending/Descending
- Search: Kode Order, Customer, Acara

### Aksi
- **View Icon** - Klik untuk melihat detail pesanan

## Halaman Laporan Pesanan

### URL
`/admin/laporan-pesanan`

### Fitur Daftar
- Kolom: Kode Order, Customer, Acara, Tanggal Acara, Tanggal Pemesanan, Status, Total Harga
- Filter: 
  - Status (Pending, Confirmed, Paid In Progress, dll)
  - Bulan (Januari - Desember)
  - Tahun (Numeric)
- Sorting: Ascending/Descending
- Search: Kode Order, Customer, Acara

### Aksi
- **View Icon** - Klik untuk melihat detail pesanan

## Flow Penggunaan

### 1. Akses Pesanan Masuk
```
Menu Pesanan > Pesanan Masuk
```

### 2. Lihat Daftar Pesanan
- Tampil tabel dengan semua pesanan terbaru
- Bisa filter berdasarkan status
- Bisa search nama customer atau kode order

### 3. Klik View Icon
- Tampil halaman detail pesanan
- Semua field dalam mode read-only
- Bisa download bukti pembayaran

### 4. Akses Laporan Pesanan (Opsional)
```
Menu Pesanan > Laporan Pesanan
```

- Halaman serupa dengan Pesanan Masuk
- Tambahan filter berdasarkan bulan/tahun
- Berguna untuk analisis historis

## Contoh Data yang Ditampilkan

```
Pesanan Acara Pernikahan - 25 Jan 2026
═════════════════════════════════════

DETAIL ORDER
  Customer: Budi Santoso
  Kode Order: WO-2025001
  Tanggal Acara: 15 February 2026

PAKET DAN LAYANAN
  Paket: Gold Wedding (Rp 15.000.000)
  
  Daftar Layanan:
  • Dekorasi: Rp 10.000.000
  • Catering: Rp 5.000.000
  
  Harga Paket: Rp 15.000.000
  Total Harga: Rp 15.000.000

DETAIL PEMBAYARAN
  Status Order: Paid In Progress
  
  Bukti Pembayaran: 
  [Download Image 1] [Download Image 2]
  
  Pembayaran Diterima: Rp 10.000.000
  Sisa Pembayaran: Rp 5.000.000

INFORMASI ALAMAT & CATATAN
  Alamat Acara: Jl. Gatot Subroto No. 123, Jakarta Pusat
  Catatan: Acara dimulai jam 19.00. Dekorasi disesuaikan tema emas dan putih.
```

## Catatan Penting

- Tampilan detail pesanan pemilik **identik** dengan admin, hanya saja:
  - **Admin**: Bisa edit semua field dan status
  - **Pemilik**: Hanya bisa view, semua field read-only
  
- Sisa Pembayaran dihitung otomatis berdasarkan:
  ```
  Sisa = Total Harga - Pembayaran Diterima
  ```

- Bukti pembayaran hanya tampil jika ada file gambar
- Status Order menampilkan status terbaru pesanan
