<div class="bg-gray-200 dark:bg-gray-700 p-6 mb-4 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-2">Novo Post</h2>
    <form>
        <x-input-label for="title" :value="__('Titulo:')" />
        <x-text-input id="title" class="block mt-1 w-full mb-4" type="text" name="title" :value="old('title')" required
            autofocus autocomplete="title" />

        <x-text-area id="conteudo" name="conteudo" label="Conteúdo" placeholder="Digite algo..." />
        <x-primary-button>
            {{ __('Publicar') }}
        </x-primary-button>


    </form>
</div>