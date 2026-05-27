<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP Toko</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold text-blue-600">ERP TOKO</h1>

            <div class="space-x-3">
                <a href="{{ route('login') }}" class="px-4 py-2 text-gray-600 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Register</a>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

        <div>
            <h2 class="text-4xl font-bold leading-tight">
                Kelola Toko Lebih Mudah & Modern 🚀
            </h2>

            <p class="text-gray-600 mt-4">
                Sistem ERP untuk penjualan, pembelian, stok barang, dan laporan bisnis secara real-time.
            </p>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-3 rounded-lg">
                    Mulai Gratis
                </a>
                <a href="#produk" class="border px-5 py-3 rounded-lg">
                    Lihat Produk
                </a>
            </div>
        </div>

        <div>
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=80"
                class="rounded-2xl shadow-lg">
        </div>

    </section>

    <!-- PRODUCTS -->
    <section id="produk" class="max-w-6xl mx-auto px-6 py-10">

        <h3 class="text-2xl font-bold mb-6">Produk Unggulan</h3>

        <div class="grid md:grid-cols-3 gap-6">

            <!-- CARD 1 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=800"
                    class="h-48 w-full object-cover">

                <div class="p-4">
                    <h4 class="font-bold">Laptop Office</h4>
                    <p class="text-gray-500 text-sm">Cocok untuk operasional toko</p>
                    <p class="mt-2 font-bold text-blue-600">Rp 8.500.000</p>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800"
                    class="h-48 w-full object-cover">

                <div class="p-4">
                    <h4 class="font-bold">Smartphone</h4>
                    <p class="text-gray-500 text-sm">Untuk komunikasi & sales</p>
                    <p class="mt-2 font-bold text-blue-600">Rp 3.200.000</p>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=800"
                    class="h-48 w-full object-cover">

                <div class="p-4">
                    <h4 class="font-bold">Printer POS</h4>
                    <p class="text-gray-500 text-sm">Cetak struk cepat & stabil</p>
                    <p class="mt-2 font-bold text-blue-600">Rp 1.250.000</p>
                </div>
            </div>

        </div>

    </section>

    <!-- FEATURES -->
    <section class="bg-white py-16 mt-10">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-6 text-center">

            <div>
                <h4 class="font-bold text-lg">📦 Manajemen Stok</h4>
                <p class="text-gray-500 mt-2">Pantau barang real-time</p>
            </div>

            <div>
                <h4 class="font-bold text-lg">💰 Laporan Keuangan</h4>
                <p class="text-gray-500 mt-2">Penjualan & laba rugi otomatis</p>
            </div>

            <div>
                <h4 class="font-bold text-lg">📊 Analytics</h4>
                <p class="text-gray-500 mt-2">Data bisnis lebih jelas</p>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-6 text-gray-500">
        © {{ date('Y') }} ERP Toko - All Rights Reserved
    </footer>
</body>

</html>
