<?php
session_start();
$izena = $_SESSION['izena'] ?? null;
$rola = $_SESSION['rola'] ?? null;
?>

<!DOCTYPE html>
<html lang="eu">
<head>
  <meta charset="UTF-8">
  <title>alaikToMUGI - Taxi Zerbitzuak</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="Estiloa/EstiloaIndex.css" rel="stylesheet">

  <style>
    header.masthead {
      background-image: url('Argazkia/taxi.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      position: relative;
    }

    /* 🧊 Estilo para navbar translúcido y borroso */
    #mainNav {
      background-color: rgba(255, 255, 255, 0.3); /* fondo translúcido */
      backdrop-filter: blur(8px); /* desenfoque del fondo */
      -webkit-backdrop-filter: blur(8px); /* soporte Safari */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* sombra sutil */
      transition: background-color 0.3s ease;
    }

    #mainNav .nav-link {
      color: #000 !important; /* texto negro para contraste */
      font-weight: 500;
    }

    #mainNav .navbar-brand {
      color: #000 !important;
      font-weight: bold;
    }

    .masthead h1, .masthead p {
      color: white;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
    }

    .divider {
      border-top: 2px solid #fff;
      opacity: 0.6;
      width: 60px;
      margin: 20px auto;
    }

    .fondoko_esaldia 
    {
      background-color: rgba(0, 0, 0, 0.5); /* fondo oscuro semitransparente */
      color: #fff;
      padding: 15px 20px;
      border-radius: 10px;
      display: inline-block;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6); /* sombra para realce */
      font-size: 1.2rem;
  }

  </style>
</head>
<body id="page-top">

<!-- 🚖 Navegación -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="#page-top">alaikToMUGI</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars ms-1"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto">
        <?php if ($izena): ?>
          <li class="nav-item"><a class="nav-link" href="#">👋 Kaixo, <?= htmlspecialchars($izena) ?>!</a></li>
          <?php if ($rola === 'erabiltzailea'): ?>
            <li class="nav-item"><a class="nav-link" href="./PHP/bidaiaSortu.php">Bidaia Programatu</a></li>
            <li class="nav-item"><a class="nav-link" href="./PHP/bidaienHistoriala.php">Nire Bidaiak</a></li>
          <?php elseif ($rola === 'gidaria'): ?>
            <li class="nav-item"><a class="nav-link" href="./PHP/gidariaBidaienKudeaketa.php">Bidaien Kudeaketa</a></li>
            <li class="nav-item"><a class="nav-link" href="./PHP/gidariBidaiakHistoriala.php">Bidaien historiala</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="./PHP/saioaItxi.php">Saioa Itxi</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="./PHP/erregistroaErabiltzailea.php">Erabiltzaile erregistroa</a></li>
          <li class="nav-item"><a class="nav-link" href="./PHP/saioaErabiltzailea.php">Erabiltzaile login</a></li>
          <li class="nav-item"><a class="nav-link" href="./PHP/saioaGidaria.php">Gidari login</a></li>
          <li class="nav-item"><a class="nav-link" href="./PHP/gidariErregistroa.php">Gidari erregistroa</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- 🖼️ Encabezado -->
<header class="masthead">
  <div class="container px-4 px-lg-5 h-100">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-8 align-self-end">
        <h1 class="font-weight-bold">Bidaiatu erraz eta seguru alaikToMUGI-rekin</h1>
        <hr class="divider" />
      </div>
      <div class="col-lg-8 align-self-baseline">
        <p class="mb-5 frase-fondo">
          Taxi zerbitzu adimenduna, erabiltzaileentzat eta gidarientzat diseinatua.
        </p>

        <?php if (!$izena): ?>
          <a class="btn btn-primary btn-xl" href="./PHP/saioaErabiltzailea.php">Erabiltzaile moduan hasi</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>

<!-- 🧩 Sección de características -->
<section class="page-section bg-primary" id="features">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5">
      <div class="col-lg-6 text-center">
        <h2 class="text-white mt-0">Erabiltzaileentzat</h2>
        <ul class="list-unstyled text-white-75">
          <li>Alta azkarra eta erraza</li>
          <li>Bidaien programazioa</li>
          <li>Historialaren kontsulta</li>
        </ul>
      </div>
      <div class="col-lg-6 text-center">
        <h2 class="text-white mt-0">Gidarientzat</h2>
        <ul class="list-unstyled text-white-75">
          <li>Bidaien egoera kontsultatu</li>
          <li>Bidaia aktibatu edo amaitu</li>
          <li>Historiala ikusi eta kudeatu</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- 📌 Pie de página -->
<footer class="bg-light py-5">
  <div class="container px-4 px-lg-5">
    <div class="small text-center text-muted">© 2025 alaikToMUGI - Taxi Zerbitzuak. Eskubide guztiak erreserbatuta.</div>
  </div>
</footer>

<!-- 📜 Scripts -->
<script src="Creative/js/scripts.js"></script>
</body>
</html>
