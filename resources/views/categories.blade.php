<x-app-layout>
    <div x-data>
        <div class="flex flex-row items-center justify-between px-6 py-4">
            <span class="text-lg font-semibold text-gray-900 dark:text-white">Kategori</span>
            <div class="space-x-2 flex items-center">
                <x-date-filter :start-date="$startDate" :end-date="$endDate" />
                <x-primary-button @click="$dispatch('open-modal', { name: 'create-category' })">
                    Tambah Kategori
                </x-primary-button>

                <!-- create modal-->
                <x-modal name="create-category" :show="false">
                    <div class="p-6" x-data="{ changed: false, name: '' }">
                        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Tambah Kategori</h2>

                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm text-gray-700 dark:text-gray-200">Nama</label>
                                <input type="text" name="name" x-model="name"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                    required @input="changed = name.trim().length > 0">
                            </div>

                            <div class="flex justify-end">
                                <button type="button" @click="$dispatch('close-modal', { name: 'create-category' })"
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
            </div>
        </div>
        <div class="px-6">
            <div class="bg-white rounded-lg px-3 py-6">
                <div class="relative flex flex-col w-fulltext-gray-700 bg-white rounded-lg bg-clip-border">
                    <table class="w-full text-center table-auto min-w-max border border-gray-100">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-gray-200 bg-slate-200">
                                    <div class="flex items-center space-x-1 justify-center">
                                        <p class="text-sm font-semibold leading-none text-slate-600">No</p>
                                        <a
                                            href="{{ request()->fullUrlWithQuery([
                                                'sort' => 'no',
                                                'direction' => request('direction') === 'asc' && request('sort') === 'no' ? 'desc' : 'asc',
                                            ]) }}"
                                            class="flex items-center"
                                        >
                                            @if (request('sort') === 'no')
                                                @if (request('direction') === 'asc')
                                                    <ion-icon name="chevron-up-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @else
                                                    <ion-icon name="chevron-down-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @endif
                                            @else
                                                <ion-icon name="chevron-down-outline"
                                                    class="w-3 text-slate-400"></ion-icon>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-200">
                                    <div class="flex items-center space-x-1 justify-center">
                                        <p class="text-sm leading-none text-slate-600 font-semibold">Tanggal Awal</p>
                                        <a
                                            href="{{ request()->fullUrlWithQuery([
                                                'sort' => 'created_at',
                                                'direction' => request('direction') === 'asc' && request('sort') === 'created_at' ? 'desc' : 'asc',
                                            ]) }}" class="flex items-center">
                                            @if (request('sort') === 'created_at')
                                                @if (request('direction') === 'asc')
                                                    <ion-icon name="chevron-up-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @else
                                                    <ion-icon name="chevron-down-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @endif
                                            @else
                                                <ion-icon name="chevron-down-outline"
                                                    class="w-3 text-slate-400"></ion-icon>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-200">
                                    <div class="flex items-center space-x-1 justify-center">
                                        <p class="text-sm leading-none text-slate-600 font-semibold">Tanggal Update</p>
                                        <a
                                            href="{{ request()->fullUrlWithQuery([
                                                'sort' => 'updated_at',
                                                'direction' => request('direction') === 'asc' && request('sort') === 'updated_at' ? 'desc' : 'asc',
                                            ]) }}" class="flex items-center">
                                            @if (request('sort') === 'updated_at')
                                                @if (request('direction') === 'asc')
                                                    <ion-icon name="chevron-up-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @else
                                                    <ion-icon name="chevron-down-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @endif
                                            @else
                                                <ion-icon name="chevron-down-outline"
                                                    class="w-3 text-slate-400"></ion-icon>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-200">
                                    <div class="flex items-center space-x-1 justify-center">
                                        <p class="text-sm leading-none text-slate-600 font-semibold">Nama</p>
                                        <a
                                            href="{{ request()->fullUrlWithQuery([
                                                'sort' => 'name',
                                                'direction' => request('direction') === 'asc' && request('sort') === 'name' ? 'desc' : 'asc',
                                            ]) }}" class="flex items-center">
                                            @if (request('sort') === 'name')
                                                @if (request('direction') === 'asc')
                                                    <ion-icon name="chevron-up-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @else
                                                    <ion-icon name="chevron-down-outline"
                                                        class="w-3 text-sky-800"></ion-icon>
                                                @endif
                                            @else
                                                <ion-icon name="chevron-down-outline"
                                                    class="w-3 text-slate-400"></ion-icon>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-200">
                                    <div class="flex items-center space-x-1">
                                        <p class="text-sm leading-none text-slate-600 font-semibold">Action</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $data)
                                <tr class="hover:bg-slate-50 border-b border-slate-200">
                                    <td class="p-4 py-5">
                                        <p class="block font-semibold text-sm text-slate-800">
                                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                        </p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">{{ $data->created_at->format('d-m-Y') }}</p>
                                    </td>
                                     <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">{{ $data->updated_at->format('d-m-Y') }}</p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">{{ $data->name }}</p>
                                    </td>
                                    <td>
                                        <div class="flex flex-row space-x-1">
                                            <button type="button"
                                                class="relative h-10 w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none flex items-center justify-center"
                                                @click="$dispatch('open-modal', { name: 'update-category-{{ $data->id }}' })">
                                                <ion-icon name="pencil" class="w-5 h-5"></ion-icon>
                                            </button>
                                            <!-- update modal-->
                                            <x-modal name="update-category-{{ $data->id }}" :show="false">
                                                <div class="p-6" x-data="{ changed: false }">
                                                    <h2
                                                        class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                                                        Edit Kategori</h2>

                                                    <form method="POST"
                                                        action="{{ route('categories.update', $data->id) }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="id"
                                                            value="{{ $data->id }}">

                                                        <div class="mb-4">
                                                            <label
                                                                class="block text-sm text-gray-700 dark:text-gray-200">Nama</label>
                                                            <input type="text" name="name"
                                                                value="{{ $data->name }}"
                                                                class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                                                                required @input="changed = true">
                                                        </div>

                                                        <div class="flex justify-end">
                                                            <button type="button"
                                                                class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded"
                                                                @click="$dispatch('close-modal', { name: 'update-category-{{ $data->id }}' })">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                class="px-4 py-2 text-sm bg-sky-600 text-white rounded"
                                                                :disabled="!changed"
                                                                :class="{ 'opacity-50 cursor-not-allowed': !changed }">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </x-modal>
                                            <button type="button"
                                                class="relative h-10 w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none flex items-center justify-center"
                                                @click="$dispatch('open-modal', { name: 'delete-category-{{ $data->id }}' })">
                                                <ion-icon name="trash-bin-outline" class="w-5 h-5"></ion-icon>
                                            </button>
                                            <x-modal name="delete-category-{{ $data->id }}" :show="false">
                                                <div class="p-6" x-data="{ changed: false }">
                                                    <h2
                                                        class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                                                        Hapus Kategori</h2>

                                                    <form method="POST"
                                                        action="{{ route('categories.destroy', $data->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <input type="hidden" name="id"
                                                            value="{{ $data->id }}">

                                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Apa
                                                            anda yakin ingin menghapus kategori
                                                            "{{ $data->name }}"?</p>
                                                        <div class="flex justify-end">
                                                            <button type="button"
                                                                class="mr-2 px-4 py-2 text-sm bg-gray-200 rounded"
                                                                @click="$dispatch('close-modal', { name: 'delete-category-{{ $data->id }}' })">
                                                                Tidak, Batalkan
                                                            </button>
                                                            <button type="submit"
                                                                class="px-4 py-2 text-sm bg-sky-600 text-white rounded">
                                                                Ya, Hapus
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </x-modal>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-slate-500">
                            Showing <b>{{ $categories->firstItem() }}-{{ $categories->lastItem() }}</b> of
                            {{ $categories->total() }}
                        </div>
                        <div class="flex space-x-1">
                            {{-- Previous Button --}}
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $categories->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                @if (!$categories->onFirstPage()) onclick="window.location='{{ $categories->previousPageUrl() }}'" @endif
                                {{ $categories->onFirstPage() ? 'disabled' : '' }}>
                                Prev
                            </button>

                            {{-- Page Numbers --}}
                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                <button
                                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $categories->currentPage() == $page ? 'text-white bg-sky-800 border-sky-800' : 'text-sky-700 bg-white border-sky-700' }} border rounded hover:bg-slate-200 hover:border-sky-700 transition duration-200 ease"
                                    @if ($categories->currentPage() != $page) onclick="window.location='{{ $url }}'" @endif
                                    {{ $categories->currentPage() == $page ? 'disabled' : '' }}>
                                    {{ $page }}
                                </button>
                            @endforeach

                            {{-- Next Button --}}
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ !$categories->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                @if ($categories->hasMorePages()) onclick="window.location='{{ $categories->nextPageUrl() }}'" @endif
                                {{ !$categories->hasMorePages() ? 'disabled' : '' }}>
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
