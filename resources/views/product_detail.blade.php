<x-app-layout>
    <div class="px-6" x-data="{ showCreateProduct: false }">
        <div class="flex bg-white p-6 rounded-lg space-x-4 w-full">
            <form method="POST" action="{{ route('products.update', $stock->id) }}" enctype="multipart/form-data"
                class="flex w-full space-x-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $stock->id }}">


                <div class="flex flex-col">
                    <div>
                        <label for="image" class="cursor-pointer inline-block">
                            <img id="previewImage" src="{{ $stock->product && $stock->product->image
                                ? asset('storage/' . $stock->product->image)
                                : asset('images/no-image.png') }}"
                                class="w-80 h-96 object-contain rounded-lg bg-gray-100 p-3"
                                alt="{{ $stock->product->name ?? 'Gambar Produk' }}">
                        </label>

                        <input type="file" id="image" name="image" class="hidden" accept="image/*" 
                            onchange="previewFile(event)">


                        <input type="hidden" name="old_image" value="{{ $stock->product->image }}">
                    </div>
                </div>

                <script>
                    function previewFile(event) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('previewImage').src = e.target.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
                <div class="flex flex-col w-4/5">
                    <div class="flex flex-row w-full space-x-4 mb-4">
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Nama Produk</label>
                            <input type="text" name="name"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                @input="changed = name.trim().length > 0" value="{{ $stock->product->name }}">

                        </div>
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Kode Produk</label>
                            <input type="text" name="barcode"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                @input="changed = barcode.trim().length > 0" value="{{ $stock->product->barcode }}">

                        </div>

                    </div>
                    <div class="flex flex-row w-full space-x-4 mb-4">
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Kategori</label>
                            <select name="categories_id"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $stock->product->categories_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Jumlah Stok</label>
                            <input type="number" name="quantity"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                @input="changed = quantity.trim().length > 0" value="{{ $stock->quantity }}">

                        </div>

                    </div>
                    <div class="flex flex-row w-full space-x-4 mb-4">
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Harga Modal</label>
                            <input type="number" name="cons_price"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                @input="changed = cons_price.trim().length > 0"
                                value="{{ $stock->product->cons_price }}">

                        </div>
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Harga Jual</label>
                            <input type="number" name="selling_price"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                @input="changed = selling_price.trim().length > 0"
                                value="{{ $stock->product->selling_price }}">

                        </div>

                    </div>
                    <div class="flex flex-row w-full space-x-4 mb-6">
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Tanggal Kadaluarsa</label>
                            <input type="date" name="expired"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                @input="changed = expired.trim().length > 0" value="{{ $stock->product->expired }}">

                        </div>
                        <div class="flex flex-col w-full">
                            <label class="block text-sm text-gray-700 dark:text-gray-200">Tanggal Masuk</label>
                            <input type="date" name="created_at"
                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white "
                                @input="changed = created_at.trim().length > 0"
                                value="{{ \Carbon\Carbon::parse($stock->created_at)->format('Y-m-d') }}">

                        </div>

                    </div>

                    <div class="flex flex-row w-full space-x-4">
                        <div class="flex flex-col w-full">
                            <button type="button" class="py-3 text-md border-2 border-sky-900  text-sky-900 rounded" @click="$dispatch('open-modal', { name: 'delete-product-{{ $stock->id }}' })">
                                Hapus
                            </button>
                        </div>
                        <div class="flex flex-col w-full">
                            <button type="submit" class="py-3.5 text-md bg-sky-900 text-white rounded"
                                :disabled="!changed" :class="{ 'opacity-50 cursor-not-allowed': !changed }">
                                Edit
                            </button>

                        </div>

                    </div>
                </div>
            </form>

        </div>

    </div>

    <x-modal name="delete-product-{{ $stock->id }}" :show="false">
        <div class="p-6" x-data>
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 text-left">
                Hapus Produk
            </h2>
            <form method="POST" action="{{ route('products.destroy', $stock->id) }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 text-left">
                    Apa Anda yakin ingin menghapus produk
                    "{{ $stock->product->name }}"?
                </p>
                <div class="flex justify-end">
                    <button type="button" class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded"
                        @click="$dispatch('close-modal', { name: 'delete-product-{{ $stock->id }}' })">
                        Tidak, Batalkan
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm bg-sky-900 text-white rounded">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-toast> </x-toast>
</x-app-layout>
