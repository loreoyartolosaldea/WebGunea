<!DOCTYPE html>
<html lang="eu">
    <head>
        <meta charset="UTF-8">
        <title>Erregistroa - alaikToMUGI</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estiloa/autentifikazioa.css">
    </head>
    <body>
        <?php
            require_once '../DatuBasea/konexioa.php';
            session_start();

            $mezuak = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $nan = $_POST['nan'];
                $izena = $_POST['izena'];
                $abizena = $_POST['abizena'];
                $posta = $_POST['posta'];
                $tel = $_POST['tel'];
                $pasahitza = $_POST['pasahitza'];

                // Pasahitza zifratu (hash)
                $pasahitzaZifratua = password_hash($pasahitza, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO Erabiltzailea (NAN, Izena, Abizena, Posta, Tel_zenb, Pasahitza) VALUES (?, ?, ?, ?, ?, ?)");

                if ($stmt->execute([$nan, $izena, $abizena, $posta, $tel, $pasahitzaZifratua])) 
                {
                    // Saioa hasi eta sesio aldagaien balioak ezarri
                    $_SESSION['erabiltzaile_nan'] = $nan;
                    $_SESSION['izena'] = $izena;
                    $_SESSION['abizena'] = $abizena;
                    $_SESSION['rola'] = 'erabiltzailea'; // Garrantzitsua: rola ezarri

                    // Hasierako orrialdera birbideratu
                    header("Location: ../index.php");
                    exit;
                } else 
                {
                    $mezuak = "<div class='alert alert-danger text-center'>Errorea: ezin izan da erregistratu.</div>";
                }
            }
        ?>
    <div class="card mt-4 mx-auto" style="max-width: 500px;">
        <div class="card-header text-white bg-primary text-center">
            <h4>📝 Erabiltzailearen Erregistroa</h4>
        </div>
        <div class="card-body">
            <?= $mezuak ?>
            <form method="post" class="needs-validation" novalidate>
                <input type="text" class="form-control mb-3" name="nan" placeholder="NAN" required>
                <input type="text" class="form-control mb-3" name="izena" placeholder="Izena" required>
                <input type="text" class="form-control mb-3" name="abizena" placeholder="Abizena" required>
                <input type="email" class="form-control mb-3" name="posta" placeholder="Posta elektronikoa" required>
                <input type="text" class="form-control mb-3" name="tel" placeholder="Telefono zenbakia" required>
                <input type="password" class="form-control mb-3" name="pasahitza" placeholder="Pasahitza" required>
                <button type="submit" class="btn btn-warning w-100">Erregistratu</button>
            </form>
            <div class="buelta mt-4 text-center">
                <a href="../index.php">⬅ Itzuli hasierara</a>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Bootstrap balidazio script-a
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
