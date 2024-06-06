Olá!

Por favor, clique no botão abaixo para verificar seu endereço de email.

@component('mail::button', ['url' => $url])
Verificar Email
@endcomponent

Se você não criou uma conta, nenhuma ação adicional é necessária.

Atenciosamente,
{{ config('app.name') }}

Se estiver com dificuldades para clicar no botão "Verificar Email", copie e cole o seguinte URL em seu navegador web:
[{{ $url }}]({{ $url }})