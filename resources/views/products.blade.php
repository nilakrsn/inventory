<x-app-layout>
    <div x-data class="px-6">
        <div class="p-6 bg-slate-800 rounded-lg">
            <div class="relative flex flex-col w-full text-gray-700  rounded-lg bg-clip-border">
                <div class="flex flex-row justify-between items-center mb-4">
                    <div class="w-1/3"><x-search-bar /></div>
                    <div class="flex-row flex space-x-4 w-2/3 justify-end">
                        <x-date-filter :start-date="$startDate" :end-date="$endDate" />
                        <x-primary-button @click="$dispatch('open-modal', { name: 'create-product' })">
                            <ion-icon name="add-outline" class="w-5 h-5 mr-2"></ion-icon> Tambah Produk
                        </x-primary-button>
                    </div>
                </div>

                <!-- create modal-->
                <x-modal name="create-product" x-bind:show="showCreateProduct">
                    <div class="p-6" x-data="{
                        changed: false,
                        name: '',
                        barcode: '',
                        image: null,
                        categories_id: [],
                        cons_price: '',
                        selling_price: '',
                        status: 'active',
                        expired: '',
                        quantity: ''
                    }">
                        <h2 class ="text-lg font-semibold mb-4 text-white ">
                            Tambah Produk</h2>
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <x-input label="Nama Produk" name="name" model="name" required />
                            <x-input label="Kode Produk" name="barcode" model="barcode" />
                            <x-input label="Gambar Produk" name="image" type="file" accept="image/*" />
                            <div class="mb-4">
                                <label class="block text-sm text-gray-300">Kategori</label>
                                <select name="categories_id" x-model="categories_id"
                                    class="mt-1 w-full rounded border-slate-700 bg-slate-700 focus:outline-none focus:ring focus:ring-slate-600 text-gray-300 ">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input label="Jumlah Produk" name="quantity" model="quantity" type="number" />
                            <x-input label="Harga Modal" name="cons_price" model="cons_price" type="number" />
                            <x-input label="Harga Jual" name="selling_price" model="selling_price" type="number" />
                            <x-input label="Tanggal Kadaluarsa" name="expired" model="expired" type="date" />

                            <div class="flex justify-end">
                                <x-form-buttons cancelTarget="create-product" submitText="Simpan" cancelText="Batal" />

                            </div>
                        </form>
                    </div>
                </x-modal>

                <table class="w-full text-center table-auto min-w-max ">
                    <thead class="bg-slate-700 text-gray-300 ">
                        <tr>
                            <th class="p-4">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm font-semibold leading-none">No</p>
                                    <x-sort-filter sort="no" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Gambar</p>
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Tanggal</p>
                                    <x-sort-filter sort="stock_created_at" />
                                </div>
                            </th>

                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Nama</p>
                                    <x-sort-filter sort="product_name" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Kategori</p>
                                    <x-sort-filter sort="categories" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Jumlah</p>
                                    <x-sort-filter sort="quantity" />
                                </div>
                            </th>

                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Harga Modal</p>
                                    <x-sort-filter sort="cons_price" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Harga Jual</p>
                                    <x-sort-filter sort="selling_price" />
                                </div>
                            </th>
                            <th class="p-4 ">
                                <div class="flex items-center space-x-1 justify-center">
                                    <p class="text-sm leading-none font-semibold">Status</p>
                                    <x-sort-filter sort="status" />
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
                        @foreach ($products as $data)
                            <tr class="bg-slate-800 text-gray-300">

                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm ">
                                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <img src="{{ asset('storage/' . $data->image) }}" alt="Gambar Produk"
                                        class="h-16 mx-auto">
                                </td>
                                <td>
                                    <p class="text-sm">
                                        {{ \Carbon\Carbon::parse($data->stock_created_at)->format('d-m-Y') }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm ">{{ $data->product_name }}</p>
                                </td>

                                <td class="p-4 py-5">
                                    <p class="text-sm">{{ $data->category_name ?? '-' }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm">{{ $data->quantity }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm">{{ $data->cons_price }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm">{{ $data->selling_price }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm">{{ $data->status }}</p>
                                </td>
                                <td>
                                    <div class="flex flex-row space-x-1">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md  hover:bg-slate-600 text-gray-400 focus:outline-none transition ease-in-out duration-150">
                                                    <ion-icon name="ellipsis-horizontal"></ion-icon>

                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link href="{{ route('products.show', $data->stock_id) }}">
                                                    {{ __('Detail') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link
                                                    @click="$dispatch('open-modal', { name: 'update-product-{{ $data->stock_id }}' })">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link
                                                    @click="$dispatch('open-modal', { name: 'delete-product-{{ $data->stock_id }}' })">
                                                    {{ __('Hapus') }}
                                                </x-dropdown-link>

                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </td>
                            </tr>
                            <!-- update modal -->
                            <x-modal name="update-product-{{ $data->stock_id }}" :show="false">
                                <div class="p-6 text-left" x-data="{ changed: false, name: '{{ $data->product_name }}', barcode: '{{ $data->barcode }}', cons_price: '{{ $data->cons_price }}', selling_price: '{{ $data->selling_price }}', expired: '{{ $data->expired }}', categories_id: '{{ $data->categories_id }}', image: null, quantity: '{{ $data->quantity }}' }">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-300 text-left">
                                        Edit Produk
                                    </h2>
                                    <form method="POST" action="{{ route('products.update', $data->stock_id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <x-input label="Nama Produk" name="name" model="name" required />
                                        <x-input label="Kode Produk" name="barcode" model="barcode" />
                                        <x-input label="Gambar Produk" name="image" type="file"
                                            accept="image/*" />
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm text-gray-700 dark:text-gray-200">Gambar
                                                Produk</label>
                                            <input type="file" name="image"
                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                accept="image/*">
                                            <input type="hidden" name="old_image" value="{{ $data->image }}">
                                            @if ($data->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $data->image) }}"
                                                        alt="Gambar Produk" class="h-16">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-sm text-gray-700 dark:text-gray-200">Kategori</label>
                                            <select name="categories_id" x-model="categories_id"
                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                @input="changed = categories_id.trim().length > 0">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm text-gray-700 dark:text-gray-200">Jumlah
                                                stok</label>
                                            <input type="number" name="quantity" x-model="quantity"
                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                @input="changed = quantity.trim().length > 0">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-sm text-gray-700 dark:text-gray-200">Harga
                                                Modal</label>
                                            <input type="number" name="cons_price" x-model="cons_price"
                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                @input="changed = cons_price.trim().length > 0">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm text-gray-700 dark:text-gray-200">Harga
                                                Jual</label>
                                            <input type="number" name="selling_price" x-model="selling_price"
                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                @input="changed = selling_price.trim().length > 0">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm text-gray-700 dark:text-gray-200">Tanggal
                                                Kadaluarsa</label>
                                            <input type="date" name="expired" x-model="expired"
                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button"
                                                @click="$dispatch('close-modal', { name: 'update-product-{{ $data->stock_id }}' })"
                                                class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 text-sm bg-sky-900 text-white rounded"
                                                :disabled="!changed"
                                                :class="{ 'opacity-50 cursor-not-allowed': !changed }">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                            <!-- delete modal -->
                            <x-modal name="delete-product-{{ $data->stock_id }}" :show="false">
                                <div class="p-6" x-data>
                                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                                        Hapus Produk
                                    </h2>
                                    <form method="POST" action="{{ route('products.destroy', $data->stock_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="stock_id" value="{{ $data->stock_id }}">
                                        <p class="text-sm text-gray-300  mb-6 text-left">
                                            Apa Anda yakin ingin menghapus produk
                                            "{{ $data->product_name }}"?
                                        </p>
                                        <div class="flex justify-end">
                                            <button type="button" class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded"
                                                @click="$dispatch('close-modal', { name: 'delete-product-{{ $data->stock_id }}' })">
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
    <x-toast></x-toast>
</x-app-layout>
