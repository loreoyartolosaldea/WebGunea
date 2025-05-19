<?php
    session_start();
    $izena = $_SESSION['izena'] ?? null;
    $rola = $_SESSION['rola'] ?? null;
?>

<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8" />
        <title>Kokapena - alaiktoMUGI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            body 
            {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f8f9fa;
                color: #333;
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
            .container-location 
            {
                max-width: 900px;
                margin: 4rem auto;
                background: white;
                padding: 2rem;
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0,0,0,0.1);
                text-align: center;
            }
            h1 
            {
                font-family: 'Montserrat', sans-serif;
                font-weight: 900;
                font-size: 2.8rem;
                color: #222;
                margin-bottom: 1.5rem;
                text-transform: uppercase;
                letter-spacing: 2px;
            }
            p.description 
            {
                font-size: 1.2rem;
                line-height: 1.7;
                margin-bottom: 2rem;
                color: #444;
            }
            iframe 
            {
                width: 100%;
                height: 450px;
                border: 0;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }
            @media (max-width: 600px) 
            {
                h1 
                {
                    font-size: 2rem;
                }
                p.description 
                {
                    font-size: 1rem;
                }
                iframe 
                {
                    height: 300px;
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
            <li class="nav-item"><a class="nav-link" href="./PHP/norGara.php">Nor gara</a></li>
            <?php endif; ?>
        </ul>
        </div>
    </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-location">
    <h1>Kokapena</h1>
    <p class="description">
        AlaiktoMUGI-ren bulegoa Donostian kokatuta dago, erabiltzaileei zerbitzu azkar eta fidagarri bat eskaintzeko.
        Hemen ikus dezakezu gure kokapena zehatza.
    </p>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.0515687037346!2d-1.9862709152940596!3d43.31317989665595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51a50000a812eb%3A0x9fb667b166bb2ccf!2sOficina%20de%20la%20tarjeta%20MUGI!5e0!3m2!1ses!2ses!4v1747655165281!5m2!1ses!2ses" 
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
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
        <p class="mb-0 small">© 2025 alaiktoMUGI. All rights reserved.</p>
    </div>
    </footer>

    <!-- Añadir FontAwesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    </body>
</html>
