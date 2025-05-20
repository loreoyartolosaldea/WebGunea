<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidaria Erregistroa</title> <!-- Orriaren izenburua nabigatzailean -->
        
        <!-- Bootstrap estiloko fitxategia, diseinua eta erabilgarritasuna hobetzeko -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        
        <!-- Estilo pertsonalizatuak dituen CSS fitxategia -->
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>

        <?php
            require_once '../DatuBaseaKonexioa/konexioa.php'; // Datu-basearekin konektatzeko fitxategia
            session_start(); // Saioa hasi, sesioan aldagaien erabilera ahalbidetzeko

            $mezua = '';   // Erroreak edo mezu arrakastatsuak gordetzeko aldagaiak
            $klasea = '';  // Bootstrap klaseak erakusteko (adibidez: alert-danger)

            // Formularioa bidali denean, datuak prozesatzen dira
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // Erabiltzaileak sartutako datuak jasotzen dira POST bidez
                $nan = $_POST['nan'];
                $izena = $_POST['izena'];
                $abizena = $_POST['abizena'];
                $posta = $_POST['posta'];
                $telefonoa = $_POST['telefonoa'];
                $pasahitza = $_POST['pasahitza']; 
                $kokapena = $_POST['kokapena'];
                $lan_lekua = $_POST['lan_lekua'];
                $matrikula = $_POST['matrikula'];

                // Datuak Gidaria taulan txertatzeko SQL kontsulta prestatzen da
                $stmt = $pdo->prepare("INSERT INTO Gidaria (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza, Kokapena, Lan_lekua, Matrikula) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                try 
                {
                    // Prestaturiko SQL kontsulta exekutatzen da erabiltzaileak sartutako datuekin
                    $stmt->execute([$nan, $izena, $abizena, $posta, $telefonoa, $pasahitza, $kokapena, $lan_lekua, $matrikula]);

                    // Erregistroa arrakastatsua bada, saioa automatikoki hasten da
                    $_SESSION['Gidari_nan'] = $nan;
                    $_SESSION['izena'] = $izena;
                    $_SESSION['rola'] = 'gidaria';

                    // Hasierako orrira birbideratzen da erabiltzailea
                    header("Location: ../index.php");
                    exit;
                } catch (PDOException $e) 
                {
                    // Salbuespenen kasuan, errore mezua bistaratzen da
                    $mezua = "Errorea: " . $e->getMessage();
                    $klasea = "danger"; // Bootstrap 'alert-danger' klasearekin kolore gorria izango du
                }
            }
        ?>

        <!-- Erregistro-formularioa daukan Bootstrap txartela -->
        <div class="card mt-4 mx-auto" style="max-width: 500px;">
            <div class="card-header text-white bg-primary text-center">
                <h4>Gidariaren Erregistroa</h4> <!-- Txartelaren goiburua -->
            </div>
            <div class="card-body">

                <!-- Erroreak edo mezuak erakusteko Bootstrap alerta bat -->
                <?php if (!empty($mezua)): ?>
                    <div class="alert alert-<?= $klasea ?>"><?= $mezua ?></div>
                <?php endif; ?>

                <!-- Gidaria erregistratzeko formularioa -->
                <form method="post">
                    <!-- Datuak sartzeko input-ak -->
                    <input type="text" name="nan" class="form-control mb-3" placeholder="NAN" required>
                    <input type="text" name="izena" class="form-control mb-3" placeholder="Izena" required>
                    <input type="text" name="abizena" class="form-control mb-3" placeholder="Abizena" required>
                    <input type="email" name="posta" class="form-control mb-3" placeholder="Posta elektronikoa" required>
                    <input type="text" name="telefonoa" class="form-control mb-3" placeholder="Telefono zenbakia" required>
                    <input type="password" name="pasahitza" class="form-control mb-3" placeholder="Pasahitza" required>
                    <input type="text" name="kokapena" class="form-control mb-3" placeholder="Kokapena" required>

                    <!-- Lan lekua aukeratzeko desplegablea -->
                    <select name="lan_lekua" class="form-select mb-3" required>
                        <option value="" disabled selected>-- Aukeratu lan lekua --</option>
                        <option value="Araba">Araba</option>
                        <option value="Bizkaia">Bizkaia</option>
                        <option value="Gipuzkoa">Gipuzkoa</option>
                        <option value="Nafarroa">Nafarroa</option>
                    </select>

                    <input type="text" name="matrikula" class="form-control mb-3" placeholder="Ibilgailuaren matrikula" required>

                    <!-- Formularioa bidaltzeko botoia -->
                    <button type="submit" class="btn btn-warning w-100">Erregistratu</button>
                </form>

                <!-- Hasiera orrira bueltatzeko botoia -->
                <div class="text-center mt-4">
                    <a href="../index.php" class="btn btn-outline-secondary">⬅ Itzuli hasierara</a>
                </div>
            </div>
        </div>
    </body>
</html>
