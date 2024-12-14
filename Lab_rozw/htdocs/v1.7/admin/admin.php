<?php

// -----------------------------------------------------------------------------
// Plik administracyjny
// Funkcje zarządzania: logowanie, dodawanie, edycja i usuwanie podstron
// -----------------------------------------------------------------------------

session_start();
require("cfg.php");

// Funkcja do logowania użytkownika
function FormularzLogowania()
{
    $wynik = '
    <div class="logowanie">
        <h1 class="heading">Panel CMS:</h1>
        <div class="logowanie">
            <form method="post" name="LoginForm" enctype="multipart/form-data" action="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
                <table class="logowanie">
                    <tr>
                        <td class="log4_t">[email]</td>
                        <td><input type="text" name="login_email" class="logowanie" /></td>
                    </tr>
                    <tr>
                        <td class="log4_t">[haslo]</td>
                        <td><input type="password" name="login_pass" class="logowanie" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="x1_submit" class="logowanie" value="zaloguj" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="skip_login" class="logowanie" value="Pomiń logowanie" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    ';

    return $wynik;
}

// Sprawdzanie czy użytkownik chce pominąć logowanie
if (isset($_POST['skip_login'])) {
    $_SESSION['is_logged_in'] = true;
    header("Location: index.php?idp=calc"); // Przekierowanie na stronę główną po pominięciu logowania
    exit; // Przerywamy dalsze wykonanie
}

// Jeśli formularz logowania został wysłany
if (isset($_POST['x1_submit'])) {                   
    $email = $_POST['login_email'] ?? '';
    $password = $_POST['login_pass'] ?? '';
    if ($email === $login && $password === $pass) {
        $_SESSION['is_logged_in'] = true;
        $admin = TRUE;
    } else {
        echo 'Błędny login lub hasło.';
        exit; 
    }
}

// Jeśli nie ma sesji z logowaniem i nie jest pominięte logowanie
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    echo FormularzLogowania();
    exit; // Przerywamy dalsze wykonanie, jeśli użytkownik nie jest zalogowany
}
function ListaPodstron() {
    global $link;

    // Zapytanie do bazy danych, aby pobrać wszystkie podstrony
    $query = "SELECT id, page_title FROM page_list"; 
    $result = mysqli_query($link, $query);

    if ($result) {
        echo '<table border="1" cellpadding="5">';
        echo '<tr><th>ID</th><th>Tytuł</th><th>Opcje</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['page_title'] . '</td>';
            echo '<td>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <input type="submit" value="Edytuj" />
                    </form>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <input type="submit" value="Usuń" onclick="return confirm(\'Czy na pewno chcesz usunąć tę podstronę?\')" />
                    </form>
                  </td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<hr>';
    } else {
        echo 'Wystąpił błąd podczas pobierania danych z bazy.';
    }

    #edycja
    if (isset($_POST['action']) && $_POST['action'] == 'edit' && isset($_POST['id'])) {
        $id = $_POST['id'];

        // Pobranie danych podstrony z bazy
        $query = "SELECT * FROM page_list WHERE id = $id LIMIT 1";
        $result = mysqli_query($link, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo '<h3>Edytuj Podstronę</h3>';
            echo '<form method="post" action="">
                    Tytuł: <input type="text" name="page_title" value="' . $row['page_title'] . '" required /><br>
                    Treść: <textarea name="content" required>' . $row['page_content'] . '</textarea><br>
                    Aktywna: <input type="checkbox" name="active" ' . ($row['status'] == 1 ? 'checked' : '') . ' /><br>
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="id" value="' . $row['id'] . '" />
                    <input type="submit" value="Zapisz" />
                  </form>';
        } else {
            echo "Nie znaleziono podstrony o tym ID.";
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

#usuniecie
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
        $id = $_POST['id'];

        // Usunięcie podstrony z bazy danych
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
        
        if (mysqli_query($link, $query)) {
            echo "Podstrona została usunięta!";
        } else {
            echo "Błąd usuwania podstrony: " . mysqli_error($link);
        }
    }
}
echo '<br><br><h2>Witaj w panelu administracyjnym!</h2>';
ListaPodstron();


//Funkcja do dodawania podstron
function DodajNowaPodstrone() {
    global $link;

    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $page_title = $_POST['page_title'];
        $content = $_POST['content'];
        $active = isset($_POST['active']) ? 1 : 0;

        $query = "INSERT INTO page_list (page_title, page_content, status) 
                  VALUES ('$page_title', '$content', $active) LIMIT 1";
        if (mysqli_query($link, $query)) {
            echo "Nowa podstrona została dodana!";
        } else {
            echo "Błąd dodawania podstrony: " . mysqli_error($link);
        }
    }

    echo '<h3>Dodaj Nową Podstronę</h3>';
    echo '<form method="post" action="">
            Tytuł: <input type="text" name="page_title" value="" required /><br>
            Treść: <textarea name="content" required></textarea><br>
            Aktywna: <input type="checkbox" name="active"><br>
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="Dodaj Podstronę" />
          </form>';
}
DodajNowaPodstrone();


function DodajKategorie($nazwa, $matka = 0) {
    global $link;

    // Zabezpieczenie danych wejściowych
    $nazwa = mysqli_real_escape_string($link, $nazwa);
    $matka = (int)$matka;

    // Dodawanie kategorii
    $query = "INSERT INTO kategorie (nazwa, matka) VALUES ('$nazwa', $matka)";
    if (mysqli_query($link, $query)) {
        echo "Kategoria została dodana!";
    } else {
        echo "Błąd podczas dodawania kategorii: " . mysqli_error($link);
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
        echo str_repeat('--', $poziom*3) . "ID: " . $row['id']. "  " . htmlspecialchars($row['nazwa']) . "<br>";

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
echo '<h2>Dodaj kategorię</h2>
<form method="post">
    Nazwa: <input type="text" name="nazwa" required><br>
    Matka: <input type="number" name="matka" value="0"><br> <!-- Wartość 0 oznacza kategorię główną -->
    <button type="submit" name="dodaj_kategorie">Dodaj</button>
</form>';

// -------------------------------
// Formularz edytowania kategorii
// -------------------------------
echo '<h2>Edytuj kategorię</h2>
<form method="post">
    ID kategorii: <input type="number" name="id" required><br>
    Nowa nazwa: <input type="text" name="nazwa" required><br>
    Matka: <input type="number" name="matka" value="0"><br> <!-- Wartość 0 oznacza kategorię główną -->
    <button type="submit" name="edytuj_kategorie">Edytuj</button>
</form>';

// -------------------------------
// Formularz usuwania kategorii
// -------------------------------
echo '<h2>Usuń kategorię</h2>
<form method="post">
    ID kategorii: <input type="number" name="id" required><br>
    <button type="submit" name="usun_kategorie" onclick="return confirm(\'Czy na pewno chcesz usunąć tę kategorię?\')">Usuń</button>
</form>';
PokazKategorie();
?>
