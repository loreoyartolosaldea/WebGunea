<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Bidaia Sortu</title>

    <!-- Bootstrap estiloak -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilo pertsonalizatua -->
    <link rel="stylesheet" href="../Estiloa/bidaia.css">
</head>
<body class="bg-light">
<?php
    session_start();

    if (!isset($_SESSION['erabiltzaile_nan'])) {
        die("<div class='alert alert-danger text-center m-5'>Errorea: Saioa hasi gabe edo NAN ez dago esleituta.</div>");
    }

    $nan = $_SESSION['erabiltzaile_nan'];

    require_once '../DatuBasea/konexioa.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['data'];
        $ordua = $_POST['ordua'];
        $kop = $_POST['pertsona_kop'];
        $hasiera = $_POST['hasiera'];
        $helmuga = $_POST['helmuga'];

        $now = new DateTime('today');
        $selectedDate = DateTime::createFromFormat('Y-m-d', $data);

        if ($selectedDate < $now) {
            $mezua = "❌ Ezin da data hau aukeratu, gaurkoa edo etorkizukoa izan behar du.";
            $alertaKlasea = "danger";
        } else {
            $stmt = $pdo->prepare("INSERT INTO Bidaia (Data, Ordua, Pertsona_kopurua, Hasiera, Helmuga, Egoera, Erabiltzaile_NAN) 
                                   VALUES (?, ?, ?, ?, ?, 'programatuta', ?)");

            try {
                $stmt->execute([$data, $ordua, $kop, $hasiera, $helmuga, $nan]);
                $mezua = "✅ Bidaia sortua arrakastaz!";
                $alertaKlasea = "success";
            } catch (PDOException $e) {
                $mezua = "❌ Errorea: " . $e->getMessage();
                $alertaKlasea = "danger";
            }
        }
    }
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-center">🚕 Bidaia Berria Sortu</h3>
        </div>

        <div class="card-body">
            <?php if (isset($mezua)): ?>
                <div class="alert alert-<?= $alertaKlasea ?> text-center"><?= $mezua ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="data" class="form-label">Data:</label>
                    <input type="date" name="data" id="data" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ordua:</label>
                    <div class="time-selector d-flex align-items-center gap-2">
                        <select id="hour-select" class="form-select flex-grow-1" required>
                            <?php for ($i = 0; $i <= 23; $i++): ?>
                                <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= $i == 12 ? 'selected' : '' ?>>
                                    <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                </option>
                            <?php endfor; ?>
                        </select>

                        <div class="time-separator fw-bold">:</div>

                        <select id="minute-select" class="form-select flex-grow-1" required>
                            <?php for ($i = 0; $i <= 59; $i++): ?>
                                <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= $i == 0 ? 'selected' : '' ?>>
                                    <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <input type="hidden" name="ordua" id="time-input" value="12:00" required>
                </div>

                <div class="mb-3">
                    <label for="hasiera" class="form-label">Hasiera (Irteera):</label>
                    <select name="hasiera" id="hasiera" class="form-select" required>
                        <option value="">Aukeratu herria</option>
                        <option value="Donostia">Donostia</option>
                        <option value="Irun">Irun</option>
                        <option value="Eibar">Eibar</option>
                        <option value="Arrasate">Arrasate</option>
                        <option value="Tolosa">Tolosa</option>
                        <option value="Hernani">Hernani</option>
                        <option value="Zarautz">Zarautz</option>
                        <option value="Azpeitia">Azpeitia</option>
                        <option value="Beasain">Beasain</option>
                        <option value="Bergara">Bergara</option>
                        <option value="Ordizia">Ordizia</option>
                        <option value="Zumarraga">Zumarraga</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="helmuga" class="form-label">Helmuga (Jomuga):</label>
                    <select name="helmuga" id="helmuga" class="form-select" required>
                        <option value="">Aukeratu helmuga</option>
                        <option value="Donostia">Donostia</option>
                        <option value="Irun">Irun</option>
                        <option value="Eibar">Eibar</option>
                        <option value="Arrasate">Arrasate</option>
                        <option value="Tolosa">Tolosa</option>
                        <option value="Hernani">Hernani</option>
                        <option value="Zarautz">Zarautz</option>
                        <option value="Azpeitia">Azpeitia</option>
                        <option value="Beasain">Beasain</option>
                        <option value="Bergara">Bergara</option>
                        <option value="Ordizia">Ordizia</option>
                        <option value="Zumarraga">Zumarraga</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pertsona_kop" class="form-label">Pertsona kopurua:</label>
                    <input type="number" name="pertsona_kop" id="pertsona_kop" min="1" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Sortu Bidaia</button>
                </div>
            </form>
        </div>

        <div class="card-footer text-center">
            <a href="index.php" class="btn btn-outline-secondary mt-2">⬅ Atzera hasierara</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hourSelect = document.getElementById('hour-select');
        const minuteSelect = document.getElementById('minute-select');
        const timeInput = document.getElementById('time-input');

        const dateInput = document.getElementById('data');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        function updateTimeInput() {
            const hour = hourSelect.value;
            const minute = minuteSelect.value;
            timeInput.value = `${hour}:${minute}`;
        }

        hourSelect.addEventListener('change', updateTimeInput);
        minuteSelect.addEventListener('change', updateTimeInput);

        updateTimeInput();

        function sortSelectOptions(selectId) {
            const select = document.getElementById(selectId);
            const options = Array.from(select.options);

            options.sort((a, b) => a.text.localeCompare(b.text));

            select.innerHTML = "";
            select.appendChild(options[0]);
            options.slice(1).forEach(option => select.appendChild(option));
        }

        sortSelectOptions("hasiera");
        sortSelectOptions("helmuga");
    });
</script>

</body>
</html>
