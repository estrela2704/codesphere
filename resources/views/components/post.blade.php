<div class="bg-gray-100 dark:bg-gray-700 p-6 mb-4 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-2">Título do Post 1</h2>
    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Autor: João Silva</p>
        <p class="text-sm text-gray-500 dark:text-gray-400">Data: 18 Jun, 2024</p>
    </div>
    <p class="text-gray-600 dark:text-gray-300 mb-4">Conteúdo do post 1. Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna
        aliqua.</p>
    <div class="flex items-center justify-between">
        <div class="flex items-center">

            <x-like-button />
            <p class="leading-1 text-sm text-gray-500 ml-2 inline-block align-middle">10 curtidas
            </p>

        </div>
    </div>
    <hr>

    <div class="mt-4">
        <h3 class="text-lg font-semibold mb-2">Comentários</h3>
        <div class="space-y-4">
            <x-comments />
        </div>
        <form class="mt-4">
            <x-text-area id="comentario" name="comentario" label="" placeholder="Digite algo..." />
            <x-primary-button class="">
                {{ __('Comentar') }}
            </x-primary-button>
        </form>
    </div>
</div>