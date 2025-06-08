<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mitra Cars | Bienvenido</title>

    <!-- Fuente Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">


    <style>
        
    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img class="imglogo" src="{{ asset('img/logo.jpg') }}" alt="Logo Mitra Cars" />
            <p class="text-logo">Mitra Cars</p>
        </div>
        <div class="actions">
            <a href="{{route('login') }}">Iniciar sesión</a>
            <a href="{{ route('register') }}">Registrarse</a>
        </div>
    </header>

    <main class="hero">
        <h1>Bienvenido a Mitra Cars</h1>
        <p>Tu plataforma confiable para compra, venta y gestión de vehículos. Explora las mejores ofertas y servicios para tu automóvil.</p>
    </main>

</body>

</html> 
