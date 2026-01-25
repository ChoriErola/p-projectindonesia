# Fitur View-Only Order untuk Pemilik (Owner)

## Deskripsi
Pemilik (owner) dapat melihat detail pesanan pelanggan melalui dua halaman:
1. **Pesanan Masuk** - Melihat pesanan yang baru masuk
2. **Laporan Pesanan** - Melihat laporan historis pesanan dengan filter

## Resource yang Dibuat

### 1. OwnerOrderResource
**File**: `app/Filament/Resources/OwnerOrders/OwnerOrderResource.php`
- Menampilkan daftar pesanan untuk pemilik
- Hanya dapat view, tidak dapat create/edit/delete
- Method yang diblokir:
  - `canCreate()` → false
  - `canEdit()` → false
  - `canDelete()` → false

### 2. OwnerOrderReportResource
**File**: `app/Filament/Resources/OwnerOrderReports/OwnerOrderReportResource.php`
- Menampilkan laporan pesanan dengan filter bulan/tahun/status
- Hanya dapat view, tidak dapat create/edit/delete
- Sama dengan OwnerOrderResource, fokus pada laporan

## Halaman View

### ViewOwnerOrder
**File**: `app/Filament/Resources/OwnerOrders/Pages/ViewOwnerOrder.php`
- Menampilkan detail pesanan untuk menu "Pesanan Masuk"
- Menggunakan schema `ViewOwnerOrderForm`

### ViewOwnerOrderReport
**File**: `app/Filament/Resources/OwnerOrderReports/Pages/ViewOwnerOrderReport.php`
- Menampilkan detail pesanan untuk menu "Laporan Pesanan"
- Menggunakan schema `ViewOwnerOrderForm` yang sama

## Schema Form

### ViewOwnerOrderForm
**File**: `app/Filament/Resources/OwnerOrders/Schemas/ViewOwnerOrderForm.php`

Menampilkan informasi berikut dalam mode read-only:

#### Section: Detail Order
- Customer (disabled)
- Kode Order (disabled)
- Tanggal Acara (disabled)

#### Section: Detail Pembayaran
- Status Order (disabled)
- Total Harga (disabled, format Rp)
- Pembayaran Diterima (disabled, format Rp)
- Sisa Pembayaran (disabled, otomatis dihitung)
- Bukti Pembayaran (read-only image upload)

#### Textarea
- Alamat Acara (disabled)
- Catatan (disabled)

#### Section: Layanan
- Repeater read-only menampilkan daftar layanan dengan harga

## Fitur Keamanan

1. **Role-based Access**
   - Hanya user dengan role 'pemilik' yang dapat akses
   - Method `canAccess()` mengecek role

2. **Read-Only Mode**
   - Semua field disabled dengan `->disabled()`
   - `->dehydrated(false)` mencegah penyimpanan
   - ViewAction hanya menampilkan data, tidak ada form submission

3. **No Edit/Delete Permission**
   - Resource methods override mencegah:
     - Pembuatan record baru
     - Pengeditan record
     - Penghapusan record
     - Bulk delete

## Navigasi

### Menu untuk Owner
1. **Pesanan** (Grup Navigasi)
   - Pesanan Masuk (ListOwnerOrders)
   - Laporan Pesanan (ListOwnerOrderReports)

Saat pemilik mengklik salah satu pesanan dari list, ia akan diarahkan ke halaman view yang menampilkan detail lengkap pesanan dengan semua informasi pembayaran dan layanan.

## Perbedaan dengan Admin

| Fitur | Admin (OrderResource) | Owner (OwnerOrderResource) |
|-------|----------------------|--------------------------|
| View | ✅ Ya | ✅ Ya |
| Edit | ✅ Ya | ❌ Tidak |
| Delete | ✅ Ya | ❌ Tidak |
| Create | ✅ Ya | ❌ Tidak |
| Approve Payment | ✅ Ya | ❌ Tidak |
| Reject Payment | ✅ Ya | ❌ Tidak |
| Report | ❌ Tidak | ✅ Ya |

## Testing

Untuk menguji fitur:
1. Login sebagai user dengan role 'pemilik'
2. Buka menu "Pesanan Masuk" atau "Laporan Pesanan"
3. Klik salah satu pesanan untuk melihat detail
4. Verifikasi bahwa semua field read-only
5. Coba edit salah satu field (tidak bisa)
6. Coba klik tombol edit/delete (tidak ada atau disabled)
