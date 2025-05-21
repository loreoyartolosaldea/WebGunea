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

            $mezua = "";

            // Bidaia bat bertan behera utzi nahi badu erabiltzaileak
            if (isset($_POST['cancelar']) && isset($_POST['bidaia_id'])) 
            {
                $bidaiaId = $_POST['bidaia_id'];

                // Egiaztatu bidaia erabiltzailearen jabetzakoa dela eta egoera programatuta edo unekoa dela
                $stmt = $pdo->prepare
                ("
                    UPDATE Bidaia 
                    SET egoera = 'bertan behera' 
                    WHERE Bidaia_id = ? 
                    AND Erabiltzaile_NAN = ? 
                    AND egoera IN ('programatuta', 'unekoa')
                ");
                $stmt->execute([$bidaiaId, $erabiltzaileNan]);

                if ($stmt->rowCount() > 0) 
                {
                    $mezua = "<div class='alert alert-success text-center'>Bidaia bertan behera utzi da.</div>";
                } else 
                {
                    $mezua = "<div class='alert alert-warning text-center'>Ezin izan da bidaia bertan behera utzi. Seguru zure bidaia eta egoera zuzena direla.</div>";
                }
            }

            // Eguneratu bidaien egoera 'eginda' egoerara, denbora pasa bada eta erabiltzaile horrek baditu bidaiak
            $updateStmt = $pdo->prepare
            ("
                UPDATE Bidaia
                SET Egoera = 'eginda'
                WHERE Egoera IN ('programatuta', 'unekoa', 'bidean')
                AND TIMESTAMP(Data, Ordua) < NOW()
                AND Erabiltzaile_NAN = ?
            ");
            $updateStmt->execute([$erabiltzaileNan]);

            // Lortu erabiltzailearen bidaia guztiak, data eta orduaren arabera jaitsi ordenean
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

                <!-- Mezuak erakutsi -->
                <?= $mezua ?>

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
                                <th>Ekintzak</th> <!-- Botonak hemen -->
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
                                    <td>
                                        <?php if (in_array($bidaia['egoera'], ['programatuta', 'unekoa'])): ?>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="bidaia_id" value="<?= htmlspecialchars($bidaia['Bidaia_id']) ?>">
                                                <button type="submit" name="cancelar" class="btn btn-danger btn-sm" onclick="return confirm('Ziur zaude bidaia hau bertan behera utzi nahi duzula?');">
                                                    Bertan behera utzi
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-muted">Ez dago aukerarik</span>
                                        <?php endif; ?>
                                    </td>
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
