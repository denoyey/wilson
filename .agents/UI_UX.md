# UI/UX Design Guidelines

Dokumen ini mendefinisikan panduan desain visual dan pengalaman pengguna (UX) untuk WilsonFlow.

---

## 1. Design Philosophy

- **Premium & Professional:** Desain harus terasa modern, bersih, dan korporat. Bukan desain "asal jadi".
- **Functional First:** Animasi dan efek visual mendukung pengalaman, bukan menghalangi.
- **Consistent:** Semua halaman menggunakan komponen UI yang sama (tombol, tabel, card, form field) agar terasa unified.

---

## 2. Layout

### 2.1 Master Layout
- Gunakan `<x-layouts.app>` sebagai layout utama.
- Navbar sticky di atas dengan logo "WilsonFlow" dan info user (nama + role).
- Sidebar navigasi di kiri dengan menu berdasarkan role user.
- Konten utama di area tengah-kanan.
- Footer minimalis di bagian bawah.

### 2.2 Responsiveness
- Layout harus responsif menggunakan Tailwind breakpoints (`sm:`, `md:`, `lg:`).
- Sidebar bisa di-collapse pada layar kecil.
- Tabel data menggunakan horizontal scroll pada mobile.

---

## 3. Color Palette

Gunakan warna profesional dan netral. Hindari warna mentah (pure red, pure blue).

| Penggunaan         | Warna                          | Tailwind Class                    |
|--------------------|--------------------------------|-----------------------------------|
| Background utama   | Abu-abu sangat terang          | `bg-gray-50`                      |
| Card / Panel       | Putih dengan border halus      | `bg-white border border-gray-100` |
| Teks utama         | Abu-abu gelap                  | `text-gray-900`                   |
| Teks sekunder      | Abu-abu medium                 | `text-gray-500`                   |
| Aksen utama (CTA)  | Biru profesional               | `bg-blue-600 hover:bg-blue-700`   |
| Success / Inbound  | Hijau                          | `bg-green-100 text-green-800`     |
| Danger / Outbound  | Merah                          | `bg-red-100 text-red-800`         |
| Warning            | Kuning/Amber                   | `bg-amber-100 text-amber-800`     |

---

## 4. Border Radius (WAJIB)

- **Semua elemen UI** (card, tombol, input, modal, container) **WAJIB** menggunakan `rounded-md`.
- **DILARANG** menggunakan `rounded-lg`, `rounded-xl`, `rounded-2xl`, atau `rounded-3xl`.
- **Pengecualian:** Badge/label status boleh menggunakan `rounded-full` untuk bentuk pill.
- Aturan ini berlaku untuk seluruh halaman tanpa terkecuali.

---

## 5. Typography

- Font utama: **Inter** atau **Instrument Sans** (sudah dikonfigurasi via Vite/Bunny).
- Heading: `font-bold` atau `font-extrabold`.
- Body text: `text-sm` atau `text-base`.
- Gunakan `tracking-tight` pada heading besar untuk kesan modern.

---

## 6. Komponen UI

### 6.1 Cards (Kartu Statistik)
Gunakan komponen `<x-card>`.
```html
<x-card class="p-6 hover:shadow-md transition-shadow duration-300">
    <!-- content -->
</x-card>
```

### 6.2 Tabel Data
- Gunakan `divide-y divide-gray-200` untuk garis pemisah baris.
- Container tabel: `rounded-md overflow-hidden`.
- Baris hover: `hover:bg-gray-50 transition-colors duration-150`.
- Header tabel: `bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider`.
- **WAJIB**: Setiap tabel data harus memiliki fitur paginasi (menggunakan `WithPagination` di Livewire) dan filter *dropdown* pemilihan jumlah data per halaman (10, 25, 50, 100).

### 6.3 Tombol
Gunakan komponen `<x-button>`, `<x-button-secondary>`, dan `<x-button-danger>`.
```html
<!-- Primary -->
<x-button>Simpan</x-button>

<!-- Danger -->
<x-button-danger>Hapus</x-button-danger>

<!-- Secondary -->
<x-button-secondary>Batal</x-button-secondary>
```

### 6.4 Form Input
Gunakan komponen `<x-label>`, `<x-input>`, `<x-select>`, `<x-textarea>`, dan `<x-error>`.
```html
<x-label for="name" value="Nama" required="true" />
<x-input id="name" wire:model="name" />
<x-error for="name" />
```

### 6.5 Badge (Label Status)
Badge adalah **satu-satunya pengecualian** yang boleh menggunakan `rounded-full`.
```html
<!-- Inbound -->
<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Masuk</span>

<!-- Outbound -->
<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Keluar</span>
```

---

## 7. Animasi & Interaksi

### 6.1 GSAP Rules
- Durasi animasi: **0.2s – 0.5s** (jangan lebih lambat dari ini untuk dashboard).
- Ease function: `power3.out` untuk elemen masuk, `power2.out` untuk list items.
- Gunakan `stagger` untuk elemen yang muncul berurutan (kartu statistik, baris tabel).
- Animasi hanya di-trigger saat halaman pertama kali dimuat, **bukan** setiap kali user mengklik tombol biasa.

### 6.2 Lenis Smooth Scroll
- Aktif secara global melalui `resources/js/app.js`.
- Memberikan efek scrolling halus pada semua halaman.

### 6.3 Livewire Loading States
- Setiap tombol submit form harus menampilkan loading state menggunakan `wire:loading`:
```html
<button wire:click="save" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed">
    <span wire:loading.remove>Simpan</span>
    <span wire:loading>Menyimpan...</span>
</button>
```

### 6.4 Hover Effects
- Semua elemen interaktif (tombol, baris tabel, card) harus memiliki hover state yang halus.
- Gunakan `transition-*` Tailwind classes untuk transisi yang smooth.

---

## 8. Notifikasi / Flash Messages

- Setiap aksi CRUD yang berhasil atau gagal harus menampilkan notifikasi.
- Gunakan toast notification atau banner di atas konten.
- Warna: hijau untuk sukses, merah untuk error, kuning untuk warning.
- Toast harus auto-dismiss setelah 3-5 detik.

---

## 9. Empty States

- Jika tabel kosong (belum ada data), tampilkan ilustrasi/ikon sederhana dengan teks deskriptif, bukan tabel kosong tanpa informasi.
- Contoh: "Belum ada barang. Klik tombol 'Tambah Barang' untuk memulai."
