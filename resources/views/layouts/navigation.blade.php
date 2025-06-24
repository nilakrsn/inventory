<nav class="border-b border-gray-100">
    <div class="flex flex-row h-16 justify-between items-center bg-white ">
        <div class="px-6 font-semibold text-lg text-sky-900">
            @php
            $titles = [
                'dashboard' => 'Dashboard',
                'categories' => 'Kategori',
                'products' => 'Produk',
                'expands' => 'Pengeluaran',
                
            ];
            $currentRoute = Route::currentRouteName();
            @endphp
            <span>{{ $titles[$currentRoute] ?? 'Profil' }}</span>
        </div>
        <div class="hidden sm:flex sm:items-center sm:ms-6 mr-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profil') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
