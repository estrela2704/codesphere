<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Novo Post -->
                    <x-new-post></x-new-post>

                    <!-- Post 1 -->
                    <x-post></x-post>

                    <!-- Post 2 (exemplo duplicado) -->
                    <x-post></x-post>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>