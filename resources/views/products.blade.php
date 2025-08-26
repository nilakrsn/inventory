<x-app-layout>
    <div x-data>
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
                        <h2 class ="md:text-lg lg:text-xl font-semibold mb-4 text-white ">
                            Tambah Produk</h2>
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <x-input label="Nama Produk" name="name" model="name" required />
                            <x-input label="Kode Produk" name="barcode" model="barcode" />
                            <div class="mb-4">
                                <label class="block md:text-sm lg:text-base text-gray-300">Kategori</label>
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
                            <x-input label="Gambar Produk" name="image" type="file" accept="image/*" />
                            <div class="flex justify-end">
                                <x-form-buttons cancelTarget="create-product" submitText="Simpan" cancelText="Batal" />

                            </div>
                        </form>
                    </div>
                </x-modal>

                <table class="w-full text-center table-auto min-w-max bg-slate-700 text-gray-300 ">
                    <thead class="md:text-sm lg:text-base font-semibold leading-none">
                        <tr>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>No</p>
                                    <x-sort-filter sort="no" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Gambar</p>
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Tanggal</p>
                                    <x-sort-filter sort="stock_created_at" />
                                </div>
                            </th>

                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Nama</p>
                                    <x-sort-filter sort="product_name" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Kategori</p>
                                    <x-sort-filter sort="categories" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Jumlah</p>
                                    <x-sort-filter sort="quantity" />
                                </div>
                            </th>

                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Harga Modal</p>
                                    <x-sort-filter sort="cons_price" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Harga Jual</p>
                                    <x-sort-filter sort="selling_price" />
                                </div>
                            </th>
                            <th>
                                <div class="flex items-center space-x-1 justify-center p-4">
                                    <p>Status</p>
                                    <x-sort-filter sort="status" />
                                </div>
                            </th>


                            <th class="p-4">
                                <div class="flex items-center space-x-1">
                                    <p>Action</p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $data)
                            <tr
                                class="border-b border-slate-600 bg-slate-800 text-gray-300 font-semibold md:text-sm lg:text-base">

                                <td class="p-4 py-5">
                                    <p>
                                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <img src="{{ asset('storage/' . $data->image) }}" alt="Gambar Produk"
                                        class="h-16 mx-auto">
                                </td>
                                <td>
                                    <p>
                                        {{ \Carbon\Carbon::parse($data->stock_created_at)->format('d-m-Y') }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="md:text-sm lg:text-base ">{{ $data->product_name }}</p>
                                </td>

                                <td class="p-4 py-5">
                                    <p>{{ $data->category_name ?? '-' }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p>{{ $data->quantity }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p>{{ $data->cons_price }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p>{{ $data->selling_price }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p>{{ $data->status }}</p>
                                </td>
                                <td>
                                    <div class="flex flex-row space-x-1">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent md:text-base lg:text-xl leading-4 font-medium rounded-md  hover:bg-slate-600 text-gray-400 focus:outline-none transition ease-in-out duration-150">
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
                                    <h2 class="md:text-lg lg:text-xl font-semibold mb-4 text-gray-300 text-left">
                                        Edit Produk
                                    </h2>
                                    <form method="POST" action="{{ route('products.update', $data->stock_id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <x-input label="Nama Produk" name="name" model="name" @input="changed = name.trim().length > 0" />
                                        <x-input label="Kode Produk" name="barcode" model="barcode" @input="changed = barcode.trim().length > 0"/>
                                        <div class="mb-4">
                                            <label class="block md:text-sm lg:text-base text-gray-300">Kategori</label>
                                            <select name="categories_id" x-model="categories_id"
                                                class="mt-1 w-full rounded border-slate-700 bg-slate-700 focus:outline-none focus:ring focus:ring-slate-600 text-gray-300"
                                                @input="changed = categories_id.trim().length > 0">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <x-input label="Jumlah Produk" name="quantity" model="quantity"
                                            type="number" @input="changed = quantity.trim().length > 0" />
                                        <x-input label="Harga Modal" name="cons_price" model="cons_price"
                                            type="number" @input="changed = cons_price.trim().length > 0"/>
                                        <x-input label="Harga Jual" name="selling_price" model="selling_price"
                                            type="number" @input="changed = selling_price.trim().length > 0"/>
                                        <x-input label="Tanggal Kadaluarsa" name="expired" model="expired"
                                            type="date" @input="changed = expired.trim().length > 0"/>
                                        @if ($data->image)
                                            <div class="bg-slate-600 p-2 rounded-lg">

                                                <img src="{{ asset('storage/' . $data->image) }}" alt="Gambar Produk"
                                                    class="h-40 mx-auto">
                                            </div>
                                            <span class="text-xs text-red-500 italic">Biarkan kosong jika tidak
                                                diubah</span>
                                        @endif


                                        <x-input label="Gambar Produk" name="image" type="file"
                                            accept="image/*" @change="image = $event.target.files[0]; changed = true"/>
                                        <input type="hidden" name="old_image" value="{{ $data->image }}">
                                        <div class="flex justify-end">
                                            <button type="button"
                                                @click="$dispatch('close-modal', { name: 'update-product-{{ $data->stock_id }}' })"
                                                class="mr-2 px-4 py-2 md:text-sm lg:text-base bg-gray-200 rounded">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 md:text-sm lg:text-base bg-sky-900 text-white rounded"
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
                                    <h2
                                        class="md:text-lg lg:text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                                        Hapus Produk
                                    </h2>
                                    <form method="POST" action="{{ route('products.destroy', $data->stock_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="stock_id" value="{{ $data->stock_id }}">
                                        <p class="md:text-sm lg:text-base text-gray-300  mb-6 text-left">
                                            Apa Anda yakin ingin menghapus produk
                                            "{{ $data->product_name }}"?
                                        </p>
                                        <div class="flex justify-end">
                                            <button type="button"
                                                class="mr-2 px-4 py-2 md:text-sm lg:text-base bg-gray-200 rounded"
                                                @click="$dispatch('close-modal', { name: 'delete-product-{{ $data->stock_id }}' })">
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
                        Showing <b>{{ $products->firstItem() }}-{{ $products->lastItem() }}</b> of
                        {{ $products->total() }}
                    </div>
                    <div class="flex space-x-1">
                        {{-- Previous Button --}}
                        <button
                            class="px-3 py-1 min-w-9 min-h-9  bg-white border border-slate-200 text-slate-600 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $products->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                            @if (!$products->onFirstPage()) onclick="window.location='{{ $products->previousPageUrl() }}'" @endif
                            {{ $products->onFirstPage() ? 'disabled' : '' }}>
                            Prev
                        </button>

                        {{-- Page Numbers --}}
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 {{ $products->currentPage() == $page ? 'text-white bg-sky-900 border-sky-900' : 'text-sky-700 bg-white border-sky-700' }} border rounded hover:bg-slate-200 hover:border-sky-700 transition duration-200 ease"
                                @if ($products->currentPage() != $page) onclick="window.location='{{ $url }}'" @endif
                                {{ $products->currentPage() == $page ? 'disabled' : '' }}>
                                {{ $page }}
                            </button>
                        @endforeach

                        {{-- Next Button --}}
                        <button
                            class="px-3 py-1 min-w-9 min-h-9  bg-white border border-slate-200 text-slate-600 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ !$products->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}"
                            @if ($products->hasMorePages()) onclick="window.location='{{ $products->nextPageUrl() }}'" @endif
                            {{ !$products->hasMorePages() ? 'disabled' : '' }}>
                            Next
                        </button>
                    </div>

                </div>


            </div>

        </div>
        <x-toast></x-toast>
</x-app-layout>
