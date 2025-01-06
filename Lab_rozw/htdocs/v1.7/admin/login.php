<?php
session_start();
require("../cfg.php");

// -----------------------------------------------------------------------------
// Plik administracyjny
// Funkcje zarządzania: logowanie, panel administracyjny
// -----------------------------------------------------------------------------


// Funkcja do wyświetlania formularza logowania
function FormularzLogowania()
{
    return '
    <div class="logowanie">
        <h1 class="heading">Panel CMS:</h1>
        <form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
            <table class="logowanie">
                <tr>
                    <td>[email]</td>
                    <td><input type="text" name="login_email" class="logowanie" /></td>
                </tr>
                <tr>
                    <td>[haslo]</td>
                    <td><input type="password" name="login_pass" class="logowanie" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="x1_submit" value="Zaloguj" /></td>
                </tr>
            </table>
        </form>
        <a href="../index.php">Wróć na strone główną</a>
    </div>';
}



// Logowanie użytkownika
if (isset($_POST['x1_submit'])) {
    $email = $_POST['login_email'] ?? '';
    $password = $_POST['login_pass'] ?? '';
    if ($email === $login && $password === $pass) {
        $_SESSION['is_logged_in'] = true;
    } else {
        $error = 'Błędny login lub hasło.';
    }
}

// Jeśli nie zalogowany, wyświetl formularz
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    echo FormularzLogowania();
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    exit;
}
// Wylogowanie użytkownika
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
    exit;
}
// Jeśli zalogowany, wyświetl panel
?>
<link rel="stylesheet" href="../css/admin.css"> <!-- Dodatkowe style -->
<h1>Witaj w panelu administracyjnym!</h1>
<a href="../index.php" type="button">Powrót do strony głównej</a>
<a href="page_list.php">Zarzadzaj podstronami</a>
<a href="product.php">Zarzadzaj produktami</a>
