<?php
    require_once '../includes/konexioa.php';
    session_start();
    $gidari_nan = $_SESSION['nan'];

    $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Egoera = 'programatuta' AND Gidari_NAN IS NULL");
    $stmt->execute();
    $bidaiak = $stmt->fetchAll();

    foreach ($bidaiak as $b) 
    {
        echo "<p>Bidaia #" . $b['Bidaia_id'] . " - " . $b['Data'] . " - " . $b['Ordua'] . "</p>";
        echo "<form method='post'><input type='hidden' name='id' value='" . $b['Bidaia_id'] . "'><input type='submit' name='aukeratu' value='Hau hartu'></form>";
    }

    if (isset($_POST['aukeratu'])) 
    {
        $bidaia_id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE Bidaia SET Gidari_NAN = ?, Egoera = 'unekoa' WHERE Bidaia_id = ?");
        $stmt->execute([$gidari_nan, $bidaia_id]);
        echo "Bidaia hartu duzu.";
    }
?>
