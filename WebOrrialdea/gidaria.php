<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidariaren Bidaiak</title>
    </head>
    <body>
        <?php
            // Saioa hasi eta NAN hartu
            session_start();
            $gidari_nan = $_SESSION['nan'];

            // Datu-basearekin konektatu
            require_once 'DatuBasea/konexioa.php';

            // Programatutako baina gidaririk gabeko bidaiak bilatu
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Egoera = 'programatuta' AND Gidari_NAN IS NULL");
            $stmt->execute();
            $bidaiak = $stmt->fetchAll();
        ?>
        <h2>Programatutako bidaiak (aukeratu nahi duzuna)</h2>

        <?php foreach ($bidaiak as $b): ?>
            <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                <p><strong>Bidaia ID:</strong> <?= $b['Bidaia_id'] ?></p>
                <p><strong>Data:</strong> <?= $b['Data'] ?> - <?= $b['Ordua'] ?></p>
                <p><strong>Hasiera:</strong> <?= $b['Hasiera'] ?> → <strong>Helmuga:</strong> <?= $b['Helmuga'] ?></p>

                <form method="post">
                    <input type="hidden" name="id" value="<?= $b['Bidaia_id'] ?>">
                    <button type="submit" name="aukeratu">Hau hartu</button>
                </form>
            </div>
        <?php endforeach; ?>

        <?php
        // Gidariak bidaia bat aukeratu duenean
        if (isset($_POST['aukeratu'])) {
            $bidaia_id = $_POST['id'];

            // Lehenik beste "unekoa" egoerako bidaia aldatzen da "eginda" egoerara (gidari honek bakarra eduki dezan)
            $stmt = $pdo->prepare("UPDATE Bidaia SET Egoera = 'eginda' WHERE Gidari_NAN = ? AND Egoera = 'unekoa'");
            $stmt->execute([$gidari_nan]);

            // Aukeratutako bidaia "unekoa" bihurtzen da eta gidariari esleitzen zaio
            $stmt = $pdo->prepare("UPDATE Bidaia SET Gidari_NAN = ?, Egoera = 'unekoa' WHERE Bidaia_id = ?");
            $stmt->execute([$gidari_nan, $bidaia_id]);

            echo "<p style='color:green;'>Bidaia hartu duzu arrakastaz.</p>";
            header("Refresh: 2");
        }
        ?>
    </body>
</html>
