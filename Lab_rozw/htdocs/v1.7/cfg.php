<?php


// -----------------------------------------------------------------------------
// Plik konfiguracyjny bazy danych
// -----------------------------------------------------------------------------
    $login = 'admin';
    $pass = '123';
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moja_strona';
    global $link;

    // Połączenie z bazą danych
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$baza);

    // Sprawdzenie poprawności połączenia
    if (!$link) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
?>