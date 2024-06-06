<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <!-- Estilos do Breeze -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
        }

        .logo-container {
            text-align: center;
            margin-top: 50px;
        }

        .logo {
            max-width: 200px;
        }

        .welcome-text {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            color: #4a5568;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #60a5fa;
            /* Cor de fundo do botão de login */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .login-button:hover {
            background-color: #3b82f6;
            /* Cor de fundo do botão de login quando hover */
        }

        .register-link {
            margin-top: 10px;
            font-size: 14px;
            color: #4a5568;
            text-decoration: none;
        }

        .register-link:hover {
            color: #718096;
        }
    </style>
</head>

<body>
    <div class="logo-container">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    </div>

    <div class="welcome-text">
        <h2>Bem-vindo ao nosso aplicativo!</h2>
        <p>Faça login ou registre-se para continuar.</p>
    </div>

    <div class="button-container">
        <a href="{{ route('login') }}" class="login-button">Login</a>
        <p class="register-link">Não tem uma conta? <a href="{{ route('register') }}">Registre-se</a></p>
    </div>
</body>

</html>