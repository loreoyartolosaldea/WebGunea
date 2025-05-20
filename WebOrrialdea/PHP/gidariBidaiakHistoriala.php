<!DOCTYPE html>
<html lang="eu"> <!-- Web orriaren hizkuntza euskara dela adierazten du -->
    <head>
        <meta charset="UTF-8">
        <title>Nire Bidaiak - Gidaria</title> <!-- Nabigatzailearen titulu barran agertuko den testua -->
        <!-- Bootstrap estiloko fitxategia gehitzen da diseinua errazteko -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-light"> <!-- Gorputzaren atalak kolore argia izango du -->
    
        <?php
            session_start(); // Saioa hasten da erabiltzailearen datuak atzitzeko

            // Gidariaren NAN-a ez badago sesioan gordeta, saioa hasi ez dela ulertzen da eta saio-hasierako orrira birbideratzen da
            if (!isset($_SESSION['Gidari_nan'])) 
            {
                header("Location: ../PHP/saioaGidaria.php"); // Saioa hasteko orria
                exit; // Script-a hemen gelditzen da, ez da jarraitzen
            }

            // Datu-basearekiko konexioa kargatzen da
            require_once '../DatuBaseaKonexioa/konexioa.php';

            // Gidariaren NAN-a eskuratzen da sesiotik
            $nan = $_SESSION['Gidari_nan'];

            // Gidari horrek dituen bidaiak eskuratzeko kontsulta prestatzen da
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ?");
            $stmt->execute([$nan]); // Kontsulta exekutatzen da gidariaren NAN-arekin
            $bidaiak = $stmt->fetchAll(); // Emaitzak eskuratzen dira array batean
        ?>

        <div class="container mt-5"> <!-- Bootstrap-en edukiontzia, goitik marjina txiki batekin -->
            <!-- Gidariaren izena erakusten da 'Nire Bidaiak' izenburuaren ondoan -->
            <h2>Nire Bidaiak (<?= htmlspecialchars($_SESSION['izena']) ?>)</h2>

            <!-- Taula bat sortzen da bidaiak zerrendatzeko -->
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark"> <!-- Taularen goiburua (beltza) -->
                    <tr>
                        <th>Data</th>
                        <th>Ordua</th>
                        <th>Hasiera</th>
                        <th>Helmuga</th>
                        <th>Pertsonak</th>
                        <th>Egoera</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Bidai guztiak taulan bistaratzen dira -->
                    <?php foreach ($bidaiak as $bidaia): ?>
                        <tr>
                            <td><?= $bidaia['Data'] ?></td> <!-- Bidaia-data -->
                            <td><?= $bidaia['ordua'] ?></td> <!-- Ordua -->
                            <td><?= $bidaia['hasiera'] ?></td> <!-- Hasiera lekua -->
                            <td><?= $bidaia['helmuga'] ?></td> <!-- Helmuga -->
                            <td><?= $bidaia['pertsona_kopurua'] ?></td> <!-- Zenbat pertsona joango diren -->
                            <td><?= $bidaia['egoera'] ?></td> <!-- Bidaia egoera (adib. aktiboa, bertan behera, burutua...) -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Hasiera orrira bueltatzeko botoia -->
            <a href="../index.php" class="btn btn-secondary mb-3">Hasierara itzuli</a>
        </div>
    </body>
</html>
