<?php
    session_start();

    // Erabiltzailearen izena eta rola eskuratu saio aldagaien bidez
    $izena          =           $_SESSION['izena'] ?? null;
    $rola           =           $_SESSION['rola'] ?? null;
?>
<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8" />
        <title>Kokapena - alaiktoMUGI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Estilo pertsonalizatua -->
        <link rel="stylesheet" href="../Estiloa/kokapenaEstiloa.css">

        <!-- FontAwesome ikonoak -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </head>
    <body id="page-top">

        <!-- Nabigazio barra -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light shadow-sm" id="mainNav">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#page-top">alaikToMUGI</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                        aria-label="Menua">
                    Menua
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <?php if ($izena): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">👋 Kaixo, <?= htmlspecialchars($izena) ?>!</a>
                            </li>
                            <?php if ($rola === 'erabiltzailea'): ?>
                                <li class="nav-item"><a class="nav-link" href="bidaiaSortu.php">Bidaia Programatu</a></li>
                                <li class="nav-item"><a class="nav-link" href="bidaienHistoriala.php">Nire Bidaiak</a></li>
                            <?php elseif ($rola === 'gidaria'): ?>
                                <li class="nav-item"><a class="nav-link" href="gidariaBidaienKudeaketa.php">Bidaien Kudeaketa</a></li>
                                <li class="nav-item"><a class="nav-link" href="gidariBidaiakHistoriala.php">Bidaien historiala</a></li>
                            <?php endif; ?>
                            <li class="nav-item"><a class="nav-link" href="PHP/saioaItxi.php">Saioa Itxi</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="erregistroaErabiltzailea.php">Erabiltzaile erregistroa</a></li>
                            <li class="nav-item"><a class="nav-link" href="saioaErabiltzailea.php">Erabiltzaile login</a></li>
                            <li class="nav-item"><a class="nav-link" href="saioaGidaria.php">Gidari login</a></li>
                            <li class="nav-item"><a class="nav-link" href="norGara.php">Nor gara</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Eduki nagusia: kokapenaren informazioa -->
        <div class="container-location mt-5 pt-5">
            <h1 class="text-center mb-4">Kokapena</h1>
            <p class="description text-center mb-4">
                AlaiktoMUGI-ren bulegoa Donostian kokatuta dago, erabiltzaileei zerbitzu azkar eta fidagarri bat eskaintzeko.
                Hemen ikus dezakezu gure kokapena zehatza.
            </p>

            <div class="d-flex justify-content-center">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.0515687037346!2d-1.9862709152940596!3d43.31317989665595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51a50000a812eb%3A0x9fb667b166bb2ccf!2sOficina%20de%20la%20tarjeta%20MUGI!5e0!3m2!1ses!2ses!4v1747655165281!5m2!1ses!2ses" 
                    width="90%" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer bg-dark text-white py-4 mt-5">
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
                <p class="mb-0 small">© 2025 alaiktoMUGI. Eskubide guztiak erreserbaturik.</p>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
