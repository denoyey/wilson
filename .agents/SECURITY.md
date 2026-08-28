# Security Policy

Dokumen ini mendefinisikan aturan keamanan yang **WAJIB** diterapkan di seluruh kode WilsonFlow. Keamanan tidak bisa di-bypass, baik melalui URL langsung, manipulasi request, maupun injeksi.

---

## 1. Authentication

### 1.1 Login
- Gunakan `Auth::attempt()` bawaan Laravel dengan hashing Bcrypt.
- Setelah login berhasil, panggil `$request->session()->regenerate()` untuk mencegah **Session Fixation Attack**.
- Setelah logout, panggil `$request->session()->invalidate()` dan `$request->session()->regenerateToken()`.

### 1.2 Rate Limiting
- Terapkan rate limiting pada route login: maksimal **5 percobaan per menit** per IP/email.
- Gunakan `RateLimiter` bawaan Laravel atau `ThrottleRequests` middleware.

### 1.3 Session
- Session driver: `database` (sudah dikonfigurasi).
- Session lifetime: 120 menit.
- Regenerasi session ID setelah login.

---

## 2. Authorization (RBAC)

### 2.1 Prinsip Utama
- **Jangan pernah** hanya mengandalkan penyembunyian menu/tombol di UI sebagai mekanisme keamanan. User bisa mengetik URL langsung.
- Setiap route dan setiap Livewire action yang sensitif **WAJIB** diproteksi di sisi server menggunakan:
  - Laravel **Policies** (untuk CRUD model-specific)
  - Laravel **Gates** (untuk permission umum)
  - **Middleware** (untuk proteksi route-level)

### 2.2 Implementasi

#### Middleware untuk Route
```php
// Contoh: Proteksi route admin-only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', UserIndex::class);
});
```

#### Policy untuk Model
```php
// app/Policies/ItemPolicy.php
class ItemPolicy
{
    public function create(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function update(User $user, Item $item): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function delete(User $user, Item $item): bool
    {
        return $user->role === UserRole::Admin;
    }
}
```

#### Di Livewire Component
```php
// Selalu authorize di awal method
public function deleteItem(int $itemId): void
{
    $item = Item::findOrFail($itemId);
    $this->authorize('delete', $item); // Akan throw 403 jika tidak berhak

    $item->delete();
}
```

---

## 3. Input Validation

### 3.1 Aturan Mutlak
- **DILARANG KERAS** menggunakan `$request->all()` langsung ke `Model::create()`.
- Semua input WAJIB divalidasi menggunakan:
  - **Form Request** class (`app/Http/Requests/`) untuk controller.
  - **`$rules` property** atau **`rules()` method** untuk Livewire components.
- Gunakan `$request->validated()` atau `$this->validate()` untuk mengambil hanya data yang sudah tervalidasi.

### 3.2 Contoh
```php
// SALAH (DILARANG)
Item::create($request->all());

// BENAR
$validated = $request->validated();
Item::create($validated);
```

---

## 4. SQL Injection Prevention

- **WAJIB** menggunakan Eloquent ORM atau Query Builder untuk semua query database.
- **DILARANG** menggunakan `DB::raw()` atau `DB::statement()` dengan interpolasi variabel langsung.
- Jika terpaksa menggunakan raw query, **WAJIB** menggunakan parameter binding:

```php
// SALAH (BERBAHAYA)
DB::select("SELECT * FROM items WHERE name = '$name'");

// BENAR
DB::select("SELECT * FROM items WHERE name = ?", [$name]);
```

---

## 5. Mass Assignment Protection

- Setiap Eloquent Model **WAJIB** memiliki property `$fillable` yang mendefinisikan secara eksplisit kolom mana saja yang boleh diisi secara massal.
- **DILARANG** menggunakan `$guarded = []` (kosong) karena ini membuka semua kolom.

```php
// BENAR
class Item extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'description',
        'category_id',
        'unit',
        'stock',
    ];
}
```

---

## 6. CSRF Protection

- Semua form POST/PUT/DELETE **WAJIB** menyertakan token CSRF.
- Blade: gunakan `@csrf` directive.
- Livewire: CSRF protection sudah otomatis ditangani oleh framework.

---

## 7. XSS Prevention

- **WAJIB** menggunakan `{{ $variable }}` (double curly braces) untuk menampilkan data user di Blade, yang secara otomatis melakukan HTML escaping.
- **DILARANG** menggunakan `{!! $variable !!}` kecuali kontennya benar-benar terpercaya dan sudah di-sanitasi.
- Jangan pernah menyisipkan input user langsung ke dalam tag `<script>` atau atribut HTML event handler.

---

## 8. Database Transaction Safety

- Setiap operasi yang memodifikasi **lebih dari satu tabel** secara bersamaan (misalnya: membuat record transaksi + update stok barang) **WAJIB** dibungkus dalam `DB::transaction()`.
- Ini mencegah data inconsistency jika salah satu operasi gagal di tengah jalan.

```php
DB::transaction(function () use ($item, $quantity) {
    $item->decrement('stock', $quantity);
    
    Transaction::create([
        'item_id'  => $item->id,
        'type'     => TransactionType::Outbound,
        'quantity' => $quantity,
        'user_id'  => auth()->id(),
    ]);
});
```

---

## 9. File Upload (Jika Ada di Masa Depan)

- Validasi MIME type dan ukuran file secara ketat.
- Simpan file di luar `public/` directory (gunakan `storage/app/`).
- Gunakan `Storage::url()` untuk mengakses file, bukan path langsung.
- Jangan pernah mempercayai ekstensi file dari user; validasi berdasarkan MIME type.

---

## 10. Error Handling

- Jangan tampilkan stack trace atau detail error internal di production (`APP_DEBUG=false`).
- Untuk demo (localhost), `APP_DEBUG=true` diperbolehkan.
- Log semua error kritis ke file log Laravel (`storage/logs/`).
- Tangani exception secara graceful: tampilkan pesan error yang user-friendly, bukan pesan teknis.

