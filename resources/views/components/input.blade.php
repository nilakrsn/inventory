
@props(['label', 'name', 'type' => 'text', 'model' => null, 'required' => false])


<div class="mb-4">
    <label class="block md:text-sm lg:text-base text-gray-300">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        @if($model) x-model="{{ $model }}" @endif
        class="file:h-10 file:px-4 file:py-2 file:mr-4 file:bg-sky-900 file:border-none file:shadow-none file:text-gray-300 mt-1 w-full  rounded border-slate-700 bg-slate-700 focus:outline-none focus:ring focus:ring-slate-600 text-gray-300"
        @if($required) required @endif
        @input="changed = {{ $model ?? $name }}.trim().length > 0"
    >
</div>


