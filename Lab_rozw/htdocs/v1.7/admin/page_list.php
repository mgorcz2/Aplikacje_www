<?php

ob_start();
// -----------------------------------------------------------------------------
// Plik administracyjny
// Funkcje zarządzania: logowanie, dodawanie, edycja i usuwanie podstron
// -----------------------------------------------------------------------------

session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Jeśli nie, przekieruj na stronę logowania
    header("Location: login.php");
    exit;
}
require("../cfg.php");

// Funkcja do logowania użytkownika

function ZarzadzajPodstronami() {
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
                        <input type="submit" value="Edytuj" class="edit" />
                    </form>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <input type="submit"  class="delete" value="Usuń" onclick="return confirm(\'Czy na pewno chcesz usunąć tę podstronę?\')" />
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
                    Treść: <textarea name="content" required>' . htmlspecialchars($row['page_content']) . '</textarea><br>
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
echo '<h2>Panel zarzadzania podstronami w bazie danych</h2>';
ZarzadzajPodstronami();


//Funkcja do dodawania podstron
function DodajNowaPodstrone() {
    global $link;

    // Przetwarzanie danych formularza
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
        $page_title = mysqli_real_escape_string($link, $_POST['page_title']);
        $content = mysqli_real_escape_string($link, $_POST['content']);
        $active = isset($_POST['active']) ? 1 : 0;

        $query = "INSERT INTO page_list (page_title, page_content, status) 
                  VALUES ('$page_title', '$content', $active)";
        if (mysqli_query($link, $query)) {
            echo "Podstrona została dodana!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Błąd dodawania podstrony: " . mysqli_error($link);
        }
    }

// -------------------------------
// Formularz dodawania podstrony
// -------------------------------
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
ob_end_flush();
?>

<link rel="stylesheet" href="../css/admin.css"> <!-- Styl dla menu -->
<a href="../index.php" type="button">Powrót do strony głównej</a>