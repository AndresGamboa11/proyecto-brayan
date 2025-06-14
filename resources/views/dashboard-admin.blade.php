<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Mitra Cars</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
  <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: #f5f6fa;
        background-image: url('../img/parkin.jpg'), linear-gradient(to right, #0f2027, #203a43, #2c5364);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .navbar {
      background-color: #1e272e;
      padding: 1rem 2rem;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar .logo {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .navbar .logout {
      background: #ff3f34;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .container {
      padding: 2rem;
      text-align: center;
      color: white;
      
    }

    h1 {
      margin-bottom: 2rem;
      color: #0b41b6;
      font-size: 60px;
    }

    .brand-container {
      display: flex;
      justify-content: center;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .brand-card {
      width: 300px;
      height: 300px; 
      padding: 16px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      padding: 1rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
      font-size: 50px;
      cursor: pointer;
      transition: transform 0.3s;
    }

    .brand-card:hover {
      transform: scale(1.05);
    }

    .brand-card img {
      width: 100%;
      height: 300px; /* Altura fija */
      object-fit: cover; /* Recorta sin deformar */
      border-radius: 12px;
    }

    .brand-card p {
      margin-top: 0.5rem;
      font-weight: bold;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.6);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      max-width: 90%;
      max-height: 90%;
      overflow-y: auto;
      position: relative;
    }

    .close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      font-size: 1.5rem;
      cursor: pointer;
      color: #57606f;
    }

    .modal-autos {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      justify-content: center;
      margin-top: 1rem;
    }

    .card {
      width: 300px;
      background-color: #f1f2f6;
      border-radius: 10px;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }

    .acciones {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      margin-top: 1rem;
    }

    .btn {
      padding: 0.4rem 0.8rem;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn.edit {
      background-color: #1e90ff;
      color: white;
    }

    .btn.delete {
      background-color: #ff4757;
      color: white;
    }

    .btn.add {
      background-color: #2ed573;
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      margin: 1rem auto;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    .success{
      background-color: #2ed573; 
      color: white; 
      padding: 10px; 
      border-radius: 5px; 
      margin-bottom: 1rem; 
      height: 20px;
    }
  </style>
</head>
<body>
<header class="navbar">
  <div class="logo">Mitra Cars</div>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="logout">Cerrar sesión</button>
  </form>
</header>
<main class="container">
  <h1>Marcas de Taxis</h1>
  <div class="brand-container">
    @if(session('success'))
    <div class="success">
      {{ session('success') }}
    </div>
    @endif
    <div class="brand-card" onclick="openBrandModal('hiunday')">
      <img src="{{ asset('img/Hyunday.jpg') }}" alt="Hiunday">
      <p>Hiunday</p>
    </div>
    <div class="brand-card" onclick="openBrandModal('chevrolet')">
      <img src="{{ asset('img/atos1.jpg') }}" alt="Chevrolet">
      <p>Chevrolet</p>
    </div>
    <div class="brand-card" onclick="openBrandModal('renoult')">
      <img src="{{ asset('img/spark.jpg') }}" alt="Renoult">
      <p>Renoult</p>
    </div>
  </div>
</main>
<div id="brandModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 id="brandTitle">Marca</h2>
    <button class="btn add" onclick="document.getElementById('modal-form').style.display='flex'">+ Añadir Auto</button>
    <div class="modal-autos" id="autosContainer">
      @foreach ($autos as $auto)
        <div class="card" data-marca="{{ strtolower($auto->marca) }}">
          <img src="{{ asset('uploads/' . $auto->imagen) }}" alt="{{ $auto->marca }}">
          <h3>{{ $auto->marca }} {{ $auto->modelo }}</h3>
          <p><strong>${{ $auto->precio }}</strong></p>
          <div class="acciones">
            <a href="{{ route('autos.edit', $auto->id) }}" class="btn edit">Editar</a>
            <form method="POST" action="{{ route('autos.destroy', $auto->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn delete">Eliminar</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
<div id="modal-form" class="modal">
  <div class="modal-content">
    <span class="close" onclick="document.getElementById('modal-form').style.display='none'">&times;</span>
    <form action="{{ route('autos.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label>Marca:</label>
      <input type="text" name="marca" required><br><br>

      <label>Modelo:</label>
      <input type="text" name="modelo" required><br><br>

      <label>Descripción:</label>
      <textarea name="descripcion" required></textarea><br><br>

      <label>Precio:</label>
      <input type="number" name="precio" required><br><br>

      <label>Imagen:</label>
      <input type="file" name="imagen" accept="image/*" required><br><br>

      <button type="submit" class="btn add">Guardar</button>
    </form>
  </div>
</div>
<script>
  function openBrandModal(brand) {
      location.href = `#${brand}`; // solo para forzar referencia
      setTimeout(() => {
        document.getElementById('brandTitle').innerText = brand.charAt(0).toUpperCase() + brand.slice(1);
        document.getElementById('brandModal').style.display = 'flex';
        let cards = document.querySelectorAll('#autosContainer .card');
        cards.forEach(card => {
          card.style.display = card.getAttribute('data-marca') === brand ? 'block' : 'none';
        });
      }, 3); // espera para que recargue
    }

    function closeModal() {
      document.getElementById('brandModal').style.display = 'none';
    }
    window.addEventListener('DOMContentLoaded', () => {
      openBrandModal('{{ session('marca') }}');
    });
    // Ocultar modal al hacer clic fuera del contenido
    window.onclick = function(e) {
      if (e.target.classList.contains('modal')) {
        e.target.style.display = 'none';
      }
    }
</script>

</body>
</html>
