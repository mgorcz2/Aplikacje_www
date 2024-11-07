<?php
 error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
 /* po tym komentarzu będzie kod do dynamicznego ładowania stron */
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Marcin Gorczyński" />
    <title>Loty kosmiczne</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/glowna_styl.css">
    <link rel="stylesheet" href="css/styl.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/sklep.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/color/jquery.color.js"></script>
    <script src="js/waga.js" type="text/javascript"></script>
    <script src="js/time.js" type="text/javascript"></script>
</head>
<body onload="gettheDate()">
<?php
$menu = 'html/menu.html';
if (file_exists($menu)) {
    include($menu);
} else {
    echo "Strona nie istnieje.";
}

if(($_GET['idp']=='')) {
    $strona = 'html/glowna.html';
}elseif($_GET['idp'] == 'start'){
    $strona = 'html/start.html';
}elseif($_GET['idp'] == 'coprzed'){
    $strona = 'html/coprzed.html';
}elseif($_GET['idp'] == 'kontynuacja'){
    $strona = 'html/kontynuacja.html';
}elseif($_GET['idp']== 'sklep'){
    $strona = 'html/sklep.html';
}elseif($_GET['idp'] == 'kontakt'){
    $strona = 'html/kontakt.html';
}elseif($_GET['idp'] == 'filmy'){
    $strona = 'html/filmy.html';
}


if (file_exists($strona)) {
    include($strona);
} else {
    echo "Strona nie istnieje.";
}
$nr_indeksu = '169240';
$nrGrupy = 'ISI 1';
echo 'Marcin Gorczynski '.$nr_indeksu.' GRUPA '.$nrGrupy;
?>
</body>

</html>