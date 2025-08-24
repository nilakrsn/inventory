<nav class="ml-6 border-b border-slate-800 ">
    <div class="flex flex-row h-16 justify-between items-center bg-slate-900 ">


        <div class="px-6 font-semibold text-lg text-gray-300 flex items-center gap-2">
            @php
                $titles = [
                    'dashboard' => 'Dashboard',
                    'categories' => 'Kategori',
                    'products' => 'Produk',
                    'expands' => 'Pengeluaran',
                ];

                $currentRoute = Route::currentRouteName();
                $parts = explode('.', $currentRoute);

                $base = $parts[0];
                $action = $parts[1] ?? null;

                if ($action) {
                    $actionTitles = [
                        'show' => 'Detail',
                    ];
                    $title = ($actionTitles[$action] ?? ucfirst($action)) . ' ' . ($titles[$base] ?? ucfirst($base));
                } else {
                    $title = $titles[$base] ?? ucfirst($base);
                }

                $listRoutes = [
                    'products' => route('products'),
                    
                ];

                $backUrl = $listRoutes[$base] ?? url()->previous();
            @endphp


            @if ($action === 'show')
                <a href="{{ $backUrl }}" class="text-gray-300 hover:text-sky-700 ">
                    <ion-icon name="arrow-back-outline" class=" flex items-center justify-center"
                        size="medium"></ion-icon>
                </a>
            @endif

            <span>{{ $title ?? 'Profil' }}</span>
        </div>

        {{-- Kanan: Dropdown User --}}
        <div class="hidden sm:flex sm:items-center sm:ms-6 mr-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-300  bg-slate-800 hover:bg-slate-700 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
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
