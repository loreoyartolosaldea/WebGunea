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

if (!isset($_SESSION['gidari_nan'])) {
    echo "<div class='alert alert-danger m-3'>Ezin da NAN eskuratu. Saioa hasi berriro.</div>";
    exit;
}

$gidari_nan = $_SESSION['gidari_nan'];
require_once '../DatuBasea/konexioa.php';

$msg = '';

// Comprobar si el conductor ya tiene un viaje activo (egoera 'unekoa')
$stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE gidari_nan = ? AND egoera = 'unekoa'");
$stmt->execute([$gidari_nan]);
$bidai_aktiboa = $stmt->fetch();

// Primero traemos los viajes programados y sin asignar
$stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND gidari_nan IS NULL");
$stmt->execute();
$bidaiak = $stmt->fetchAll();

if (isset($_POST['aukeratu'])) {
    if ($bidai_aktiboa) {
        // Ya tiene viaje activo, no dejar elegir otro
    } else {
        if (isset($_POST['bidaia_id']) && !empty($_POST['bidaia_id'])) {
            $bidaia_id = $_POST['bidaia_id'];

            // Marcar como 'eginda' el viaje anterior 'unekoa' (precaución, aunque no debería haber ninguno)
            $stmt = $pdo->prepare("UPDATE Bidaia SET egoera = 'eginda' WHERE gidari_nan = ? AND egoera = 'unekoa'");
            $stmt->execute([$gidari_nan]);

            // Asignar el viaje seleccionado
            $stmt = $pdo->prepare("UPDATE Bidaia SET gidari_nan = ?, egoera = 'unekoa' WHERE Bidaia_id = ?");
            $stmt->execute([$gidari_nan, $bidaia_id]);

            $msg = "<div class='alert alert-success'>Bidaia hartu duzu arrakastaz.</div>";

            // Actualizamos la lista de viajes
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE egoera = 'programatuta' AND gidari_nan IS NULL");
            $stmt->execute();
            $bidaiak = $stmt->fetchAll();

            // Actualizamos el viaje activo
            $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE gidari_nan = ? AND egoera = 'unekoa'");
            $stmt->execute([$gidari_nan]);
            $bidai_aktiboa = $stmt->fetch();
        } else {
            $msg = "<div class='alert alert-warning'>Mesedez, aukeratu bidaia bat lehenik.</div>";
        }
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Programatutako bidaiak (aukeratu nahi duzuna)</h2>

    <?= $msg ?>

    <?php if ($bidai_aktiboa): ?>
        <div class="alert alert-info">
            Zure bidaia aktiboa:
            <strong>ID <?= htmlspecialchars($bidai_aktiboa['Bidaia_id']) ?></strong> |
            <?= htmlspecialchars($bidai_aktiboa['Data']) ?> <?= htmlspecialchars($bidai_aktiboa['ordua']) ?> |
            <?= htmlspecialchars($bidai_aktiboa['hasiera']) ?> → <?= htmlspecialchars($bidai_aktiboa['helmuga']) ?>
        </div>
        <div class="alert alert-warning">
            Bidaia aktibo bat duzu dagoeneko, ezin duzu beste bat aukeratu.
        </div>
    <?php else: ?>
        <?php if (count($bidaiak) > 0): ?>
            <form method="post" class="mb-4" onsubmit="return confirmSelection();">
                <div class="mb-3">
                    <label for="bidaiaSelect" class="form-label">Bidaiak</label>
                    <select name="bidaia_id" id="bidaiaSelect" class="form-select" required>
                        <option value="" disabled selected>-- Aukeratu bidaia bat --</option>
                        <?php foreach ($bidaiak as $b): ?>
                            <option value="<?= htmlspecialchars($b['Bidaia_id']) ?>">
                                ID: <?= htmlspecialchars($b['Bidaia_id']) ?> |
                                <?= htmlspecialchars($b['Data']) ?> <?= htmlspecialchars($b['ordua']) ?> |
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
    <?php endif; ?>
    <a href="index.php" class="btn btn-secondary mb-3">Hasierara itzuli</a>
</div>

<script>
    function confirmSelection() {
        const select = document.getElementById('bidaiaSelect');
        if (select.value === "") {
            alert('Mesedez, aukeratu bidaia bat lehenik.');
            return false;
        }
        return true;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
