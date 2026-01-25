# Sistem Pelacakan Pembayaran (Payment Tracking System)

## Deskripsi Fitur
Sistem baru memungkinkan admin untuk melacak pembayaran dari pelanggan secara otomatis dengan menghitung sisa pembayaran yang harus dibayarkan.

## Komponen Sistem

### 1. Field "Pembayaran Diterima" (Amount Paid)
- **Tipe**: Input Numerik
- **Format**: Rp (Rupiah)
- **Kegunaan**: Admin menginputkan jumlah pembayaran yang sudah diterima dari pelanggan
- **Visibilitas**: Hanya muncul ketika status order adalah "Paid In Progress"

### 2. Field "Sisa Pembayaran" (Remaining Payment)
- **Tipe**: Read-Only / Disabled
- **Format**: Rp (Rupiah)
- **Kegunaan**: Menampilkan sisa pembayaran yang masih harus dibayarkan pelanggan
- **Kalkulasi**: `Sisa Pembayaran = Total Harga - Pembayaran Diterima`
- **Visibilitas**: Hanya muncul ketika status order adalah "Paid In Progress"
- **Update Otomatis**: Terhitung ulang secara real-time ketika admin mengubah nilai "Pembayaran Diterima"

### 3. Field "Catatan Pembayaran" (Payment Note)
- **Tipe**: Textarea
- **Kegunaan**: Mencatat informasi tambahan terkait pembayaran (misal: alasan delay, instruksi khusus)
- **Placeholder**: "Contoh: Menunggu konfirmasi admin / Bukti transfer belum jelas / Kekurangan Rp XXX"

## Alur Penggunaan

### Langkah 1: Admin Menerima Pembayaran
1. Pelanggan mengirimkan bukti transfer ke admin
2. Admin membuka detail order yang berstatus "Paid In Progress"
3. Admin melihat:
   - **Total Harga**: Total harga order dari pelanggan
   - **Pembayaran Diterima**: (Field kosong, siap diisi)
   - **Sisa Pembayaran**: Menampilkan total harga (karena belum ada pembayaran)

### Langkah 2: Input Pembayaran
1. Admin memasukkan jumlah pembayaran yang diterima di field "Pembayaran Diterima"
2. Contoh:
   - Total Harga: Rp 10.000.000
   - Admin input: Rp 5.000.000
   - Sistem otomatis menghitung: Sisa Pembayaran = Rp 5.000.000

### Langkah 3: Input Catatan (Opsional)
1. Admin bisa menambahkan catatan pembayaran untuk referensi
2. Contoh catatan:
   - "Transfer 50% dari total, menunggu sisa pembayaran"
   - "Kekurangan Rp 2.000.000, ditunggu sampai 25 Januari"

### Langkah 4: Simpan
1. Admin mengklik tombol "Save" untuk menyimpan perubahan
2. Sistem akan menyimpan:
   - Jumlah pembayaran yang diterima
   - Catatan pembayaran

## Perubahan Database
- **Tabel**: `orders`
- **Kolom Baru**: `amount_paid` (decimal 15,2)
- **Default Value**: 0
- **Migration**: `2026_01_25_000001_add_amount_paid_to_orders_table`

## Contoh Skenario

### Skenario 1: Pembayaran Penuh
```
Total Harga: Rp 10.000.000
Pembayaran Diterima: Rp 10.000.000
Sisa Pembayaran: Rp 0 (Pembayaran Lengkap)
Catatan: "Pembayaran lunas, siap untuk proses order"
```

### Skenario 2: Pembayaran Bertahap
```
Total Harga: Rp 10.000.000
Pembayaran Diterima: Rp 3.000.000 (DP 30%)
Sisa Pembayaran: Rp 7.000.000
Catatan: "Transfer DP, sisa sampai 28 Januari"
```

### Skenario 3: Pembayaran Termin
```
Total Harga: Rp 10.000.000
Pembayaran Diterima: Rp 5.000.000 (Termin 1)
Sisa Pembayaran: Rp 5.000.000
Catatan: "Termin 1 diterima, menunggu termin 2 sebelum event"
```

## File yang Diubah
1. **EditOrderForm.php**: Menambahkan field "Pembayaran Diterima" dan "Sisa Pembayaran"
2. **EditOrder.php**: Memastikan field "remaining_payment" tidak disimpan ke database (hanya calculated)
3. **Order.php**: Menambahkan 'amount_paid' ke $fillable
4. **Migration**: 2026_01_25_000001_add_amount_paid_to_orders_table.php (Menambahkan kolom amount_paid)

## Fitur Keamanan
- Field "Sisa Pembayaran" adalah read-only, tidak bisa diubah langsung
- Hanya admin yang berstatus "Paid In Progress" yang bisa melihat/edit
- Semua perubahan pembayaran terdata di database untuk audit trail

## Integrasi Dengan Fitur Lain
- **Approve Payment**: Ketika admin approve pembayaran, status berubah ke "Paid Completed"
- **Reject Payment**: Admin bisa menolak dengan menambahkan catatan alasan di field "Catatan Pembayaran"
- **Payment Note**: Catatan pembayaran membantu komunikasi internal tim admin
