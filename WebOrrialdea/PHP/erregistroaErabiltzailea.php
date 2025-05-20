<!DOCTYPE html>
<html lang="eu"> <!-- HTML dokumentua euskaraz -->
    <head>
        <meta charset="UTF-8"> <!-- Karaktere-kodeketa UTF-8 -->
        <title>Erregistroa - alaikToMUGI</title> <!-- Nabigatzailearen izenburua -->

        <!-- Bootstrap estiloak (diseinu responsibo eta azkarra egiteko) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Estilo pertsonalizatua (autentifikazioari dagokiona) -->
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            // Datu-basearekin konektatu eta saioa hasi
            require_once '../DatuBaseaKonexioa/konexioa.php';
            session_start();

            $mezuak = ""; // Mezua bistaratuko da errore kasuan

            // POST eskaera jaso denean (hau da, formularioa bidali denean)
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // Formularioan jasotako balioak hartu
                $nan = $_POST['nan'];
                $izena = $_POST['izena'];
                $abizena = $_POST['abizena'];
                $posta = $_POST['posta'];
                $tel = $_POST['tel'];
                $pasahitza = $_POST['pasahitza'];

                // Pasahitza zifratu, segurtasunagatik
                $pasahitzaZifratua = password_hash($pasahitza, PASSWORD_DEFAULT);

                // SQL adierazpena prestatu datuak sartzeko
                $stmt = $pdo->prepare("INSERT INTO Erabiltzailea (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza) VALUES (?, ?, ?, ?, ?, ?)");

                // SQL-a ondo exekutatu bada...
                if ($stmt->execute([$nan, $izena, $abizena, $posta, $tel, $pasahitzaZifratua])) 
                {
                    // Saioa hasi eta sesioan erabiltzailearen datuak gorde
                    $_SESSION['erabiltzaile_nan'] = $nan;
                    $_SESSION['izena'] = $izena;
                    $_SESSION['abizena'] = $abizena;
                    $_SESSION['rola'] = 'erabiltzailea'; // Erabiltzaile mota zehaztu

                    // Hasierako orrira bideratu
                    header("Location: ../index.php");
                    exit;
                } 
                else 
                {
                    // Errorea izanez gero, mezua bistaratuko da
                    $mezuak = "<div class='alert alert-danger text-center'>Errorea: ezin izan da erregistratu.</div>";
                }
            }
        ?>

        <!-- Erregistro-txartela (formularioa kutxa baten barruan) -->
        <div class="card mt-4 mx-auto" style="max-width: 500px;">
            <!-- Goiburua urdinaz -->
            <div class="card-header text-white bg-primary text-center">
                <h4>Erabiltzailearen Erregistroa</h4>
            </div>

            <!-- Gorputza: formularioa -->
            <div class="card-body">
                <?= $mezuak ?> <!-- Errorea bada, hemen bistaratuko da -->

                <form method="post" class="needs-validation" novalidate>
                    <!-- NAN eremua -->
                    <input type="text" class="form-control mb-3" name="nan" placeholder="NAN" required>

                    <!-- Izena -->
                    <input type="text" class="form-control mb-3" name="izena" placeholder="Izena" required>

                    <!-- Abizena -->
                    <input type="text" class="form-control mb-3" name="abizena" placeholder="Abizena" required>

                    <!-- Posta elektronikoa -->
                    <input type="email" class="form-control mb-3" name="posta" placeholder="Posta elektronikoa" required>

                    <!-- Telefono zenbakia -->
                    <input type="text" class="form-control mb-3" name="tel" placeholder="Telefono zenbakia" required>

                    <!-- Pasahitza -->
                    <input type="password" class="form-control mb-3" name="pasahitza" placeholder="Pasahitza" required>

                    <!-- Bidali botoia -->
                    <button type="submit" class="btn btn-warning w-100">Erregistratu</button>
                </form>

                <!-- Hasierara itzultzeko esteka -->
                <div class="buelta mt-4 text-center">
                    <a href="../index.php">Itzuli hasierara</a>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS script-a (moduak eta botoiak funtzionatzeko) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap-en balidazio script-a -->
        <script>
            (() => 
            {
                'use strict';
                // Balidazio script-a automatikoki forma egiaztatzeko
                const forms = document.querySelectorAll('.needs-validation');
                Array.from(forms).forEach(form => 
                {
                    form.addEventListener('submit', event => 
                    {
                        if (!form.checkValidity()) 
                        {
                            event.preventDefault(); // Bidalketa galarazi
                            event.stopPropagation(); // Propagazioa etenda
                        }
                        form.classList.add('was-validated'); // Bootstrap estiloa gehitu
                    }, false);
                });
            })();
        </script>
    </body>
</html>
