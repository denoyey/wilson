<?php

use App\Livewire\Auth\LoginForm;
use App\Livewire\Categories\CategoryIndex;
use App\Livewire\Dashboard\DashboardPage;
use App\Livewire\Items\ItemIndex;
use App\Livewire\Transactions\InboundForm;
use App\Livewire\Transactions\OutboundForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes (Belum Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', LoginForm::class)->name('login');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Sudah Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');

    // Admin Only - Master Data & Transaksi
    Route::middleware('can:manage-transactions')->group(function () {
        Route::get('/categories', CategoryIndex::class)->name('categories.index');
        Route::get('/items', ItemIndex::class)->name('items.index');
        Route::get('/transactions/inbound', InboundForm::class)->name('transactions.inbound');
        Route::get('/transactions/outbound', OutboundForm::class)->name('transactions.outbound');
    });

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});