<?php
session_start();
$izena = $_SESSION['izena'] ?? null;  
$rola = $_SESSION['rola'] ?? null; 
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8" />
    <title>Nor gara - alaiktoMUGI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <style>
    /* Fondo y header */
    header.masthead {
      background-image: url('../Argazkia/taxi.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      position: relative;
    }

    /* Navbar translúcido y borroso */
    #mainNav {
      background-color: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease;
    }
    #mainNav .nav-link {
      color: #000 !important;
      font-weight: 500;
    }
    #mainNav .navbar-brand {
      color: #000 !important;
      font-weight: bold;
    }

    /* Contenido principal */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    .empresa-section {
      max-width: 900px;
      margin: 3rem auto;
      padding: 0 20px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .empresa-title {
      font-size: 3rem;
      font-weight: 900;
      text-align: center;
      margin-bottom: 1.5rem;
      letter-spacing: 2px;
      color: #222;
      text-transform: uppercase;
      font-family: 'Montserrat', sans-serif;
    }

    .highlight {
      color: #007bff;
    }

    .section-title {
      font-size: 2rem;
      font-weight: 700;
      color: #004085;
      border-bottom: 3px solid #007bff;
      padding-bottom: 0.3rem;
      margin-bottom: 1rem;
      font-family: 'Montserrat', sans-serif;
    }

    .empresa-history p,
    .empresa-specialist p {
      font-size: 1.125rem;
      line-height: 1.7;
      margin-bottom: 1rem;
      color: #444;
    }

    .empresa-specialist p em {
      color: #007bff;
      font-style: normal;
      font-weight: 600;
    }

    .empresa-partners ul {
      list-style: none;
      padding-left: 0;
    }

    .empresa-partners li {
      font-size: 1.1rem;
      margin-bottom: 0.75rem;
      padding-left: 1.5rem;
      position: relative;
      color: #333;
    }

    .empresa-partners li::before {
      content: "✔";
      position: absolute;
      left: 0;
      color: #28a745;
      font-weight: bold;
    }

    strong {
      color: #007bff;
    }

    @media (max-width: 600px) {
      .empresa-title {
        font-size: 2.2rem;
      }
      .section-title {
        font-size: 1.5rem;
      }
      .empresa-history p,
      .empresa-specialist p,
      .empresa-partners li {
        font-size: 1rem;
      }
    }
    </style>

</head>
<body id="page-top">

<!-- Navegación -->
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
            <li class="nav-item"><a class="nav-link" href="../PHP/bidaiaSortu.php">Bidaia Programatu</a></li>
            <li class="nav-item"><a class="nav-link" href="../PHP/bidaienHistoriala.php">Nire Bidaiak</a></li>
          <?php elseif ($rola === 'gidaria'): ?>
            <li class="nav-item"><a class="nav-link" href="../PHP/gidariaBidaienKudeaketa.php">Bidaien Kudeaketa</a></li>
            <li class="nav-item"><a class="nav-link" href="../PHP/gidariBidaiakHistoriala.php">Bidaien historiala</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="../PHP/saioaItxi.php">Saioa Itxi</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="../PHP/erregistroaErabiltzailea.php">Erabiltzaile erregistroa</a></li>
          <li class="nav-item"><a class="nav-link" href="../PHP/saioaErabiltzailea.php">Erabiltzaile login</a></li>
          <li class="nav-item"><a class="nav-link" href="../PHP/saioaGidaria.php">Gidari login</a></li>
          <li class="nav-item"><a class="nav-link" href="../PHP/gidariErregistroa.php">Gidari erregistroa</a></li>
          <li class="nav-item"><a class="nav-link" href="../PHP/norGara.php">Nor gara</a></li>
          <li class="nav-item"><a class="nav-link" href="./PHP/kontaktua.php">Kontaktua</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<header class="masthead"></header>

<div class="empresa-section">

  <h1 class="empresa-title">alaiktoMUGI <span class="highlight">Enpresa</span></h1>

  <section class="empresa-history mb-5">
    <h2 class="section-title">Historia</h2>
    <p>2018an sortu zen, Donostian taxi-zerbitzu tradizionalak modernizatzeko asmoz. Bere sortzaileek, teknologia aurreratuaren zaleak, aplikazio bat garatu zuten, erabiltzaileei taxiak erraz eta azkar eskatzeko aukera ematen ziena.</p>
    <p>Hasieran, tokiko taxilariekin elkarlanean aritu ziren, baina 2021ean, Uberrek Gipuzkoan sartzeko interesa erakutsi zuenean, alaiktoMUGIk bere zerbitzuak zabaldu zituen, gidari independenteekin lan eginez. Bere arrakasta MUGI garraio-sistemarekin integratzean etorri zen, erabiltzaileei garraio publikoaren eta taxi pribatuaren arteko konbinazio erosoa eskainiz.</p>
    <p>2025erako, alaiktoMUGI Gipuzkoako taxi-merkatuan lider bihurtu zen, tokiko gidariei aukera berriak eskainiz eta erabiltzaileei zerbitzu azkar eta fidagarria bermatuz. Bere aplikazioak AI teknologia erabiltzen du eskaerak optimizatzeko eta bidaiarientzako esperientzia pertsonalizatua eskaintzeko.</p>
    <p>Gaur egun <strong>21 langilek</strong> osatzen dugu enpresa.</p>
  </section>

  <section class="empresa-specialist mb-5">
    <h2 class="section-title">Taxi Arinen Espezialista</h2>
    <p>Gipuzkoan Taxi zerbitzuan liderra da <span class="highlight">alaiktoMUGI</span>, mugikorretik zein webgunetik taxiak eskatzeko gaitasunaz gain, <strong>MUGI plataformarekin</strong> integratua egoteagatik.</p>
    <p>2025an, <em>Araba, Bizkaia eta Nafarroara irekitzeko asmotan dabil.</em></p>
  </section>

  <section class="empresa-partners">
    <h2 class="section-title">Gure Lankideak</h2>
    <ul>
      <li><strong>MUGI Garraio Sistema:</strong> Gipuzkoako garraio publikoaren sistemarekin integratu da, erabiltzaileek taxiak eta autobusek erraz konbinatu ahal izateko.</li>
      <li><strong>Gidari Independenteen Elkartea:</strong> Gidari autonomoek AlaiktoMUGI plataformaren bidez bezeroak aurkitu eta zerbitzua eskaini dezakete.</li>
      <li><strong>Gipuzkoako Ostalaritza Federazioa:</strong> Hotelekin, sagardotegiekin eta jatetxeekin lankidetza hitzarmenak ditu, bezeroei garraio azkarra eskaintzeko.</li>
      <li><strong>Teknologia Enpresa Startup-ak:</strong> AI eta datuen azterketan espezializatutako enpresekin lan egiten du, bidaiak optimizatzeko eta erabiltzaile-esperientzia hobetzeko.</li>
      <li><strong>Energia Berdearen Hornitzaileak:</strong> Bere flota elektrifikatzeko eta karbono-aztarna txikitzeko konpromisoa du, ingurumenarekin arduratsu jokatuz.</li>
    </ul>
  </section>

</div>

<!-- Bootstrap JS y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
