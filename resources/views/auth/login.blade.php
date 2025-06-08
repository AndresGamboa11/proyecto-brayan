<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <style>
        /* TODO EL CSS ORIGINAL SE MANTIENE IGUAL */
        /* ... */
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <img class="imglogo" src="{{ asset('img/logo.jpg') }}" alt="Logo">
            <p class="text-logo">Mitra Cars</p>
        </div>
        <div class="actions">
            <a href="{{ route('register') }}">Registrarse</a>
            <a href="{{ route('welcome') }}">Inicio</a>
        </div>
    </header>

    <div class="overlay">
        <div class="form-container">
            <h2 class="text-login">LOGIN</h2>

            @if (session('status'))
                <div class="error-message" style="color: green;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <input type="email" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
                </div>

                <div>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Recordarme</label>
                </div>

                <div class="actions">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                    <button class="btn-inicio" type="submit">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
