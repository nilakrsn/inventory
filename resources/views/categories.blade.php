<x-app-layout >
    <div x-data class="min-h-screen">
        <div class="p-6 bg-slate-800 rounded-lg">
            <div class="relative flex flex-col w-full text-gray-700  rounded-lg bg-clip-border">
                <div class="flex flex-row justify-between items-center mb-4">
                    <div class="w-1/3"><x-search-bar /></div>
                    <div class="flex-row flex space-x-4 w-2/3 justify-end">
                        <x-date-filter :start-date="$startDate" :end-date="$endDate" />
                        <x-primary-button @click="$dispatch('open-modal', { name: 'create-category' })">
                            <ion-icon name="add-outline" class="w-5 h-5 mr-2"></ion-icon> Tambah Kategori
                        </x-primary-button>
                    </div>
                </div>
                <!-- create modal-->
                <x-modal name="create-category" :show="false">
                    <div class="p-6" x-data="{ changed: false, name: '' }">
                        <h2 class="md:text-lg lg:text-xl font-semibold mb-4 text-white ">
                            Tambah Kategori
                        </h2>

                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <x-input label="Nama Kategori" name="name" model="name" required />

                            <div class="flex justify-end">
                                <x-form-buttons cancelTarget="create-category" submitText="Simpan" cancelText="Batal" />
                            </div>
                        </form>
                    </div>
                </x-modal>
                <table class="w-full text-center table-auto min-w-max bg-slate-700 text-gray-300"">
                    <thead class="md:text-sm lg:text-base leading-none font-semibold ">
                        <tr >
                            <th >
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>No</p>
                                    <x-sort-filter sort="no" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Tanggal Awal</p>
                                    <x-sort-filter sort="created_at" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Tanggal Update</p>
                                    <x-sort-filter sort="updated_at" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Nama</p>
                                    <x-sort-filter sort="name" />
                                </div>
                            </th>

                            <th class="p-4">
                                <div class="flex items-center space-x-1 ">
                                    <p>Action</p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $data)
                            <tr class="border-b border-slate-600 bg-slate-800 text-gray-300 md:text-sm lg:text-base">
                                <td class="p-4 py-5">
                                
                                    <p>
                                        {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p >{{ $data->created_at->format('d-m-Y') }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p>{{ $data->updated_at->format('d-m-Y') }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p>{{ $data->name }}</p>
                                </td>
                                <td>
                                    <div class="flex flex-row space-x-1">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent md:ext-base lg:text-xl leading-4 font-medium  rounded-md  hover:bg-slate-600 text-gray-400  hover:text-gray-300  focus:outline-none transition ease-in-out duration-150">
                                                    <ion-icon name="ellipsis-horizontal" ></ion-icon>

                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link
                                                    @click="$dispatch('open-modal', { name: 'update-category-{{ $data->id }}' })">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link
                                                    @click="$dispatch('open-modal', { name: 'delete-category-{{ $data->id }}' })">
                                                    {{ __('Hapus') }}
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>


                                        
                                    </div>
                                </td>
                            </tr>
                            <!-- update modal-->
                            <x-modal name="update-category-{{ $data->id }}" :show="false">
                                <div class="p-6 text-left" x-data="{ changed: false, name: '{{ $data->name }}' }">
                                    <h2 class="md:text-lg lg:text-xl font-semibold mb-4 text-gray-300">
                                        Edit Kategori
                                    </h2>

                                    <form method="POST" action="{{ route('categories.update', $data->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-input label="Nama Kategori" name="name" model="name" required />

                                        <div class="flex justify-end">
                                            <x-form-buttons cancelTarget="update-category-{{ $data->id }}"
                                                submitText="Simpan" cancelText="Batal" />
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                            <x-modal name="delete-category-{{ $data->id }}" :show="false">
                                <div class="p-6" x-data="{ changed: false, name: '{{ $data->name }}' }">
                                    <h2 class="md:text-lg lg:text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                                        Hapus Kategori</h2>
                                    <form method="POST" action="{{ route('categories.destroy', $data->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <p class="md:text-sm lg:text-base text-gray-300 mb-6 text-left">
                                            Apa
                                            Anda yakin ingin menghapus kategori
                                            "{{ $data->name }}"?</p>
                                        <div class="flex justify-end">
                                            <button type="button" class="mr-2 px-4 py-2 md:text-sm lg:text-base bg-gray-200 rounded"
                                                @click="$dispatch('close-modal', { name: 'delete-category-{{ $data->id }}' })">
                                                Tidak, Batalkan
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 md:text-sm lg:text-base bg-sky-700 text-gray-300 rounded">
                                                Ya, Hapus
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center px-4 py-3 md:text-sm lg:text-base text-gray-300"">
                    <div>
                        Showing <b>{{ $categories->firstItem() }}-{{ $categories->lastItem() }}</b> of
                        {{ $categories->total() }}
                    </div>
                    <div class="flex space-x-1">
                        {{-- Previous Button --}}
                        <button
                            class="px-3 py-1 min-w-9 min-h-9  bg-slate-300 border border-slate-200 text-slate-600 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $categories->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                            @if (!$categories->onFirstPage()) onclick="window.location='{{ $categories->previousPageUrl() }}'" @endif
                            {{ $categories->onFirstPage() ? 'disabled' : '' }}>
                            Prev
                        </button>

                        {{-- Page Numbers --}}
                        @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 {{ $categories->currentPage() == $page ? 'text-gray-300 bg-sky-900 border-sky-900' : 'text-slate-700 bg-slate-300 ' }} border rounded hover:bg-sky-700 hover:border-slate-700 transition duration-200 ease"
                                @if ($categories->currentPage() != $page) onclick="window.location='{{ $url }}'" @endif
                                {{ $categories->currentPage() == $page ? 'disabled' : '' }}>
                                {{ $page }}
                            </button>
                        @endforeach

                        {{-- Next Button --}}
                        <button
                            class="px-3 py-1 min-w-9 min-h-9  bg-slate-300 border border-slate-300 text-slate-600 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ !$categories->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}"
                            @if ($categories->hasMorePages()) onclick="window.location='{{ $categories->nextPageUrl() }}'" @endif
                            {{ !$categories->hasMorePages() ? 'disabled' : '' }}>
                            Next
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    

  
</x-app-layout>
