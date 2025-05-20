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
    <link href="Estiloa/EstiloaIndex.css" rel="stylesheet">

    <style>
      header.masthead 
      {
        background-image: url('Argazkia/taxi.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        position: relative;
      }

      #mainNav 
      {
        background-color: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
      }

      #mainNav .nav-link 
      {
        color: #000 !important;
        font-weight: 500;
      }

      #mainNav .navbar-brand 
      {
        color: #000 !important;
        font-weight: bold;
      }

      .masthead h1, .masthead p 
      {
        color: white;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
      }

      .divider 
      {
        border-top: 2px solid #fff;
        opacity: 0.6;
        width: 60px;
        margin: 20px auto;
      }

      .fondoko_esaldia 
      {
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 15px 20px;
        border-radius: 10px;
        display: inline-block;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        font-size: 1.2rem;
      }
    </style>
  </head>
  <body id="page-top">

    <!-- Nabigazioa -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="#page-top">alaikToMUGI</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Menua aldatu">
          Menu
          <i class="fas fa-bars ms-1"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto">
            <?php if ($izena): ?>
              <li class="nav-item"><a class="nav-link" href="#">👋 Kaixo, <?= htmlspecialchars($izena) ?>!</a></li>
              <?php if ($rola === 'erabiltzailea'): ?>
                <li class="nav-item"><a class="nav-link" href="./PHP/bidaiaSortu.php">Bidaia programatu</a></li>
                <li class="nav-item"><a class="nav-link" href="./PHP/bidaienHistoriala.php">Nire bidaiak</a></li>
              <?php elseif ($rola === 'gidaria'): ?>
                <li class="nav-item"><a class="nav-link" href="./PHP/gidariaBidaienKudeaketa.php">Bidaien kudeaketa</a></li>
                <li class="nav-item"><a class="nav-link" href="./PHP/gidariBidaiakHistoriala.php">Historiala</a></li>
              <?php endif; ?>
              <li class="nav-item"><a class="nav-link" href="./PHP/saioaItxi.php">Saioa itxi</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="./PHP/erregistroaErabiltzailea.php">Erabiltzailearen erregistroa</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/saioaErabiltzailea.php">Erabiltzailearen saioa hasi</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/saioaGidaria.php">Gidariaren saioa hasi</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/gidariErregistroa.php">Gidariaren erregistroa</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/norGara.php">Nor gara</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/kokapena.php">Kokapena</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Goiburua -->
    <header class="masthead">
      <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
          <div class="col-lg-8 align-self-end">
            <h1 class="font-weight-bold">Bidaiatu erraz eta seguru alaikToMUGI-rekin</h1>
            <hr class="divider" />
          </div>
          <div class="col-lg-8 align-self-baseline">
            <p class="mb-5 fondoko_esaldia">
              Taxi zerbitzu adimenduna, erabiltzaileentzat eta gidarientzat diseinatua.
            </p>

            <?php if (!$izena): ?>
              <a class="btn btn-primary btn-xl" href="./PHP/saioaErabiltzailea.php">Erabiltzaile moduan hasi</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </header>

    <!-- Ezaugarriak -->
    <section class="page-section bg-primary" id="features">
      <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5">
          <div class="col-lg-6 text-center">
            <h2 class="text-white mt-0">Erabiltzaileentzat</h2>
            <ul class="list-unstyled text-white-75">
              <li>Alta azkarra eta erraza</li>
              <li>Bidaien programazioa</li>
              <li>Bidaiaren historialaren kontsulta</li>
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

    <!-- Script-ak -->
    <script src="Creative/js/scripts.js"></script>

    <!-- Footer soziala -->
    <footer class="footer bg-dark text-white py-4 mt-auto">
      <div class="container text-center">
        <div class="mb-3">
          <a href="https://www.facebook.com/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://twitter.com/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4" aria-label="Twitter">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="https://www.instagram.com/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.linkedin.com/company/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4" aria-label="LinkedIn">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
        <p class="mb-0 small">© 2025 alaikToMUGI - Eskubide guztiak erreserbatuta.</p>
      </div>
    </footer>

    <!-- Ikonoak (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  </body>
</html>
