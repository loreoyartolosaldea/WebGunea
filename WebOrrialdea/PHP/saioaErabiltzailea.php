<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Saioa hasi - Erabiltzailea</title>
        
        <!-- Bootstrap estiloak txertatzen dira -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Estilo pertsonalizatua kargatzen da -->
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            // Saioaren hasiera
            session_start();

            // Datu-basearekin konexioa lortzen da
            require_once '../DatuBaseaKonexioa/konexioa.php';

            // Erroreak erakusteko aldagaia
            $errorea = "";

            // Formularioa bidali bada (POST bidez)
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // Erabiltzaileak sartutako NAN eta pasahitza jasotzen dira
                $nan = trim($_POST['nan']);
                $pasahitza = trim($_POST['pasahitza']);

                // NAN horrekin datu-basean erabiltzailea bilatzen da
                $stmt = $pdo->prepare("SELECT NAN, Izena, Pasahitza FROM Erabiltzailea WHERE NAN = ?");
                $stmt->execute([$nan]);
                $erabiltzailea = $stmt->fetch();

                // Erabiltzailea existitzen bada
                if ($erabiltzailea) 
                {
                    // Datu-baseko pasahitza eskuratzen da
                    $pasahitzaBD = $erabiltzailea['Pasahitza'];

                    // Pasahitzak berdinak badira (testu arrunta)
                    if ($pasahitza === $pasahitzaBD) 
                    {
                        // Saioan erabiltzailearen informazioa gordetzen da
                        $_SESSION['erabiltzaile_nan'] = $erabiltzailea['NAN'];
                        $_SESSION['izena'] = $erabiltzailea['Izena'];
                        $_SESSION['rola'] = 'erabiltzailea';

                        // Hasiera orrira birbideratzen da
                        header("Location: ../index.php");
                        exit;
                    } else 
                    {
                        // Pasahitza okerra bada
                        $errorea = "NAN edo pasahitza okerra.";
                    }
                } else 
                {
                    // NAN hori ez badago erregistratuta
                    $errorea = "NAN edo pasahitza okerra.";
                }
            }
        ?>

        <!-- Login orria HTML bidez -->
        <div class="card mt-5 mx-auto" style="max-width: 400px;">
            <div class="card-header text-white bg-primary text-center">
                <h4>Erabiltzailearen Saioa</h4>
            </div>
            <div class="card-body">
                <!-- Errorea badago, bistaratzen da -->
                <?php if (!empty($errorea)): ?>
                    <div class="alert alert-danger text-center"><?= $errorea ?></div>
                <?php endif; ?>

                <!-- Saioa hasteko formularioa -->
                <form method="post" class="needs-validation" novalidate>
                    <input class="form-control mb-3" type="text" name="nan" placeholder="NAN" required>
                    <input class="form-control mb-3" type="password" name="pasahitza" placeholder="Pasahitza" required>
                    
                    <!-- Bidali botoia -->
                    <button class="btn btn-warning w-100" type="submit">Sartu</button>
                </form>

                <!-- Hasierara itzultzeko esteka -->
                <div class="text-center mt-4">
                    <a href="../index.php">⬅ Itzuli hasierara</a>
                </div>
            </div>
        </div>

        <!-- Bootstrap-eko scriptak -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Formularioaren balidazioa Bootstrap erabiliz -->
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
