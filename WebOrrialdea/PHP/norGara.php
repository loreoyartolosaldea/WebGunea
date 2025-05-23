<?php
    session_start();
    $izena      =       $_SESSION['izena'] ?? null;  
    $rola       =       $_SESSION['rola'] ?? null; 
?>

<!DOCTYPE html>
<html lang="eu">
  <head>
      <meta charset="UTF-8" />
      <title>Nor gara - alaiktoMUGI</title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="../Estiloa/menuaNorGara.css">
  </head>

  <body id="page-top">

    <!-- Nabigazio barra -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="#page-top">alaiktoMUGI</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Menua zabaldu/itzali">
          Menua
          <i class="fas fa-bars ms-1"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto">
            <?php if ($izena): ?>
              <li class="nav-item"><a class="nav-link" href="#">👋 Kaixo, <?= htmlspecialchars($izena) ?>!</a></li>

              <?php if ($rola === 'erabiltzailea'): ?>
                <li class="nav-item"><a class="nav-link" href="../PHP/bidaiaSortu.php">Bidaia programatu</a></li>
                <li class="nav-item"><a class="nav-link" href="../PHP/bidaienHistoriala.php">Nire bidaiak</a></li>
              <?php elseif ($rola === 'gidaria'): ?>
                <li class="nav-item"><a class="nav-link" href="../PHP/gidariaBidaienKudeaketa.php">Bidaien kudeaketa</a></li>
                <li class="nav-item"><a class="nav-link" href="../PHP/gidariBidaiakHistoriala.php">Bidaien historiala</a></li>
              <?php endif; ?>

              <li class="nav-item"><a class="nav-link" href="../PHP/saioaItxi.php">Saioa itxi</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="../PHP/erregistroaErabiltzailea.php">Erabiltzailearen erregistroa</a></li>
              <li class="nav-item"><a class="nav-link" href="../PHP/saioaErabiltzailea.php">Erabiltzailearen saioa hasi</a></li>
              <li class="nav-item"><a class="nav-link" href="../PHP/saioaGidaria.php">Gidariaren saioa hasi</a></li>
              <li class="nav-item"><a class="nav-link" href="../PHP/gidariErregistroa.php">Gidariaren erregistroa</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Goiburua (hasiera irudia edo hutsa) -->
    <header class="masthead"></header>

    <!-- Eduki nagusia -->
    <div class="empresa-section">

      <h1 class="empresa-title">alaiktoMUGI <span class="highlight">Enpresa</span></h1>

      <!-- Historia atala -->
      <section class="empresa-history mb-5">
        <h2 class="section-title">Gure Historia</h2>
        <p>alaiktoMUGI 2018an sortu zen, Donostian, taxi-zerbitzu tradizionalak modernizatzeko helburuarekin. Sortzaileek teknologia berrietan oinarritutako aplikazio bat garatu zuten, erabiltzaileei taxi bat azkar eta erraz eskatzeko aukera ematen ziena.</p>
        <p>Hasieran, tokiko taxi-gidarien laguntzarekin jardun zuen. Baina 2021ean, Uber Gipuzkoan sartzeko interesa agertu zuenean, alaiktoMUGIk bere jarduera hedatu zuen gidari autonomoekin lan eginez. Arrakasta nagusia MUGI sistemarekin integratzean lortu zuen, garraio publikoaren eta taxi pribatuaren arteko konbinazio erosoa eskainiz.</p>
        <p>2025ean, alaiktoMUGI Gipuzkoako taxi-merkatuan lidertzat hartu zen, tokiko gidariei aukera berriak emanez eta erabiltzaileei zerbitzu azkar eta fidagarria eskainiz. Bere aplikazioak adimen artifiziala erabiltzen du eskaerak optimizatzeko eta esperientzia pertsonalizatua eskaintzeko.</p>
        <p>Gaur egun, <strong>21 langile</strong> gara alaiktoMUGIn.</p>
      </section>

      <!-- Espezializazio atala -->
      <section class="empresa-specialist mb-5">
        <h2 class="section-title">Taxi Arinen Espezialista</h2>
        <p><span class="highlight">alaiktoMUGI</span> Gipuzkoan taxi-zerbitzuen liderra da, bai mugikorreko aplikazio bidez, bai webgunearen bidez taxiak eskatzeko gaitasunagatik. Gainera, <strong>MUGI sistemarekin</strong> integratuta dago.</p>
        <p>2025ean <em>Araba, Bizkaia eta Nafarroara zabaltzeko asmoa</em> du.</p>
      </section>

      <!-- Lankideak atala -->
      <section class="empresa-partners">
        <h2 class="section-title">Gure Lankideak</h2>
        <ul>
          <li><strong>MUGI Garraio Sistema:</strong> Taxi eta garraio publikoa erraz konbinatzeko aukera eskaintzen du, sistema bakarrean integratuta.</li>
          <li><strong>Gidari Independenteen Elkartea:</strong> Gidari autonomoek bezeroak aurki ditzakete alaiktoMUGI plataformaren bidez.</li>
          <li><strong>Gipuzkoako Ostalaritza Federazioa:</strong> Hotelekin, jatetxeekin eta sagardotegiekin hitzarmenak ditu, garraio azkar eta fidagarria eskaintzeko.</li>
          <li><strong>Teknologia Startup-ak:</strong> AI eta datuen azterketa erabiltzen duten enpresekin elkarlanean aritzen da, zerbitzua hobetzeko.</li>
          <li><strong>Energia Berdearen Hornitzaileak:</strong> Flota elektrifikatzeko eta ingurumen-inpaktua gutxitzeko konpromisoa hartu du.</li>
        </ul>
      </section>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
