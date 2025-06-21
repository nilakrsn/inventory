<form method="GET" class="flex items-center mr-4 w-full relative">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
    </span>
    <input type="text" name="query" placeholder="Search..."
        class="flex-1 w-60 pl-10 pr-3 py-3 border border-sky-900 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-sm dark:bg-gray-700 dark:text-gray-200"
        value="{{ request('query') }}">
</form>
