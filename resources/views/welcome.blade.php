<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="gsap-fade-up mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Dashboard Overview</h1>
            <p class="mt-2 text-lg text-gray-600">Selamat datang di Sistem Inventory PT Wilson. Berikut adalah ringkasan
                stok hari ini.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-12">
            <div
                class="gsap-stagger-item bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="shrink-0 bg-blue-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Stok Barang</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">2,450</div>
                                <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                    <svg class="self-center shrink-0 h-4 w-4 text-green-500" fill="currentColor"
                                        viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Increased by</span>
                                    12%
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div
                class="gsap-stagger-item bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="shrink-0 bg-green-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Barang Masuk (Hari Ini)</dt>
                            <dd class="text-2xl font-bold text-gray-900">142</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div
                class="gsap-stagger-item bg-white overflow-hidden shadow-sm rounded-md border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="shrink-0 bg-red-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Barang Keluar (Hari Ini)</dt>
                            <dd class="text-2xl font-bold text-gray-900">89</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-md border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Riwayat Transaksi Terbaru</h3>
                <p class="mt-1 text-sm text-gray-500">Scroll ke bawah untuk melihat efek smooth scrolling Lenis.</p>
            </div>
            <ul role="list" class="divide-y divide-gray-200">
                @for ($i = 1; $i <= 50; $i++)
                    <li class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150 gsap-list-item">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="shrink-0 h-10 w-10 rounded-full {{ $i % 2 == 0 ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                                    <svg class="h-5 w-5 {{ $i % 2 == 0 ? 'text-green-600' : 'text-red-600' }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        @if ($i % 2 == 0)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        @endif
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        TRX-20260827-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $i % 2 == 0 ? 'Supplier PT ABC' : 'Dikirim ke Cabang Jakarta' }}
                                    </div>
                                </div>
                            </div>
                            <div class="ml-2 shrink-0 flex">
                                <p
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $i % 2 == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $i % 2 == 0 ? 'Masuk' : 'Keluar' }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-layouts.app>
