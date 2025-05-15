<?php
// Datu basearekin konexioa ezarri
require_once '../DatuBasea/konexioa.php';
session_start();

$mezuak = ""; // Erroreak edo mezuak gordetzeko aldagaia

// Formularioa bidali bada (POST metodoa erabiliz)
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Formularioan jasotako datuak hartu
    $nan = $_POST['nan'];
    $izena = $_POST['izena'];
    $abizena = $_POST['abizena'];
    $posta = $_POST['posta'];
    $tel = $_POST['tel'];
    $pasahitza = $_POST['pasahitza'];

    // Pasahitza zifratu (hash) gorde aurretik
    $pasahitzaZifratua = password_hash($pasahitza, PASSWORD_DEFAULT);

    // SQL prestatu eta exekutatu datuak sartzeko
    $stmt = $pdo->prepare("INSERT INTO Erabiltzailea (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza) 
                           VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([$nan, $izena, $abizena, $posta, $tel, $pasahitzaZifratua])) {
        // Erregistroa ondo egin da -> saioa hasi eta hasierako orrira bidali
        $_SESSION['nan'] = $nan;
        $_SESSION['izena'] = $izena;
        $_SESSION['abizena'] = $abizena;
        header("Location: ../index.php");
        exit;
    } else {
        // Errorea datuak sartzean
        $mezuak = "<p class='errorea'>Errorea: ezin izan da erregistratu.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erregistroa - alaikToMUGI</title>
    <link rel="stylesheet" href="../Estiloa/erregistroa.css">
</head>
<body>
    <div class="form-container">
        <h1>Erabiltzailearen Erregistroa</h1>

        <!-- Erroreak bistaratzea (baldin badaude) -->
        <?= $mezuak ?>

        <!-- Erregistro formularioa -->
        <form method="post" class="erregistro-form">
            <label for="nan">NAN:</label>
            <input type="text" name="nan" id="nan" required>

            <label for="izena">Izena:</label>
            <input type="text" name="izena" id="izena" required>

            <label for="abizena">Abizena:</label>
            <input type="text" name="abizena" id="abizena" required>

            <label for="posta">Posta elektronikoa:</label>
            <input type="email" name="posta" id="posta" required>

            <label for="tel">Telefono zenbakia:</label>
            <input type="text" name="tel" id="tel" required>

            <label for="pasahitza">Pasahitza:</label>
            <input type="password" name="pasahitza" id="pasahitza" required>

            <input type="submit" value="Erregistratu" class="btn">
        </form>

        <!-- Hasierara itzultzeko esteka -->
        <p class="buelta"><a href="../index.php">Itzuli hasierara</a></p>
    </div>
</body>
</html>
