<?php
    // MySQL zerbitzariaren konfigurazioa
    $host = 'localhost'; // '127.0.0.1' edo 'localhost' erabil dezakezu, zure konfiguraziotik araberakoa
    $dbname = 'alaikToMUGI'; // Datu-basearen izena
    $username = 'root'; // XAMPP erabiltzailearen izena (XAMPP-k root erabiltzailea du)
    $password = 'pvlbtnse'; // XAMPP-n password-a hutsik dago (MySQL Workbench-en beste password bat erabiltzen baduzu, horri egokitu)

    try 
    {
        // PDO erabiliz datu-basearekin konektatzen gara
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Konektatutakoan, erroreak erakutsi behar dituela konfiguratzen dugu
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) 
    {
        // Konektatzerakoan errore bat gertatzen bada, mezu bat erakutsiko du
        echo 'Konexioa huts egin du: ' . $e->getMessage();
    }
?>
