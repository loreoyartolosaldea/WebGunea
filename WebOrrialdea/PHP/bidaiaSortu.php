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

        if (!isset($_SESSION['erabiltzaile_nan'])) 
        {
            die("<div class='alert alert-danger text-center m-5'>Errorea: Saioa hasi gabe edo NAN ez dago esleituta.</div>");
        }

        $erabiltzaileNan = $_SESSION['erabiltzaile_nan'];

        require_once '../DatuBasea/konexioa.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $bidaiaData = $_POST['data'];
            $bidaiaOrdua = $_POST['ordua'];
            $pertsonaKopurua = $_POST['pertsona_kop'];
            $hasieraHerria = $_POST['hasiera'];
            $helmugaHerria = $_POST['helmuga'];

            $gaur = new DateTime('today');
            $orain = new DateTime();
            $hautatutakoData = DateTime::createFromFormat('Y-m-d', $bidaiaData);
            $hautatutakoMomentua = DateTime::createFromFormat('Y-m-d H:i', $bidaiaData . ' ' . $bidaiaOrdua);

            if ($hautatutakoData < $gaur) 
            {
                $mezua = "❌ Ezin da atzoko data edo aurrekoa aukeratu.";
                $alertaMota = "danger";
            } elseif ($hautatutakoMomentua < $orain) 
            {
                $mezua = "❌ Ezin da gaurko ordu hau aukeratu, dagoeneko igaro da.";
                $alertaMota = "warning";
            } else 
            {
                // Dagoeneko bidaia berdina existitzen bada, ez baimendu
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM Bidaia WHERE Data = ? AND Ordua = ? AND Erabiltzaile_NAN = ?");
                $stmt->execute([$bidaiaData, $bidaiaOrdua, $erabiltzaileNan]);
                $dagoenak = $stmt->fetchColumn();

                if ($dagoenak > 0) 
                {
                    $mezua = "❌ Bidaia berdina (data eta ordu berean) ezin da errepikatu.";
                    $alertaMota = "warning";
                } else 
                {
                    $stmt = $pdo->prepare("INSERT INTO Bidaia (Data, Ordua, Pertsona_kopurua, Hasiera, Helmuga, Egoera, Erabiltzaile_NAN) 
                                        VALUES (?, ?, ?, ?, ?, 'programatuta', ?)");
                    try 
                    {
                        $stmt->execute([$bidaiaData, $bidaiaOrdua, $pertsonaKopurua, $hasieraHerria, $helmugaHerria, $erabiltzaileNan]);
                        $mezua = "✅ Bidaia sortua arrakastaz!";
                        $alertaMota = "success";
                    } catch (PDOException $e) 
                    {
                        $mezua = "❌ Errorea: " . $e->getMessage();
                        $alertaMota = "danger";
                    }
                }
            }
        }

        // Herriak probintziaz sailkatuta eta alfabetikoki ordenatuta
        $herrienZerrenda = 
        [
            "Gipuzkoa" => 
            [
                "Azpeitia", "Beasain", "Bergara", "Donostia", "Eibar",
                "Hernani", "Irun", "Ordizia", "Tolosa", "Zumarraga", "Zarautz", "Arrasate"
            ],
            "Bizkaia" => 
            [
                "Barakaldo", "Bilbo", "Getxo", "Gernika",
                "Santurtzi", "Portugalete"
            ],
            "Araba" => 
            [
                "Agurain", "Añana", "Gasteiz", "Legutio", "Laudio", "Amurrio"
            ],
            "Nafarroa" => 
            [
                "Altsasu", "Arbizu", "Iruña", "Lakuntza", "Otsagabia",
                "Uharte"
            ]
        ];
    ?>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">🚕 Bidaia Berria Sortu</h3>
            </div>
            <div class="card-body">
                <?php if (isset($mezua)): ?>
                    <div class="alert alert-<?= $alertaMota ?> text-center"><?= $mezua ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="data" class="form-label">Data:</label>
                        <input type="date" name="data" id="data" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ordua:</label>
                        <div class="d-flex gap-2">
                            <select id="ordu-select" class="form-select" required>
                                <?php for ($i = 0; $i < 24; $i++): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                <?php endfor; ?>
                            </select>
                            <span class="fw-bold">:</span>
                            <select id="minutu-select" class="form-select" required>
                                <?php for ($i = 0; $i < 60; $i += 5): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <input type="hidden" name="ordua" id="denbora-input" value="00:00" required>
                    </div>

                    <!-- Hasiera (irteera) aukeraketa -->
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

                    <!-- Helmuga (helmuga) aukeraketa -->
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

                    <div class="mb-3">
                        <label for="pertsona_kop" class="form-label">Pertsona kopurua:</label>
                        <input type="number" name="pertsona_kop" id="pertsona_kop" class="form-control" min="1" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Bidaia sortu</button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center">
                <a href="../index.php" class="btn btn-outline-secondary">⬅ Hasierara itzuli</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => 
        {
            const orduSelect = document.getElementById('ordu-select');
            const minutuSelect = document.getElementById('minutu-select');
            const denboraInput = document.getElementById('denbora-input');
            const dataInput = document.getElementById('data');

            function eguneratuOrdua() 
            {
                denboraInput.value = `${orduSelect.value}:${minutuSelect.value}`;
            }

            orduSelect.addEventListener('change', eguneratuOrdua);
            minutuSelect.addEventListener('change', eguneratuOrdua);
            eguneratuOrdua();

            const gaur = new Date().toISOString().split('T')[0];
            dataInput.setAttribute('min', gaur);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
