<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Bidaia Sortu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estiloa/bidaia.css">
    </head>
    <body class="bg-light">
        <?php
            session_start();

            // Saioa hasita dagoen ala egiaztatu
            if (!isset($_SESSION['erabiltzaile_nan'])) 
            {
                // Saioa hasi gabe badago edo NAN-a ez badago esleituta, mezua erakutsi eta amaitu
                die("<div class='alert alert-danger text-center m-5'>Errorea: Saioa hasi gabe edo NAN ez dago esleituta.</div>");
            }

            // Erabiltzailearen NAN hartu saioetik
            $erabiltzaileNan = $_SESSION['erabiltzaile_nan'];

            // Datu-basera konektatu
            require_once '../DatuBaseaKonexioa/konexioa.php';

            // ============================================
            // EGUNERATU: Bidaien egoera 'programatuta' badago eta data+ordua pasa bada, jarri 'eginda' egoeran
            // ============================================
            $stmt = $pdo->prepare
            ("
                UPDATE Bidaia
                SET Egoera = 'eginda'
                WHERE Egoera = 'programatuta' AND 
                      CONCAT(Data, ' ', Ordua) < NOW()
            ");
            $stmt->execute();

            // POST eskaera jasotzen badugu (formularioa bidali bada)
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // Formularioan jasotako datuak hartu
                $bidaiaData = $_POST['data'];
                $bidaiaOrdua = $_POST['ordua'];
                $pertsonaKopurua = $_POST['pertsona_kop'];
                $hasieraHerria = $_POST['hasiera'];
                $helmugaHerria = $_POST['helmuga'];

                // Gaurko data eta ordua DateTime objektu gisa sortu
                $gaur = new DateTime('today');
                $orain = new DateTime();

                // Hautatutako data eta ordua DateTime gisa sortu, konparaketarako
                $hautatutakoData = DateTime::createFromFormat('Y-m-d', $bidaiaData);
                $hautatutakoMomentua = DateTime::createFromFormat('Y-m-d H:i', $bidaiaData . ' ' . $bidaiaOrdua);

                // ============================================
                // DATA ETA ORDUA BALIDATU
                // ============================================
                if ($hautatutakoData < $gaur) 
                {
                    // Aukeratutako data gaur baino lehenagokoa bada, mezua prestatu
                    $mezua = "Ezin da atzoko data edo aurrekoa aukeratu.";
                    $alertaMota = "danger";
                } 
                elseif ($hautatutakoMomentua < $orain) 
                {
                    // Aukeratutako ordua dagoeneko pasa bada, mezua prestatu
                    $mezua = "Ezin da gaurko ordu hau aukeratu, dagoeneko igaro da.";
                    $alertaMota = "warning";
                } 
                else 
                {
                    // ============================================
                    // BIDAI BERRIAK ERREPETITZEA SAHUZTEN DUTEN KONTROLA
                    // ============================================
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Bidaia WHERE Data = ? AND Ordua = ? AND Erabiltzaile_NAN = ?");
                    $stmt->execute([$bidaiaData, $bidaiaOrdua, $erabiltzaileNan]);
                    $bidaiaDago = $stmt->fetchColumn();

                    if ($bidaiaDago > 0) 
                    {
                        // Data eta ordu berdineko bidaia badago, mezua prestatu
                        $mezua = "Bidaia berdina (data eta ordu berean) ezin da errepikatu.";
                        $alertaMota = "warning";
                    } 
                    else 
                    {
                        // ============================================
                        // BIDAI BERRIA SARTU DATABASEAN
                        // ============================================
                        $stmt = $pdo->prepare
                        ("
                            INSERT INTO Bidaia 
                                (Data, Ordua, Pertsona_kopurua, Hasiera, Helmuga, Egoera, Erabiltzaile_NAN) 
                            VALUES (?, ?, ?, ?, ?, 'programatuta', ?)
                        ");

                        try 
                        {
                            // Datuak sartu
                            $stmt->execute([$bidaiaData, $bidaiaOrdua, $pertsonaKopurua, $hasieraHerria, $helmugaHerria, $erabiltzaileNan]);
                            $mezua = "Bidaia sortua arrakastaz!";
                            $alertaMota = "success";
                        } 
                        catch (PDOException $e) 
                        {
                            // Erroreak kudeatu
                            $mezua = "Errorea: " . $e->getMessage();
                            $alertaMota = "danger";
                        }
                    }
                }
            }

            // ============================================
            // HERRIEN ZERRENDA (Probintzia eta herriak)
            // ============================================
            $herrienZerrenda = 
            [
                "Gipuzkoa" => ["Azpeitia", "Beasain", "Bergara", "Donostia", "Eibar", "Hernani", "Irun", "Ordizia", "Tolosa", "Zumarraga", "Zarautz", "Arrasate"],
                "Bizkaia" => ["Barakaldo", "Bilbo", "Getxo", "Gernika", "Santurtzi", "Portugalete"],
                "Araba" => ["Agurain", "Añana", "Gasteiz", "Legutio", "Laudio", "Amurrio"],
                "Nafarroa" => ["Altsasu", "Arbizu", "Iruña", "Lakuntza", "Otsagabia", "Uharte"]
            ];
        ?>

        <div class="container mt-5">
            <div class="card shadow-lg">
                <!-- Karta goiburua -->
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Bidaia Berria Sortu</h3>
                </div>

                <div class="card-body">
                    <!-- Mezua erakutsi behar bada -->
                    <?php if (isset($mezua)): ?>
                        <div class="alert alert-<?= $alertaMota ?> text-center"><?= $mezua ?></div>
                    <?php endif; ?>

                    <!-- Bidaia sortzeko formularioa -->
                    <form method="post">
                        <!-- Data aukeratzeko -->
                        <div class="mb-3">
                            <label for="data" class="form-label">Data:</label>
                            <input type="date" name="data" id="data" class="form-control" required>
                        </div>

                        <!-- Ordua aukeratzeko -->
                        <div class="mb-3">
                            <label class="form-label">Ordua:</label>
                            <div class="d-flex gap-2">
                                <!-- Orduak -->
                                <select id="ordu-select" class="form-select" required>
                                    <?php for ($i = 0; $i < 24; $i++): ?>
                                        <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php endfor; ?>
                                </select>
                                <span class="fw-bold">:</span>
                                <!-- Minutuak 5 minutu tartean -->
                                <select id="minutu-select" class="form-select" required>
                                    <?php for ($i = 0; $i < 60; $i += 5): ?>
                                        <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <!-- Ordu guztia input ezkutua bidaltzeko -->
                            <input type="hidden" name="ordua" id="denbora-input" value="00:00" required>
                        </div>

                        <!-- Hasiera herria aukeratzeko -->
                        <div class="mb-3">
                            <label for="hasiera" class="form-label">Hasiera (irteera):</label>
                            <select name="hasiera" id="hasiera" class="form-select" required>
                                <option value="" selected disabled>Aukeratu hasiera</option>
                                <?php foreach ($herrienZerrenda as $probintzia => $herriak): ?>
                                    <optgroup label="<?= htmlspecialchars($probintzia) ?>">
                                        <?php sort($herriak); ?>
                                        <?php foreach ($herriak as $herria): ?>
                                            <option value="<?= htmlspecialchars($herria) ?>"><?= htmlspecialchars($herria) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Helmuga herria aukeratzeko -->
                        <div class="mb-3">
                            <label for="helmuga" class="form-label">Helmuga (jomuga):</label>
                            <select name="helmuga" id="helmuga" class="form-select" required>
                                <option value="" selected disabled>Aukeratu helmuga</option>
                                <?php foreach ($herrienZerrenda as $probintzia => $herriak): ?>
                                    <optgroup label="<?= htmlspecialchars($probintzia) ?>">
                                        <?php sort($herriak); ?>
                                        <?php foreach ($herriak as $herria): ?>
                                            <option value="<?= htmlspecialchars($herria) ?>"><?= htmlspecialchars($herria) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Pertsona kopurua sartzeko -->
                        <div class="mb-3">
                            <label for="pertsona_kop" class="form-label">Pertsona kopurua:</label>
                            <input type="number" name="pertsona_kop" id="pertsona_kop" class="form-control" min="1" required>
                        </div>

                        <!-- Bidaiaren sorkuntza botoia -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Bidaia sortu</button>
                        </div>
                    </form>
                </div>

                <!-- Karta oina -->
                <div class="card-footer text-center">
                    <a href="../index.php" class="btn btn-outline-secondary">⬅ Hasierara itzuli</a>
                </div>
            </div>
        </div>

        <script>
            // Dokumentua kargatuta, hau exekutatu
            document.addEventListener('DOMContentLoaded', () => 
            {
                // Ordu eta minutu select elementuak eta denbora ezkutuko input-a hartu
                const orduSelect = document.getElementById('ordu-select');
                const minutuSelect = document.getElementById('minutu-select');
                const denboraInput = document.getElementById('denbora-input');
                const dataInput = document.getElementById('data');

                // Ordua eguneratzeko funtzioa: ordu eta minutu aukeratuak ezkutuko input-ean jartzen ditu
                function eguneratuOrdua() 
                {
                    denboraInput.value = `${orduSelect.value}:${minutuSelect.value}`;
                }

                // Ordu eta minutu select-ak aldatu direnean ordua eguneratu
                orduSelect.addEventListener('change', eguneratuOrdua);
                minutuSelect.addEventListener('change', eguneratuOrdua);
                eguneratuOrdua(); // hasieran ere eguneratu

                // Data input-ari gaurko data minimo ezarri, ezin da gaur baino lehenago aukeratu
                const gaur = new Date().toISOString().split('T')[0];
                dataInput.setAttribute('min', gaur);
            });
        </script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
