@props(['comment' => null])

@php
    // Verifica se o comentário é nulo e define dados padrão de exemplo
    if (!$comment) {
        $comment = (object) [
            'description' => 'Muito bom o post!.',
            'user' => (object) ['name' => 'John Doe'],
            'created_at' => now()->subHours(2),
        ];
    }
@endphp
<div class="flex items-start space-x-4 mb-2">
    <div class="flex-1 bg-white dark:bg-gray-600 p-4 rounded-md shadow">
        <p class="text-sm">{{ $comment->description }}</p>
        <p class="text-xs text-gray-500">Autor: {{ $comment->user->name }} -
            {{ $comment->created_at->format('d M, Y H:i') }}
        </p>
    </div>
</div>