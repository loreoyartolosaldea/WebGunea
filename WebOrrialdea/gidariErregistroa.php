<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Gidaria Erregistroa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <?php
        require_once 'DatuBasea/konexioa.php';

        $mezua = '';
        $klasea = '';

        // Formularioa bidali denean
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $nan = $_POST['nan'];
            $izena = $_POST['izena'];
            $abizena = $_POST['abizena'];
            $posta = $_POST['posta'];
            $telefonoa = $_POST['telefonoa'];
            $pasahitza = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT); // Pasahitza zifratuta gorde
            $kokapena = $_POST['kokapena'];
            $lan_lekua = $_POST['lan_lekua'];
            $matrikula = $_POST['matrikula'];

            // Datuak txertatzeko SQLa
            $stmt = $pdo->prepare("INSERT INTO Gidaria (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza, Kokapena, Lan_lekua, Matrikula) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            try {
                $stmt->execute([$nan, $izena, $abizena, $posta, $telefonoa, $pasahitza, $kokapena, $lan_lekua, $matrikula]);
                $mezua = "✅ Gidaria erregistratu da!";
                $klasea = "success";
            } catch (PDOException $e) {
                $mezua = "❌ Errorea: " . $e->getMessage();
                $klasea = "danger";
            }
        }
    ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>📝 Gidaria Erregistroa</h3>
        </div>

        <div class="card-body">
            <?php if (!empty($mezua)): ?>
                <div class="alert alert-<?= $klasea ?>"><?= $mezua ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="nan" class="form-label">NAN:</label>
                    <input type="text" name="nan" id="nan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="izena" class="form-label">Izena:</label>
                    <input type="text" name="izena" id="izena" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="abizena" class="form-label">Abizena:</label>
                    <input type="text" name="abizena" id="abizena" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="posta" class="form-label">Posta elektronikoa:</label>
                    <input type="email" name="posta" id="posta" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefonoa" class="form-label">Telefono zenbakia:</label>
                    <input type="text" name="telefonoa" id="telefonoa" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="pasahitza" class="form-label">Pasahitza:</label>
                    <input type="password" name="pasahitza" id="pasahitza" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kokapena" class="form-label">Kokapena:</label>
                    <input type="text" name="kokapena" id="kokapena" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="lan_lekua" class="form-label">Lan lekua:</label>
                    <input type="text" name="lan_lekua" id="lan_lekua" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="matrikula" class="form-label">Ibilgailuaren matrikula:</label>
                    <input type="text" name="matrikula" id="matrikula" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Erregistratu</button>
                </div>
            </form>
        </div>

        <div class="card-footer text-center">
            <a href="gidariHasiera.php" class="btn btn-outline-secondary mt-2">⬅ Itzuli hasierara</a>
        </div>
    </div>
</div>
</body>
</html>
