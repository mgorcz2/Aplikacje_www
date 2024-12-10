<?php
// -----------------------------------------------------------------------------
// Funkcja pobierająca podstronę na podstawie ID
// -----------------------------------------------------------------------------
function PokazPodstrone($id)
{
    require('cfg.php');
    global $link;

    // Oczyszczanie zmiennej ID w celu zapobiegania SQL Injection
    $id_clear = (int)$id;

    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($link, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);
        if (empty($row['id'])) {
            echo "Nie znaleziono podstrony.";
        } else {
            return $row['page_content'];
        }
    } else {
        echo "Błąd zapytania: " . mysqli_error($link);
    }
}
?>