@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center p-3 mb-1 bg-slate-800 rounded-md relative text-white font-semibold text-base'
    : 'flex items-center p-3 mb-1 text-gray-300 text-base';

$iconName = $attributes->get('icon');
$iconType = ($active ?? false) ? $iconName : $iconName . '-outline';
@endphp

<a {{ $attributes->merge(['class' => $classes])  }}>
    <ion-icon name="{{ $iconType }}" class="text-xl mr-2"></ion-icon>
    <span >{{ $slot }}</span>
</a>