<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-[13px] sm:text-[14px] lg:text-[14.5px]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'PT. Wilson Inventory System' }}</title>

    <link rel="icon" href="{{ asset('img/logo/logo.webp') }}" type="image/webp">

    <meta name="description"
        content="PT. Wilson Inventory System - Sistem Manajemen Gudang terintegrasi untuk melacak stok, barang masuk, dan barang keluar secara real-time dengan akurat.">
    <meta name="keywords"
        content="inventory system, manajemen gudang, sistem stok, pt wilson, aplikasi pergudangan, warehouse management, pencatatan stok">
    <meta name="author" content="PT. Wilson">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'PT. Wilson Inventory System' }}">
    <meta property="og:description"
        content="Sistem Manajemen Gudang terintegrasi PT. Wilson untuk melacak stok secara real-time dan efisien.">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'PT. Wilson Inventory System' }}">
    <meta property="twitter:description"
        content="Sistem Manajemen Gudang terintegrasi PT. Wilson untuk melacak stok secara real-time dan efisien.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <style>
        .ts-control {
            border-color: #d1d5db !important;
            border-radius: 0.375rem !important;
            padding: 0.75rem 1rem !important;
            font-size: 1rem !important;
            min-height: 3rem !important;
        }

        .ts-control.focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
        }

        .ts-dropdown {
            background-color: white !important;
            border-radius: 0.375rem !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            z-index: 50 !important;
        }

        .ts-dropdown .option {
            padding: 0.75rem 1rem !important;
            cursor: pointer !important;
        }

        .ts-dropdown .active {
            background-color: #f3f4f6 !important;
            color: #1f2937 !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen flex flex-col" x-data="{ showLogoutModal: false }">
        <nav x-data="{ open: false, showNav: true, lastScrollY: window.scrollY }"
            x-on:scroll.window="
                 const currentScroll = window.scrollY;
                 if (currentScroll <= 0) {
                     showNav = true;
                 } else if (currentScroll > lastScrollY && currentScroll > 60) {
                     showNav = false;
                 } else if (currentScroll < lastScrollY) {
                     showNav = true;
                 }
                 lastScrollY = currentScroll;
             "
            :class="showNav ? 'translate-y-0' : '-translate-y-full'"
            class="bg-white shadow-sm border-b border-gray-100 fixed w-full top-0 z-50 transition-transform duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 relative">
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" wire:navigate class="shrink-0 flex items-center gap-3">
                            <img src="{{ asset('img/logo/logo.webp') }}" alt="PT Wilson"
                                class="h-10 w-auto object-contain">
                            <span class="font-bold text-gray-800 text-lg tracking-tight">PT. Wilson</span>
                        </a>
                    </div>

                    <div class="hidden sm:flex sm:space-x-8 h-full absolute left-1/2 -translate-x-1/2">
                            <a href="{{ route('dashboard') }}" wire:navigate
                                class="{{ request()->routeIs('dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium whitespace-nowrap">
                                Dashboard
                            </a>
                            @can('manage-transactions')
                                <a href="{{ route('items.index') }}" wire:navigate
                                    class="{{ request()->routeIs('items.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium whitespace-nowrap">
                                    Manajemen Barang
                                </a>
                                <a href="{{ route('categories.index') }}" wire:navigate
                                    class="{{ request()->routeIs('categories.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium whitespace-nowrap">
                                    Kategori
                                </a>
                                <a href="{{ route('transactions.inbound') }}" wire:navigate
                                    class="{{ request()->routeIs('transactions.inbound') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium whitespace-nowrap">
                                    Catat Barang Masuk
                                </a>
                                <a href="{{ route('transactions.outbound') }}" wire:navigate
                                    class="{{ request()->routeIs('transactions.outbound') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium whitespace-nowrap">
                                    Catat Barang Keluar
                                </a>
                            @endcan
                        </div>
                    <div class="flex items-center gap-4">
                        <button type="button" @click="showLogoutModal = true"
                            class="hidden sm:flex items-center gap-2 text-gray-600 hover:text-red-600 transition-colors text-sm font-medium group">
                            <span>{{ auth()->user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-red-600 transition-colors" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>

                        <div class="flex items-center sm:hidden">
                            <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-gray-200">
                <div class="pt-2 pb-3 px-2 space-y-1">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="{{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} block px-4 py-2.5 rounded-md text-sm font-medium transition-colors">
                        Dashboard
                    </a>
                    @can('manage-transactions')
                        <a href="{{ route('items.index') }}" wire:navigate
                            class="{{ request()->routeIs('items.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} block px-4 py-2.5 rounded-md text-sm font-medium transition-colors">
                            Manajemen Barang
                        </a>
                        <a href="{{ route('categories.index') }}" wire:navigate
                            class="{{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} block px-4 py-2.5 rounded-md text-sm font-medium transition-colors">
                            Kategori
                        </a>
                        <a href="{{ route('transactions.inbound') }}" wire:navigate
                            class="{{ request()->routeIs('transactions.inbound') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} block px-4 py-2.5 rounded-md text-sm font-medium transition-colors">
                            Catat Barang Masuk
                        </a>
                        <a href="{{ route('transactions.outbound') }}" wire:navigate
                            class="{{ request()->routeIs('transactions.outbound') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} block px-4 py-2.5 rounded-md text-sm font-medium transition-colors">
                            Catat Barang Keluar
                        </a>
                    @endcan
                </div>
                <div class="border-t border-gray-100">
                    <button type="button" @click="showLogoutModal = true"
                        class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-600 hover:text-red-600 hover:bg-red-50 transition-colors">
                        <span>{{ auth()->user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </div>

        </nav>

        <main class="flex-1 pt-16">
            @if (session()->has('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200 py-4 mt-6">
            <div class="max-w-7xl mx-auto px-4 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} PT Wilson. All rights reserved.
            </div>
        </footer>

        <form x-ref="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>

        <!-- Logout Modal -->
        <div x-show="showLogoutModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div x-show="showLogoutModal" x-transition.opacity
                    class="fixed inset-0 bg-black/50 transition-opacity"
                    @click="showLogoutModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showLogoutModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative z-10 inline-block align-bottom bg-white rounded-md text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-gray-100">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    Konfirmasi Keluar
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin keluar dari sistem? Anda harus masuk kembali untuk
                                        menggunakan aplikasi ini.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="button" @click="$refs.logoutForm.submit()"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Ya, Keluar
                        </button>
                        <button type="button" @click="showLogoutModal = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html>
