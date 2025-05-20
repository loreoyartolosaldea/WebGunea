<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidariaren Bidaiak</title>
        <!-- Bootstrap estiloak -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <?php
            session_start();

            // Gidariaren NAN sesioan dagoen egiaztatu
            if (!isset($_SESSION['Gidari_nan'])) 
            {
                echo "<div class='alert alert-danger m-3'>Ezin da NAN-a eskuratu. Saioa hasi berriro.</div>";
                exit;
            }

            // Gidariaren NAN hartu
            $Gidari_nan = $_SESSION['Gidari_nan'];

            // Datu-basearekin konektatu
            require_once '../DatuBaseaKonexioa/konexioa.php';

            $mezua = "";

            // Gidariak jadanik bidaia aktiboa duen egiaztatu
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ? AND egoera = 'unekoa'");
            $stmt->execute([$Gidari_nan]);
            $bidai_aktiboa = $stmt->fetch();

            // Programatutako eta esleitu gabe dauden bidaiak lortu
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND Gidari_nan IS NULL ORDER BY Data ASC, Ordua ASC");
            $stmt->execute();
            $bidaiak = $stmt->fetchAll();

            // Gidariak bidaia bat aukeratzen badu
            if (isset($_POST['aukeratu'])) 
            {
                // Bidaia ID-a jasota badago
                if (isset($_POST['bidaia_id']) && !empty($_POST['bidaia_id'])) 
                {
                    $hautatutakoId = $_POST['bidaia_id'];

                    // Hautatutako bidaia datu-basean dagoen egiaztatu
                    $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Bidaia_id = ?");
                    $stmt->execute([$hautatutakoId]);
                    $hautatutakoBidaia = $stmt->fetch();

                    if (!$hautatutakoBidaia) 
                    {
                        $mezua = "<div class='alert alert-danger'>Errorea: bidaia ez da existitzen.</div>";
                    } 
                    else 
                    {
                        $bidaiOnartuDaiteke = true;

                        // Bidaia aktiboarekin gainjartzen bada, ezin da hartu
                        if ($bidai_aktiboa) 
                        {
                            $aktiboData = $bidai_aktiboa['Data'] . ' ' . $bidai_aktiboa['ordua'];
                            $hautatuData = $hautatutakoBidaia['Data'] . ' ' . $hautatutakoBidaia['ordua'];

                            $aktiboDateTime = new DateTime($aktiboData);
                            $hautatuDateTime = new DateTime($hautatuData);

                            if ($aktiboDateTime == $hautatuDateTime) 
                            {
                                $bidaiOnartuDaiteke = false;
                            }
                        }

                        // Bidaia onartu daiteke, eguneratu datu-basea
                        if ($bidaiOnartuDaiteke) 
                        {
                            $stmt = $pdo->prepare("UPDATE Bidaia SET Gidari_nan = ?, egoera = 'unekoa' WHERE Bidaia_id = ?");
                            $stmt->execute([$Gidari_nan, $hautatutakoId]);

                            $mezua = "<div class='alert alert-success'>Bidaia hartu duzu arrakastaz.</div>";

                            // Datuak berriz eskuratu eguneratuta
                            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND Gidari_nan IS NULL ORDER BY Data ASC, Ordua ASC");
                            $stmt->execute();
                            $bidaiak = $stmt->fetchAll();

                            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ? AND egoera = 'unekoa'");
                            $stmt->execute([$Gidari_nan]);
                            $bidai_aktiboa = $stmt->fetch();
                        } 
                        else 
                        {
                            $mezua = "<div class='alert alert-warning'>Ezinezkoa: bidaia hori unean aktibo dagoen bidaiarekin gainjartzen da.</div>";
                        }
                    }
                } 
                else 
                {
                    $mezua = "<div class='alert alert-warning'>Mesedez, aukeratu bidaia bat lehenik.</div>";
                }
            }
        ?>

        <div class="container mt-4">
            <h2 class="mb-4">Programatutako bidaiak (aukeratu nahi duzuna)</h2>

            <!-- Erroreak edo mezuak erakutsi -->
            <?= $mezua ?>

            <!-- Gidariak jadanik bidaia aktiboa badu, informazioa erakutsi -->
            <?php if ($bidai_aktiboa): ?>
                <div class="alert alert-info">
                    <strong>Zure bidaia aktiboa:</strong><br>
                    ID: <?= htmlspecialchars($bidai_aktiboa['Bidaia_id']) ?>
                    <?= htmlspecialchars($bidai_aktiboa['Data']) ?> <?= htmlspecialchars($bidai_aktiboa['ordua']) ?>
                    <?= htmlspecialchars($bidai_aktiboa['hasiera']) ?><?= htmlspecialchars($bidai_aktiboa['helmuga']) ?>
                </div>
            <?php endif; ?>

            <!-- Bidaiak badaude, hautatzeko formularioa erakutsi -->
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
                <!-- Ez badaude bidaiarik eskuragarri -->
                <div class="alert alert-info">Oraindik ez dago bidairik programatuta.</div>
            <?php endif; ?>

            <!-- Hasierara bueltatzeko botoia -->
            <a href="../index.php" class="btn btn-secondary mb-3">Hasierara itzuli</a>
        </div>

        <!-- Aukeraketa baieztatzeko JavaScript -->
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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
