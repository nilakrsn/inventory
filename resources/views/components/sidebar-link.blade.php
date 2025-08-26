@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center md:p-3 lg:p-4 mb-1 bg-slate-800 rounded-md relative text-white font-semibold md:text-base lg:text-xl'
    : 'flex items-center md:p-3 lg:p-4 mb-1 text-gray-300 md:text-base lg:text-xl';

$iconName = $attributes->get('icon');
$iconType = ($active ?? false) ? $iconName : $iconName . '-outline';
@endphp

<a {{ $attributes->merge(['class' => $classes])  }}>
    <ion-icon name="{{ $iconType }}" class="md:text-xl lg:text-xl mr-2"></ion-icon>
    <span >{{ $slot }}</span>
</a>