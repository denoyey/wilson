<div class="max-w-7xl mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-8" wire:poll.keep-alive.10s>
    <div class="mb-8 gsap-fade-up">
        @if ($isAdmin)
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="mt-1 text-sm text-gray-500">Ringkasan operasional gudang secara keseluruhan.</p>
        @else
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Monitoring Stok Barang</h1>
            <p class="mt-1 text-sm text-gray-500">Pantau ketersediaan barang yang ready di gudang.</p>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-5 mb-6 sm:mb-8">
        <div class="gsap-stagger-item h-full">
            <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                <div class="flex items-center">
                    <div
                        class="shrink-0 bg-blue-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Stok Barang</dt>
                            <dd class="text-xl sm:text-2xl font-bold text-gray-900" x-data="{
                                value: 0,
                                animate() {
                                    let target = parseInt(this.$el.dataset.value, 10) || 0;
                                    if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                    else this.value = target;
                                },
                                init() {
                                    this.animate();
                                    let observer = new MutationObserver(() => this.animate());
                                    observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                }
                            }"
                                data-value="{{ $totalStock }}" x-text="Math.round(value).toLocaleString('id-ID')">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        @if ($isAdmin)
            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-green-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Masuk (Bulan Ini)</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-gray-900" x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                    data-value="{{ $monthlyInbound }}" x-text="Math.round(value).toLocaleString('id-ID')">0
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-red-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Keluar (Bulan Ini)</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-gray-900" x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                    data-value="{{ $monthlyOutbound }}" x-text="Math.round(value).toLocaleString('id-ID')">0
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-green-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Ready</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-green-600"><span x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                        data-value="{{ $readyItems->count() }}"
                                        x-text="Math.round(value).toLocaleString('id-ID')">0</span> item</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gsap-stagger-item h-full">
                <div class="group h-full bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-4 sm:p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-default">
                    <div class="flex items-center">
                        <div
                            class="shrink-0 bg-orange-100 rounded-md p-2.5 sm:p-3 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Stok Habis</dt>
                                <dd class="text-xl sm:text-2xl font-bold text-red-600"><span x-data="{
                                    value: 0,
                                    animate() {
                                        let target = parseInt(this.$el.dataset.value, 10) || 0;
                                        if (window.gsap) window.gsap.to(this, { value: target, duration: 1.5, ease: 'power3.out' });
                                        else this.value = target;
                                    },
                                    init() {
                                        this.animate();
                                        let observer = new MutationObserver(() => this.animate());
                                        observer.observe(this.$el, { attributes: true, attributeFilter: ['data-value'] });
                                    }
                                }"
                                        data-value="{{ $outOfStockItems->count() }}"
                                        x-text="Math.round(value).toLocaleString('id-ID')">0</span> item</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @unless ($isAdmin)
        <div class="bg-white shadow-sm rounded-md border border-gray-100 overflow-hidden mb-6 sm:mb-8">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Barang Ready</h3>
                <p class="mt-1 text-sm text-gray-500">Barang yang tersedia dan siap digunakan.</p>
            </div>

            @if ($readyItems->isEmpty())
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Tidak Ada Barang Ready</h3>
                    <p class="mt-1 text-sm text-gray-500">Semua stok barang sedang kosong.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    SKU</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Barang</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stok</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Satuan</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($readyItems as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 gsap-list-item">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">
                                        {{ $item->sku }}</td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->name }}</td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->category->name ?? '-' }}</td>
                                    <td
                                        class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold {{ $item->stock <= 10 ? 'text-orange-600' : 'text-gray-900' }}">
                                        {{ number_format($item->stock, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->unit }}</td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        @if ($item->stock <= 10)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Stok
                                                Rendah</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                        @endif
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-xs">
                                        {{ $item->description ?: '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if ($outOfStockItems->isNotEmpty())
            <div class="bg-white shadow-sm rounded-md border border-orange-200 overflow-hidden mb-6 sm:mb-8">
                <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-orange-200 bg-orange-50">
                    <h3 class="text-lg leading-6 font-medium text-orange-800">Barang Stok Habis</h3>
                    <p class="mt-1 text-sm text-orange-600">Barang berikut perlu di-restock segera.</p>
                </div>
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach ($outOfStockItems as $item)
                        <li
                            class="px-6 py-4 flex items-center justify-between hover:bg-orange-50 transition-colors duration-150">
                            <div>
                                <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                                <span class="ml-2 text-xs text-gray-500">({{ $item->sku }})</span>
                            </div>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Habis</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endunless

    @if ($isAdmin)
        <div class="bg-white shadow-sm rounded-md border border-gray-100 overflow-hidden">
            <div
                class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Riwayat Transaksi Terbaru</h3>
                    <p class="mt-1 text-sm text-gray-500">Daftar barang masuk dan keluar.</p>
                </div>
                <div class="flex items-center gap-2">
                    <label for="perPage" class="text-sm text-gray-600">Tampilkan:</label>
                    <x-select id="perPage" wire:model.live="perPage" class="text-sm py-1.5 pl-3 pr-8">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-select>
                </div>
            </div>
            @if ($recentTransactions->isEmpty())
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Belum Ada Transaksi</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada barang masuk atau keluar yang dicatat.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Transaksi</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Detail</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status & Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($recentTransactions as $transaction)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 gsap-list-item">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="shrink-0 h-10 w-10 rounded-full {{ $transaction->type === \App\Enums\TransactionType::Inbound ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                                                <svg class="h-5 w-5 {{ $transaction->type === \App\Enums\TransactionType::Inbound ? 'text-green-600' : 'text-red-600' }}"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    @if ($transaction->type === \App\Enums\TransactionType::Inbound)
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                    @endif
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $transaction->code }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Oleh: {{ $transaction->user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $transaction->item->name }}</div>
                                        <div class="text-sm text-gray-500">Qty: {{ $transaction->quantity }}
                                            {{ $transaction->item->unit }} &bull;
                                            {{ $transaction->source_or_destination }}</div>
                                        @if ($transaction->notes)
                                            <div class="text-xs text-gray-500 mt-1 italic">
                                                Catatan: {{ $transaction->notes }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right">
                                        <p
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaction->type === \App\Enums\TransactionType::Inbound ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $transaction->type->label() }}
                                        </p>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $transaction->created_at->translatedFormat('d M Y, H:i') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($recentTransactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $recentTransactions->links() }}
                    </div>
                @endif
            @endif
        </div>
    @endif

    </div>
