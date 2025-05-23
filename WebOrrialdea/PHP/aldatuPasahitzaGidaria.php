<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Pasahitza Aldatu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            session_start(); // Saioa hasi

            // Datu-basearekin konexioa lortzen da
            require_once '../DatuBaseaKonexioa/konexioa.php'; 

            $errorea            =           "";    // Errore mezuak gordetzeko aldagaia
            $arrakasta          =           ""; // Arrakasta mezuak gordetzeko aldagaia

            // Gidaria saioa hasita dagoen eta pasahitza aldatu behar duen egiaztatu
            if (!isset($_SESSION['gidari_nan']) || !$_SESSION['pasahitzaAldatuBehar']) 
            {
                header("Location: saioaGidaria.php"); // Ez bada, loginerako birbideratu
                exit;
            }

            $gidari_nan = $_SESSION['gidari_nan']; // Saioan gordetako gidariaren NANa

            // Formularioa POST bidez bidali bada
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $pasahitz_berria            =           trim($_POST['pasahitz_berria']);
                $pasahitz_berria_berretsi   =           trim($_POST['pasahitz_berria_berretsi']);

                // Pasahitz berriak bat datozen egiaztatu
                if ($pasahitz_berria !== $pasahitz_berria_berretsi) 
                {
                    $errorea = "Pasahitz berriak ez datoz bat. Mesedez, saiatu berriro.";
                } 
                // Pasahitzaren luzera minimorik baduen egiaztatu (adibidez, 6 karaktere)
                else if (strlen($pasahitz_berria) < 6) 
                {
                    $errorea = "Pasahitzak gutxienez 6 karaktere izan behar ditu.";
                }
                else 
                {
                    // Pasahitza gordetzen da
                    $pasahitza_gordetzeko = $pasahitz_berria;

                    // Datu-basean pasahitza eguneratu
                    $stmt = $pdo->prepare("UPDATE Gidaria SET Pasahitza = ? WHERE NAN = ?");
                    if ($stmt->execute([$pasahitza_gordetzeko, $gidari_nan])) 
                    {
                        $_SESSION['pasahitzaAldatuBehar'] = false; // Bandera desaktibatu
                        $arrakasta = "Pasahitza behar bezala aldatu da. Hasierako orrira birbideratzen...";
                        // Birbideratu hasierako orrira denbora labur baten buruan
                        header("Refresh: 3; URL=../index.php"); 
                        exit;
                    } else 
                    {
                        $errorea = "Errore bat gertatu da pasahitza aldatzean. Mesedez, saiatu berriro.";
                    }
                }
            }
        ?>
        <div class="card mt-5 mx-auto" style="max-width: 400px;">
            <div class="card-header text-white bg-warning text-center">
                <h4>⚠️ Pasahitza Aldatu Behar Du</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($errorea)): // Errorea badago, bistaratu ?>
                    <div class="alert alert-danger text-center"><?= $errorea ?></div>
                <?php endif; ?>
                <?php if (!empty($arrakasta)): // Arrakasta mezua badago, bistaratu ?>
                    <div class="alert alert-success text-center"><?= $arrakasta ?></div>
                <?php endif; ?>

                <p class="text-center">Segurtasun arrazoiengatik, zure NANa pasahitz gisa erabili duzu. Mesedez, ezarri pasahitz berri bat jarraitzeko.</p>

                <form method="post" class="needs-validation" novalidate>
                    <label for="pasahitz_berria" class="form-label">Pasahitz Berria</label>
                    <input class="form-control mb-3" type="password" id="pasahitz_berria" name="pasahitz_berria" placeholder="Sartu pasahitz berria" required minlength="6">

                    <label for="pasahitz_berria_berretsi" class="form-label">Pasahitz Berria Berretsi</label>
                    <input class="form-control mb-3" type="password" id="pasahitz_berria_berretsi" name="pasahitz_berria_berretsi" placeholder="Pasahitz berria berretsi" required minlength="6">

                    <button class="btn btn-primary w-100" type="submit">Pasahitza Aldatu</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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