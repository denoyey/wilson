<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Login - PT. Wilson' }}</title>

    <link rel="icon" href="{{ asset('img/logo/logo.webp') }}" type="image/webp">

    <meta name="description"
        content="PT. Wilson Inventory System - Sistem Manajemen Gudang terintegrasi untuk melacak stok, barang masuk, dan barang keluar secara real-time dengan akurat.">
    <meta name="keywords"
        content="inventory system, manajemen gudang, sistem stok, pt wilson, aplikasi pergudangan, warehouse management, pencatatan stok">
    <meta name="author" content="PT. Wilson">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Login - PT. Wilson' }}">
    <meta property="og:description"
        content="Sistem Manajemen Gudang terintegrasi PT. Wilson untuk melacak stok secara real-time dan efisien.">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'Login - PT. Wilson' }}">
    <meta property="twitter:description"
        content="Sistem Manajemen Gudang terintegrasi PT. Wilson untuk melacak stok secara real-time dan efisien.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="bg-gray-50 text-gray-900 relative overflow-hidden font-sans antialiased selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen flex items-center justify-center px-4">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
