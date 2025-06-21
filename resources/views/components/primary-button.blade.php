<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-sky-900 text-white rounded-lg text-sm hover:bg-sky-700 transition']) }}>
    {{ $slot }}
</button>
