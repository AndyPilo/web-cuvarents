<form action="<?= BASE_URL ?>rents" method="GET" class="relative">
    <div class="flex flex-col md:flex-row gap-2 md:gap-3">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input
                type="search"
                name="search"
                class="block w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-full bg-white dark:bg-gray-800 shadow-sm dark:shadow-gray-900/50 focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-400 focus:border-cyan-500 dark:focus:border-cyan-400 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-gray-100 transition-all duration-200"
                placeholder="Busca por provincia, zona o categoría"
                required>
        </div>
        <button
            type="submit"
            class="px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 text-white font-medium rounded-full hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 dark:focus:ring-cyan-400 focus:ring-offset-white dark:focus:ring-offset-gray-800 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
            Buscar
        </button>
    </div>
</form>