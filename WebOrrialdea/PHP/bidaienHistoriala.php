<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Bidaien Historiala</title>

        <!-- Bootstrap estiloa -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Estilo pertsonalizatua -->
        <link rel="stylesheet" href="../Estiloa/historiala.css">
    </head>
    <body>
        <?php
            require_once '../DatuBaseaKonexioa/konexioa.php';
            session_start();

            // Saioa hasi dela egiaztatu
            if (!isset($_SESSION['erabiltzaile_nan'])) 
            {
                // Saioa hasi gabe badago, login orrira bideratu
                header("Location: ../PHP/saioaErabiltzailea.php");
                exit;
            }

            // Saioan dagoen erabiltzailearen NAN hartu
            $erabiltzaileNan = $_SESSION['erabiltzaile_nan'];

            // ============================================
            // 1. Eguneratu bidaien egoera 'eginda' egoerara, 
            //    denbora pasa bada eta erabiltzaile horrek baditu bidaiak
            // ============================================
           $updateStmt = $pdo->prepare
           ("
                UPDATE Bidaia
                SET Egoera = 'eginda'
                WHERE Egoera IN ('programatuta', 'unekoa', 'bidean')
                AND TIMESTAMP(Data, Ordua) < NOW()
                AND Erabiltzaile_NAN = ?
            ");
            $updateStmt->execute([$erabiltzaileNan]);


            $updateStmt->execute([$erabiltzaileNan]);

            // ============================================
            // 3. Lortu erabiltzailearen bidaia guztiak, data eta orduaren arabera jaitsi ordenean
            // ============================================
            $adierazpena = $pdo->prepare
            ("
                SELECT * FROM Bidaia 
                WHERE Erabiltzaile_NAN = ? 
                ORDER BY Data DESC, Ordua DESC
            ");
            $adierazpena->execute([$erabiltzaileNan]);
            $bidaiaGuztiak = $adierazpena->fetchAll();
        ?>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h3 class="mb-0">Zure Bidaien Historiala</h3>
            </div>
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
                                <?php foreach ($bidaiaGuztiak as $bidaia): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($bidaia['Data']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['ordua']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['egoera']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['hasiera']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['helmuga']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        Ez duzu oraindik bidaiarik egin.
                    </div>
                <?php endif; ?>

                <div class="text-center mt-4">
                    <a href="../index.php" class="btn btn-outline-primary">Itzuli hasierara</a>
                </div>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
