<form action="<?= BASE_URL ?>rents" method="GET" class="relative">
    <div class="flex flex-col md:flex-row gap-2">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input
                type="search"
                name="search"
                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-full bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                placeholder="Busca por provincia, zona o categoría"
                required>
        </div>
        <button
            type="submit"
            class="px-6 py-3 bg-cyan-600 text-white font-medium rounded-full hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors">
            Buscar
        </button>
    </div>
</form>