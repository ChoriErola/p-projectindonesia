# PANDUAN VISUAL - AKSES PEMILIK

## 🎯 ALUR NAVIGASI

```
Login Panel (/panel)
    ↓
Masukkan Credentials Pemilik
    ↓
Sistem Cek Role = 'pemilik'
    ↓ ✓ VALID
Dashboard Pemilik
    ├── Sidebar Menu:
    │   ├── Dashboard Pemilik [HOME]
    │   ├── Order
    │   │   └── Order Masuk
    │   └── Laporan
    │       ├── Laporan Pesanan
    │       └── Laporan Pendapatan
    │
    └── Top Bar:
        └── Account Profile
```

---

## 📊 DASHBOARD PEMILIK LAYOUT

```
╔═══════════════════════════════════════════════════════════════════════╗
║                         DASHBOARD PEMILIK                             ║
╠═══════════════════════════════════════════════════════════════════════╣
║                                                                       ║
║  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐ ║
║  │ Total Order │  │   Pendapatan│  │Terbayar    │  │  Pending    │ ║
║  │     42      │  │ Rp 52.5 JT  │  │    28      │  │      8      │ ║
║  └─────────────┘  └─────────────┘  └─────────────┘  └─────────────┘ ║
║                                                                       ║
║  ┌─────────────┐                                                     ║
║  │  Proses     │                                                     ║
║  │      6      │                                                     ║
║  └─────────────┘                                                     ║
║                                                                       ║
║  ═══════════════════════════════════════════════════════════════════ ║
║  RECENT ORDERS (10 Terakhir)                                         ║
║  ═══════════════════════════════════════════════════════════════════ ║
║                                                                       ║
║  Kode Order    │ Customer      │ Acara    │ Tanggal    │ Harga      ║
║  ─────────────────────────────────────────────────────────────────  ║
║  ORD-2025001   │ Budi Santoso  │ Pernikah │ 25 Jan 26  │ Rp 5.0 JT  ║
║  ORD-2025002   │ Siti Rahmah   │ Ulang TH │ 26 Jan 26  │ Rp 3.5 JT  ║
║  ORD-2025003   │ Ahmad Rizki   │ Khitanan │ 27 Jan 26  │ Rp 2.5 JT  ║
║  ...                                                                 ║
║                                                                       ║
╚═══════════════════════════════════════════════════════════════════════╝
```

---

## 📋 ORDER MASUK PAGE LAYOUT

```
╔═══════════════════════════════════════════════════════════════════════╗
║                           ORDER MASUK                                 ║
╠═══════════════════════════════════════════════════════════════════════╣
║ Filter: [Status ▼]  Search: [_____________]                          ║
╠═══════════════════════════════════════════════════════════════════════╣
║                                                                       ║
║ Kode    │ Customer      │ Acara    │ Paket      │ Tgl Acara │ Harga  ║
║─────────┼───────────────┼──────────┼────────────┼───────────┼────── ║
║ORD-001 │ Budi Santoso  │Pernikah │Full Service│25 Jan 26 │Rp 5JT │
║(Copy)  │               │         │            │          │       ║
║        │ Status: ✓ Paid│ Confirmed            │          │       ║
║─────────┼───────────────┼──────────┼────────────┼───────────┼────── ║
║ORD-002 │ Siti Rahmah   │Ulang TH │Standard   │26 Jan 26 │Rp 3.5JT
║(Copy)  │               │         │            │          │       ║
║        │ Status: ⏱ Proses│ In Progress         │          │       ║
║─────────┼───────────────┼──────────┼────────────┼───────────┼────── ║
║ORD-003 │ Ahmad Rizki   │Khitanan │Premium    │27 Jan 26 │Rp 2.5JT
║(Copy)  │               │         │            │          │       ║
║        │ Status: ⏰ Pending│ Waiting Confirmation│        │       ║
║─────────┼───────────────┼──────────┼────────────┼───────────┼────── ║
║...                                                                   ║
║                                                                       ║
║ Showing 1-3 of 42 records               [< Prev] [1] [Next >]       ║
║                                                                       ║
╚═══════════════════════════════════════════════════════════════════════╝

✓ Terbayar (Green)
⏱ Proses (Blue)
⏰ Pending (Yellow)
✗ Batal (Red)
○ Pending (Gray)
```

---

## 📈 LAPORAN PESANAN PAGE LAYOUT

```
╔═══════════════════════════════════════════════════════════════════════╗
║                      LAPORAN PESANAN                                  ║
╠═══════════════════════════════════════════════════════════════════════╣
║ Filter: [Status ▼]  Search: [_____________]                          ║
╠═══════════════════════════════════════════════════════════════════════╣
║                                                                       ║
║ Kode  │Customer │Acara │Paket │Tgl Acara │Tgl Pesan │Harga │Status║
║───────┼─────────┼──────┼──────┼──────────┼──────────┼──────┼──────║
║ORD-01│Budi    │Pernikah│Full │25 Jan 26 │22 Jan 26│5 JT│✓ Paid ║
║ORD-02│Siti    │UlangTH │Std  │26 Jan 26 │22 Jan 26│3.5JT│⏱Proses║
║ORD-03│Ahmad   │Khitanan│Prem │27 Jan 26 │21 Jan 26│2.5JT│⏰Pending
║...                                                                   ║
║                                                                       ║
║ Total Records: 42                                                    ║
║ Total Revenue (All): Rp 125.5 JT                                   ║
║ Average Order Value: Rp 2.9 JT                                    ║
║                                                                       ║
╚═══════════════════════════════════════════════════════════════════════╝
```

---

## 💰 LAPORAN PENDAPATAN PAGE LAYOUT

```
╔═══════════════════════════════════════════════════════════════════════╗
║                    LAPORAN PENDAPATAN                                 ║
╠═══════════════════════════════════════════════════════════════════════╣
║ Filter: Dari [__/__/__] Sampai [__/__/__]                            ║
║ [APPLY FILTER]                                                        ║
╠═══════════════════════════════════════════════════════════════════════╣
║                                                                       ║
║ Kode  │Customer │Acara     │Paket │Tgl Bayar │Harga Dasar│Total Harga
║───────┼─────────┼──────────┼──────┼──────────┼───────────┼──────────║
║ORD-01│Budi    │Pernikah  │Full │22 Jan 26│Rp 4.5 JT│Rp 5 JT    ║
║ORD-02│Siti    │UlangTH   │Std  │21 Jan 26│Rp 3 JT │Rp 3.5 JT  ║
║ORD-03│Ahmad   │Khitanan  │Prem │20 Jan 26│Rp 2 JT │Rp 2.5 JT  ║
║ORD-05│Rina    │Akad Nikah│Std  │19 Jan 26│Rp 2.5 JT│Rp 3 JT   ║
║...                                                                   ║
║                                                                       ║
║ ═════════════════════════════════════════════════════════════════════ ║
║ SUMMARY:                                                             ║
║ Total Transaksi Terbayar: 28                                         ║
║ Total Pendapatan: Rp 85.5 JT                                        ║
║ Average Bayar: Rp 3.05 JT per order                                ║
║ ═════════════════════════════════════════════════════════════════════ ║
║                                                                       ║
╚═══════════════════════════════════════════════════════════════════════╝
```

---

## 🔐 AUTHORIZATION FLOW

```
User Login → Cek Credentials
    ↓
Database: Check Email & Password
    ↓ ✓ Valid
Ambil User Data + Role
    ↓
Cek Role:
    ├─ role = 'admin'
    │  ├─ canAccessPanel() → ✓ YES
    │  ├─ canViewAny() Admin Resources → ✓ YES
    │  └─ canViewAny() Owner Resources → ✗ NO
    │
    ├─ role = 'pemilik'
    │  ├─ canAccessPanel() → ✓ YES
    │  ├─ canViewAny() Owner Resources → ✓ YES
    │  └─ canViewAny() Admin Resources → ✗ NO
    │
    ├─ role = 'pelanggan'
    │  ├─ canAccessPanel() → ✗ NO
    │  └─ Redirect ke /dashboard (customer)
    │
    └─ role = other
       ├─ canAccessPanel() → ✗ NO
       └─ Redirect ke /login
```

---

## 📊 DATA QUERY FLOW

```
DASHBOARD PEMILIK
├─ Total Order Query:
│  └─ SELECT COUNT(*) FROM orders
│
├─ Total Pendapatan Query:
│  └─ SELECT SUM(total_price) FROM orders
│
├─ Order Terbayar Query:
│  └─ SELECT COUNT(*) FROM orders 
│     WHERE status IN ('paid completed', 'completed')
│
├─ Order Pending Query:
│  └─ SELECT COUNT(*) FROM orders WHERE status = 'confirmed'
│
├─ Order Proses Query:
│  └─ SELECT COUNT(*) FROM orders 
│     WHERE status = 'paid in progress'
│
└─ Recent Orders Query:
   └─ SELECT * FROM orders ORDER BY created_at DESC LIMIT 10

ORDER MASUK
├─ Get All Orders:
│  └─ SELECT * FROM orders (with customer & package relations)
│
└─ Filter by Status:
   └─ WHERE status = [selected_status]

LAPORAN PESANAN
├─ Get All Orders:
│  └─ SELECT * FROM orders
│
└─ Filter by Status:
   └─ WHERE status = [selected_status]

LAPORAN PENDAPATAN
├─ Get Only Paid Orders:
│  └─ SELECT * FROM orders 
│     WHERE status IN ('paid completed', 'completed')
│
└─ Filter by Date Range:
   └─ WHERE payment_approved_at BETWEEN [from] AND [to]
```

---

## 🎨 COLOR & STATUS LEGEND

```
Status Badge Colors:
┌─────────────────────┬──────────┬─────────────────────────┐
│ Status Order        │ Color    │ Meaning                 │
├─────────────────────┼──────────┼─────────────────────────┤
│ pending             │ Gray     │ Menunggu konfirmasi     │
│ confirmed           │ Orange   │ Sudah dikonfirmasi      │
│ paid in progress    │ Blue     │ Pembayaran diproses     │
│ paid completed      │ Green    │ Pembayaran selesai      │
│ completed           │ Green    │ Order selesai           │
│ cancelled           │ Red      │ Order dibatalkan        │
└─────────────────────┴──────────┴─────────────────────────┘
```

---

## ⚙️ SISTEM REQUIREMENTS

### Minimum
- PHP 8.0+
- Laravel 11+
- Filament 3+
- MySQL 5.7+

### Database Schema
```sql
users table:
  ├─ id (Primary Key)
  ├─ name (varchar)
  ├─ email (varchar, unique)
  ├─ password (varchar)
  ├─ role (varchar) -- VALUES: 'admin', 'pelanggan', 'pemilik'
  ├─ no_hp (varchar, nullable)
  ├─ alamat (text, nullable)
  ├─ avatar_url (varchar, nullable)
  └─ timestamps

orders table:
  ├─ id (Primary Key)
  ├─ user_id (Foreign Key to users)
  ├─ package_id (Foreign Key to packages)
  ├─ order_code (varchar, unique)
  ├─ acara (varchar)
  ├─ event_date (datetime)
  ├─ base_price (decimal)
  ├─ total_price (decimal)
  ├─ status (varchar) -- Tracked in database
  ├─ payment_status (varchar)
  ├─ payment_approved_at (datetime, nullable)
  ├─ payment_approved_by (int, nullable)
  ├─ alamat (text, nullable)
  ├─ notes (text, nullable)
  └─ timestamps
```

---

## 📱 RESPONSIVE DESIGN

- Desktop: ✓ Full featured
- Tablet: ✓ Optimized
- Mobile: ✓ Touch-friendly

Tables akan scroll horizontal di device kecil.

---

## 🔄 UPDATE DATA

Data pada dashboard dan laporan:
- **Real-time**: Diperbarui saat data berubah
- **Caching**: Dapat dioptimalkan dengan query caching
- **Refresh**: Auto-refresh setiap kunjungan halaman

---

## 📞 QUICK ACCESS URLS

```
Dashboard Pemilik:
  /panel/owner-dashboard

Order Masuk:
  /panel/owner-orders

Laporan Pesanan:
  /panel/order-reports

Laporan Pendapatan:
  /panel/revenue-reports

Panel Home:
  /panel

Logout:
  /panel/logout (POST)
```

---

## ✨ FITUR BONUS

1. **Search**: Di Order Masuk dan laporan
2. **Filter**: Berdasarkan status atau date range
3. **Sort**: Kolom dapat di-sort ascending/descending
4. **Copy**: Kode order dapat langsung di-copy
5. **View Detail**: Click untuk lihat detail order lengkap
6. **Export**: Ready untuk integrasi export PDF/Excel

---

Semua fitur yang Anda minta sudah **SELESAI** dan **SIAP DIGUNAKAN**! 🎉
