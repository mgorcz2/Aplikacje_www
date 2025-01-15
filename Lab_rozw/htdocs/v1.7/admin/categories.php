<?php

// -----------------------------------------------------------------------------
// Plik administracyjny
// Funkcje zarządzania: logowanie, dodawanie, edycja i usuwanie kategorii
// -----------------------------------------------------------------------------

session_start();
require("../cfg.php");

// Funkcja do logowania użytkownika
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Jeśli nie, przekieruj na stronę logowania
    header("Location: login.php");
    exit;
}


function DodajKategorie($nazwa, $matka = 0) {
    global $link;

    // Zabezpieczenie danych wejściowych
    $nazwa = mysqli_real_escape_string($link, $nazwa);
    $matka = (int)$matka;

    // Dodawanie kategorii
    $query = "INSERT INTO kategorie (nazwa, matka) VALUES ('$nazwa', $matka) LIMIT 1";
    if (mysqli_query($link, $query)) {
        echo "Kategoria została dodana!";
    } else {
        echo "Błąd podczas dodawania kategorii: " . mysqli_error($link);
    }
}

#aktualizacja
if (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $page_title = $_POST['page_title'];
    $content = $_POST['content'];
    $active = isset($_POST['active']) ? 1 : 0;

    $query = "UPDATE page_list SET page_title = '$page_title', page_content = '$content', status = $active WHERE id = $id LIMIT 1";
    
    if (mysqli_query($link, $query)) {
        echo "Podstrona została zaktualizowana!";
    } else {
        echo "Błąd aktualizacji: " . mysqli_error($link);
    }
}

function EdytujKategorie($id, $nazwa, $matka) {
    global $link;

    // Zabezpieczenie danych wejściowych
    $id = (int)$id;
    $nazwa = mysqli_real_escape_string($link, $nazwa);
    $matka = (int)$matka;

    // Aktualizacja kategorii
    $query = "UPDATE kategorie SET nazwa = '$nazwa', matka = $matka WHERE id = $id LIMIT 1";
    if (mysqli_query($link, $query)) {
        echo "Kategoria została zaktualizowana!";
    } else {
        echo "Błąd podczas aktualizacji kategorii: " . mysqli_error($link);
    }
}
function UsunKategorie($id) {
    global $link;

    $id = (int)$id;

    // Usunięcie kategorii
    $query = "DELETE FROM kategorie WHERE id = $id LIMIT 1";
    if (mysqli_query($link, $query)) {
        echo "Kategoria została usunięta!";
    } else {
        echo "Błąd podczas usuwania kategorii: " . mysqli_error($link);
    }
}
function PokazKategorie($matka = 0, $poziom = 1) {
    global $link;

    // Przygotowanie zapytania do bazy danych
    $query = "SELECT * FROM kategorie WHERE matka = $matka";
    $result = mysqli_query($link, $query);
    // Obsługa błędów zapytania SQL
    if (!$result) {
        echo "Błąd zapytania: " . mysqli_error($link);
        return;
    }
    // Wyświetlanie kategorii w formie drzewa
    while ($row = mysqli_fetch_assoc($result)) {
        // Wyświetlenie nazwy kategorii z odpowiednim wcięciem
        echo str_repeat('--', $poziom*3) . '<text class="kategorie">'. "ID: " . $row['id']. "  " . htmlspecialchars($row['nazwa']) .' </text>'. "<br>";

        // Rekurencyjne wywołanie dla podkategorii
        PokazKategorie($row['id'], $poziom + 1);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['dodaj_kategorie'])) {
        DodajKategorie($_POST['nazwa'], $_POST['matka']);
    } elseif (isset($_POST['edytuj_kategorie'])) {
        EdytujKategorie($_POST['id'], $_POST['nazwa'], $_POST['matka']);
    } elseif (isset($_POST['usun_kategorie'])) {
        UsunKategorie($_POST['id']);
    }
}

//Wyświetlenie formularzy do zarządzania kategoriami

// -------------------------------
// Formularz dodawania kategorii
// -------------------------------
echo '<h3>Dodaj kategorię</h3>
<form method="post">
    Nazwa: <input type="text" name="nazwa" required><br>
    Matka: <input type="number" name="matka" value="0"><br> <!-- Wartość 0 oznacza kategorię główną -->
    <button type="submit" name="dodaj_kategorie">Dodaj</button>
</form>';

// -------------------------------
// Formularz edytowania kategorii
// -------------------------------
echo '<h3>Edytuj kategorię</h3>
<form method="post">
    ID kategorii: <input type="number" name="id" required><br>
    Nowa nazwa: <input type="text" name="nazwa" required><br>
    Matka: <input type="number" name="matka" value="0"><br> <!-- Wartość 0 oznacza kategorię główną -->
    <button type="submit" name="edytuj_kategorie">Edytuj</button>
</form>';

// -------------------------------
// Formularz usuwania kategorii
// -------------------------------
echo '<h3>Usuń kategorię</h3>
<form method="post">
    ID kategorii: <input type="number" name="id" required><br>
    <button type="submit" name="usun_kategorie" onclick="return confirm(\'Czy na pewno chcesz usunąć tę kategorię?\')">Usuń</button>
</form>';

echo '<h3>Kategorie: </h3>';
PokazKategorie();

?>
 <link rel="stylesheet" href="../css/admin.css">
