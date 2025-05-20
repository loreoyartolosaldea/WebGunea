<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Gidariaren Saioa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            session_start();
            require_once '../DatuBaseaKonexioa/konexioa.php';

            $errorea = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $nan = trim($_POST['nan']);
                $pasahitza = trim($_POST['pasahitza']);

                $stmt = $pdo->prepare("SELECT NAN, Izena, Pasahitza FROM Gidaria WHERE NAN = ?");
                $stmt->execute([$nan]);
                $gidari = $stmt->fetch();

                if ($gidari && $pasahitza === $gidari['Pasahitza']) 
                {
                    // Saioa ondo hasi da
                    $_SESSION['Gidari_nan'] = $gidari['NAN'];
                    $_SESSION['izena'] = $gidari['Izena'];
                    $_SESSION['rola'] = 'gidaria';

                    header("Location: ../index.php");
                    exit;
                } else 
                {
                    $errorea = "NAN edo pasahitza ez da zuzena.";
                }
            }
        ?>

        <div class="card mt-5 mx-auto" style="max-width: 400px;">
            <div class="card-header text-white bg-primary text-center">
                <h4>🛵 Gidariaren Saioa Hasi</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($errorea)): ?>
                    <div class="alert alert-danger text-center"><?= $errorea ?></div>
                <?php endif; ?>

                <form method="post" class="needs-validation" novalidate>
                    <label for="nan" class="form-label">NAN</label>
                    <input class="form-control mb-3" type="text" id="nan" name="nan" placeholder="Zure NANa sartu" required>

                    <label for="pasahitza" class="form-label">Pasahitza</label>
                    <input class="form-control mb-3" type="password" id="pasahitza" name="pasahitza" placeholder="Zure pasahitza sartu" required>

                    <button class="btn btn-warning w-100" type="submit">Saioa hasi</button>
                </form>

                <div class="buelta mt-4 text-center">
                    <a href="../index.php">⬅ Itzuli hasierara</a>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Balidazioa -->
        <script>
            (() => 
            {
                'use strict';
                const forms = document.querySelectorAll('.needs-validation');
                Array.from(forms).forEach(form => 
                {
                    form.addEventListener('submit', event => 
                    {
                        if (!form.checkValidity()) 
                        {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            })();
        </script>
    </body>
</html>
