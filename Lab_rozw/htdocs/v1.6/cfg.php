<?php
    $login = 'admin';
    $pass = '123';
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moja_strona';
    global $link;
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$baza);
    if (!$link) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
?>