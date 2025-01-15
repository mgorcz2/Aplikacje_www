<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Marcin Gorczyński" />
    <title>Loty kosmiczne</title>
    <link rel="stylesheet" href="css/menu.css"> <!-- Styl dla menu -->
    <link rel="stylesheet" href="css/glowna_styl.css"> <!-- Styl główny -->
    <link rel="stylesheet" href="css/styl.css"> <!-- Dodatkowe style -->
    <link rel="stylesheet" href="css/kontakt.css"> <!-- Styl formularzy -->
    <link rel="stylesheet" href="css/sklep.css"> <!-- Styl sklepu -->
    <!-- Dołączenie bibliotek i skryptów JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://code.jquery.com/color/jquery.color.js"></script> <!-- jQuery Color -->
    <script src="js/waga.js" type="text/javascript"></script> <!-- Skrypt kalkulatora wag -->
    <script src="js/time.js" type="text/javascript"></script> <!-- Skrypt wyświetlania daty -->
</head>
<body onload="gettheDate()"> <!-- Po załadowaniu strony uruchamia funkcję wyświetlającą datę -->
<?php
// Dołączenie pliku PHP do obsługi wyświetlania stron
require('showpage.php');

$strona = PokazPodstrone(1);
if (!isset($_GET['idp']) || $_GET['idp'] == '' || $_GET['idp'] == 'index') {
    $strona = PokazPodstrone(1);
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
} elseif ($_GET['idp'] == 'koszyk') {
    $strona = PokazPodstrone(13); // Koszyk
} 


$menu = PokazPodstrone(2); 
echo $menu; // Wyświetlenie menu
echo $strona; //wyswielt zawartosc podstrony


// Informacje o autorze projektu
$nr_indeksu = '169240';
$nrGrupy = 'ISI 1';
echo '<center>Marcin Gorczynski '.$nr_indeksu.' GRUPA '.$nrGrupy;
?>
<a href="index.php?idp='index'" class="home_button"><B>HOME</B></a>
<a href="admin/login.php" class="admin_button">Zaloguj</a>
</body>
</html>
