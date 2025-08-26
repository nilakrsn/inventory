<aside class=" md:flex flex-col w-10/12  h-screen border-r border-slate-800 fixed left-0 top-0 z-10">
    <div class="flex items-center border-b border-slate-800 px-6 py-2">
        <img src="{{ asset('image/air.png') }}" class="md:w-12 lg:w-16 mr-3" alt="Logo">
        <span class="ml-2 font-semibold md:text-xl lg:text-2xl text-gray-300">Inventory</span>
    </div>
    <div class="flex flex-col flex-1"> 
        <span class="text-gray-300 px-6 py-4 pt-6 md:text-sm lg:text-base">MAIN MENU</span>
        <div class="flex flex-col px-6">
            <x-sidebar-link href="{{ route('dashboard') }}" icon="home" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('categories') }}" icon="grid" :active="request()->routeIs('categories')">
                Kategori
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('products') }}" icon="cube" :active="request()->routeIs('products*')">
                Produk
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="arrow-down-circle" :active="request()->routeIs('welcome')">
                Barang Masuk
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('dashboard') }}" icon="arrow-up-circle" :active="request()->routeIs('welcome')">
                Barang Keluar
            </x-sidebar-link>
             <x-sidebar-link href="{{ route('dashboard') }}" icon="document" :active="request()->routeIs('welcome')">
                Report
            </x-sidebar-link>
        </div>
        <span class="text-gray-300 px-6 py-3 pt-6 md:text-sm lg:text-base">OTHER MENU</span>
        <div class="flex flex-col px-6">
           
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
    </div>
</aside>
