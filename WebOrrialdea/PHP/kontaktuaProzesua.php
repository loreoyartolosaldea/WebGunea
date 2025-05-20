<?php
// Recibimos los datos enviados por POST
$izena = $_POST['izena'] ?? '';
$email = $_POST['email'] ?? '';
$mezu = $_POST['mezu'] ?? '';

// Validación básica
$errors = [];
if (empty($izena)) {
    $errors[] = "Izena ezin da hutsik egon.";
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Emaila baliogarria sartu behar duzu.";
}
if (empty($mezu)) {
    $errors[] = "Mesua ezin da hutsik egon.";
}

// Si hay errores, los mostramos
if (!empty($errors)) {
    echo "<h2>Erroreak gertatu dira:</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul><a href='kontaktua.php'>Itzuli formularioara</a>";
    exit;
}

// Si no hay errores, enviamos el email (puedes cambiar a tu mail real)
$to = "";
$subject = "Kontaktua alaiktoMUGI webgunetik - $izena";
$message = "Izena: $izena\nEmaila: $email\nMezua:\n$mezu";
$headers = "From: $email\r\nReply-To: $email\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "<h2>Eskerrik asko, $izena!</h2>";
    echo "<p>Mezua ondo bidali da. Berehala jarraituko dugu zurekin harremanetan.</p>";
    echo "<a href='kontaktua.php'>Itzuli kontaktu formularioara</a>";
} else {
    echo "<h2>Errorea gertatu da bidaltzean.</h2>";
    echo "<p>Mesua ezin izan da bidali. Mesedez, saiatu berriro geroago.</p>";
    echo "<a href='kontaktua.php'>Itzuli kontaktu formularioara</a>";
}
?>
