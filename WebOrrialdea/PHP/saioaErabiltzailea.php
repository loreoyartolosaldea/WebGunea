<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Saioa hasi - Erabiltzailea</title>
    <link rel="stylesheet" href="../Estiloa/saioa.css">
</head>
<body>
<?php
    require_once '../DatuBasea/konexioa.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nan = trim($_POST['nan']);
        $pasahitza = trim($_POST['pasahitza']);

        $stmt = $pdo->prepare("SELECT NAN, Izena, Pasahitza FROM Erabiltzailea WHERE NAN = ?");
        $stmt->execute([$nan]);
        $erabiltzailea = $stmt->fetch();

        if ($erabiltzailea) {
            $hashDB = $erabiltzailea['Pasahitza'];

            if (password_verify($pasahitza, $hashDB) || $pasahitza === $hashDB) {
                // Saioa hasi eta izena gorde
                $_SESSION['erabiltzaile_nan'] = $nan;
                $_SESSION['izena'] = $erabiltzailea['Izena'];
                $_SESSION['rola'] = 'erabiltzailea'; // GARRANTZITSUA

                // Pasahitza plaintext bada → eguneratu hash-arekin
                if ($pasahitza === $hashDB) {
                    $hashBerria = password_hash($pasahitza, PASSWORD_DEFAULT);
                    $updateStmt = $pdo->prepare("UPDATE Erabiltzailea SET Pasahitza = ? WHERE NAN = ?");
                    $updateStmt->execute([$hashBerria, $nan]);
                }

                header("Location: ../index.php");
                exit;
            } else {
                $errorea = "NAN edo pasahitza okerra.";
            }
        } else {
            $errorea = "NAN edo pasahitza okerra.";
        }
    }
?>
<h2>Saioa hasi (Erabiltzailea)</h2>

<?php if (isset($errorea)) echo "<p style='color:red;'>$errorea</p>"; ?>

<form method="post">
    <label for="nan">NAN:</label>
    <input type="text" name="nan" required><br>

    <label for="pasahitza">Pasahitza:</label>
    <input type="password" name="pasahitza" required><br>

    <input type="submit" value="Sartu">
</form>

<p><a href="../index.php">Atzera hasierara</a></p>
</body>
</html>
