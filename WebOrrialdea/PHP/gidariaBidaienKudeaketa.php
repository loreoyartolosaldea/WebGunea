<!DOCTYPE html>
    <html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidariaren Bidaiak</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <?php
            session_start();

            if (!isset($_SESSION['gidari_nan'])) 
            {
                echo "<div class='alert alert-danger m-3'>Ezin da NAN eskuratu. Saioa hasi berriro.</div>";
                exit;
            }

            $gidari_nan = $_SESSION['gidari_nan'];
            require_once '../DatuBasea/konexioa.php';

            $mezua = "";

            // Uneko bidaia aktiboa lortu
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE gidari_nan = ? AND egoera = 'unekoa'");
            $stmt->execute([$gidari_nan]);
            $bidai_aktiboa = $stmt->fetch();

            // Programa gabe dauden eta esleitu gabe dauden bidaiak lortu ordenatuta
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND gidari_nan IS NULL ORDER BY Data ASC, Ordua ASC");
            $stmt->execute();
            $bidaiak = $stmt->fetchAll();

            // Aukeraketa prozesua
            if (isset($_POST['aukeratu'])) 
            {
                if (isset($_POST['bidaia_id']) && !empty($_POST['bidaia_id'])) 
                {
                    $hautatutakoId = $_POST['bidaia_id'];

                    // Hautatutako bidaia lortu
                    $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Bidaia_id = ?");
                    $stmt->execute([$hautatutakoId]);
                    $hautatutakoBidaia = $stmt->fetch();

                    if (!$hautatutakoBidaia) 
                    {
                        $mezua = "<div class='alert alert-danger'>Errorea: bidaia ez da existitzen.</div>";
                    } else 
                    {
                        $bidaiOnartuDaiteke = true;

                        // Uneko bidaiarekin gainjartzen bada, ezin da onartu
                        if ($bidai_aktiboa) 
                        {
                            $aktiboData = $bidai_aktiboa['Data'] . ' ' . $bidai_aktiboa['ordua'];
                            $hautatuData = $hautatutakoBidaia['Data'] . ' ' . $hautatutakoBidaia['ordua'];

                            $aktiboDateTime = new DateTime($aktiboData);
                            $hautatuDateTime = new DateTime($hautatuData);

                            if ($aktiboDateTime == $hautatuDateTime) {
                                $bidaiOnartuDaiteke = false;
                            }
                        }

                        if ($bidaiOnartuDaiteke) 
                        {
                            // Esleitu bidaia
                            $stmt = $pdo->prepare("UPDATE Bidaia SET gidari_nan = ?, egoera = 'unekoa' WHERE Bidaia_id = ?");
                            $stmt->execute([$gidari_nan, $hautatutakoId]);

                            $mezua = "<div class='alert alert-success'>Bidaia hartu duzu arrakastaz.</div>";

                            // Datu eguneratuak berriz lortu
                            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND gidari_nan IS NULL ORDER BY Data ASC, Ordua ASC");
                            $stmt->execute();
                            $bidaiak = $stmt->fetchAll();

                            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE gidari_nan = ? AND egoera = 'unekoa'");
                            $stmt->execute([$gidari_nan]);
                            $bidai_aktiboa = $stmt->fetch();
                        } else 
                        {
                            $mezua = "<div class='alert alert-warning'>Ezinezkoa: bidaia hori unean aktibo dagoen bidaiarekin gainjartzen da.</div>";
                        }
                    }
                } else 
                {
                    $mezua = "<div class='alert alert-warning'>Mesedez, aukeratu bidaia bat lehenik.</div>";
                }
            }
        ?>

    <div class="container mt-4">
        <h2 class="mb-4">Programatutako bidaiak (aukeratu nahi duzuna)</h2>

        <?= $mezua ?>

        <?php if ($bidai_aktiboa): ?>
            <div class="alert alert-info">
                <strong>Zure bidaia aktiboa:</strong><br>
                ID: <?= htmlspecialchars($bidai_aktiboa['Bidaia_id']) ?>
                <?= htmlspecialchars($bidai_aktiboa['Data']) ?> <?= htmlspecialchars($bidai_aktiboa['ordua']) ?>
                <?= htmlspecialchars($bidai_aktiboa['hasiera']) ?> → <?= htmlspecialchars($bidai_aktiboa['helmuga']) ?>
            </div>
        <?php endif; ?>

        <?php if (count($bidaiak) > 0): ?>
            <form method="post" class="mb-4" onsubmit="return confirmSelection();">
                <div class="mb-3">
                    <label for="bidaiaSelect" class="form-label">Aukeratu bidaia bat</label>
                    <select name="bidaia_id" id="bidaiaSelect" class="form-select" required>
                        <option value="" disabled selected>-- Aukeratu bidaia bat --</option>
                        <?php foreach ($bidaiak as $b): ?>
                            <option value="<?= htmlspecialchars($b['Bidaia_id']) ?>">
                                ID: <?= htmlspecialchars($b['Bidaia_id']) ?> 
                                <?= htmlspecialchars($b['Data']) ?> <?= htmlspecialchars($b['ordua']) ?>
                                <?= htmlspecialchars($b['hasiera']) ?> → <?= htmlspecialchars($b['helmuga']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="aukeratu" class="btn btn-primary">Hau hartu</button>
            </form>
        <?php else: ?>
            <div class="alert alert-info">Oraindik ez dago bidairik programatuta.</div>
        <?php endif; ?>

        <a href="../index.php" class="btn btn-secondary mb-3">⬅ Hasierara itzuli</a>
    </div>

        <script>
            function confirmSelection() 
            {
                const select = document.getElementById('bidaiaSelect');
                if (select.value === "") 
                {
                    alert('Mesedez, aukeratu bidaia bat lehenik.');
                    return false;
                }
                return true;
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
