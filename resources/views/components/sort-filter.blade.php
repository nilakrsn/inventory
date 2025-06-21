@props(['sort'])

<a href="{{ request()->fullUrlWithQuery([
    'sort' => $sort,
    'direction' => request('direction') === 'asc' && request('sort') === $sort ? 'desc' : 'asc',
    ]) }}"
    class="flex items-center">
    @if (request('sort') === $sort)
    @if (request('direction') === 'asc')
        <ion-icon name="chevron-up-outline" class="w-3 text-sky-900"></ion-icon>
    @else
        <ion-icon name="chevron-down-outline" class="w-3 text-sky-900"></ion-icon>
    @endif
    @else
    <ion-icon name="chevron-down-outline" class="w-3 text-slate-400"></ion-icon>
    @endif
</a>

