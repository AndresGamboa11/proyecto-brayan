<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <link rel="stylesheet" href="{{asset('css/register.css')}}">

  <style>
    /* Todo tu CSS original se mantiene sin cambios */
    /* ... */
  </style>
</head>

<body>
  <header class="navbar">
    <div class="logo">
      <img class='imglogo' src="{{ asset('img/logo.jpg') }}" alt="">
      <p class='text-logo'>Mitra Cars</p>
    </div>
    <div class="actions">
      <a href="{{ route('login') }}">Iniciar sesión</a>
      <a href="{{ route('welcome') }}">Inicio</a>
    </div>
  </header>

  <div class="overlay">
    <div class="form-container">
      <h2>Regístrate para conocer nuestro catálogo</h2>

      {{-- Mensajes de error --}}
      @if ($errors->any())
        <div class="error-message" style="color: red; margin-bottom: 10px;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" id="name" placeholder="Nombre completo"
          value="{{ old('name') }}" required autocomplete="name">

        <input type="email" name="email" id="email" placeholder="Correo electrónico"
          value="{{ old('email') }}" required autocomplete="username">

        <input type="password" name="password" id="password" placeholder="Contraseña" required autocomplete="new-password">

        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password">

        {{-- Selector de rol si es necesario --}}
        <select name="role" id="role" required>
          <option value="">Selecciona un rol</option>
          <option value="usuario" {{ old('role') == 'usuario' ? 'selected' : '' }}>Usuario</option>
          <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
        </select>

        <div class="actions">
          <a href="{{ route('login') }}">¿Ya tienes cuenta?</a>
          <button type="submit">Registrarse</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
