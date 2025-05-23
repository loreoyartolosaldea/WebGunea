<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Nire Bidaiak - Gidaria</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
        <?php
            // PHP saioa hasi
            session_start();
            
            // Saioan 'gidari_nan' aldagairik ez badago, gidariaren saioa hasteko orrira birbideratu
            // Orain 'gidari_nan' erabiltzen dugu, loginean gordetzen den bezala.
            if (!isset($_SESSION['gidari_nan'])) 
            {
                header("Location: ../PHP/saioaGidaria.php");
                exit;
            }

            // Datu-basearekiko konexioa ezartzeko fitxategia sartu
            require_once '../DatuBaseaKonexioa/konexioa.php';

            // Saioan dagoen gidariaren NAN-a eskuratu
            // Aldagaiaren izena 'gidari_nan' izan dadin zuzendu da.
            $nan            =           $_SESSION['gidari_nan']; 

            $mezua          =           ''; // Mezuak gordetzeko aldagaia hasieratu

            // Bidaia bat amaitu dela adierazten duen formularioa bidali bada
            if (isset($_POST['bukatuta']) && isset($_POST['bidaia_id'])) 
            {
                $bidaiaId           =           $_POST['bidaia_id'];

                // Bidaiaren egoera 'eginda' egoerara eguneratzeko kontsulta
                // Egoera 'eginda' jarri eta 'Amaiera_ordua' uneko ordua bezala ezarri (CURTIME() erabiliz)
                $updateStmt = $pdo->prepare
                ("
                    UPDATE Bidaia 
                    SET Egoera = 'eginda', Amaiera_ordua = CURTIME() 
                    WHERE Bidaia_id = ? 
                    AND Gidari_nan = ? 
                    AND Egoera IN ('unekoa', 'bidean')
                ");
                
                $updateStmt->execute([$bidaiaId, $nan]);

                // Eguneraketa zuzen egin den egiaztatu
                if ($updateStmt->rowCount() > 0) 
                {
                    $mezua = "<div class='alert alert-success'>Bidaia eginda markatu da.</div>";
                } else 
                {
                    $mezua = "<div class='alert alert-warning'>Ezin izan da bidaia eginda markatu. Ziurtatu bidaia hau zurea dela eta oraindik ez dela eginda.</div>";
                }
            }

            // Gidariaren bidaia guztiak eskuratzeko kontsulta, data eta hasiera-orduaren arabera beheranzko ordenan
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Gidari_nan = ? ORDER BY Data DESC, Hasiera_ordua DESC");
            $stmt->execute([$nan]);
            $bidaiak = $stmt->fetchAll();
        ?>

        <div class="container mt-5">
            <h2>Nire Bidaiak (<?= htmlspecialchars($_SESSION['izena'] ?? 'Gidaria') ?>)</h2>

            <?= $mezua ?>

            <?php if (count($bidaiak) > 0): // Bidaiarik badago, taula erakutsi ?>
                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Data</th>
                            <th>Hasiera_ordua</th>
                            <th>Amaiera_ordua</th> 
                            <th>Hasiera</th>
                            <th>Helmuga</th>
                            <th>Pertsonak</th>
                            <th>Egoera</th>
                            <th>Ekintza</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bidaiak as $bidaia): // Bidaia bakoitzeko ilara bat sortu ?>
                        <tr>
                            <td><?= htmlspecialchars($bidaia['Data']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Hasiera_ordua']) ?></td>
                            <td><?= $bidaia['Amaiera_ordua'] ? htmlspecialchars($bidaia['Amaiera_ordua']) : 'N/A' ?></td> 
                            <td><?= htmlspecialchars($bidaia['Hasiera']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Helmuga']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Pertsona_kopurua']) ?></td>
                            <td><?= htmlspecialchars($bidaia['Egoera']) ?></td>
                            <td>
                            <?php if ($bidaia['Egoera'] === 'unekoa' || $bidaia['Egoera'] === 'bidean'): // Bidaia 'unekoa' edo 'bidean' bada, "Eginda" botoia erakutsi ?>
                                <form method="post" style="display:inline-block;">
                                <input type="hidden" name="bidaia_id" value="<?= $bidaia['Bidaia_id'] ?>">
                                <button type="submit" name="bukatuta" class="btn btn-success btn-sm" onclick="return confirm('Bidaia hau eginda markatu nahi duzu?')">Eginda</button>
                                </form>
                            <?php else: // Bidaiaren egoera ez bada horietakoa, botoia desgaitu ?>
                                <button class="btn btn-secondary btn-sm" disabled>Eginda</button>
                            <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: // Bidaiarik ez badago, informazio mezua erakutsi ?>
                <div class="alert alert-info">Ez dago bidairik.</div>
            <?php endif; ?>

            <a href="../index.php" class="btn btn-secondary mb-3">Hasierara itzuli</a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>