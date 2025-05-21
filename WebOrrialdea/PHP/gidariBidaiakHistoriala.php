<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Nire Bidaiak - Gidaria</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
    <?php
        session_start();
        if (!isset($_SESSION['Gidari_nan'])) 
        {
            header("Location: ../PHP/saioaGidaria.php");
            exit;
        }

        require_once '../DatuBaseaKonexioa/konexioa.php';

        $nan = $_SESSION['Gidari_nan'];

        // Si se ha enviado el formulario para finalizar viaje
        if (isset($_POST['bukatuta']) && isset($_POST['bidaia_id'])) {
            $bidaiaId = $_POST['bidaia_id'];

            // Solo puede finalizar viajes asignados a este conductor y que estén en estado 'unekoa' o 'bidean'
            $updateStmt = $pdo->prepare("UPDATE Bidaia SET Egoera = 'eginda' WHERE Bidaia_id = ? AND Gidari_nan = ? AND Egoera IN ('unekoa', 'bidean')");
            $updateStmt->execute([$bidaiaId, $nan]);

            if ($updateStmt->rowCount() > 0) {
                $mezua = "<div class='alert alert-success'>Bidaia eginda markatu da.</div>";
            } else {
                $mezua = "<div class='alert alert-warning'>Ezin izan da bidaia eginda markatu. Ziurtatu bidaia hau zurea dela eta oraindik ez dela eginda.</div>";
            }
        }

        // Obtener todas las viajes del conductor ordenadas por fecha y hora descendente
        $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ? ORDER BY Data DESC, Hasiera_ordua DESC");
        $stmt->execute([$nan]);
        $bidaiak = $stmt->fetchAll();
    ?>

    <div class="container mt-5">
        <h2>Nire Bidaiak (<?= htmlspecialchars($_SESSION['izena']) ?>)</h2>

        <?= $mezua ?? '' ?>

        <?php if (count($bidaiak) > 0): ?>
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Data</th>
                        <th>Hasiera_ordua</th>
                        <th>Hasiera</th>
                        <th>Helmuga</th>
                        <th>Pertsonak</th>
                        <th>Egoera</th>
                        <th>Ekintza</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bidaiak as $bidaia): ?>
                        <tr>
                            <td><?= htmlspecialchars($bidaia['Data']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Hasiera_ordua']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Hasiera']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Helmuga']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Pertsona_kopurua']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Egoera']) ?></td>
                            <td>
                                <?php if ($bidaia['Egoera'] === 'unekoa' || $bidaia['Egoera'] === 'bidean'): ?>
                                    <form method="post" style="display:inline-block;">
                                        <input type="hidden" name="bidaia_id" value="<?= $bidaia['Bidaia_id'] ?>">
                                        <button type="submit" name="bukatuta" class="btn btn-success btn-sm" onclick="return confirm('Bidaia hau eginda markatu nahi duzu?')">Eginda</button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Eginda</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Ez dago bidairik.</div>
        <?php endif; ?>

        <a href="../index.php" class="btn btn-secondary mb-3">Hasierara itzuli</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
