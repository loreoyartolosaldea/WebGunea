<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidaria Erregistroa</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            require_once '../DatuBaseaKonexioa/konexioa.php';
            session_start();

            $mezua = '';
            $klasea = '';

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $nan = $_POST['nan'];
                $izena = $_POST['izena'];
                $abizena = $_POST['abizena'];
                $posta = $_POST['posta'];
                $telefonoa = $_POST['telefonoa'];
                $pasahitza = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);
                $kokapena = $_POST['kokapena'];
                $lan_lekua = $_POST['lan_lekua'];
                $matrikula = $_POST['matrikula'];

                $stmt = $pdo->prepare("INSERT INTO Gidaria (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza, Kokapena, Lan_lekua, Matrikula) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                try 
                {
                    $stmt->execute([$nan, $izena, $abizena, $posta, $telefonoa, $pasahitza, $kokapena, $lan_lekua, $matrikula]);

                    // Saioa hasi automatikoki
                    $_SESSION['Gidari_nan'] = $nan;
                    $_SESSION['izena'] = $izena;
                    $_SESSION['rola'] = 'gidaria';

                    // Bideratu hasierako orrira
                    header("Location: ../index.php");
                    exit;

                } catch (PDOException $e) 
                {
                    $mezua = "Errorea: " . $e->getMessage();
                    $klasea = "danger";
                }
            }
        ?>

        <div class="card mt-4 mx-auto" style="max-width: 500px;">
            <div class="card-header text-white bg-primary text-center">
                <h4>Gidariaren Erregistroa</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($mezua)): ?>
                    <div class="alert alert-<?= $klasea ?>"><?= $mezua ?></div>
                <?php endif; ?>

                <form method="post">
                    <input type="text" name="nan" class="form-control mb-3" placeholder="NAN" required>
                    <input type="text" name="izena" class="form-control mb-3" placeholder="Izena" required>
                    <input type="text" name="abizena" class="form-control mb-3" placeholder="Abizena" required>
                    <input type="email" name="posta" class="form-control mb-3" placeholder="Posta elektronikoa" required>
                    <input type="text" name="telefonoa" class="form-control mb-3" placeholder="Telefono zenbakia" required>
                    <input type="password" name="pasahitza" class="form-control mb-3" placeholder="Pasahitza" required>
                    <input type="text" name="kokapena" class="form-control mb-3" placeholder="Kokapena" required>

                    <!-- Lan lekua (select ordenatua) -->
                    <select name="lan_lekua" class="form-select mb-3" required>
                        <option value="" disabled selected>-- Aukeratu lan lekua --</option>
                        <option value="Araba">Araba</option>
                        <option value="Bizkaia">Bizkaia</option>
                        <option value="Gipuzkoa">Gipuzkoa</option>
                        <option value="Nafarroa">Nafarroa</option>
                    </select>

                    <input type="text" name="matrikula" class="form-control mb-3" placeholder="Ibilgailuaren matrikula" required>

                    <button type="submit" class="btn btn-warning w-100">Erregistratu</button>
                </form>

                <div class="text-center mt-4">
                    <a href="../index.php" class="btn btn-outline-secondary">⬅ Itzuli hasierara</a>
                </div>
            </div>
        </div>
    </body>
</html>
