<aside class="w-72 bg-slate-900 text-white min-h-screen flex flex-col">

    <!-- LOGO -->

    <div class="p-6 border-b border-slate-800">

        <h1 class="text-2xl font-bold">
            ERP TOKO
        </h1>

        <p class="text-slate-400 text-sm mt-1">
            Sistem ERP & POS Modern
        </p>

    </div>

    <!-- MENU -->

    <nav class="flex-1 overflow-y-auto p-4 space-y-4">

        <!-- DASHBOARD -->

        <a href="/dashboard"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition
            {{ request()->is('dashboard') ? 'bg-slate-800' : '' }}">

            <span>🏠</span>

            Dashboard

        </a>

        <!-- POS -->

        <a href="{{ route('pos.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition
            {{ request()->routeIs('pos.*') ? 'bg-slate-800' : '' }}">

            <span>🛒</span>

            POS Kasir

        </a>

        <!-- MASTER DATA -->

        <details class="group"
            {{ request()->routeIs('categories.*') ||
            request()->routeIs('units.*') ||
            request()->routeIs('products.*') ||
            request()->routeIs('suppliers.*') ||
            request()->routeIs('customers.*')
                ? 'open'
                : '' }}>

            <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer hover:bg-slate-800">

                <div class="flex items-center gap-3">

                    <span>📂</span>

                    Master Data

                </div>

                <span class="group-open:rotate-180 transition">
                    ⌄
                </span>

            </summary>

            <div class="mt-2 ml-4 space-y-1">

                <a href="{{ route('categories.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('categories.*') ? 'bg-slate-800' : '' }}">

                    Kategori

                </a>

                <a href="{{ route('units.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('units.*') ? 'bg-slate-800' : '' }}">

                    Satuan

                </a>

                <a href="{{ route('products.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('products.*') ? 'bg-slate-800' : '' }}">

                    Barang

                </a>

                <a href="{{ route('suppliers.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('suppliers.*') ? 'bg-slate-800' : '' }}">

                    Supplier

                </a>

                <a href="{{ route('customers.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('customers.*') ? 'bg-slate-800' : '' }}">

                    Customer

                </a>

            </div>

        </details>

        <!-- TRANSAKSI -->

        <details class="group"
            {{ request()->routeIs('purchases.*') || request()->routeIs('sales.*') || request()->routeIs('stocks.*')
                ? 'open'
                : '' }}>

            <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer hover:bg-slate-800">

                <div class="flex items-center gap-3">

                    <span>💳</span>

                    Transaksi

                </div>

                <span class="group-open:rotate-180 transition">
                    ⌄
                </span>

            </summary>

            <div class="mt-2 ml-4 space-y-1">

                <a href="{{ route('purchases.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('purchases.*') ? 'bg-slate-800' : '' }}">

                    Pembelian

                </a>

                <a href="{{ route('sales.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('sales.*') ? 'bg-slate-800' : '' }}">

                    Penjualan

                </a>

                <a href="{{ route('stocks.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-slate-800
                    {{ request()->routeIs('stocks.*') ? 'bg-slate-800' : '' }}">

                    Stok Barang

                </a>

            </div>

        </details>

        <!-- LAPORAN -->

        <details class="group" {{ request()->routeIs('reports.*') ? 'open' : '' }}>

            <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer hover:bg-slate-800">

                <div class="flex items-center gap-3">

                    <span>📊</span>

                    Laporan

                </div>

                <span class="group-open:rotate-180 transition">
                    ⌄
                </span>

            </summary>

            <div class="mt-2 ml-4 space-y-1">

                <a href="{{ route('reports.sales') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">

                    Penjualan

                </a>

                <a href="{{ route('reports.purchases') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">

                    Pembelian

                </a>

                <a href="{{ route('reports.profit-loss') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">

                    Laba Rugi

                </a>

            </div>

        </details>

        <!-- SETTING -->

        <details class="group">

            <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer hover:bg-slate-800">

                <div class="flex items-center gap-3">

                    <span>⚙️</span>

                    Pengaturan

                </div>

                <span class="group-open:rotate-180 transition">
                    ⌄
                </span>

            </summary>

            <div class="mt-2 ml-4 space-y-1">

                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800">

                    Profile

                </a>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-red-600 transition">

                        Logout

                    </button>

                </form>

            </div>

        </details>

    </nav>

</aside>
