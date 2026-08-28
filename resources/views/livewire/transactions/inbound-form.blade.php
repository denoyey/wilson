<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 gsap-fade-up">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Catat Barang Masuk</h1>
        <p class="mt-1 text-sm text-gray-500">Catat penerimaan barang baru dari supplier ke gudang.</p>
    </div>

    @if (session()->has('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative gsap-fade-up">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <x-card class="p-6 sm:p-8 gsap-fade-up delay-100">
        <form wire:submit="save" class="space-y-6">
            
            <div class="gsap-stagger-item">
                <x-label for="name" value="Nama Barang" required="true" />
                <x-input id="name" wire:model="name" class="px-4 py-3" placeholder="Contoh: Laptop Dell XPS 15" />
                <x-error for="name" />
            </div>

            <div class="gsap-stagger-item">
                <x-label for="category_id" value="Kategori" required="true" />
                <x-select id="category_id" wire:model="category_id" class="px-4 py-3">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </x-select>
                <x-error for="category_id" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 gsap-stagger-item">
                <div>
                    <x-label for="quantity" value="Kuantitas Masuk" required="true" />
                    <x-input type="number" id="quantity" wire:model="quantity" min="1" />
                    <x-error for="quantity" />
                </div>
                <div>
                    <x-label for="unit" value="Satuan" required="true" />
                    <x-input id="unit" wire:model="unit" placeholder="pcs, roll, box, dll" />
                    <x-error for="unit" />
                </div>
            </div>

            <div class="gsap-stagger-item">
                <x-label for="source" value="Supplier / Asal Barang" />
                <x-input id="source" wire:model="source" placeholder="Contoh: PT ABC Jaya" />
                <x-error for="source" />
            </div>

            <div class="gsap-stagger-item">
                <x-label for="notes" value="Catatan (Opsional)" />
                <x-textarea id="notes" wire:model="notes" rows="4" placeholder="Tambahkan catatan jika ada..."></x-textarea>
                <x-error for="notes" />
            </div>

            <div class="flex justify-end items-center gap-4 pt-4 border-t border-gray-100 gsap-stagger-item">
                <a href="{{ route('items.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                    Batal
                </a>
                <x-button type="submit" class="bg-blue-600 hover:bg-blue-700" wire:loading.attr="disabled">
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