<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Ustawienie typu zawartości oraz kodowania znaków -->
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <!-- Ustawienie języka dokumentu na polski -->
    <meta http-equiv="Content-Language" content="pl" />
    <!-- Informacja o autorze strony -->
    <meta name="Author" content="Marcin Gorczyński" />
    <!-- Tytuł strony -->
    <title>Loty kosmiczne</title>
    <!-- Dołączenie arkuszy stylów -->
    <link rel="stylesheet" href="css/menu.css"> <!-- Styl dla menu -->
    <link rel="stylesheet" href="css/glowna_styl.css"> <!-- Styl główny -->
    <link rel="stylesheet" href="css/styl.css"> <!-- Dodatkowe style -->
    <link rel="stylesheet" href="css/form.css"> <!-- Styl formularzy -->
    <link rel="stylesheet" href="css/sklep.css"> <!-- Styl sklepu -->
    <!-- Dołączenie bibliotek i skryptów JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://code.jquery.com/color/jquery.color.js"></script> <!-- jQuery Color -->
    <script src="js/waga.js" type="text/javascript"></script> <!-- Skrypt kalkulatora wag -->
    <script src="js/time.js" type="text/javascript"></script> <!-- Skrypt wyświetlania daty -->
</head>
<body onload="gettheDate()"> <!-- Po załadowaniu strony uruchamia funkcję wyświetlającą datę -->
<?php
// Dołączenie plików PHP do obsługi wyświetlania stron i funkcji administratora
require('showpage.php');
require('admin/admin.php');

// Sprawdzanie parametru 'idp' w URL i ładowanie odpowiedniej podstrony
if (!isset($_GET['idp']) || $_GET['idp'] == '') {
    // Jeśli parametr 'idp' nie jest ustawiony lub jest pusty, załaduj stronę domyślną
    $strona = PokazPodstrone(9);
} elseif ($_GET['idp'] == 'calc') {
    $strona = PokazPodstrone(1); // Kalkulator
} elseif ($_GET['idp'] == 'start') {
    $strona = PokazPodstrone(3); // Informacje o startach
} elseif ($_GET['idp'] == 'coprzed') {
    $strona = PokazPodstrone(4); // Podstrona "Co przed startem"
} elseif ($_GET['idp'] == 'kontynuacja') {
    $strona = PokazPodstrone(5); // Podstrona "Kontynuacja misji"
} elseif ($_GET['idp'] == 'sklep') {
    $strona = PokazPodstrone(6); // Sklep
} elseif ($_GET['idp'] == 'kontakt') {
    $strona = PokazPodstrone(7); // Kontakt
} elseif ($_GET['idp'] == 'filmy') {
    $strona = PokazPodstrone(8); // Filmy
}

// Wywołanie funkcji generującej menu i podstronę
$menu = PokazPodstrone(2); // Generowanie menu strony
echo $menu; // Wyświetlenie menu
echo $strona; // Wyświetlenie zawartości podstrony

// Informacje o autorze projektu
$nr_indeksu = '169240';
$nrGrupy = 'ISI 1';
// echo 'Marcin Gorczynski '.$nr_indeksu.' GRUPA '.$nrGrupy;
?>
</body>
</html>
