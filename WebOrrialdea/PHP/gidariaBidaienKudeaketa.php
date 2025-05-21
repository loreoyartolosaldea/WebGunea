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

            // Saioa hasi dela egiaztatu, bestela errore mezua erakutsi eta irten
            if (!isset($_SESSION['Gidari_nan'])) 
            {
                echo "<div class='alert alert-danger m-3'>Ezin da NAN-a eskuratu. Saioa hasi berriro.</div>";
                exit;
            }

            $Gidari_nan = $_SESSION['Gidari_nan'];

            require_once '../DatuBaseaKonexioa/konexioa.php';

            $mezua = "";

            // Gidariak jadanik bidaia aktiboa duen egiaztatu ('unekoa' egoeran)
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ? AND egoera = 'unekoa'");
            $stmt->execute([$Gidari_nan]);
            $bidai_aktiboa = $stmt->fetch();

            // Programatutako eta oraindik gidaririk gabe dauden bidaiak lortu
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND Gidari_nan IS NULL ORDER BY Data ASC, Ordua ASC");
            $stmt->execute();
            $bidaiak = $stmt->fetchAll();

            // Bidai bat aukeratu bada
            if (isset($_POST['aukeratu'])) 
            {
                if (isset($_POST['bidaia_id']) && !empty($_POST['bidaia_id'])) 
                {
                    $hautatutakoId = $_POST['bidaia_id'];

                    // Aukeratutako bidaia lortu
                    $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Bidaia_id = ?");
                    $stmt->execute([$hautatutakoId]);
                    $hautatutakoBidaia = $stmt->fetch();

                    if (!$hautatutakoBidaia) 
                    {
                        // Aukeratutako bidaia ez da existitzen
                        $mezua = "<div class='alert alert-danger'>Errorea: bidaia ez da existitzen.</div>";
                    } 
                    else 
                    {
                        $bidaiOnartuDaiteke = true;

                        // Gidariaren bidaia aktiboarekin data eta ordua konparatu, bat badira ez onartu
                        if ($bidai_aktiboa) 
                        {
                            $aktiboData = $bidai_aktiboa['Data'] . ' ' . $bidai_aktiboa['Ordua'];
                            $hautatuData = $hautatutakoBidaia['Data'] . ' ' . $hautatutakoBidaia['Ordua'];

                            $aktiboDateTime = new DateTime($aktiboData);
                            $hautatuDateTime = new DateTime($hautatuData);

                            if ($aktiboDateTime == $hautatuDateTime) 
                            {
                                $bidaiOnartuDaiteke = false;
                            }
                        }

                        if ($bidaiOnartuDaiteke) 
                        {
                            // Bidaia gidariari esleitu eta egoera 'unekoa' bihurtu
                            $stmt = $pdo->prepare("UPDATE Bidaia SET Gidari_nan = ?, egoera = 'unekoa' WHERE Bidaia_id = ?");
                            $stmt->execute([$Gidari_nan, $hautatutakoId]);

                            $mezua = "<div class='alert alert-success'>Bidaia hartu duzu arrakastaz.</div>";

                            // Programatutako bidaiak berriro kargatu, esleitutakoak kendu daitezen
                            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND Gidari_nan IS NULL ORDER BY Data ASC, Ordua ASC");
                            $stmt->execute();
                            $bidaiak = $stmt->fetchAll();

                            // Gidariaren bidaia aktiboa berriro kargatu
                            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ? AND egoera = 'unekoa'");
                            $stmt->execute([$Gidari_nan]);
                            $bidai_aktiboa = $stmt->fetch();
                        } 
                        else 
                        {
                            // Bidaiak data eta ordu berdina du gidariaren bidaia aktiboarekin
                            $mezua = "<div class='alert alert-warning'>Ezinezkoa: bidaia hori unean aktibo dagoen bidaiarekin gainjartzen da.</div>";
                        }
                    }
                } 
                else 
                {
                    // Ez da bidaia bat aukeratu
                    $mezua = "<div class='alert alert-warning'>Mesedez, aukeratu bidaia bat lehenik.</div>";
                }
            }
        ?>

        <div class="container mt-4">
            <h2 class="mb-4">Programatutako bidaiak (aukeratu nahi duzuna)</h2>

            <!-- Mezuak erakutsi -->
            <?= $mezua ?>

            <?php if ($bidaiak): ?>
                <form method="post" class="mb-4" onsubmit="return confirmSelection();">
                    <div class="mb-3">
                        <label for="bidaiaSelect" class="form-label">Aukeratu bidaia bat</label>
                        <select name="bidaia_id" id="bidaiaSelect" class="form-select" required>
                            <option value="" disabled selected>-- Aukeratu bidaia bat --</option>
                            <?php foreach ($bidaiak as $bidaia): ?>
                                <option value="<?= $bidaia['Bidaia_id'] ?>">
                                    <?= htmlspecialchars($bidaia['Data']) ?> - <?= htmlspecialchars($bidaia['Ordua']) ?> - <?= htmlspecialchars($bidaia['hasiera']) ?> → <?= htmlspecialchars($bidaia['helmuga']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="aukeratu" class="btn btn-primary">Bidaia hartu</button>
                </form>
            <?php else: ?>
                <p>Ez dago programatutako bidaia esleitzerik.</p>
            <?php endif; ?>

            <?php if ($bidai_aktiboa): ?>
                <div class="alert alert-info">
                    <strong>Uneko bidaia:</strong><br>
                    Data: <?= htmlspecialchars($bidai_aktiboa['Data']) ?><br>
                    Ordua: <?= htmlspecialchars($bidai_aktiboa['Ordua']) ?><br>
                    Hasiera: <?= htmlspecialchars($bidai_aktiboa['hasiera']) ?><br>
                    Helmuga: <?= htmlspecialchars($bidai_aktiboa['helmuga']) ?><br>
                    Egoera: <?= htmlspecialchars($bidai_aktiboa['egoera']) ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Ez duzu bidaia aktiborik une honetan.</div>
            <?php endif; ?>

            <a href="../index.php" class="btn btn-secondary mt-3">Hasierara itzuli</a>
        </div>

        <script>
            // Erabiltzaileari baieztapena eskatu bidaia aukeratu aurretik
            function confirmSelection() 
            {
                const select = document.getElementById('bidaiaSelect');
                if (!select.value) 
                {
                    alert('Mesedez, aukeratu bidaia bat.');
                    return false;
                }
                return confirm('Ziur zaude bidaia hau hartu nahi duzula?');
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
