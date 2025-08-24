<x-app-layout>
    <div x-data class="px-6">
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
                        <h2 class="text-lg font-semibold mb-4 text-white ">
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
                <table class="w-full text-center table-auto min-w-max ">
                    <thead class="bg-slate-700 text-gray-300">
                        <tr>
                            <th class="p-4">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm font-semibold leading-none">No</p>
                                    <x-sort-filter sort="no" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Tanggal Awal</p>
                                    <x-sort-filter sort="created_at" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Tanggal Update</p>
                                    <x-sort-filter sort="updated_at" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Nama</p>
                                    <x-sort-filter sort="name" />
                                </div>
                            </th>

                            <th class="p-4">
                                <div class="flex items-center space-x-1">
                                    <p class="text-sm leading-none font-semibold">Action</p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $data)
                            <tr class="   bg-slate-800 text-gray-300">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm ">
                                        {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm ">{{ $data->created_at->format('d-m-Y') }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm ">{{ $data->updated_at->format('d-m-Y') }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm ">{{ $data->name }}</p>
                                </td>
                                <td>
                                    <div class="flex flex-row space-x-1">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md  hover:bg-slate-600 text-gray-400  hover:text-gray-300  focus:outline-none transition ease-in-out duration-150">
                                                    <ion-icon name="ellipsis-horizontal"></ion-icon>

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
                                    <h2 class="text-lg font-semibold mb-4 text-gray-300">
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
                                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                                        Hapus Kategori</h2>
                                    <form method="POST" action="{{ route('categories.destroy', $data->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <p class="text-sm text-gray-300 mb-6 text-left">
                                            Apa
                                            Anda yakin ingin menghapus kategori
                                            "{{ $data->name }}"?</p>
                                        <div class="flex justify-end">
                                            <button type="button" class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded"
                                                @click="$dispatch('close-modal', { name: 'delete-category-{{ $data->id }}' })">
                                                Tidak, Batalkan
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 text-sm bg-sky-700 text-gray-300 rounded">
                                                Ya, Hapus
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-toast> </x-toast>
</x-app-layout>
