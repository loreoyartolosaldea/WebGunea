<?php
require_once '../includes/konexioa.php'; // edo db.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nan = $_POST['nan'];
    $pasahitza = $_POST['pasahitza'];

    $stmt = $pdo->prepare("SELECT * FROM Erabiltzailea WHERE NAN = ?");
    $stmt->execute([$nan]);
    $erabiltzailea = $stmt->fetch();

    if ($erabiltzailea && password_verify($pasahitza, $erabiltzailea['Pasahitza'])) {
        $_SESSION['erabiltzaile_nan'] = $nan;
        header("Location: hasierakoOrria.php"); // Panela edo dashboard-era
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
    <title>Saioa hasi - Erabiltzailea</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Saioa hasi (Erabiltzailea)</h2>

    <?php if (isset($errorea)) echo "<p style='color:red;'>$errorea</p>"; ?>

    <form method="post">
        NAN: <input type="text" name="nan" required><br>
        Pasahitza: <input type="password" name="pasahitza" required><br>
        <input type="submit" value="Sartu">
    </form>

    <p><a href="../index.php">Atzera hasierara</a></p>
</body>
</html>

