# Modal View untuk Owner Orders

## Deskripsi Fitur

Halaman pesanan untuk pemilik (owner) telah diperbarui untuk menampilkan detail pesanan dalam **modal popup** saat mengklik icon mata, mirip dengan halaman Order Histories.

## Perubahan Struktur

### Sebelumnya
- Klik icon mata → Membuka halaman terpisah dengan form detail
- URL: `/admin/owner-orders/{id}` atau `/admin/owner-order-reports/{id}`

### Sekarang
- Klik icon mata → Modal popup langsung terbuka
- Tetap di halaman yang sama
- Tidak ada navigasi URL berubah

## Komponen yang Berubah

### 1. OwnerOrderResource.php
- Hapus import `ViewOwnerOrder` page
- Ubah `actions([ViewAction::make()])` → `recordActions([ViewAction::make()->modalHeading(...)->infolist(...)])`
- Hapus `getPages()` method (hanya ada index)

### 2. OwnerOrderReportResource.php
- Ubah dari action biasa ke `recordActions` dengan modal
- Hapus `ViewOwnerOrderReport` page dari getPages()
- Gunakan infolist yang sama seperti OwnerOrderResource

### 3. OrderDetailsInfolist.php (BARU)
- File infolist baru untuk menampilkan detail dalam modal
- Struktur mirip dengan OrderHistoriesTable::getViewInfolist()
- Menampilkan:
  - Informasi Pesanan (kode, customer, tanggal, acara)
  - Paket dan Layanan (paket, harga, list layanan)
  - Detail Pembayaran (status, amount, base price, tanggal)
  - Sisa Pembayaran (calculated field)
  - Lokasi Acara
  - Catatan (collapsed)
  - Bukti Pembayaran (collapsed)

## Tampilan Modal

### Ukuran
- `modalWidth('4xl')` - Lebar full dengan padding

### Heading
- Format: "Detail Pesanan - WO-XXXXX"

### Content
Menampilkan informasi dalam sections yang organized:

```
┌─────────────────────────────────────────────────────┐
│ Detail Pesanan - WO-2025001                      [×] │
├─────────────────────────────────────────────────────┤
│                                                     │
│ INFORMASI PESANAN                                   │
│ ┌─────────────────────┬──────────────────────────┐ │
│ │ Kode Order: WO-..   │ Pelanggan: Budi Santoso │ │
│ │ Tanggal Acara: ...  │ Nama Acara: Pernikahan  │ │
│ └─────────────────────┴──────────────────────────┘ │
│                                                     │
│ PAKET DAN LAYANAN                                   │
│ Paket: Gold Wedding (Rp 15.000.000)                │
│                                                     │
│ Daftar Layanan:                                     │
│ • Dekorasi: Rp 10.000.000                          │
│ • Catering: Rp 5.000.000                           │
│                                                     │
│ ┌─────────────────────┬──────────────────────────┐ │
│ │ Harga Paket: Rp ... │ Total Harga: Rp ...     │ │
│ └─────────────────────┴──────────────────────────┘ │
│                                                     │
│ DETAIL PEMBAYARAN                                   │
│ ┌─────────────────────┬──────────────────────────┐ │
│ │ Status: Paid In ... │ Pembayaran Diterima: ...│ │
│ │ Harga Paket: Rp ... │ Tanggal Pemesanan: ...  │ │
│ └─────────────────────┴──────────────────────────┘ │
│                                                     │
│ SISA PEMBAYARAN                                     │
│ Sisa Pembayaran: Rp 5.000.000 (merah jika > 0)    │
│                                                     │
│ LOKASI ACARA                                        │
│ Alamat: Jl. Gatot Subroto No. 123, Jakarta Pusat  │
│                                                     │
│ [▶] CATATAN (Collapsed)                            │
│ [▶] BUKTI PEMBAYARAN (Collapsed)                   │
│                                                     │
│                                              [Tutup] │
└─────────────────────────────────────────────────────┘
```

## File yang Dihapus/Tidak Digunakan

- `ViewOwnerOrder.php` (masih ada tapi tidak digunakan)
- `ViewOwnerOrderReport.php` (masih ada tapi tidak digunakan)
- `ViewOwnerOrderForm.php` (masih ada tapi tidak digunakan)

## Keuntungan Modal Popup

1. **UX Lebih Baik**: User tetap di halaman daftar, tidak perlu navigate
2. **Kecepatan**: Loading lebih cepat, tidak perlu reload halaman
3. **Konsistensi**: Mirip dengan Order Histories yang sudah ada
4. **User-Friendly**: Bisa langsung kembali ke daftar tanpa back button
5. **Responsive**: Modal beradaptasi dengan ukuran layar

## Halaman yang Affected

### 1. Pesanan Masuk
- URL: `http://p-projectindonesia.test/panel/owner-orders`
- Klik icon mata → Modal detail muncul
- Semua field read-only

### 2. Laporan Pesanan
- URL: `http://p-projectindonesia.test/panel/owner-order-reports`
- Klik icon mata → Modal detail muncul (sama dengan Pesanan Masuk)
- Dengan filter tambahan (bulan, tahun, status)

## Testing Checklist

- [ ] Pesanan Masuk: Klik icon mata → Modal muncul
- [ ] Modal menampilkan semua detail pesanan dengan benar
- [ ] Sections collapse/expand berfungsi (Catatan, Bukti Pembayaran)
- [ ] Gambar bukti pembayaran bisa di-view
- [ ] Tutup modal → kembali ke daftar
- [ ] Laporan Pesanan: Modal tampil dengan benar
- [ ] Filter bulan/tahun/status berfungsi di Laporan Pesanan
