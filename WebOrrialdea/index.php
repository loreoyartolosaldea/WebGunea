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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Estiloa/estiloaOrokorra.css">

  <style>
    body {
      background-image: url('Argazkia/taxi.jpg'); /* Aquí pon la ruta correcta */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white">
  <div class="container">
    <a class="navbar-brand" href="#">alaikToMUGI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if ($izena): ?>
          <li class="nav-item"><span class="nav-link">👋 Kaixo, <?= htmlspecialchars($izena) ?>!</span></li>

          <?php if ($rola === 'erabiltzailea'): ?>
            <li class="nav-item"><a class="nav-link" href="PHP/bidaiaSortu.php">Bidaia Programatu</a></li>
            <li class="nav-item"><a class="nav-link" href="PHP/bidaienHistoriala.php">Nire Bidaiak</a></li>
          <?php elseif ($rola === 'gidaria'): ?>
            <li class="nav-item"><a class="nav-link" href="PHP/gidariaBidaienKudeaketa.php">Bidaien Kudeaketa</a></li>
            <li class="nav-item"><a class="nav-link" href="PHP/gidariBidaiakHistoriala.php">Bidaien historiala</a></li>
          <?php endif; ?>

          <li class="nav-item"><a class="nav-link" href="PHP/saioaItxi.php">Saioa Itxi</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="PHP/erregistroaErabiltzailea.php">Erabiltzaile erregistroa</a></li>
          <li class="nav-item"><a class="nav-link" href="PHP/saioaErabiltzailea.php">Erabiltzaile login</a></li>
          <li class="nav-item"><a class="nav-link" href="PHP/saioaGidaria.php">Gidari login</a></li>
          <li class="nav-item"><a class="nav-link" href="PHP/gidariErregistroa.php">Gidari erregistroa</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <h2>Bidaiatu erraz eta seguru alaikToMUGI-rekin</h2>
    <p>Taxi zerbitzu adimenduna, erabiltzaileentzat eta gidarientzat diseinatua.</p>
    <?php if (!$izena): ?>
      <a href="PHP/saioaErabiltzailea.php" class="btn btn-warning btn-lg mt-4">Erabiltzaile moduan hasi</a>
    <?php endif; ?>
  </div>
</section>

<section class="features py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="custom-card p-4 bg-white shadow-sm rounded">
          <h4>Erabiltzaileentzat</h4>
          <ul>
            <li>Alta azkarra eta erraza</li>
            <li>Bidaien programazioa</li>
            <li>Historialaren kontsulta</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="custom-card p-4 bg-white shadow-sm rounded">
          <h4>Gidarientzat</h4>
          <ul>
            <li>Bidaien egoera kontsultatu</li>
            <li>Bidaia aktibatu edo amaitu</li>
            <li>Historiala ikusi eta kudeatu</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="text-center py-3 bg-white">
  &copy; 2025 <strong>alaikToMUGI</strong> - Taxi Zerbitzuak. Eskubide guztiak erreserbatuta.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
