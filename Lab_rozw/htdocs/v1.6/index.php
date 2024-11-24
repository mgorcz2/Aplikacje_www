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
require('showpage.php');
require('admin/admin.php');
if (!isset($_GET['idp']) || $_GET['idp'] == '') {
    $strona = PokazPodstrone(9);
}elseif($_GET['idp'] == 'calc'){
    $strona = PokazPodstrone(1);
}elseif($_GET['idp'] == 'start'){
    $strona = PokazPodstrone(3);
}elseif($_GET['idp'] == 'coprzed'){
    $strona = PokazPodstrone(4);
}elseif($_GET['idp'] == 'kontynuacja'){
    $strona = PokazPodstrone(5);
}elseif($_GET['idp']== 'sklep'){
    $strona = PokazPodstrone(6);
}elseif($_GET['idp'] == 'kontakt'){
    $strona = PokazPodstrone(7);
}elseif($_GET['idp'] == 'filmy'){
    $strona = PokazPodstrone(8);
}
$menu = PokazPodstrone(2);
echo $menu;
echo $strona;   



$nr_indeksu = '169240';
$nrGrupy = 'ISI 1';
#echo 'Marcin Gorczynski '.$nr_indeksu.' GRUPA '.$nrGrupy;
?>


</body>

</html>