# Architecture Guide

Dokumen ini mendefinisikan arsitektur kode, struktur folder, pola desain, dan alur data yang harus diikuti saat mengembangkan WilsonFlow.

---

## 1. Struktur Folder Aplikasi

```
app/
â”œâ”€â”€ Actions/                   # Single-purpose action classes
â”‚   â”œâ”€â”€ Inventory/
â”‚   â”‚   â”œâ”€â”€ ProcessInboundAction.php
â”‚   â”‚   â””â”€â”€ ProcessOutboundAction.php
â”‚   â””â”€â”€ User/
â”‚       â””â”€â”€ CreateUserAction.php
â”‚
â”œâ”€â”€ Http/
â”‚   â”œâ”€â”€ Controllers/           # Hanya untuk non-Livewire routes (jika ada)
â”‚   â”œâ”€â”€ Middleware/             # Custom middleware (role check, dll)
â”‚   â””â”€â”€ Requests/              # Form Request validation classes
â”‚       â”œâ”€â”€ StoreItemRequest.php
â”‚       â”œâ”€â”€ StoreTransactionRequest.php
â”‚       â””â”€â”€ StoreUserRequest.php
â”‚
â”œâ”€â”€ Livewire/                  # Livewire components (logic layer)
â”‚   â”œâ”€â”€ Auth/
â”‚   â”‚   â””â”€â”€ LoginForm.php
â”‚   â”œâ”€â”€ Dashboard/
â”‚   â”‚   â””â”€â”€ DashboardPage.php
â”‚   â”œâ”€â”€ Items/
â”‚   â”‚   â”œâ”€â”€ ItemIndex.php
â”‚   â”‚   â””â”€â”€ ItemForm.php
â”‚   â”œâ”€â”€ Categories/
â”‚   â”‚   â”œâ”€â”€ CategoryIndex.php
â”‚   â”‚   â””â”€â”€ CategoryForm.php
â”‚   â”œâ”€â”€ Transactions/
â”‚   â”‚   â”œâ”€â”€ InboundForm.php
â”‚   â”‚   â”œâ”€â”€ OutboundForm.php
â”‚   â”‚   â””â”€â”€ TransactionLog.php
â”‚   â””â”€â”€ Users/
â”‚       â”œâ”€â”€ UserIndex.php
â”‚       â””â”€â”€ UserForm.php
â”‚
â”œâ”€â”€ Models/                    # Eloquent models
â”‚   â”œâ”€â”€ User.php
â”‚   â”œâ”€â”€ Item.php
â”‚   â”œâ”€â”€ Category.php
â”‚   â””â”€â”€ Transaction.php
â”‚
â”œâ”€â”€ Policies/                  # Authorization policies
â”‚   â”œâ”€â”€ ItemPolicy.php
â”‚   â”œâ”€â”€ TransactionPolicy.php
â”‚   â””â”€â”€ UserPolicy.php
â”‚
â”œâ”€â”€ Services/                  # Reusable business logic
â”‚   â”œâ”€â”€ InventoryService.php
â”‚   â””â”€â”€ ReportService.php
â”‚
â””â”€â”€ Enums/                     # PHP 8.1+ Enums
    â”œâ”€â”€ UserRole.php           # enum: admin, spv
    â””â”€â”€ TransactionType.php    # enum: inbound, outbound
```

---

## 2. Design Patterns

### 2.1 Action Pattern
Untuk operasi yang melibatkan beberapa langkah (misal: proses inbound = validasi stok + update stok + buat record transaksi), gunakan **Action Class**. Satu action class = satu use case.

```php
// app/Actions/Inventory/ProcessInboundAction.php
class ProcessInboundAction
{
    public function execute(Item $item, int $quantity, string $source, ?string $notes = null): Transaction
    {
        return DB::transaction(function () use ($item, $quantity, $source, $notes) {
            $item->increment('stock', $quantity);

            return Transaction::create([
                'item_id'    => $item->id,
                'user_id'    => auth()->id(),
                'type'       => TransactionType::Inbound,
                'quantity'   => $quantity,
                'source'     => $source,
                'notes'      => $notes,
            ]);
        });
    }
}
```

### 2.2 Service Pattern
Untuk logika bisnis yang digunakan ulang di beberapa tempat (misal: menghitung statistik dashboard), gunakan **Service Class**.

```php
// app/Services/InventoryService.php
class InventoryService
{
    public function getTotalStock(): int { ... }
    public function getTodayInboundCount(): int { ... }
    public function getTodayOutboundCount(): int { ... }
}
```

### 2.3 Enum Pattern
Gunakan PHP Enum untuk nilai konstan yang memiliki set terbatas:

```php
// app/Enums/UserRole.php
enum UserRole: string
{
    case Admin = 'admin';
    case SPV = 'spv';
}

// app/Enums/TransactionType.php
enum TransactionType: string
{
    case Inbound = 'inbound';
    case Outbound = 'outbound';
}
```

---

## 3. Alur Data (Data Flow)

### 3.1 Alur Transaksi Barang Masuk
```
User klik "Tambah Barang Masuk"
  â†’ Livewire Component (InboundForm) menampilkan form
  â†’ User isi form dan submit
  â†’ Livewire memanggil validate() dengan $rules
  â†’ Livewire memanggil ProcessInboundAction::execute()
    â†’ DB::transaction() dimulai
      â†’ Item->increment('stock', $quantity)
      â†’ Transaction::create([...])
    â†’ DB::transaction() selesai (commit)
  â†’ Flash message "Barang berhasil ditambahkan"
  â†’ Redirect / emit event untuk refresh tabel
```

### 3.2 Alur Transaksi Barang Keluar
```
User klik "Catat Barang Keluar"
  â†’ Livewire Component (OutboundForm) menampilkan form
  â†’ User isi form dan submit
  â†’ Livewire memanggil validate() dengan $rules
  â†’ Validasi tambahan: kuantitas <= stok tersedia
  â†’ Livewire memanggil ProcessOutboundAction::execute()
    â†’ DB::transaction() dimulai
      â†’ Cek ulang stok (pessimistic/optimistic locking)
      â†’ Item->decrement('stock', $quantity)
      â†’ Transaction::create([...])
    â†’ DB::transaction() selesai (commit)
  â†’ Flash message "Barang berhasil dikeluarkan"
```

---

## 4. Routing Strategy

Semua halaman menggunakan Livewire full-page components melalui `Route::get()`:

```php
// routes/web.php
Route::get('/login', LoginForm::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardPage::class)->name('dashboard');
    
    // Transaksi (Admin + Manager)
    Route::get('/transactions/inbound', InboundForm::class)->name('transactions.inbound');
    Route::get('/transactions/outbound', OutboundForm::class)->name('transactions.outbound');
    Route::get('/transactions/log', TransactionLog::class)->name('transactions.log');
    
    // Master Data (Admin only â€” enforced via Policy)
    Route::get('/items', ItemIndex::class)->name('items.index');
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
});
```

---

## 5. Naming Conventions

| Elemen                  | Konvensi                                | Contoh                        |
|-------------------------|-----------------------------------------|-------------------------------|
| Model                   | Singular, PascalCase                    | `Item`, `Transaction`         |
| Migration               | snake_case, deskriptif                  | `create_items_table`          |
| Controller              | PascalCase + "Controller"               | `ItemController`              |
| Livewire Component      | PascalCase                              | `ItemIndex`, `InboundForm`    |
| Service Class           | PascalCase + "Service"                  | `InventoryService`            |
| Action Class            | PascalCase + "Action"                   | `ProcessInboundAction`        |
| Form Request            | "Store/Update" + Model + "Request"      | `StoreItemRequest`            |
| Policy                  | Model + "Policy"                        | `ItemPolicy`                  |
| Enum                    | PascalCase                              | `UserRole`, `TransactionType` |
| Blade View              | kebab-case                              | `item-index.blade.php`        |
| Route Name              | dot notation                            | `items.index`, `transactions.inbound` |
| Database Table          | plural, snake_case                      | `items`, `transactions`       |
| Database Column         | singular, snake_case                    | `item_id`, `created_at`       |

