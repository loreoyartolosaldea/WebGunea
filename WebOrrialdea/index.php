<!DOCTYPE html>
<html lang="eu">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>alaikToMUGI - Taxi Zerbitzuak</title>

    <!-- Estiloak -->
    <link href="Estiloa/EstiloaIndex.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

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

      #mainNav .nav-link,
      #mainNav .navbar-brand 
      {
        color: #000 !important;
        font-weight: 500;
      }

      .masthead h1,
      .masthead p 
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

      .abisua-kutxa 
      {
        background-color: #fff3cd;
        border-left: 6px solid #ffc107;
        padding: 15px 20px;
        border-radius: 6px;
        margin-top: 20px;
        color: #856404;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        text-align: left;
      }

      .abisua-kutxa ul 
      {
        padding-left: 20px;
        margin-bottom: 0;
      }

      .abisua-kutxa li 
      {
        margin-bottom: 8px;
      }
    </style>
  </head>

  <body id="page-top">

    <?php
      session_start();
      require_once './DatuBaseaKonexioa/konexioa.php';

      $izena = $_SESSION['izena'] ?? null;
      $rola = $_SESSION['rola'] ?? null;
      $nan = $_SESSION['Gidari_nan'] ?? null;
      $abisuak = [];

      if ($rola === 'gidaria' && $nan) 
      {
        $stmt = $pdo->prepare("SELECT Mezua, Sortze_data FROM Abisuak WHERE Gidari_NAN = ? ORDER BY Sortze_data DESC");
        $stmt->execute([$nan]);
        $abisuak = $stmt->fetchAll();
      }
    ?>

    <!-- Nabigazio Barra -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="#page-top">alaikToMUGI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Menua aldatu">
          Menua <i class="fas fa-bars ms-1"></i>
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
              <li class="nav-item"><a class="nav-link" href="./PHP/erregistroaErabiltzailea.php">Erregistroa</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/saioaErabiltzailea.php">Saioa hasi (erabiltzailea)</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/saioaGidaria.php">Saioa hasi (gidaria)</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/gidariErregistroa.php">Erregistroa (gidaria)</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/norGara.php">Nor gara</a></li>
              <li class="nav-item"><a class="nav-link" href="./PHP/kokapena.php">Kokapena</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Goiburua -->
    <header class="masthead">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="text-white">
          <h1 class="font-weight-bold">Bidaiatu erraz eta seguru alaikToMUGI-rekin</h1>
          <hr class="divider" />

          <?php if ($rola === 'gidaria' && count($abisuak) > 0): ?>
            <div class="abisua-kutxa">
              <strong>📢 Abisuak:</strong>
              <ul>
                <?php foreach ($abisuak as $abisua): ?>
                  <li><?= htmlspecialchars($abisua['Mezua']) ?> 
                    <small class="text-muted">(<?= $abisua['Sortze_data'] ?>)</small>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <p class="mt-4 fondoko_esaldia">
            Taxi zerbitzu adimenduna, erabiltzaileentzat eta gidarientzat diseinatua.
          </p>

          <?php if (!$izena): ?>
            <a class="btn btn-primary btn-xl mt-3" href="./PHP/saioaErabiltzailea.php">Erabiltzaile moduan hasi</a>
          <?php endif; ?>
        </div>
      </div>
    </header>

    <!-- Zerbitzu Ezaugarriak -->
    <main>
      <section class="page-section bg-primary py-5" id="features">
        <div class="container">
          <div class="row text-center">
            <div class="col-lg-6">
              <h2 class="text-white mt-0">Erabiltzaileentzat</h2>
              <ul class="list-unstyled text-white-75">
                <li>Alta azkarra eta erraza</li>
                <li>Bidaien programazioa</li>
                <li>Bidaiaren historialaren kontsulta</li>
              </ul>
            </div>
            <div class="col-lg-6">
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
    </main>

    <!-- Footer soziala -->
    <footer class="footer bg-dark text-white py-4 mt-auto">
      <div class="container text-center">
        <div class="mb-3">
          <a href="https://www.facebook.com/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/company/alaiktoMUGI" target="_blank" class="text-white mx-3 fs-4"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <p class="mb-0 small">© 2025 alaikToMUGI - Eskubide guztiak erreserbatuta.</p>
      </div>
    </footer>

    <!-- Script-ak -->
    <script src="Creative/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
