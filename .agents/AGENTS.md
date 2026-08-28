# Wilson Inventory System — Agent Rules

Dokumen ini adalah aturan mutlak bagi AI Agent saat mengerjakan project ini. Semua aturan di bawah ini WAJIB diikuti tanpa pengecualian.

Untuk detail fitur, lihat [PRD.md](./PRD.md).
Untuk arsitektur kode, lihat [ARCHITECTURE.md](./ARCHITECTURE.md).
Untuk aturan keamanan, lihat [SECURITY.md](./SECURITY.md).
Untuk panduan UI/UX, lihat [UI_UX.md](./UI_UX.md).
Untuk skema database, lihat [DATABASE.md](./DATABASE.md).

---

## 1. Tech Stack (Wajib Dipatuhi)

| Layer           | Teknologi                          | Versi    |
|-----------------|------------------------------------|----------|
| Backend         | Laravel                            | 13.x     |
| Reactivity      | Livewire                           | 4.x      |
| CSS Framework   | Tailwind CSS (via Vite plugin)     | 4.x      |
| Build Tool      | Vite                               | 8.x      |
| Animation       | GSAP (GreenSock)                   | 3.x      |
| Smooth Scroll   | Lenis                              | 1.x      |
| Database        | MySQL                              | 8.x      |
| PHP             | PHP                                | 8.3+     |

Jangan menambahkan library/package baru tanpa konfirmasi dari user terlebih dahulu.

---

## 2. Prinsip Pengembangan Kode

### 2.1 Object-Oriented Programming (OOP)
- Semua logika bisnis WAJIB diekstrak ke dalam **Service Classes** (`app/Services/`) atau **Action Classes** (`app/Actions/`).
- Controller dan Livewire component hanya boleh menangani: parsing request, validasi, memanggil Service/Action, dan mengembalikan response.
- Gunakan **Dependency Injection** melalui constructor atau method injection. Jangan gunakan `app()` helper atau facade secara berlebihan.
- Gunakan **Interface** untuk Service yang kompleks agar mudah di-mock saat testing.

### 2.2 Clean Code & Maintainability
- Satu method/function = satu tanggung jawab (Single Responsibility).
- Gunakan **early return** untuk menghindari deep nesting.
- Penamaan variabel dan method harus deskriptif dan self-documenting.
- Jangan menulis komentar yang hanya mengulang apa yang sudah jelas dari kode.
- Maksimal 1 level nesting di dalam method (selain try/catch).
- File Blade harus dipecah menjadi komponen kecil yang reusable.

### 2.3 Laravel Conventions
- Gunakan **Form Request** classes (`app/Http/Requests/`) untuk semua validasi input, bukan validasi inline di controller.
- Gunakan **Eloquent Relationships** secara konsisten, jangan query manual yang bisa diganti relationship.
- Gunakan **Eloquent Scopes** untuk query yang sering diulang.
- Gunakan **Eloquent Accessors & Mutators** untuk transformasi data model.
- Gunakan **Resource/Collection** classes jika perlu mengembalikan data terformat ke frontend.

---

## 3. Documentation Sync (WAJIB)

Setiap kali ada perubahan pada project — baik menambah fitur baru, mengubah struktur database, menambah library, mengubah flow, atau perubahan apapun yang diminta user — **WAJIB** langsung memperbarui file dokumentasi `.agents/` yang terkait agar selalu sinkron dengan kondisi aktual kode.

### Aturan:
- **Setiap prompt dari user yang menghasilkan perubahan kode**, periksa apakah perubahan tersebut berdampak pada salah satu dokumen di `.agents/`. Jika ya, update dokumen tersebut di akhir pekerjaan.
- Jangan menunda pembaruan dokumentasi. Lakukan di sesi yang sama dengan perubahan kode.
- Jika menambah tabel baru → update `DATABASE.md`.
- Jika menambah fitur/modul baru → update `PRD.md`.
- Jika mengubah folder structure atau menambah design pattern → update `ARCHITECTURE.md`.
- Jika ada perubahan aturan keamanan atau mekanisme auth → update `SECURITY.md`.
- Jika ada perubahan komponen UI, warna, animasi → update `UI_UX.md`.
- Jika ada perubahan tech stack atau aturan coding → update `AGENTS.md`.

### Contoh:
- User meminta "tambahkan fitur export PDF" → setelah coding selesai, tambahkan requirement baru di `PRD.md` dan library baru di `AGENTS.md`.
- User meminta "ubah field di tabel items" → setelah migration dibuat, update skema tabel di `DATABASE.md`.

---

## 4. Referensi Dokumen

| Dokumen                            | Isi                                                  |
|------------------------------------|------------------------------------------------------|
| [PRD.md](./PRD.md)                 | Fitur lengkap, modul, dan spesifikasi fungsional     |
| [ARCHITECTURE.md](./ARCHITECTURE.md) | Struktur folder, pola desain, alur data            |
| [SECURITY.md](./SECURITY.md)       | Aturan keamanan, otorisasi, validasi, proteksi       |
| [UI_UX.md](./UI_UX.md)            | Panduan desain, komponen UI, animasi, warna          |
| [DATABASE.md](./DATABASE.md)       | Skema tabel, relasi, migration, seeder               |

---

## 5. Bahasa (Language) WAJIB INDONESIA

- **WAJIB** menggunakan Bahasa Indonesia dalam segala hal terkait komunikasi dengan User.
- **WAJIB** menggunakan Bahasa Indonesia di dalam seluruh dokumentasi `.agents/` (PRD, UI_UX, AGENTS, dll).
- **WAJIB** menggunakan Bahasa Indonesia pada seluruh antarmuka pengguna (UI), teks placeholder, label, pesan error, dan notifikasi di dalam aplikasi.
- Variabel kode, class name, nama database table, dan hal-hal teknis tetap menggunakan Bahasa Inggris standar pemrograman (contoh: `users`, `ItemController`, `$transactions`), namun komentar dalam kode harus Bahasa Indonesia.
