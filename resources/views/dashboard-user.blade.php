<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Catálogo - Mitra Cars</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
</head>
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
        }

        h1 {
        margin-bottom: 1rem;
        color: #2f3542;
        }


         .catalogo {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          gap: 0;
        }

       .card {
          background-color: rgb(185, 181, 181, 0.4);
          border-radius: 10px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.1);
          padding: 1rem;
          text-align: center;
          transition: 0.3s ease;
          height: 300px;
          width: 300px;
          margin: 10px; /* sin margen para que queden pegadas */
        }

        .card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        }

        .card h3 {
        margin: 0.8rem 0;
        font-size: 1.2rem;
        color: #2f3542;
        }

        .acciones {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        }

        .btn {
        padding: 0.4rem 0.8rem;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        }
        .btn.comprar {
            background-color: #00b894;
            color: white;
            }

        .btn.carrito {
            background-color: #6c5ce7;
            color: white;
            }


        /* Modal */
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
        max-width: 500px;
        height: 600px;
        width: 400px;
        position: relative;
        animation: fadeIn 0.3s ease;
        }

        .modal-content img {
        height: 400px;
        width: 400px;
        border-radius: 8px;
        margin-bottom: 1rem;
        }

        .modal-content h2 {
        margin-top: 0;
        color: #3f422f;
        }

        .modal-content p {
        margin: 0.5rem 0;
        }

        .close {
        position: absolute;
        top: 1rem; right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: #57606f;
        }

        @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
        }


</style>
<body>

  <header class="navbar">
    <div class="logo">Mitra Cars</div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout">Cerrar sesión</button>
    </form>
  </header>

  <main class="container">
    <h1 style="text-align:center; font-size:2rem; color:#f30b0b; text-transform:uppercase;"> Catálogo de Autos Mitra</h1>


    <div class="catalogo">
      @foreach ($autos as $auto)
      <div class="card">
        <img src="{{ asset('uploads/' . $auto->imagen) }}" alt="{{ $auto->modelo }}" onclick="openModal('{{ asset('uploads/' . $auto->imagen) }}', '{{ $auto->modelo }}', '{{ $auto->precio }}', `{{ $auto->descripcion }}`)">
        <h3 style="text-align:center; font-size:2rem; color:#fcf812; text-transform:uppercase;">{{ $auto->modelo }}</h3>
        <div class="acciones">
          <button class="btn comprar">Comprar</button>
          <button class="btn carrito">Agregar al carrito</button>
        </div>
      </div>
      @endforeach
    </div>
  </main>

  <!-- Modal -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <img id="modal-img" src="">
      <h2 id="modal-title"></h2>
      <p><strong>Precio:</strong> <span id="modal-price"></span></p>
      <p id="modal-description"></p>
    </div>
  </div>

  <script>
    function openModal(img, title, price, description) {
      document.getElementById('modal-img').src = img;
      document.getElementById('modal-title').innerText = title;
      document.getElementById('modal-price').innerText = price;
      document.getElementById('modal-description').innerText = description;
      document.getElementById('modal').style.display = "block";
    }

    function closeModal() {
      document.getElementById('modal').style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == document.getElementById('modal')) {
        closeModal();
      }
    }
  </script>
</body>
</html>
