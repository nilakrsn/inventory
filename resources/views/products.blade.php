<x-app-layout>
    <div x-data>
        <div class="px-6">
            <div class="bg-white rounded-lg px-6 py-6 mt-6">
                <div class="relative flex flex-col w-full text-gray-700 bg-white rounded-lg bg-clip-border">
                    <div class="flex flex-row justify-between items-center mb-4">
                        <div class="w-1/3"><x-search-bar /></div>
                        <div class="flex-row flex space-x-4 w-2/3 justify-end">
                            <x-date-filter :start-date="$startDate" :end-date="$endDate" />
                            <x-primary-button @click="$dispatch('open-modal', { name: 'create-products' })">
                                <ion-icon name="add-outline" class="w-5 h-5 mr-2"></ion-icon> Tambah Produk
                            </x-primary-button>
                        </div>
                    </div>
                    <!-- create modal-->
                    <x-modal name="create-products" :show="false">
                        <div class="p-6" x-data="{ changed: false, name: '' }">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Tambah Produk</h2>
                            <form method="POST" action="{{ route('products.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Nama</label>
                                    <input type="text" name="name" x-model="name"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                        required @input="changed = name.trim().length > 0">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Barcode</label>
                                    <input type="text" name="barcode" x-model="barcode"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                        required @input="changed = barcode.trim().length > 0">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Gambar Produk</label>
                                    <input type="file" name="image"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                        accept="image/*">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Kategori</label>
                                    <select name="categories" x-model="categories"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                        required @change="changed = categories.trim().length > 0">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Harga Modal</label>
                                    <input type="number" name="cons_price" x-model="cons_price"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                        required @>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Harga Jual</label>
                                    <input type="number" name="selling_price" x-model="selling_price"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm text-gray-700 dark:text-gray-200">Tanggal
                                        Kadaluarsa</label>
                                    <input type="date" name="expired" x-model="expired"
                                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                </div>

                                <div class="flex justify-end">
                                    <button type="button"
                                        @click="$dispatch('close-modal', { name: 'create-products' })"
                                        class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded">
                                        Cancel
                                    </button>
                                    <button type="submit" class="px-4 py-2 text-sm bg-sky-600 text-white rounded"
                                        :disabled="!changed" :class="{ 'opacity-50 cursor-not-allowed': !changed }">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </x-modal>

                    <div class="overflow-x-auto w-ful">
                        <table class="w-full text-center table-auto min-w-max border border-gray-100">
                            <thead class="bg-gray-200 ">
                                <tr>
                                    <th class="p-4 border-b">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm font-semibold leading-none">No</p>
                                            <x-sort-filter sort="no" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Tanggal Awal</p>
                                            <x-sort-filter sort="created_at" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Tanggal Update</p>
                                            <x-sort-filter sort="updated_at" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Nama</p>
                                            <x-sort-filter sort="name" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Barcode</p>
                                            <x-sort-filter sort="barcode" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Gambar</p>
                                            <x-sort-filter sort="image" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Kategori</p>
                                            <x-sort-filter sort="categories" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Harga Modal</p>
                                            <x-sort-filter sort="cons_price" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Harga Jual</p>
                                            <x-sort-filter sort="selling_price" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Status</p>
                                            <x-sort-filter sort="status" />
                                        </div>
                                    </th>
                                    <th class="p-4 border-b ">
                                        <div class="flex items-center space-x-1 justify-center">
                                            <p class="text-sm leading-none font-semibold">Tanggal Kadaluarsa</p>
                                            <x-sort-filter sort="expired" />
                                        </div>
                                    </th>

                                    <th class="p-4 border-b">
                                        <div class="flex items-center space-x-1">
                                            <p class="text-sm leading-none font-semibold">Action</p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $data)
                                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                                        <td class="p-4 py-5">
                                            <p class="block font-semibold text-sm text-slate-800">
                                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                            </p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->created_at->format('d-m-Y') }}
                                            </p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->updated_at->format('d-m-Y') }}
                                            </p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->name }}</p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->barcode }}</p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->image }}</p>
                                        </td>
                                        @if (!empty($data->categories) && count($data->categories) > 0)
                                            @foreach ($data->categories as $category)
                                                <td class="p-4 py-5">
                                                    <p class="text-sm text-slate-500">{{ $category->name }}</p>
                                                </td>
                                            @endforeach
                                        @else
                                            <td class="p-4 py-5">
                                                <p class="text-sm text-slate-500">-</p>
                                            </td>
                                        @endif
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->cons_price }}</p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->selling_price }}</p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->status }}</p>
                                        </td>
                                        <td class="p-4 py-5">
                                            <p class="text-sm text-slate-500">{{ $data->expired }}</p>
                                        </td>
                                        <td>
                                            <div class="flex flex-row space-x-1">
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <button
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 hover:bg-slate-200 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                            <ion-icon name="ellipsis-horizontal"></ion-icon>

                                                        </button>
                                                    </x-slot>
                                                    <x-slot name="content">
                                                        <x-dropdown-link
                                                            @click="$dispatch('open-modal', { name: 'update-products-{{ $data->id }}' })">
                                                            {{ __('Edit') }}
                                                        </x-dropdown-link>
                                                        <x-dropdown-link
                                                            @click="$dispatch('open-modal', { name: 'delete-products-{{ $data->id }}' })">
                                                            {{ __('Hapus') }}
                                                        </x-dropdown-link>
                                                    </x-slot>
                                                </x-dropdown>
                                                <!-- update modal-->
                                                <x-modal name="update-products-{{ $data->id }}" :show="false">
                                                    <div class="p-6" x-data="{ changed: false, name: '{{ $data->name }}' }">
                                                        <h2
                                                            class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                                                            Edit Kategori
                                                        </h2>
                                                        <form method="POST"
                                                            action="{{ route('categories.update', $data->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            div class="mb-4">
                                                            <label
                                                                class="block text-sm text-gray-700 dark:text-gray-200">Nama</label>
                                                            <input type="text" name="name" x-model="name"
                                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                                required @input="changed = name.trim().length > 0">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm text-gray-700 dark:text-gray-200">Barcode</label>
                                                        <input type="text" name="barcode" x-model="barcode"
                                                            class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                            required @input="changed = barcode.trim().length > 0">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm text-gray-700 dark:text-gray-200">Gambar
                                                            Produk</label>
                                                        <input type="file" name="image"
                                                            class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                            accept="image/*">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm text-gray-700 dark:text-gray-200">Kategori</label>
                                                        <select name="categories[]" x-model="selectedCategories"
                                                            class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                            multiple required
                                                            @change="changed = selectedCategories.length > 0">
                                                            <option value="">Pilih Kategori</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if (!empty($data->categories) && $data->categories && $data->categories->contains('id', $category->id)) selected @endif>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm text-gray-700 dark:text-gray-200">Harga
                                                            Modal</label>
                                                        <input type="number" name="cons_price" x-model="cons_price"
                                                            class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                            required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm text-gray-700 dark:text-gray-200">Harga
                                                            Jual</label>
                                                        <input type="number" name="selling_price"
                                                            x-model="selling_price"
                                                            class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                            required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm text-gray-700 dark:text-gray-200">Tanggal
                                                            Kadaluarsa</label>
                                                        <input type="date" name="expired" x-model="expired"
                                                            class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                                    </div>

                                                    <div class="flex justify-end">
                                                        <button type="button"
                                                            @click="$dispatch('close-modal', { name: 'update-products-{{ $data->id }}' })"
                                                            class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded">
                                                            Cancel
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
                                            <!-- delete modal-->
                                            <x-modal name="delete-products-{{ $data->id }}" :show="false">
                                                <div class="p-6" x-data="{ changed: false, name: '{{ $data->name }}' }">
                                                    <h2
                                                        class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                                                        Hapus Produk</h2>
                                                    <form method="POST"
                                                        action="{{ route('products.destroy', $data->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id"
                                                            value="{{ $data->id }}">
                                                        <p
                                                            class="text-sm text-gray-600 dark:text-gray-400 mb-6 text-left">
                                                            Apa
                                                            Anda yakin ingin menghapus produk
                                                            "{{ $data->name }}"?</p>
                                                        <div class="flex justify-end">
                                                            <button type="button"
                                                                class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded"
                                                                @click="$dispatch('close-modal', { name: 'delete-products-{{ $data->id }}' })">
                                                                Tidak, Batalkan
                                                            </button>
                                                            <button type="submit"
                                                                class="px-4 py-2 text-sm bg-sky-900 text-white rounded">
                                                                Ya, Hapus
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </x-modal>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-slate-500">
                            Showing <b>{{ $products->firstItem() }}-{{ $products->lastItem() }}</b> of
                            {{ $products->total() }}
                        </div>
                        <div class="flex space-x-1">
                            {{-- Previous Button --}}
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $products->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                @if (!$products->onFirstPage()) onclick="window.location='{{ $products->previousPageUrl() }}'" @endif
                                {{ $products->onFirstPage() ? 'disabled' : '' }}>
                                Prev
                            </button>

                            {{-- Page Numbers --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <button
                                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $products->currentPage() == $page ? 'text-white bg-sky-900 border-sky-900' : 'text-sky-700 bg-white border-sky-700' }} border rounded hover:bg-slate-200 hover:border-sky-700 transition duration-200 ease"
                                    @if ($products->currentPage() != $page) onclick="window.location='{{ $url }}'" @endif
                                    {{ $products->currentPage() == $page ? 'disabled' : '' }}>
                                    {{ $page }}
                                </button>
                            @endforeach

                            {{-- Next Button --}}
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ !$products->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                @if ($products->hasMorePages()) onclick="window.location='{{ $products->nextPageUrl() }}'" @endif
                                {{ !$products->hasMorePages() ? 'disabled' : '' }}>
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-toast> </x-toast>
</x-app-layout>
