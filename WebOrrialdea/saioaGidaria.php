<?php
session_start();
require_once 'DatuBasea/konexioa.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nan = $_POST['nan'];
    $pasahitza = $_POST['pasahitza'];

    $stmt = $pdo->prepare("SELECT * FROM Gidaria WHERE NAN = ?");
    $stmt->execute([$nan]);
    $gidari = $stmt->fetch();

    if ($gidari && password_verify($pasahitza, $gidari['Pasahitza'])) {
        $_SESSION['gidari_nan'] = $gidari['NAN'];
        $_SESSION['izena'] = $gidari['Izena'];
        header("Location: index.php");
        exit;
    } else {
        $errorea = "NAN edo pasahitza okerra.";
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Gidaria Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3>🔐 Gidaria Saioa Hasi</h3>
        </div>
        <div class="card-body">
            <?php if (isset($errorea)): ?>
                <div class="alert alert-danger"><?= $errorea ?></div>
            <?php endif; ?>
            <form method="post">
                <input class="form-control mb-3" type="text" name="nan" placeholder="NAN" required>
                <input class="form-control mb-3" type="password" name="pasahitza" placeholder="Pasahitza" required>
                <button class="btn btn-primary w-100">Saioa hasi</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
