<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-sky-800 text-white rounded-lg text-sm hover:bg-sky-700 transition']) }}>
    <!-- Ionicon Plus Icon -->
    <ion-icon name="add-outline" class="w-5 h-5 mr-2"></ion-icon>
    {{ $slot }}
</button>
