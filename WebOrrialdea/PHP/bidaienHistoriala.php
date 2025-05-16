<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Bidaien Historiala</title>

        <!-- Bootstrap estiloak -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!--Estilo pertsonalizatua -->
        <link rel="stylesheet" href="../Estiloa/historiala.css">
    </head>
    <body>
        <?php
            // Datu basearekin konektatu eta saioa hasi
            require_once '../DatuBasea/konexioa.php';
            session_start();

            // Erabiltzailearen NAN saioan dagoela ziurtatu, bestela login-era bidali
            if (!isset($_SESSION['erabiltzaile_nan'])) 
            {
                header("Location: ../PHP/saioaErabiltzailea.php");
                exit;
            }

            // Saioaren NAN hartu
            $erabiltzaileNan = $_SESSION['erabiltzaile_nan'];

            // Erabiltzailearen bidaiak lortu, data eta orduaren arabera ordenatuta, berrienak lehenengo
            $adierazpena = $pdo->prepare("SELECT * FROM Bidaia WHERE Erabiltzaile_NAN = ? ORDER BY Data DESC, ordua DESC");
            $adierazpena->execute([$erabiltzaileNan]);
            $bidaiaGuztiak = $adierazpena->fetchAll();
        ?>

        <div class="container mt-5">
            <div class="card shadow-lg">
                <!-- Goiburua -->
                <div class="card-header text-center">
                    <h3 class="mb-0">🧾 Zure Bidaien Historiala</h3>
                </div>

                <!-- Edukia -->
                <div class="card-body">
                    <?php if (count($bidaiaGuztiak) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Data</th>
                                        <th>Ordua</th>
                                        <th>Egoera</th>
                                        <th>Hasiera</th>
                                        <th>Helmuga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        // Bidai bakoitzeko errenkada
                                        foreach ($bidaiaGuztiak as $bidaia): 
                                            // Bidaiaren data eta ordu konbinatu eta DateTime objektua sortu
                                            $bidaiaDataOrdua = DateTime::createFromFormat('Y-m-d H:i:s', $bidaia['Data'] . ' ' . $bidaia['ordua']);
                                            $gaurkoOrdua = new DateTime();

                                            // Egoera lortu eta balioa eguneratu baldintza baten arabera
                                            $egoera = $bidaia['egoera'];
                                            // Egoera programatua edo bidean badago baina data ordu haunditu bada, egoera "Eginda" jarri
                                            if (in_array(strtolower($egoera), ['programatuta', 'bidean']) && $bidaiaDataOrdua < $gaurkoOrdua) 
                                            {
                                                $egoera = 'Eginda';
                                            }
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($bidaia['Data']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['ordua']) ?></td>
                                        <td><?= htmlspecialchars($egoera) ?></td>
                                        <td><?= htmlspecialchars($bidaia['hasiera']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['helmuga']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <!-- Ez bada bidairik, alerta mezua -->
                        <div class="alert alert-warning text-center">
                            Ez duzu oraindik bidaiarik egin.
                        </div>
                    <?php endif; ?>

                    <!-- Itzuli hasierara botoia -->
                    <div class="text-center mt-4">
                        <a href="../index.php" class="btn btn-outline-primary">⬅ Itzuli hasierara</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
