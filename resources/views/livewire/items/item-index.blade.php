<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8" wire:poll.3s>
    <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 gsap-fade-up">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Manajemen Barang</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola data katalog barang di gudang.</p>
        </div>
        <button wire:click="openCreateModal" class="self-start sm:self-auto inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors shadow-sm">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Barang
        </button>
    </div>

    <div class="bg-white rounded-md border border-gray-100 shadow-sm p-4 mb-6 gsap-fade-up" style="animation-delay: 0.1s">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau SKU barang..." class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <div class="sm:w-48">
                <select wire:model.live="categoryFilter" class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:w-32">
                <select wire:model.live="perPage" class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="10">10 data</option>
                    <option value="25">25 data</option>
                    <option value="50">50 data</option>
                    <option value="100">100 data</option>
                </select>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-md border border-gray-100 overflow-hidden gsap-fade-up" style="animation-delay: 0.2s">
        @if($items->isEmpty())
            <div class="p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-gray-900">Tidak Ada Barang</h3>
                <p class="mt-1 text-sm text-gray-500">Belum ada data barang. Klik "Tambah Barang" untuk menambahkan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($items as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $item->sku }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ $item->description ?: '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $item->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $item->stock <= 0 ? 'text-red-600' : ($item->stock <= 10 ? 'text-orange-600' : 'text-gray-900') }}">
                                    {{ number_format($item->stock, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->unit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="openEditModal({{ $item->id }})" class="text-blue-600 hover:text-blue-900 transition-colors bg-blue-50 hover:bg-blue-100 p-1.5 rounded-md" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $item->id }})" class="text-red-600 hover:text-red-900 transition-colors bg-red-50 hover:bg-red-100 p-1.5 rounded-md" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>

    @if($showModal)
        <template x-teleport="body">
        
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true" data-lenis-prevent>
            <div class="flex items-center justify-center min-h-screen px-4">
                <div wire:click="closeModal" class="fixed inset-0 bg-black/50 transition-opacity"></div>

                <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-6 z-10">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">
                            {{ $isEditing ? 'Edit Barang' : 'Tambah Barang Baru' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <x-label for="name" value="Nama Barang" required="true" />
                            <x-input wire:model="name" type="text" id="name" placeholder="Contoh: Laptop Dell XPS 15" />
                            <x-error for="name" />
                        </div>

                        <div>
                            <x-label for="category_id" value="Kategori" required="true" />
                            <x-select wire:model="category_id" id="category_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </x-select>
                            <x-error for="category_id" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-label for="unit" value="Satuan" required="true" />
                                <x-input wire:model="unit" type="text" id="unit" placeholder="pcs, kg, box, rim" />
                                <x-error for="unit" />
                            </div>
                            <div>
                                <x-label for="stock" value="Stok Awal" required="true" />
                                <x-input wire:model="stock" type="number" id="stock" min="0" placeholder="0" />
                                <x-error for="stock" />
                            </div>
                        </div>

                        <div>
                            <x-label for="description">
                                Deskripsi <span class="text-gray-400">(opsional)</span>
                            </x-label>
                            <x-textarea wire:model="description" id="description" rows="3" placeholder="Deskripsi singkat tentang barang..."></x-textarea>
                            <x-error for="description" />
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                            <x-button-secondary wire:click="closeModal">
                                Batal
                            </x-button-secondary>
                            <x-button type="submit" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Simpan Perubahan' : 'Tambah Barang' }}</span>
                                <span wire:loading wire:target="save">Menyimpan...</span>
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    @endif

    @if($showDeleteModal)
        <template x-teleport="body">
        
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true" data-lenis-prevent>
            <div class="flex items-center justify-center min-h-screen px-4">
                <div wire:click="cancelDelete" class="fixed inset-0 bg-black/50 transition-opacity"></div>

                <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6 z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Hapus Barang</h3>
                            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus barang <strong>"{{ $deletingItemName }}"</strong>? Tindakan ini tidak bisa dibatalkan.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <x-button-secondary wire:click="cancelDelete">
                            Batal
                        </x-button-secondary>
                        <x-button-danger wire:click="deleteItem">
                            Ya, Hapus
                        </x-button-danger>
                    </div>
                </div>
            </div>
        </div>
        
    @endif

</div>