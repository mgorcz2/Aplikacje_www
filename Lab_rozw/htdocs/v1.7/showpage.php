<?php
function PokazPodstrone($id)
{
    require('cfg.php');
    global $link;
    $id_clear = (int)$id;
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($link, $query);
    if ($result) {
        $row = mysqli_fetch_array($result);
        if (empty($row['id'])) {
            echo "nie znaleziono";
        } else {
            return $row['page_content'];
        }
    } else {
       echo "blad".mysqli_error($link);
    }
}

?>