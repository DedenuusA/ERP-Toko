<header class="bg-white shadow-sm border-b">

    <div class="flex items-center justify-between px-6 py-4">

        <!-- TITLE DINAMIS -->

        <div>

            <h1 class="text-2xl font-bold text-slate-800">

                @php

                    $title = 'Dashboard';

                    if (request()->routeIs('dashboard')) {
                        $title = 'Dashboard';
                    } elseif (request()->routeIs('categories.*')) {
                        $title = 'Kategori';
                    } elseif (request()->routeIs('units.*')) {
                        $title = 'Unit';
                    } elseif (request()->routeIs('products.*')) {
                        $title = 'Produk';
                    } elseif (request()->routeIs('suppliers.*')) {
                        $title = 'Supplier';
                    } elseif (request()->routeIs('customers.*')) {
                        $title = 'Customer';
                    } elseif (request()->routeIs('purchases.*')) {
                        $title = 'Pembelian';
                    } elseif (request()->routeIs('sales.*')) {
                        $title = 'Penjualan';
                    } elseif (request()->routeIs('reports.*')) {
                        $title = 'Laporan';
                    } elseif (request()->routeIs('pos.*')) {
                        $title = 'POS Kasir';
                    }

                @endphp

                {{ $title }}

            </h1>

            <p class="text-sm text-gray-500 mt-1">

                Selamat datang,
                {{ Auth::user()->name }}

            </p>

        </div>

        <!-- JAM + PROFILE -->

        <div class="flex items-center gap-6">

            <!-- DATE & CLOCK -->

            <div class="text-right">

                <p id="date" class="text-sm text-gray-500">

                </p>

                <h2 id="clock" class="text-2xl font-bold text-slate-800">

                    00:00:00

                </h2>

            </div>

            <!-- DROPDOWN -->

            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-xl transition">

                            <div class="text-sm font-medium text-slate-700">

                                {{ Auth::user()->name }}

                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">

                            Profile

                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

        </div>

    </div>

</header>

<script>
    function updateClock() {
        const now = new Date();

        // JAM
        const hours =
            String(now.getHours()).padStart(2, '0');

        const minutes =
            String(now.getMinutes()).padStart(2, '0');

        const seconds =
            String(now.getSeconds()).padStart(2, '0');

        document.getElementById('clock')
            .innerText =
            `${hours}:${minutes}:${seconds}`;

        // TANGGAL
        const options = {

            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'

        };

        document.getElementById('date')
            .innerText =
            now.toLocaleDateString('id-ID', options);
    }

    setInterval(updateClock, 1000);

    updateClock();
</script>
