<?php
    require_once 'DatuBasea/konexioa.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $nan = $_POST['nan'];
        $izena = $_POST['izena'];
        $abizena = $_POST['abizena'];
        $posta = $_POST['posta'];
        $tel = $_POST['tel'];
        $pasahitza = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO Erabiltzailea (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza) 
                            VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$nan, $izena, $abizena, $posta, $tel, $pasahitza])) 
        {
            echo "Erabiltzailea erregistratua!";
        } else 
        {
            echo "Errorea: ezin izan da erregistratu.";
        }
    }
?>

<form method="post">
    NAN: <input type="text" name="nan" required><br>
    Izena: <input type="text" name="izena" required><br>
    Abizena: <input type="text" name="abizena" required><br>
    Posta: <input type="email" name="posta" required><br>
    Telefonoa: <input type="text" name="tel" required><br>
    Pasahitza: <input type="password" name="pasahitza" required><br>
    <input type="submit" value="Erregistratu">
</form>
