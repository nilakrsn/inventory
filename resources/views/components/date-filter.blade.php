<style>
    /* Chrome, Safari, Edge */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(87%) sepia(6%) saturate(222%) hue-rotate(180deg) brightness(96%) contrast(92%);
        opacity: 1;
    }
</style>
<form {{ $attributes->merge(['class' => 'flex flex-col md:flex-row md:items-center md:space-x-2 space-y-2 md:space-y-0']) }} method="GET" id="date-filter-form">
    <div class="flex flex-row md:flex-row md:items-center md:space-x-2 space-y-2 md:space-y-0 w-full">
        <input
            type="date"
            name="start_date"
            class="border border-slate-700 bg-slate-700 rounded-md px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-slate-600 w-full md:w-auto text-gray-300 placeholder-gray-300"
            value="{{ $startDate }}"
            placeholder="Start date"
        >
        <span class= mx-auto md:mx-0">-</span>
        <input
            type="date"
            name="end_date"
            id="end_date"
            class="border border-slate-700 bg-slate-700 rounded-md px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-slate-600 w-full md:w-auto text-gray-300 placeholder-gray-300"
            value="{{ $endDate }}"
            placeholder="End date"
        >
    </div>
    <div class="flex space-x-2">
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('date-filter-form');
                const inputs = form.querySelectorAll('input[type="date"]');
                inputs.forEach(input => {
                    input.addEventListener('change', function () {
                        form.submit();
                    });
                });
            });
        </script>
        <a href="{{ url()->current() }}" class="inline-flex items-center px-3 py-3 border border-slate-700 bg-slate-700 rounded-md text-gray-300 text-sm hover:bg-slate-600 hover:text-gray-300 transition">
            <ion-icon name="refresh-outline" class="w-5 h-5"></ion-icon>
        </a>
    </div>
</form>

