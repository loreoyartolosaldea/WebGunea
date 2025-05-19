<?php
    session_start();
    $izena = $_SESSION['izena'] ?? null;  
    $rola = $_SESSION['rola'] ?? null; 
?>

<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8" />
        <title>Kontaktua - alaiktoMUGI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FontAwesome para iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <style>
            body 
            {
                padding-top: 70px;
                background: #f8f9fa;
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
            .contact-section 
            {
                max-width: 700px;
                margin: auto;
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }
            .contact-section h2 
            {
                margin-bottom: 30px;
                font-weight: 700;
                color: #007bff;
                text-align: center;
            }
            .form-control:focus 
            {
                box-shadow: 0 0 8px #007bff;
                border-color: #007bff;
            }
            .btn-primary 
            {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary:hover 
            {
                background-color: #0056b3;
                border-color: #004085;
            }
        </style>
    </head>
    <body id="page-top">

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">alaiktoMUGI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" 
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
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
            <li class="nav-item"><a class="nav-link" href="./PHP/kontaktua.php">Kontaktua</a></li>
            <?php endif; ?>
        </ul>
        </div>
    </div>
    </nav>

    <!-- Sección contacto -->
    <section class="contact-section my-5">
    <h2>Kontaktua</h2>
    <form action="kontaktuarenProzesua.php" method="post">
        <div class="mb-3">
        <label for="name" class="form-label">Izena</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Zure izena" required>
        </div>
        <div class="mb-3">
        <label for="email" class="form-label">Posta elektronikoa</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Zure emaila" required>
        </div>
        <div class="mb-3">
        <label for="message" class="form-label">Mezua</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Zure mezua" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Bidali</button>
    </form>
    </section>

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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
