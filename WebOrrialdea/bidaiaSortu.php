<?php
    require_once '../includes/konexioa.php';
    session_start();
    $nan = $_SESSION['nan'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $data = $_POST['data'];
        $ordua = $_POST['ordua'];
        $kop = $_POST['pertsona_kop'];
        $prezioa = $_POST['prezioa'];

        $stmt = $pdo->prepare("INSERT INTO Bidaia (Data, Ordua, Pertsona_kopurua, Egoera, Prezioa, Ordainketa_egoera, Erabiltzaile_NAN) 
                            VALUES (?, ?, ?, 'programatuta', ?, 'ordainketa gabe', ?)");
        $stmt->execute([$data, $ordua, $kop, $prezioa, $nan]);

        echo "Bidaia sortua!";
    }
?>

<form method="post">
    Data: <input type="date" name="data" required><br>
    Ordua: <input type="time" name="ordua" required><br>
    Pertsonak: <input type="number" name="pertsona_kop" required><br>
    Prezioa (€): <input type="number" step="0.01" name="prezioa" required><br>
    <input type="submit" value="Sortu Bidaia">
</form>
