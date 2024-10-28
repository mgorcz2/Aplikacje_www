<?php
 $nr_indeksu = '169240';
 $nrGrupy = 'ISI 1';
 echo 'Marcin Gorczyński'.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
 echo 'Zastosowanie metody include() <br />';

 require_once 'require.php'; // Dołączenie pliku TYLKO RAZ z zmienną imienazwisko 
 echo $imienazwisko.' '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
 echo 'Zastosowanie metody require_once() <br />';

 $a=2;
 $b= 3;
 if ($a > $b)
 echo "a is bigger than b";
 else
 echo "a is smaller than b";

 echo ' <br / >';
 $i=2;
 switch ($i) {
    case 0:
        echo "i equals 0";
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
}
echo '<br />Zastosowanie funkcji warunkowych  <br />';
for ($i = 1; $i <= 10; $i++) {
    echo '<br />'.$i;
}
echo '<br />Zastosowanie petli <br />';
?>