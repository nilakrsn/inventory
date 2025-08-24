@props([
    'cancelName' => 'close-modal',
    'cancelTarget' => null,
    'submitText' => 'Submit',
    'cancelText' => 'Cancel',
])


{{-- Tombol Cancel --}}
<button type="button" @click="$dispatch('{{ $cancelName }}'{{ $cancelTarget ? ", { name: '$cancelTarget' }" : '' }})"
    class="mr-2 px-4 py-2 text-sm bg-gray-300 hover:bg-gray-200 rounded">
    {{ $cancelText }}
</button>

{{-- Tombol Submit --}}
<button type="submit" class="px-4 py-2 text-sm bg-sky-900 hover:bg-sky-700 text-gray-300 rounded" :disabled="!changed"
    :class="{ 'opacity-50 cursor-not-allowed': !changed }">
    {{ $submitText }}
</button>
