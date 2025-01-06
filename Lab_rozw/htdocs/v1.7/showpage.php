<?php
// -----------------------------------------------------------------------------
// Funkcja pobierająca podstronę na podstawie ID
// -----------------------------------------------------------------------------
function PokazPodstrone($id)
{
    require('cfg.php');
    global $link;
    require_once('sklep.php');
    require_once('koszyk.php');

    $id_clear = (int)$id;

    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($link, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);
        if (empty($row['id'])) {
            echo "Nie znaleziono podstrony.";
        }elseif($id_clear == 6){
            $pageContent = $row['page_content'];
            $pageContent .= DodajProduktyDoSklepu();
            return $pageContent;
        }elseif($id_clear == 13){
            $pageContent = $row['page_content'];
            $pageContent .= showCart();
            return $pageContent;
        }
        else {
            return $row['page_content'];
        }
    } else {
        echo "Błąd zapytania: " . mysqli_error($link);
    }
}

?>