<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Bidaien Historiala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estiloa/historiala.css">
</head>
<body>
    <?php
        require_once '../DatuBasea/konexioa.php';
        session_start();

        if (!isset($_SESSION['erabiltzaile_nan'])) {
            header("Location: PHP/saioaErabiltzailea.php");
            exit;
        }

        $nan = $_SESSION['erabiltzaile_nan'];

        $stmt = $pdo->prepare("SELECT * FROM Bidaia WHERE Erabiltzaile_NAN = ? ORDER BY Data DESC, ordua DESC");
        $stmt->execute([$nan]);
        $bidaiaGuztiak = $stmt->fetchAll();
    ?>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h3 class="mb-0">🧾 Zure Bidaien Historiala</h3>
            </div>
            <div class="card-body">

                <?php if (count($bidaiaGuztiak) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Data</th>
                                    <th>Ordua</th>
                                    <th>Egoera</th>
                                    <th>Hasiera</th>
                                    <th>Helmuga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bidaiaGuztiak as $bidaia): ?>
                                    <?php
                                        $bidaiaDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $bidaia['Data'] . ' ' . $bidaia['ordua']);
                                        $now = new DateTime();

                                        $egoera = $bidaia['egoera'];
                                        if (in_array(strtolower($egoera), ['programatua', 'bidean']) && $bidaiaDateTime < $now) {
                                            $egoera = 'Eginda';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($bidaia['Data']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['ordua']) ?></td>
                                        <td><?= htmlspecialchars($egoera) ?></td>
                                        <td><?= htmlspecialchars($bidaia['hasiera']) ?></td>
                                        <td><?= htmlspecialchars($bidaia['helmuga']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        Ez duzu oraindik bidaiarik egin.
                    </div>
                <?php endif; ?>

                <div class="text-center mt-4">
                    <a href="../index.php" class="btn btn-outline-primary">⬅ Itzuli hasierara</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
