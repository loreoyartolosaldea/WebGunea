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
            session_start(); // Saioa hasi

            // Datu-basearekin konexioa lortzen da
            // Ziurtatu 'konexioa.php' fitxategiaren bidea zuzena dela
            require_once '../DatuBaseaKonexioa/konexioa.php'; 

            $errorea = ""; // Errore mezuak gordetzeko aldagaia

            // Formularioa POST bidez bidali bada
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // Erabiltzaileak sartutako NAN eta pasahitza jaso eta espazioak kendu
                $nan            =           trim($_POST['nan']);
                $pasahitza      =           trim($_POST['pasahitza']);

                // Gidaria datu-basean bilatu NANaren arabera
                $stmt = $pdo->prepare("SELECT NAN, Izena, Pasahitza FROM Gidaria WHERE NAN = ?");
                $stmt->execute([$nan]);
                $gidaria = $stmt->fetch(); // Gidariaren datuak eskuratu

                // Gidaria aurkitu bada datu-basean
                if ($gidaria) 
                {
                    // Gidariaren pasahitza NAN-a bada (hasierako pasahitza suposatzen da)
                    // Oharra: Segurtasun hobea izateko, pasahitzak HASH bidez gorde eta konparatu beharko lirateke.
                    // Adibidez: 'password_verify($pasahitza, $gidaria['Pasahitza'])' erabiliz.
                    // Baina eskatutakoaren arabera, testu arruntean konparatzen dugu.
                    if ($pasahitza === $nan) 
                    {
                        // Saioan gidariaren informazioa gorde
                        $_SESSION['gidari_nan']             = $gidaria['NAN'];
                        $_SESSION['izena']                  = $gidaria['Izena'];
                        $_SESSION['rola']                   = 'gidaria';
                        $_SESSION['pasahitzaAldatuBehar']   = true; // Pasahitza aldatzera behartzeko bandera aktibatu

                        // Pasahitza aldatzeko orrira birbideratu
                        // Ziurtatu 'aldatuPasahitzaGidaria.php' fitxategia sortuta eta bide egokian dagoela
                        header("Location: aldatuPasahitzaGidaria.php"); 
                        exit; // Birbideratu ondoren exekuzioa gelditu
                    } 
                    // Sartutako pasahitza datu-baseko pasahitzarekin bat badator (NAN-a ez bada)
                    else if ($pasahitza === $gidaria['Pasahitza']) 
                    {
                        // Saioan gidariaren informazioa gorde
                        $_SESSION['gidari_nan']             = $gidaria['NAN'];
                        $_SESSION['izena']                  = $gidaria['Izena'];
                        $_SESSION['rola']                   = 'gidaria';
                        $_SESSION['pasahitzaAldatuBehar']   = false; // Pasahitza aldatu behar ez dela adierazi

                        // Hasierako orrira birbideratu
                        header("Location: ../index.php");
                        exit; // Birbideratu ondoren exekuzioa gelditu
                    } else 
                    {
                        // Pasahitza okerra bada
                        $errorea = "NAN edo pasahitza ez da zuzena.";
                    }
                } else 
                {
                    // Gidaria ez bada aurkitu
                    $errorea = "NAN edo pasahitza ez da zuzena.";
                }
            }
        ?>
        <div class="card mt-5 mx-auto" style="max-width: 400px;">
            <div class="card-header text-white bg-primary text-center">
                <h4>🛵 Gidariaren Saioa Hasi</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($errorea)): // Errorea badago, bistaratu ?>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            (() => 
            {
                'use strict';
                const forms = document.querySelectorAll('.needs-validation'); // 'needs-validation' klasea duten formulario guztiak hautatu
                Array.from(forms).forEach(form => 
                {
                    form.addEventListener('submit', event => 
                    {
                        if (!form.checkValidity()) // Formularioa baliozkoa ez bada
                        {
                            event.preventDefault(); // Ekintza lehenetsia (bidalketa) ekidin
                            event.stopPropagation(); // Gertaeraren hedapena gelditu
                        }
                        form.classList.add('was-validated'); // 'was-validated' klasea gehitu, CSS balidazioa erakusteko
                    }, false);
                });
            })();
        </script>
    </body>
</html>