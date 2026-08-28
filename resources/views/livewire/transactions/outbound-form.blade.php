<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 gsap-fade-up">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Catat Barang Keluar</h1>
        <p class="mt-1 text-sm text-gray-500">Catat pengiriman atau pengeluaran barang dari gudang.</p>
    </div>

    @if (session()->has('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative gsap-fade-up">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <x-card class="p-6 sm:p-8 gsap-fade-up delay-100">
        <form wire:submit="save" class="space-y-6">
            
            <div class="gsap-stagger-item">
                <x-label for="item_id" value="Barang" required="true" />
                <div wire:ignore>
                    <select x-data="{
                        tomSelect: null,
                        init() {
                            this.tomSelect = new TomSelect(this.$el, {
                                create: false,
                                sortField: { field: 'text', direction: 'asc' },
                                placeholder: 'Ketik untuk mencari barang...',
                                dropdownParent: 'body',
                                onInitialize: function() {
                                    if (this.dropdown) {
                                        this.dropdown.setAttribute('data-lenis-prevent', 'true');
                                    }
                                }
                            });
                            this.tomSelect.on('change', (value) => {
                                $wire.set('item_id', value);
                            });
                        }
                    }" id="item_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base px-4 py-3">
                    <option value="">Pilih barang...</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->sku }} - {{ $item->name }} (Stok Tersedia: {{ $item->stock }} {{ $item->unit }})</option>
                    @endforeach
                </select>
                </div>
                <x-error for="item_id" />
            </div>

            <div class="gsap-stagger-item">
                <x-label for="quantity" value="Kuantitas Keluar" required="true" />
                <x-input id="quantity" type="number" wire:model="quantity" placeholder="Contoh: 10" min="1" />
                <x-error for="quantity" />
            </div>

            <div class="gsap-stagger-item">
                <x-label for="destination" value="Tujuan / Kepada" />
                <x-input type="text" id="destination" wire:model="destination" placeholder="Contoh: Cabang Jakarta" />
                <x-error for="destination" />
            </div>

            <div class="gsap-stagger-item">
                <x-label for="notes" value="Catatan (Opsional)" />
                <x-textarea id="notes" wire:model="notes" rows="4" placeholder="Tambahkan catatan jika ada..."></x-textarea>
                <x-error for="notes" />
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100 gsap-stagger-item">
                <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex items-center justify-center bg-gray-100 text-gray-700 px-3 py-1.5 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </a>
                <x-button type="submit" wire:loading.attr="disabled" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700">
                    <span wire:loading.remove>Simpan Transaksi</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan...
                    </span>
                </x-button>
            </div>
        </form>
    </x-card>
</div>
