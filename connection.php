<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'prova_lombardia';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Connessione al database fallita");
?>