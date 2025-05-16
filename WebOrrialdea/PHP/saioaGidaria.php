<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidaria Saioa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            session_start();
            require_once '../DatuBasea/konexioa.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $nan = trim($_POST['nan']);
                $pasahitza = trim($_POST['pasahitza']);

                $stmt = $pdo->prepare("SELECT NAN, Izena, Pasahitza FROM Gidaria WHERE NAN = ?");
                $stmt->execute([$nan]);
                $gidari = $stmt->fetch();

                if ($gidari && (password_verify($pasahitza, $gidari['Pasahitza']) || $pasahitza === $gidari['Pasahitza'])) 
                {
                    $_SESSION['gidari_nan'] = $gidari['NAN'];
                    $_SESSION['izena'] = $gidari['Izena'];
                    $_SESSION['rola'] = 'gidaria';

                    if ($pasahitza === $gidari['Pasahitza']) 
                    {
                        $hashBerria = password_hash($pasahitza, PASSWORD_DEFAULT);
                        $pdo->prepare("UPDATE Gidaria SET Pasahitza = ? WHERE NAN = ?")->execute([$hashBerria, $nan]);
                    }

                    header("Location: ../index.php");
                    exit;
                } else 
                {
                    $errorea = "NAN edo pasahitza okerra.";
                }
            }
        ?>
        <div class="card">
            <div class="card-header">🛵 Gidariaren Saioa</div>
            <div class="card-body">
                <?php if (isset($errorea)): ?>
                    <div class="alert alert-danger"><?= $errorea ?></div>
                <?php endif; ?>
                <form method="post">
                    <input class="form-control mb-3" type="text" name="nan" placeholder="NAN" required>
                    <input class="form-control mb-3" type="password" name="pasahitza" placeholder="Pasahitza" required>
                    <button class="btn btn-primary w-100" type="submit">Saioa hasi</button>
                </form>
                <div class="buelta mt-4">
                    <a href="../index.php">⬅ Itzuli hasierara</a>
                </div>
            </div>
        </div>
    </body>
</html>
