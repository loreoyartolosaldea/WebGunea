<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Bidaien Historiala</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estiloa/historiala.css">
    </head>
    <body>

        <?php
            require_once '../DatuBaseaKonexioa/konexioa.php';
            session_start();

            // Saioa hasi dela egiaztatu
            if (!isset($_SESSION['erabiltzaile_nan'])) {
                header("Location: ../PHP/saioaErabiltzailea.php");
                exit;
            }

            $erabiltzaileNan = $_SESSION['erabiltzaile_nan'];
            $mezua = "";

            // Bidaia bertan behera uzteko eskaera
            if (isset($_POST['ezeztatu']) && isset($_POST['bidaia_id'])) {
                $bidaiaId = $_POST['bidaia_id'];

                // Egoera eguneratu
                $stmt = $pdo->prepare("
                    UPDATE Bidaia 
                    SET egoera = 'bertan behera' 
                    WHERE Bidaia_id = ? 
                    AND Erabiltzaile_NAN = ? 
                    AND egoera IN ('programatuta', 'unekoa')
                ");
                $stmt->execute([$bidaiaId, $erabiltzaileNan]);

                if ($stmt->rowCount() > 0) {
                    // Gidariari abisua bidali
                    $stmtGidari = $pdo->prepare("
                        SELECT Gidari_NAN 
                        FROM Bidaia 
                        WHERE Bidaia_id = ? AND Erabiltzaile_NAN = ?
                    ");
                    $stmtGidari->execute([$bidaiaId, $erabiltzaileNan]);
                    $gidariDatuak = $stmtGidari->fetch();

                    if ($gidariDatuak && $gidariDatuak['Gidari_NAN']) {
                        $abisuMezua = "Erabiltzaile batek bidaia (ID: $bidaiaId) bertan behera utzi du.";
                        $abisuaStmt = $pdo->prepare("
                            INSERT INTO Abisuak (Gidari_nan, Mezua, Ikusita) 
                            VALUES (?, ?, 0)
                        ");
                        $abisuaStmt->execute([$gidariDatuak['Gidari_NAN'], $abisuMezua]);
                    }

                    $mezua = "<div class='alert alert-success text-center'>Bidaia bertan behera utzi da.</div>";
                } else {
                    $mezua = "<div class='alert alert-warning text-center'>Ezin izan da bidaia bertan behera utzi. Ziurtatu zure bidaia eta egoera zuzenak direla.</div>";
                }
            }

            // Eguneratu igarotako bidaiak egoera "eginda" bezala
            $updateStmt = $pdo->prepare("
                UPDATE Bidaia
                SET Egoera = 'eginda'
                WHERE Egoera IN ('programatuta', 'unekoa', 'bidean')
                AND TIMESTAMP(Data, Hasiera_ordua) < NOW()
                AND Erabiltzaile_NAN = ?
            ");
            $updateStmt->execute([$erabiltzaileNan]);

            // Erabiltzailearen bidaiak eskuratu
            $adierazpena = $pdo->prepare("
                SELECT * FROM Bidaia 
                WHERE Erabiltzaile_NAN = ? 
                ORDER BY Data DESC, Hasiera_ordua DESC
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

                <?= $mezua ?>

                <?php if (count($bidaiaGuztiak) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered text-center align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Data</th>
                                <th>Hasiera_ordua</th>
                                <th>Egoera</th>
                                <th>Hasiera</th>
                                <th>Helmuga</th>
                                <th>Ekintzak</th>
                                <th>Amaiera_ordua</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($bidaiaGuztiak as $bidaia): ?>
                                <tr>
                                    <td><?= htmlspecialchars($bidaia['Data']) ?></td>
                                    <td><?= htmlspecialchars($bidaia['Hasiera_ordua']) ?></td>
                                    <td><?= htmlspecialchars($bidaia['Egoera']) ?></td>
                                    <td><?= htmlspecialchars($bidaia['Hasiera']) ?></td>
                                    <td><?= htmlspecialchars($bidaia['Helmuga']) ?></td>
                                    <td>
                                        <?php if (in_array($bidaia['Egoera'], ['programatuta', 'unekoa'])): ?>
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
