# Product Requirements Document (PRD)

**Project Name:** WilsonFlow â€” Sistem Inventory PT Wilson
**Version:** 1.0.0
**Last Updated:** 2026-08-27
**Deployment:** Localhost (Demo Sidang)

---

## 1. Executive Summary

WilsonFlow adalah aplikasi web sistem manajemen keluar masuk barang (Inventory Management System) yang dibangun untuk PT Wilson. Aplikasi ini dirancang untuk memantau pergerakan stok secara akurat, mencatat setiap transaksi barang masuk (inbound) dan barang keluar (outbound), serta menyediakan dashboard informatif bagi manajemen.

Sistem ini dibangun dengan prinsip **keamanan penuh** (tidak bisa di-bypass), **kode berorientasi objek (OOP)** yang bersih, dan **antarmuka premium** dengan animasi modern.

---

## 2. Tech Stack

| Komponen        | Teknologi               | Versi   | Fungsi                                           |
|-----------------|--------------------------|---------|--------------------------------------------------|
| Backend         | Laravel                  | 13.x   | Framework utama, routing, middleware, ORM         |
| Reactivity      | Livewire                 | 4.x    | Komponen interaktif tanpa perlu API terpisah      |
| CSS Framework   | Tailwind CSS             | 4.x    | Styling responsif dan modern                      |
| Build Tool      | Vite                     | 8.x    | Kompilasi aset frontend (CSS, JS)                 |
| Animation       | GSAP (GreenSock)         | 3.x    | Micro-animations pada elemen UI                   |
| Smooth Scroll   | Lenis                    | 1.x    | Smooth scrolling pada halaman panjang             |
| Database        | MySQL                    | 8.x    | Penyimpanan data relasional                       |
| Font Optimizer  | Fontaine                 | 0.8.x  | Optimasi fallback font untuk performa loading     |
| PHP Runtime     | PHP                      | 8.3+   | Runtime bahasa pemrograman                        |

---

## 3. User Roles & Access Control

Sistem menggunakan **Role-Based Access Control (RBAC)** dengan pemisahan hak akses yang diterapkan secara ketat di sisi server (bukan hanya menyembunyikan menu di UI).

### 3.1 Admin
Memiliki akses penuh ke seluruh sistem:
- Melihat Dashboard dengan statistik lengkap
- CRUD Master Data User (membuat akun Admin atau SPV (Supervisor) baru)
- CRUD Master Data Barang (Katalog Barang)
- CRUD Kategori Barang
- Mencatat Transaksi Barang Masuk (Inbound)
- Mencatat Transaksi Barang Keluar (Outbound)
- Melihat seluruh Laporan & Riwayat Transaksi
- Mengelola pengaturan sistem

### 3.2 SPV (Supervisor)
Memiliki akses monitoring terbatas:
- Melihat Dashboard dengan fokus monitoring stok barang
- Melihat daftar Barang yang Ready (stok > 0) dan yang Habis
- Melihat status ketersediaan barang secara real-time
- TIDAK bisa mencatat transaksi barang masuk/keluar (hanya Admin)
- Melihat Riwayat Transaksi (read-only)

---

## 4. Core Modules & Functional Requirements

### Module A: Authentication

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| AUTH-1 | User dapat login menggunakan **username** dan **password**     | High     |
| AUTH-2 | Sistem mendeteksi role user dan mengarahkan ke dashboard sesuai role | High |
| AUTH-3 | User dapat logout dengan aman (session dihancurkan)            | High     |
| AUTH-4 | Halaman login memiliki proteksi rate limiting (max 5 percobaan/menit) | High |
| AUTH-5 | Password di-hash menggunakan Bcrypt (bawaan Laravel)           | High     |
| AUTH-6 | Session timeout setelah 120 menit tidak aktif                  | Medium   |
| AUTH-7 | Halaman pertama yang muncul saat membuka web adalah **Login**, bukan Dashboard | High |
| AUTH-8 | Guest (belum login) tidak bisa mengakses halaman apapun selain Login | High |

### Module B: Dashboard

| ID      | Requirement                                                   | Priority |
|---------|---------------------------------------------------------------|----------|
| DASH-1  | Menampilkan Total Stok Barang keseluruhan                     | High     |
| DASH-2  | Menampilkan jumlah Barang Masuk hari ini                      | High     |
| DASH-3  | Menampilkan jumlah Barang Keluar hari ini                     | High     |
| DASH-4  | Menampilkan 10 transaksi terbaru                              | Medium   |
| DASH-5  | Kartu statistik muncul dengan animasi stagger GSAP            | Medium   |
| DASH-6  | Dashboard Admin menampilkan data global                       | High     |
| DASH-7  | Dashboard Manager menampilkan data miliknya saja              | High     |
| DASH-8  | **Real-time Auto-refresh:** Statistik dan daftar transaksi terupdate otomatis antar tab menggunakan Livewire Polling tanpa perlu *refresh* manual | High     |

### Module C: Master Data â€” Users (Admin Only)

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| USR-1  | Admin dapat melihat daftar semua user dalam tabel              | High     |
| USR-2  | Admin dapat menambah user baru (Nama, Username, Email, Password, Role) | High |
| USR-3  | Admin dapat mengubah data user (termasuk reset password)       | High     |
| USR-4  | Admin dapat menghapus user (soft delete)                       | High     |
| USR-5  | Admin tidak bisa menghapus akunnya sendiri                     | High     |
| USR-6  | Validasi username dan email unik saat membuat/mengedit user    | High     |
| USR-7  | Tabel user mendukung pencarian dan pagination                  | Medium   |

### Module D: Master Data â€” Kategori Barang (Admin Only)

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| CAT-1  | Admin dapat melihat daftar kategori barang                     | High     |
| CAT-2  | Admin dapat menambah kategori baru (Nama, Deskripsi)           | High     |
| CAT-3  | Admin dapat mengubah kategori                                  | High     |
| CAT-4  | Admin dapat menghapus kategori (hanya jika tidak ada barang terkait) | High |

### Module E: Master Data â€” Barang (Admin CRUD, Manager Read-Only)

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| ITM-1  | Admin dapat melihat daftar barang dalam tabel                  | High     |
| ITM-2  | SPV (Supervisor) dapat melihat daftar barang (read-only)         | High     |
| ITM-3  | Admin dapat menambah barang (SKU, Nama, Deskripsi, Kategori, Satuan, Stok Awal) | High |
| ITM-4  | SKU (Stock Keeping Unit) harus unik dan auto-generated         | High     |
| ITM-5  | Admin dapat mengubah data barang                               | High     |
| ITM-6  | Admin dapat menghapus barang (soft delete)                     | High     |
| ITM-7  | Tabel barang mendukung pencarian, filter per kategori, dan pagination | Medium |

### Module F: Transaksi Barang Masuk â€” Inbound

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| INB-1  | Admin dan Manager dapat mencatat barang masuk                  | High     |
| INB-2  | Form mencatat: Barang (dropdown), Kuantitas, Supplier/Sumber, Catatan | High |
| INB-3  | Setelah submit, stok barang terkait otomatis bertambah         | High     |
| INB-4  | Proses penambahan stok harus menggunakan DB::transaction()     | High     |
| INB-5  | Setiap transaksi mencatat user yang melakukan (audit trail)    | High     |
| INB-6  | Kuantitas harus bilangan positif (integer > 0)                 | High     |

### Module G: Transaksi Barang Keluar â€” Outbound

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| OUT-1  | Admin dan Manager dapat mencatat barang keluar                 | High     |
| OUT-2  | Form mencatat: Barang (dropdown), Kuantitas, Tujuan, Catatan   | High     |
| OUT-3  | Setelah submit, stok barang terkait otomatis berkurang         | High     |
| OUT-4  | Validasi ketat: kuantitas keluar TIDAK BOLEH melebihi stok tersedia | High |
| OUT-5  | Proses pengurangan stok harus menggunakan DB::transaction()    | High     |
| OUT-6  | Setiap transaksi mencatat user yang melakukan (audit trail)    | High     |
| OUT-7  | Kuantitas harus bilangan positif (integer > 0)                 | High     |

### Module H: Laporan & Riwayat Transaksi

| ID     | Requirement                                                    | Priority |
|--------|----------------------------------------------------------------|----------|
| RPT-1  | Menampilkan seluruh log transaksi (inbound + outbound) dalam tabel | High |
| RPT-2  | Tabel dapat difilter berdasarkan: Tipe (Masuk/Keluar), Tanggal, Barang | Medium |
| RPT-3  | Admin melihat semua transaksi dari semua user                  | High     |
| RPT-4  | Manager hanya melihat transaksi yang dia buat sendiri          | High     |
| RPT-5  | Tabel mendukung pagination                                     | Medium   |
| RPT-6  | Setiap baris menampilkan: Kode Transaksi, Tanggal, Barang, Tipe, Kuantitas, User | High |

---

## 5. Non-Functional Requirements

| ID      | Requirement                                                   | Priority |
|---------|---------------------------------------------------------------|----------|
| NFR-1   | Halaman harus dimuat dalam < 3 detik pada localhost            | High     |
| NFR-2   | Aplikasi harus responsif (mobile-friendly)                     | Medium   |
| NFR-3   | Kode harus mengikuti prinsip OOP dan Clean Code                | High     |
| NFR-4   | Keamanan tidak boleh bisa di-bypass (lihat SECURITY.md)        | High     |
| NFR-5   | Semua form harus memiliki loading state saat proses submit     | Medium   |
| NFR-6   | Notifikasi (toast/flash) harus muncul untuk setiap aksi CRUD  | Medium   |
| NFR-7   | Animasi GSAP harus subtle (durasi 0.2s - 0.5s) agar tidak mengganggu operasional | Medium |

---

## 6. Deployment

- **Target:** Localhost (laptop developer)
- **Server:** `php artisan serve` atau `composer run dev`
- **Tujuan:** Demo presentasi sidang
- **Tidak memerlukan:** SSL, CI/CD, cloud hosting, Docker

