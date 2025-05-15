<?php
session_start();
if (!isset($_SESSION['gidari_nan'])) {
    header("Location: saioaGidaria.php");
    exit;
}

require_once 'DatuBasea/konexioa.php';
$nan = $_SESSION['gidari_nan'];

$stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE gidari_nan = ?");
$stmt->execute([$nan]);
$bidaiak = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Nire Bidaiak - Gidaria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>🚕 Nire Bidaiak (<?= htmlspecialchars($_SESSION['izena']) ?>)</h2>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>Data</th>
                <th>Ordua</th>
                <th>Hasiera</th>
                <th>Helmuga</th>
                <th>Pertsonak</th>
                <th>Egoera</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bidaiak as $bidaia): ?>
                <tr>
                    <td><?= $bidaia['Data'] ?></td>
                    <td><?= $bidaia['ordua'] ?></td>
                    <td><?= $bidaia['hasiera'] ?></td>
                    <td><?= $bidaia['helmuga'] ?></td>
                    <td><?= $bidaia['pertsona_kopurua'] ?></td>
                    <td><?= $bidaia['egoera'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary mb-3">Hasierara itzuli</a>
</div>
</body>
</html>
