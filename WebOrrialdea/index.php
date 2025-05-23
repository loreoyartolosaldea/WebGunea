<!DOCTYPE html>
<html lang="eu">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>alaikToMUGI - Taxi Zerbitzuak</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />

        <style>
      /* Orriaren gorputzerako estilo orokorrak */
      body 
      {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background-color: #f8f9fa; /* Atzeko plano argia */
      }

      /* Goiburuko nagusiaren (masthead) estiloak */
      header.masthead 
      {
        /* Gradientearekin eta atzeko planoko irudiarekin. Irudiaren esteka: Argazkia/taxi.jpg */
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('Argazkia/taxi.jpg') no-repeat center center;
        background-size: cover; /* Irudia edukiontzia bete dezan */
        height: 100vh; /* Leihoaren altuera osoa */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
      }

      /* Goiburuko nagusiko lehen mailako izenbururako estiloak */
      header.masthead h1 
      {
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7); /* Testuaren itzala */
      }

      /* Goiburuko nagusiko paragrafoetarako estiloak */
      header.masthead p 
      {
        font-size: 1.5rem;
        max-width: 700px;
        margin: 0 auto 3rem;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6); /* Testuaren itzala */
      }

      /* Nabigazio barraren estiloak */
      .navbar {
        background-color: rgba(255, 255, 255, 0.8); /* Nabigazio barraren hondo erdi-gardena */
        backdrop-filter: blur(5px); /* Atzeko plano lausotua */
        -webkit-backdrop-filter: blur(5px); /* Safari-rako */
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Itzala */
        transition: background-color 0.3s ease; /* Trantsizio leuna */
      }

      /* Nabigazio barneko estekak eta marka estiloak */
      .navbar .nav-link,
      .navbar .navbar-brand {
        color: #343a40 !important; /* Esteken kolore iluna */
        font-weight: 600;
      }

      /* Nabigazio barneko estekak gainean jartzean (hover) estiloak */
      .navbar .nav-link:hover {
        color: #007bff !important; /* Kolore urdina */
      }

      /* Nabigazio barraren toogler botoiaren estiloak (mugikorretan) */
      .navbar-toggler {
        border-color: rgba(0, 0, 0, 0.1);
      }

      /* Nabigazio barraren toogler ikonoaren estiloak */
      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      /* Botoi nagusien estiloak */
      .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.8rem 2rem;
        font-size: 1.1rem;
        border-radius: 0.3rem;
        transition: all 0.3s ease;
      }

      /* Botoi nagusien gainean jartzean (hover) estiloak */
      .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px); /* Apur bat gora mugitzen da */
      }

      /* Orrialde sekzioen estilo orokorrak */
      .page-section {
        padding: 6rem 0;
      }

      /* Bootstrap-eko kolore nagusia */
      .bg-primary {
        background-color: #007bff !important;
      }

      /* Testu zuri gardena */
      .text-white-75 {
        color: rgba(255, 255, 255, 0.75) !important;
      }

      /* Ezaugarri kutxaren estiloak */
      .feature-box {
        background-color: #ffffff;
        border-radius: 0.5rem;
        padding: 2rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Itzala */
        text-align: center;
        margin-bottom: 2rem;
        transition: transform 0.3s ease-in-out; /* Trantsizio animatua */
      }

      /* Ezaugarri kutxaren gainean jartzean (hover) estiloak */
      .feature-box:hover {
        transform: translateY(-5px); /* Apur bat gora mugitzen da */
      }

      /* Ezaugarri kutxako h3 izenburuen estiloak */
      .feature-box h3 {
        color: #343a40;
        margin-bottom: 1rem;
      }

      /* Ezaugarri kutxako ikonoen estiloak */
      .feature-box i {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 1rem;
      }

      /* Oin-orriaren estiloak */
      .footer {
        background-color: #343a40 !important; /* Oin-orri iluna */
      }

      /* Sare sozialen ikonoen esteken estiloak */
      .social-icons a {
        font-size: 1.8rem;
        margin: 0 1rem;
        color: #ffffff;
        transition: color 0.3s ease;
      }

      /* Sare sozialen ikonoen estekak gainean jartzean (hover) estiloak */
      .social-icons a:hover {
        color: #007bff;
      }

      /* "Zergatik Aukeratu Gu" ataleko estiloak */
      .why-choose-us .col-lg-3 {
        margin-bottom: 2rem;
      }
      .why-choose-us .icon-box {
        text-align: center;
        padding: 1.5rem;
        background-color: #f8f9fa; /* Atzeko plano desberdina */
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05); /* Itzala */
        height: 100%; /* Kutxa guztiek altuera berdina izan dezaten */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      .why-choose-us .icon-box i {
        font-size: 4rem;
        color: #28a745; /* Ikonoetarako kolore berdea */
        margin-bottom: 1rem;
      }
      .why-choose-us .icon-box h4 {
        color: #343a40;
        margin-bottom: 0.5rem;
      }
      .why-choose-us .icon-box p {
        color: #6c757d;
        font-size: 0.95rem;
      }

      /* "Gure Lorpenak" ataleko estiloak */
      .our-achievements {
        /* Atzeko plano iluna, irudi batekin. Irudiaren esteka: Argazkia/city_night.jpg */
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('Argazkia/city_night.jpg') no-repeat center center;
        background-size: cover;
        color: white;
      }
      .our-achievements .achievement-item {
        text-align: center;
        padding: 1.5rem;
        margin-bottom: 2rem; /* Mugikorretarako tartea */
      }
      .our-achievements .achievement-item h2 {
        font-size: 3.5rem; /* Zenbakientzako tamaina handia */
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #ffc107; /* Kontraste kolorea, Bootstrap-eko horia */
      }
      .our-achievements .achievement-item p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.85);
      }

      /* Abisu kutxaren estiloak */
      .abisua-kutxa {
        background-color: #fff3cd;
        border-left: 6px solid #ffc107;
        padding: 15px 20px;
        border-radius: 6px;
        margin-top: 20px;
        color: #856404;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        text-align: left;
      }

      /* Abisu kutxako zerrenden estiloak */
      .abisua-kutxa ul {
        padding-left: 20px;
        margin-bottom: 0;
      }

      /* Abisu kutxako zerrenda elementuen estiloak */
      .abisua-kutxa li {
        margin-bottom: 8px;
      }
    </style>
  </head>

  <body id="page-top">
    <?php
      // Saioa hasten du. Honek, erabiltzailearen datuak (izena, rola) saioan zehar gordetzeko aukera ematen du.
      // session_start() deia behin bakarrik egin behar da orri bakoitzeko,
      // goian dagoena nahikoa da.
      session_start();

      // 'izena' eta 'rola' aldagaiak saioan definituta dauden egiaztatzen du.
      // Ez badaude definituta, 'null' balioa esleitzen die erroreak saihesteko.
      $izena = $_SESSION['izena'] ?? null;
      $rola = $_SESSION['rola'] ?? null;

      // 'test' saio aldagaia existitzen den egiaztatzen du.
      // Existitzen ez bada, sortu eta "Saioa behar bezala hasi da." mezua erakusten du.
      // Existitzen bada, "Saio iraunkorra detektatu da." mezua erakusten du.
      if (!isset($_SESSION['test'])) {
          $_SESSION['test'] = 'ok';
          echo "Saioa behar bezala hasi da.";
      } else {
          echo "Saio iraunkorra detektatu da.";
      }
    ?>

        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top">alaikToMUGI</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Menua aldatu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto my-2 my-lg-0">
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

        <header class="masthead">
      <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 align-items-center justify-content-center">
          <div class="col-lg-10">
            <h1 class="font-weight-bold text-white mb-4">Bidaiatu erraz eta seguru alaikToMUGI-rekin</h1>
            <p class="lead mb-5">
              Taxi zerbitzu adimenduna, erabiltzaileentzat eta gidarientzat diseinatua, zure mugikortasuna eraldatzeko.
            </p>
            <?php if (!$izena): ?>
              <a class="btn btn-primary btn-lg mt-3" href="./PHP/saioaErabiltzailea.php">Hasi Bidaia Bat Orain</a>
            <?php endif; ?>
          </div>
          </div>
      </div>
    </header>

    <section class="page-section" id="features">
      <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0 mb-5">Gure Zerbitzuaren Abantailak</h2>
        <div class="row gx-4 gx-lg-5">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-box">
              <i class="fas fa-user mb-3"></i>
              <h3>Erabiltzaileentzako Erraztasuna</h3>
              <p class="text-muted">Bidaiak programatu, historialak kontsultatu eta zure taxia erraz eskatu, edonondik eta edonoiz.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-box">
              <i class="fas fa-car mb-3"></i>
              <h3>Gidarientzako Kudeaketa Aurreratua</h3>
              <p class="text-muted">Bidaien egoera ikusi, bidaiak aktibatu edo amaitu, eta zure historial osoa erraz kudeatu.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-box">
              <i class="fas fa-mobile-alt mb-3"></i>
              <h3>Plataforma Erabat Integrala</h3>
              <p class="text-muted">Konexio azkar, erraz eta segurua eskaintzen dugu erabiltzaileen eta gidarien artean, mugikortasuna hobetuz.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="page-section bg-light why-choose-us" id="why-us">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0 mb-5">Zergatik Aukeratu alaikToMUGI?</h2>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="icon-box">
                        <i class="fas fa-shield-alt mb-3"></i>
                        <h4>Segurtasuna Lehenik</h4>
                        <p class="text-muted">Gure gidari guztiak zorrotz egiaztatuta daude, zure bidaia segurua izan dadin.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="icon-box">
                        <i class="fas fa-money-bill-wave mb-3"></i>
                        <h4>Prezio Gardenak</h4>
                        <p class="text-muted">Ez dago ezkutuko kosturik. Ikusi beti prezio estimatua erreserbatu aurretik.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="icon-box">
                        <i class="fas fa-clock mb-3"></i>
                        <h4>Eskuragarri 24/7</h4>
                        <p class="text-muted">Edozein unetan, eguneko edozein ordutan, taxi bat zure zain izango duzu.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="icon-box">
                        <i class="fas fa-map-marked-alt mb-3"></i>
                        <h4>Bidaiaren Jarraipena</h4>
                        <p class="text-muted">Jarraitu zure taxia denbora errealean mapan, jaso arte.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section our-achievements" id="achievements">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-5 text-white">Gure Lorpenak</h2>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6 achievement-item">
                    <h2>5000+</h2>
                    <p>Bidaia Burutu</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 achievement-item">
                    <h2>100+</h2>
                    <p>Gidari Erregistratu</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 achievement-item">
                    <h2>15000+</h2>
                    <p>Kilometro Eginda</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 achievement-item">
                    <h2>4.9 <i class="fas fa-star" style="font-size: 2rem;"></i></h2>
                    <p>Batez Besteko Balorazioa</p>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section bg-primary text-white">
      <div class="container px-4 px-lg-5 text-center">
        <h2 class="mb-4">Listo zaude zure lehen bidaia egiteko?</h2>
        <p class="lead mb-5">Eman izena orain eta hasi bidaiatzen modu adimendunean eta seguruan gurekin!</p>
        <?php if (!$izena): ?>
          <a class="btn btn-light btn-xl" href="./PHP/erregistroaErabiltzailea.php">Erregistratu Orain!</a>
        <?php endif; ?>
      </div>
    </section>

    <footer class="footer py-5">
      <div class="container text-center">
        <div class="social-icons mb-4">
          <a href="https://www.facebook.com/alaiktoMUGI" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/alaiktoMUGI" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/alaiktoMUGI" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/company/alaiktoMUGI" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <p class="mb-0 small text-white-50">© 2025 alaikToMUGI - Eskubide guztiak erreserbatuta.</p>
      </div>
    </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcOdihvfOQ7pNnNq+1uI" crossorigin="anonymous"></script>
  </body>
</html>