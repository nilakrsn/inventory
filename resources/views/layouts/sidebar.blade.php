<aside class="flex flex-col w-1/6 h-screen border-r border-gray-100">
    <div class="flex items-center border-b border-gray-100 px-6 py-2">
        <img src="image/air.png" class="w-12 mr-3" alt="Logo">
        <span class="ml-2 font-semibold text-xl text-sky-900">Inventory</span>
    </div>
    <nav class="flex flex-col flex-1">
        <span class="text-gray-400 px-6 py-4 pt-6 text-sm">MAIN MENU</span>
        <div class="flex flex-col px-6">
            <x-sidebar-link href="{{ route('dashboard') }}" icon="home" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('categories') }}" icon="grid" :active="request()->routeIs('categories')">
                Kategori
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="cube" :active="request()->routeIs('welcome')">
                Produk
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="arrow-down-circle" :active="request()->routeIs('welcome')">
                Barang Masuk
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="arrow-up-circle" :active="request()->routeIs('welcome')">
                Barang Keluar
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="cash" :active="request()->routeIs('welcome')">
                Pemasukan
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="card" :active="request()->routeIs('welcome')">
                Pengeluaran
            </x-sidebar-link>
        </div>
        <span class="text-gray-400 px-6 py-3 pt-6 text-sm">OTHER MENU</span>
        <div class="flex flex-col px-6">
            <x-sidebar-link href="{{ route('dashboard') }}" icon="document" :active="request()->routeIs('welcome')">
                Report
            </x-sidebar-link>
            <form method="POST" action="{{ route('logout') }}">
                            @csrf
            <x-sidebar-link href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                icon="log-out" :active="request()->routeIs('welcome')">
                Logout
            </x-sidebar-link>
            </form>
        </div>
    </nav>
</aside>
