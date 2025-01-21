<?php

// -----------------------------------------------------------------------------
// Plik administracyjny
// Funkcje zarządzania: edycja i usuwanie produktów
// -----------------------------------------------------------------------------

require("../cfg.php");
require 'categories.php';
// Funkcja do logowania użytkownika
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Jeśli nie, przekieruj na stronę logowania
    header("Location: login.php");
    exit;
}

//funckja dodajaca produkt do bazy danych
function DodajProdukt($dane) {
    global $link;

    $tytul = mysqli_real_escape_string($link, $dane['tytul']);
    $opis = mysqli_real_escape_string($link, $dane['opis']);
    $data_wygasniecia = mysqli_real_escape_string($link, $dane['data_wygasniecia']);
    $cena_netto = (float)$dane['cena_netto'];
    $podatek_vat = (float)$dane['podatek_vat'];
    $ilosc = (int)$dane['ilosc'];
    $status = isset($dane['status']) ? 1 : 0; // Wartość 1, jeśli zaznaczony, w przeciwnym razie 0
    $kategoria_id = (int)$dane['kategoria_id'];
    $gabaryt = mysqli_real_escape_string($link, $dane['gabaryt']);
    $zdjecie = null;

    // Pobranie obrazu z pliku, jeśli został przesłany
    if (isset($_FILES['zdjecie']) && is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
        $zdjecie = file_get_contents($_FILES['zdjecie']['tmp_name']);
    }

    // Zapytanie SQL dla INSERT
    $query = "INSERT INTO produkty (tytul, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, cena_netto, podatek_vat, ilosc, status, kategoria_id, gabaryt, zdjecie)
              VALUES ('$tytul', '$opis', NOW(), NOW(), '$data_wygasniecia', $cena_netto, $podatek_vat, $ilosc, $status, $kategoria_id, '$gabaryt', ?)";

    $stmt = mysqli_prepare($link, $query);

    // Wysyłanie danych binarnych
    mysqli_stmt_bind_param($stmt, 'b', $zdjecie);

    // Jeśli dane są duże, wysyłanie ich w kawałkach
    mysqli_stmt_send_long_data($stmt, 0, $zdjecie);

    // Wykonanie zapytania
    if (mysqli_stmt_execute($stmt)) {
        echo "Produkt został dodany!";
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}



//funkcja ktora usuwa produkt z bazy danych
function UsunProdukt($id) {
    global $link;

    $id = (int)$id;

    $query = "DELETE FROM produkty WHERE id = $id LIMIT 1";
    if (mysqli_query($link, $query)) {
        echo "Produkt został usunięty!";
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}
//funkcja ktora pobiera produkty z bazy danych
function PokazProdukty() {
    global $link;

    $query = "SELECT produkty.*, kategorie.nazwa AS kategoria_nazwa
        FROM produkty
        LEFT JOIN kategorie ON produkty.kategoria_id = kategorie.id
    ";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo '<table border="1" cellpadding="5">';
        echo '
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Cena netto</th>
            <th>VAT</th>
            <th>Ilość</th>
            <th>Status</th>
            <th>Kategoria</th>
            <th>Data utworzenia</th>
            <th>Data wygasniecia</th>
            <th>zdjecie</th>
            <th>Opcje</th>
        </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['tytul']) . '</td>';
            echo '<td>' . $row['cena_netto'] . ' zł</td>';
            echo '<td>' . $row['podatek_vat'] . ' %</td>';
            echo '<td>' . $row['ilosc'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td>' . htmlspecialchars($row['kategoria_nazwa']) . '</td>';
            echo '<td>' . $row['data_utworzenia'] . '</td>';
            echo '<td>' . $row['data_wygasniecia'] . '</td>';
            echo '<td>';
            if (!empty($row['zdjecie'])) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['zdjecie']) . '" width="100" height="auto"/>';
            } else {
                echo 'Brak zdjęcia';
            }
            echo '</td>';
            echo '<td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <button type="submit" class="delete" name="usun">Usuń</button>
                    </form>
                    <a href="?edit_id=' . $row['id'] . '">Edytuj</a>
                  </td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['dodaj'])) {
        DodajProdukt($_POST);
    } elseif (isset($_POST['edytuj'])) {
        EdytujProdukt($_POST['id'], $_POST);
    } elseif (isset($_POST['usun'])) {
        UsunProdukt($_POST['id']);
    }
}
//funkcja edytujaca produkt
function EdytujProdukt($id, $dane) {
    global $link;

    $id = (int)$id;
    $tytul = mysqli_real_escape_string($link, $dane['tytul']);
    $opis = mysqli_real_escape_string($link, $dane['opis']);
    $cena_netto = (float)$dane['cena_netto'];
    $podatek_vat = (float)$dane['podatek_vat'];
    $ilosc = (int)$dane['ilosc'];
    $status = isset($dane['status']) ? 1 : 0;
    $kategoria_id = (int)$dane['kategoria_id'];
    $gabaryt = mysqli_real_escape_string($link, $dane['gabaryt']);
    $zdjecie = null;

    // Pobranie zdjęcia, jeśli zostało przesłane
    if (isset($_FILES['zdjecie']) && is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
        $zdjecie = file_get_contents($_FILES['zdjecie']['tmp_name']);
    }
    if ($zdjecie !== null) {
        echo '<p>Zdjęcie ma długość: ' . strlen($zdjecie) . ' bajtów</p>';
        echo '<p>Zapytanie: UPDATE produkty z nowym zdjęciem</p>';
    } else {
        echo '<p>Brak nowego zdjęcia. Zapytanie: UPDATE produkty bez zmiany zdjęcia</p>';
    }
    if($zdjecie !==null){
        $query = "UPDATE produkty
          SET tytul = '$tytul', opis = '$opis', data_modyfikacji = NOW(),
              cena_netto = $cena_netto, podatek_vat = $podatek_vat, ilosc = $ilosc, status = $status,
              kategoria_id = $kategoria_id, gabaryt = '$gabaryt', zdjecie = ?
          WHERE id = $id";
        $stmt = mysqli_prepare($link, $query);

        // Wysyłanie danych binarnych
        mysqli_stmt_bind_param($stmt, 'b', $zdjecie);

        // Jeśli dane są duże
        mysqli_stmt_send_long_data($stmt, 0, $zdjecie);
    }else{
    $query = "UPDATE produkty
          SET tytul = '$tytul', opis = '$opis', data_modyfikacji = NOW(),
              cena_netto = $cena_netto, podatek_vat = $podatek_vat, ilosc = $ilosc, status = $status,
              kategoria_id = $kategoria_id, gabaryt = '$gabaryt'
          WHERE id = $id";
    $stmt = mysqli_prepare($link, $query);
    }
    if (mysqli_stmt_execute($stmt)) {
        echo "Produkt został zaktualizowany!";
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}


echo '<h2>Zarządzaj produktami</h2>';
PokazProdukty();
$productToEdit = null;

//pobranie danych do edycji
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $id = (int)$_GET['edit_id'];
    $query = "SELECT * FROM produkty WHERE id = $id";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $productToEdit = mysqli_fetch_assoc($result);
    }
}


// -------------------------------
// Formularz edytowania produktu
// -------------------------------
if ($productToEdit) {
    echo '<h3>Edytuj Produkt</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="' . htmlspecialchars($productToEdit['id']) . '">
        Tytuł: <input type="text" name="tytul" value="' . htmlspecialchars($productToEdit['tytul']) . '" required><br>
        Opis: <textarea name="opis">' . htmlspecialchars($productToEdit['opis']) . '</textarea><br>
        <!Data wygaśnięcia: <input type="date" name="data_wygasniecia" value="' . htmlspecialchars($productToEdit['data_wygasniecia']) . '">-><br>
        Cena netto: <input type="number" name="cena_netto" value="' . htmlspecialchars($productToEdit['cena_netto']) . '" required><br>
        Podatek VAT: <input type="number" name="podatek_vat" value="' . htmlspecialchars($productToEdit['podatek_vat']) . '" required><br>
        Ilość: <input type="number" name="ilosc" value="' . htmlspecialchars($productToEdit['ilosc']) . '" required><br>
        Status: <input type="checkbox" name="status" ' . ($productToEdit['status'] ? 'checked' : '') . '><br>
        Kategoria ID: <input type="number" name="kategoria_id" value="' . htmlspecialchars($productToEdit['kategoria_id']) . '" required><br>
        Gabaryt: <input type="text" name="gabaryt" value="' . htmlspecialchars($productToEdit['gabaryt']) . '" required><br>
        Zdjęcie: <input type="file" name="zdjecie" accept="image/*"><br>
        <button type="submit" name="edytuj">Edytuj Produkt</button>
    </form>';
}

// -------------------------------
// Formularz dodawania produktu
// -------------------------------
echo '<h3>Dodaj Produkt</h3>
<form method="post" enctype="multipart/form-data">
    Tytuł: <input type="text" name="tytul" required><br>
    Opis: <textarea name="opis" required></textarea><br>
    Data wygaśnięcia: <input type="date" name="data_wygasniecia" required><br>
    Cena netto: <input type="number" name="cena_netto" required><br>
    Podatek VAT: <input type="number" name="podatek_vat" required><br>
    Ilość: <input type="number" name="ilosc" required><br>
    Status dostępności: <input type="checkbox" name="status"><br>
    Kategoria ID: <input type="number" name="kategoria_id" required><br>
    Gabaryt: <input type="text" name="gabaryt" required><br>
    Zdjęcie: <input type="file" name="zdjecie" accept="image/*"><br>
    <button type="submit" name="dodaj">Dodaj Produkt</button>
</form>';


?>
 <link rel="stylesheet" href="../css/admin.css"> <!-- Styl dla menu -->
 <a href="../index.php" type="button">Powrót do strony głównej</a>