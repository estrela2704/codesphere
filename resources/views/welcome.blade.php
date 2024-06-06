<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CodeSphere') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" width="200px" alt="Logo" class="logo mt-5">
            </a>
        </div>

        <div class="welcome-text m-9">
            <h2 class="text-2xl font-medium text-gray-900">Bem-vindo ao nosso Website!</h2>
            <p class="mt-2 text-xl text-gray-500 mt-5">Entre ou registre-se para continuar.</p>
        </div>

        <div class="button-container mt-1 flex justify-between">
            <x-primary-button class="ms-4">
                <a href="{{ route('login') }}">
                    Entrar
                </a>
            </x-primary-button>
            <x-primary-button class="ms-4">
                <a href="{{ route('register') }}">
                    Registrar
                </a>
            </x-primary-button>
        </div>
    </div>
</body>

</html>